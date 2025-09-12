<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Тест moisait >>> Карт ФТП</title>
</head>

<body>
<h1>Тест moisait >>> Карт ФТП</h1>
<br>
<br>
<?php
//ini_set( 'max_execution_time', 22500 );
//ini_set( "memory_limit", "512M" );
ini_set( "error_reporting", E_ALL );
ini_set( "display_errors", 1 );
ini_set( "display_startup_errors", 1 );

//file_put_contents( "error_log", "" );
$server = '82.202.162.16';
$username = 'upload_olga@weblector.ru';
$password = 'olgaglr';
//$username = 'ilval@weblector.ru';
//$password = 'ilval2398';


try {
  $con = ftp_connect( $server, 21 );
  if ( false === $con ) {
    throw new Exception( 'ftp_connect - ERROR<br>' );
  } else {
    echo 'ftp_connect - OK<br>';
  }


  $loggedIn = ftp_login( $con, $username, $password );
  if ( true === $loggedIn ) {
    echo 'ftp_login - OK<br>';
  } else {
    echo 'ftp_login - ERROR<br>';
    throw new Exception( 'Unable to log in' );
  }
  echo 'FTP_USEPASVADDRESS - ' . ftp_set_option( $con, FTP_USEPASVADDRESS, false ) . '<br>';
  echo ftp_pasv( $con, true ) ? 'ftp_pasv - TRUE<br>' : 'ftp_pasv - Не могу включить пассивный режим<br>';
  echo 'Пробуем получить листинг корня: <pre>';
  ftp_set_option( $con, FTP_TIMEOUT_SEC, 15 ); // Устанавливаем таймаут в 15 секунд
  $fff = ftp_nlist( $con, '.' );
  //$fff = scandir( '.' );
  //$fff = ftp_pwd( $con );
  var_dump( $fff );
  //        ftp_put( $con, '/soft_tmp/EasyAccess/cMTViewer_V22351.zip', $_SERVER[ 'DOCUMENT_ROOT' ].'/cMTViewer_V22351.zip', FTP_AUTOSEEK );
  echo '</pre>';
  //echo $_SERVER[ 'DOCUMENT_ROOT' ].'/work/error.txt';
  ftp_close( $con );
} catch ( Exception $e ) {
  echo "Ошибка: " . $e->getMessage();
}
?>
</body>
</html>