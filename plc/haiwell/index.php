<?
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
$DESCRIPTION = 'Официальный представитель Haiwell PLC, программируемые логические контроллеры управления (ПЛК) со склада по отличной цене. Модули. Расширяемость до 10000 точек. Большой выбор, в наличии на складе, доставка по России.';
$KEYWORDS = 'контроллеры ПЛК, программируемые контроллеры, программируемые логические программируемые модули, управление PLC, PLC, Haiwell, официальный представитель';
$TITLE = 'Haiwell промышленные контроллеры (ПЛК, PLC)  купить в Санкт-Петербурге и Москве | доставка по всей России';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/plc/haiwell/";
$section_setup = '.section.php';
if (file_exists($section_setup)) {
    include $section_setup;
}

include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
?>
<!--div style="padding: 2rem;margin: -20px -40px 1.5rem;text-align: center;font-size: 2rem;background:#de6060;color: white;position: relative;z-index: 1">
    <p>Извините, продукцию фирмы Haiwell мы временно не поставляем.</p>
    <p style="font-size: 1.9rem">Предлагаем вам рассмотреть вариант <a style="color: white" href="/plc/weintek/">модульной системы Weintek</a>.</p>
</div-->
<?php

/* Подключение компонента каталога */
$filter = Array("parent_code" => "plc-controllers");
$SEF = Array("sections_list" => "/plc/haiwell/", "section" => "/plc/haiwell/#section_code#/", "element" => "/plc/haiwell/#section_code#/#element_code#/");
$SEO = Array("element_title" => "Haiwell #element_name# #section_title# | #section_name# | купить в Санкт-Петербурге и Москве | доставка по России");
if (isset($arguments["catalog_section_H1"]) and $arguments["catalog_section_H1"] != "") {
    ?>
    <h1><?= $arguments["catalog_section_H1"] ?></h1>
    <?
}
$titles = Array("catalog_sections_list_H1" => "Программируемые логические контроллеры Haiwell", "catalog_section_H1" => "#section_name#", "catalog_element_H1" => "#element_name#");
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
/* * * END *** Подключение компонента каталога */

include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>

