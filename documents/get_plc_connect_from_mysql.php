<?php
// разовый скрипт для экспорта 'Руководства по подключению ПЛК' из БД в json
global $mysqli_db;
$host = "localhost"; // Имя хоста
$plc_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/PLC_Connect_Guide.txt';
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
$query = "SELECT * FROM `documents` WHERE `subSection` LIKE 'Руководства по подключению ПЛК' ORDER BY `documents`.`position` DESC, `documents`.`date` DESC ;";
$outMysqlStrings = [];
$outMysqlQuery = mysqli_query( $mysqli_db, $query )or die( "Invalid query: " . $query . "  " . mysqli_error( $mysqli_db ) );
$rows = mysqli_num_rows( $outMysqlQuery );
if ( $rows > 0 ) {
  for ( $row = 0; $row < $rows; $row++ ) {
    $current_row = mysqli_fetch_assoc( $outMysqlQuery );
    $outMysqlStrings[] = $current_row;
  }
} else {
  $outMysqlStrings = '';
};
function deep_unset_key( array &$data, string $key ) {
  if ( is_array( $data ) ) {
    unset( $data[ $key ] );
  }
  foreach ( $data as &$value ) {
    if ( is_array( $value ) ) {
      deep_unset_key( $value, $key );
    }
  }
}
$arr = $outMysqlStrings;
deep_unset_key( $arr, 'id' );
deep_unset_key( $arr, 'title_translate' );
deep_unset_key( $arr, 'url_ru' );
deep_unset_key( $arr, 'url_en' );
deep_unset_key( $arr, 'format' );
deep_unset_key( $arr, 'description' );
deep_unset_key( $arr, 'position' );
deep_unset_key( $arr, 'hash_local' );
deep_unset_key( $arr, 'candidate' );
deep_unset_key( $arr, 'original_file_name' );
foreach ( $arr as $k=>$v )
{
  $arr[$k] ['section'] = "plc";
  unset($arr[$k]['subSection']);
  $arr[$k] ['url'] = $arr[$k] ['original_url'];
  unset($arr[$k]['original_url']);
    $url = $arr[$k] ['url'];
    $curl = curl_init( $url );
    //Отказываемся от самой стр. Нам только заголовки
    curl_setopt( $curl, CURLOPT_NOBODY, true );
    //стопим вывод данных в stdout
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    //получаем дату крайней модификации файла
    curl_setopt( $curl, CURLOPT_FILETIME, true );
    $result = curl_exec( $curl );
    if ( $result === false ) {
      $file_data = "N/A";
    }
    $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
    if ( $timestamp != -1 ) {
      $file_data = date( "d.m.Y", $timestamp ); //etc
    } else {
      $file_data = "N/A";
    }
  $arr[$k] ['mod_data'] = $file_data;
  $arr[$k] ['label'] = "";
  unset($arr[$k]['date']);
}


header('Content-type: text/javascript');
echo( json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );
file_put_contents( $plc_filename, json_encode( $arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
?>