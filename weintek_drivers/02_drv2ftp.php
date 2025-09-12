<h2>Заливка драйверов на наш сервер: <? echo (date("H:i:s")); ?></h2>
<?
// это для работы с PDF
require_once( 'tcpdf/tcpdf.php' );
require_once( 'tcpdf/tcpdi.php' );
require_once( 'fpdf/fpdi.php' );

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
// проверяем доступность донора
$homepage = file_get_contents( 'https://dl.weintek.com/' );
$doc = new DOMDocument;
$doc->loadHTML( $homepage );
$titles = $doc->getElementsByTagName( 'body' );
$uptime = $titles->item( 0 )->nodeValue;
if ( $uptime != "Welcome to dl.weintek.com." ) {
  echo "dl.weintek.com лежит";
  mail( "maxbelousov@ya.ru", "Копирование драйверов", "dl.weintek.com лежит", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
  exit();
} else {
  $start = microtime( true );
  $final_json = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek_drivers__/drv_ftp_result.txt';
  $drv_result = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek_drivers__/drv_result.txt';
  $drv_work = array();
  $drv_final = array();
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
      // перед копированием новых удаляем старые
      if ( !in_array( $ftp_folder, ftp_nlist( $conn_id, '.' ) ) ) {
        ftp_mkdir($conn_id,$ftp_folder);
      }
        ftp_chdir( $conn_id, $ftp_folder );
        $files = ftp_nlist( $conn_id, "." );
        //      print_r( $files );
        //echo(count( $files )." файлов<br>");
        $ifile = 0;
        foreach ( $files as $file ) {
          if ( $ifile++ < 3 ) { // убираем из массива . и ..
            continue;
          } else {
            ftp_delete( $conn_id, $file );
          }
        }
    }
  }
  $drv = file_get_contents( $drv_result );
  $json_array = json_decode( $drv, true );
  $idrv = 1;
  // Проходимся по всем элементам массива
  foreach ( $json_array as $key => $url ) {
    // Если это не пустая строка
    if ( !empty( $url ) ) {
      $fullPath = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek_drivers__/';
      // Получаем имя файла
      $src_file = $url[ 'fnUrl' ];
      $arr = explode( '/', $src_file );
      $src_filename = $arr[ ( count( $arr ) - 1 ) ];
      $tmp_file = $fullPath . $src_filename;
      copy( $src_file, $tmp_file );
      //echo $src_filename . "<br>";
      //              echo $final_json."<br>";
      //              echo $drv_result."<br>";
      //              exit();
      // начало процедуры вставки колонтитула в PDF
      $pdf = new MYPDF();
      $pdf->setFontSubsetting( true );
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
      // конец процедуры вставки колонтитула в PDF

      // собираем инфу о файле
      $size = round( ( filesize( $tmp_file ) / 1024 ), 0 );
      $curl = curl_init( $url[ 'fnUrl' ] );
      curl_setopt( $curl, CURLOPT_NOBODY, true );
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $curl, CURLOPT_FILETIME, true );
      $result = curl_exec( $curl );
      $valid = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
      //echo gettype($valid);
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
  //                      echo "<pre>";
  //                      var_dump( $json_array );
  //                      echo "</pre>";
  $drv_final = json_encode( array_values( $drv_work ) );
  //echo("<pre>".$json_array."</pre>");
  file_put_contents( $final_json, $drv_final );
  if ( count( $drv_json ) < 300 ) {
    echo "Подозрительно мало драйверов";
    mail( "maxbelousov@ya.ru", "Копирование драйверов", "Подозрительно мало драйверов в финальном массиве. Требуется проверка", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $time_elapsed_secs = round( ( ( microtime( true ) - $start ) / 60 ), 2 );
    echo "<br>Копирование драйверов на наш FTP заняло " . $time_elapsed_secs . " мин<hr>Общее время работы: " . ( $time_tags_secs + $time_elapsed_secs ) . "<br><br><a href=\"https://www.rusavtomatika.com/weintek_drivers__/\" target=\"_new\">Перейти в раздел</a>";
  }
  //echo "Файлы скачаны";
}
?>
</body></html>