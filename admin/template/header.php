<?
if (!defined('admin'))
    exit;

@header("Content-Type: text/html; charset=utf-8");

global $core_admin_path;
$core_admin_path = $_SERVER['DOCUMENT_ROOT'] . '/admin/';
include_once $core_admin_path . 'config/admin_dbcon.php';

if (!defined('PRODUCTS_ALL') and !defined('CONTROLLERS')) {
    include_once $core_admin_path . 'classes/databases.php';
} elseif (defined('CONTROLLERS')) {
    include_once $core_admin_path . 'controllers/classes/databases_controllers.php';
} elseif (defined('PRODUCTS_ALL')) {
    include_once $core_admin_path . 'products_all/classes/databases_products_all.php';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link rel="icon" type="image/gif" href="/images/favicon-a.gif" />
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="Content-Language" content="ru" />
        <title>Административная панель</title>
        <meta name="viewport" content="width=1110" />
        <link rel="stylesheet" type="text/css" href="/admin/template/styles.css" />
        <? if(isset($_COOKIE["template_theme"])){?><link rel="stylesheet" type="text/css" href="/admin/template/styles_theme_<? echo($_COOKIE["template_theme"])?>.css" /><?}?>
        <script src="/admin/template/jquery-3.2.1.min.js"></script>
        <script src="/admin/template/jquery.cookie.js"></script>
        <script src="/admin/template/scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="/admin/template/reformator.css" />
    </head>
    <body>
        <div class="wrapper_all" <? if(isset($_COOKIE["template_theme"])){ echo 'id="template_theme_'.$_COOKIE["template_theme"].'"'; };?>>



