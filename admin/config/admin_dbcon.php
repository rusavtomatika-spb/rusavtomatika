<?
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/ExceptionInterface.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidFileException.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidPathException.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/ValidationException.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Parser.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Loader.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Validator.php';
require_once __DIR__ . '/../vendor/vlucas/phpdotenv/src/Dotenv.php';
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');
$dbName = getenv('DB_NAME');

global $db;
global $mysqli_db;

ini_set("error_reporting", E_ALL & ~E_DEPRECATED); 

if (!getenv('DB_HOST')) {
    $configFile = __DIR__ . '/config/admin_dbcon.php';
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