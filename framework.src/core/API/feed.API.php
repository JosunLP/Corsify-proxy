<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\FeedValidator;

header('Access-Control-Allow-Origin: *');

try {
    $command = Main::checkRequest('get', 'feedMode');
    $dataUrl = Main::checkRequest('get', 'dataUrl');

    if ($command === NULL) {
        $command = DEFAULT_STRING;
    }

    if ($dataUrl === NULL) {
        $dataUrl = DEFAULT_STRING;
    }
} catch (Exception $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
    $command = DEFAULT_STRING;
    $dataUrl = DEFAULT_STRING;
}

$originHeaders = get_headers($dataUrl, false);

foreach ($originHeaders as $header) {
    header($header);
}

try {
    $feedData = file_get_contents($dataUrl);
    if ($feedData === false) {
        JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
    }
} catch (Exception $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}

try {
    switch ($command) {
        case 'rss':
            if (FeedValidator::validate_RSS($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            }
            break;
        case 'atom':
            if (FeedValidator::validate_ATOM($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            }
            break;
        default:
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            break;
    }
} catch (JsonException $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
