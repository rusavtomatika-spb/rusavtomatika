<?php
//require_once $_SERVER[ "DOCUMENT_ROOT" ] . '/admin/products_all/config_ftp.php';
//putenv('TMPDIR=/test/');
global $ftpConnectionID,$FTP_SERVER,$FTP_USER_NAME,$FTP_USERPASS;

function debug_to_console( $data ) {
  $output = $data;
  if ( is_array( $output ) )
    $output = implode( ',', $output );
  echo "<script>console.log('" . $output . "' );</script>";
}
//ftp_close( $ftpConnectionID );
//if ( $ftpConnectionID == null ) {
//  connectToFTP();
//} else {
//	disconnectFTP( $ftpConnectionID );
//}

function connectToFTP() {
global $ftpConnectionID,$FTP_SERVER,$FTP_USER_NAME,$FTP_USERPASS;
$FTP_SERVER = '82.202.162.16';
$FTP_USER_NAME= 'upload_olga@weblector.ru';
$FTP_USERPASS= 'olgaglr';
$FTP_ROOT_PATH= '/images/';
  $ftpConnectionID = ftp_connect( '82.202.162.16', 21 );
  if ( is_resource( $ftpConnectionID ) ) {
    //$login_result = ftp_login($ftpConnectionID, FTP_USER_NAME, FTP_USERPASS);
    $login_result = ftp_login( $ftpConnectionID, 'upload_olga@weblector.ru', 'olgaglr' );
    ftp_set_option( $ftpConnectionID, FTP_USEPASVADDRESS, false );
    ftp_pasv( $ftpConnectionID, true )or die( 'Не могу включить пассив<br>' );
	//echo ftp_pasv( $ftpConnectionID, true ) ? 'ftp_pasv - TRUE<br>':'ftp_pasv - Не могу включить пассивный режим<br>';
    ftp_set_option($ftpConnectionID, FTP_TIMEOUT_SEC, 10); // Устанавливаем таймаут в 15 секунд
    if ( true === $login_result ) {
      //echo 'Зашёл!<br>';
    } else {
      echo 'Авторизация не пройдена<br>';
      throw new Exception( 'Unable to log in' );
    } 
    //ftp_set_option($ftpConnectionID, FTP_USEPASVADDRESS, true);
    //ftp_set_option( $ftpConnectionID, FTP_TIMEOUT_SEC, 30 );
	  if ( ( !$ftpConnectionID ) || ( !$login_result ) ) {
      throw new Exception( 'FTP connection has failed!' );
      echo "FTP connection has failed!";
      echo "Attempted to connect to 82.202.162.16 for user: upload_olga@weblector.ru";
      exit;
    } else {
      //debug_to_console( "Соединился" );
      return true;
    }
  } else {
    throw new Exception( 'FTP connection has failed!' );
    echo "FTP connection has failed!";
    echo "Attempted to connect to 82.202.162.16 for user: upload_olga@weblector.ru";
    exit;
  }
}

function disconnectFTP() {

  global $ftpConnectionID;
  ftp_close( $ftpConnectionID );
}

function getRemoteFTPImagesHtml( $arProduct ) {
  global $ftpConnectionID;
      //var_dump($arProduct);
  //    return "";*/
  global $db_work;
  if ( !isset( $db_work ) ) {
    $db_work = new DBWORK();
  }
  $model_secured = str_replace( "/", "_", $arProduct[ "model" ] );
  $model_secured = str_replace( " ", "_", $model_secured );
  $model_secured = str_replace( "®", "_", $model_secured );

  $imgRemoteDir = "/images/" . strtolower( $arProduct[ "brand" ] )
    . "/" . strtolower( $arProduct[ "type" ] )
    . "/{$model_secured}/lg/";
  $imgPathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/" . strtolower( $arProduct[ "type" ] )
    . "/{$model_secured}/lg/";
  //    if ($ftpConnectionID) {
  //		        //debug_to_console( "ftpConnectionID: ".$ttt);
  //        $files = ftp_nlist($ftpConnectionID, $imgRemoteDir);
  //		var_dump($files);
  //		exit();
  //    }else{
  //        var_dump($ftpConnectionID);
  //    }
  // Проверяем состояние соединения
  try {
    if ( $ftpConnectionID ) {
      //debug_to_console( "Соединился.111");
      //echo ftp_systype($ftpConnectionID).'---';
      $files = ftp_nlist( $ftpConnectionID, $imgRemoteDir );
      //echo ftp_nlist($ftpConnectionID, $imgRemoteDir).'<br>';
      //            var_dump($files);
      //			ftp_close($ftpConnectionID);
    } else {
      throw new Exception( 'FTP connection is not established.' );
      debug_to_console( "FTP connection is not established." );
    }
  } catch ( Exception $e ) {
    // Если произошла ошибка, переподключаемся
    connectToFTP();

    // Еще раз пробуем получить список файлов
    if ( $ftpConnectionID ) {
      debug_to_console( "Соединился.222" );
      $files = ftp_nlist( $ftpConnectionID, $imgRemoteDir );
    } else {
      // Если снова ошибка, выводим сообщение
      var_dump( $ftpConnectionID );
      return "";
    }
  }
  //exit();
  $out = '';
  if ( is_array( $files ) ) {

    $counter = 0;
    foreach ( $files as $file ) {
      $pos_png = strpos( $file, ".png" );
      if ( $pos_png === false ) {
        continue;
      } else {
        $counter++;
        //$out.="<span><img src='".$imgPathURL.$file."' /></span>";
        $out .= "<span>.</span>";
      }
    }
    if ( $counter > 0 ) {
      $out .= "<span> " . $counter . " </span>";
      $db_work->update_pics_number( $arProduct[ "model" ], $counter );
				file_put_contents( 'tmp.txt', $counter );

    }
  }
  return $out;
	disconnectFTP();
}

function getImagesHtml( $arProduct ) {
  $model_secured = str_replace( "/", "_", $arProduct[ "model" ] );
  $model_secured = str_replace( " ", "_", $model_secured );
  $model_secured = str_replace( "®", "_", $model_secured );


  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $imgPathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $files = scandir( $imgPathDir );
  $out = '';
  foreach ( $files as $file ) {
    $pos_png = strpos( $file, ".png" );
    if ( $pos_png === false ) {
      continue;
    } else {
      $out .= "<span><img src='" . $imgPathURL . $file . "' /></span>";
    }
  }
  return $out;
}

function getImagesArray( $arProduct ) {
  $model_secured = str_replace( "/", "_", $arProduct[ "model" ] );
  $model_secured = str_replace( " ", "_", $model_secured );
  $model_secured = str_replace( "®", "_", $model_secured );

  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $imgPathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $files = scandir( $imgPathDir );
  $out = '';
  foreach ( $files as $file ) {
    $pos_png = strpos( $file, ".png" );
    if ( $pos_png === false ) {
      continue;
    } else {
      $out[] = $imgPathURL . $file;
    }
  }
  return $out;
}

function getImagesFullArray( $arProduct ) {

  $model_secured = str_replace( "/", "_", $arProduct[ "model" ] );
  $model_secured = str_replace( " ", "_", $model_secured );
  $model_secured = str_replace( "®", "_", $model_secured );


  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $imgPathDir_1330 = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/1330/";

  $imgPathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  $img_MD_PathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/md/";
  $img_130_PathURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/130/";
  $imgPathToBigURL = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/1330/";


  if ( !file_exists( $imgPathDir_1330 ) ) {
    return array();
  }

  $files = scandir( $imgPathDir_1330 );
  $out = [];
  foreach ( $files as $file ) {
    $extension = pathinfo( $file )[ 'extension' ];
    if ( $extension != "png" ) {
      continue;
    } else {
      $fileNameWEBP = substr( $file, 0, strrpos( $file, '.' ) ) . ".webp";
      $out[] = array(
        "sm" => $imgPathURL . $file,
        "md" => $img_MD_PathURL . $file,
        "lg" => $imgPathToBigURL . $fileNameWEBP,
        "130" => $img_130_PathURL . $fileNameWEBP
      );
    }
  }
  return $out;
}

function process_product_pictures( $arProduct ) {
  $model_secured = str_replace( "/", "_", $arProduct[ "model" ] );
  $model_secured = str_replace( " ", "_", $model_secured );
  $model_secured = str_replace( "®", "_", $model_secured );
  $model_secured = strtolower( $model_secured );


  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/";
  rename_files_in_folder( $imgPathDir, '', $model_secured );

  $imgPathDirRemoteFTP = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/" . strtolower( $arProduct[ "type" ] ) . "/{$model_secured}/lg/";
  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/lg/";
  rename_files_in_folder( $imgPathDir, $imgPathDirRemoteFTP, $model_secured );

  $imgPathDirRemoteFTP = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/" . strtolower( $arProduct[ "type" ] ) . "/{$model_secured}/sm/";
  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/sm/";
  rename_files_in_folder( $imgPathDir, $imgPathDirRemoteFTP, $model_secured );

  $imgPathDirRemoteFTP = "/images/" . strtolower( $arProduct[ "brand" ] ) . "/" . strtolower( $arProduct[ "type" ] ) . "/{$model_secured}/md/";
  $imgPathDir = $_SERVER[ "DOCUMENT_ROOT" ] . "/images/" . strtolower( $arProduct[ "brand" ] ) . "/{$arProduct["type"]}/{$model_secured}/md/";
  rename_files_in_folder( $imgPathDir, $imgPathDirRemoteFTP, $model_secured );

  //$imgPathURL = "/images/" . strtolower($arProduct["brand"]) . "/{$arProduct["type"]}/{$model_secured}/lg/";

  return;
}

function rename_files_in_folder( $imgPathDir, $imgPathDirRemoteFTP, $model ) {
  global $ftpConnectionID;
  if ( !file_exists( $imgPathDir ) ) {
    return;
  }

  $files = scandir( $imgPathDir );
  $arr_files = [];
  foreach ( $files as $file ) {
    //        $pos_png = strpos($file, ".png");
    $path_parts = pathinfo( $file );
    if ( !( isset( $path_parts[ 'extension' ] )and $path_parts[ 'extension' ] == 'png' ) ) {
      continue;
    } else {
      $arr_files[] = $file;
    }
  }
  sort( $arr_files );
  $counter = 1;
  $arr_renames = [];
  foreach ( $arr_files as $file ) {
    $num = substr( $file, 0, strrpos( $file, '.' ) );
    $num = substr( $num, strrpos( $num, '_' ) + 1 );
    if ( $counter != intval( $num ) ) {
      $arr_renames[] = array( "from" => $num, "to" => $counter );
    }
    $counter++;
  }

  foreach ( $arr_renames as $rename ) {
    rename( $imgPathDir . $model . "_" . $rename[ "from" ] . ".png", $imgPathDir . $model . "_" . $rename[ "to" ] . ".png" );
    if ( $ftpConnectionID != null and $imgPathDirRemoteFTP != '' ) {
      $result = ftp_rename( $ftpConnectionID, $imgPathDirRemoteFTP . $model . "_" . $rename[ "from" ] . ".png", $imgPathDirRemoteFTP . $model . "_" . $rename[ "to" ] . ".png" );
      if ( !$result )echo $imgPathDirRemoteFTP . $model . "_" . $rename[ "from" ] . ".png <br>";
    }
  }
}