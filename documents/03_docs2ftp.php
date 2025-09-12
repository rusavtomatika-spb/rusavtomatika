<h2>Заливка документов на наш сервер: <? echo (date("H:i:s")); ?></h2>
<?
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
$start_upload = microtime( true );
file_put_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . "/documents__/error_log", "" );
ini_set( "memory_limit", "512M" );
ini_set( 'max_execution_time', 500 );

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
    if ( $file != '/documents_ra/' )ftp_rmdir( $conn, $file );
  } else {
    ftp_delete( $conn, $file );
  }
}

function ftp_putAll( $conn_id, $src_dir, $dst_dir ) {
  $d = dir( $src_dir );
  while ( $file = $d->read() ) {
    if ( $file != "." && $file != ".." ) {
      if ( is_dir( $src_dir . "/" . $file ) ) {
        if ( !@ftp_chdir( $conn_id, $dst_dir . "/" . $file ) ) {
          ftp_mkdir( $conn_id, $dst_dir . "/" . $file );
        }
        ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . "/" . $file );
      } else {
        $upload = ftp_put( $conn_id, $dst_dir . "/" . $file, $src_dir . "/" . $file, FTP_BINARY );
      }
    }
  }
  $d->close();
}

function scan_folder( $source_dir, & $result ) {
  if ( is_dir( $source_dir ) ) {
    foreach ( glob( $source_dir . '/*' ) as $file ) {
      if ( is_dir( $file ) ) {
        scan_folder( $file, $result );
      } else {
        //                $path = $source_dir . '/' . $file;
        $path = $file;
        $name = basename( $file );
        array_push( $result, array( 'path' => $path, 'name' => $name ) );
      }
    }
  }
}

// это для работы с PDF
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
    $this->Write( 10, 'Документ предоставлен компанией "Русавтоматика". WWW.RUSAVTOMATIKA.COM', 'https://www.rusavtomatika.com/?utm=documents', false, 'C', true );
    //$this->Cell( 0, 15, $ralink, 0, false, 'C', 0, '', 0, false, 'T', 'M' );
    $style3 = array( 'width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array( 0, 173, 97 ) );
    $this->Line( 0, 285, 210, 285, $style3 );
  }
}


// проверяем доступность донора
$homepage = file_get_contents( 'https://dl.weintek.com/' );
$doc = new DOMDocument;
$doc->loadHTML( $homepage );
$titles = $doc->getElementsByTagName( 'body' );
$uptime = $titles->item( 0 )->nodeValue;
if ( $uptime != "Welcome to dl.weintek.com." ) {
  echo "dl.weintek.com лежит";
  mail( "maxbelousov@ya.ru", "Копирование документов", "dl.weintek.com лежит", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
  exit();
} else {
  $start = microtime( true );
  $final_json = $_SERVER[ 'DOCUMENT_ROOT' ] . 'documents__/all_downloaded_docs.txt';
  $drv_result = $_SERVER[ 'DOCUMENT_ROOT' ] . 'documents__/all_uploaded_docs.txt';
  $tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . 'documents__/tmp_bufer';
  $drv_work = array();
  $drv_final = array();
  $ftp_folder = '/documents_ra/';
  $ftp_server = '51.254.18.36';
  $ftp_user_name = 'upload_olga@weblector.ru';
  $ftp_user_pass = 'olgaglr';

  $result = array();
  scan_folder( $tmp_bufer, $result );

  $idrv = 0;
  $skip = 0;

  foreach ( $result as $key => $url ) {
    // Если это не пустая строка
    if ( !empty( $url ) ) {
      $fullPath = $_SERVER[ 'DOCUMENT_ROOT' ] . 'documents__/';
      // Получаем имя файла
      $src_file = $url[ 'path' ];
      $src_filename = $url[ 'name' ];
      $tmp_file = $fullPath . $src_filename;
      copy( $src_file, $tmp_file );
      $pdf = new MYPDF();
      try {
        $pdf->numPages = $pdf->setSourceFile( $tmp_file );
        for ( $i = 1; $i <= $pdf->numPages; $i++ ) {
          $pdf->endPage();
          $pdf->_tplIdx = $pdf->importPage( $i );
          $pdf->AddPage();
        }
        $pdfdump = $pdf->Output( 'pdfdump.pdf', 'S' );
        copy( $src_file, $src_file . '.src' );
        unlink( $src_file );
        if ( file_put_contents( $src_file, $pdfdump ) ) {
          unlink( $src_file . '.src' );
          unlink( $tmp_file );
          unset( $pdf, $pdfdump );
          // конец процедуры вставки колонтитула в PDF
        }
        $idrv++;
      } catch ( Exception $e ) {
        unlink( $tmp_file );
        unset( $pdf, $pdfdump );
        $skip++;
        continue;
      }
      // выводим как строку (имя игнорируется)
    }
  }
  $conn_id = ftp_connect( $ftp_server );
  // проверяем доступность нашего FTP
  if ( false === $conn_id ) {
    echo "Невозможно соединиться с FTP-сервером";
    mail( "maxbelousov@ya.ru", "Копирование документов", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
    //    Проверяем авторизацию
    if ( false === $login_result ) {
      echo "Ошибка авторизации на FTP";
      mail( "maxbelousov@ya.ru", "Копирование документов", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      ftp_pasv( $conn_id, true );
      ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 10000 );
      //        перед копированием новых удаляем старые
      clean( $conn_id, $ftp_folder );
      echo "Целевая папка была успешно очищена.<br>";
      ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
      deleteFolder( $tmp_bufer );
      echo "Файлы скопированы на FTP с картинками";
      ftp_close( $conn_id );
    }
  }
}
$total = $idrv + $skip;
$time_upload_secs = round( ( ( microtime( true ) - $start_upload ) / 60 ), 2 );
echo "<br>Upload документов занял " . $time_upload_secs . " мин<br>";
echo $idrv . " файлов обработано<br>" . $skip . " пропущено<br>" . $total . " файлов всего<br><hr>";
?>