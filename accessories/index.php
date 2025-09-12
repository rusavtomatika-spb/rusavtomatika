<?
include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    //include $_SERVER["DOCUMENT_ROOT"]."/accessories_/index.php";
    //
    $_GET['component'] = "catalog_detail";
    include_once $_SERVER['DOCUMENT_ROOT'].'/catalog/index.php';
    exit();
}

header('Content-Type: text/html; charset=windows-1251');
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$DESCRIPTION = '';
$KEYWORDS = '';
$TITLE = 'accessories';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/accessories/";

$section_setup = '.section.php';
if (file_exists($section_setup)) {
    include $section_setup;
}

include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
echo "<article>";

/* var_dump($current_component);
  var_dump($element_code);
  var_dump($section_code);
 */

/* * ****************************************************************************** */

/* Подключение компонента каталога */
/**/
$filter = Array("section" => "accessories");
/**/
$SEF = Array("sections_list" => "/accessories/",
    "section" => "/accessories/#section_code#/",
    "element" => "/accessories/#section_code#/#element_code#/");
$SEO = Array("element_title" => "#element_name# | купить в Санкт-Петербурге и Москве | доставка по России");
if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {
    ?>
    <h1><?= $arguments["catalog_section_H1"] ?></h1>
    <?
}
$titles = Array(
    "catalog_sections_list_H1" => "Аксессуары",
    "catalog_section_H1" => "#section_name#",
    "catalog_element_H1" => "#element_name#");

$arguments = Array(
        "filter" => $filter        
        , "SEF" => $SEF
        , "SEO" => $SEO
        , "path_to_images" => ""
        , "titles" => $titles
        , "current_component" => $current_component
        , "section_code" => $section_code
        , "element_code" => $element_code
        , "table_name" => "products_all"
        , "order_by" => "index"
        , "group_by" => " GROUP BY `section` ");

$arguments["path_to_images"] = "";

$APPLICATION->IncludeComponent("catalog", "accessories_all_products", $arguments);

/* * * END *** Подключение компонента каталога */
/* * ****************************************************************************** */

echo "</article>";
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>

