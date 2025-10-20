<?php
@header("Content-Type: text/html; charset=windows-1251");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('admin',true);
$core_admin_path = $_SERVER['DOCUMENT_ROOT'].'/admin/';
include $core_admin_path.'template/header.php';
?><h1>Административная панель - главная</h1><?
include $core_admin_path.'menu.php';

include $core_admin_path.'template/footer.php';
?>



