<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;

?>
<!DOCTYPE html>
<?php
include 'core/loader/UI.loader.php';
?>
<html lang="<?php echo LANGUAGE ?>" dir="ltr">
<?php
include 'page/view/head.php';
?>
<body>
<?php
include 'page/view/header.php';

try {
	Main::main($pagePath, $pageName, $pageMap);
} catch (JsonException $e) {
	ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

include 'page/view/footer.php';
?>
</body>
</html>
