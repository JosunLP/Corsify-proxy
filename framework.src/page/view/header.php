<?php

use webapp_php_sample_class\Main;

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="<?php echo LOGO ?>" alt="logo" class="logo">
    <a class="navbar-brand" href="/Home"><?php echo PAGE_TITLE ?> | [<?php echo $pageName; ?>]</a>
    <button class="navbar-toggler navbar-toggler-icon" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    <?php
    Main::navigation($pageMap, $pageName);
    ?>
</nav>
