<?php
define('MAIN_FILE_EXECUTED',true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';

$status = 0;
if ($_POST['action'] == 'get_values'){
    switch ($_POST['field_name']) {
        case 'name':            
            $product = \model\get_product($_POST['id']);
            $arrCurrencies = \model\get_reference_price_currencies();
            $arrBrands = \model\get_all_brands();
            include $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/form_edit_name.php';
            $status = 1;
            break;
        default:
            break;
    }
}elseif(
        $_POST['action'] == 'update_values'){
        
        foreach ($_POST['fields'] as $field) {
            $arFields[$field] = $_POST[$field];
        }
        $status = update_product($_POST['product_id'], $arFields);
}
?>

    <?
$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
$out["status"] = $status;

ob_end_clean();
echo json_encode($out);
/*
function get_product($product_id) {
    global $db;
    $query = "SELECT * FROM `ord_products` where id='$product_id' ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return mysqli_fetch_array($result);
}*/
function update_product($product_id, $arFields) {
    global $db;
    if ($product_id > 0) {
        $constructor = "";
        foreach ($arFields as $key => $value) {
            if (mb_detect_encoding($value) == 'UTF-8') {
                $value = iconv("utf-8", "windows-1251", $value);
            }
            $constructor .= " `$key` = '$value',";
        }
        $constructor = trim($constructor, ',');
        echo $query = "UPDATE `ord_products`
SET 
$constructor
where id='$product_id';";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        return($result);
    }
    return false;
}



