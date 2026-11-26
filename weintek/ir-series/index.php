<?

global $current_component;

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = '';

$KEYWORDS = '';

$TITLE = 'weintek/ir-series';

$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/weintek/ir-series/";

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";





$root_section_path = "/weintek/ir-series/";



/* var_dump($current_component);

  var_dump($element_code);

  var_dump($section_code);

 */



/* * ****************************************************************************** */



/* ����������� ���������� �������� */

/**/

$filter = Array("series" => "iR", "brand" => "Weintek",);

/**/

$SEF = Array("sections_list" => $root_section_path,

    "section" => $root_section_path . "#section_code#/",

    "element" => $root_section_path . "#section_code#/#element_code#/");

$SEO = Array("element_title" => "Weintek #element_name# | ������ ������ � �����-���������� � ������ | �������� �� ������");

if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {

    ?>

    <h1><?= $arguments["catalog_section_H1"] ?></h1>

    <?

}

$titles = Array(

    "catalog_sections_list_H1" => "������ Weintek",

    "catalog_section_H1" => "#section_name#",

    "catalog_element_H1" => "#element_name#");



$arguments = Array("filter" => $filter, "SEF" => $SEF, "SEO" => $SEO, "path_to_images" => "/images/weintek/ir", "titles" => $titles,

    "current_component" => $current_component, "section_code" => $section_code, "element_code" => $element_code,

    "table_name" => "products_all", "order_by" => "index", "group_by" => " GROUP BY `series` ");



//$arguments["path_to_images"] = "/images/weintek/ir";



$APPLICATION->IncludeComponent("catalog", "weintek-ir", $arguments);



/* * * END *** ����������� ���������� �������� */

/* * ****************************************************************************** */





include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>



