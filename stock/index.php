<?php
require_once __DIR__ . '/_right.php';

if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 1800)) {
    session_unset();
    session_destroy();
    header('Location: /stock/');
    exit;
}
$_SESSION['login_time'] = time();

$allowed_servers = array(
    'www.rusavto.moisait.net',
    'rusavto.moisait.net',
    'moisait.net'
);

if (!in_array($_SERVER['SERVER_NAME'], $allowed_servers)) {
    header('HTTP/1.0 403 Forbidden');
    die('Доступ запрещён. Сервер: ' . $_SERVER['SERVER_NAME']);
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

if ($uri === '/stock/price' || $uri === '/stock/price/') {
    require_once __DIR__ . '/price/index.php';
    exit;
}

if (!in_array($_SERVER['SERVER_NAME'], $allowed_servers)) {
    header('HTTP/1.0 403 Forbidden');
    die('Доступ запрещён. Сервер: ' . $_SERVER['SERVER_NAME']);
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

if ($uri === '/stock/price' || $uri === '/stock/price/') {
    require_once __DIR__ . '/price/index.php';
    exit;
}

require_once __DIR__ . '/../etm_converter/edi_converter.php';
$config = require __DIR__ . '/../etm_converter/config.php';

$converter = new ETMConverter(array(
    'base_path' => dirname(__DIR__),
    'api_url' => $config['api_url'],
    'api_login' => $config['api_login'],
    'api_password' => $config['api_password']
));

$stock_data = $converter->getStockData();

if (empty($stock_data)) {
    $json = file_get_contents($config['api_url'], false, stream_context_create(array(
        'http' => array(
            'header' => "Authorization: Basic " . base64_encode($config['api_login'] . ':' . $config['api_password']) . "\r\n",
            'timeout' => 30
        )
    )));
    $data = json_decode($json, true);
    
    $stock_data = array();
    if (is_array($data)) {
        foreach ($data as $item) {
            $article_raw = isset($item['Артикул']) ? trim($item['Артикул']) : '';
            if (empty($article_raw)) continue;
            
            $article_key = mb_strtolower($article_raw, 'UTF-8');
            $stock_data[$article_key] = array(
                'article_original' => $article_raw,
                'article_key' => $article_key,
                'name' => isset($item['НаименованиеПолное']) ? trim($item['НаименованиеПолное']) : '',
                'quantity' => floatval(isset($item['Остаток']) ? $item['Остаток'] : 0),
                'gtd' => isset($item['НомерГТД']) ? trim($item['НомерГТД']) : '',
                'price_stock' => floatval(isset($item['Цена']) ? $item['Цена'] : 0)
            );
        }
    }
}

require_once __DIR__ . '/template.php';