<?php
ob_start();

header('Content-type: text/html; charset=UTF-8');
if (!defined('ENCODING')) {
	define('ENCODING', 'UTF-8');
}

define('PROLOG_INCLUDED', true);
if (!defined('bullshit')) {
    define('bullshit', 1);
}

if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

if (function_exists('mb_internal_encoding')) {
	@mb_internal_encoding(ENCODING);
}
@ini_set('default_charset', ENCODING);

include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";

require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/config.php';

define('ROUTE_STRING', (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "");
define('URL_PATH_TO_PRODUCT_PICTURES', "/images/");

database_connect();

global $mysqli_db,$mysql_db;
if ($mysqli_db){
    mysqli_query($mysqli_db, "SET NAMES utf8");
}else{
    mysql_query("SET NAMES utf8",$mysql_db);
}

require_once 'config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");

require_once CORE_PATH . '/application/CoreApplication.php';

CoreApplication::include_component(["component" => "seo"]);

require_once MAIN_TEMPLATE_PATH . 'header.php';