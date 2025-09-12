<?php


ini_set('error_reporting', E_ALL && ~e_deprecated);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=windows-1251');
$_POST = json_decode(file_get_contents('php://input'), true);
//require_once __DIR__.'/../control/inc_c_processing_files.php';

require_once __DIR__.'/../control/inc_c_updater_destination.php';
//require_once __DIR__.'../control/inc_c_updater_destination.php';
global $updater_destination;
$updater_destination = new c_updater_destination();

if (isset($_POST["action"]) and $_POST["action"] != "") {
    switch ($_POST["action"]) {
        case 'create_self_list_of_files':
            echo $updater_destination->create_dest_list_of_files();
            break;
        case 'download_zip_from_source':
            echo $updater_destination->download_zip_from_source($_POST["data"]["link"]);
            break;
        case 'extract_zip_list_of_files':
            echo $updater_destination->extract_zip_list_of_files();
            break;
        case 'download_sql_backup':
            echo $updater_destination->download_sql_backup($_POST["data"]["link"]);
            break;
        case 'update_database':
            echo $updater_destination->update_database();
            break;
        case 'read_settings':
            echo $updater_destination->read_settings();
            break;
        case 'save_settings':
            echo $updater_destination->save_settings($_POST["data"]["settings"]);
            break;

        default:
            break;
    }
}












