<?php
/*
 * There's no need to edit this file anymore:
 *     Please edit settings for each environment using the .env file within the project root.
 */

if (array_key_exists('T3BUILD_BRWOSERSYNC_TYPO3_DISABLE_PAGECACHE', $_ENV) && $_ENV['T3BUILD_BRWOSERSYNC_TYPO3_DISABLE_PAGECACHE'] == true) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['core']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['hash']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['pages']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['pagesection']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['phpcode']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['runtime']['backend'] = \TYPO3\CMS\Core\Cache\Backend\TransientMemoryBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['rootline']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['imagesizes']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['l10n']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_object']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_reflection']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_datamapfactory_datamap']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['typoscript']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['fluid_template']['backend'] = \TYPO3\CMS\Core\Cache\Backend\NullBackend::class;
}

require_once __DIR__ . '/ConfigurationLoader.php';
$applicationContext = \TYPO3\CMS\Core\Core\Environment::getContext()->__toString();
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] .= ' / ' . $applicationContext;
$GLOBALS['TYPO3_CONF_VARS']['BE']['versionNumberInFilename'] = true;
$GLOBALS['TYPO3_CONF_VARS']['FE']['versionNumberInFilename'] = 'embed';
$GLOBALS['TYPO3_CONF_VARS']['BE']['compressionLevel'] = 9;


// log all messages in syslog
/*
$GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'] = [
  \TYPO3\CMS\Core\Log\LogLevel::WARNING => [
    \TYPO3\CMS\Core\Log\Writer\SyslogWriter::class => [],
  ],
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors']     = 22517; // E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING (everything except deprecated-msgs and notices and warnings)
$GLOBALS['TYPO3_CONF_VARS']['SYS']['syslogErrorReporting']   = 22517; // E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING (everything except deprecated-msgs and notices and warnings)
$GLOBALS['TYPO3_CONF_VARS']['SYS']['belogErrorReporting']    = 22517; // E_ALL ^ E_DEPRECATED ^

*/
