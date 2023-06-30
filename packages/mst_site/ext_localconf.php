<?php

/**
 *
 */
(static function (): void {
    $extensionKey = 'mst_site';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:' . $extensionKey . '/Configuration/TSconfig/Page/site.tsconfig">'
    );

    $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['custom'] = 'EXT:mst_site/Configuration/RTE/custom.yaml';

})();
