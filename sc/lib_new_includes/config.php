<?php

$document_root = $_SERVER['DOCUMENT_ROOT'];

include ("$document_root/sc/vars.php");
include ("$document_root/sc/kw.php");
if (!defined('cms'))
    define('cms', true);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/cms/core/classes.php');
global $APPLICATION;
global $DBWORK;
$DBWORK = new CDBWork();



$ftp_server = '51.254.18.36';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';
global $ftp_server;
global $ftp_user_name;
global $ftp_user_pass;



if(defined("ENCODING") and ENCODING == 'UTF-8'){
    @header("Content-Type: text/html; charset=utf-8");
}else{
    @header("Content-Type: text/html; charset=windows-1251");
}


