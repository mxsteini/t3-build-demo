<?php

declare(strict_types=1);

namespace MST\MstSite\Listener;

/*
 * This file is part of TYPO3 CMS-based extension "container" by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Core\TypoScript\IncludeTree\Event\ModifyLoadedPageTsConfigEvent;
use TYPO3\CMS\Core\Configuration\Loader\YamlFileLoader;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageTsConfig
{

  public function __invoke(ModifyLoadedPageTsConfigEvent $event): void
  {
    $tsConfig = $event->getTsConfig();
    if ((GeneralUtility::makeInstance(Typo3Version::class))->getMajorVersion() > 11) {
      $tsConfig = array_merge(['pageTsConfig-package-LOWERVENDOR_site' => $this->getPageTsString()], $tsConfig);
    } else {
      $tsConfig['default'] = trim($this->getPageTsString() . "\n" . ($tsConfig['default'] ?? ''));
    }
    $event->setTsConfig($tsConfig);
  }


  public function getPageTsString(): string
  {
    $pageTs = '';
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
        $newElements = $tt_content['sections'];
      }

      // group containers by group

      foreach ($newElements as $group => $groupConfigurations) {

        $content = '
mod.wizards.newContentElement.wizardItems.' . $group . '.header = ' . $groupConfigurations['title'] . '
mod.wizards.newContentElement.wizardItems.' . $group . '.show = *
';
        foreach ($groupConfigurations['elements'] as $cType => $elementConfiguration) {
          if (isset($elementConfiguration['defaultValues']) && is_array($elementConfiguration['defaultValues'])) {
            array_walk($elementConfiguration['defaultValues'], static function (&$item, $key) {
              $item = $key . ' = ' . $item;
            });
            $ttContentDefValues = 'CType = ' . $cType . LF . implode(LF, $elementConfiguration['defaultValues']);
          } else {
            $ttContentDefValues = 'CType = ' . $cType;
          }

          $content .= 'mod.wizards.newContentElement.wizardItems.' . $group . '.elements {
' . $cType . ' {
    title = ' . $elementConfiguration['title'] . '
    description = ' . ($elementConfiguration['description'] ?? '') . '
    iconIdentifier = ' . ($elementConfiguration['icon'] ?? '') . '
    tt_content_defValues {
    ' . $ttContentDefValues . '
    }
}
}
';
        }
        $pageTs .= LF . $content;
      }
    }
    return $pageTs;
  }
}
