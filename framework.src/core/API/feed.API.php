<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\FeedValidator;

error_reporting(E_ERROR | E_PARSE);

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
    die;
}

try {
    $originHeaders = get_headers($dataUrl, false);

    if ($originHeaders === false) {
        $originHeaders = [];
    }
} catch (\Throwable $th) {
    ErrorHandler::FireJsonError($th->getCode(), $th->getMessage());
    die;
}

header('Access-Control-Allow-Origin: *');
foreach ($originHeaders as $header) {
    if (str_contains($header, 'Transfer-Encoding')) {
        continue;
    } else {
        header($header, true);
    }
}

try {
    $feedData = file_get_contents($dataUrl);
    if ($feedData === false) {
        JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
        die;
    }
} catch (Error $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
    die;
}

try {
    switch ($command) {
        case 'rss':
            if (FeedValidator::validate_RSS($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
                die;
            }
            break;
        case 'atom':
            if (FeedValidator::validate_ATOM($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
                die;
            }
            break;
        default:
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
            die;
    }
} catch (JsonException $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
    die;
}
