<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test5</title>
</head>

<body>
<h1>Test5</h1>
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
    throw new Exception( 'Нет коннекта<br>' );
  } else {
    echo 'Есть коннект!<br>';
  }


  $loggedIn = ftp_login( $con, $username, $password );
  if ( true === $loggedIn ) {
    echo 'Зашёл!<br>';
  } else {
    echo 'Не пускает<br>';
    throw new Exception( 'Unable to log in' );
  }
  echo 'Пробуем получить листинг корня: <pre>';
  var_dump( ftp_nlist( $con, '.' ) );
  echo '</pre>';
		ftp_pasv( $con, true ) or die('Не могу включить пассив<br>');
        ftp_put( $conn_id, '/soft_tmp/EasyAccess/cMTViewer_V22351.zip', $_SERVER[ 'DOCUMENT_ROOT' ].'/download_tmp/tmp_soft/cMTViewer/cMTViewer_V22351.zip', FTP_AUTOSEEK );
  ftp_close( $con );
} catch ( Exception $e ) {
  echo "Failure: " . $e->getMessage();
}
?>
</body>
</html>