<?php
$accessPassword = 'K4c3gzOr9Z';

$isAuthorized = false;

if (isset($_GET['pass']) && $_GET['pass'] === $accessPassword) {
    $isAuthorized = true;
    setcookie('country_test_access', '1', time() + 3600, '/');
} elseif (isset($_COOKIE['country_test_access']) && $_COOKIE['country_test_access'] === '1') {
    $isAuthorized = true;
}

if (!$isAuthorized) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Доступ запрещен</title>
        <meta charset="utf-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .password-form {
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                width: 300px;
                text-align: center;
            }
            .password-form h2 {
                margin: 0 0 20px 0;
                color: #333;
            }
            .password-form input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .password-form button {
                width: 100%;
                padding: 10px;
                background: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .password-form button:hover {
                background: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="password-form">
            <h2>Введите пароль</h2>
            <form method="GET">
                <input type="password" name="pass" placeholder="Пароль" required autofocus>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Проверка API ключей DaData</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .key-result {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            font-family: monospace;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .logout:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Проверка API ключей DaData</h1>
        
        <h2>Результаты проверки ключей:</h2>
        <?php
        $results = CountryDetector::checkKeys('77.88.8.8');
        
        foreach ($results as $keyName => $result) {
            echo "<div class='key-result " . ($result['success'] ? 'success' : 'error') . "'>";
            echo "<strong>Ключ: {$keyName}</strong><br>";
            if ($result['success']) {
                echo "✅ Работает! Страна: {$result['country']}";
            } else {
                echo "❌ Ошибка: {$result['error_type']} - {$result['message']}";
            }
            echo "</div>";
        }
        ?>
        
        <h2>Определение страны для текущего пользователя:</h2>
        <?php
        $userCountry = CountryDetector::getCountry();
        echo "<div class='key-result " . ($userCountry ? 'success' : 'error') . "'>";
        echo "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
        echo "Страна: " . ($userCountry ? $userCountry : 'не определена');
        echo "</div>";
        ?>
        
        <a href="test_country_detector.php?logout=1" class="logout">Выйти</a>
    </div>
</body>
</html>