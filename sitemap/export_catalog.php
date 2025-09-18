<?php
	if (!defined("ENCODING")) {
    	define("ENCODING","UTF-8");
	}
if(isset($export_self_launching)){
    ob_start();
}
if (!defined('PROLOG_INCLUDED')) define('PROLOG_INCLUDED', true);
if (!defined('bullshit')) {
    define('bullshit', 1);
}
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";

database_connect();
global $mysqli_db;
mysqli_query($mysqli_db, "SET NAMES utf8");
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/application/CoreApplication.php';
/*require_once $_SERVER["DOCUMENT_ROOT"] . '/core/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/config.php';

define('ROUTE_STRING', (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "");
define('URL_PATH_TO_PRODUCT_PICTURES', "/images/");

include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");


include $_SERVER["DOCUMENT_ROOT"] . "/core/components/sitemap_html/templates/default/inc_sitemap_data.php";
global $ar_main_static_links, $ar_dynamic_links, $ar_catalog_links;*/
$ar_catalog_links["items"] = [];
$file_name = "export_catalog.xml";

//$ar_sections = CoreApplication::get_rows_from_table("catalog_sections", "id,name,code,category_link,products_selected_by_query", "`active`='1'", "position asc");
include_once "inc_get_data.php";
/**/ ?><!--<pre><?php
/*var_dump($arr_export_catalog_products);
*/ ?></pre>--><?php


/*foreach ($ar_catalog_links["items"] as $sections) {
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
}*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$catalog_xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog date="' . date('Y-m-d H:i:s') . '" />');


//shop
$catalog_xml__shop = $catalog_xml->addChild('shop');

$catalog_xml__shop->addChild('name', "Русавтоматика");

$catalog_xml__shop->addChild('company', "ООО Русавтоматика");
$catalog_xml__shop->addChild('url', "https://www.rusavtomatika.com");

$catalog_xml__categories = $catalog_xml__shop->addChild('categories');
$catalog_xml__offers = $catalog_xml__shop->addChild('offers');

foreach ($ar_sections as $section) {
    $catalog_xml__category = $catalog_xml__categories->addChild('category', $section["name"]);
    $catalog_xml__category->addAttribute('id', $section["id"]);
}


$counter = 0;

foreach ($arr_export_catalog_products as $product) {
    $counter++;
    if ($counter > 5000) break;
    $catalog_xml__offer = $catalog_xml__offers->addChild('offer');
    $catalog_xml__offer->addAttribute('id', $product["index"]);
    if(!($product["onstock_spb"] > 0)){
        $catalog_xml__offer->addAttribute('type', "on.demand");
    }else{
        $catalog_xml__offer->addAttribute('available', "true");

    }


    if($product["type"] == "monitor"){
        $full_name = "Промышленный монитор ";
        if($product["diagonal"]>0 and $product["diagonal_hide"] != '1'){
            /*        $diagonal = str_replace(".0", "", $product["diagonal"]) . "&Prime;";*/
            $diagonal = str_replace(".0", "", $product["diagonal"]) . "'' ";
            $full_name .=  $diagonal;
        }
        $full_name .=  " " . $product["model"];
        if($product["brand"]!= "IFC") $full_name .=  " " .$product["brand"];
    }else{
        $full_name = $product["model"];
        if($product["diagonal"]>0 and $product["diagonal_hide"] != '1'){
            /*        $diagonal = str_replace(".0", "", $product["diagonal"]) . "&Prime;";*/
            $diagonal = str_replace(".0", "", $product["diagonal"]) . "'' ";
            $full_name .= " - " . $diagonal;
        }
        $full_name .=  " " . $ar_catalog_types[$product["type"]] . " " . $product["brand"];
    }





    $catalog_xml__offer->addChild('name',$full_name);
    $catalog_xml__offer->addChild('vendor',$product["brand"]);
    $catalog_xml__offer->addChild('url',$product["url"]);
    $catalog_xml__offer->addChild('price',$product["price"]);
    $catalog_xml__offer->addChild('currencyId',"RUR");
    $catalog_xml__offer->addChild('categoryId',$product["categoryId"]);

    if(is_array($product["pictures"])){
        foreach ($product["pictures"] as $picture){
            $catalog_xml__offer->addChild('picture',$picture);
        }
    }

    $description = $catalog_xml__offer->addChild('description');

    $node = dom_import_simplexml($description);
    $no   = $node->ownerDocument;
    $node->appendChild($no->createCDATASection($product["text_features"]));

    if($product["diagonal"] != '') {
        $catalog_xml__param = $catalog_xml__offer->addChild('param', $product["diagonal"]);
        $catalog_xml__param->addAttribute('name', "Диагональ экрана");
        $catalog_xml__param->addAttribute('unit', "&Prime;");
    }

    if($product["dimentions"] != '') {
        $catalog_xml__param = $catalog_xml__offer->addChild('param', $product["dimentions"]);
        $catalog_xml__param->addAttribute('name', "Габариты");
        $catalog_xml__param->addAttribute('unit', "мм" );
    }

    if($product["resolution"] != ''){
        $catalog_xml__param = $catalog_xml__offer->addChild('param',$product["resolution"]);
        $catalog_xml__param->addAttribute('name', "Разрешение");
    }

    if($product["interfaces"] != ''){
        $catalog_xml__param = $catalog_xml__offer->addChild('param',$product["interfaces"]);
        $catalog_xml__param->addAttribute('name', "Интерфейсы");
    }













    //$catalog_xml__category->addAttribute('id', $section["id"]);
}


//$catalog_xml__shop_name = $catalog_xml__shop->addChild('name',"Русавтоматика");


/*foreach ($ar_xml_links as $link) {
    $xml_level2 = $catalog_xml->addChild('url');
    foreach ($link as $k => $v) {
        $xml_level2->addChild($k, $v);
    }
}*/


echo $catalog_xml->asXML();
file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/" . $file_name, $catalog_xml->asXML());
//require_once $_SERVER['DOCUMENT_ROOT'] . "/core/epilog.php";

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

if(isset($export_self_launching)){
    ob_clean();
}


?>