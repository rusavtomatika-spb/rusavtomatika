<?php
$isDirectRequest = (basename($_SERVER['SCRIPT_NAME']) === 'auth.php');
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) session_start();

define('W_LOGIN',    'maxbelousov@ya.ru');
define('W_PASSWORD', 'V5cN7Ar0Tv');
define('W_BASE',     'https://www.weintek.com');
define('W_UA',       'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');

function w_cookie_header(array $jar) {
    $parts = array();
    foreach ($jar as $name => $value) {
        $parts[] = $name . '=' . $value;
    }
    return implode('; ', $parts);
}

function w_parse_set_cookies(array $headers, array &$jar) {
    foreach ($headers as $h) {
        if (stripos($h, 'set-cookie:') !== 0) continue;
        $cookie = trim(substr($h, strlen('set-cookie:')));
        $first = explode(';', $cookie)[0];
        $eq = strpos($first, '=');
        if ($eq === false) continue;
        $name = trim(substr($first, 0, $eq));
        $value = substr($first, $eq + 1);
        if ($name !== '') {
            $jar[$name] = $value;
        }
    }
}

function w_request($url, $method = 'GET', $postFields = null, array $jar = array(), $followRedirect = false) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $followRedirect);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, W_UA);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'Connection: keep-alive',
    ));

    if (!empty($jar)) {
        curl_setopt($ch, CURLOPT_COOKIE, w_cookie_header($jar));
    }

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $err = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        return array('ok' => false, 'error' => $err, 'code' => 0, 'headers' => array(), 'body' => '');
    }

    $rawHeaders = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);
    $headers = preg_split("/\r\n|\n|\r/", $rawHeaders);
    $headers = array_filter($headers);

    return array(
        'ok' => true,
        'code' => $httpCode,
        'headers' => array_values($headers),
        'body' => $body,
    );
}

function w_extract_csrf($html) {
    if (preg_match('/name="__RequestVerificationToken"[^>]*value="([^"]+)"/i', $html, $m)) {
        return $m[1];
    }
    return null;
}

function w_login() {
    $jar = array();
    $log = array();

    $r1 = w_request(W_BASE . '/Account/Login', 'GET', null, $jar, false);
    if (!$r1['ok']) {
        return array('success' => false, 'message' => 'Ошибка запроса страницы логина: ' . $r1['error'], 'log' => $log);
    }
    w_parse_set_cookies($r1['headers'], $jar);
    $log[] = 'GET /Account/Login → HTTP ' . $r1['code'] . ', cookies: ' . count($jar);

    $csrf = w_extract_csrf($r1['body']);
    $log[] = 'CSRF: ' . ($csrf ? 'получен' : 'не найден');

    $postFields = array();
    if ($csrf) $postFields['__RequestVerificationToken'] = $csrf;
    $postFields['Email'] = W_LOGIN;
    $postFields['Password'] = W_PASSWORD;
    $postFields['RememberMe'] = 'false';

    $r2 = w_request(
        W_BASE . '/Account/Login',
        'POST',
        http_build_query($postFields),
        $jar,
        false
    );
    if (!$r2['ok']) {
        return array('success' => false, 'message' => 'Ошибка POST логина: ' . $r2['error'], 'log' => $log);
    }
    w_parse_set_cookies($r2['headers'], $jar);
    $log[] = 'POST /Account/Login → HTTP ' . $r2['code'] . ', cookies: ' . count($jar);

    if ($r2['code'] !== 302 && $r2['code'] !== 200) {
        return array('success' => false, 'message' => 'Неожиданный HTTP-код при логине: ' . $r2['code'], 'log' => $log);
    }

    $r3 = w_request(W_BASE . '/Download/Document', 'GET', null, $jar, true);
    if (!$r3['ok']) {
        return array('success' => false, 'message' => 'Ошибка проверки авторизации: ' . $r3['error'], 'log' => $log);
    }
    w_parse_set_cookies($r3['headers'], $jar);

    $html = $r3['body'];
    $hasLogout = (stripos($html, 'Log Out') !== false) || (stripos($html, 'Logout') !== false) || (stripos($html, 'logout') !== false);
    $hasEmail  = (strpos($html, W_LOGIN) !== false);
    $hasUser   = (strpos($html, 'fa-user-circle') !== false);

    $log[] = 'GET /Download/Document → HTTP ' . $r3['code'];
    $log[] = 'Признаки: logout=' . ($hasLogout ? '1' : '0') . ', email=' . ($hasEmail ? '1' : '0') . ', user_menu=' . ($hasUser ? '1' : '0');

    if ($hasLogout || $hasEmail || $hasUser) {
        $_SESSION['weintek_cookies'] = $jar;
        return array(
            'success' => true,
            'message' => '✅ Вы авторизовались как ' . W_LOGIN,
            'log' => $log,
            'jar' => $jar,
        );
    }

    return array(
        'success' => false,
        'message' => '❌ Авторизация не подтверждена (на странице нет признаков входа)',
        'log' => $log,
    );
}

$result = null;
if (isset($_GET['login']) && $_GET['login'] === '1') {
    $result = w_login();
}

if (isset($_GET['logout'])) {
    unset($_SESSION['weintek_cookies']);
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

if (!$isDirectRequest) {
    return;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Weintek auth test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; color: #222; }
        .ok { background: #e6f7e6; border: 1px solid #34AB5E; padding: 14px 18px; border-radius: 6px; margin-bottom: 20px; }
        .err { background: #fdecec; border: 1px solid #d9534f; padding: 14px 18px; border-radius: 6px; margin-bottom: 20px; }
        button, a.btn { display: inline-block; background: #34AB5E; color: #fff; border: none; padding: 10px 18px; border-radius: 5px; font-size: 15px; text-decoration: none; cursor: pointer; }
        a.btn-secondary { background: #888; margin-left: 10px; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; font-size: 13px; }
        .status { margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>

<h1>Авторизация на weintek.com</h1>

<div class="status">
    Статус:
    <?php if (!empty($_SESSION['weintek_cookies'])): ?>
        <b style="color:#34AB5E">авторизован</b> (куки сохранены в сессии)
    <?php else: ?>
        <b style="color:#d9534f">не авторизован</b>
    <?php endif; ?>
</div>

<?php if ($result !== null): ?>
    <div class="<?= $result['success'] ? 'ok' : 'err' ?>">
        <?= htmlspecialchars($result['message']) ?>
    </div>
    <?php if (!empty($result['log'])): ?>
        <h3>Лог</h3>
        <pre><?= htmlspecialchars(implode("\n", $result['log'])) ?></pre>
    <?php endif; ?>
<?php endif; ?>

<p>
    <?php if (empty($_SESSION['weintek_cookies'])): ?>
        <a class="btn" href="?login=1">Войти</a>
    <?php else: ?>
        <a class="btn btn-secondary" href="?logout=1">Выйти (очистить сессию)</a>
    <?php endif; ?>
</p>

</body>
</html>