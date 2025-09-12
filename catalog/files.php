<?php
define('ENCODING', "UTF-8");
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
$is_core_catalog_page = explode('?', $_SERVER['REQUEST_URI'])[0] == "/catalog/";

global $H1;
$H1 = 'Каталог оборудования';
$arguments = array(
    "component" => "catalog",
    "template" => "files",
    "template_section_detail" => "default",
);


CoreApplication::include_component($arguments);

if ($is_core_catalog_page):
    ?>
<?php
endif;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
