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
    </head>
    <body>
        <div style="text-align:center;margin-top:100px;">
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

if (isset($_GET['force_key'])) {
    CountryDetector::setForcedKey($_GET['force_key']);
    header('Location: test_country_detector.php');
    exit;
}

if (isset($_GET['clear_force'])) {
    CountryDetector::clearForcedKey();
    header('Location: test_country_detector.php');
    exit;
}

$forcedKey = false;
$forcedKeyFile = $_SERVER['DOCUMENT_ROOT'] . '/logs/forced_key.txt';
if (file_exists($forcedKeyFile)) {
    $forcedKey = trim(file_get_contents($forcedKeyFile));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Проверка API ключей DaData</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        h1, h2 { color: #333; }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .warning { background: #fff3cd; color: #856404; }
        .active { background: #cce5ff; }
        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .button-use { background: #007bff; color: white; }
        .button-clear { background: #6c757d; color: white; }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Проверка API ключей DaData</h1>
        
        <?php if ($forcedKey): ?>
            <p>
                <span class="badge" style="background:#007bff;color:white;">Принудительно выбран: <?= $forcedKey ?></span>
                <a href="?clear_force=1" class="button button-clear">Сбросить</a>
            </p>
        <?php endif; ?>
        
        <h2>Статистика по ключам:</h2>
        <table>
            <tr>
                <th>Ключ</th>
                <th>Использовано сегодня</th>
                <th>Осталось</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            <?php
            $stats = CountryDetector::getAllStats();
            
            foreach ($stats as $keyName => $stat) {
                $used = isset($stat['services']['suggestions']) ? $stat['services']['suggestions'] : 'N/A';
                $remaining = isset($stat['remaining']['suggestions']) ? $stat['remaining']['suggestions'] : 'N/A';
                
                $statusClass = 'error';
                $statusText = 'Ошибка';
                
                if ($remaining !== 'N/A' && $remaining > 1000) {
                    $statusClass = 'success';
                    $statusText = '✅ Доступен';
                } elseif ($remaining !== 'N/A' && $remaining > 0) {
                    $statusClass = 'warning';
                    $statusText = '⚠️ Заканчивается';
                } else {
                    $statusClass = 'error';
                    $statusText = '❌ Исчерпан';
                }
                
                $rowClass = ($forcedKey === $keyName) ? 'active' : '';
                
                echo "<tr class='{$rowClass}'>";
                echo "<td>{$keyName}" . ($forcedKey === $keyName ? ' <span class="badge" style="background:#007bff;color:white;">активен</span>' : '') . "</td>";
                echo "<td>{$used}</td>";
                echo "<td>{$remaining}</td>";
                echo "<td class='{$statusClass}'>{$statusText}</td>";
                echo "<td><a class='button button-use' href='?force_key={$keyName}'>Использовать</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        
        <h2>Проверка определения страны (IP: 77.88.8.8):</h2>
        <?php
        foreach (array_keys($stats) as $keyName) {
            $result = CountryDetector::checkKey($keyName, '77.88.8.8');
            
            echo "<div class='key-result " . ($result['country_result']['success'] ? 'success' : 'error') . "'>";
            echo "<strong>{$keyName}:</strong> ";
            if ($result['country_result']['success']) {
                echo "✅ Страна: {$result['country_result']['country']}";
            } else {
                echo "❌ {$result['country_result']['message']}";
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
        
        <a href="?logout=1" class="logout">Выйти</a>
    </div>
</body>
</html>