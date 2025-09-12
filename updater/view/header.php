<?
header('Content-Type: text/html; charset=windows-1251');
$content = file_get_contents(__DIR__ . "/../settings/settings.php");
$content = json_decode($content, true);
$MD5PASSWORD = $content["settings"]["updater_password"];
if ($_POST["action"] == "auth") {
    if (MD5($_POST["password"]) == $MD5PASSWORD) {
        setcookie("auth", $MD5PASSWORD, time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
        header("Location: /updater/");
    } else {
        require_once 'wrong_password.php';
        exit;
    }
} else if (empty($_COOKIE['auth'])) {
    require_once 'auth.php';
    exit;
} else {
    if ($_COOKIE['auth'] != $MD5PASSWORD) {
        require_once 'auth.php';
        exit;
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="windows-1251">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обновление</title>
    <link src="updater_styles"/>
    <link rel="stylesheet" type="text/css" href="/updater/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/updater/css/updater_styles.css?<?= rand() ?>"/>
</head>
<body>