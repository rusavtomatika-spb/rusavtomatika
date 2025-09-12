<?
if (!defined("MAIN_FILE_EXECUTED")) define("MAIN_FILE_EXECUTED", TRUE);



require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/config.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_legacy.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_ifc.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_cincoze.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_banners.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_template.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_menu.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_basket.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_weintek.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_messages.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_currencies.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_search.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_new.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/inc_dbconnect.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/functions_utilities.php");

/* 
Package
*/

require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/package/CComponents.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/package/CProducts.php");
$component = new easylife\CComponents;
tools\CProducts::init();
//
require_once ($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new_includes/ILYA_bredogenerator_koda.php");

if (defined("ENCODING") and ENCODING == "UTF-8") {
    header('Content-Type: text/html; charset=utf-8');
} else {
    header('Content-Type: text/html; charset=windows-1251');
}

if (!defined("MAIN_FILE_EXECUTED")) define("MAIN_FILE_EXECUTED", TRUE);

?>