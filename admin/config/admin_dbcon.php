<?
if (!defined('admin')) exit;
global $db;
global $mysqli_db;

ini_set("error_reporting", E_ALL & ~E_DEPRECATED); 

if (!getenv('DB_HOST')) {
    $configFile = $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    if (file_exists($configFile)) {
        require_once $configFile;
    }
}

function database_connect()
{
    global $db;
    global $mysqli_db;

    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $dbnm = getenv('DB_NAME');

    $h = empty($port) ? $host : $host . ":" . $port;

    $mysqli_db = mysqli_connect($h, $user, $pass, $dbnm);
    
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