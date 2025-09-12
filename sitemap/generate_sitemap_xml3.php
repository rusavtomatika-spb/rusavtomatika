<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/sitemap_html/templates/default/inc_sitemap_data_articles_only.php";
global $ar_dynamic_links;

$file_name = "articles.xml";
?>
    <h2><a target="_blank" href="/<?=$file_name?>"><?=$file_name?></a></h2>
<?php



// ГЛАВНЫЙ МАССИВ ССЫЛОК
$ar_xml_links = [];

//var_dump_pre($ar_main_static_links, $ar_dynamic_links,$ar_catalog_links);


///  СОБИРАЕМ ДИНАМИЧЕСКИЕ ССЫЛКИ ///
foreach ($ar_dynamic_links as $dynamic_link_group){
    foreach ($dynamic_link_group["items"] as $dynamic_link_item){
        $link = $dynamic_link_item["link"];
        if($link[0] != '/') continue;
        $link = "https://www.rusavtomatika.com".do_xml_safe_link($link);
        $ar_xml_links[] = [
            'loc' => $link,
            'lastmod' => date("Y-m-d"),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/*echo "<pre>";
$filename = $_SERVER["DOCUMENT_ROOT"] . "/1.txt";
if (file_exists($filename)) {
    echo "Файл $filename в последний раз был изменён: " . date("F d Y H:i:s.", filectime($filename));
}
//var_dump(filectime($_SERVER["DOCUMENT_ROOT"]."/1.txt"));
echo "</pre>";*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$sitemap_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:yandex="http://news.yandex.ru"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:turbo="http://turbo.yandex.ru"
     version="2.0">
    <channel>
        <!-- Информация о сайте-источнике -->
        <title>Автоматизация технологических процессов от А до Я. Информация, оборудование, примеры и помощь.</title>
        <link>https://www.rusavtomatika.com/</link>
        <description>Статьи об оборудовании Weintek, IFC, Aplex, eWON, Samkoon и методика применения</description>
        <language>ru</language>
        <turbo:analytics></turbo:analytics>
        <turbo:adNetwork></turbo:adNetwork>');


foreach ($ar_xml_links as $link) {
/*    echo "<pre>";
    var_dump($link);
    echo "</pre>";*/
    $xml_level2 = $sitemap_xml->addChild('url');
    foreach ($link as $k => $v) {
        $xml_level2->addChild($k, $v);
    }
}
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/".$file_name, $sitemap_xml->asXML());
echo "<pre>";
var_dump($ar_xml_links);
echo "</pre>";
?>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function do_xml_safe_link($link)
{
    $link = str_replace("&", "&amp;", $link);
    $link = str_replace("'", "&apos;", $link);
    $link = str_replace('"', "&quot;", $link);
    $link = str_replace('>', "&gt;", $link);
    $link = str_replace('<', "&lt;", $link);
    return $link;
}


?>