<?php
header('Access-Control-Allow-Origin: *');

define("DATA_PATH", __DIR__ . "/data/");
define("FILENAME_SOURCE_LIST_OF_FILES", __DIR__ . "/data/source_list_of_files.txt");
define("FILENAME_DEST_LIST_OF_FILES", __DIR__ . "/data/dest_list_of_files.txt");

define("PRINT_FILENAME_SOURCE_LIST_OF_FILES", __DIR__ . "/data/PRINT_source_list_of_files.txt");
define("PRINT_FILENAME_DEST_LIST_OF_FILES", __DIR__ . "/data/PRINT_dest_list_of_files.txt");

define("FILENAME_DIFFERENCE_LIST_OF_FILES", __DIR__ . "/data/difference_list_of_files.txt");

define("FILENAME_ZIP_DIFF_FILES", __DIR__ . "/data/archive_difference_files.zip");
define("URL_FILENAME_ZIP_DIFF_FILES", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/updater_source/data/archive_difference_files.zip");

define("PATH_TO_EXPORT_BACKUPS", __DIR__ . '/data/sql_backups/');
define("URL_PATH_TO_EXPORT_BACKUPS_PATH", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/updater_source/data/sql_backups/");



global $exclude_folders_regs;
global $exclude_file_ext_regs;

require_once 'inc_c_processing_files.php';
require_once 'inc_updater_functions.php';
$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST["action"]) and $_POST["action"] != "") {

    $updater_source = new c_updater_source();

    switch ($_POST["action"]) {
        case 'get_current_step':
            echo $updater_source->get_current_step();
            break;
        case 'take_dest_list_of_files':
            echo $updater_source->take_dest_list_of_files($_POST["data"]);
            break;
        case 'create_source_list_of_files':
            echo $updater_source->create_source_list_of_files($_POST["data"]);
            break;
        case 'create_difference_list_of_files':
            echo $updater_source->create_difference_list_of_files();
            break;
        case 'create_zip_list_of_files':
            echo $updater_source->create_zip_list_of_files();
            break;
        case 'update_database_create_sql_dump':
            echo $updater_source->update_database_create_sql_dump();
            break;
        default:
            break;
    }
}
