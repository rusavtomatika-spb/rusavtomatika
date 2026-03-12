<?php
$db_host = 'localhost';
$db_user = 'moisait_olga';
$db_pass = 'olgaglr';
$db_name = 'moisait_ra';

$mysqli_db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$mysqli_db) {
    error_log("Direct DB connection failed: " . mysqli_connect_error());
    die('Database connection failed. Check credentials in direct_db.php');
}

mysqli_set_charset($mysqli_db, "utf8");
?>