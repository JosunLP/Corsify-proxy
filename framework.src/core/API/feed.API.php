<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\FeedValidator;

try {
    $command = Main::checkRequest('post', 'svmode');
    $dataUrl = Main::checkRequest('post', 'dataUrl');

    if ($command === NULL) {
        $command = DEFAULT_STRING;
    }

    if ($dataUrl === NULL) {
        $dataUrl = DEFAULT_STRING;
    }
} catch (Error $e) {
    $command = DEFAULT_STRING;
    $dataUrl = DEFAULT_STRING;
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
            }
            break;
        case 'atom':
            if (FeedValidator::validate_ATOM($feedData)) {
                echo ($feedData);
            }
            break;
        default:
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            break;
    }
} catch (JsonException $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
