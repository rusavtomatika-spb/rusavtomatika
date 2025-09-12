<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update demo</title>
</head>

<body>
<h1>Обновление раздела "Демо проекты и макросы"</h1>
<p><? echo (date("H:i:s")); ?></p>
<br>
<br>
<form id="frm" method="post"  action="?action" >
  <input type="submit" value="НАЧАТЬ ОБНОВЛЕНИЕ" id="submit" />
</form>
<?php
if ( isset( $_GET[ 'action' ] ) ) {
  ini_set( 'max_execution_time', 919500 );
  ini_set( "memory_limit", "512M" );
  /////////////////// Функции и классы ///////////////////////////////	


  function saveFiles( $docs, $destination ) {
    global $final_json;
    global $tmp_bufer;
    global $pack_folder;
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
      $dest_path2pack = $pack_folder . $filename;
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
        make_path( $arr_folders, $tmp_bufer );
        if ( UR_exists( $src_url ) !== false ) {
          file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          $ifc++;
        }
      } else {
        if ( UR_exists( $src_url ) !== false ) {
          file_put_contents( $dest_path2file, file_get_contents( $src_url ) );
          $ifc++;
        }
      }
      if ( preg_match( '/\.package$/', $filename ) ) {
        if ( UR_exists( $src_url ) !== false ) {
          file_put_contents( $dest_path2pack, file_get_contents( $src_url ) );
        }
      }

      if ( UR_exists( $img_url ) !== false ) {
        //		echo $dest_path2img."<br>";
        //echo '<a href="' . $img_url . '" target="_new">' . $img_url . '</a><br>';
        file_put_contents( $dest_path2img, file_get_contents( $img_url ) );
      } else {
        echo 'SD: <a href="' . $img_url . '" target="_new">' . $img_url . '</a> <a target="_new" href="'.$url.'">src</a><br>';

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
          echo "rscan1: {$ff}<br>";
          $ifs++;
        }
        if ( is_dir( $dir . $ff ) ) {
          echo "rscan2: <b>[{$ff}]</b><br>";
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
    global $img_bufer;
    global $arc_projects;
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
      if ( ( $folderPath != $tmp_bufer )AND( $folderPath != $img_bufer )AND( $folderPath != $arc_projects ) ) {
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
      if ( ( $file != '/projects/' )AND( $file != '/projects/arc_projects/' ) )ftp_rmdir( $conn, $file );
    } else {
      ftp_delete( $conn, $file );
    }
  }

  function ftp_putAll( $conn_id, $src_dir, $dst_dir ) {
    $d = dir( $src_dir );
    while ( $file = $d->read() ) {
      if ( $file != "." && $file != ".." ) {
        if ( is_dir( $src_dir . "/" . $file ) ) {
          if ( !@ftp_chdir( $conn_id, $dst_dir . "/"  . $file ) ) {
            ftp_mkdir( $conn_id, $dst_dir . "/"  . $file );
          }
          ftp_putAll( $conn_id, $src_dir . "/" . $file, $dst_dir . "/"  . $file );
        } else {
          $upload = ftp_put( $conn_id, $dst_dir . "/"  . $file, $src_dir . "/" . $file, FTP_BINARY );
			echo $dst_dir . "/"  . $file .($upload ? '----OK2<br>' : ' <span style="color: red;">ERROR2</span> ftp_putAll<br>' );
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
  echo "<h1>Формируем массив проектов</h1>";

  $demos_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects/';
  $pack_folder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/download/soft/';
  $filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/availableTags.txt';
  $ftp_folder = '/projects/';
  file_put_contents( $demos_folder . "error_log", "" );
  $tmp_bufer = $demos_folder . 'tmp_bufer/';
  $img_bufer = $demos_folder . 'tmp_bufer/images/';
  $arc_projects = $demos_folder . 'tmp_bufer/arc_projects/';
  $demos_filename = $demos_folder . 'pr.txt';
  $alltags = json_decode( file_get_contents( $filename ), true );
  //$good_urls = "/picture/"; //гуд-слова в URL
  $good_cat = "/Demo Project/"; //гуд-слова в URL
  $final_json = array();
  foreach ( $alltags as $catalog ) {
    if ( preg_match( $good_cat, $catalog[ category ] ) ) {
      $title = $catalog[ title ];
      $title = str_replace( '_', ' ', $title );
      $title = preg_replace( '/(\(([\w\/ ]{20,})\))/i', '', $title );
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

      $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put_wt );
      $fname = $info[ 'basename' ];
      if ( strpos( " ", $fname ) !== false ) {
        $fname = str_replace( " ", "_", $fname );
      }
      if ( $fname == "D1_MT8050iE_Meter.ecmp" ) {
        $put_wt_img = "https://w1.weintek.com/Images/Download/Project";
      }
      $img_name = explode( '.', $fname );
      $img_name = $img_name[ 0 ];
      if ( strpos( " ", $img_name ) !== false ) {
        $img_name = str_replace( " ", "_", $doc[ 'image' ] );
      }
      $img_name = preg_replace( '"(Window_Title_Bar)"', 'window_title_bar', $img_name );
      $img_name = preg_replace( '"(Trend_Dynamic_Interval)"', 'Trend_dynamic_interval', $img_name );
      $img_name = preg_replace( '"(Demo_Operation_Log)"', 'Demo_Operation_log', $img_name );
      $img_name = preg_replace( '"(PATLITE_LED)"', 'PATLITE_800x480', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_1024x600_8102)"', 'mt_iE_demo_8102iE', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_480x272)"', 'mt_iE_demo_800x480', $img_name );
      $img_name = preg_replace( '"(MT8090XE_demo_1024x768)"', 'MT8000XE_demo', $img_name );
      $img_name = preg_replace( '"(MT8092XE_demo_1024x768)"', 'MT8000XE_demo', $img_name );
      //      $img_name = preg_replace( '"(D1_MT8050iE_Meter)"', 'mt_iE_demo_800x480', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_800x480_8073)"', 'mt_iE_demo_800x480', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_800x480_8071_8072)"', 'mt_iE_demo_800x480', $img_name );
      //      $img_name = preg_replace( '"(emt_demo_800x480)"', 'emt_demo', $img_name );
      $img_name = preg_replace( '"(emt_demo_800x600)"', 'emt_demo', $img_name );
      $img_name = preg_replace( '"(emt_demo_1024x768)"', 'emt_demo', $img_name );
      $img_name = preg_replace( '"(emt_demo_800x480)"', 'emt_demo', $img_name );
      $img_name = preg_replace( '"(cmt3151_demo)"', 'cmt_svr_demo', $img_name );
      $img_name = preg_replace( '"(MT8072iP_Demo_800x480)"', 'MT8072iP', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_8103iE)"', 'mt_iE_demo_8102iE', $img_name );
      $img_name = preg_replace( '"(mt_iE_demo_1024x600_8103)"', 'mt_iE_demo_8102iE', $img_name );
      $img_name = preg_replace( '"(Continue_Beep)"', 'Continue_beep', $img_name );
      $img_name = preg_replace( '"(Topvert)"', 'TOPVERT', $img_name );
      $img_name = preg_replace( '"(Screen_Saver_with_Password)"', 'screen_saver_with_password', $img_name );
      $img_name = preg_replace( '"(Macro_find_event_date)"', 'macro_find_event_date', $img_name );
      $img_name = preg_replace( '"(Macro_find_event_index)"', 'macro_find_event_index', $img_name );
      $img_name = preg_replace( '"(Macro_Trace)"', 'macro_trace', $img_name );
      $img_name = preg_replace( '"(Macro_mathematical)"', 'macro_mathematical', $img_name );
      $img_name = preg_replace( '"(Macro_data_transformation)"', 'macro_data_transformation', $img_name );
      $img_name = preg_replace( '"(Recipe_Search)"', 'recipe_search', $img_name );
      $img_name = preg_replace( '"(Station_Variable)"', 'station_variable', $img_name );
      $img_name = preg_replace( '"(e_Mail)"', 'e_mail', $img_name );
      $img_name = preg_replace( '"(Allen_Bradley_EtherNetIP_DF1)"', 'MicroLogix1100_EthernetIP', $img_name );
      $img_name = preg_replace( '"(Mitsubishi_MELSEC_QL_Binary_Mode)"', 'MT8000i_Q03UDE', $img_name );
      $img_name = preg_replace( '"(SAIA_SBUS_Ethernet)"', 'SAIA', $img_name );
      $img_name = preg_replace( '"(Modbus_Server)"', 'Demo_Modbus_Server', $img_name );
      $img_name = preg_replace( '"(MT8106iP_Demo_1024x600)"', 'MT8072iP', $img_name );
      $img_name = preg_replace( '"(DEM24003_CODESYS_Access_HMI_Over_ModbusTCP_Demo)"', 'DEM22008_CODESYS_ModbusServer_Demo', $img_name );
      $img_name = preg_replace( '"(Enhanced_Security)"', 'enhanced_security', $img_name );
      $img_name = preg_replace( '"(DEM19001_iR_Application_Oven_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM19004_iR_Application_JOG_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM19005_iR_Application_Positioning_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM20006_iR_Application_PU_PWM_Inverter_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM20007_CODESYS_Library_SysTimeRtc_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM20008_CODESYS_Library_SysFile_SysDir_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM20010_CODESYS_SDcard_Access_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM21001_CODESYS_RawValue_to_EngineeringValue_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM21002_iR-PU01-P_CAM_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM21004_iR_ETN_PU_Configuration_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM21006_iR_Application_PU_SimpleCounter_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM22004_HMI_CODESYS_iR-ETN40R_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM22006_CODESYS_TCP_Socket_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM22008_CODESYS_ModbusServer_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM23002_CODESYS_Recipe_Manager_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM24001_iR-ETN40P_High_Speed_Output_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(DEM24003_CODESYS_Access_HMI_Over_ModbusTCP_Demo)"', 'CODESYS&RemoteIO', $img_name );
      $img_name = preg_replace( '"(cMT1106X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2058XH)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2078X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2108X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2128X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2158X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT2166X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3072XH)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3072XP)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3072X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3092X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3102X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3108XH)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3108XP)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3152X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT3162X)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT_FHDX_820)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(cMT_SVRX_820)"', 'cMTX', $img_name );
      $img_name = preg_replace( '"(MT8052iP)"', 'MT8072iP', $img_name );
      $img_name = preg_replace( '"(MT8106iP)"', 'MT8072iP', $img_name );
      if ( UR_exists( $put_wt . '/' . $img_name . '.png' ) !== false ) {
        $img_name = $img_name . ".png";
      } elseif ( UR_exists( $put_wt . '/' . $img_name . '.jpg' ) !== false ) {
        $img_name = $img_name . ".jpg";
      } else {
        echo $url . "<br>";
        $img_name = $img_name . ".na";
      }

      $label = $catalog[ label ];
      if ( strpos( $label, 'HMI_Sample' ) !== false ) {
        $section = 'Демо проекты';
        $section_get = 'HMI_Sample';
      } elseif ( strpos( $label, 'Part_Sample' ) !== false ) {
        $section_get = 'Part_Sample';
        $section = 'Объекты EBPro';
      } elseif ( strpos( $label, 'PLC_Sample' ) !== false ) {
        $section_get = 'PLC_Sample';
        $section = 'ПЛК(PLC)';
      } elseif ( strpos( $label, 'Macro_Sample' ) !== false ) {
        $section_get = 'Macro_Sample';
        $section = 'Макросы';
      } elseif ( strpos( $label, 'System_Sample' ) !== false ) {
        $section_get = 'System_Sample';
        $section = 'Функции, примеры решения задач';
      } elseif ( strpos( $label, 'Application_sample' ) !== false ) {
        $section_get = 'Application_sample';
        $section = 'Комплексные примеры проектов';
      } elseif ( strpos( $label, 'CODESYS_Sample' ) !== false ) {
        $section_get = 'CODESYS_Sample';
        $section = 'CODESYS и модули ввода-вывода';
      } else $section = '';

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
      $item = array( 'title' => $title, 'mod_data' => $file_data, 'section' => $section, 'section_get' => $section_get, 'image' => $img_name, 'url' => $catalog[ url ], 'category' => $catalog[ category ], 'label' => $label, 'put' => $put, 'put_wt' => $put_wt, 'put_wt_img' => $put_wt_img, 'fname' => $fname, 'size' => $filesize, 'description' => '' );
      array_push( $final_json, $item );
    }
  }
  unset( $alltags );
  $total_flt = count( $final_json );
  echo "Массив отфильтрован. Оставлены только проекты и макросы. (" . $total_flt . ")</br>";

  $time_tags_secs = microtime( true ) - $start;
  echo "<br>Получение массива заняло " . date( 'i мин s сек', $time_tags_secs ) . "<hr>";
  ////////////////////// берём русское описание с РА /////////////////////
  $demos = json_decode( file_get_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_projects/demo_mysql.txt' ), true );
  $i = 0;
  foreach ( $final_json as $k => $v ) {
    $query = $final_json[ $k ][ fname ];
    $ind = array_search( $query, array_column( $demos, 'fname' ) );
    if ( $ind !== false ) {
      //    echo $ind."<br>";
      $rtext = $demos[ $ind ][ stext ];
      $stext = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $rtext );
      $final_json[ $k ][ stext ] = $stext;
      unset( $query );
      $i++;
    } else {
      $final_json[ $k ][ stext ] = '';
    }
  }
  file_put_contents( $demos_filename, json_encode( $final_json, JSON_UNESCAPED_UNICODE ) );
  //exit();
  //////////////////// Скачивание документов ////////////////////////////

  echo "<h1>Скачивание файлов</h1>";
  $start_down = microtime( true );
  //$all_external_docs = $items;
  //$items = json_decode( file_get_contents( $all_external_docs ), true ); // Объединяем эти 3 массива
  $final_json = array_values( $final_json );
  //unset( $items );
  echo "В массиве " . count( $final_json ) . " файлов<br>";

  //echo $tmp_bufer;
  //file_put_contents( $all_downloaded_docs_filename, json_encode( $demos ) );
  if ( count( $final_json ) > 2 ) {
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
  saveFiles( $final_json, $tmp_bufer );
  //echo "Листинг каталога " . $tmp_bufer . ":<br>";
  //echo getcwd();
  //rscan( "/home/moisait/public_html/rusavto/documents__/tmp_bufer/images/" );
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
    mail( "maxbelousov@ya.ru", "Копирование проектов", "Невозможно соединиться с FTP-сервером", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
    exit();
  } else {
    $login_result = ftp_login( $conn_id, $ftp_user_name, $ftp_user_pass );
    //    Проверяем авторизацию
    if ( false === $login_result ) {
      echo "Ошибка авторизации на FTP<br>";
      mail( "maxbelousov@ya.ru", "Копирование проектов", "Ошибка авторизации на FTP", "From: rusvtomatika.com <noreply@rusvtomatika.com>" );
      exit();
    } else {
        ftp_pasv( $conn_id, true ) or die("Unable switch to passive mode");
        ftp_set_option( $conn_id, FTP_TIMEOUT_SEC, 10000 );
      //        перед копированием новых удаляем старые
      //clean( $conn_id, $ftp_folder );
      ftp_putAll( $conn_id, $tmp_bufer, $ftp_folder );
      //deleteFolder( $tmp_bufer );
      ftp_close( $conn_id );
    }
  }
  //  unset( $result );
  $time_upload_secs = microtime( true ) - $start_upload;
  $time_total_secs = microtime( true ) - $start;
  echo "Upload проектов занял " . date( 'i мин s сек', $time_upload_secs ) . "<br>";
  echo "Весь скрипт работал " . date( 'i мин s сек', $time_total_secs ) . "<br>";
}
?>
</body>
</html>