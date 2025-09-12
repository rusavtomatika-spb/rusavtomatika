<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Драйверы</title>
</head>

<body>
<h2>Получение драйверов: <? echo (date("H:i:s")); ?></h2>
<?php
//ini_set( 'error_reporting', E_ALL & ~E_NOTICE );
//error_reporting( E_ALL & ~E_NOTICE );
///// отправка лога ошибок на почту
//function error_alert( $type, $message, $file, $line, $vars ) {
//  $error = array(
//    'type' => $type,
//    'message' => $message,
//    'file' => $file,
//    'line' => $line
//  );
//  error_log( print_r( $error, true ), 1, 'maxbelousov@ya.ru', 'From: info@rusavtomatika.com' );
//}
//
//set_error_handler( 'error_alert' );
$start = microtime( true );
$drv_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers__/drv.txt';
$drv_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers__/drv_result.txt';
$com_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers__/companies.txt';
$com_raw_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers__/companies_raw.txt';
$drv_filename_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/weintek_drivers__/coms_jsons/';
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
  $drvs = file_get_contents( $drvs_url );
  $drvs = json_decode( $drvs, true );
    if (count($drvs) == 0) { 
        unset ($comps[ $key ]);
    };
}
    $comps = array_values($comps);
file_put_contents( $com_filename, json_encode( $comps ) );
//                    echo "<pre>";
//                    var_dump($comps);
//                    echo "</pre>";
$drv_json = array();
$json_name = array();
$i = 0;

function UR_exists( $url ) {
  $headers = get_headers( $url );
  return stripos( $headers[ 0 ], "200 OK" ) ? true : false;
}
foreach ( $comps as $com ) {
  $com_drv = $comps[ $i ][ 'brand' ];
  $com_drv4get = $comps[ $i ][ 'brand4get' ];
  $com_onewordbrand = $comps[ $i ][ 'onewordbrand' ];
  $com_drv_url = 'https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Mod&selVel=' . $com_drv4get;
  $json = file_get_contents( $com_drv_url );
  //$json_name = ${"com_drv_raw_$i"};
  $json_name = json_decode( $json, true );
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
    //              echo "<pre>";
    //              var_dump( $json_name );
    //              echo "</pre><hr>";
    $i++;
    if ( ( is_array( $json_name ) ) && ( count( $json_name ) > 0 ) ) {
      $drv_json = array_merge( $drv_json, $json_name );
    }
}
file_put_contents( $drv_result, json_encode( $drv_json ) );
//                  echo "<h2>Итог:</h2><pre>";
//                  var_dump( $drv_json );
//                  echo "</pre>";
$time_tags_secs = round( ( ( microtime( true ) - $start ) / 60 ), 2 );
echo "<br>Получение массива драйверов заняло " . $time_tags_secs . " мин<hr>";
//require 'drv2ftp.php';
?>
