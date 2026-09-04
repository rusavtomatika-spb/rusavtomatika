<?php
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Exception/ExceptionInterface.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Exception/InvalidFileException.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Exception/InvalidPathException.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Exception/ValidationException.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Parser.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Loader.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Validator.php';
require_once __DIR__ . '/vendor/vlucas/phpdotenv/src/Dotenv.php';
use Dotenv\Dotenv;

if (defined("ENCODING") and ENCODING == "UTF-8") {
    header('Content-Type: text/html; charset=utf-8');
} else {
    header('Content-Type: text/html; charset=utf-8');
}

if (1) {
    if (!defined('EX')) {
        define('EX', ""); // для продакшена
    }
} else {
    if (!defined('EX')) {
        define('EX', "_");  // для периода разработки
    }
}

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$apiKey = getenv('API_KEY');
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');
$dbName = getenv('DB_NAME');