<?php
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
if ($server_name != 'www.rusavto.moisait.net' && $server_name != 'rusavto.moisait.net' && $server_name != 'rusavtomatika.local') {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

session_start();

require_once __DIR__ . '/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

if (isset($_GET['force_key'])) {
    CountryDetector::setForcedKey($_GET['force_key']);
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['clear_force'])) {
    CountryDetector::clearForcedKey();
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['refresh_all'])) {
    unset($_SESSION['stats_cache']);
    unset($_SESSION['stats_cache_time']);
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['refresh_key'])) {
    $refreshKeyName = $_GET['refresh_key'];
    $keyStats = CountryDetector::getKeyStats($refreshKeyName);
    
    if ($keyStats !== false && isset($_SESSION['stats_cache'])) {
        $_SESSION['stats_cache'][$refreshKeyName] = $keyStats;
        $_SESSION['stats_cache_time'][$refreshKeyName] = time();
    }
    
    header('Location: /stats/test_country_detector.php');
    exit;
}

$forcedKey = false;
$forcedKeyFile = $_SERVER['DOCUMENT_ROOT'] . '/logs/forced_key.txt';
if (file_exists($forcedKeyFile)) {
    $forcedKey = trim(file_get_contents($forcedKeyFile));
}

if (!isset($_SESSION['stats_cache'])) {
    $_SESSION['stats_cache'] = CountryDetector::getAllStats();
    
    foreach ($_SESSION['stats_cache'] as $keyName => $stat) {
        $_SESSION['stats_cache_time'][$keyName] = time();
    }
}

$stats = $_SESSION['stats_cache'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Управление ключами DaData</title>
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
        .button {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 3px;
            font-size: 13px;
        }
        .button-use { background: #007bff; color: white; }
        .button-clear { background: #6c757d; color: white; }
        .button-refresh-all { background: #28a745; color: white; }
        .button-refresh-key { background: #17a2b8; color: white; }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        .last-updated {
            font-size: 11px;
            color: #999;
            display: block;
        }
        .nav-links {
            margin-bottom: 20px;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 4px;
        }
        .nav-links a {
            margin-right: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-links">
            <a href="/stats/">← Назад к статистике</a>
        </div>
        
        <h1>🔑 Управление ключами DaData</h1>
        
        <?php if ($forcedKey): ?>
            <p>
                <span class="badge" style="background:#007bff;color:white;">Принудительно выбран: <?= $forcedKey ?></span>
                <a href="?clear_force=1" class="button button-clear">Сбросить</a>
            </p>
        <?php endif; ?>
        
        <h2>
            Статистика по ключам:
            <a href="?refresh_all=1" class="button button-refresh-all">🔄 Обновить всё</a>
        </h2>
        
        <table>
            <tr>
                <th>Ключ</th>
                <th>Использовано сегодня</th>
                <th>Осталось</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            <?php
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
                $lastUpdate = isset($_SESSION['stats_cache_time'][$keyName]) 
                    ? date('H:i:s', $_SESSION['stats_cache_time'][$keyName]) 
                    : 'никогда';
                
                echo "<tr class='{$rowClass}'>";
                echo "<td>{$keyName}" . ($forcedKey === $keyName ? ' <span class="badge" style="background:#007bff;color:white;">активен</span>' : '') . "";
                echo "<span class='last-updated'>обновлено: {$lastUpdate}</span></td>";
                echo "<td>{$used}</td>";
                echo "<td>{$remaining}</td>";
                echo "<td class='{$statusClass}'>{$statusText}</td>";
                echo "<td>";
                echo "<a class='button button-use' href='?force_key={$keyName}'>Использовать</a> ";
                echo "<a class='button button-refresh-key' href='?refresh_key={$keyName}'>Обновить</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        
    </div>
</body>
</html>