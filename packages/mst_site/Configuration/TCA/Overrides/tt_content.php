<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Configuration\Loader\YamlFileLoader;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

call_user_func(function ($extKey = 'mono_site') {

    
  $newColumns = [
//    'tx_mstsite_icon' => [
//      'label' => 'Heute',
//      'config' => [
//        'type' => 'imageManipulation',
//        'fileFolder_extList' => 'jpg,jpeg,png,svg',
//        'maxWidth' => 1000,
//        'maxHeight' => 1000,
//        'minWidth' => 0,
//        'minHeight' => 0,
//        'crop' => 1,
//        'showThumbs' => 1,
//        'allowedExtensions' => 'jpg,jpeg,png,svg',
//        'disallowedExtensions' => '',
//        'size' => 1,
//        'maxItems' => 1,
//      ],
//    ],
  ];

  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $newColumns
  );

  $GLOBALS['TCA']['tt_content']['columns']['header']['config']['eval'] = 'trim';
  $GLOBALS['TCA']['tt_content']['palettes']['header'] = [
    'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers',
    'showitem' => '
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel, --linebreak--,
            header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
            tx_mstsite_headersize;headerstyle
    '
  ];

  $GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config'] = [
    'cropVariants' => [
      'default' => [
        'title' => '1:1',
        'allowedAspectRatios' => [
          'NaN' => [
            'disabled' => true,
          ],
          '16:9' => [
            'disabled' => true,
          ],
          '4:5' => [
            'disabled' => true,
          ],
          '5:4' => [
            'disabled' => true,
          ],
          'default' => [
            'title' => '1:1',
            'value' => 1,
          ],
        ],
      ],
    ],
  ];


  $newElements = [
    'mono_site_basic_elements' => [
      'title' => 'Basic elements',
      'postion' => 'after:special',
      'elements' => [
        'mst_site_image' => [
          'title' => 'Bild',
          'ctype' => 'image',
          'icon' => 'content-image',
          'config' => [
            'columnsOverrides' => [
              'image' => [
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                  'image', [
                  'appearance' => [
                    'createNewRelationLinkTitle' => 'Hinzufügen',
                  ],
                  'overrideChildTca' => [
                    'types' => [
                      \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                        'showitem' => '
		                    --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
		                    --palette--;;filePalette',
                      ],
                    ],
                    'columns' => [
                      'crop' => [
                        'config' => [
                          'cropVariants' => [
                            'desktop' => [
                              'title' => 'desktop',
                              'allowedAspectRatios' => [
                                'NaN' => [
                                  'title' => 'Frei',
                                  'value' => 0.0,
                                ],
                                'square' => [
                                  'title' => 'Fast Quadratisch',
                                  'value' => 455 / 450,
                                ],
                              ],
                              'cropArea' => [
                                'x' => 0,
                                'y' => 0,
                                'width' => 1,
                                'height' => 1,
                              ],
                            ],
                          ],
                        ],
                      ],
                    ],

                  ],
                  'maxitems' => 1,
                ],
                  'png,jpg,jpeg,svg'
                ),
              ],
            ],
            'showitem' => '
                            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                                --palette--;;general, --palette--;;header, subheader, image,
                            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance, --palette--;;frames,
                            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                                --palette--;;hidden,--palette--;;access,
                       ',
          ],
        ]
      ],
    ],
  ];


  if (file_exists(GeneralUtility::getFileAbsFileName('EXT:mst_site/Configuration/TCA/Overrides/tt_content.yaml'))) {
    $tt_content = (new YamlFileLoader())->load(GeneralUtility::getFileAbsFileName('EXT:mst_site/Configuration/TCA/Overrides/tt_content.yaml'));
    if (key_exists('sections', $tt_content) && is_array($tt_content['sections'])) {
      foreach ($tt_content['sections'] as &$section) {
        foreach ($section['elements'] as &$element) {
          $divs = [];
          foreach ($element['config']['showItem'] as $div) {
            $fields = implode(',', $div['fields']);
            $divs[] = '--div--;' . $div['title'] . ',' . $fields;
          }
          $element['config']['showitem'] = implode(',', $divs);
        }
      }
      $newElements = array_replace_recursive($tt_content['sections'], $newElements);
    }
  }

  foreach ($newElements as $groupdId => $group) {
    ExtensionManagementUtility::addTcaSelectItemGroup(
      'tt_content',
      'CType',
      $groupdId,
      $group['title'],
      $group['position'] ?? 'bottom');
    foreach ($group['elements'] as $ctype => $element) {
      ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
          $element['title'],
          $ctype,
          $element['icon'],
          $groupdId,
        ],
      );

      $GLOBALS['TCA']['tt_content']['types'][$ctype] = $element['config'];
      $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$ctype] = $element['icon'];

    }
  }
});
