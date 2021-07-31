<?php

use webapp_php_sample_class\PluginLoader;

?>
<head>
    <meta charset="<?php echo CHARSET ?>">
    <meta name="description" content="<?php echo DESCRIPTION ?>">
    <meta name="keywords" content="<?php echo KEYWORDS ?>">
    <meta name="author" content="<?php echo AUTHOR ?>">
    <meta name="viewport" content="user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAV_ICON ?>">
    <title><?php echo PAGE_TITLE . ' - ' . $pageName; ?></title>
    <script src="/content/js/main.js"></script>
    <link rel="stylesheet" href="/content/css/main.css">
    <?php PluginLoader::loadPlugins(); ?>
</head>
