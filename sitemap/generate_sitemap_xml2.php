<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/core/prolog.php";
include $_SERVER["DOCUMENT_ROOT"] . "/core/components/sitemap_html/templates/default/inc_sitemap_data.php";
global $ar_main_static_links, $ar_dynamic_links, $ar_catalog_links;

$file_name = "sitemap.xml";
?>
    <h2><a target="_blank" href="/<?=$file_name?>"><?=$file_name?></a></h2>
<?php

//var_dump_pre($ar_catalog_links["items"]);

// ÃËÀÂÍÛÉ ÌÀÑÑÈÂ ÑÑÛËÎÊ
$ar_xml_links = [];

//var_dump_pre($ar_main_static_links, $ar_dynamic_links,$ar_catalog_links);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///  ÑÎÁÈÐÀÅÌ ÑÒÀÒÈ×ÅÑÊÈÅ ÑÑÛËÊÈ ///
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
///  ÑÎÁÈÐÀÅÌ ÄÈÍÀÌÈ×ÅÑÊÈÅ ÑÑÛËÊÈ ///
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
///  ÑÎÁÈÐÀÅÌ ÊÀÒÀËÎÆÍÛÅ ÑÑÛËÊÈ ///
foreach ($ar_catalog_links["items"] as $sections) {
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

/*echo "<pre>";
$filename = $_SERVER["DOCUMENT_ROOT"] . "/1.txt";
if (file_exists($filename)) {
    echo "Ôàéë $filename â ïîñëåäíèé ðàç áûë èçìåí¸í: " . date("F d Y H:i:s.", filectime($filename));
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
require_once $_SERVER['DOCUMENT_ROOT'] . "/core/epilog.php";

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