<?php

namespace Mstudio\NewsAutoTeaserBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\ContentModel;
use Contao\StringUtil;

class NewsTeaserListener
{
    #[AsCallback(table: 'tl_news', target: 'config.onsubmit')]
    public function onSubitNews(DataContainer $dc): void
    {
        if (!$dc->activeRecord) {
            return;
        }

        $teaser = $dc->activeRecord->teaser;
        $maxLength = 300;

        if (mb_strlen(strip_tags($teaser)) > $maxLength) {
            // 1. Den Teaser kürzen (optional mit "...")
            $shortTeaser = StringUtil::substrHtml($teaser, $maxLength, '…');

            // 2. Den Teaser in der Datenbank aktualisieren
            \Database::getInstance()
                ->prepare("UPDATE tl_news SET teaser=? WHERE id=?")
                ->execute($shortTeaser, $dc->id);

            // 3. Prüfen, ob bereits ein automatisches Element existiert,
            // um Dubletten bei jedem Speichern zu vermeiden.
            $existing = ContentModel::findBy(['pid=?', 'ptable=?', 'invisible=?'], [$dc->id, 'tl_news', '0']);
            
            // Logik: Nur erstellen, wenn noch kein Inhalt da ist
            if (null === $existing) {
                $objElement = new ContentModel();
                $objElement->pid = $dc->id;
                $objElement->ptable = 'tl_news';
                $objElement->type = 'text';
                $objElement->text = $teaser; // Hier der volle Text
                $objElement->tstamp = time();
                $objElement->save();
            }
        }
    }
}