<?php

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;

$classString = './class/';
$modelString = './model/';
$configString = './config/';

$objFiles = array_diff(scandir($modelString), array('.', '..'));
$classFiles = array_diff(scandir($classString), array('.', '..'));

foreach ($objFiles as $singleObj) {
    include $modelString . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode('.', $singleClass);
    if ($classParts[1] === 'class') {
        include $classString . $singleClass;
    }
}

try {
	ConfigLoader::loadConfig($configString);
} catch (JsonException $e) {
	ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
