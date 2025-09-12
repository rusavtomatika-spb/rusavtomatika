<?php
// разовый скрипт для экспорта 'Руководства по подключению ПЛК' из БД в json
global $mysqli_db;
$host = "localhost"; // Имя хоста
$plc_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/tmp_pr_files.txt';
$port = "3307"; // Номер порта, 3306 - по умолчанию
$user = "root"; // Имя пользователя
$pass = '123456'; // Пароль
$dbnm = "rusavtomatika_db"; // Имя БД
$mysqli_db = mysqli_connect( $host, $user, $pass, $dbnm );
if ( !$mysqli_db ) {
  echo "[inc_database_credentials.php]" . PHP_EOL;
  echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
  echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
  exit();
} else mysqli_query( $mysqli_db, "SET NAMES utf8" );
mysqli_query( $mysqli_db, "SET NAMES utf8" );
header( 'Content-Type: text/html; charset=utf-8' );
$query = "SELECT * FROM `products_files` ORDER BY `id` ;";
//$query = "UPDATE _tmpproducts_files SET path=LOWER(path); ;";
$outMysqlStrings = [];
$outMysqlQuery = mysqli_query( $mysqli_db, $query )or die( "Invalid query: " . $query . "  " . mysqli_error( $mysqli_db ) );
//exit();
$rows = mysqli_num_rows( $outMysqlQuery );
if ( $rows > 0 ) {
  for ( $row = 0; $row < $rows; $row++ ) {
    $current_row = mysqli_fetch_assoc( $outMysqlQuery );
    $outMysqlStrings[] = $current_row;
  }
} else {
  $outMysqlStrings = '';
};

function deep_unset_key( array & $data, string $key ) {
  if ( is_array( $data ) ) {
    unset( $data[ $key ] );
  }
  foreach ( $data as & $value ) {
    if ( is_array( $value ) ) {
      deep_unset_key( $value, $key );
    }
  }
}
$arr = $outMysqlStrings;
//deep_unset_key( $arr, 'annotation' );
//deep_unset_key( $arr, 'brand	' );
//deep_unset_key( $arr, 'series' );
//deep_unset_key( $arr, 'position' );
//deep_unset_key( $arr, 'type' );
//deep_unset_key( $arr, 'version' );
//deep_unset_key( $arr, 'language' );
//deep_unset_key( $arr, 'date' );
//deep_unset_key( $arr, 'size' );
?>
<table>
<thead>
	<th>ID</th>
	<th>Name</th>
	<th>Path</th></thead>
<?
foreach ( $arr as $k => $v ) {
  echo '<tr>';
	echo '<td>'.$arr[ $k ][ 'id' ];
	echo '</td><td>'.$arr[ $k ][ 'name' ];
  echo '</td><td><a href="'.$arr[ $k ][ 'path' ].'" target="_new">'.$arr[ $k ][ 'path' ];
  echo '</a></td></tr>';
  //  $arr[$k] ['name'] = $file_data;
  //  $arr[$k] ['label'] = "";
  //  unset($arr[$k]['date']);
}


header( 'Content-type: text/javascript' );
//echo( json_encode( $arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
file_put_contents( $plc_filename, json_encode( $arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
?></table>