<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Das neue Feld definieren
$GLOBALS['TL_DCA']['tl_news']['fields']['teaser_processed'] = [
    'label'     => ['Teaser verarbeitet', 'Der Teaser wurde bereits gekürzt und der volle Text in die Details verschoben.'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50', 'disabled' => true], // 'disabled', damit man es nicht manuell fälscht
    'sql'       => "char(1) NOT NULL default ''"
];

// 2. Das Feld in der Ansicht (Palette) anzeigen
PaletteManipulator::create()
    ->addField('teaser_processed', 'teaser_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news'); 