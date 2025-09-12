<?

define('MAIN_FILE_EXECUTED', true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if (isset($_POST["name"])) {
        $product_name = strip_tags($_POST["name"]);
    }
} elseif (isset($_GET["action"])) {
    $action = $_GET["action"];
    if (isset($_GET["name"]))
        $product_name = strip_tags($_GET["name"]);
}

$out = Array();

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new_includes/inc_dbconnect.php';
require_once 'model.php';
switch ($action) {
    case 'update_values':
        update_product();
        $out["status"] = 1;
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
        break;
    case 'edit_field':
        if ($_POST["id"] > 0) {
            $value = mysqli_real_escape_string($db, $_POST["value"]);
            if (mb_detect_encoding($value) == 'UTF-8') {
                $value = iconv("utf-8", "windows-1251", $value);
            };
            $id = intval($_POST["id"]);
            $field_name = $_POST["field_name"];
            $query2 = "UPDATE `ord_products` SET {$field_name}='{$value}' where id = '{$id}';";
            $result = mysqli_query($db, $query2);
            if ($result) {
                $out = array("status" => 1);
            } else {
                echo mysqli_error($db);
                $out = array("status" => 0);
                $out["id"] = $id;
                $out["is_error"] = true;
                $out["old_value"] = $_POST["old_value"];
                $out["field_name"] = $_POST["field_name"];
            }
        } /* else
          if ($_POST["id"] == 'new') {
          $value = mysqli_real_escape_string($db, $_POST["value"]);
          $field_name = $_POST["field_name"];
          if ($field_name != "url") {
          $query2 = "INSERT INTO `ord_products` (`id`,`url`, `$field_name`) VALUES (NULL, 'url" . rand() . "', '$value');";
          } else {
          $query2 = "INSERT INTO `search_index_weight_map` (`id`, `$field_name`) VALUES (NULL, '$value');";
          }
          $result = mysqli_query($db, $query2);
          echo mysqli_error($db);
          echo "***" . mysqli_errno($db) . "***";
          if ($result) {
          $new_id = mysqli_insert_id($db);
          if ($new_id > 0) {
          $out = array("status" => 1);
          $out["id"] = 'new';
          $out["new_id"] = $new_id;
          $out["old_value"] = $_POST["old_value"];
          $out["field_name"] = $_POST["field_name"];
          } else {
          $out = array("status" => 0);
          }
          } else {
          $out = array("status" => 0);
          $out["id"] = $id;
          $out["old_value"] = $_POST["old_value"];
          $out["field_name"] = $_POST["field_name"];
          }
          } */ else {
            $out = array("status" => 0);
            $out["id"] = $id;
            $out["old_value"] = $_POST["old_value"];
            $out["field_name"] = $_POST["field_name"];
        }
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());


        break;
    case 'delete_row':
        if ($_POST["id"] > 0) {
            $query = "DELETE FROM `` WHERE `id` = '{$_POST["id"]}';";
            $result = mysqli_query($db, $query);
            if ($result) {
                $out = array("status" => 1);
                $out["id"] = $_POST["id"];
            } else {
                $out = array("status" => 0);
            }
        }
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
        break;
    case 'add_product':
        $arrCurrencies = \model\get_reference_price_currencies();
        $arrBrands = \model\get_all_brands();
        include $_SERVER['DOCUMENT_ROOT'] . '/orders/template/component_templates/form_add_product.php';
        $out["status"] = 1;
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
        break;
    case 'save_product':
        $arrParameters['table'] = 'ord_products';
        if (isset($_POST['active'])) {
            $arrParameters['fields']['active'] = $_POST['active'];
        } else {
            $arrParameters['fields']['active'] = 1;
        }
        $arrParameters['fields']['description'] = $_POST['description'];
        $arrParameters['fields']['name'] = $_POST['name'];
        $arrParameters['fields']['name_1c'] = $_POST['name_1c'];
        $arrParameters['fields']['artikul_1c'] = $_POST['artikul_1c'];
        $arrParameters['fields']['presence_1c'] = $_POST['presence_1c'];

        $arrParameters['fields']['reference_price_currency'] = $_POST['reference_price_currency'];
        $arrParameters['fields']['position'] = 1;
        $arrParameters['fields']['row_type'] = $_POST['row_type'];
        if ($_POST['brand_new'] != '') {
            $arrParameters['fields']['brand'] = $_POST['brand_new'];
        } else {
            $arrParameters['fields']['brand'] = $_POST['brand'];
        }
        $out["status"] = \model\add_row($arrParameters);
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
        break;

    case 'delete_separator':
        $out["status"] = \model\delete_separator($_POST["separator_id"]);
        break;
    case 'get_product_by_name':
        $product = \model\get_product_by_name($product_name);
        if (isset($product) and is_array($product)) {
            var_dump($product);
            //$out["product"] = $product;
            $out["product"]["name"] = $product["name"];
            $out["product"]["name_rus"] = $product["name_rus"];
            $out["product"]["description_rus"] = $product["description_rus"];
            $out["product"]["name_1c"] = $product["name_1c"];
            $out["product"]["artikul_1c"] = $product["artikul_1c"];
            $out["product"]["presence_1c"] = $product["presence_1c"];
            $out["product"]["id"] = $product["id"];
            $out["product"]["active"] = $product["active"];
            //$out["product"]["name_1c"] = iconv("windows-1251", "utf-8", $product["name_1c"]);
            $out["product"]["brand"] = $product["brand"];
            $out["product"]["reference_price"] = $product["reference_price"];
            $out["product"]["reference_price_currency"] = $product["reference_price_currency"];
            $out["product"]["moq"] = $product["moq"];
            $out["product"]["description"] = $product["description"];
            $out["status"] = 1;
        }
        $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
        break;
    default:
        $out = array("status" => 0);
        $out["id"] = $id;
        $out["old_value"] = $_POST["old_value"];
        $out["field_name"] = $_POST["field_name"];
        break;
}

//$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
ob_end_clean();
//var_dump($out);
echo json_encode($out);

function update_product()
{
    global $db;
    $product_id = $_POST["product_id"];
    //$arFields = $_POST["fields"];
    foreach ($_POST['fields'] as $field) {
        if (isset($_POST[$field])) {
            $arFields[$field] = $_POST[$field];
        }
    }

    if ($product_id > 0) {
        $constructor = "";
        foreach ($arFields as $key => $value) {
            if (mb_detect_encoding($value) == 'UTF-8') {
                $value = iconv("UTF-8", "windows-1251", $value);
            }
            $constructor .= " `$key` = '$value',";
        }
        $constructor = trim($constructor, ',');
        echo $query = "UPDATE `ord_products` SET $constructor where id='$product_id';";
        echo " ************************************************************ ";
        $result = mysqli_query($db, $query) or die("Invalid query update_product: " . $query . "  " . mysqli_error($db));
        return ($result);
    }
    return false;
}
