<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update docs</title>
</head>

<body>
<h1 style="color: red;">Обновление раздела ДОКУМЕНТЫ v 2.0</h1>
<p><? echo (date("H:i:s")); ?></p>
<br>
<br>
<form id="frm" method="post"  action="?take" >
  <input type="submit" value="Получить список документов" id="submit" />
</form>
<br>
<br>
<form id="frm" method="post"  action="?download" >
  <input type="submit" value="Скачать документы в буфер" id="submit" />
</form>
<br>
<br>
<form id="frm" method="post"  action="?upload" >
  <input type="submit" value="Загрузить документы из буфера на Карт.ФТП" id="submit" />
</form>
<?php
ini_set( 'max_execution_time', 982500 );
//ini_set( "memory_limit", "512M" );
//ini_set( "error_reporting", E_ALL & ~E_NOTICE );
ini_set( "error_reporting", E_ALL );
ini_set( "display_errors", 1 );
ini_set( "display_startup_errors", 1 );
global $docs_folder, $cat_folder, $manual_en_folder, $filename, $docs_wt_result, $wt_files_result, $ra_filename, $docs_result, $all_downloaded_docs_filename, $tmp_bufer, $chap_bufer, $chap_files, $old_weintek, $ftp_folder, $ftp_chap_folder;

$docs_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/';
	//echo $docs_folder;
$cat_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/catalog/';
$manual_en_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek-easybuilderpro-user-manual-en/';

file_put_contents( $docs_folder . "error_log", "" );
$filename = $docs_folder . 'availableTags.txt';
$docs_wt_result = $docs_folder . 'docs_wt_result.txt';
$wt_files_result = $cat_folder . 'wt_files_result.txt';
$ra_filename = $docs_folder . 'ra-docs.txt';
$docs_result = $docs_folder . 'docs_result.txt';
$docs_lresult = 'docs_result.txt';
$all_downloaded_docs_filename = $docs_folder . 'all_downloaded_docs.txt';
//$drv_result = $docs_folder . 'all_uploaded_docs.txt';
$tmp_bufer = $docs_folder . 'tmp_bufer/';
$chap_bufer = $docs_folder . 'chap_bufer/';
$chap_files = $docs_folder . 'chap_files/';
$old_weintek = $docs_folder . 'old_weintek/';
$ftp_chap_folder = '/manuals/weintek/UserManual_separate_chapter';
$ftp_folder = '/documents/weintek';

function my_curl( $url, $timeout = 100, $error_report = true ) {
  $curl = curl_init();

  // HEADERS FROM FIREFOX - APPEARS TO BE A BROWSER REFERRED BY GOOGLE
  $header[] = "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.

  // SET THE CURL OPTIONS - SEE http://php.net/manual/en/function.curl-setopt.php
  curl_setopt( $curl, CURLOPT_URL, $url );
  curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6' );
  curl_setopt( $curl, CURLOPT_HTTPHEADER, $header );
  curl_setopt( $curl, CURLOPT_REFERER, 'http://www.google.com' );
  curl_setopt( $curl, CURLOPT_ENCODING, 'gzip,deflate' );
  curl_setopt( $curl, CURLOPT_AUTOREFERER, TRUE );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
  curl_setopt( $curl, CURLOPT_TIMEOUT, $timeout );

  // RUN THE CURL REQUEST AND GET THE RESULTS
  $htm = curl_exec( $curl );
  $err = curl_errno( $curl );
  $inf = curl_getinfo( $curl );
  curl_close( $curl );

  // ON FAILURE
  if ( !$htm ) {
    // PROCESS ERRORS HERE
    if ( $error_report ) {
      echo "CURL FAIL: $url TIMEOUT=$timeout, CURL_ERRNO=$err";
      var_dump( $inf );
    }
    return FALSE;
  }

  // ON SUCCESS
  return $htm;
}

function debug_to_console( $data ) {
  $output = $data;
  if ( is_array( $output ) )
    $output = implode( ',', $output );

  echo "<script>console.log('" . $output . "' );</script>";
}

function saveFiles( $docs, $destination ) {
  global $documents, $docs_folder, $tmp_bufer, $chap_bufer, $ifs;
  $idoc = $ifs = $ifc = 0;
  //$docs_result = $docs_folder . "/documents/ra/docs_wt_result.txt";
  //                            echo "<pre>";
  //                            var_dump( $documents );
  //                            echo "</pre>";
  foreach ( $docs as $key => $doc ) {
    $idoc++;
    $filename = $doc[ 'fname' ];
    if ( strpos( " ", $filename ) !== false ) {
      $filename = str_replace( " ", "_", $doc[ 'fname' ] );
      $documents[ $ifs ][ 'fname' ] = $filename;
    }
    $src_path = $doc[ 'put' ];
    $section = $doc[ 'section' ];
    $cur_path = $tmp_bufer;
    $url_cat_dest = $docs_folder . $src_path;
    $dest_path2file = $tmp_bufer . $src_path . '/' . $filename;
    $dest_path2chap = $chap_bufer . $filename;
    $src_url = $doc[ 'url' ];
    if ( strpos( " ", $src_url ) !== false ) {
      $src_url = str_replace( " ", "%20", $src_url );
      if ( UR_exists( $src_url ) === false ) {
        //                    echo $ifc . ") " . $src_url . " удалён как [404].<br>";
        //                    unset( $documents[ $ifs ] );
        //                    continue;
      }
      $documents[ $ifs ][ 'url' ] = $src_url;
    }
    if ( is_dir( $url_cat_dest ) === false ) {
      $arr_folders = explode( "/", $src_path );
      make_path( $arr_folders, $tmp_bufer );
      if ( UR_exists( $src_url ) !== false ) {
        file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
        debug_to_console( "DOWN: " . $dest_path2file . " SECTION: " . $section );
        $ifc++;
        if ( $section == "chap" ) {
          if ( UR_exists( $src_url ) !== false ) {
            file_put_contents( $dest_path2chap, file_get_contents( $src_url ) );
            debug_to_console( "DOWN: " . $dest_path2chap . " SECTION: " . $section );
          }
        }
      }
    } else {
      if ( UR_exists( $src_url ) !== false ) {
        file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
        debug_to_console( "dest_path2file(2): " . $dest_path2file . " Section: " . $section );
        $ifc++;
      }

    }
  }
}

function make_path( $arr_path, $cur_path ) {
  $array = $arr_path;
  for ( $i = 0; $i < count( $array ); $i++ ) {
    if ( is_dir( @$cur_path . $array[ $i ] ) === false ) {
      mkdir( $tmp_bufer . @$cur_path . $array[ $i ], 0755, true );
    }
    @$cur_path .= $array[ $i ] . "/";
  }
}

function rscan( $dir ) {
  global $ifs;
  $all = array_diff( scandir( $dir ), [ ".", ".." ] );
  $eol = PHP_EOL;
  if ( $all ) {
    foreach ( $all as $ff ) {
      if ( is_file( $dir . $ff ) ) {
        echo "{$ff}<br>";
        $ifs++;
      }
      if ( is_dir( $dir . $ff ) ) {
        echo "<b>[{$ff}]</b><br>";
        rscan( "$dir$ff/" );
      }
    }
  }
}

function UR_exists( $url ) {
  $headers = get_headers( $url );
  return stripos( $headers[ 0 ], "200 OK" ) ? true : false;
}

function deleteFolder( $folderPath ) {
  global $tmp_bufer;
  global $chap_bufer;
  if ( is_dir( $folderPath ) ) {
    $files = scandir( $folderPath );
    foreach ( $files as $file ) {
      if ( $file != "." && $file != ".." ) {
        if ( is_dir( $folderPath . '/' . $file ) ) {
          deleteFolder( $folderPath . '/' . $file );
          debug_to_console( "DEL: " . $folderPath . '/' . $file );
        } else {
          unlink( $folderPath . '/' . $file );
          debug_to_console( "DEL: " . $folderPath . '/' . $file );
        }
      }
    }
    //            if ( ( $folderPath != $tmp_bufer ) & ( $folderPath != $chap_bufer ) & ( $folderPath != $tmp_bufer . 'images/' ) ) {
    //    if ( ( $folderPath != $tmp_bufer ) & ( $folderPath != $chap_bufer ) ) {
    rmdir( $folderPath );
    debug_to_console( "DEL: " . $folderPath );
    //    }
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
    if ( ( $file != '/documents/' ) & ( $file != '/documents/' ) & ( $file != '/documents/weintek/' ) & ( $file != '/manuals/weintek/UserManual_separate_chapter/' ) ) {
      ftp_rmdir( $conn, $file );
    }
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
          debug_to_console( "КАТАЛОГ: " . $dst_dir . "/" . $file );
        }
        ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . "/" . $file );
      } else {
        $upload = ftp_put( $conn_id, $dst_dir . "/" . $file, $src_dir . "/" . $file, FTP_BINARY );
        debug_to_console( "UP: " . $dst_dir . "/" . $file );
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
        $ext = pathinfo( $file, PATHINFO_EXTENSION );
        array_push( $result, array( 'path' => $path, 'name' => $name, 'ext' => $ext ) );
      }
    }
  }
}

if ( isset( $_GET[ 'take' ] ) ) {
  if ( is_dir( $tmp_bufer ) === false ) {
    mkdir( $tmp_bufer, 0755, true );
    debug_to_console( "Создан каталог: " . $tmp_bufer );
  }
  if ( is_dir( $chap_bufer ) === false ) {
    mkdir( $chap_bufer, 0755, true );
    debug_to_console( "Создан каталог: " . $chap_bufer );
  }
  if ( is_dir( $chap_files ) === false ) {
    mkdir( $chap_files, 0755, true );
    debug_to_console( "Создан каталог: " . $chap_files );
  }
  /////////////////// Функции и классы ///////////////////////////////	


  // это для работы с PDF
  //  require_once( 'tcpdf/tcpdf.php' );
  //  require_once( 'tcpdf/tcpdi.php' );
  //  require_once( 'fpdf/fpdi.php' );
  // класс для добавления колонтитула в PDF
  //  class MYPDF extends FPDI {
  //    //шапка
  //    public function Header() {}
  //    //подвал
  //    public function Footer() {
  //      global $tmp_file;
  //      if ( is_null( $this->_tplIdx ) ) {
  //        // берём кол-во страниц в исходнике
  //        $this->numPages = $this->setSourceFile( $tmp_file );
  //        $this->_tplIdx = $this->importPage( 1 );
  //      }
  //      $this->useTemplate( $this->_tplIdx );
  //      // 10 mm от низа стр
  //      $this->SetY( -10 );
  //      $this->SetFont( "dejavusans", "N", 9 );
  //      $this->Write( 10, 'Документ предоставлен компанией "Русавтоматика". WWW.RUSAVTOMATIKA.COM', 'https://www.rusavtomatika.com/?utm=documents', false, 'C', true );
  //      //$this->Cell( 0, 15, $ralink, 0, false, 'C', 0, '', 0, false, 'T', 'M' );
  //      $style3 = array( 'width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array( 0, 173, 97 ) );
  //      $this->Line( 0, 285, 210, 285, $style3 );
  //    }
  //  }
  ////////////////////////////////////////////////////////////////
  $start = microtime( true );
  echo "<h1>Обновление раздела Документы</h1>";
  // путь на проде: /home/weblec/public_html/rusavtomatika.com
  $chapters = '<ul class="weintek-easybuilderpro-user-manual-en__menu">';
  $metatags = 'if ($current_url == \'\')
$current_url = \'Chapter_01_EasyBuilder_Pro_Installation_and_Startup_Guide\';
$TITLE_second_part = \'Скачать Weintek EBPro EasyBuilder Pro V6 руководство пользователя, мануал manual, инструкция, на английском \';
$H1_first_part = \'\';
$KEYWORDS = \'easybuilder pro, easybuilder pro скачать, easybuilder pro руководство, Weintek\';
$CANONICAL = \'https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/Chapter_01_EBPro_Installation_and_Startup_Guide/\';
$DESCRIPTION = \'EasyBuilder Pro — среда разработки проектов для панелей оператора Weintek. Использование ПО EasyBuilder Pro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.\';
$change_title_and_h1_on_page = true;
switch ($current_url) { ';
  $theUrl = 'https://www.weintek.com/globalw/Download/Download.aspx';
  //$src = file_get_contents( $theUrl );
  $src = my_curl( $theUrl );
  //if (!$htm) die("NO $url");
  echo "<pre>";
  echo htmlentities( $htm );
  echo "Массив всех доступных ссылок с сайта WEINTEK.COM получен</br>";
  // Парсинг HTML-страницы
  $dom = new DOMDocument();
  @$dom->loadHTML( $src );

  // Получение всех ссылок
  $links = $dom->getElementsByTagName( 'a' );

  // Массив для хранения ссылок
  $uploadLinks = [];

  foreach ( $links as $link ) {
    // Проверка наличия текста 'upload' в href
    if ( strpos( $link->getAttribute( 'href' ), 'FCK_Upload' ) !== false ) {
      $lhref = $link->getAttribute( 'href' );
      $lfile = explode( '/', $lhref );
      $lfnameext = array_pop( $lfile );
      $lfname = explode( '.', $lfnameext );
      $lfname = $lfname[ 0 ];
      $model = array();
      $model[ 'title' ] = $lfname . " 3D Model";
      $model[ 'label' ] = $lfname . " 3D Model";
      $model[ 'category' ] = "3D Model";
      $model[ 'url' ] = "https://www.weintek.com/globalw/FCK_Upload/Dimensions/" . $lfnameext;
      $uploadLinks[] = $model;
      //		array_push($uploadLinks,$lfname,$lhref);
    }
  }
  $marker_b = stripos( $src, "var availableTags" );
  if ( $marker_b )
    $src = substr( $src, $marker_b + 20 );
  $marker_e = stripos( $src, "autoComplateWord" );
  if ( $marker_e )
    $src = substr( $src, 0, $marker_e - 3 );
  $tags_json = $src . ']';
  $inval = array( "title", "label", "category", "url" );
  $val = array( "\"title\"", "\"label\"", "\"category\"", "\"url\"" );
  $tags = str_replace( $inval, $val, $tags_json );
  echo "Массив с сайта WEINTEK.COM обработан</br>";
  file_put_contents( $filename, $tags );
  //exit();
  //$headers = get_headers( $url, 1 );
  //$tags_json = file_get_contents( $filename );
  $alltags = json_decode( $tags, true );
  $alltags = array_merge( $alltags, $uploadLinks );
  echo "<br>В массиве alltags " . count( $alltags );
  unset( $tags, $src );
  $total_alltags = count( $alltags );
  ////////////////////////////////
  global $bad_words, $bad_urls, $good_urls, $good_cat, $bad_cat;
  $bad_words = "/(Chinese|japanese|HMI\sPin\sAssignment|RoHS|Connection\sGuide|Conformity)/i"; //стоп-слова в названии
  $bad_urls = "/(cht|jap|jpn|_jpn|_cht|_tw|_jp|MT500|.htm|Certificate)/i"; //стоп-слова в URL
  $bad_labels = "/(Certificate)/i"; //стоп-слова в URL
  $good_urls = "/(EBPro|EasyAccess20|cMT|MT8000iP|MT8000iE|mTV|eMT3000|iR|FAQ|Drawing)/i"; //гуд-слова в URL
  $good_cat = "/(Document|2D\sCAD|3D\sModel)/i"; //гуд-слова в URL
  $files = array();
  foreach ( $alltags as $catalog ) {
    if ( ( !preg_match( $bad_words, $catalog[ 'title' ] ) ) && ( !preg_match( $bad_urls, $catalog[ 'url' ] ) ) && ( preg_match( $good_cat, $catalog[ 'category' ] ) ) && ( !preg_match( $bad_labels, $catalog[ 'label' ] ) ) ) {
      //    if ( ( !preg_match( $bad_words, $catalog[ 'title' ] ) )) {
      $title = str_replace( "_", " ", $catalog[ 'title' ] );
      //		  echo $title."<br>";
      $item = array();
      $cate = $catalog[ 'category' ];
      $url = $catalog[ 'url' ];
      $title = $catalog[ 'title' ];
      $info = pathinfo( $url );
      $put = $info[ 'dirname' ];
      $dtype = '';
      $descr = '';
      $sort = '2000';
      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put );
      $param = $put;
      if ( preg_match( '/FCK_Upload/', $url ) )$put = 'Drawing';
      if ( preg_match( '/Datasheet/i', $param ) ) {
        $dtype = 'Datasheet';
        $sort = '100';
      }
      if ( preg_match( '/Installation/i', $param ) ) {
        $dtype = 'Installation';
        $sort = '200';
      }
      if ( preg_match( '/Brochure/i', $param ) ) {
        $dtype = 'Brochure';
        $sort = '600';
      }
      if ( preg_match( '/UserManual/i', $param ) ) {
        $dtype = 'UserManual';
        $sort = '300';
      }
      if ( preg_match( '/Appendix/i', $url ) ) {
        $dtype = 'UserManual';
        $sort = '370';
      }
      if ( preg_match( '/Utility/i', $param ) ) {
        $dtype = 'Utility';
        $sort = '700';
      }
      if ( preg_match( '/Drawing/i', $param ) ) {
        $dtype = 'Drawing';
        $sort = '500';
      }
      if ( preg_match( '/Part_Sample/i', $param ) ) {
        $dtype = 'Part_Sample';
        $sort = '1000';
      }
      if ( preg_match( '/PLC_Sample/i', $param ) ) {
        $dtype = 'PLC_Sample';
        $sort = '1100';
      }
      if ( preg_match( '/Macro_Sample/i', $param ) ) {
        $dtype = 'Macro_Sample';
        $sort = '1200';
      }
      if ( preg_match( '/System_Sample/i', $param ) ) {
        $dtype = 'System_Sample';
        $sort = '1300';
      }
      if ( preg_match( '/Demo/i', $param ) ) {
        $dtype = 'Demo';
        $sort = '900';
      }
      if ( preg_match( '/Library/i', $param ) ) {
        $dtype = 'Library';
        $sort = '1400';
      }
      if ( preg_match( '/SDK/i', $param ) ) {
        $dtype = 'SDK';
        $sort = '710';
      }
      if ( preg_match( '/API/i', $param ) ) {
        $dtype = 'API';
        $sort = '720';
      }
      if ( preg_match( '/3D Model/i', $cate ) ) {
        $dtype = '3D_model';
        $sort = '400';
      }
      if ( preg_match( '/2D Cad/i', $cate ) ) {
        $dtype = '2D_CAD';
        $sort = '500';
      }
      if ( preg_match( '/EasyBuilder Pro User Manual/i', $title ) ) {
        $dtype = 'ebpro';
        $sort = '1500';
      }

      $fname = $info[ 'basename' ];
      $fname = preg_replace( '/\s/', '_', $fname );
      $fjname = $info[ 'filename' ];
      $label = $catalog[ 'label' ];
      $url = preg_replace( '/\s/', '%20', $url );
      $curl = curl_init( $url );
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      if ( curl_getinfo( $curl, CURLOPT_RETURNTRANSFER ) == 404 ) {
        //		  echo $title." не могу достучаться<br>";
        continue;
      }
      //Отказываемся от самой стр. Нам только заголовки
      curl_setopt( $curl, CURLOPT_NOBODY, true );
      //стопим вывод данных в stdout
      //получаем дату крайней модификации файла
      curl_setopt( $curl, CURLOPT_FILETIME, true );
      //curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec( $curl );

      if ( is_array( explode( '.', $fname ) ) ) {
        $ctype = explode( '.', $fname );
        $contentType = end( $ctype );
      }
      $filesize = curl_getinfo( $curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD );
      $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
      if ( $timestamp != -1 ) {
        $file_data = $timestamp; //etc
      } else {
        $file_data = "";
      }
      curl_close( $curl );
      //$section = '';
      $item = array( 'title' => $title, 'brand' => '', 'data' => $file_data, 'url' => $url, 'path' => $put, 'fname' => $fname, 'model' => '', 'category' => $catalog[ 'category' ], 'section' => $section, 'size' => $filesize, 'ftype' => $contentType, 'dtype' => $dtype, 'description' => '', 'lang' => 'eng', 'label' => $label, 'sort' => $sort );
      //$item = array( 'title' => '1', 'brand' => '2' );
      array_push( $files, $item );
    }
  }
  echo "<br>В массиве files " . count( $files ) . '<br>';
  /////////////////////////
  $i = 0;
  foreach ( $files as $item ) {
    $label = '';
    $title = '';
    $label = $item[ 'label' ];
    $title = $item[ 'title' ];
    $label = preg_replace( '/data\ssheet/i', ' Datasheet', $label );
    $label = preg_replace( '/([\w\d-]{3,})\1[\s,]/i', '$1 ', $label );
    $label = preg_replace( '/([\w\d-]{3,}[^\d])\1/i', '$1', $label );
    $label = preg_replace( '/([\w\d-]{3,}[^\d])\1/i', '$1', $label );
    $label = preg_replace( '/([\w]{7,})\w{5,}\1/i', '$1', $label );
    $label = preg_replace( '/document/i', ' ', $label );
    $label = preg_replace( '/([^,\n\/\s])(cmt)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(i[er] series)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(emt[\d]+[\s]*series)/i', '$1,$2,', $label );
    $label = preg_replace( '/([^,\n\/\s])(ir-etn)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(ir-etn)\w/i', '$1,$2,', $label );
    $label = preg_replace( '/iR-ETN40R\/40P/i', 'iR-ETN40R,iR-ETN40P', $label );
    $label = preg_replace( '/([^,\n\/\s][^softwar])(emt)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\sce])(mt)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Easy)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(ManualUserManual)/i', '$1,UserManual', $label );
    $label = preg_replace( '/([^,\n\/\s])(Project\sManager)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(BACnet)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Installation)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(CODESYS)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Software)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Utility)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Recipe\sEditor)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(DataSheet)/i', '$1,$2', $label );
    $label = preg_replace( '/[^,\n\/]\s(DataSheet)/i', ',$1', $label );
    $label = preg_replace( '/([^,\n\/\s])(Wifi)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(Database)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\n\/\s])(UserManual)/i', '$1,$2', $label );
    $label = preg_replace( '/([^,\s\/])(cMT\+CODESYS)/i', ',$2', $label );
    $label = preg_replace( '/(Installation InstructionInstallation)/i', ',Installation', $label );
    $label = preg_replace( '/(Installation InstrauctionInstallation)/i', ',Installation', $label );
    $label = preg_replace( '/\s(,Installation)/i', '$1', $label );
    $label = preg_replace( '/([\w\d])(?:\s+)(Installation)/i', '$1,$2', $label );
    $label = preg_replace( '/([\w\d])(?:\s+)(DataSheet)/i', '$1,$2', $label );
    $label = preg_replace( '/([\w\d])(?:\s+)(UserManual)/i', '$1,$2', $label );
    $label = preg_replace( '/([\w\d])(?:\s+)(Brochure)/i', '$1,$2', $label );
    $label = preg_replace( '/(Installation)(?:\s+)/i', '$1,', $label );
    $label = preg_replace( '/(DataSheet)(?:\s+)/i', '$1,', $label );
    $label = preg_replace( '/(UserManual)(?:\s+)/i', '$1,', $label );
    $label = preg_replace( '/(Brochure)(?:\s+)/i', '$1,', $label );
    $label = preg_replace( '/(cMT2078|cMT2128|cMT2158|cMT2166|cMT3102),/i', '$1X,', $label );
    $label = preg_replace( '/([^,]\sManual,UserManual)/i', ',UserManual', $label );
    $label = preg_replace( '/(,Manual,UserManual)/i', ',UserManual', $label );
    $label = preg_replace( '/^(cMT1106,Datasheet)$/i', ',cMT1106X,Datasheet', $label );
    $label = preg_replace( '/(\s*),(\s*)/i', ',', $label );
    $label = preg_replace( '/([\s\w\d])(2d\scad)([\s\w\d])/i', '$1,$2,$3', $label );
    $label = preg_replace( '/([\s\w\d])(3d\smodel)([\s\w\d])/i', '$1,$2,$3', $label );
    $label = preg_replace( '/(,Instruction,Installation)/i', '', $label );
    $label = preg_replace( '/(\sUser\s)/i', ',', $label );
    $label = preg_replace( '/MT8071iER1/i', 'MT8071iER', $label );
    $label = preg_replace( '/^(N\/A)(,*)/', '', $label );
    $label = preg_replace( '/(,\s,\s)/i', ',', $label );
    $label = preg_replace( '/(,+)/i', ',', $label );
    $label = preg_replace( '/\sUse,/i', ',', $label );
    $title = preg_replace( '/(.+)(Data[\s]*sheet)(.*)/i', 'Спецификация $1$2$3', $title );
    $title = preg_replace( '/(.+)(3D[\s]*Model)(.*)/i', '3D модель $1$2$3 (SLDPRT + STEP)', $title );
    $title = preg_replace( '/(.+)(2D[\s]*cad)(.*)/i', 'Чертёж $1$2$3', $title );
    $title = preg_replace( '/(.+)([\s]Installation[\s])(.*)/i', 'Инструкция по установке $1$2$3', $title );
    $title = preg_replace( '/(.+)(Brochure)(.*)/i', 'Брошюра $1$2$3', $title );
    $title = preg_replace( '/(.+)(User[\s]*Manual)(.*)/i', 'Руководство пользователя $1$2$3', $title );
    //echo $label . "<hr>";
    if ( strpos( $title, "cMT3108XP" ) !== false ) {
      $label = 'cMT3108XP,' . $label;
    }
    if ( strpos( $title, "cMT3108XH" ) !== false ) {
      $label = 'cMT3108XH,' . $label;
    }
    $files[ $i ][ 'label' ] = $label;
    $files[ $i ][ 'title' ] = $title;
    $i++;
  }
  //echo "<br>2) В массиве files ".count($files)."<br>";
  //$files = array_unique($files);
  //file_put_contents( 'nice_docs.txt', json_encode( $files, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  file_put_contents( 'wt_files_result.txt', json_encode( $files, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  //unset( $files );
  ////////////////////////////////
  echo "Массив с сайта WEINTEK.COM записан в файл availableTags.json (" . $total_alltags . ")</br>";
  $docs_json = array();
  $chapters_arr = array();
  foreach ( $files as $catalog ) {
    if ( ( !preg_match( $bad_words, $catalog[ 'title' ] ) ) && ( preg_match( $good_cat, $catalog[ 'category' ] ) ) ) {
      $title = str_replace( "_", " ", $catalog[ 'title' ] );
      //		  echo $title."<br>";
      $item = array();
      $url = $catalog[ 'url' ];
      $info = pathinfo( $url );
      $put = $info[ 'dirname' ];
      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put );
      $param = $put;
      if ( preg_match( '/FCK_Upload/', $url ) )$put = 'Drawing';
      $fname = $info[ 'basename' ];
      $fname = preg_replace( '/\s/', '_', $fname );
      $fjname = $info[ 'filename' ];
      $url = preg_replace( '/\s/', '%20', $url );
      $description = '';
      $label = $catalog[ 'label' ];
      if ( is_array( explode( '.', $fname ) ) ) {
        $ctype = explode( '.', $fname );
        $contentType = end( $ctype );
      }
      if ( preg_match( '/Datasheet/i', $param ) ) {
        $dtype = 'Datasheet';
        $sort = '100';
      }
      if ( preg_match( '/Installation/i', $param ) ) {
        $dtype = 'Installation';
        $sort = '200';
      }
      if ( preg_match( '/Brochure/i', $param ) ) {
        $dtype = 'Brochure';
        $sort = '600';
      }
      if ( preg_match( '/UserManual/i', $param ) ) {
        $dtype = 'UserManual';
        $sort = '300';
      }
      if ( preg_match( '/Appendix/i', $url ) ) {
        $dtype = 'UserManual';
        $sort = '370';
      }
      if ( preg_match( '/Utility/i', $param ) ) {
        $dtype = 'Utility';
        $sort = '700';
      }
      if ( preg_match( '/Drawing/i', $param ) ) {
        $dtype = 'Drawing';
        $sort = '500';
      }
      if ( preg_match( '/Part_Sample/i', $param ) ) {
        $dtype = 'Part_Sample';
        $sort = '1000';
      }
      if ( preg_match( '/PLC_Sample/i', $param ) ) {
        $dtype = 'PLC_Sample';
        $sort = '1100';
      }
      if ( preg_match( '/Macro_Sample/i', $param ) ) {
        $dtype = 'Macro_Sample';
        $sort = '1200';
      }
      if ( preg_match( '/System_Sample/i', $param ) ) {
        $dtype = 'System_Sample';
        $sort = '1300';
      }
      if ( preg_match( '/Demo/i', $param ) ) {
        $dtype = 'Demo';
        $sort = '900';
      }
      if ( preg_match( '/Library/i', $param ) ) {
        $dtype = 'Library';
        $sort = '1400';
      }
      if ( preg_match( '/SDK/i', $param ) ) {
        $dtype = 'SDK';
        $sort = '710';
      }
      if ( preg_match( '/API/i', $param ) ) {
        $dtype = 'API';
        $sort = '720';
      }
      if ( preg_match( '/3D Model/i', $cate ) ) {
        $dtype = '3D_model';
        $sort = '400';
      }
      if ( preg_match( '/2D Cad/i', $cate ) ) {
        $dtype = '2D_CAD';
        $sort = '500';
      }
      if ( preg_match( '/EasyBuilder Pro User Manual/i', $title ) ) {
        $dtype = 'ebpro';
        $sort = '1500';
        $description = "Приложение EasyBuilderPro применяется для создания пользовательских проектов для операторских панелей Weintek";
      }

      $curl = curl_init( $catalog[ 'url' ] );
      //Отказываемся от самой стр. Нам только заголовки
      curl_setopt( $curl, CURLOPT_NOBODY, true );
      //стопим вывод данных в stdout
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      if ( curl_getinfo( $curl, CURLOPT_RETURNTRANSFER ) == 404 ) {
        //		  echo $title." не могу достучаться<br>";
        continue;
      }
      //получаем дату крайней модификации файла
      curl_setopt( $curl, CURLOPT_FILETIME, true );
      $result = curl_exec( $curl );
      $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
      if ( $timestamp != -1 ) {
        $file_data = $timestamp; //etc
      } else {
        $file_data = "N/A";
      }
      curl_close( $curl );
      if ( preg_match( "/,EB$|EasyBuilder/", $label ) ) {
        $section = "ebpro";
      } else if ( preg_match( "/EasyAccess/", $label ) ) {
        $section = "ea20";
      } else if ( preg_match( "/cMT/", $title ) ) {
        $section = "cmt";
      } else if ( preg_match( "/(MT-*8[0-9]{3}iP)|(MT-*8[0-9]{3}i,)/", $label ) ) {
        $section = "mt8000ip";
      } else if ( preg_match( "/MT-*8[0-9]{3}iE/", $label ) ) {
        $section = "mt8000ie";
      } else if ( preg_match( "/mTV-*[0-9]{3}/", $label ) ) {
        $section = "mtv";
      } else if ( preg_match( "/eMT-*3[0-9]{3}/", $label ) ) {
        $section = "emt3000";
      } else if ( preg_match( "/\/iR/", $url ) ) {
        $section = "moduli";
      } else if ( preg_match( "/DocumentFAQ/", $label ) ) {
        $section = "faq";
      } else {
        $section = "other";
      }
      $item = array( 'title' => $title, 'brand' => '', 'lang' => 'ENG', 'mod_data' => $file_data, 'url' => $url, 'put' => $put, 'fname' => $fname, 'category' => $catalog[ 'category' ], 'section' => $section, 'ftype' => $contentType, 'label' => $label, 'sort' => $sort, 'description' => $description );
      array_push( $docs_json, $item );
      if ( preg_match( "/(EBPro User Manual|EasyBuilder Pro User Manual)/i", $title ) ) {
        $title_ch = str_replace( 'EBPro User Manual-', '', $title );
        $chapters .= '<li> <a class="chapter" href="/weintek-easybuilderpro-user-manual-en/' . $fjname . '/">' . $title_ch . '</a> </li>';
        $metatags .= 'case \'' . $fjname . '\':
$TITLE = \'' . $title_ch . ' | Скачать Weintek EBPro EasyBuilder Pro V6 руководство пользователя, мануал manual, инструкция, на английском\';
$h1 = \'' . $title_ch . '\';
$DESCRIPTION = \'Глава ' . $title_ch . ' из руководства пользователя Easybuilder Pro.\';
$CANONICAL = \'https://www.rusavtomatika.com/weintek-easybuilderpro-user-manual-en/' . $fjname . '/\';
break;';
        $chap = array( 'title' => $title, 'brand' => '', 'mod_data' => $file_data, 'url' => $catalog[ 'url' ], 'put' => $put, 'fname' => $fname, 'category' => $catalog[ 'category' ], 'section' => "chap", 'label' => $label );
        array_push( $chapters_arr, $chap );
        $up2date = $file_data;
      }
    }
  }
  $chapters_arr = array_values( $chapters_arr );
  //                                                  echo "<pre>";
  //                                                  var_dump( $chapters_arr );
  //                                                  echo "</pre>"; exit();
  $chapters .= '</ul>';
  $metatags .= 'default:
break;
}
$text_before = \'<img style=float:right;margin: 0 0 20px 20px; alt=Weintek Easybuilder Pro скачать руководство src=/manuals/weintek/UserManual_separate_chapter/easybuilder-pro.png />EasyBuilder Pro — среда разработки проектов для панелей оператора Weintek. Использование ПО EasyBuilder Pro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.\';';
  //$metatags = iconv( "UTF-8", "Windows-1251", $metatags );
  file_put_contents( $docs_folder . 'menu.php', $chapters );
  file_put_contents( $docs_folder . 'metatags.php', $metatags );
  file_put_contents( $docs_folder . 'chapters_arr.txt', json_encode( $chapters_arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  file_put_contents( $docs_folder . 'update_date.txt', $up2date );
  file_put_contents( $docs_folder . 'update.txt', time() );
  file_put_contents( $chap_files . 'menu.php', $chapters );
  file_put_contents( $chap_files . 'metatags.php', $metatags );
  file_put_contents( $chap_files . 'update.txt', time() );
  unset( $files );
  //exit();
  $total_flt = count( $docs_json );
  echo "Массив отфильтрован. Оставлены только документы. (" . $total_flt . ")</br>";
  //echo( json_encode($docs_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );
  $ra_items = json_decode( file_get_contents( $ra_filename ), true ); // JSON с нашими документами
  //$plc_items = json_decode( file_get_contents( $plc_filename ), true ); // JSON с "Руководства по подключению ПЛК". Большинства из них уже нет в массиве weintek.com
  //$items = array_merge( $docs_json, $ra_items, $plc_items ); // $plc_items - это по сути драйверы


  $items = array_merge( $docs_json, $ra_items ); // Объединяем эти 2 массива. Без драйверов
  file_put_contents( $docs_lresult, json_encode( $items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  file_put_contents( $docs_wt_result, json_encode( $docs_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  unset( $ra_items );
  $time_tags_secs = microtime( true ) - $start;
  echo "<br>Получение массива документов заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  unset( $items );
  exit();
}
//////////////////// Скачивание документов ////////////////////////////
if ( isset( $_GET[ 'download' ] ) ) {

  echo "<h1>Скачивание документов</h1>";
  $start_down = microtime( true );
  //$all_external_docs = $items;
  //$items = json_decode( file_get_contents( $all_external_docs ), true ); // Объединяем эти 3 массива
  $docs_json = json_decode( file_get_contents( $docs_wt_result ), true ); // JSON с нашими документами
  $chapters_arr = json_decode( file_get_contents( $docs_folder . 'chapters_arr.txt' ), true ); // JSON с нашими документами
  $documents = array_values( $docs_json );
  echo "В массиве " . count( $documents ) . " документов<br>";
  if ( is_dir( $tmp_bufer ) === false ) {
    mkdir( $tmp_bufer, 0755, true );
    debug_to_console( "Создан каталог: " . $tmp_bufer );
  }
  if ( is_dir( $chap_bufer ) === false ) {
    mkdir( $chap_bufer, 0755, true );
    debug_to_console( "Создан каталог: " . $chap_bufer );
  }
  if ( is_dir( $chap_files ) === false ) {
    mkdir( $chap_files, 0755, true );
    debug_to_console( "Создан каталог: " . $chap_files );
  }

  //echo $tmp_bufer;
  //file_put_contents( $all_downloaded_docs_filename, json_encode( $documents ) );
  if ( count( $documents ) > 2 ) {
    deleteFolder( $tmp_bufer );
  } else {
    echo "Входящий массив пуст";
    exit();
  } // проверяем входящий массив
  saveFiles( $documents, $tmp_bufer );
  saveFiles( $chapters_arr, $chap_bufer );
  //echo "Листинг каталога " . $tmp_bufer . ":<br>";
  //echo getcwd();
  //rscan( "/home/moisait/public_html/rusavto/documents/ra/tmp_bufer/" );
  $time_save_secs = microtime( true ) - $start_down;
  echo "Сохранение документов заняло " . date( 'i мин s сек', $time_save_secs ) . "<br><hr>";
  exit();
}
if ( isset( $_GET[ 'upload' ] ) ) {
  //////////////////////// Upload документов на FTP ///////////////////////////	
  echo "<h1>Заливаем документы на FTP (картинки)</h1>";
  // проверяем доступность донора
  $homepage = file_get_contents( 'https://dl.weintek.com/' );
  $doc = new DOMDocument;
  $doc->loadHTML( $homepage );
  $titles = $doc->getElementsByTagName( 'h1' );
  $uptime = $titles->item( 0 )->nodeValue;
  if ( $uptime != "Hello, world" ) {
    echo "dl.weintek.com лежит<br>";
    mail( "maxbelousov@ya.ru", "Копирование документов", "dl.weintek.com лежит", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $start_upload = microtime( true );
    $drv_work = array();
    $drv_final = array();
    $ftp_server = '82.202.162.16';
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';

    $ftp_server_ms = 'moisait.net';
    $ftp_user_name_ms = 'mbel@moisait.net';
    $ftp_user_pass_ms = 'mbel-0864';

    $result_tmp = array();
    $result = array();
    $result_chap = array();
    scan_folder( $tmp_bufer, $result_tmp );
    scan_folder( $chap_bufer, $result_chap );
    //    $result = array_merge( $result_tmp, $result_chap );
    unset( $result_tmp, $result_chap );
    $idrv = 0;
    $skip = 0;

    //    foreach ( $result as $key => $url ) {
    //      // Если это не пустая строка
    //      if ( (!empty( $url )) && ($url[ 'ext' ] == "pdf11111111111111111111111111111111111111111111111111111") ) {
    //        // Получаем имя файла
    //        $src_file = $url[ 'path' ];
    //        $src_filename = $url[ 'name' ];
    //        $tmp_file = $docs_folder . $src_filename;
    //        copy( $src_file, $tmp_file );
    //        $pdf = new MYPDF();
    //        try {
    //          $pdf->numPages = $pdf->setSourceFile( $tmp_file );
    //          for ( $i = 1; $i <= $pdf->numPages; $i++ ) {
    //            $pdf->endPage();
    //            $pdf->_tplIdx = $pdf->importPage( $i );
    //            $pdf->AddPage();
    //          }
    //          $pdfdump = $pdf->Output( 'pdfdump.pdf', 'S' );
    //          copy( $src_file, $src_file . '.src' );
    //          unlink( $src_file );
    //          if ( file_put_contents( $src_file, $pdfdump ) ) {
    //            unlink( $src_file . '.src' );
    //            unlink( $tmp_file );
    //            unset( $pdf, $pdfdump );
    //            // конец процедуры вставки колонтитула в PDF
    //          }
    //          $idrv++;
    //        } catch ( Exception $e ) {
    //          unlink( $tmp_file );
    //          unset( $pdf, $pdfdump );
    //          $skip++;
    //          continue;
    //        }
    //        // выводим как строку (имя игнорируется)
    //      }
    //    }
    $conn_id = ftp_connect( $ftp_server, 21 );
    // проверяем доступность нашего FTP
    $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
    //    Проверяем авторизацию
    if ( false === $login_result ) {
      echo "Ошибка авторизации на FTP<br>";
      mail( "maxbelousov@ya.ru", "Копирование документов", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      echo "Вошёл<br>";
      ftp_set_option( $conn_id, FTP_USEPASVADDRESS, false );
      ftp_pasv( $conn_id, true )or die( "Unable switch to passive mode" );
      ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 100 );
      //        перед копированием новых удаляем старые
      //        clean( $conn_id, $ftp_folder );
      //        clean( $conn_id, $ftp_chap_folder );
      $docs_json = json_decode( file_get_contents( $docs_wt_result ), true ); // JSON с нашими документами
      $documents = array_values( $docs_json );
      foreach ( $documents as $id_dom => $attrs ) {
        if ( isset( $attrs[ 'title' ] ) && ( strpos( $attrs[ 'title' ], 'All chapters' ) !== false ) ) {
          //                        echo $attrs[ 'title' ].'<br>';
          //                        echo $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ].'<br>';
          ftp_put( $conn_id, '/manuals/EBPro_Manual_All_in_One/EasyBuilderPro_UserManual_eng.pdf', $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ], FTP_BINARY );
          $beg = strpos( $attrs[ 'fname' ], '_V' );
          $ver0 = mb_substr( $attrs[ 'fname' ], $beg + 2, 5, 'UTF8' );
          $ver0 = str_split( $ver0 );
          $ver = $ver0[ 0 ] . '.' . $ver0[ 1 ] . $ver0[ 2 ] . '.' . $ver0[ 3 ] . $ver0[ 4 ];
          file_put_contents( 'chap_files/versionEBPro.txt', $ver );
          file_put_contents( 'chap_files/update_date.txt', $attrs[ 'mod_data' ] );
        }
      }
      ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
      ftp_putAll( $conn_id, $chap_bufer, $ftp_chap_folder );
      //ftp_putAll( $conn_id, $old_weintek, $ftp_folder );
      ftp_putAll( $conn_id, $docs_folder . 'chap_files/', '/manuals/weintek/UserManual_separate_chapter' );
      deleteFolder( $tmp_bufer );
      deleteFolder( $chap_bufer );
      deleteFolder( $chap_files );
      ftp_close( $conn_id );
    }
    $conn_id_ms = ftp_connect( $ftp_server_ms, 21 );
    $login_result_ms = ftp_login( $conn_id_ms, $ftp_user_name_ms, $ftp_user_pass_ms );
    if ( false === $login_result_ms ) {
      echo "Ошибка авторизации на FTP МС<br>";
      //mail( "maxbelousov@ya.ru", "Копирование документов", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      ftp_pasv( $conn_id_ms, true )or die( 'Не могу включить пассив<br>' );
      echo "Вошёл в МС<br>";
      ftp_put( $conn_id_ms, '/rusavto/documents/docs_result.txt', $docs_folder . 'docs_result.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/availableTags.txt', $docs_folder . 'availableTags.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/chapters_arr.txt', $docs_folder . 'chapters_arr.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/docs_wt_result.txt', $docs_folder . 'docs_wt_result.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/ra-docs.txt', $docs_folder . 'ra-docs.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/wt_files_result.txt', $docs_folder . 'wt_files_result.txt', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/menu.php', $docs_folder . 'menu.php', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/metatags.php', $docs_folder . 'metatags.php', FTP_ASCII );
      ftp_put( $conn_id_ms, '/rusavto/documents/update.txt', $docs_folder . 'update.txt', FTP_ASCII );
      ftp_close( $conn_id_ms );
    }
  }
  unset( $result, $documents );
  $total = $idrv + $skip;
  $time_upload_secs = microtime( true ) - $start_upload;
  $time_total_secs = microtime( true ) - $start;
  //echo $idrv . " файлов обработано<br>" . $skip . " пропущено<br>" . $total . " файлов всего<br>";
  echo "Upload документов занял " . date( 'i мин s сек', $time_upload_secs ) . "<br>";
  echo "Весь скрипт работал " . date( 'i мин s сек', $time_total_secs ) . "<br>";
}
?>
</body>
</html>