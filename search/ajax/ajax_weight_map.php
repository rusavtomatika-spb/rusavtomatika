<?
define('MAIN_FILE_EXECUTED',true);
ob_start();
require_once('../model/inc_dbconnect.php');
require_once('../controller/inc_functions.php');
if ($_POST["action"] == 'edit_field') {
    if ($_POST["id"] > 0) {

        $field_name = $_POST["field_name"];
        $value = mysqli_real_escape_string($db, $_POST["value"]);
        ;
        $id = intval($_POST["id"]);
        ;
        $query2 = "UPDATE search_index_weight_map SET {$field_name}='{$value}' where id = '{$id}';";
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
    } else
    if ($_POST["id"] == 'new') {
        $value = mysqli_real_escape_string($db, $_POST["value"]);
        $field_name = $_POST["field_name"];
        if ($field_name != "url"){
         $query2 = "INSERT INTO `search_index_weight_map` (`id`,`url`, `$field_name`) VALUES (NULL, 'url".rand()."', '$value');";        
        }
        else
            {
             $query2 = "INSERT INTO `search_index_weight_map` (`id`, `$field_name`) VALUES (NULL, '$value');";
            
            }            
            
        $result = mysqli_query($db, $query2);
        echo mysqli_error($db);
        echo "***".mysqli_errno($db)."***";

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
    } else {
        $out = array("status" => 0);
        $out["id"] = $id;
        $out["old_value"] = $_POST["old_value"];
        $out["field_name"] = $_POST["field_name"];
    }
    $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
} 
else if ($_POST["action"] == 'delete_row') {
    if ($_POST["id"]>0){        
    $query = "DELETE FROM `search_index_weight_map` WHERE `id` = '{$_POST["id"]}';";
    $result = mysqli_query($db, $query);
        if ($result) {
            $out = array("status" => 1);
            $out["id"] = $_POST["id"];
        }
        else{$out = array("status" => 0);}
    }    
    $out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
}
else {
    $out = array("status" => 0);
    $out["id"] = $id;
    $out["old_value"] = $_POST["old_value"];
    $out["field_name"] = $_POST["field_name"];
}
ob_end_clean();
echo json_encode($out);
?>