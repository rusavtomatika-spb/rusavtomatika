<?php
if (!defined('admin'))
    exit;
global $db;
global $mysqli_db;
if (empty($_COOKIE['a']))
    exit;

ini_set("error_reporting", E_ALL & ~E_DEPRECATED); 

function database_connect()
{
    global $db;
    global $mysqli_db;

    $host = "localhost";
    $port = "3307";
    
    $user = "";
    $pass = "";
    $dbnm = "";
    
    if (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {
        $user = "root";
        $pass = '123456';
        $dbnm = "rusavtomatika_db";
    } else {
        $user = "root";
        $pass = '123456';
        $dbnm = "rusavtomatika_db";
    }

    if (PHP_MAJOR_VERSION < 7) {
        if (!isset($db) or is_null($db)) {
            $h = empty($port) ? $host : $host . ":" . $port;
            $db = mysql_connect($h, $user, $pass);

            if (!$db) {
                print("Datebase connection failed.");
                exit();
            }
            
            if (!mysql_select_db($dbnm)) {
                print("Datebase select failed.");
                exit();
            } else {
                mysql_query("SET NAMES utf8");
            }
        }
    }

    $mysqli_db = mysqli_connect($host, $user, $pass, $dbnm, $port);
    if (!$mysqli_db) {
        echo "[inc_database_credentials.php]" . PHP_EOL;
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    } else {
        mysqli_query($mysqli_db, "SET NAMES utf8");
    }
}
?>