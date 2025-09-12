<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update docs</title>
</head>

<body>
<h1>Обновление раздела SOFTWARE</h1>
<br>
<br>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
  ini_set( 'max_execution_time', 1500 );
  ini_set( "memory_limit", "512M" );

  /////////////////// Функции и классы ///////////////////////////////	


  function saveFiles( $docs, $destination ) {
    global $documents;
    global $tmp_bufer;
    global $chap_bufer;
    global $ifs;
    $idoc = 0;
    $ifs = 0;
    //$docs_result = $docs_folder . "/documents__/docs_wt_result.txt";
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
          copy( $src_url, $dest_path2file );
          //file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          //                    echo "dest_path2file: " . $dest_path2file . " Section: " . $section . "<br>";
          $ifc++;
        }
      } else {
        if ( UR_exists( $src_url ) !== false ) {
          copy( $src_url, $dest_path2file );
          //file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          //                    echo "dest_path2file(2): " . $dest_path2file . " Section: " . $section . "<br>";
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
            if ( ( $folderPath != $tmp_bufer ) & ( $folderPath != $chap_bufer ) & ( $folderPath != $tmp_bufer . 'images/' ) ) {
              deleteFolder( $folderPath . '/' . $file );
            }
          } else {
            unlink( $folderPath . '/' . $file );
          }
        }
      }
      //            if ( ( $folderPath != $tmp_bufer ) & ( $folderPath != $chap_bufer ) & ( $folderPath != $tmp_bufer . 'images/' ) ) {
      if ( ( $folderPath != $tmp_bufer ) & ( $folderPath != $chap_bufer ) & ( $folderPath != $tmp_bufer . 'images/' ) ) {
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
      if ( ( $file != '/documents/' ) & ( $file != '/soft/' ) & ( $file != '/manuals/weintek/UserManual_separate_chapter/' ) ) {
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

  ////////////////////////////////////////////////////////////////
  $start = microtime( true );
  echo "<h1>Обновление раздела soft</h1>";
  // путь на проде: /home/weblec/public_html/rusavtomatika.com
  $docs_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/';
  file_put_contents( $docs_folder . "error_log", "" );
  $filename = $docs_folder . 'availableTags.txt';
  $docs_wt_result = $docs_folder . 'soft.txt';
  $ra_filename = $docs_folder . 'ra-docs.txt';
  $docs_result = $docs_folder . 'soft_result.txt';
  $all_downloaded_docs_filename = $docs_folder . 'all_downloaded_docs.txt';
  $drv_result = $docs_folder . 'all_uploaded_docs.txt';
  $tmp_bufer = $docs_folder . 'tmp_soft/';
  $arc_bufer = $docs_folder . 'arc/';
  //  $docs_folder = $docs_folder . '';
  $ftp_folder = '/soft/';
  $um_ebpro_arc_folder = '/documents/weintek/EBPro/UserManual/eng/arc/';

  $theUrl = 'https://www.weintek.com/globalw/Download/Download.aspx';
  $src = file_get_contents( $theUrl );
  echo "Массив всех доступных ссылок с сайта WEINTEK.COM получен</br>";
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
  //$headers = get_headers( $url, 1 );
  //$tags_json = file_get_contents( $filename );
  //$alltags = json_decode( $tags, true );
  $alltags = json_decode( file_get_contents( $filename ), true );
  $total_alltags = count( $alltags );
  echo "Массив с сайта WEINTEK.COM записан в файл availableTags.json (" . $total_alltags . ")</br>";
  $bad_words = "/(Chinese|japanese|HMI Pin Assignment|RoHS)/i"; //стоп-слова в названии
  $bad_urls = "/(cht|jap|jpn|_jpn|_cht|_tw|_jp|MT500|.zip|.apk|.package|.cmtp|.ccmp|.ecmp|.rar|.dwg|.bin|.emtp|.htm)/i"; //стоп-слова в URL
  $good_urls = "/(EBPro|EasyAccess20|cMT|MT8000iP|MT8000iE|mTV|eMT3000|iR|FAQ)/"; //гуд-слова в URL
  $good_cat = "/Software/"; //гуд-слова в URL
  $docs_json = array();
  //////////////////// массив архивов мануалов ebpro
  //  $fileListing = ftp_nlist( $conn_id, $um_ebpro_arc_folder );
  //echo $um_ebpro_arc_folder;
  //  if ( !$fileListing ) {
  //    die( 'Error listing directory' );
  //  }
  ////  print_r( $fileListing );
  //  $fileListing = array_diff( $fileListing, [ $um_ebpro_arc_folder . "/.", $um_ebpro_arc_folder . "/.." ] );
  ////  echo "<pre>";
  ////  var_dump( $fileListing );
  ////  echo "</pre>";
  //  foreach ( $fileListing as $file ) {
  //    if ( $file !== '.' && $file !== '..' ) {
  //      $filename = pathinfo( $file );
  //      $basename = $filename[ 'basename' ]; // сохранить имя файла
  //      $filename = $filename[ 'filename' ];
  //      $ver = str_split( $filename );
  //      $version = $ver[ 0 ] . '.' . $ver[ 1 ] . $ver[ 2 ] . '.' . $ver[ 3 ] . $ver[ 4 ];
  //      $fileArray[] = [ 'url' => $file, 'fname' => $filename, 'version' => $version ]; // добавить файл в массив
  //    }
  //  }
  //  echo $docs_folder . 'um_arc.txt';
  //  file_put_contents( $docs_folder . 'um_arc.txt', json_encode( $fileArray ) );
  /////////////////////////////////
  foreach ( $alltags as $catalog ) {
    if ( preg_match( $good_cat, $catalog[ category ] ) ) {
      $title = str_replace( "_", " ", $catalog[ title ] );
        $title = preg_replace('/(\(([\w\/ ]{10,})\))/i','',$title);
      //		  echo $title."<br>";
      $item = array();
      $url = $catalog[ url ];
      if ( strpos( $url, 'ihmi.net' ) !== false ) {
        $headers = get_headers( $url, 1 );
        $url = $headers[ 'Location' ];
      }
      $info = pathinfo( $url );
      $put = $info[ 'dirname' ];
      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put );
      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/)/', '', $put );

      if ( strpos( $url, 'codesys.com' ) !== false ) {
        $put = 'codesys';
      }
      //      echo $put . "<br>";
      $fname = $info[ 'basename' ];
      $fjname = $info[ 'filename' ];
      $label = $catalog[ label ];
      $curl = curl_init( $catalog[ url ] );
      //Отказываемся от самой стр. Нам только заголовки
      curl_setopt( $curl, CURLOPT_NOBODY, true );
      //стопим вывод данных в stdout
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      //получаем дату крайней модификации файла
      curl_setopt( $curl, CURLOPT_FILETIME, true );
      //получаем размер файла
      curl_setopt( $curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD, true );
      $result = curl_exec( $curl );
      if ( $result === false ) {
        //		  echo $title." не могу достучаться<br>";
        continue;
      }
      $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
      if ( $timestamp != -1 ) {
        $file_data = $timestamp; //etc
      } else {
        $file_data = "N/A";
      }
      $filesize = curl_getinfo( $curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD );

      curl_close( $curl );
      if ( preg_match( "/SoftwareEB/", $label ) ) { //
        $section = "ebpro";
      } else if ( preg_match( "/EasyAccess/", $label ) ) { //
        $section = "ea20";
      } else if ( preg_match( "/SoftwareUtility/", $label ) ) { //
        $section = "utility";
      } else if ( preg_match( "/cMT[0-9]{3}/", $label ) ) { //
        $section = "cmt";
      } else if ( preg_match( "/MT6[0-9]{2}/", $label ) ) { //
        $section = "mt600";
      } else if ( preg_match( "/MT8[0-9]{3}iP/", $label ) ) { //
        $section = "mt8000ip";
      } else if ( preg_match( "/MT8[0-9]{3}iE/", $label ) ) { //
        $section = "mt8000ie";
      } else if ( preg_match( "/mTV-[0-9]{3}/", $label ) ) {
        $section = "mtv";
      } else if ( preg_match( "/eMT3[0-9]{3}/", $label ) ) {
        $section = "emt3000";
      } else if ( preg_match( "/\/iR\//", $url ) ) { //
        $section = "moduli";
      } else if ( preg_match( "/EasyLauncher/", $label ) ) { //
        $section = "easylauncher";
      } else {
        $section = "";
      }
      $item = array( 'title' => $title, 'mod_data' => $file_data, 'url' => $url, 'put' => $put, 'fname' => $fname, 'fsize' => $filesize, 'category' => $catalog[ category ], 'section' => $section, 'label' => $label );
      array_push( $docs_json, $item );
    }
  }
  //                                                echo "<pre>";
  //                                                var_dump( $chapters_arr );
  //                                                echo "</pre>";
  unset( $alltags );
  $total_flt = count( $docs_json );
  echo "Массив отфильтрован. Оставлены только soft. (" . $total_flt . ")</br>";
  //echo( json_encode($docs_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );
  //$plc_items = json_decode( file_get_contents( $plc_filename ), true ); // JSON с "Руководства по подключению ПЛК". Большинства из них уже нет в массиве weintek.com
  //$items = array_merge( $docs_json, $ra_items, $plc_items ); // $plc_items - это по сути драйверы
  file_put_contents( $docs_result, json_encode( $docs_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  //unset( $docs_json );
  $time_tags_secs = microtime( true ) - $start;
  echo "<br>Получение массива soft заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  //////////////////// Скачивание документов ////////////////////////////

  echo "<h1>Скачивание soft</h1>";
  $start_down = microtime( true );
  //$all_external_docs = $items;
  //$items = json_decode( file_get_contents( $all_external_docs ), true ); // Объединяем эти 3 массива
  $documents = array_values( $docs_json );
  unset( $items );
  echo "В массиве " . count( $documents ) . " элементов<br>";

  //echo $tmp_bufer;
  //file_put_contents( $all_downloaded_docs_filename, json_encode( $documents ) );
  if ( count( $documents ) > 2 ) {
    deleteFolder( $tmp_bufer );
  } else {
    echo "Входящий массив пуст";
    exit();
  } // проверяем входящий массив
  saveFiles( $documents, $tmp_bufer );
  //saveFiles( $chapters_arr, $chap_bufer );
  //echo "Листинг каталога " . $tmp_bufer . ":<br>";
  //echo getcwd();
  //rscan( "/home/moisait/public_html/rusavto/documents__/tmp_bufer/" );
  $time_save_secs = microtime( true ) - $start_down;
  echo "Сохранение soft заняло " . date( 'i мин s сек', $time_save_secs ) . "<br><hr>";
  //////////////////////// Upload документов на FTP ///////////////////////////	
  echo "<h1>Заливаем soft на FTP (картинки)</h1>";
  // проверяем доступность донора
  $homepage = file_get_contents( 'https://dl.weintek.com/' );
  $doc = new DOMDocument;
  $doc->loadHTML( $homepage );
  $titles = $doc->getElementsByTagName( 'body' );
  $uptime = $titles->item( 0 )->nodeValue;
  if ( $uptime != "Welcome to dl.weintek.com." ) {
    echo "dl.weintek.com лежит<br>";
    mail( "maxbelousov@ya.ru", "Копирование soft", "dl.weintek.com лежит", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $start_upload = microtime( true );
    $drv_work = array();
    $drv_final = array();
    $result = array();
    scan_folder( $tmp_bufer, $result );


    // проверяем доступность нашего FTP
    $ftp_server = '51.254.18.36';
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';
    $conn_id = ftp_connect( $ftp_server );
    if ( false === $conn_id ) {
      echo "Невозможно соединиться с FTP-сервером<br>";
      mail( "maxbelousov@ya.ru", "Копирование soft", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
      //    Проверяем авторизацию
      if ( false === $login_result ) {
        echo "Ошибка авторизации на FTP<br>";
        mail( "maxbelousov@ya.ru", "Копирование soft", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
        exit();
      } else {
        ftp_pasv( $conn_id, true );
        ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 10000 );
        foreach ( $documents as $id_dom => $attrs ) {
          if ( isset( $attrs[ 'label' ] ) && ( strpos( $attrs[ 'label' ], 'SoftwareEB' ) !== false ) ) {
            //                        echo $attrs[ 'title' ].'<br>';
            //                        echo $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ].'<br>';
            ftp_put( $conn_id, '/soft/EBPro/EBpro_setup.zip', $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ], FTP_BINARY );
            $ver0 = preg_match( '/\d{8}/', $attrs[ 'fname' ], $matches );
            $ver_rn0 = preg_match( '/\d{5}/', $attrs[ 'fname' ], $matches5 );
			$ver0 = $matches[0];
			$ver_rn = $matches5[0];
            $ver0 = str_split( $ver0 );
            $ver = $ver0[ 0 ] . '.' . $ver0[ 1 ] . $ver0[ 2 ] . '.' . $ver0[ 3 ] . $ver0[ 4 ] . '.' . $ver0[ 5 ] . $ver0[ 6 ] . $ver0[ 7 ];
			$rn_url = 'https://dl.weintek.com/EBPro/ReleaseNote/EBProV'.$ver_rn.'_ReleaseNotes_en.pdf';
			$rn_fname = 'EBProV'.$ver_rn.'_ReleaseNotes_en.pdf';
			$rn_unifname = 'EBPro_ReleaseNotes_en.pdf';
			copy($rn_url,$tmp_bufer . $attrs[ 'put' ] . '/'.$rn_fname);
            ftp_put( $conn_id, '/soft/EBPro/release_notes/'.$rn_fname, $tmp_bufer . $attrs[ 'put' ] . '/'.$rn_fname, FTP_BINARY );
            ftp_put( $conn_id, '/soft/EBPro/release_notes/'.$rn_unifname, $tmp_bufer . $attrs[ 'put' ] . '/'.$rn_fname, FTP_BINARY );
            file_put_contents( $tmp_bufer . $attrs[ 'put' ] . '/version.txt', $ver );
            file_put_contents( $tmp_bufer . $attrs[ 'put' ] . '/date.txt', $attrs[ 'mod_data' ] );
			break;  
          }
        }
        //        перед копированием новых удаляем старые
        //        clean( $conn_id, $ftp_folder );
        ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
//        ftp_putAll( $conn_id, $arc_bufer, $um_ebpro_arc_folder );
        deleteFolder( $tmp_bufer );
        ftp_close( $conn_id );
      }
    }
  }
  unset( $result );
  $total = $idrv + $skip;
  $time_upload_secs = microtime( true ) - $start_upload;
  $time_total_secs = microtime( true ) - $start;
  echo "Upload soft занял " . date( 'i мин s сек', $time_upload_secs ) . "<br>";
  echo "Весь скрипт работал " . date( 'i мин s сек', $time_total_secs ) . "<br>";
}
?>
</body>
</html>