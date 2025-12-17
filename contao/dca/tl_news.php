<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Das neue Feld definieren
$GLOBALS['TL_DCA']['tl_news']['fields']['teaser_processed'] = [
    'label'     => ['Teaser verarbeitet', 'Der Teaser wurde bereits gekürzt und der volle Text in die Details verschoben.'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 m12', 'disabled' => true, 'isBoolean' => true],
    'sql'       => "char(1) NOT NULL default ''"
];

// 2. Das Feld in der Palette (Eingabemaske) anzeigen
PaletteManipulator::create()
    ->addField('teaser_processed', 'teaser_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news');

// 3. Das Feld in der Listenansicht anzeigen (Label-Callback)
// Wir hängen uns an den bestehenden Label-Callback von Contao an
$GLOBALS['TL_DCA']['tl_news']['list']['label']['label_callback'] = [
    'Mstudio\ContaoNewsAutoTeaser\EventListener\NewsTeaserListener', 
    'addProcessedFlagToList'
];