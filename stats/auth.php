<?php
$valid_username = 'admin';
$valid_password = 'BqpUXC';

$search_bots = [
    'Googlebot',
    'Googlebot-Image',
    'Googlebot-News',
    'Googlebot-Video',
    'Mediapartners-Google',
    'AdsBot-Google',
    'YandexBot',
    'YandexImages',
    'YandexVideo',
    'YandexMedia',
    'YandexBlogs',
    'YandexFavicons',
    'YandexWebmaster',
    'YandexPagechecker',
    'YandexDirect',
    'YandexDirectDyn',
    'YandexMetrika',
    'YandexNews',
    'YandexMarket',
    'Mail.RU_Bot',
    'bingbot',
    'BingPreview',
    'msnbot',
    'facebookexternalhit',
    'Twitterbot'
];

$is_bot = false;
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    foreach ($search_bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            $is_bot = true;
            break;
        }
    }
}

if ($is_bot) {
    return;
}

if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] !== $valid_username || 
    $_SERVER['PHP_AUTH_PW'] !== $valid_password) {
    
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access denied. Invalid username or password.';
    exit;
}
?>