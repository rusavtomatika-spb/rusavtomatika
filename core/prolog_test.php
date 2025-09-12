<?php
//header('Content-type: text/html; charset=windows-1251');
define('PROLOG_INCLUDED', true);
if(!defined('bullshit')) {
    define('bullshit', 1);
}

if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/config.php';


define('ROUTE_STRING', (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "");
define('URL_PATH_TO_PRODUCT_PICTURES', "/images/");

include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";

require_once 'config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");

require_once CORE_PATH . '/application/CoreApplication.php';


//include_once 'classes.php';
//require_once CORE_PATH . 'components/menu/top_menu/top_menu.php';


CoreApplication::include_component(["component" => "seo"]);


require_once MAIN_TEMPLATE_PATH . 'header.php';




