<?php

/*
PAGEINFO
Title: true;
Master: Example;
*/

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\GalleryBuilder;

try {
	GalleryBuilder::GalleryGenerator('./custom/plugin/GalleryBuilder/content/img/');
} catch (Error $e) {
	ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
