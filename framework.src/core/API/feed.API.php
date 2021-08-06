<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\FeedValidator;

$feedData = file_get_contents($dataUrl);
$originHeaders = get_headers($dataUrl, false);
echo (json_encode($originHeaders));

if ($feedData === false) {
    JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
}

header('Access-Control-Allow-Origin: *');

try {
    foreach ($originHeaders as $header) {
        header($header, true);
    }
} catch (Error $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}

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
        case 'casual':
            echo ($feedData);
            break;
        default:
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            break;
    }
} catch (JsonException $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
