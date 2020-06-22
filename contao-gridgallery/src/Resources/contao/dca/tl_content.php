<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['xproject_gridgallery'] = '{type_legend},type;{source_legend},xextendedgallerydata;{invisible_legend:hide},cssID,invisible';
$GLOBALS['TL_DCA']['tl_content']['fields']['xextendedgallerydata'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_content']['xextendedgallerydata'],
    'exclude' => true,
    'inputType' => 'fieldpalette',
    'foreignKey' => 'tl_fieldpalette.id',
    'relation' => array('type' => 'hasMany', 'load' => 'eager'),
    'sql' => "blob NULL",
    'fieldpalette' => array
        (
        'config' => array(
            'hidePublished' => false
        ),
        'list' => array
            (
            'label' => array
                (
                'fields' => array('xextendedgallerydata_grid','xextendedgallerydata_text'),
                'format' => '%s Prozent => %s',
            ),
        ),
        'palettes' => array
            (
            'default' => 'xextendedgallerydata_text,xextendedgallerydata_grid,xextendedgallerydata_thumb,xextendedgallerydata_image',
        ),
        'fields' => array
            (
            'xextendedgallerydata_text' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['xextendedgallerydata_text'],
                'exclude' => true,
                'search' => true,
                'inputType' => 'text',
                'eval' => array('maxlength' => 255, 'tl_class' => 'clr'),
                'sql' => "varchar(255) NOT NULL default ''",
            ),
            'xextendedgallerydata_grid' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['xextendedgallerydata_grid'],
                'exclude' => true,
                'search' => true,
                'inputType' => 'select',
                'options' => array(25, 33, 50, 100),
                'eval' => array('tl_class' => 'clr'),
                'sql' => "int(10) unsigned NOT NULL default '0'"
            ),
            'xextendedgallerydata_thumb' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['xextendedgallerydata_thumb'],
                'exclude' => true,
                'inputType' => 'fileTree',
                'eval' => array('filesOnly' => true, 'files' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'),
                'sql' => "binary(16) NULL",
            ),
            'xextendedgallerydata_image' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['xextendedgallerydata_image'],
                'exclude' => true,
                'inputType' => 'fileTree',
                'eval' => array('filesOnly' => true, 'files' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'),
                'sql' => "binary(16) NULL",
            ),
        ),
    )
);
