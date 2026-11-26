<?

$DESCRIPTION = 'PLC, ��������������� ���������� ����������� ���������� (���) �� ������ �� �������� ����. ������. ������������� �� 10000 �����. ������� �����, � ������� �� ������, �������� �� ������ � �������.';

$KEYWORDS = '����������� ���, ��������������� �����������, ��������������� ���������� ��������������� ������, ���������� PLC, PLC, Yottacontrol, ����������� �������������';

$TITLE = '���, PLC, ��������������� ���������� ����������� Yottacontrol, ��������� �����������, �� ������';

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

echo "!!!!!!!!!";

?>

<pre>

<? var_dump($_GET) ?>

</pre>

<?

/* ����������� ���������� �������� */

$filter = Array("parent_code" => "plc-controllers");

$SEF = Array("sections_list" => "/plc/haiwell/", "section" => "/plc/haiwell/#section_code#/", "element" => "/plc/haiwell/#section_code#/#element_code#/");



if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {

    ?>

    <h1><?= $arguments["catalog_section_H1"] ?></h1>

    <?

}

$titles = Array("catalog_sections_list_H1" => "��������������� ���������� ����������� Haiwell", "catalog_section_H1" => "#section_name#", "catalog_element_H1" => "#element_name#");

$arguments = Array("filter" => $filter, "SEF" => $SEF, "path_to_images" => "/images/haiwell/", "titles" => $titles);



$APPLICATION->IncludeComponent("catalog", "default", $arguments);

/* * * END *** ����������� ���������� �������� */



include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>



