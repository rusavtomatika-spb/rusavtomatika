<?

namespace ajax_handle_orders;
define('MAIN_FILE_EXECUTED', true);
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
$out = array();
switch ($_POST["action"]) {
    case 'get_one_logist_order_html':
        \model\get_one_logist_order_html($_POST["logist_order_id"]);
        $out['status'] = 1;
        break;
    case 'get_one_order_payment_form_html':
        \model\get_one_order_payment_form_html($_POST["payment_id"]);
        $out['status'] = 1;
        break;
    case 'get_order_payment_forms_html':
        \model\get_order_payment_forms_html($_POST["order_id"]);
        $out['status'] = 1;
        break;
    case 'get_logist_orders_html':
        \model\get_logist_orders_html($_POST["order_id"]);
        $out['status'] = 1;
        break;
    case 'get_rows':
        if (isset($_POST["fields"]) and $_POST["fields"] != '') {
            $fields = $_POST["fields"];
        } else {
            $fields = ' * ';
        }
        $rows = \model\get_rows_by_condition($_POST["table"], " id > 0 ", $fields);
        foreach ($rows as &$item){
            foreach ($item as &$subitem) {
                $subitem = iconv('ASCII', 'UTF-8//IGNORE', $subitem);
            }
        }
        $out["rows"] = $rows;
        $out['status'] = 1;
        break;

    case 'delete_file':
        $victim_file = $_SERVER['DOCUMENT_ROOT'] . $_POST['file'];
        if (file_exists($victim_file)) {
            unlink($victim_file);
            if (file_exists($victim_file)) {
                echo 'deleted!!!';
                $out['status'] = 0;
            } else {
                $out['status'] = 1;
            }
        } else {
            //echo 'no file!!! '.$victim_file;
            $out['status'] = 0;
        }
        break;
    case 'delete_rows_by_condition':
        $rows_affected = \model\delete_rows_by_condition($_POST["table_name"], $_POST["condition"]);

        $out['rows_affected'] = $rows_affected;
        if ($rows_affected >= 0) {
            $out['status'] = 1;
        } else {
            $out['status'] = 0;
        }
        break;
    case 'delete_row':
        $rows_affected = \model\delete_row($_POST["table_name"], $_POST["id"]);
        $out['rows_affected'] = $rows_affected;
        if ($rows_affected >= 0) {
            $out['status'] = 1;
        } else {
            $out['status'] = 0;
        }
        break;
    case 'add_row':
        $arrParameters['table'] = $_POST["table_name"];
        $arrParameters['fields'] = $_POST["arrData"];
        $insert_id = \model\add_row($arrParameters);
        $out['insert_id'] = $insert_id;
        if ($insert_id >= 0) {
            $out['status'] = 1;
        } else {
            $out['status'] = 0;
        }
        break;
    default:
        $out = array("status" => 0);
        break;
}
$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
echo  json_encode($out);


