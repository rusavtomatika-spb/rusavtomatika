<? require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
//database_connect();
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
ini_set("error_reporting", E_ALL & ~E_WARNING );
$query = "SELECT * FROM `subscriptions`";
$res = mysql_query( $query )or die( mysql_error() );
//$res = mysql_fetch_assoc( $res );
$recs = '';
while ($row = mysql_fetch_assoc($res)) {
    //$recs[] = $row;
	$recs .= $row['email'].PHP_EOL;
}
$file_path = '/path/to/your/file.txt';
$to_email = 'km@fam-drive.ru';
$subject = 'Список подписчиков';
$message_body = $recs;
$file_content = $recs;
$boundary = md5(uniqid(time()));
$headers = [
    'From' => 'sales@rusavtomatika.com',
    'Reply-To' => 'sales@rusavtomatika.com',
    'Content-Type' => 'multipart/mixed; boundary="' . $boundary . '"'
];
$body = '--' . $boundary . "\n";
$body .= 'Content-Type: text/plain; charset="UTF-8"' . "\n\n";
$body .= $message_body . "\n\n";
// $body .= '--' . $boundary . "\n"; 
// $body .= 'Content-Type: application/octet-stream; name="' . basename($file_path) . '"' . "\n";
// $body .= 'Content-Transfer-Encoding: base64' . "\n";
// $body .= 'Content-Disposition: attachment; filename="' . basename($file_path) . '"' . "\n\n";
// $body .= chunk_split(base64_encode($file_content)) . "\n";
// $body .= '--' . $boundary . "--\n";
if(mail($to_email, $subject, $body, implode("\r\n", $headers))) {
    echo 'Файл успешно отправлен!';
} else {
    echo 'Ошибка отправки файла.';
}
//file_put_contents('subs.txt',$recs);
	//var_dump($recs);
	//echo '<hr>';
	?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php"; ?>