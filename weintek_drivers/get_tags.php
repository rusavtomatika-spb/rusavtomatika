<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Драйверы</title>
</head>

<body>
<h2>Получение драйверов: <? echo (date("H:i:s")); ?></h2>
<?php
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
  $item_br = $coms[ $key ][ Com ];
  $comps[ $key ][ 'brand' ] = $item_br;
  $item_b2g = str_replace([ ' ', '&' ], [ '+', '%26' ], $item_br );
  $comps[ $key ][ 'brand4get' ] = $item_b2g;
  $item_owbr = preg_replace( '/[^a-zA-Z\d]/ui', '', $item_b2g );
  $comps[ $key ][ 'onewordbrand' ] = strtolower($item_owbr);
}
file_put_contents( $com_filename, json_encode( $comps ) );
//                    echo "<pre>";
//                    var_dump($comps);
//                    echo "</pre>";
$drv_json = array();
$json_name = array();
$i = 0;
foreach ( $comps as $com ) {
  $com_drv = $comps[ $i ][ brand ];
  $com_drv4get = $comps[ $i ][ brand4get ];
  $com_onewordbrand = $comps[ $i ][ onewordbrand ];
  $com_drv_url = 'https://www.weintek.com/globalw/Software/getPLC2.aspx?selType=Mod&selVel=' . $com_drv4get;
  $json = file_get_contents( $com_drv_url );
  $json_name = $ {
    "com_drv_raw_$i"
  };
  $json_name = json_decode( $json, true );
  foreach ( $json_name as $key => $item ) {
    $json_name[ $key ][ 'brand' ] = $com_drv;
    $json_name[ $key ][ 'brand4get' ] = $com_drv4get;
    $json_name[ $key ][ 'onewordbrand' ] = $com_onewordbrand;
	$item_mod = $json_name[ $key ][ 'Model' ];
	$item_mod = preg_replace( '/(?<=,)(?! )/', ' ', $item_mod );
	$json_name[ $key ][ 'Model' ] = $item_mod;
  }
  //              echo "<pre>";
  //              var_dump( $json_name );
  //              echo "</pre><hr>";
  $i++;
  if ( ( is_array( $json_name ) ) && ( count( $json_name ) > 0 ) ) {
    $drv_json = array_merge( $drv_json, $json_name );
  } else {
    echo $com_drv . " не имеет драйверов<br>";
  }
}
file_put_contents( $drv_result, json_encode( $drv_json ) );
//                  echo "<h2>Итог:</h2><pre>";
//                  var_dump( $drv_json );
//                  echo "</pre>";
$time_tags_secs = round((( microtime( true ) - $start ) / 60),2);
echo "<br>Получение массива драйверов заняло " . $time_tags_secs . " мин<hr>";
require 'drv2ftp.php';
?>
</body>
</html>