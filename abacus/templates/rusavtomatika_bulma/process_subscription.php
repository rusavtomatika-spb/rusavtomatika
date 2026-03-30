<?php
session_start();

database_connect();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    $agree = isset($_POST['agree']) ? true : false;
    
    $recaptchaToken = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
    
    if (empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Введите email адрес']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Введите корректный email адрес']);
        exit;
    }
    
    if (!$agree) {
        echo json_encode(['success' => false, 'message' => 'Необходимо согласие с политикой конфиденциальности']);
        exit;
    }
    
    if (empty($recaptchaToken)) {
        echo json_encode(['success' => false, 'message' => 'Ошибка проверки безопасности. Пожалуйста, обновите страницу.']);
        exit;
    }
    
    $secretKey = '6LdZ250sAAAAAC7kyvlb72AKj8qCxstf6Op42lkW';
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaToken,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
            'timeout' => 10
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === false) {
        echo json_encode(['success' => false, 'message' => 'Ошибка подключения к серверу проверки. Попробуйте позже.']);
        exit;
    }
    
    $recaptchaResponse = json_decode($result, true);
    
    if (!$recaptchaResponse['success']) {
        $errorCodes = isset($recaptchaResponse['error-codes']) ? implode(', ', $recaptchaResponse['error-codes']) : 'unknown';
        error_log("reCAPTCHA error: " . $errorCodes);
        echo json_encode(['success' => false, 'message' => 'Ошибка проверки безопасности. Попробуйте еще раз.']);
        exit;
    }
    
    if ($recaptchaResponse['score'] < 0.5) {
        error_log("reCAPTCHA low score: " . $recaptchaResponse['score'] . " for IP: " . $_SERVER['REMOTE_ADDR']);
        echo json_encode(['success' => false, 'message' => 'Подозрительная активность. Подписка не оформлена.']);
        exit;
    }
    
    $checkQuery = "SELECT id FROM news_sender WHERE email = '" . mysql_real_escape_string($email) . "'";
    $checkResult = mysql_query($checkQuery);
    
    if (mysql_num_rows($checkResult) > 0) {
        echo json_encode(['success' => false, 'message' => 'Этот email уже подписан на рассылку']);
        exit;
    }
    
    $userIp = $_SERVER['REMOTE_ADDR'];
    
    $apiToken = '43790424b5f130';
    
    $data = getUserDataFromIPInfo($userIp, $apiToken);
    
    $emailEscaped = mysql_real_escape_string($email);
    $ipEscaped = mysql_real_escape_string($userIp);
    $hostnameEscaped = mysql_real_escape_string($data['hostname'] ?? '');
    $cityEscaped = mysql_real_escape_string($data['city'] ?? '');
    $regionEscaped = mysql_real_escape_string($data['region'] ?? '');
    $countryEscaped = mysql_real_escape_string($data['country'] ?? '');
    $lat = isset($data['loc']) ? explode(',', $data['loc'])[0] : '';
    $lng = isset($data['loc']) ? explode(',', $data['loc'])[1] : '';
    $orgEscaped = mysql_real_escape_string($data['org'] ?? '');
    $postalEscaped = mysql_real_escape_string($data['postal'] ?? '');
    $timezoneEscaped = mysql_real_escape_string($data['timezone'] ?? '');
    
    $query = "
        INSERT INTO news_sender (email, ip, hostname, city, region, country, lat, lng, org, postal, timezone, created_at)
        VALUES ('$emailEscaped', '$ipEscaped', '$hostnameEscaped', '$cityEscaped', '$regionEscaped', '$countryEscaped', '$lat', '$lng', '$orgEscaped', '$postalEscaped', '$timezoneEscaped', NOW())
    ";
    
    $res = mysql_query($query);
    
    if ($res) {
        echo json_encode(['success' => true, 'message' => 'Спасибо за подписку!']);
    } else {
        error_log("Subscription error: " . mysql_error());
        echo json_encode(['success' => false, 'message' => 'Что-то пошло не так... Попробуйте позже.']);
    }
    exit;
}

function getUserDataFromIPInfo($ipAddress, $token) {
    $url = "https://ipinfo.io/$ipAddress?token=$token";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if (!$response || $httpCode !== 200) {
        return [];
    }
    
    return json_decode($response, true);
}
?>