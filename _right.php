<?
header('Content-type: text/html; charset=cp1251');

if (!preg_match("/www\.rusavtomatika\.com/i", $_SERVER['SERVER_NAME'])) {
    if (empty($_COOKIE['m'])) {
        setcookie("m", "r", time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
    }
}
function isSecure()
{
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        return "https";
    } else return "http";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="font-size: 25px">
<br><br>Теперь нажмите: <a href="<?= isSecure() ?>://<?= $_SERVER["SERVER_NAME"] ?>"><?= $_SERVER["SERVER_NAME"] ?></a>

</body>
</html>

