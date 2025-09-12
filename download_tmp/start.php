<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TMP Update soft</title>
</head>

<body>
<h1>Тестовое Обновление раздела SOFTWARE</h1>
<p><? echo (date("H:i:s")); ?></p>
<br>
<br>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
//ini_set( 'max_execution_time', 911500 );
//ini_set( "memory_limit", "512M" );
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

  /////////////////// Функции и классы ///////////////////////////////	


  function saveFiles( $docs, $destination ) {
    $idoc = 0;
    $ifs = 0;
    $ifc = 0;
    global $documents,$docs_folder,$tmp_bufer,$pack_folder,$ifs,$ifc,$chap_bufer;
    //$docs_result = $docs_folder . "/documents__/docs_wt_result.txt";
    //                            echo "<pre>";
    //                            var_dump( $documents );
    //                            echo "</pre>";
    foreach ( $docs as $key => $doc ) {
      $idoc++;
      $filename = $doc[ 'fname' ];
      if ( ( strpos( " ", $filename ) )OR( strpos( "%20", $filename ) !== false ) ) {
        $filename = str_replace( " ", "_", $doc[ 'fname' ] );
        $filename = str_replace( "%20", "_", $doc[ 'fname' ] );
        $documents[ $ifs ][ 'fname' ] = $filename;
      }
      $src_path = $doc[ 'put' ];
      $section = $doc[ 'section' ];
      $cur_path = $tmp_bufer;
      $url_cat_dest = $docs_folder . $src_path;
      $dest_path2file = $tmp_bufer . $src_path . '/' . $filename;
      $dest_path2pack = $pack_folder . $filename;
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
          $ifc++;
        }
      } else {
        if ( UR_exists( $src_url ) !== false ) {
          copy( $src_url, $dest_path2file );
          $ifc++;
        }

      }
      if ( preg_match( '/\.package$/', $filename ) ) {
        if ( UR_exists( $src_url ) !== false ) {
          file_put_contents( $dest_path2pack, file_get_contents( $src_url ) );
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
            if ( $folderPath != $tmp_bufer ) {
              deleteFolder( $folderPath . '/' . $file );
            }
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
      $result3 = ftp_nlist( $conn, $file );
      $i = 0;
      foreach ( $result3 as $item ) {
        if ( ( strpos( $item, '/.' ) === false ) ) {} else {
          unset( $result3[ $i ] );
        }
        $i++;
      }
      foreach ( $result3 as $childFile ) {
        clean( $conn, $childFile );
      }
      if ( $file != '/soft_tmp/' ) {
        ftp_rmdir( $conn, $file );
      }
    } else {
      ftp_delete( $conn, $file );
    }
  }

  function ftp_putAll( $conn_id, $src_dir, $dst_dir ) {
    $d = dir( $src_dir );
    while ( $file = $d->read() ) {
			  //echo 'file: '.$file.'<br>';
      if ( $file != "." && $file != ".." ) {
        if ( is_dir( $src_dir . "/" . $file ) ) {
          if ( !@ftp_chdir( $conn_id, $dst_dir . "/" . $file ) ) {
            ftp_mkdir( $conn_id, $dst_dir . "/" . $file );
			  //echo 'Каталог создан: '.$dst_dir . "/" . $file.'<br>';
          }
          $upload = ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . "/" . $file );
			  //echo 'Файл загружен (1): '.$dst_dir . "/" . $file.'<br>';
        } else {
          $upload = ftp_put( $conn_id, $dst_dir . "/" . $file, $src_dir . "/" . $file );
			//echo $dst_dir . "/" . $file .($upload ? '----OK2<br>' : '----ERROR2<br>' );
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
  $docs_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download_tmp/';
  $pack_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download_tmp/soft/';
  //file_put_contents( $docs_folder . "error_log", "" );
  $docs_result = $docs_folder . 'soft_result.txt';
  $filename = $docs_folder . 'soft.txt';
  $tmp_bufer = $docs_folder . 'tmp_soft/';
  $ftp_folder = '/soft_tmp/';
  file_put_contents( $docs_folder . "error_log", "" );

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
  $alltags = json_decode( file_get_contents( $filename ), true );
  $total_alltags = count( $alltags );
  echo "Массив с сайта WEINTEK.COM записан в файл soft.txt (" . $total_alltags . ")</br>";
  $good_cat = "/Software/"; //гуд-слова в URL
  $docs_json = array();
  foreach ( $alltags as $catalog ) {
    if ( preg_match( $good_cat, $catalog[ 'category' ] ) ) {
      $title = str_replace( "_", " ", $catalog[ 'title' ] );
      $title = preg_replace( '/(\(([\w\/ ]{20,})\))/i', '', $title );
      //		  echo $title."<br>";
      $item = array();
      $url = $catalog[ 'url' ];
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
      $label = $catalog[ 'label' ];
      if ( strpos( $fname, '%20' ) !== false ) {
        $fname = str_replace( "%20", "_", $fname );
      }
      if ( is_array( explode( '.', $fname ) ) ) {
        $ctype = explode( '.', $fname );
        $contentType = end( $ctype );
      }

      $curl = curl_init( $catalog[ 'url' ] );
      //Отказываемся от самой стр. Нам только заголовки
      curl_setopt( $curl, CURLOPT_NOBODY, true );
      //стопим вывод данных в stdout
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      //получаем дату крайней модификации файла
      curl_setopt( $curl, CURLOPT_FILETIME, true );
      //получаем размер файла
      curl_setopt( $curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD, true );
      $result2 = curl_exec( $curl );
      if ( $result2 === false ) {
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
      $description = '';
      if ( preg_match( "/SoftwareEB/i", $label ) ) { //
        $description = "Программное обеспечение EasyBuilderPro применяется для создания пользовательских проектов для операторских панелей Weintek всех серий.<br>
Использование ПО EasyBuilderPro полностью бесплатно, вы можете скачивать ПО и пользоваться им без каких-либо ограничений.<br>
USB драйвера для подключения панели к ПК устанавливаются автоматически при установке EasyBuilderPro";
      }
      $item = array( 'title' => $title, 'mod_data' => $file_data, 'url' => $url, 'put' => $put, 'fname' => $fname, 'fsize' => $filesize, 'category' => $catalog[ 'category' ], 'ftype' => $contentType, 'section' => $section, 'label' => $label, 'sort' => '1450', 'description' => $description );
      array_push( $docs_json, $item );
    }
  }
  unset( $alltags );
  $total_flt = count( $docs_json );
  echo "Массив отфильтрован. Оставлены только soft. (" . $total_flt . ")</br>";
  file_put_contents( $docs_result, json_encode( $docs_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
  //unset( $docs_json );
	//exit();
  $time_tags_secs = microtime( true ) - $start;
  echo "<br>Получение массива soft заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  //exit();
  //////////////////// Скачивание документов ////////////////////////////

  echo "<h1>Скачивание soft</h1>";
  $start_down = microtime( true );
  $documents = array_values( $docs_json );
//                                                  echo "<pre>";
//                                                  var_dump( $documents );
//                                                  echo "</pre>";
//	exit();
  unset( $items,$docs_json );
  echo "В массиве " . count( $documents ) . " элементов<br>";
  if ( count( $documents ) > 2 ) {
    deleteFolder( $tmp_bufer );
  } else {
    echo "Входящий массив пуст";
    exit();
  } // проверяем входящий массив
  //saveFiles( $documents, $tmp_bufer );
	//exit();
  $time_save_secs = microtime( true ) - $start_down;
  echo "Сохранение soft заняло " . date( 'i мин s сек', $time_save_secs ) . "<br><hr>";
  //////////////////////// Upload soft на FTP ///////////////////////////	
  echo "<h1>Заливаем soft на FTP (картинки)</h1>";
  // проверяем доступность донора
    $start_upload = microtime( true );
    $drv_work = array();
    $drv_final = array();
    $result = array();
    //scan_folder( $tmp_bufer, $result );


    // проверяем доступность нашего FTP
    $ftp_server = '82.202.162.16';
$ftp_user_name = 'upload_olga@weblector.ru';
$ftp_user_pass = 'olgaglr';
//$ftp_user_name = 'ilval@weblector.ru';
//$ftp_user_pass = 'ilval2398';
    $conn_id = ftp_connect( $ftp_server, 21 );
    try {if (false === $conn_id) {
        throw new Exception('Unable to connect');
    }
		
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
    if ( false === $conn_id ) {
        throw new Exception('Unable to log in');
      //mail( "maxbelousov@ya.ru", "Копирование soft", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      echo "Есть коннект<br>";
        //ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 9999 );
    //var_dump(ftp_nlist($conn_id, "."));
//        ftp_close( $conn_id );
//		exit();
        //ftp_set_option($conn_id, FTP_USEPASVADDRESS, false);
		ftp_pasv( $conn_id, true ) or die('Не могу включить пассив<br>');
		//$file_handle = fopen($docs_folder . '4.php', 'r');
        ftp_put( $conn_id, '/soft_tmp/EasyAccess/cMTViewer_V22351.zip', $_SERVER[ 'DOCUMENT_ROOT' ].'/download_tmp/tmp_soft/cMTViewer/cMTViewer_V22351.zip', FTP_AUTOSEEK );
		//echo $docs_folder . '4.php<br>';
        ftp_close( $conn_id );
		exit();
      //    Проверяем авторизацию
//      if ( false === $login_result ) {
//        echo "Ошибка авторизации на FTP<br>";
//        mail( "maxbelousov@ya.ru", "Копирование soft", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
//        exit();
//      } else {
//      echo "Есть логин<br>".count( $documents )."<br>";
		  //ftp_set_option($conn_id, FTP_USEPASVADDRESS, false);
//                                                  echo "<pre>";
//                                                  var_dump( $documents );
//                                                  echo "</pre>";
        foreach ( $documents as $id_dom => $attrs ) {
          if ( isset( $attrs[ 'label' ] ) && ( strpos( $attrs[ 'label' ], 'SoftwareEB' ) !== false ) ) {
//            echo $attrs[ 'title' ].'<br>';
//            echo $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ].'<br>';
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            ftp_put( $conn_id, '/soft_tmp/EBPro/EBpro_setup.zip', $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ], FTP_BINARY );
			  echo 'EBpro_setup.zip: ' . $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ] . '<br>';
            $ver0 = preg_match( '/\d{8}/', $attrs[ 'fname' ], $matches );
            $ver_rn0 = preg_match( '/\d{5}/', $attrs[ 'fname' ], $matches5 );
            $ver0 = $matches[ 0 ];
            $ver_rn = $matches5[ 0 ];
            $ver0 = str_split( $ver0 );
            $ver = $ver0[ 0 ] . '.' . $ver0[ 1 ] . $ver0[ 2 ] . '.' . $ver0[ 3 ] . $ver0[ 4 ] . '.' . $ver0[ 5 ] . $ver0[ 6 ] . $ver0[ 7 ];
            $rn_url = 'https://dl.weintek.com/EBPro/ReleaseNote/EBProV' . $ver_rn . '_ReleaseNotes_en.pdf';
            $rn_fname = 'EBProV' . $ver_rn . '_ReleaseNotes_en.pdf';
            $rn_unifname = 'EBPro_ReleaseNotes_en.pdf';
            copy( $rn_url, $tmp_bufer . $attrs[ 'put' ] . '/' . $rn_fname );
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            ftp_put( $conn_id, '/soft_tmp/EBPro/release_notes/' . $rn_fname, $tmp_bufer . $attrs[ 'put' ] . '/' . $rn_fname, FTP_BINARY );
			  echo $rn_fname.': ' . $tmp_bufer . $attrs[ 'put' ] . '/' . $rn_fname . '<br>';
            ftp_put( $conn_id, '/soft_tmp/EBPro/release_notes/' . $rn_unifname, $tmp_bufer . $attrs[ 'put' ] . '/' . $rn_fname, FTP_BINARY );
			  echo $rn_unifname.': ' . $tmp_bufer . $attrs[ 'put' ] . '/' . $rn_fname . '<br>';
            file_put_contents( $tmp_bufer . $attrs[ 'put' ] . '/version.txt', $ver );
            file_put_contents( $tmp_bufer . $attrs[ 'put' ] . '/date.txt', $attrs[ 'mod_data' ] );
			  //echo $tmp_bufer . $attrs[ 'put' ] . '/date.txt<br>';
//			  echo $tmp_bufer . $attrs[ 'put' ] . '/version.txt - '.$ver.'<br>';
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            ftp_put( $conn_id, '/soft_tmp/EBPro/Installer/version.txt', $tmp_bufer . $attrs[ 'put' ] . '/version.txt', FTP_ASCII );
			  echo 'EBPro/Installer/version.txt: ' . $tmp_bufer . $attrs[ 'put' ] . '/version.txt<br>';
            ftp_put( $conn_id, '/soft_tmp/EBPro/Installer/date.txt', $tmp_bufer . $attrs[ 'put' ] . '/date.txt', FTP_ASCII );
			  echo 'EBPro/Installer/date.txt: ' . $tmp_bufer . $attrs[ 'put' ] . '/date.txt<br>';
            //break;
          }
          if ( isset( $attrs[ 'label' ] ) && ( strpos( $attrs[ 'label' ], 'SoftwareEasyAccess' ) !== false ) ) {
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            ftp_put( $conn_id, '/soft_tmp/EasyAccess/EasyAccess20_setup.exe', $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ], FTP_BINARY );
			  echo 'EasyAccess/EasyAccess20_setup.exe: ' . $tmp_bufer . $attrs[ 'put' ] . '/' . $attrs[ 'fname' ] . '<br>';
            $ver0 = preg_match( '/(2)\.(\d{2})\.(\d{1})/', $attrs[ 'fname' ], $matches );
            $ver_rn0 = preg_match( '/(\d{5})/', $attrs[ 'fname' ], $matches5 );
            $ver0 = $matches[ 0 ];
            if ($matches5) $ver_rn = $matches5[ 0 ];
            $ver0 = str_split( $ver0 );
            $ver = $ver0[ 0 ] . '.' . $ver0[ 1 ] . $ver0[ 2 ] . '.' . $ver0[ 3 ] . $ver0[ 4 ] . '.' . $ver0[ 5 ];
            file_put_contents( $tmp_bufer . $attrs[ 'put' ] . '/version.txt', $matches );
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
            ftp_put( $conn_id, '/soft_tmp/EasyAccess/version.txt', $tmp_bufer . $attrs[ 'put' ] . '/version.txt', FTP_ASCII );
			  echo 'EasyAccess/version.txt: ' . $tmp_bufer . $attrs[ 'put' ] . '/version.txt<br>';
            //break;
          }
          if ( preg_match( '/\.package$/', $attrs[ 'fname' ] ) ) {
            copy( $rn_url, $pack_folder . $rn_fname );
          }
//                                                  echo $attrs[ 'fname' ]."---------".$attrs[ 'label' ]."</br>";
        }
        //        перед копированием новых удаляем старые
        //        clean( $conn_id, $ftp_folder );
        //ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
        //        ftp_putAll( $conn_id, $arc_bufer, $um_ebpro_arc_folder );
        //deleteFolder( $tmp_bufer );
        ftp_close( $conn_id );
      }
    } catch (Exception $e) {
    echo "Failure: " . $e->getMessage();
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