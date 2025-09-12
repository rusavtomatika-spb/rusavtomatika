<?php

use abacus\admin\classes\Database;

require __DIR__ . "/../prolog_before.php";

$_POST = json_decode(file_get_contents('php://input'), true);
ob_start();
$result = [];
if (isset($_POST["command"])) {
    switch ($_POST["command"]) {
        case "products.get.list":
            $db = new Database();
            $rows = $db->products_get_list();
            if (is_array($rows)) {
                foreach ($rows as $product) {
                    $result[] = [
                        'id' => $product['index'],
                        "model" => $product["model"],
                        "brand" => $product["brand"],
                        "type" => $product["type"],
                        "series" => $product["series"],
                        "price" => $product["retail_price"],
                        "price_hide" => $product["retail_price_hide"],
                    ];
                }
            }
            break;
        case "product.get":
            if (isset($_POST["data"]["id"]) and $_POST["data"]["id"] > 0) {
                $db = new Database();
                $product_fields = $db->product_get($_POST["data"]["id"]);
                $field_descriptions = $db->get_catalog_field_descriptions();
                $field_descriptions2 = $db->get_catalog_field_descriptions2();
                $arr_fields = [];
                foreach ($product_fields as $key => $field) {
                    $arr_fields[$key]['value'] = $field;
                    if(isset($field_descriptions[$key]["name"])){
                        $arr_fields[$key]['rus_name'] = $field_descriptions[$key]["name"];
                    }
/*                    if(isset($field_descriptions[$key]["field_type"])){
                        $arr_fields[$key]['field_type'] = $field_descriptions[$key]["field_type"];
                    }else{

                    }*/
                    $arr_fields[$key]['field_type'] = $field_descriptions2[$key]["Type"];
                }
                $result["product_fields"] = $product_fields;
                $result["field_descriptions"] = $arr_fields;


            }
            break;
        case "product.save":
            if(isset($_POST["data"]['index']) and $_POST["data"]['index'] > 0){
                $db = new Database();
                $result = $db->product_save($_POST["data"]);
            }

            break;
        case "product.delete":
            if(isset($_POST["data"]['index']) and $_POST["data"]['index'] > 0){
                $db = new Database();
                $result = $db->product_delete($_POST["data"]);
            }
            break;
        case "product.copy":
            if(isset($_POST["data"]['index']) and $_POST["data"]['index'] > 0){
                $db = new Database();
                $result = $db->product_copy($_POST["data"]);
            }
            break;

    }
}

$out["buffer"] = ob_get_clean();
$out["result"] = $result;

echo json_encode($out);


