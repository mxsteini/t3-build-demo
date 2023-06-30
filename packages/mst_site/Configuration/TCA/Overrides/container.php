<?php

declare(strict_types=1);

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\Loader\YamlFileLoader;

call_user_func(function ($extKey = 'mst_site') {

    /*
     * Use this, if you have complicated things to do otherwise use the yaml-file
     */
    $containers = [
    ];

    if (file_exists(GeneralUtility::getFileAbsFileName('EXT:mst_site/Configuration/TCA/Overrides/container.yaml'))) {
        $containersFromYaml = (new YamlFileLoader())->load(GeneralUtility::getFileAbsFileName('EXT:mst_site/Configuration/TCA/Overrides/container.yaml'));
        $containers = array_replace_recursive($containersFromYaml, $containers);
    }

    foreach ($containers as $ctype => $container) {
        $registry = GeneralUtility::makeInstance(Registry::class);
        $containerConfiguration = new ContainerConfiguration($ctype, $container['label'], $container['description'], $container['config']);
        $containerConfiguration->setIcon($container['iconIdentifier']);
        $registry->configureContainer($containerConfiguration);
    }
});
