<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];

include ("$document_root/sc/dbcon.php"); 

$ftp_server = '51.254.18.36';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';

if(defined("ENCODING") and ENCODING == 'UTF-8'){
    @header("Content-Type: text/html; charset=utf-8");
} else {
    @header("Content-Type: text/html; charset=windows-1251");
}