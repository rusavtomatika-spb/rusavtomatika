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


switch ($_POST['action']) {
    case 'get_comments':
        if ($_POST['order_id'] != ''){
            $arrResult['order'] = \model\get_order($_POST['order_id']);
            $arrResult['comments'] = get_comments($_POST['order_id']);
            $arrResult['current_user_login_md5'] = $_POST['current_user_login_md5'];
                    include $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/panel_order_comments.php';
                    $status = 1;  
        }        
        break;
    case 'send_message':
        if ($_POST['order_id'] != ''){
            $message = strip_tags($_POST['message']);
            $insert_id = add_message($_POST['order_id'],$_POST['current_user_login_md5'], $message);
            if ($insert_id) {
                $status = 1;
                $last_comment_short = (strlen($message) > 60) ? substr($message, 0, 57) . "..." : $message;
                $last_comment_long = (strlen($message) > 300) ? substr($message, 0, 297) . "..." : $message;
                $out["last_comment_short"] = $last_comment_short;
                $out["last_comment_long"] = $last_comment_long;
                $out["order_id"] = $_POST['order_id'];
            }
        }
        break;
    case 'delete_message':
        if (delete_comment($_POST['order_id'], $_POST['message_id'], $_POST['current_user_login_md5'])){
            $status = TRUE;
        };        
        break;
    case 'update_message':
            $status = update_message(
                    $_POST['order_id'],
                    $_POST['comment_id'], 
                    $_POST['current_user_login_md5'],
                    $_POST['text']);
                 
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



function update_message($order_id, $message_id, $current_user_login_md5, $text) {
    global $db;
    if (mb_detect_encoding($text) == 'UTF-8') {
        $text = iconv("utf-8", "windows-1251", $text);
    }
    $user = get_user_by_login_md5($current_user_login_md5);
    $user_id = $user['id'];
    $query = "UPDATE ord_comments ".
            "SET text = '$text', date_modified = now()".
            "WHERE id = '$message_id' AND ext_id = '$order_id' ".
            "AND ext_table = 'ord_orders' AND author_id = '$user_id' LIMIT 1;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return $result;
}



function delete_comment($order_id, $message_id, $current_user_login_md5) {
    global $db;
    $user = get_user_by_login_md5($current_user_login_md5);
    $user_id = $user['id'];
    $query = "DELETE FROM ord_comments WHERE id = '$message_id' AND ext_id = '$order_id' AND ext_table = 'ord_orders' AND author_id = '$user_id' LIMIT 1;";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return $result;
}

function add_message($order_id,$current_user_login_md5, $message){
     if (mb_detect_encoding($message) == 'UTF-8') {
        $message = iconv("utf-8", "windows-1251", $message);
    }
    $user = get_user_by_login_md5($current_user_login_md5);
    global $db;
    $message = strip_tags($message);
    $message = trim($message);
    $query = "INSERT INTO ord_comments(ext_id,ext_table,text,author_id,date_creating) "
            . "VALUES($order_id,'ord_orders','$message','{$user['id']}',now());";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return  mysqli_insert_id($db);
}

function get_user_by_login_md5($login_md5) {
    global $db;
    $query = "SELECT * FROM ord_users WHERE login_md5 = '$login_md5'; ";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    return  mysqli_fetch_array($result);            
}


function get_comments($order_id) {
    global $db;
    $out = NULL;
    //echo $query = "SELECT * FROM `ord_comments` where ext_id='$order_id' and ext_table='ord_orders'  order by `date_creating`;";
    
    $query = "SELECT "            
            . "ord_comments.*, "
            . "DATE_FORMAT(ord_comments.date_creating, '%d-%m-%Y %H:%i:%s') as time, "
            . "DATE_FORMAT(ord_comments.date_modified, '%d-%m-%Y %H:%i:%s') as modified, "
            . "ord_users.name, "
            . "ord_users.id as user_id, "
            . "ord_users.login_md5 "
            . "FROM ord_comments, ord_users "
            . "WHERE ord_comments.author_id = ord_users.id "
            . "and ext_id='$order_id' "
            . "and ext_table='ord_orders' "
            . "order by `date_creating`";
    
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $out[] = $row;
    }
    return $out;
}



