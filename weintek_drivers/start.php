<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Драйверы</title>
</head>

<body>
<h1>Обновление раздела ДРАЙВЕРЫ</h1>
<p><? echo (date("H:i:s")); ?></p>
<br>
<br>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
  ini_set( 'max_execution_time', 25000 );
  ini_set( "memory_limit", "512M" );

  ///////////////////////////////////////////////

  function UR_exists( $url ) {
    $headers = get_headers( $url );
    return stripos( $headers[ 0 ], "200 OK" ) ? true : false;
  }

  function deleteFolder( $folderPath ) {
    global $tmp_bufer;
    if ( is_dir( $folderPath ) ) {
      $files = scandir( $folderPath );
      foreach ( $files as $file ) {
        if ( $file != "." && $file != ".." ) {
          if ( is_dir( $folderPath . '/' . $file ) ) {
            deleteFolder( $folderPath . '/' . $file );
          } else {
            unlink( $folderPath . '/' . $file );
          }
        }
      }
      if ( $folderPath != $tmp_bufer ) {
        rmdir( $folderPath );
      }
    }
  }

  require_once( 'tcpdf/tcpdf.php' );
  require_once( 'tcpdf/tcpdi.php' );
  require_once( 'fpdf/fpdi.php' );


  // класс для добавления колонтитула в PDF
  class MYPDF extends FPDI {
    //шапка
    public function Header() {}
    //подвал
    public function Footer() {
      global $tmp_file;
      if ( is_null( $this->_tplIdx ) ) {
        // берём кол-во страниц в исходнике
        $this->numPages = $this->setSourceFile( $tmp_file );
        $this->_tplIdx = $this->importPage( 1 );
      }
      $this->useTemplate( $this->_tplIdx );
      // 10 mm от низа стр
      $this->SetY( -10 );
      $this->SetFont( "dejavusans", "N", 9 );
      $this->Write( 10, 'Документ предоставлен компанией "Русавтоматика". WWW.RUSAVTOMATIKA.COM', 'https://www.rusavtomatika.com/?utm=drivers', false, 'C', true );
      //$this->Cell( 0, 15, $ralink, 0, false, 'C', 0, '', 0, false, 'T', 'M' );
      $style3 = array( 'width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array( 0, 173, 97 ) );
      $this->Line( 0, 285, 210, 285, $style3 );
    }
  }

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
      if ( $file != '/drivers/' )ftp_rmdir( $conn, $file );
    } else {
      ftp_delete( $conn, $file );
    }
  }


  ///////////////////////////////////////////////
  echo "<h1>Берём массив брендов</h1>";

  $start = microtime( true );
  $drivers_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers/';
  file_put_contents( $drivers_folder . "error_log", "" );
  $drv_filename = $drivers_folder . 'drv.txt';
  $drv_result = $drivers_folder . 'drv_result.txt';
  $com_filename = $drivers_folder . 'companies.txt';
  $com_raw_filename = $drivers_folder . 'companies_raw.txt';
  $final_json = $drivers_folder . 'drv_ftp_result.txt';
  $com_url = 'https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Com';
  $coms = file_get_contents( $com_url );
  $coms = json_decode( $coms, JSON_NUMERIC_CHECK );
  foreach ( $coms as $key => $item ) {
    $item_br = $coms[ $key ][ 'Com' ];
    $comps[ $key ][ 'brand' ] = $item_br;
    $item_b2g = str_replace( [ ' ', '&' ], [ '+', '%26' ], $item_br );
    $comps[ $key ][ 'brand4get' ] = $item_b2g;
    $item_owbr = preg_replace( '/[^a-zA-Z\d]/ui', '', $item_b2g );
    $comps[ $key ][ 'onewordbrand' ] = strtolower( $item_owbr );
    $drvs_url = 'https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Mod&selVel=' . $item_b2g;
    $drvs = json_decode( file_get_contents( $drvs_url ), true );
    if ( count( $drvs ) == 0 ) {
      unset( $comps[ $key ] );
    };
  }
  $comps = array_values( $comps );
  file_put_contents( $com_filename, json_encode( $comps ) );
  echo "В массиве " . count( $comps ) . "<hr>";
  echo "<h1>Берём массив драйверов</h1>";
  $drv_json = array();
  $json_name = array();
  $i = 0;

  foreach ( $comps as $com ) {
    $com_drv = $comps[ $i ][ 'brand' ];
    $com_drv4get = $comps[ $i ][ 'brand4get' ];
    $com_onewordbrand = $comps[ $i ][ 'onewordbrand' ];
    $com_drv_url = 'https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Mod&selVel=' . $com_drv4get;
    $json_name = json_decode( file_get_contents( $com_drv_url ), true );
    foreach ( $json_name as $key => $item ) {
      $drv_url = $json_name[ $key ][ 'fnUrl' ];
      if ( UR_exists( $drv_url ) ) {
        $json_name[ $key ][ 'brand' ] = $com_drv;
        $json_name[ $key ][ 'brand4get' ] = $com_drv4get;
        $json_name[ $key ][ 'onewordbrand' ] = $com_onewordbrand;
        $item_mod = $json_name[ $key ][ 'Model' ];
        $item_mod = preg_replace( '/(?<=,)(?! )/', ' ', $item_mod );
        $json_name[ $key ][ 'Model' ] = $item_mod;
      } else {
        unset( $json_name[ $key ] );
      }
    }
    $i++;
    if ( ( is_array( $json_name ) ) && ( count( $json_name ) > 0 ) ) {
      $drv_json = array_merge( $drv_json, $json_name );
    }
  }
  file_put_contents( $drv_result, json_encode( $drv_json ) );
//  $drv_json = json_decode( file_get_contents( $drv_result ), true );

  unset( $comps );
  if ( count( $drv_json ) < 200 ) {
    echo "Подозрительно мало драйверов";
    mail( "maxbelousov@ya.ru", "Копирование драйверов", "Подозрительно мало драйверов. Требуется проверка", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $time_tags_secs = microtime( true ) - $start;
    echo "В массиве " . count( $drv_json ) . " файлов<br>Получение массива драйверов заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  }
  echo "<h1>Добавляем колонтитул и заливаем на FTP</h1>";

  // проверяем доступность донора
  $homepage = file_get_contents( 'https://dl.weintek.com/' );
  $doc = new DOMDocument;
  $doc->loadHTML( $homepage );
  $titles = $doc->getElementsByTagName( 'h1' );
  $uptime = $titles->item( 0 )->nodeValue;
  if ( $uptime != "Hello, world" ) {
    echo "dl.weintek.com лежит";
    mail( "maxbelousov@ya.ru", "Копирование драйверов", "dl.weintek.com лежит", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $start = microtime( true );
    $drv_work = array();
    $drv_final = array();
    $ftp_folder = '/drivers/';
    $ftp_server = '82.202.162.16';
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
        ftp_chdir( $conn_id, '/' );
        // перед копированием новых удаляем старые
        clean( $conn_id, $ftp_folder );
        unset( $files );
      }
    }
    $idrv = 1;
    // Проходимся по всем элементам массива
    foreach ( $drv_json as $key => $url ) {
      // Если это не пустая строка
      if ( !empty( $url ) ) {
        // Получаем имя файла
        $src_file = $url[ 'fnUrl' ];
        $arr = explode( '/', $src_file );
        $src_filename = $arr[ ( count( $arr ) - 1 ) ];
        $tmp_file = $drivers_folder . $src_filename;
        copy( $src_file, $tmp_file );
        // начало процедуры вставки колонтитула в PDF
        $pdf = new MYPDF();
        $pdf->setFontSubsetting( true );
        try {
          $pdf->numPages = $pdf->setSourceFile( $tmp_file );
          if ( $pdf->numPages > 1 ) {
            for ( $i = 1; $i <= $pdf->numPages; $i++ ) {
              $pdf->endPage();
              $pdf->_tplIdx = $pdf->importPage( $i );
              $pdf->AddPage();
            }
          }

          // выводим как строку (имя игнорируется)
          $pdfdump = $pdf->Output( 'pdfdump.pdf', 'S' );
          file_put_contents( $tmp_file, $pdfdump );
        } catch ( Exception $e ) {
          unlink( $tmp_file );
          unset( $pdf, $pdfdump );
          continue;
        }
        // конец процедуры вставки колонтитула в PDF

        // собираем инфу о файле
        $size = round( ( filesize( $tmp_file ) / 1024 ), 0 );
        $curl = curl_init( $url[ 'fnUrl' ] );
        curl_setopt( $curl, CURLOPT_NOBODY, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_FILETIME, true );
        $result = curl_exec( $curl );
        $valid = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
        // бывает так, что дату определить невозможно
        if ( $valid != 404 ) {
          if ( $result === false ) {
            $file_data = "N/A";
          }
          $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
          if ( $timestamp != -1 ) {
            $file_data = date( "d.m.Y", $timestamp ); //etc
          } else {
            $file_data = "N/A";
          }
          curl_close( $curl );
          if ( ftp_put( $conn_id, $ftp_folder . $src_filename, $tmp_file, FTP_BINARY ) ) {
            $com_drv = $url[ 'brand' ];
            $drv_work[ $key ][ 'Model' ] = $url[ 'Model' ];
            $drv_work[ $key ][ 'Driver' ] = $url[ 'Driver' ];
            $drv_work[ $key ][ 'fnUrl' ] = $url[ 'fnUrl' ];
            $drv_work[ $key ][ 'fn' ] = $url[ 'fn' ];
            $drv_work[ $key ][ 'brand' ] = $url[ 'brand' ];
            $drv_work[ $key ][ 'brand4get' ] = $url[ 'brand4get' ];
            $drv_work[ $key ][ 'onewordbrand' ] = $url[ 'onewordbrand' ];
            $drv_work[ $key ][ 'size' ] = $size;
            $drv_work[ $key ][ 'fdata' ] = $file_data;
            unlink( $tmp_file );
          }
        } else {
          echo " <span style='color:red;'>ОШИБКА</span>: " . $src_filename . ":\tОтвет сервера: " . $valid . "<br>"; // некоторые драйвера имеют битые ссылки. Их мы убираем вообще
        }
      }
      $idrv++;
    }
    $drv_final = json_encode( array_values( $drv_work ) );
    file_put_contents( $final_json, $drv_final );
    unset( $drv_final );
    if ( count( $drv_json ) < 100 ) {
      echo "Подозрительно мало драйверов";
      mail( "maxbelousov@ya.ru", "Копирование драйверов", "Подозрительно мало драйверов в финальном массиве. Требуется проверка", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      $time_elapsed_secs = microtime( true ) - $start;
      echo "<br>Копирование драйверов (" . count( $drv_json ) . ") на наш FTP заняло " . date( 'i мин s сек', $time_elapsed_secs ) . "<hr>Общее время работы: " . date( 'i мин s сек', ( $time_tags_secs + $time_elapsed_secs ) ) . "<br><br><a href=\"https://www.rusavtomatika.com/weintek_drivers/\" target=\"_new\">Перейти в раздел Драйверы</a>";
    }
  }
}
?>
