<p><? echo (date("H:i:s")); ?></p>
<?php
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
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';
$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects/test/';
  $ftp_folder = '/soft/test/';
    $conn_id = ftp_connect( $ftp_server );
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
ftp_pasv( $conn_id, true ) or die("Unable switch to passive mode");
        ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 5 );
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
		echo 'Res: ' .((ftp_put( $conn_id, '/soft/EBPro/Installer/demo2.txt', 'demo.txt', FTP_ASCII )) ? 'OK<br>' : 'ERROR<br>' );
		//ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
	}?>