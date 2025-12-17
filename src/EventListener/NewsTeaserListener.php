<?php

namespace Mstudio\ContaoNewsAutoTeaser\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\ContentModel;
use Contao\StringUtil;

class NewsTeaserListener
{
    #[AsCallback(table: 'tl_news', target: 'config.onsubmit')]
    public function onSubmmitCallback(DataContainer $dc): void
    {
        if (!$dc->activeRecord) {
            return;
        }

        if ($dc->activeRecord->teaser_processed) {
            return;
        }

        $teaser = $dc->activeRecord->teaser;
        $cleanTeaser = strip_tags($teaser);

        if (mb_strlen($cleanTeaser) > 300) {
            $shortTeaser = StringUtil::substrHtml($teaser, 300);

            $objContent = new ContentModel();
            $objContent->pid = $dc->activeRecord->id;
            $objContent->ptable = 'tl_news';
            $objContent->type = 'text';
            $objContent->text = $teaser;
            $objContent->tstamp = time();
            $objContent->sorting = 128;
            $objContent->save();

            $dc->createNewVersion = false;
            $db = \Database::getInstance();
            $db->prepare("UPDATE tl_news SET teaser = ?, teaser_processed = '1' WHERE id = ?")
               ->execute($shortTeaser, $dc->id);
        }
    }
    public function addProcessedFlagToList(array $row, string $label, DataContainer $dc, array $args): array
    {
        // Wenn verarbeitet, fügen wir einen Hinweis zum Label hinzu
        if ($row['teaser_processed']) {
            // Wir fügen ein kleines Badge oder Text hinzu (HTML ist hier erlaubt)
            $args[0] = $args[0] . ' <span style="color:#1eb27e; font-weight:bold; padding-left:10px;">[Teaser gekürzt ✓]</span>';
        }

        return $args;
    }
}