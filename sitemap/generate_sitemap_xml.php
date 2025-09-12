<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/sitemap_html/templates/default/inc_sitemap_data.php";
global $ar_main_static_links, $ar_dynamic_links, $ar_catalog_links;

$file_name = "sitemap.xml";
?>
    <h2><a target="_blank" href="/<?=$file_name?>"><?=$file_name?></a></h2>
<?php



// ГЛАВНЫЙ МАССИВ ССЫЛОК
$ar_xml_links = [];

//var_dump_pre($ar_main_static_links, $ar_dynamic_links,$ar_catalog_links);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///  СОБИРАЕМ СТАТИЧЕСКИЕ ССЫЛКИ ///
foreach ($ar_main_static_links as $static_link_group){
    foreach ($static_link_group["items"] as $static_link_item){
        $link = $static_link_item["link"];
        if($link[0] != '/') continue;
        $link = "https://www.rusavtomatika.com".do_xml_safe_link($link);
        $ar_xml_links[] = [
            'loc' => $link,
            'lastmod' => date("Y-m-d"),
            'changefreq' => 'yearly',
            'priority' => '0.7',
        ];
    }
}
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
///  СОБИРАЕМ КАТАЛОЖНЫЕ ССЫЛКИ ///
foreach ($ar_catalog_links["items"] as $sections) {
    //var_dump_pre($sections["link"]);
    $link = "https://www.rusavtomatika.com" . do_xml_safe_link($sections["link"]);
    $ar_xml_links[] = [
        'loc' => $link,
        'lastmod' => date("Y-m-d"),
        'changefreq' => 'weekly',
        'priority' => '0.7',
    ];
    foreach ($sections["series"] as $series) {
        foreach ($series["items"] as $item) {
            $brand = strtolower($item["brand"]);
            if (isset($item['section']) and $item['section'] == 'accessories') {
                $brand = 'accessories';
            }
            if ($brand == 'faraday') {
                $model = $item["s_name"];
            } else {
                $model = $item["model"];
            }
            if($brand == '') {echo "!!!!!!!!!!!!!!!";}
            $link = "/" . $brand . EX . "/" . $model . "/";
            $link = "https://www.rusavtomatika.com" . do_xml_safe_link($link);
            $ar_xml_links[] = [
                'loc' => $link,
                'lastmod' => date("Y-m-d"),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// из облака тегов
include_once $_SERVER["DOCUMENT_ROOT"]."/include/main_page/content/block_cloud_tags_data.php";
if(isset($arr_cloud_tags) and count($arr_cloud_tags)>0){
    foreach ($arr_cloud_tags as $cloud_tag){
        if($cloud_tag["add_to_sitemap"] == 1) {
            $link = $cloud_tag["url"];
            if ($link[0] != '/') continue;
            $link = "https://www.rusavtomatika.com" . do_xml_safe_link($link);
            $ar_xml_links[] = [
                'loc' => $link,
                'lastmod' => date("Y-m-d"),
                'changefreq' => 'yearly',
                'priority' => '0.7',
            ];
        }
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


$sitemap_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');


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