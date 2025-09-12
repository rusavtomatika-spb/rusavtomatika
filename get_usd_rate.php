
<?php
/*
 $link = "//www.cbr.ru/scripts/XML_daily.asp";
// $link="//www.yandex.ru";
$link="//www.cbr.ru/scripts/XML_daily.asp?date_req=02/03/2002";
// echo "contents";
//echo  file_get_contents($link);

$link="//www.yandex.ru";
$cont=file_get_contents($link);

//echo $cont;

echo "size=".strlen($cont);

$a=strstr($cont,"b-stocks__currency-value_adaptive2");

echo $a;

$b=explode(">",$a);

//echo $b[0];

//$usd="".$a[1].$a[2].$a[3].$a[4].$a[5];
//echo $a;

exit;
*/

  // Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
  $content = get_content();
 //echo $content;
  // Разбираем содержимое, при помощи регулярных выражений
  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
  preg_match_all($pattern, $content, $out, PREG_SET_ORDER);
  $dollar = "";
  $euro = "";
  foreach($out as $cur)
  {
    //echo "$cur[2]<br>";
    if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]);
    if($cur[2] == 978) $euro   = str_replace(",",".",$cur[4]);
  }

// временно ставим 75
//$dollar = 87;

 // echo "Доллар - ".$dollar."<br>";
 // echo $euro;

 $subj="usd = $dollar";
 $text="
 usd  = $dollar
 euro = $euro
 ";

 //send_message ("plesk@mail.ru", $subj, $text);
if($dollar!="")
{
 $file = fopen('usdrate.txt', 'w');


 fwrite($file,$dollar);

 fclose($file);


$export_self_launching = true;
include($_SERVER["DOCUMENT_ROOT"].'/sitemap/export_catalog.php');
}

if($euro!="")
{
 $file = fopen('eurrate.txt', 'w');


 fwrite($file,$euro);

 fclose($file);
}
//echo $dollar;

  function get_content()
  {
    
    // Формируем сегодняшнюю дату
    $date = date("d/m/Y");
    $date="";
    //?date_req=$date
    // Формируем ссылку
    $link = "https://www.cbr.ru/scripts/XML_daily.asp";
      $text="";

      try {
          $headers = get_headers($link);
          if($headers[0] == 'HTTP/1.1 200 OK') {

              // Загружаем HTML-страницу
              $fd = fopen($link, "r");
              if (!$fd) echo "Запрашиваемая страница не найдена";
              else {
                  // Чтение содержимого файла в переменную $text
                  while (!feof($fd)) $text .= fgets($fd, 4096);
                  fclose($fd);
              }
          }
      } catch (Exception $e) {
      }



    return $text;
  }
?>