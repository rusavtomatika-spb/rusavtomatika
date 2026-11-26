<?php
$redirect_file = $_SERVER['DOCUMENT_ROOT'] . '/include_utf_8/redirect.php';
if (file_exists($redirect_file)) {
    include $redirect_file;
}

define('ERRORS', 1);
if (ERRORS) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

if (!defined('bullshit')) {
    $is_main_domain = ($_SERVER['SERVER_NAME'] === 'www.rusavtomatika.com');
    $is_test_domain = (preg_match('/moisait/i', $_SERVER['SERVER_NAME']) || preg_match('/test/i', $_SERVER['SERVER_NAME']));
    
    if (!$is_main_domain && !isset($_GET['indexindex']) && $is_test_domain && empty($_COOKIE['m'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}

$docRoot = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : '';

if (preg_match('/rusavtomatika\.com$/i', $host) && !preg_match('/test/i', $host)) {
    $env = 'prod';
} elseif (preg_match('/test/i', $host) || preg_match('/moisait/i', $docRoot)) {
    $env = 'test';
} else {
    $env = 'local';
}

$GLOBALS['root_html'] = 'https://www.rusavtomatika.com';
$GLOBALS['APATH'] = ($env === 'prod' && preg_match('/weblec/i', $docRoot)) ? $docRoot : '';
$GLOBALS['path_to_real_files'] = ($env === 'prod' && preg_match('/weblec/i', $docRoot)) 
    ? $docRoot . '/upload_files' 
    : $GLOBALS['root_html'] . '/upload_files';

$GLOBALS['software_links'] = [
    'EB8000'     => '/soft/EB8000/EB8000_setup.zip',
    'EBPro'      => '/soft/EBPro/EBpro_setup.zip',
    'SKWorkshop' => '/soft/SKWorkshop/setup_SKWorkshopv5_0_2.rar',
    'EA20'       => '/soft/EasyAccess/EasyAccess20_setup.zip',
    'PLC_guide'  => '/manuals/PLC_connection_guide.pdf',
];

$GLOBALS['software_versions'] = [
    'EB8000'     => $GLOBALS['path_to_real_files'] . '/soft/EB8000/version.txt',
    'EBPro'      => $GLOBALS['path_to_real_files'] . '/soft/EBPro/version.txt',
    'SKWorkshop' => $GLOBALS['path_to_real_files'] . '/soft/SKWorkshop/version.txt',
    'EA20'       => $GLOBALS['path_to_real_files'] . '/soft/EasyAccess/version.txt',
];

if (!function_exists('database_connect')) {
    function database_connect() {
        global $mysqli_db, $env, $docRoot;
        
        if ($mysqli_db) {
            return;
        }

        $db_host = 'localhost';
        $db_port = 3306;

        if ($env === 'prod' && preg_match('/weblec/i', $docRoot)) {
            $db_user = '';
            $db_pass = '';
            $db_name = '';
        } elseif ($env === 'test' && preg_match('/weblec/i', $docRoot)) {
            $db_user = '';
            $db_pass = '';
            $db_name = '';
        } elseif (preg_match('/moisait/i', $docRoot)) {
            $db_user = '';
            $db_pass = '';
            $db_name = '';
        } elseif (preg_match('/olgaglr/i', $docRoot)) {
            $db_user = '';
            $db_pass = '';
            $db_name = '';
        } else {
            $db_user = '';
            $db_pass = '';
            $db_name = '';
        }

        $mysqli_db = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
        
        if (!$mysqli_db) {
            die('[dbcon.php] Ошибка соединения с MySQL: ' . mysqli_connect_error());
        }
        
        mysqli_set_charset($mysqli_db, 'utf8mb4');
    }
}