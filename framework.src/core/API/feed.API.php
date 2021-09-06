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
    try {
        if (
            str_contains($header, 'Transfer-Encoding')
            || str_contains($header, 'Content-Length')
            ) {
            continue;
        } else {
            header($header, true);
        }
    } catch (\Throwable $th) {
        ErrorHandler::FireJsonError($th->getCode(), $th->getMessage());
    }
}

try {
    $feedData = file_get_contents($dataUrl);
    if ($feedData === false) {
        ErrorHandler::FireJsonError('Fetch Error', 'Fetching Data from ' . $dataUrl . ' failed!');
    }
} catch (\Throwable $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
    die;
}

try {
    switch ($command) {
        case 'rss':
            if (FeedValidator::validate_RSS($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No RSS content warning', 'Your request contains no valid RSS Data');
                die;
            }
            break;
        case 'atom':
            if (FeedValidator::validate_ATOM($feedData)) {
                echo ($feedData);
            } else {
                JsonHandler::FireSimpleJson('No ATOM content warning', 'Your request contains no valid ATOM Data');
                die;
            }
            break;
        case 'api':
            echo ($feedData);
            break;
        default:
            JsonHandler::FireSimpleJson('Endpoint Error', 'Your request contains no valid Data mode');
            die;
    }
} catch (JsonException $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
    die;
}
