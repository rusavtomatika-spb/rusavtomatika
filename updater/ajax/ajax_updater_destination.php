<?php
/**
 * Приёмник обновлений. Ответ — всегда JSON в UTF-8.
 */

@set_time_limit(0);
@ini_set('memory_limit', '512M');
@ini_set('display_errors', 0);
@ini_set('log_errors', 1);
ignore_user_abort(true);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (!defined('bullshit')) { define('bullshit', 1); }

/* Любой fatal превращаем в читаемый JSON, а не в HTML-страницу ошибки */
register_shutdown_function(function () {
    $e = error_get_last();
    if ($e && in_array($e['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR), true)) {
        while (ob_get_level() > 0) { ob_end_clean(); }
        echo json_encode(array(
            'reply'  => 'fail_php_fatal',
            'buffer' => $e['message'] . ' in ' . $e['file'] . ':' . $e['line'],
        ), JSON_UNESCAPED_UNICODE);
    }
});

require_once __DIR__ . '/../control/inc_c_updater_destination.php';

/* Доступ: если пароль задан — только с валидной кукой */
$settingsFile = __DIR__ . '/../settings/settings.php';
$md5 = '';
if (file_exists($settingsFile)) {
    $s = json_decode(file_get_contents($settingsFile), true);
    if (is_array($s) && isset($s['settings']['updater_password'])) {
        $md5 = $s['settings']['updater_password'];
    }
}
if ($md5 !== '' && (!isset($_COOKIE['auth']) || $_COOKIE['auth'] !== $md5)) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(array('reply' => 'fail_auth', 'buffer' => 'Нет доступа (кука auth)'));
    exit;
}

$_POST = json_decode(file_get_contents('php://input'), true);
if (!is_array($_POST)) { $_POST = array(); }

$action = isset($_POST['action']) ? $_POST['action'] : '';
$data   = isset($_POST['data']) && is_array($_POST['data']) ? $_POST['data'] : array();

if ($action === '') {
    echo json_encode(array('reply' => 'fail_no_action', 'buffer' => 'Не передан action'));
    exit;
}

$updater = new c_updater_destination();
$out = '';

try {
    switch ($action) {
        case 'read_settings':
            $out = $updater->read_settings();
            break;
        case 'save_settings':
            $out = $updater->save_settings(isset($data['settings']) ? $data['settings'] : array());
            break;
        case 'create_self_list_of_files':
        case 'create_self_list_of_files_hta':
        case 'create_self_list_of_files_down':
            $out = $updater->create_dest_list_of_files();
            break;
        case 'download_zip_from_source':
            $out = $updater->download_zip_from_source(isset($data['link']) ? $data['link'] : '');
            break;
        case 'extract_zip_list_of_files':
            $out = $updater->extract_zip_list_of_files();
            break;
        case 'download_sql_backup':
            $out = $updater->download_sql_backup(isset($data['link']) ? $data['link'] : '');
            break;
        case 'update_database':
            $out = $updater->update_database();
            break;
        default:
            $out = json_encode(array('reply' => 'fail_unknown_action', 'buffer' => $action));
            break;
    }
} catch (Exception $e) {
    $out = json_encode(array(
        'reply'  => 'fail_exception',
        'buffer' => $e->getMessage(),
    ), JSON_UNESCAPED_UNICODE);
}

echo $out;