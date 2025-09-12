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
//$query = "SELECT `name` FROM `catalog_series` WHERE `brand` regexp '(Weintek|Aplex|IFC|Samkoon)' AND `active` = '1' ORDER BY `name` ;";
$query = "SELECT `sys_name`,`id`,`name`,`linked_products`,`linked_types`,`linked_series`,`linked_brands` FROM `articles` WHERE `show` = '1' ORDER BY `id` ;";
//$query = "SELECT `code`,`id`,`name`,`linked_products`,`linked_types`,`linked_series`,`linked_brands` FROM `videos` WHERE `show` = '1' ORDER BY `id` ;";
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
//$arr = $outMysqlQuery;
//deep_unset_key( $arr, 'id' );
//deep_unset_key( $arr, 'brand	' );
//deep_unset_key( $arr, 'series' );
//deep_unset_key( $arr, 'position' );
//deep_unset_key( $arr, 'type' );
//deep_unset_key( $arr, 'version' );
//deep_unset_key( $arr, 'language' );
//deep_unset_key( $arr, 'date' );
//deep_unset_key( $arr, 'size' );
//$arr=array_values($arr);
//print_r($arr);
//echo '<hr>';
//print_r($arr);
$arr2 = array();
?>
<table border="1px" bordercolor="#eee" cellspacing="0" cellpadding="5px">
<thead>
	<th>ID</th>
	<th></th>
	<th>brands</th>
	<th>types</th>
	<th>series</th>
	<th>products</th>
</thead>

<?
foreach ( $arr as $k => $v ) {
  echo '<tr>';
	//echo '<td>'.$arr[ $k ][ 'id' ].'</td>';
	//echo $arr[ $k ][ 'name' ].'</br>';
  echo '<td>'.$arr[ $k ][ 'id' ].'</td>';
  echo '<td><a target="_new" href="https://www.rusavtomatika.com/articles/'.$arr[ $k ][ 'sys_name' ].'/" target="_new">'.$arr[ $k ][ 'name' ].'</a></td>';
  echo '<td>'.$arr[ $k ][ 'linked_brands' ].'</td>';
  echo '<td>'.$arr[ $k ][ 'linked_types' ].'</td>';
  echo '<td>'.$arr[ $k ][ 'linked_series' ].'</td>';
  echo '<td>'.$arr[ $k ][ 'linked_products' ].'</td>';
  echo '</tr>';
//    $arr[$k] ['name'] = $file_data;
//    $arr[$k] ['label'] = "";
//    unset($arr[$k]['date']);
	//array_push($arr2,$arr[ $k ][ 'id' ]);
}
//$arr2 = sort($arr2);
//$arr2 = array_unique($arr2);
//foreach($arr2 as $el){
//		echo $el.'</br>';
//
//}


//header( 'Content-type: text/javascript' );
//echo( json_encode( $arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
//file_put_contents( $plc_filename, json_encode( $arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
?></table>