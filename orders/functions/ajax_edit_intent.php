<?php

define('MAIN_FILE_EXECUTED', true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
$status = 0;

switch ($_POST['action']) {
    /*case 'edit_intent':
        if ($_POST['product_id'] != '' and $_POST['month'] != '') {
            $arrResult['product_id'] = intval($_POST['product_id']);
            $arrResult['month'] = intval($_POST['month']);
            $arrResult['intent'] = get_intent($arrResult['product_id'], $arrResult['month']);
            include 'templates/form_edit_intent.php';
            $status = 1;
        }
        break;*/
    case 'edit_intent':
        if ($_POST['product_id'] != '' and $_POST['month'] != '' and ($_POST['product_intent_quantity'] == '' or $_POST['product_intent_quantity']>=0)) {
            $arrResult['product_id'] = intval($_POST['product_id']);
            $arrResult['month'] = intval($_POST['month']);
            $arrResult['intent_id'] = intval($_POST['intent_id']);

            $arrResult['product_intent_quantity'] = intval($_POST['product_intent_quantity']);
            if ($arrResult['intent_id'] > 0 and $arrResult['month'] > 0 and $arrResult['product_intent_quantity'] >= 0) {
                $status = update_intent($arrResult['intent_id'], $arrResult['product_id'], $arrResult['month'], $arrResult['product_intent_quantity']);
            } else {
                if ($arrResult['intent_id'] == 0 and $arrResult['month'] > 0 and $arrResult['product_intent_quantity'] >= 0) {
                    add_intent($arrResult['intent_id'], $arrResult['product_id'], $arrResult['month'], $arrResult['product_intent_quantity']);
                }
            }
            
        }
        break;

    default:
        break;
}
?>

<?

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
$out["status"] = $status;

ob_end_clean();
echo json_encode($out);

function get_intent($product_id, $month) {
    global $db;
    $query = "SELECT * FROM `ord_intents` where product_id='$product_id' and month = '$month' limit 1";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return mysqli_fetch_array($result);
}

function update_intent($intent_id, $product_id, $month, $product_intent_quantity) {
    global $db;
    $query = "UPDATE `ord_intents` SET quantity = '$product_intent_quantity' "
            . "WHERE product_id='$product_id' and month = '$month' and id = '$intent_id' limit 1;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return ($result);
}
function add_intent($intent_id, $product_id, $month, $product_intent_quantity) {
    global $db;
    $query = "INSERT INTO ord_intents(date_created,month,product_id,quantity) VALUES(now(), '$month', '$product_id', '$product_intent_quantity');";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return ($result);
}
