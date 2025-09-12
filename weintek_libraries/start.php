<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update libs</title>
</head>

<body>
<h1>Обновление раздела Гр.Библиотеки</h1>
<p><? echo (date("H:i:s")); ?></p>
<br>
<br>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
//  ini_set( 'max_execution_time', 22500 );
//  ini_set( "memory_limit", "512M" );
  /////////////////// Функции и классы ///////////////////////////////	
  function saveFiles( $docs, $destination ) {
    global $final_json;
    global $tmp_bufer;
    global $ifs;
    //    $demos = array();
    $idoc = 0;
    $ifs = 0;
    $img_cat_dest = $tmp_bufer . 'images/';
    //$docs_result = $docs_folder . "/documents__/docs_wt_result.txt";
    //                            echo "<pre>";
    //                            var_dump( $documents );
    //                            echo "</pre>";
    foreach ( $docs as $key => $doc ) {
      $idoc++;
      $title = $doc[ 'title' ];
      $mod_data = $doc[ 'mod_data' ];
      $filename = $doc[ 'fname' ];
      $src_path = $doc[ 'put' ];
      $category = $doc[ 'category' ];
      $label = $doc[ 'label' ];
      $imgname = $doc[ 'image' ];
      $cur_path = $tmp_bufer;
      $url_cat_dest = $tmp_bufer . $src_path;
      $img_cat_dest = $tmp_bufer . 'images/';
      $dest_path2file = $tmp_bufer . $src_path . '/' . $filename;
      $dest_path2img = $img_cat_dest . $imgname;
      //		echo $dest_path2file."<br>";
      $img_url = $doc[ 'put_wt_img' ] . "/" . $doc[ 'image' ];
      //echo '<a href="'.$img_url.'" target="_new">'.$img_url.'</a><br>';continue;
      $src_url = $doc[ 'url' ];
      if ( is_dir( $url_cat_dest ) === false ) {
        $arr_folders = explode( "/", $src_path );
        //                                echo "<pre>";
        //                                var_dump( $arr_folders );
        //                                echo "</pre>";
        //		echo $tmp_bufer."<br>";
		  $check = UR_exists( $src_url );
        make_path( $arr_folders, $tmp_bufer );
        if ( $check !== false ) {
          file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          $ifc++;
        }
      } else {
        if ( $check !== false ) {
          file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          $ifc++;
        }
      }
      if ( UR_exists( $img_url ) !== false ) {
        //		echo $dest_path2img."<br>";
        //echo '<a href="' . $img_url . '" target="_new">' . $img_url . '</a><br>';
        file_put_contents( $dest_path2img, file_get_contents( $img_url ) );
      } else {
        echo '<a href="' . $img_url . '" target="_new">' . $img_url . '</a><br>';

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
      if ( ( $folderPath != $tmp_bufer )AND( $folderPath != $img_bufer ) ) {
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
      if ( $file != '/libraries/' )ftp_rmdir( $conn, $file );
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
  /////////////////////////////////////////////////////
  $start = microtime( true );
  echo "<h1>Формируем массив файлов</h1>";

  $libs_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_libraries/';
  $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/availableTags.txt';
  $ftp_folder = '/libraries/';
  file_put_contents( $libs_folder . "error_log", "" );
  $tmp_bufer = $libs_folder . 'tmp_bufer/';
  $img_bufer = $demos_folder . 'tmp_bufer/images/';
  $libs_filename = $libs_folder . 'libs.txt';
  $alltags = json_decode( file_get_contents( $filename ), true );
  //$good_urls = "/picture/"; //гуд-слова в URL
  $good_cat = "/Picture Library/"; //гуд-слова в URL
  $final_json = array();
  foreach ( $alltags as $catalog ) {
    if ( preg_match( $good_cat, $catalog[ category ] ) ) {
      $title = $catalog[ title ];
      $title = str_replace( '_', ' ', $title );
      $doc[ $ifs ][ 'title' ] = $title;
      $item = array();
      $url = $catalog[ url ];
      if ( strpos( " ", $url ) !== false ) {
        $url = str_replace( " ", "%20", $url );
        if ( UR_exists( $url ) === false ) {
          echo $ifc . ") " . $url . " удалён как [404].<br>";
          continue;
        }
      }
      $info = pathinfo( $url );
      $put_wt = $info[ 'dirname' ];
      $put_wt_img = $info[ 'dirname' ];
      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put );
      $fname = $info[ 'basename' ];
      if ( strpos( " ", $fname ) !== false ) {
        $fname = str_replace( " ", "_", $fname );
      }
//      if ( $fname == "D1_MT8050iE_Meter.ecmp" ) {
//        $put_wt_img = "https://w1.weintek.com/Images/Download/Project";
//      }
      $img_name = explode( '.', $fname );
      $img_name = $info[ 'filename' ];
      if ( strpos( " ", $img_name ) !== false ) {
        $img_name = str_replace( " ", "_", $img_name );
      }
				  $img_name = preg_replace('"(\(sqr_y\))"', '(sqr_yl)', $img_name );
				  $img_name = preg_replace('"(Containers$)"', 'Container_1', $img_name );
				  $img_name = preg_replace('"(Containers_2)"', 'Container_2', $img_name );
				  $img_name = preg_replace('"(Mixers)"', 'Mixer', $img_name );
				  $img_name = preg_replace('"(Pipes$)"', 'pipes', $img_name );
				  $img_name = preg_replace('"(Pipes_12p)"', 'pipes_12p', $img_name );
				  $img_name = preg_replace('"(Process_Heating$)"', 'Process_heating', $img_name );
				  $img_name = preg_replace('"(Process_Heating_2)"', 'Process_heating_2', $img_name );
				  $img_name = preg_replace('"(motor_01)"', 'Motor_01', $img_name );
				  $img_name = preg_replace('"(Pipes_03)"', 'pipes_03', $img_name );
				  $img_name = preg_replace('"(Pipes_04)"', 'pipes_04', $img_name );
				  $img_name = preg_replace('"(Pipes_05)"', 'pipes_05', $img_name );
				  $img_name = preg_replace('"(Pipes_small_01)"', 'pipes_small_01', $img_name );
				  $img_name = preg_replace('"(Building_01)"', 'building_01', $img_name );
				  $img_name = preg_replace('"(Boiler_01)"', 'boiler_01', $img_name );
				  $img_name = preg_replace('"(Fan_01)"', 'fan_01', $img_name );
				  $img_name = preg_replace('"(Cooling_01)"', 'cooling_01', $img_name );
				  $img_name = preg_replace('"(Icon_01)"', 'icon_01', $img_name );
				  $img_name = preg_replace('"(Arrow_01)"', 'arrow_01', $img_name );
				  $img_name = preg_replace('"(Arrow_02)"', 'arrow_02', $img_name );
				  $img_name = preg_replace('"(Audo_Video_Small_01)"', 'audio_video_small_01', $img_name );
				  $img_name = preg_replace('"(Arrow_Small_01)"', 'arrow_small_01', $img_name );
				  $img_name = preg_replace('"(Arrow_Small_02)"', 'arrow_small_02', $img_name );
				  $img_name = preg_replace('"(Button_05)"', 'button_05', $img_name );
				  $img_name = preg_replace('"(Button_06)"', 'button_06', $img_name );
				  $img_name = preg_replace('"(Fire_Ice_01)"', 'fire_ice_01', $img_name );
				  $img_name = preg_replace('"(Hoppers_01)"', 'hoppers_01', $img_name );
      if ( UR_exists( $put_wt . '/' . $img_name . '.gif' ) !== false ) {
        $img_name = $img_name . ".gif";
      } elseif ( UR_exists( $put_wt . '/' . $img_name . '.jpg' ) !== false ) {
        $img_name = $img_name . ".jpg";
      } else {
        //echo $url . "<br>";
        $img_name = $img_name . ".na";
      }


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
        $file_data = "N/A";
      }
      $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
      if ( $timestamp != -1 ) {
        $file_data = $timestamp; //etc
      } else {
        $file_data = "N/A";
      }
      $filesize = curl_getinfo( $curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD );
      $filesizeKB = round( $filesize / 1024 );
      curl_close( $curl );
      $item = array( 'title' => $title, 'brand' => '', 'mod_data' => $file_data, 'image' => $img_name, 'url' => $catalog[ url ], 'category' => $catalog[ category ], 'label' => $label, 'put' => $put, 'put_wt' => $put_wt, 'put_wt_img' => $put_wt_img, 'fname' => $fname, 'size' => $filesize, 'description' => '' );
      array_push( $final_json, $item );
    }
  }
  unset( $alltags );
  $total_flt = count( $final_json );
  echo "Массив отфильтрован. Оставлены только библиотеки. (" . $total_flt . ")</br>";
  $time_tags_secs = microtime( true ) - $start;
  echo "<br>Получение массива заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  file_put_contents( $libs_filename, json_encode( $final_json, JSON_UNESCAPED_UNICODE ) );

  //////////////////// Скачивание документов ////////////////////////////

  echo "<h1>Скачивание файлов</h1>";
  $start_down = microtime( true );
  //$all_external_docs = $items;
  //$items = json_decode( file_get_contents( $all_external_docs ), true ); // Объединяем эти 3 массива
  $libs = array_values( $final_json );
  //unset( $items );
  echo "В массиве " . count( $libs ) . " файлов<br>";

  //echo $tmp_bufer;
  //file_put_contents( $all_downloaded_docs_filename, json_encode( $libs ) );
  if ( count( $libs ) > 2 ) {
    deleteFolder( $tmp_bufer );
  } else {
    echo "Входящий массив пуст";
    exit();
  }
	// проверяем входящий массив
   if ( is_dir( $tmp_bufer ) === false ) {
    mkdir( $tmp_bufer );
  }
  if ( is_dir( $img_bufer ) === false ) {
    mkdir( $img_bufer );
  }
 saveFiles( $libs, $tmp_bufer );
	// Enter the name of directory 
$pathdir = "tmp_bufer/";  
  
// Enter the name to creating zipped directory 
$zipcreated = $pathdir.'libs-by-rusavtomatika.com.zip'; 
  
// Create new zip class 
$zip = new ZipArchive; 
   
if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) { 
      
    // Store the path into the variable 
    $dir = opendir($pathdir); 
       
    while($file = readdir($dir)) { 
        if(is_file($pathdir.$file)) { 
            $zip -> addFile($pathdir.$file, $file); 
        } 
    } 
    $zip ->close(); 
} 

  //echo "Листинг каталога " . $tmp_bufer . ":<br>";
  //echo getcwd();
  //rscan( "/home/moisait/public_html/rusavto/documents__/tmp_bufer/" );
  $time_save_secs = microtime( true ) - $start_down;
  echo "Сохранение файлов заняло " . date( 'i мин s сек', $time_save_secs ) . "<br><hr>";
  //////////////////////// Upload документов на FTP ///////////////////////////	
  echo "<h1>Заливаем файлы на FTP (картинки)</h1>";
  $start_upload = microtime( true );
    $drv_work = array();
    $drv_final = array();
    $ftp_server = '82.202.162.16';
    $ftp_user_name = 'upload_olga@weblector.ru';
    $ftp_user_pass = 'olgaglr';

    //    $result = array();
    //    scan_folder( $tmp_bufer, $result );

    $conn_id = ftp_connect( $ftp_server );
    // проверяем доступность нашего FTP
    if ( false === $conn_id ) {
      echo "Невозможно соединиться с FTP-сервером<br>";
      mail( "maxbelousov@ya.ru", "Копирование библиотек", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
      $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
        ftp_pasv( $conn_id, true );
        ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 15 );
      //    Проверяем авторизацию
      if ( false === $login_result ) {
        echo "Ошибка авторизации на FTP<br>";
        mail( "maxbelousov@ya.ru", "Копирование библиотек", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
        exit();
      } else {
        //        перед копированием новых удаляем старые
        clean( $conn_id, $ftp_folder );
        ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
        deleteFolder( $tmp_bufer );
        ftp_close( $conn_id );
      }
    }

  //  unset( $result );
  $time_upload_secs = microtime( true ) - $start_upload;
  $time_total_secs = microtime( true ) - $start;
  echo "Upload библиотек занял " . date( 'i мин s сек', $time_upload_secs ) . "<br>";
  echo "Весь скрипт работал " . date( 'i мин s сек', $time_total_secs ) . "<br>";
}
?>
</body>
</html>