<?php
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=UTF-8');

define("bullshit", 1);
define("PROLOG_INCLUDED", 1);
define("CATALOG_PRODUCT_URL_TEMPATE", "/#brand#_/#model#/");
define("CATALOG_SECTION_URL_TEMPATE", "/catalog/#section#/");

global $mysqli_db;
global $db;
include $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
database_connect();

require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/config.php';
require_once CORE_PATH . '/application/CoreApplication.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/abacus/components/catalog_layout/CatalogLayout.php';

if (!function_exists('var_dump_pre')) {
    function var_dump_pre(...$values)
    {
        foreach ($values as $value) {
            echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
            var_dump($value);
            echo "</pre>";
        }
    }
}

ob_start();

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST['action']) and $_POST['action'] != '') {
    switch ($_POST['action']) {
        case 'show_section_by_categories':
            require __DIR__ . '/response_templates/inc_show_section_by_categories.php';
            break;
        case 'show_section_by_categories_one_brand_only':
            require __DIR__ . '/response_templates/inc_show_section_by_categories.php';
            break;
        case 'show_all_sections_by_brand':
            require __DIR__ . '/response_templates/inc_show_all_sections_by_brand.php';
            break;
        case 'show_one_section_by_brand':
            require __DIR__ . '/response_templates/inc_show_all_sections_by_brand.php';
            break;
        default:
            break;
    }
}

$buffer = ob_get_clean();
echo $buffer;