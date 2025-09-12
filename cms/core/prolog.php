<?php

define('cms', true);
if (0) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
define('bullshit',1);
include_once $_SERVER["DOCUMENT_ROOT"]."/sc/dbcon.php";
include_once 'config.php';
include_once 'classes.php';

include_once $cms_path_templates . "/" . $cms_template . '/header.php';




