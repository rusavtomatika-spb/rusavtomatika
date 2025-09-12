<?php
  function clean( $conn, $file ) {
    if ( ftp_size( $conn, $file ) == -1 ) {
      $result = ftp_nlist( $conn, $file );
      $i = 0;
      foreach ( $result as $item ) {
        if ( ( strpos( $item, '/.' ) === false ) ) {} else {
          unset( $result[ $i ] );
        }
        $i++;
      }
      foreach ( $result as $childFile ) {
        clean( $conn, $childFile );
      }
      if ( $file != '/drivers_ra/' ) ftp_rmdir( $conn, $file );
    } else {
      ftp_delete( $conn, $file );
    }
  }

        $ftp_folder = '/drivers_ra/';
        $ftp_server = '51.254.18.36';
        $ftp_user_name = 'upload_olga@weblector.ru';
        $ftp_user_pass = 'olgaglr';
        $conn_id = ftp_connect( $ftp_server );
        // проверяем доступность нашего FTP
        if ( false === $conn_id ) {
            echo "Невозможно соединиться с FTP-сервером";
            mail( "maxbelousov@ya.ru", "Копирование драйверов", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
            exit();
        } else {
            $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            // Проверяем авторизацию
            if ( false === $login_result ) {
                echo "Ошибка авторизации на FTP";
                mail( "maxbelousov@ya.ru", "Копирование драйверов", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
                exit();
            } else {
                ftp_pasv( $conn_id, true );
                ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 6600 );
        clean( $conn_id, $ftp_folder );
                unset($files);
            }
        }
?>