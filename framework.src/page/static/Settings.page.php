<?php

/*
PAGEINFO
Title: false;
*/


use webapp_php_sample_class\UserConfig;

if (!isset($_SESSION['login_User'])) {
    echo '<h2>You are not logged in!</h2>';
} else {
    echo '<h2>User Config Page</h2>';
    UserConfig::userDataRequest();
    UserConfig::loadConfigTable();
}
