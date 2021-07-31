<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

try {
    $command = Main::checkRequest('post', 'svmode');
    if ($command === NULL) {
        $command = DEFAULT_STRING;
    }
} catch (Error $e) {
    $command = DEFAULT_STRING;
}

try {
    switch ($command) {
        case 'pageList':
            StartUp::loadPages();
            JsonHandler::FireSimpleJson('done', 'valid');
            break;
        case 'pluginList':
            PluginLoader::loadPluginConfig();
            JsonHandler::FireSimpleJson('done', 'valid');
            break;
        default:
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            break;
    }

} catch (JsonException $e) {
	ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
