<?php
define('MAIN_FILE_EXECUTED', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
//require_once 'model.php';
echo "!!";


/** Include PHPExcel_IOFactory */
require_once $_SERVER['DOCUMENT_ROOT'] . '/orders/excel/Classes/PHPExcel/IOFactory.php';

//$file = "05featuredemo.xlsx";
$file_in = $_SERVER['DOCUMENT_ROOT'] . "/orders/import/nomenklatura.xlsx";

if (!file_exists($file_in)) {
    exit("No file! (((");
}
$objPHPExcel = PHPExcel_IOFactory::load($file_in);
$activeSheet = $objPHPExcel->getActiveSheet();
$arrRows = $activeSheet->toArray();
global $db;



foreach ($arrRows as $row) {
    $name = iconv("utf-8", "windows-1251", $row[0]);
    if ($name != "") {
        //$brand = iconv("utf-8", "windows-1251", $row[0]);
        $description = iconv("utf-8", "windows-1251", $row[1]);
        $query = "INSERT INTO `ord_products` SET `name`= '$name', `description`='$description' ON DUPLICATE KEY UPDATE  `description`='$description'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db) . "Invalid query: " . $query . "  ");
        echo "<pre>";
        echo $name." ";
        echo $brand." ";
        echo $description."<br>";
        echo "</pre>";
    }
}
