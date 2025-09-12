<?php
define('MAIN_FILE_EXECUTED',true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
require_once $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';
//echo $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';


if (count($_POST['positions'])>0){
    $counter = 100;
    foreach ($_POST['positions'] as $id) {
        $query = "UPDATE `ord_products` SET position='".$counter."' where id='".$id."';";
        $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
        $counter += 100;
    }
}

//if ($_POST['action'] == 'change_positions'){
//    var_dump($_POST['data']);
//}