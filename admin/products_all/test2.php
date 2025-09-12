<?php
//ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('admin', true);
define('PRODUCTS_ALL', true);
global $ftpConnectionID;
global $db_work;
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include $core_admin_path . 'template/header.php';
include $core_admin_path . 'products_all/menu.php';
include $core_admin_path . 'products_all/classes/functions.php';
echo connectToFTP();
include $core_admin_path . 'template/footer.php';

?>
