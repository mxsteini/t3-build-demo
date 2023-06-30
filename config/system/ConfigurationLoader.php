<?php
$prefix = 'TYPO3';
$keySeparator = '__';
$configuration = array();

function setValueByPath(array $array, $path, $value, $delimiter = '/')
{
    if (empty($path)) {
        throw new \RuntimeException('Path must not be empty. Please set a non empty $envPrefix!', 1462018404);
    }
    if (!is_string($path)) {
        throw new \RuntimeException('Path must be a string', 1341406402);
    }
    // Extract parts of the path
    $path = str_getcsv($path, $delimiter);
    // Point to the root of the array
    $pointer = &$array;
    // Find path in given array
    foreach ($path as $segment) {
        // Fail if the part is empty
        if (empty($segment)) {
            throw new \RuntimeException('Invalid path segment specified', 1341406846);
        }
        // Create cell if it doesn't exist
        if (!array_key_exists($segment, $pointer)) {
            $pointer[$segment] = array();
        }
        // Set pointer to new cell
        $pointer = &$pointer[$segment];
    }
    // Set value of target cell
    $pointer = $value;
    return $array;
}
foreach ($_ENV as $name => $value) {
    if (!empty($prefix) && strpos($name, $prefix . $keySeparator) !== 0) {
        continue;
    }
    $configuration = setValueByPath(
        $configuration,
        str_replace($keySeparator, '/', substr($name, strlen($prefix . $keySeparator))),
        $value
    );
}

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TYPO3_CONF_VARS'], $configuration);

