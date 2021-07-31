<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;

include 'core/loader/core.loader.php';

$APIString = 'core/API/';

$APIFiles = array_diff(scandir($APIString), array('.', '..'));
$command = Main::checkRequest('get', 'apiMode');

foreach ($APIFiles as $singleAPI) {
    $fileParts = explode('.', $singleAPI);
    if ($command === $fileParts[0]) {
        include $APIString . $singleAPI;
    } elseif ($command === null) {
		try {
			JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
		} catch (JsonException $e) {
			ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
		}
	}
}
