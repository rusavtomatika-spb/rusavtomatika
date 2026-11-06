<?php
define('admin', true);
define('PRODUCTS_ALL', true);

if (session_status() === PHP_SESSION_NONE) session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/admin_auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';
require_once __DIR__ . '/auth.php';

$isAllowed = false;
$allowedDomains = array('www.rusavto.moisait.net', 'rusavtomatika.local');
if (in_array($_SERVER['SERVER_NAME'], $allowedDomains)) $isAllowed = true;
if (preg_match('/\.local$/i', $_SERVER['SERVER_NAME']))  $isAllowed = true;
if (!$isAllowed && !empty($_COOKIE['m']))                $isAllowed = true;
if (!$isAllowed) { header('HTTP/1.0 403 Forbidden'); exit('forbidden'); }

$current_admin = check_admin_auth();
if (!$current_admin) { header('Location: /admin/_right.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['run_sync'])) {
    header('Location: /admin'); exit;
}

define('W_BASE', 'https://www.weintek.com');
define('TMP_DIR', __DIR__ . '/tmp');

$type = isset($_POST['type']) ? $_POST['type'] : '';
if (!in_array($type, array('x', 'pro'), true)) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не указан тип (x/pro)');
    header('Location: /admin'); exit;
}

$jar = isset($_SESSION['weintek_cookies']) ? $_SESSION['weintek_cookies'] : array();

if (empty($jar)) {
    if (function_exists('w_login')) {
        $login_result = w_login();
        if (empty($login_result['success'])) {
            $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось авторизоваться: ' . $login_result['message']);
            header('Location: /admin'); exit;
        }
        $jar = isset($login_result['jar']) ? $login_result['jar'] : $_SESSION['weintek_cookies'];
    } else {
        $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Нет кук Weintek и нет w_login()');
        header('Location: /admin'); exit;
    }
}

$downloadPageUrl = W_BASE . '/Download/Software';
$r = w_request($downloadPageUrl, 'GET', null, $jar, true);
if (!$r['ok'] || $r['code'] !== 200) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Ошибка загрузки /Download/Software (HTTP ' . $r['code'] . ')');
    header('Location: /admin'); exit;
}
w_parse_set_cookies($r['headers'], $jar);
$_SESSION['weintek_cookies'] = $jar;

$html = $r['body'];

if (stripos($html, 'You are not logged in') !== false || stripos($html, '/Account/Login') !== false) {
    if (function_exists('w_login')) {
        $login_result = w_login();
        if (!empty($login_result['success'])) {
            $jar = isset($login_result['jar']) ? $login_result['jar'] : $_SESSION['weintek_cookies'];
            $r = w_request($downloadPageUrl, 'GET', null, $jar, true);
            if ($r['ok'] && $r['code'] === 200) {
                $html = $r['body'];
                w_parse_set_cookies($r['headers'], $jar);
                $_SESSION['weintek_cookies'] = $jar;
            }
        }
    }
    if (stripos($html, 'You are not logged in') !== false || stripos($html, '/Account/Login') !== false) {
        $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось получить доступ к /Download/Software (страница логина)');
        header('Location: /admin'); exit;
    }
}

$isX = ($type === 'x');

$zipUrl = null;
$fileNameFromPage = null;

$needle = $isX ? 'EasyBuilder X' : 'EasyBuilder Pro';
$pos = stripos($html, $needle);

if ($pos !== false) {
    $chunk = substr($html, $pos, 5000);

    if (preg_match('/>\s*([^<>\s]+\.zip)\s*</i', $chunk, $mFile)) {
        $fileNameFromPage = $mFile[1];
    }

    if (preg_match('/<a[^>]+href="(\/Download\/FileLink\?[^"]+)"[^>]*>/i', $chunk, $mLink)) {
        $zipUrl = html_entity_decode($mLink[1], ENT_QUOTES, 'UTF-8');
    }
}

if ($zipUrl === null) {
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Не найдена ссылка FileLink для ' . ($isX ? 'EasyBuilder X' : 'EasyBuilder Pro') . ' на /Download/Software'
    );
    header('Location: /admin'); exit;
}

if (strpos($zipUrl, 'http') !== 0) {
    $zipUrl = rtrim(W_BASE, '/') . '/' . ltrim($zipUrl, '/');
}

if (!is_dir(TMP_DIR)) @mkdir(TMP_DIR, 0775, true);

$fileName = $fileNameFromPage;
if ($fileName === null || $fileName === '') {
    $fileName = 'weintek_' . $type . '_' . date('Ymd_His') . '.zip';
}
$fileName = basename($fileName);

$filePath = TMP_DIR . '/' . $fileName;

$fp = fopen($filePath, 'wb');
if ($fp === false) {
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'Не удалось открыть файл для записи: ' . $filePath);
    header('Location: /admin'); exit;
}

$ch = curl_init($zipUrl);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 600);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_USERAGENT, W_UA);
curl_setopt($ch, CURLOPT_REFERER, $downloadPageUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: */*',
));
if (!empty($jar)) {
    curl_setopt($ch, CURLOPT_COOKIE, w_cookie_header($jar));
}

$ok = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$err = curl_error($ch);
curl_close($ch);
fclose($fp);

if (!$ok || $code !== 200 || filesize($filePath) < 1024) {
    $size = @filesize($filePath);
    @unlink($filePath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Ошибка скачивания (HTTP ' . $code . ', size=' . (int)$size . ', ' . $err . ')'
    );
    header('Location: /admin'); exit;
}

if (stripos((string)$contentType, 'html') !== false) {
    @unlink($filePath);
    $_SESSION['sync_toast'] = array(
        'type' => 'error',
        'text' => 'Вместо файла пришёл HTML (Content-Type: ' . $contentType . ')'
    );
    header('Location: /admin'); exit;
}

$size = filesize($filePath);
$_SESSION['sync_toast'] = array(
    'type' => 'success',
    'text' => 'Скачано: ' . $fileName . ' (' . formatSizeUnits($size) . ')'
);
header('Location: /admin'); exit;

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
    if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
    if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
    return $bytes . ' B';
}