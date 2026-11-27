<?php
header('Content-Type: text/html; charset=utf-8');

$settingsFile = __DIR__ . "/../settings/settings.php";
$content = file_exists($settingsFile) ? file_get_contents($settingsFile) : '';
$content = json_decode($content, true);
$MD5PASSWORD = isset($content["settings"]["updater_password"]) ? $content["settings"]["updater_password"] : '';

$action = isset($_POST["action"]) ? $_POST["action"] : '';

if ($action == "auth") {
    $pass = isset($_POST["password"]) ? $_POST["password"] : '';
    if ($MD5PASSWORD != '' && md5($pass) == $MD5PASSWORD) {
        setcookie("auth", $MD5PASSWORD, time() + 60 * 60 * 24 * 365, "/");
        header("Location: /updater/");
        exit;
    }
    require_once 'wrong_password.php';
    exit;
}

if ($MD5PASSWORD == '' || empty($_COOKIE['auth']) || $_COOKIE['auth'] != $MD5PASSWORD) {
    require_once 'auth.php';
    exit;
}
?><!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Обновление</title>
<link rel="stylesheet" type="text/css" href="/updater/css/reset.css">
<link rel="stylesheet" type="text/css" href="/updater/css/updater_styles.css?<?= rand() ?>">
</head>
<body>