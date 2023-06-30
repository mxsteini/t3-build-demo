<?php

$GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants'] = [
    'desktop' => [
        'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariantDefault',
        'selectedRatio' => 'NaN',
        'allowedAspectRatios' => [
            'NaN' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariantFree',
                'value' => 0.0
            ],
            '1:1' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant1to1',
                'value' => 1.0
            ],
            '3:2' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant3to2',
                'value' => 3 / 2
            ],
            '2:3' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant2to3',
                'value' => 2 / 3
            ],
            '4:3' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant4to3',
                'value' => 4 / 3
            ],
            '3:4' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant3to4',
                'value' => 3 / 4
            ],
            '16:9' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant16to9',
                'value' => 16 / 9
            ],
            '16:3' => [
                'title' => 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariant16to3',
                'value' => 16 / 3
            ],
        ],
    ],
];

$GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['tablet'] = $GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['desktop'];
$GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['tablet']['title'] = 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariantTablet';

$GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['smartphone'] = $GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['desktop'];
$GLOBALS['TCA']['sys_file_reference']['columns']['crop']['config']['cropVariants']['smartphone']['title'] = 'LLL:EXT:mst_site/Resources/Private/Language/locallang.xlf:mst_site.cropVariantSmartphone';
