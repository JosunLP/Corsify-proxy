<?php

/*
PAGEINFO
Title: false;
*/

use webapp_php_sample_class\Main;
use webapp_php_sample_class\SessionTool;
use webapp_php_sample_class\StartUp;

$lg = 'page/private/Lg.page.php';
$rg = 'page/private/Pg.page.php';
$lc = 'page/private/Lchoice.page.php';
$st = Main::checkRequest('post', 'st');

switch (Main::checkRequest('post', 'requestMode')) {
    case 'login':
        SessionTool::LoginUser(StartUp::loadDatabase());
        break;

    case 'add':
        SessionTool::AddUser(StartUp::loadDatabase());
        break;

    default:
        break;
}


if ($st === 'login') {
    include $lg;
} elseif ($st === 'register') {
    include $rg;
} else {
    include $lc;
}