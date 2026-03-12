<?php

if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net') {
    $db_host = 'localhost';
    $db_user = 'moisait_olga';
    $db_pass = 'olgaglr';
    $db_name = 'moisait_ra';
} else if ($_SERVER['SERVER_NAME'] == 'www.test.rusavtomatika.com') {
    $db_host = 'localhost';
    $db_user = 'weblec_max_test';
    $db_pass = 'Maxtest-4314';
    $db_name = 'weblec_weintek_test';
}

$mysqli_db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$mysqli_db) {
    error_log("Direct DB connection failed: " . mysqli_connect_error());
    die('Database connection failed. Check credentials in direct_db.php');
}

mysqli_set_charset($mysqli_db, "utf8");
?>