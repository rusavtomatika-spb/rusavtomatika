<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>01 Сбор</title>
</head>

<body>
<h2>Обновление раздела Документы</h2>
<?php
ini_set( 'max_execution_time', 500 );
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );
$start = microtime( true );
// путь на проде: /home/weblec/public_html/rusavtomatika.com
$filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/availableTags.txt';
$docs_wt_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/docs_wt_result.txt';
$plc_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/PLC_Connect_Guide.txt';
$ra_filename = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/ra-docs.txt';
$docs_result = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents__/docs_result.txt';
$theUrl = 'https://www.weintek.com/globalw/Download/Download.aspx';
$src = file_get_contents( $theUrl );
print( "Массив с сайта WEINTEK.COM получен</br>" );
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
print( "Массив с сайта WEINTEK.COM обработан</br>" );
file_put_contents( $filename, $tags );
//$headers = get_headers( $url, 1 );
print( "Массив с сайта WEINTEK.COM записан в файл availableTags.json</br>" );
$tags_json = file_get_contents( $filename );
$alltags = json_decode( $tags_json, true );
$bad_words = "/(Chinese|japanese|HMI Pin Assignment|RoHS)/i"; //стоп-слова в названии
$bad_urls = "/(cht|jap|jpn|_jpn|_cht|_tw|_jp|MT500|.zip|.apk|.package|.cmtp|.ccmp|.ecmp|.rar|.dwg|.bin|.emtp|.htm)/i"; //стоп-слова в URL
$good_urls = "/(EBPro|EasyAccess20|cMT|MT8000iP|MT8000iE|mTV|eMT3000|iR|FAQ)/"; //гуд-слова в URL
$good_cat = "/Document/"; //гуд-слова в URL
$final_json = array();
foreach ( $alltags as $catalog ) {
  if ( ( !preg_match( $bad_words, $catalog[ title ] ) ) & ( !preg_match( $bad_urls, $catalog[ url ] ) ) & ( preg_match( $good_cat, $catalog[ category ] ) ) ) {
    $title = str_replace( "_", " ", $catalog[ title ] );
    $item = array();
    $url = $catalog[ url ];
    $info = pathinfo( $url );
    $put = $info[ 'dirname' ];
    $put = preg_replace( '/^(https?:\/\/dl.weintek.com\/public\/|http?:\/\/dl.weintek.com\/public\/|ftps?:\/\/dl.weintek.com\/public\/)/', '', $put );
    $fname = $info[ 'basename' ];
    $label = $catalog[ label ];
    $curl = curl_init( $catalog[ url ] );
    //Отказываемся от самой стр. Нам только заголовки
    curl_setopt( $curl, CURLOPT_NOBODY, true );
    //стопим вывод данных в stdout
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    //получаем дату крайней модификации файла
    curl_setopt( $curl, CURLOPT_FILETIME, true );
    $result = curl_exec( $curl );
    if ( $result === false ) {
      continue;
    }
    $timestamp = curl_getinfo( $curl, CURLINFO_FILETIME );
    if ( $timestamp != -1 ) {
      $file_data = date( "d.m.Y", $timestamp ); //etc
    } else {
      $file_data = "N/A";
    }
    curl_close( $curl );
    if ( preg_match( "/DocumentEB/", $label ) ) {
      $section = "ebpro";
    } else if ( preg_match( "/EasyAccess/", $label ) ) {
      $section = "ea20";
    } else if ( preg_match( "/cMT[0-9]{3}/", $label ) ) {
      $section = "cmt";
    } else if ( preg_match( "/MT8[0-9]{3}iP/", $label ) ) {
      $section = "mt8000ip";
    } else if ( preg_match( "/MT8[0-9]{3}iE/", $label ) ) {
      $section = "mt8000ie";
    } else if ( preg_match( "/mTV-[0-9]{3}/", $label ) ) {
      $section = "mtv";
    } else if ( preg_match( "/eMT3[0-9]{3}/", $label ) ) {
      $section = "emt3000";
    } else if ( preg_match( "/\/iR\//", $url ) ) {
      $section = "moduli";
    } else if ( preg_match( "/DocumentFAQ/", $label ) ) {
      $section = "faq";
    } else {
      $section = "";
    }
    $item = array( 'title' => $title, 'brand' => '', 'mod_data' => $file_data, 'url' => $catalog[ url ], 'put' => $put, 'fname' => $fname, 'category' => $catalog[ category ], 'section' => $section, 'label' => $label );
    array_push( $final_json, $item );
  }
}
print( "Массив отфильтрован. Оставлены только документы.</br>" );
//echo( json_encode($final_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );
$ra_items = json_decode( file_get_contents( $ra_filename ), true ); // JSON с нашими документами
$plc_items = json_decode( file_get_contents( $plc_filename ), true ); // JSON с "Руководства по подключению ПЛК". Большинства из них уже нет в массиве weintek.com
//$items = array_merge( $final_json, $ra_items, $plc_items ); // $plc_items - это по сути драйверы
$items = array_merge( $final_json, $ra_items ); // Объединяем эти 2 массива. Без драйверов
file_put_contents( $docs_result, json_encode( $items ) );
file_put_contents( $docs_wt_result, json_encode( $final_json ) );

print( "Массив ДОКУМЕНТЫ записан в файл</br><hr>" );
$time_tags_secs = round( ( ( microtime( true ) - $start ) / 60 ), 2 );
echo "<br>Получение массива документов заняло " . $time_tags_secs . " мин<hr>";
require '02_savedocs.php';

?>
</body>
</html>