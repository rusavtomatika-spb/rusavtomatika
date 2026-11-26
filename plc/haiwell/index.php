<?

global $current_component;

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

$DESCRIPTION = '����������� ������������� Haiwell PLC, ��������������� ���������� ����������� ���������� (���) �� ������ �� �������� ����. ������. ������������� �� 10000 �����. ������� �����, � ������� �� ������, �������� �� ������.';

$KEYWORDS = '����������� ���, ��������������� �����������, ��������������� ���������� ��������������� ������, ���������� PLC, PLC, Haiwell, ����������� �������������';

$TITLE = 'Haiwell ������������ ����������� (���, PLC)  ������ � �����-���������� � ������ | �������� �� ���� ������';

$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/plc/haiwell/";

$section_setup = '.section.php';

if (file_exists($section_setup)) {

    include $section_setup;

}



include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

?>

<!--div style="padding: 2rem;margin: -20px -40px 1.5rem;text-align: center;font-size: 2rem;background:#de6060;color: white;position: relative;z-index: 1">

    <p>��������, ��������� ����� Haiwell �� �������� �� ����������.</p>

    <p style="font-size: 1.9rem">���������� ��� ����������� ������� <a style="color: white" href="/plc/weintek/">��������� ������� Weintek</a>.</p>

</div-->

<?php



/* ����������� ���������� �������� */

$filter = Array("parent_code" => "plc-controllers");

$SEF = Array("sections_list" => "/plc/haiwell/", "section" => "/plc/haiwell/#section_code#/", "element" => "/plc/haiwell/#section_code#/#element_code#/");

$SEO = Array("element_title" => "Haiwell #element_name# #section_title# | #section_name# | ������ � �����-���������� � ������ | �������� �� ������");

if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {

    ?>

    <h1><?= $arguments["catalog_section_H1"] ?></h1>

    <?

}

$titles = Array("catalog_sections_list_H1" => "��������������� ���������� ����������� Haiwell", "catalog_section_H1" => "#section_name#", "catalog_element_H1" => "#element_name#");

$arguments = Array("filter" => $filter, "SEF" => $SEF, "SEO" => $SEO, "path_to_images" => "/images/haiwell/", "titles" => $titles,

    "current_component" => $current_component,

    "section_code" => $section_code,

    "element_code" => $element_code,

    "order_by" => "",

    "group_by" => "",

    "table_name"=>'ib_catalog_sections');



echo "<article>";



$APPLICATION->IncludeComponent("catalog", "default", $arguments);

echo "</article>";

/* * * END *** ����������� ���������� �������� */



include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>



