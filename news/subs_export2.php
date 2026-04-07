<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

//$mysqli = new mysqli('localhost', 'ваш_пользователь', 'ваш_пароль', 'ваша_база');

//if ($mysqli->connect_error) {
//    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
//}

$query = "SELECT email FROM `subscriptions`";
//$res = $mysqli_db->query($query);
$res = mysqli_query( $mysqli_db, $query )or die( mysql_error() );

$recs = '';
while ($row = mysqli_fetch_assoc($res)) {
    $recs .= $row['email'] . PHP_EOL;
}

$to_email = 'km@fam-drive.ru,maxbelousov@ya.ru,maxbel@mail.ru';
$subject = '=?UTF-8?B?' . base64_encode('Список подписчиков') . '?=';

$boundary = md5(uniqid(time()));
$message_body = '--' . $boundary . "\n\n";
$message_body .= $recs;

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";

$headers .= "From: no-reply@rusavtomatika.com\r\n";

$headers .= "Reply-To: no-reply@rusavtomatika.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if (mail($to_email, $subject, $message_body, $headers)) {
    echo 'Письмо успешно отправлено!';
} else {
    echo 'Ошибка отправки письма. Проверьте настройки сервера.';
}

//$mysqli_db->close();

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
?>