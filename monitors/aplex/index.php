<?

global $current_component;

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = '';

$KEYWORDS = '';

$TITLE = 'monitors/aplex';



$extra_openGraph = Array(

    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/monitors_aplex.png",

    "openGraph_title" => "������������ �������� Aplex",

    "openGraph_siteName" => "�������������"

);

$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/monitors/aplex/";

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";



/* var_dump($current_component);

  var_dump($element_code);

  var_dump($section_code);

 */



/* * ****************************************************************************** */



/* ����������� ���������� �������� */

$filter = Array("type" => "monitors");

$SEF = Array("sections_list" => "/monitors/aplex/", "section" => "/monitors/aplex/#section_code#/", "element" => "/monitors/aplex/#section_code#/#element_code#/");

$SEO = Array("element_title" => "Aplex #element_name# | ������������ ���������� ������� ������ � �����-���������� � ������ | �������� �� ������");

if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {

    ?>

    <h1><?= $arguments["catalog_section_H1"] ?></h1>

    <?

}

$titles = Array(

    "catalog_sections_list_H1" => "������������ �������� Aplex",

    "catalog_section_H1" => "#section_name#",

    "catalog_element_H1" => "#element_name#");

$arguments = Array("filter" => $filter, "SEF" => $SEF, "SEO" => $SEO, "path_to_images" => "/images/aolex/", "titles" => $titles,

    "current_component" => $current_component, "section_code" => $section_code, "element_code" => $element_code,

    "table_name" => "products_all", "order_by" => "index", "group_by" => " GROUP BY `series` ");

$arguments["path_to_images"] = "/images/aplex/monitors";

echo "<article>";

$APPLICATION->IncludeComponent("catalog", "monitors_aplex", $arguments);

echo "</article>";



/* * * END *** ����������� ���������� �������� */

/* * ****************************************************************************** */





include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>



