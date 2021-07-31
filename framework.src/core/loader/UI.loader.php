<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;

include 'core.loader.php';

try {
    $database_link = StartUp::loadDatabase();
    StartUp::checkDatabaseStatus();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
$pagePath = Main::validateHome(Main::getUrlInterpreter());
$pageList = Main::validateFile('page/open/');
$pageName = Main::getPageNameFromPath($pagePath);

Main::ipCheck($database_link);