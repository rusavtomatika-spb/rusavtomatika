<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

@set_time_limit(0);
@ini_set('memory_limit', '512M');

/* ================= ОГРАНИЧИТЕЛИ (должны совпадать с приёмником) ================= */
define('UPDATER_ONLY_ROOT_FOLDERS', '');
define('UPDATER_EXCLUDE_DIRS_ANY',  'node_modules,cache,data,sql_backups,logs,log,tmp,temp');
define('UPDATER_EXCLUDE_DIRS_ROOT', 'images,upload_files,documents,download,backup,backups,updater_source,updater,export,upl,import,test,admin,service,3d,weintek_projects,weintek_libraries,weintek_drivers,lightbox');
define('UPDATER_INCLUDE_EXT',       'php,js,css,html,htm,xml,txt,json,svg,htaccess');
define('UPDATER_EXCLUDE_FILES',     'settings.php,error_log,usdrate.txt');
define('UPDATER_MAX_FILES',         20000);
define('UPDATER_MAX_FILE_SIZE',     2097152);
define('UPDATER_ZIP_CHUNK',         300);
/* ============================================================================== */

define('DATA_PATH', __DIR__ . '/data/');
define('FILENAME_SOURCE_LIST_OF_FILES', __DIR__ . '/data/source_list_of_files.txt');
define('FILENAME_DEST_LIST_OF_FILES', __DIR__ . '/data/dest_list_of_files.txt');
define('FILENAME_DIFFERENCE_LIST_OF_FILES', __DIR__ . '/data/difference_list_of_files.txt');
define('FILENAME_ZIP_DIFF_FILES', __DIR__ . '/data/archive_difference_files.zip');
define('URL_FILENAME_ZIP_DIFF_FILES', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/updater_source/data/archive_difference_files.zip');
define('PATH_TO_EXPORT_BACKUPS', __DIR__ . '/data/sql_backups/');
define('URL_PATH_TO_EXPORT_BACKUPS_PATH', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/updater_source/data/sql_backups/');

require_once __DIR__ . '/inc_c_processing_files.php';
require_once __DIR__ . '/inc_updater_functions.php';

$_POST = json_decode(file_get_contents('php://input'), true);
if (!is_array($_POST)) { $_POST = array(); }

$action = isset($_POST['action']) ? $_POST['action'] : '';
$data   = isset($_POST['data']) && is_array($_POST['data']) ? $_POST['data'] : array();
if ($action === '') { exit; }

$updater_source = new c_updater_source();

switch ($action) {
    case 'get_current_step':                 echo $updater_source->get_current_step(); break;
    case 'take_dest_list_of_files':          echo $updater_source->take_dest_list_of_files($data); break;
    case 'create_source_list_of_files':      echo $updater_source->create_source_list_of_files($data); break;
    case 'create_difference_list_of_files':  echo $updater_source->create_difference_list_of_files(); break;
    case 'create_zip_list_of_files':         echo $updater_source->create_zip_list_of_files($data); break;
    case 'update_database_create_sql_dump':  echo $updater_source->update_database_create_sql_dump(); break;
}