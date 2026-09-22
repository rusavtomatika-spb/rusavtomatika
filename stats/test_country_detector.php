<?php
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
if ($server_name != 'www.rusavto.moisait.net'
    && $server_name != 'rusavto.moisait.net'
    && $server_name != 'rusavtomatika.local'
) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

session_start();

require_once __DIR__ . '/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

if (isset($_GET['set_mode'])) {
    CountryDetector::setSourceMode($_GET['set_mode']);
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['clear_mode'])) {
    CountryDetector::clearSourceMode();
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['refresh_all'])) {
    unset($_SESSION['stats_cache'], $_SESSION['stats_cache_time']);
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (isset($_GET['refresh_key'])) {
    $refreshKeyName = $_GET['refresh_key'];
    $keyStats = CountryDetector::getKeyStats($refreshKeyName);
    if ($keyStats !== false && isset($_SESSION['stats_cache'])) {
        $_SESSION['stats_cache'][$refreshKeyName]      = $keyStats;
        $_SESSION['stats_cache_time'][$refreshKeyName] = time();
    }
    header('Location: /stats/test_country_detector.php');
    exit;
}

if (!isset($_SESSION['stats_cache'])) {
    $_SESSION['stats_cache'] = CountryDetector::getAllStats();
    foreach ($_SESSION['stats_cache'] as $keyName => $stat) {
        $_SESSION['stats_cache_time'][$keyName] = time();
    }
}
$stats = $_SESSION['stats_cache'];

$geoDebug     = CountryDetector::getServerVariableDebug();
$sourceMode   = CountryDetector::getSourceMode();
$keysOverview = CountryDetector::getKeysOverview($stats);

$currentIp      = CountryDetector::getCurrentIpForDebug();
$currentCountry = CountryDetector::getCountry();
$currentTrace   = CountryDetector::getLastTrace();

$actualSource = '—';
foreach ($currentTrace as $t) {
    if ($t['step'] === 'env')              { $actualSource = 'переменная ' . CountryDetector::SERVER_VAR_NAME; break; }
    if ($t['step'] === 'local')            { $actualSource = 'локальный IP'; break; }
    if (strpos($t['step'], 'key:') === 0
        && strpos($t['text'], 'ВЫБРАН') !== false) {
        $actualSource = 'DaData ' . substr($t['step'], 4);
        break;
    }
    if (strpos($t['step'], 'request') === 0
        && strpos($t['text'], 'OK') !== false) {
        $parts = explode(' ', $t['text']);
        $actualSource = 'DaData ' . $parts[0];
        break;
    }
}
if ($currentCountry === false) {
    $actualSource = '❌ НЕ ОПРЕДЕЛЕНО';
}

$problems = array();
if ($geoDebug['status'] === 'invalid')     { $problems[] = 'Переменная ' . $geoDebug['var_name'] . ' невалидна'; }
if ($geoDebug['status'] === 'blacklisted') { $problems[] = 'Переменная ' . $geoDebug['var_name'] . ' в чёрном списке'; }

$workingKeys = 0; $lowKeys = 0; $deadKeys = 0;
foreach ($keysOverview as $k) {
    if ($k['state'] === 'ok')      { $workingKeys++; }
    if ($k['state'] === 'low')     { $lowKeys++; }
    if ($k['state'] === 'dead')    { $deadKeys++; }
}
if ($workingKeys === 0 && $geoDebug['detected'] === false) {
    $problems[] = 'Нет ни рабочего ключа, ни переменной — страна может быть не определена!';
}
if ($sourceMode !== 'auto') {
    $pref = $keysOverview[$sourceMode];
    if ($pref && $pref['state'] !== 'ok') {
        $problems[] = 'Выбранный ключ ' . $sourceMode . ' ' . $pref['statusText'] . ' — будет авто-фолбэк';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>GeoIp</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        h1, h2 { color: #333; }
        .container {
            max-width: 900px; margin: 0 auto; background: white;
            padding: 20px; border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; vertical-align: top; }
        th { background: #f5f5f5; }
        .success { background: #d4edda; color: #155724; }
        .error   { background: #f8d7da; color: #721c24; }
        .warning { background: #fff3cd; color: #856404; }
        .active  { background: #cce5ff; }
        .button {
            display: inline-block; padding: 5px 10px; border-radius: 4px;
            cursor: pointer; text-decoration: none; margin-right: 3px;
            font-size: 13px; border: 1px solid rgba(0,0,0,0.1);
        }
        .button-use         { background: #007bff; color: white; }
        .button-clear       { background: #6c757d; color: white; }
        .button-refresh-all { background: #28a745; color: white; }
        .button-refresh-key { background: #17a2b8; color: white; }
        .button-disabled    { background: #e9ecef; color: #6c757d; cursor: default; }
        .badge {
            display: inline-block; padding: 3px 8px; border-radius: 10px;
            font-size: 12px; font-weight: bold;
        }
        .last-updated { font-size: 11px; color: #999; display: block; }
        .nav-links {
            margin-bottom: 20px; padding: 10px; background: #f0f0f0;
            border-radius: 4px;
        }
        .nav-links a { margin-right: 15px; color: #007bff; text-decoration: none; }
        .nav-links a:hover { text-decoration: underline; }
        .problems { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;
                    padding: 10px 15px; border-radius: 6px; margin: 10px 0; }
        .problems ul { margin: 5px 0 0 20px; }
        .trace { font-family: Consolas, monospace; font-size: 12px; }
        .trace td { padding: 4px 8px; }
        .chain { font-size: 13px; color: #555; }
        .chain .arrow { color: #aaa; margin: 0 4px; }
        .chain .active-step { font-weight: bold; color: #155724; }
    </style>
</head>
<body>
<div class="container">
    <div class="nav-links">
        <a href="/stats/">← Назад к статистике</a>
    </div>

    <?php if (!empty($problems)): ?>
        <div class="problems">
            <strong>⚠️ Обнаружены проблемы:</strong>
            <ul>
                <?php foreach ($problems as $p): ?>
                    <li><?= htmlspecialchars($p) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>⚙️ Источник GeoIP</h2>
    <table>
        <tr>
            <th style="width: 220px;">Режим</th>
            <td>
                <?php if ($sourceMode === 'auto'): ?>
                    <span class="badge" style="background:#6c757d;color:white;">Переменная (auto)</span>
                    &nbsp;<span style="color:#666;">
                        переменная → DaData по порядку (первый рабочий ключ)
                    </span>
                <?php else: ?>
                    <span class="badge" style="background:#007bff;color:white;">Ключ <?= htmlspecialchars($sourceMode) ?></span>
                    &nbsp;<span style="color:#666;">
                        этот ключ → авто-фолбэк на рабочий → переменная
                    </span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Фактически сработал</th>
            <td>
                <?php if ($currentCountry === false): ?>
                    <span class="badge error">❌ НЕ ОПРЕДЕЛЕНО</span>
                <?php else: ?>
                    <strong><?= htmlspecialchars($actualSource) ?></strong>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Переключить режим</th>
            <td>
                <a class="button <?= $sourceMode === 'auto' ? 'button-use' : 'button-refresh-key' ?>"
                   href="?set_mode=auto">Режим: переменная</a>

                <?php foreach ($keysOverview as $keyName => $info): ?>
                    <a class="button <?= $sourceMode === $keyName ? 'button-use' : 'button-refresh-key' ?>"
                       href="?set_mode=<?= urlencode($keyName) ?>">
                        Режим: <?= htmlspecialchars($keyName) ?>
                    </a>
                <?php endforeach; ?>

                <?php if ($sourceMode !== 'auto'): ?>
                    <a class="button button-clear" href="?clear_mode=1">Сбросить в auto</a>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <h2>🌍 Переменная <?= htmlspecialchars($geoDebug['var_name']) ?></h2>
    <?php
        $geoClass = 'success';
        if ($geoDebug['status'] === 'empty')       { $geoClass = 'warning'; }
        if ($geoDebug['status'] === 'invalid')     { $geoClass = 'error'; }
        if ($geoDebug['status'] === 'blacklisted') { $geoClass = 'error'; }
    ?>
    <table>
        <tr>
            <th style="width: 220px;">Сырое значение</th>
            <td>
                <?php if ($geoDebug['raw'] === null): ?>
                    <em style="color:#999;">— не задана —</em>
                <?php else: ?>
                    <code><?= htmlspecialchars((string)$geoDebug['raw']) ?></code>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Состояние</th>
            <td class="<?= $geoClass ?>">
                <?php if ($geoDebug['detected'] !== false): ?>
                    <strong><?= htmlspecialchars($geoDebug['detected']) ?></strong>
                    &nbsp;— <span><?= htmlspecialchars($geoDebug['statusText']) ?></span>
                <?php else: ?>
                    <strong>нет</strong>
                    &nbsp;— <span><?= htmlspecialchars($geoDebug['statusText']) ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <h2>🧪 Текущий запрос</h2>
    <table>
        <tr>
            <th style="width: 220px;">IP клиента</th>
            <td><code><?= htmlspecialchars((string)$currentIp) ?></code></td>
        </tr>
        <tr>
            <th>Определённая страна</th>
            <td>
                <?php if ($currentCountry === false): ?>
                    <span class="badge error">❌ НЕ ОПРЕДЕЛЕНО</span>
                <?php else: ?>
                    <strong><?= htmlspecialchars((string)$currentCountry) ?></strong>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Трейс выполнения</th>
            <td>
                <?php if (empty($currentTrace)): ?>
                    <em style="color:#999;">—</em>
                <?php else: ?>
                    <table class="trace">
                        <?php foreach ($currentTrace as $t): ?>
                            <tr>
                                <td style="width:160px;"><code><?= htmlspecialchars($t['step']) ?></code></td>
                                <td><?= htmlspecialchars($t['text']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <h2>
        🔑 Ключи DaData
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
        <?php foreach ($keysOverview as $keyName => $info): ?>
            <?php
                $rowClass = '';
                if ($sourceMode === $keyName) { $rowClass = 'active'; }
                $lastUpdate = isset($_SESSION['stats_cache_time'][$keyName])
                    ? date('H:i:s', $_SESSION['stats_cache_time'][$keyName])
                    : 'никогда';
            ?>
            <tr class="<?= $rowClass ?>">
                <td>
                    <strong><?= htmlspecialchars($keyName) ?></strong>
                    <?php if ($sourceMode === $keyName): ?>
                        <span class="badge" style="background:#007bff;color:white;">выбран</span>
                    <?php endif; ?>
                    <span class="last-updated">обновлено: <?= htmlspecialchars($lastUpdate) ?></span>
                </td>
                <td><?= $info['used'] !== null ? intval($info['used']) : '—' ?></td>
                <td><?= $info['remaining'] !== null ? intval($info['remaining']) : '—' ?></td>
                <td class="<?= $info['class'] ?>"><?= $info['statusText'] ?></td>
                <td>
                    <a class="button button-refresh-key"
                       href="?refresh_key=<?= urlencode($keyName) ?>">Обновить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>📜 Как работает фолбэк</h2>
    <div class="chain">
        <strong>Режим «переменная»:</strong>
        локальный IP
        <span class="arrow">→</span> переменная
        <span class="arrow">→</span> DaData (первый рабочий ключ)
        <span class="arrow">→</span> UNKNOWN / false<br>

        <strong>Режим «ключ N»:</strong>
        локальный IP
        <span class="arrow">→</span> ключ N (если remaining &gt; <?= CountryDetector::getMinRemaining() ?>)
        <span class="arrow">→</span> первый рабочий ключ
        <span class="arrow">→</span> переменная
        <span class="arrow">→</span> UNKNOWN / false
    </div>
</div>
</body>
</html>