<?php
header('Content-Type: text/html; charset=windows-1251');
ob_start();

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('admin', true);
define('LG_WIDTH', '1330');
define('LG_HEIGHT', '1000');
define('MD_WIDTH', '590');
define('MD_HEIGHT', '443');
define('SM_WIDTH', '50');
define('SM_HEIGHT', '38');

define('PX130_WIDTH', '130');
define('PX130_HEIGHT', '100');

define('PX67_WIDTH', '67');
define('PX67_HEIGHT', '50');


require_once 'config_ftp.php';
require_once '../config/admin_dbcon.php';
require_once 'classes/databases_products_all.php';
require_once 'classes/functions.php';
global $ftpConnectionID;
file_put_contents( "error_log", "" );


if (
    isset($_REQUEST["model"]) and $_REQUEST["model"] != '' and
    isset($_REQUEST["brand"]) and $_REQUEST["brand"] != '' and
    isset($_REQUEST["pic_url"]) and $_REQUEST["pic_url"] != ''
) {

    $model_secured = str_replace("/", "_", $_REQUEST["model"]);
    $model_secured = str_replace(" ", "_", $model_secured);
    $model_secured = str_replace("®", "_", $model_secured);
	
	$armodel = array();
	$armodel["model"] = $_REQUEST["model"];
	$armodel["brand"] = $_REQUEST["brand"];
	$armodel["type"] = $_REQUEST["type"];

    $imgPathDir = $_SERVER["DOCUMENT_ROOT"] . "/images/" . strtolower($_REQUEST["brand"]) . "/" . strtolower($_REQUEST["type"]) . "/{$model_secured}/";
    $imgPathDirRemoteFTP = "/images/" . strtolower($_REQUEST["brand"]) . "/" . strtolower($_REQUEST["type"]) . "/{$model_secured}/";

    $num = substr($_REQUEST["pic_url"], strrpos($_REQUEST["pic_url"], '_') + 1);
    $num = substr($num, 0, strrpos($num, '.'));


    $files_to_delete[] = $imgPathDir . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . $model_secured . "_" . $num . ".png.txt";
    $files_to_delete[] = $imgPathDir . "sm/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "md/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "lg/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "130/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "1330/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "150/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "190/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "580/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "67/" . $model_secured . "_" . $num . ".webp";
    $files_to_delete[] = $imgPathDir . "130/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "1330/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "150/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "190/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "580/" . $model_secured . "_" . $num . ".png";
    $files_to_delete[] = $imgPathDir . "67/" . $model_secured . "_" . $num . ".png";
	$files_to_delete[] = $imgPathDir . "130/" . $model_secured . "_" . $num . ".png.big.txt";
    $files_to_delete[] = $imgPathDir . "1330/" . $model_secured . "_" . $num . ".png.big.txt";
    $files_to_delete[] = $imgPathDir . "150/" . $model_secured . "_" . $num . ".png.big.txt";
    $files_to_delete[] = $imgPathDir . "190/" . $model_secured . "_" . $num . ".png.big.txt";
    $files_to_delete[] = $imgPathDir . "580/" . $model_secured . "_" . $num . ".png.big.txt";
    $files_to_delete[] = $imgPathDir . "67/" . $model_secured . "_" . $num . ".png.big.txt";

    foreach ($files_to_delete as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
	connectToFTP();
    if ($ftpConnectionID != null) {
        $files_to_delete = [];
        $files_to_delete[] = $imgPathDirRemoteFTP . "sm/" . $model_secured . "_" . $num . ".png";
        $files_to_delete[] = $imgPathDirRemoteFTP . "md/" . $model_secured . "_" . $num . ".png";
        $files_to_delete[] = $imgPathDirRemoteFTP . "lg/" . $model_secured . "_" . $num . ".png";
        $files_to_delete[] = $imgPathDirRemoteFTP . "130/" . $model_secured . "_" . $num . ".webp";
        $files_to_delete[] = $imgPathDirRemoteFTP . "1330/" . $model_secured . "_" . $num . ".webp";
        $files_to_delete[] = $imgPathDirRemoteFTP . "150/" . $model_secured . "_" . $num . ".webp";
        $files_to_delete[] = $imgPathDirRemoteFTP . "190/" . $model_secured . "_" . $num . ".webp";
        $files_to_delete[] = $imgPathDirRemoteFTP . "580/" . $model_secured . "_" . $num . ".webp";
        $files_to_delete[] = $imgPathDirRemoteFTP . "67/" . $model_secured . "_" . $num . ".webp";
		//file_put_contents( 'tmp.txt', json_encode( $files_to_delete, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
        foreach ($files_to_delete as $file) {
            ftp_delete($ftpConnectionID, $file);
        }
    }
$imagesHtml = getRemoteFTPImagesHtml($armodel);
    //file_put_contents( 'tmp.txt', json_encode( $_REQUEST, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
//file_put_contents( 'tmp.txt', $imagesHtml );
disconnectFTP();


    $out["status"] = 1;
} else {
    var_dump($_REQUEST);
    $out["status"] = 0;
}


$out["buffer"] = ob_get_clean();

echo json_encode($out);
