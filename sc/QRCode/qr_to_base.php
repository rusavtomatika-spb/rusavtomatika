<?php
if (!defined('true_qr_scan'))
    exit;

require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';

function add_message($message){
    /*
    if (mb_detect_encoding($message) == 'UTF-8') {
        $message = iconv("utf-8", "windows-1251", $message);
    }*/
    global $db;
   // $message = strip_tags($message);
    //$message = trim($message);
     $query = "INSERT INTO qr_codes(source,country,city,ip,browser,browser_ver,os,device,time,http_user_agent) "
        . "VALUES('{$message['source']}','{$message['country']}','{$message['city']}','{$message['ip']}','{$message['browser']}','{$message['browser_ver']}','{$message['os']}','{$message['device']}','{$message['time']}','{$message['http_user_agent']}');";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    //return  mysqli_fetch_array($result);
}
/**
 *
 *
 * Created by PhpStorm.
 * User: Leo
 * Date: 21.08.2019
 * Time: 14:56
 */