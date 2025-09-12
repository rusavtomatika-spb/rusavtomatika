<?
$DESCRIPTION = 'PLC, программируемые логические контроллеры управления (ПЛК) со склада по отличной цене. Модули. Расширяемость до 10000 точек. Большой выбор, в наличии на складе, доставка по России и Украине.';
$KEYWORDS = 'контроллеры ПЛК, программируемые контроллеры, программируемые логические программируемые модули, управление PLC, PLC, Yottacontrol, официальный представитель';
$TITLE = 'ПЛК, PLC, программируемые логические контроллеры Yottacontrol, бюджетные контроллеры, со склада';
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
echo "!!!!!!!!!";
?>
<pre>
<? var_dump($_GET) ?>
</pre>
<?
/* Подключение компонента каталога */
$filter = Array("parent_code" => "plc-controllers");
$SEF = Array("sections_list" => "/plc/haiwell/", "section" => "/plc/haiwell/#section_code#/", "element" => "/plc/haiwell/#section_code#/#element_code#/");

if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {
    ?>
    <h1><?= $arguments["catalog_section_H1"] ?></h1>
    <?
}
$titles = Array("catalog_sections_list_H1" => "Программируемые логические контроллеры Haiwell", "catalog_section_H1" => "#section_name#", "catalog_element_H1" => "#element_name#");
$arguments = Array("filter" => $filter, "SEF" => $SEF, "path_to_images" => "/images/haiwell/", "titles" => $titles);

$APPLICATION->IncludeComponent("catalog", "default", $arguments);
/* * * END *** Подключение компонента каталога */

include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>

