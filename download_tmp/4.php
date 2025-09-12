<p><? echo (date("H:i:s")); ?></p>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="ПОГНАЛИ" id="submit" />
</form>
<?php
ini_set("log_errors", 1);
$err_file = $_SERVER[ 'DOCUMENT_ROOT' ] . "/download/error.txt";
echo $err_file;
ini_set("error_log", $err_file);
//error_log( "Hello, errors!" );
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
if ( isset( $_GET[ 'action' ] ) ) {
//  function ftp_putAll( $conn_id, $src_dir, $dst_dir ) {
//    $d = dir( $src_dir );
//    while ( $file = $d->read() ) {
//      if ( $file != "." && $file != ".." ) {
//        if ( is_dir( $src_dir . "/" . $file ) ) {
//          if ( !@ftp_chdir( $conn_id, $dst_dir . $file ) ) {
//            ftp_mkdir( $conn_id, $dst_dir . $file );
//          }
//          $upload = ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . $file, FTP_BINARY );
//			echo $dst_dir . $file .($upload ? '----OK<br>' : '----ERROR<br>' );
//        } else {
//          $upload = ftp_put( $conn_id, $dst_dir . $file, $src_dir . "/" . $file, FTP_BINARY );
//			echo $dst_dir . $file .($upload ? '----OK<br>' : '----ERROR<br>' );
//        }
//      }
//    }
//    $d->close();
//  }


// проверяем доступность нашего FTP
$ftp_server = '82.202.162.16';
//$ftp_user_name = 'upload_olga@weblector.ru';
//$ftp_user_pass = 'olgaglr';
$ftp_user_name = 'ilval@weblector.ru';
$ftp_user_pass = 'ilval2398';
$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects/test/';
$ftp_folder = '/soft/test/';
$conn_id = @ftp_ssl_connect( $ftp_server,21 );
ftp_set_option($conn_id, FTP_USEPASVADDRESS, false);
//ftp_pasv( $conn_id, true ) or die( "Unable switch to passive mode" );
//ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 5 );
$login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
//var_dump(ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass ));
if ( false === $conn_id ) {
  echo "Невозможно соединиться с FTP-сервером<br>";
  //mail( "maxbelousov@ya.ru", "Копирование soft", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
  exit();
} else {
  //      echo "Есть коннект<br>";

  //    Проверяем авторизацию
  if ( !$login_result ) {
    echo "Ошибка авторизации на FTP<br>";
    //mail( "maxbelousov@ya.ru", "Копирование soft", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    echo "Авторизовался<br>";
  }
  echo 'Res: ' . ( ( ftp_put( $conn_id, '/soft/EBPro/Installer/soft.txt', 'soft.txt', FTP_BINARY ) ) ? 'OK<br>' : 'ERROR<br>' );
  //ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
}
	ftp_close($conn_id);
}
?>
