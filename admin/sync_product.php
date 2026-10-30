<?php
require_once 'admin_auth.php';

$isAllowed = false;
$allowedDomains = array('www.rusavto.moisait.net', 'rusavtomatika.local');
if (in_array($_SERVER['SERVER_NAME'], $allowedDomains)) $isAllowed = true;
if (preg_match('/\.local$/i', $_SERVER['SERVER_NAME']))  $isAllowed = true;
if (!$isAllowed && !empty($_COOKIE['m']))                $isAllowed = true;

if (!$isAllowed) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Доступ запрещен. Неизвестный маршрут.';
    exit;
}

$current_admin = check_admin_auth();
if (!$current_admin) {
    header('Location: /admin/_right.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['run_sync'])) {
    header('Location: /admin');
    exit;
}

define('admin', true);
define('PRODUCTS_ALL', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';

$key_path = __DIR__ . '/scrt.php';
if (!is_file($key_path)) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('key file not found');
}
$key_hex = require $key_path;
$key_hex = trim((string)$key_hex, " \t\n\r\0\x0B\"'");
$sync_key = hex2bin($key_hex);
if ($sync_key === false || strlen($sync_key) !== 32) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('key invalid');
}

define('STOCK_MODE', 'sum');
define('ONSTOCK_VALUE', 1);

function sync_decrypt($b64, $key) {
    $raw = base64_decode($b64, true);
    if ($raw === false || strlen($raw) < 16 + 32) return false;
    $iv     = substr($raw, 0, 16);
    $mac    = substr($raw, 16, 32);
    $cipher = substr($raw, 48);
    $calc   = hash_hmac('sha256', $iv . $cipher, $key, true);
    if (!hash_equals($calc, $mac)) return false;
    return openssl_decrypt($cipher, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}

$sync_db = new mysqli('localhost', 'user', '123123', 'msbd');
if ($sync_db->connect_errno) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('sync db connect error');
}
$sync_db->set_charset('utf8mb4');

$sync_secrets = array();
$res = $sync_db->query("SELECT `name`, `value` FROM `scrt`");
if (!$res) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('sync secrets query error');
}
while ($row = $res->fetch_assoc()) {
    $dec = sync_decrypt($row['value'], $sync_key);
    if ($dec === false) {
        header('HTTP/1.0 500 Internal Server Error');
        exit('sync secret decrypt failed: ' . $row['name']);
    }
    $sync_secrets[$row['name']] = $dec;
}
$sync_db->close();

if (empty($sync_secrets['api_url'])) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('api_url not configured');
}

define('API_URL',   $sync_secrets['api_url']);
define('API_LOGIN', isset($sync_secrets['api_login']) ? $sync_secrets['api_login'] : '');
define('API_PASS',  isset($sync_secrets['api_pass'])  ? $sync_secrets['api_pass']  : '');

function sync_api_request($url, $login, $pass) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    if ($login !== '' || $pass !== '') {
        curl_setopt($ch, CURLOPT_USERPWD, $login . ':' . $pass);
    }

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err       = curl_error($ch);
    curl_close($ch);

    if ($response === false || $http_code >= 400) {
        return array('ok' => false, 'error' => 'HTTP ' . $http_code . ' ' . $err, 'body' => $response);
    }
    return array('ok' => true, 'body' => $response);
}

function sync_normalize($s) {
    $s = (string)$s;
    $s = str_replace(array("\xC2\xA0", "\r", "\n", "\t"), ' ', $s);
    $s = preg_replace('/\s+/u', ' ', $s);
    return trim($s);
}

function sync_key($s) {
    $s = sync_normalize($s);
    if (function_exists('mb_strtolower')) return mb_strtolower($s, 'UTF-8');
    return strtolower($s);
}

function sync_parse_articuls($raw) {
    $raw = (string)$raw;
    if (trim($raw) === '') return array();

    $lines = preg_split('/[\r\n;]+/u', $raw);
    $articles = array();

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;

        $pos = function_exists('mb_strpos') ? mb_strpos($line, ':', 0, 'UTF-8') : strpos($line, ':');
        if ($pos === false) {
            $art = $line;
        } else {
            $art = function_exists('mb_substr') ? mb_substr($line, 0, $pos, 'UTF-8') : substr($line, 0, $pos);
        }
        $art = sync_normalize($art);
        if ($art !== '') $articles[] = $art;
    }
    return $articles;
}

$updated_to_1 = 0;
$updated_to_0 = 0;
$unchanged    = 0;
$matched_zero = 0;
$not_found    = 0;
$errors       = 0;

$db_work = new DBWORK();

$api = sync_api_request(API_URL, API_LOGIN, API_PASS);
if (!$api['ok']) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'API: ' . $api['error']);
    header('Location: /admin');
    exit;
}

$api_data = json_decode($api['body'], true);
if (!is_array($api_data)) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['sync_toast'] = array('type' => 'error', 'text' => 'API вернул невалидный JSON');
    header('Location: /admin');
    exit;
}

$api_stock = array();
foreach ($api_data as $row) {
    if (!is_array($row) || !isset($row['Артикул'])) continue;
    $art = sync_normalize($row['Артикул']);
    if ($art === '') continue;

    $key   = sync_key($art);
    $stock = isset($row['Остаток']) ? (float)$row['Остаток'] : 0;

    if (!isset($api_stock[$key])) {
        $api_stock[$key] = array('article' => $art, 'stock' => 0, 'rows' => 0);
    }

    switch (STOCK_MODE) {
        case 'max':
            if ($stock > $api_stock[$key]['stock']) $api_stock[$key]['stock'] = $stock;
            break;
        case 'first':
            if ($api_stock[$key]['rows'] === 0) $api_stock[$key]['stock'] = $stock;
            break;
        case 'sum':
        default:
            $api_stock[$key]['stock'] += $stock;
            break;
    }
    $api_stock[$key]['rows']++;
}

$products = $db_work->get_products_with_articuls();

foreach ($products as $row) {
    if (!isset($row['articuls']) || trim((string)$row['articuls']) === '') continue;

    $product_articles = sync_parse_articuls($row['articuls']);
    if (empty($product_articles)) continue;

    $matched      = false;
    $best_stock   = 0;

    foreach ($product_articles as $pa) {
        $k = sync_key($pa);
        if (isset($api_stock[$k])) {
            $matched = true;
            if ($api_stock[$k]['stock'] > $best_stock) {
                $best_stock = $api_stock[$k]['stock'];
            }
        }
    }

    if ($matched && $best_stock > 0) {
        $new_value = (ONSTOCK_VALUE === 'stock') ? (int)$best_stock : (int)ONSTOCK_VALUE;
    } else {
        $new_value = 0;
        if ($matched) $matched_zero++;
        else          $not_found++;
    }

    $current = isset($row['onstock_spb']) ? (int)$row['onstock_spb'] : 0;
    if ($current === $new_value) {
        $unchanged++;
        continue;
    }

    $index = isset($row['index']) ? $row['index'] : null;
    if ($index === null) { $errors++; continue; }

    $res = $db_work->set_product_onstock_spb($index, $new_value);
    if (!empty($res['success'])) {
        if ($new_value > 0) $updated_to_1++;
        else                $updated_to_0++;
    } else {
        $errors++;
    }
}

$msg = 'Синхронизация завершена: '
     . 'обновлено в наличии ' . $updated_to_1 . ', '
     . 'обнулено ' . $updated_to_0 . ', '
     . 'без изменений ' . $unchanged . ', '
     . 'найдено с нулём ' . $matched_zero . ', '
     . 'не найдено ' . $not_found . ', '
     . 'ошибок ' . $errors;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['sync_toast'] = array(
    'type' => 'success',
    'text' => $msg
);
header('Location: /admin');
exit;