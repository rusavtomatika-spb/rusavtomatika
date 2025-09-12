<?php
if (!function_exists('var_dump_pre')) {
    function var_dump_pre(...$values)
    {
        foreach ($values as $value) {
            echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
            var_dump($value);
            echo "</pre>";
        }
    }
}




if (1) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

if (empty($_COOKIE['a']))
    exit;

if (!defined('admin')){
    define('admin',"1");
}



include $_SERVER["DOCUMENT_ROOT"]."/admin/config/admin_dbcon.php";
global $mysqli_db;


database_connect();


?><form  method="post">
 <p>ID source: <input type="text" name="source" /></p>
 <p>ID destination: <input type="text" name="destination" /></p>
 <p><input type="submit" /></p>
</form><?


//var_dump($_POST);

if(isset($_POST["source"]) and isset($_POST["destination"])){
    $source_id = intval($_POST["source"]);
    $destination_id = intval($_POST["destination"]);
    if($source_id > 0 and $destination_id >0){
        $row = get_rows_from_table("products_all", "", $condition = "`index`=$source_id");
        $row2 = get_rows_from_table("products_all", "", $condition = "`index`=$destination_id");
        if(isset($row[0]) and is_array($row[0]) and isset($row2[0]) and is_array($row2[0]) ){
            echo "<br>";
            echo "<h2>{$row[0]['index']} {$row[0]['model']}</h2>";
            echo "<h2>{$row2[0]['index']} {$row2[0]['model']}</h2>";
            echo "<br>";

            $set = "";
            foreach ($row[0] as $key => $val){
                if($key != "index" and $key != "model" and $key != "retail_price"){
                    $set .= " `$key` = '$val' ,";
                }
                //echo $key." ".$val."<br>";
            }

            $set = trim($set,", ");

            $query = "UPDATE `moisait_ra`.`products_all` SET {$set} WHERE `products_all`.`index` = '{$destination_id}';";
            $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
            var_dump_pre($result);
        }
    }else{

    }
}

/**********************************************************************************************************************/



function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
{

    global $mysqli_db;
    $out = array();
    $query = "SELECT ";
    if ($selected_fields != '') $query .= " " . $selected_fields . " ";
    else $query .= " * ";
    $query .= " FROM " . $table_name . " ";
    if ($condition != '') $query .= " WHERE " . $condition . " ";
    if ($order != '') $query .= " ORDER BY  " . $order . " ";
    if ($limit != '') $query .= " LIMIT  " . $limit . " ";


    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row;
    }

    return $out;
}