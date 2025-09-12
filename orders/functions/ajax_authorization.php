<?php
define('MAIN_FILE_EXECUTED',true);
if (1) {
    ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/sc/lib_new_includes/inc_dbconnect.php';
$status = 0;

switch ($_POST['action']) {
    case 'start_login':
include $_SERVER['DOCUMENT_ROOT'].'/orders/template/component_templates/form_do_login.php';
    $status = 1;
        break;
    case 'do_login':
        $status = 1;
        $current_user = get_user($_POST["login"],$_POST["password"]);
        if($current_user !== NULL){
            echo '<span title="'.$current_user['role'].'" class="current_user" data-user-code="'.$current_user['login_md5'].'">[ '.$current_user['name'].' ]</span><span class="user_logout">Выход</span>';
        }else{
            $status = 3;
            echo '<span class="current_user">Неверно!</span><span class="user_try_again">Еще раз</span>';
        }
        break;
    case 'check_user':
        $status = 1;
        $current_user = get_user_by_md5($_POST["login_md5"]);
        if($current_user !== NULL){
            echo '<span title="'.$current_user['role'].'" class="current_user" data-user-code="'.$current_user['login_md5'].'">[ '.$current_user['name'].' ]</span><span class="user_logout">Выход</span>';
        }else{
            $status = 3;
            echo '<span class="current_user">Неверно!</span><span class="user_try_again">Еще раз</span>';
        }
        break;       

    default:
        break;
}
function get_user($login, $password) {
    global $db;
    $query = "SELECT * FROM `ord_users` where login='$login' and password='$password'";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    if ($result) {
        return mysqli_fetch_array($result);
    } else {
        return NULL;
    }
}
function get_user_by_md5($login_md5) {
    global $db;
    $query = "SELECT * FROM `ord_users` where login_md5='$login_md5'";
    $result = mysqli_query($db, $query) or die("Invalid query: " . $query . "  " . mysqli_error($db));
    if ($result) {
        return mysqli_fetch_array($result);
    } else {
        return NULL;
    }
}

$out["buffer"] = iconv("windows-1251", "utf-8", ob_get_contents());
$out["status"] = $status;

ob_end_clean();
echo json_encode($out);