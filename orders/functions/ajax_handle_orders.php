<?
namespace ajax_handle_orders;
define('MAIN_FILE_EXECUTED', true);
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';

$out = array();
switch ($_POST["action"]) {
    case 'get_all_invoices':
        $order_id = intval($_POST['order_id']);
        if ($order_id > 0) {
            \model\get_all_html_invoices_by_order_id($order_id);
            $out["status"] = 1;
        } else $out["status"] = 0;
        break;
    case 'upload_file':
        $out["invoice"] = upload_file();
        if (is_array($out["invoice"])) $out["status"] = 1;
        else $out["status"] = 0;
        break;
    case 'get_order_panel':
        get_order_panel();
        $out = array("status" => 1);
        break;
    case 'get_form_new_order':
        include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/form_order.php';
        break;

    case 'get_all_orders':
        $orders = \model\get_orders();
        include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/table_all_orders.php';
        $out = array("status" => 1);
        break;
    case 'save_cell':
        $status = \model\save_cell($_POST["table_name"], $_POST["id"], $_POST["field_name"], $_POST["value"]);
        $out = array("status" => $status);
        break;
    case 'add_new_order':
        $new_order = \model\add_new_order();
        $out["status"] = 1;
        $out["new_order"] = $new_order;
        break;
    default:
        $out["status"] = 0;
        if (isset($id)) $out["id"] = $id;
        $out["old_value"] = $_POST["old_value"];
        $out["field_name"] = $_POST["field_name"];
        break;
}

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
//$out["buffer"] = ob_get_contents();

ob_end_clean();
echo json_encode($out);


////////////////
///
///
///
///


function upload_file()
{
    $order_id = $_POST['order_id'];
    $path = $_POST['path'];
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        echo $destination_path = '/orders/invoices' . $path;
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $destination_path)) {
            if (!mkdir($_SERVER['DOCUMENT_ROOT'] . $destination_path, 0777, true)) {
                echo('Failed to create folders...');
                return;
            }
        }
        $now = Date('Y-m-d_H-i-s');
        $destination_file = $destination_path . $_FILES['file']['name'];
        $destination_file = str_ireplace('.xls','_'.$now.'.xls',$destination_file);
        $success = move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $destination_file);
        if ($success) {
            $arrParameters['table'] = 'ord_invoices';
            $arrParameters['fields']['order_id'] = $order_id;
            $arrParameters['fields']['status'] = 'загружено';
            $arrParameters['fields']['file'] = $destination_file;
            $arrParameters['fields']['name'] = $_FILES['file']['name'];
            $arrParameters['fields']['date'] = date("Y-m-d");
            $result = \model\add_row($arrParameters);
            if ($result) {
                $invoice = \model\get_row_by_id('ord_invoices', $result);
                //var_dump($invoice);
                return $invoice;
            } else {
                echo "error add_row";
            }
        }
    }
}

function create_invoice()
{
}

function get_order_panel()
{
    $orders = \model\get_orders(array(
        'month' => $_POST["month"],
        'brand' => $_POST["brand"],
    ));
    $arrResult['product_id'] = intval($_POST["product_id"]);
    $arrResult['product'] = \model\get_product($arrResult['product_id']);
    $arrResult['month'] = intval($_POST["month"]);
    $arrResult['year'] = intval($_POST["year"]);
    $arrResult['brand'] = strip_tags($_POST["brand"]);
    $arrResult['intent_id'] = intval($_POST["intent_id"]);
    include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/form_order.php';
}
