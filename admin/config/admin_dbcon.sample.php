<?
if (!defined('admin'))
    exit;
global $db;
global $mysqli_db;

ini_set("error_reporting", E_ALL & ~E_DEPRECATED); 

function database_connect()
{
    global $db;
    global $mysqli_db;

    $host = "127.0.1.29";
    $user = "root";
    $pass = '';
    $dbnm = '';

    $mysqli_db = mysqli_connect($host, $user, $pass, $dbnm);
    
    if (!$mysqli_db) {
        echo "[inc_database_credentials.php]" . PHP_EOL;
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }
    
    mysqli_set_charset($mysqli_db, "utf8");
    
    if (PHP_MAJOR_VERSION < 7) {
        $db = $mysqli_db;
    }
}

database_connect();
?>