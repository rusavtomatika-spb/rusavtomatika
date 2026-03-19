<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '256M');

require_once(__DIR__ . '/auth.php');
require_once(__DIR__ . '/goods_changes_history.php');

if (!class_exists('Core_database_goods_changes_history')) {
    die('Класс истории изменений не найден');
}

$period = isset($_GET['period']) ? (int)$_GET['period'] : 30;
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$view = isset($_GET['view']) ? $_GET['view'] : 'overview';
$username = isset($_GET['username']) ? $_GET['username'] : '';

$today_stats = Core_database_goods_changes_history::get_changes_count_by_date($date);
$period_stats = Core_database_goods_changes_history::get_changes_by_period($period);
$recent_products = Core_database_goods_changes_history::get_recently_changed_products(10);
$top_fields = Core_database_goods_changes_history::get_top_changed_fields(10);
$detailed = Core_database_goods_changes_history::get_detailed_changes($date, 50);
$user_stats = Core_database_goods_changes_history::get_user_stats($period);

if ($username) {
    $user_changes = Core_database_goods_changes_history::get_user_changes($username, 100);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Статистика изменений товаров</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; }
        .stat-card h3 { margin: 0 0 10px 0; color: #666; font-size: 14px; }
        .stat-card .number { font-size: 32px; font-weight: bold; color: #333; }
        .changes-table { width: 100%; background: white; border-collapse: collapse; margin-bottom: 20px; }
        .changes-table th { background: #4CAF50; color: white; padding: 12px; text-align: left; }
        .changes-table td { padding: 12px; border-bottom: 1px solid #ddd; }
        .changes-table tr:hover { background: #f9f9f9; }
        .date-picker { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge.update { background: #ffd700; }
        .badge.insert { background: #4CAF50; color: white; }
        .badge.delete { background: #f44336; color: white; }
        .field-name { font-weight: bold; color: #2196F3; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px; }
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; }
        .tab { padding: 10px 20px; background: #ddd; border-radius: 4px; cursor: pointer; text-decoration: none; color: #333; }
        .tab.active { background: #4CAF50; color: white; }
        .user-link { color: #2196F3; text-decoration: none; font-weight: bold; }
        .user-link:hover { text-decoration: underline; }
        .username-cell { font-weight: bold; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Статистика изменений товаров</h1>
        </div>
        
        <div class="tabs">
            <a href="?view=overview&period=<?= $period ?>&date=<?= $date ?>" class="tab <?= $view == 'overview' ? 'active' : '' ?>">Обзор</a>
            <a href="?view=users&period=<?= $period ?>&date=<?= $date ?>" class="tab <?= $view == 'users' ? 'active' : '' ?>">По пользователям</a>
        </div>
        
        <div class="date-picker">
            <form method="GET">
                <input type="hidden" name="view" value="<?= $view ?>">
                <label>Период:</label>
                <select name="period" onchange="this.form.submit()">
                    <option value="7" <?= $period == 7 ? 'selected' : '' ?>>7 дней</option>
                    <option value="30" <?= $period == 30 ? 'selected' : '' ?>>30 дней</option>
                    <option value="90" <?= $period == 90 ? 'selected' : '' ?>>90 дней</option>
                    <option value="365" <?= $period == 365 ? 'selected' : '' ?>>Год</option>
                </select>
                
                <label>Дата:</label>
                <input type="date" name="date" value="<?= $date ?>" onchange="this.form.submit()">
            </form>
        </div>
        
        <?php if ($view == 'overview'): ?>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>📅 Дата</h3>
                <div class="number"><?= date('d.m.Y', strtotime($date)) ?></div>
            </div>
            <div class="stat-card">
                <h3>📝 Всего изменений</h3>
                <div class="number"><?= $today_stats['total_changes'] ?></div>
            </div>
            <div class="stat-card">
                <h3>📦 Товаров изменено</h3>
                <div class="number"><?= $today_stats['affected_products'] ?></div>
            </div>
            <div class="stat-card">
                <h3>🔄 / ➕ / ❌</h3>
                <div class="number"><?= $today_stats['updates'] ?> / <?= $today_stats['inserts'] ?> / <?= $today_stats['deletes'] ?></div>
            </div>
        </div>
        
        <h2>📈 Изменения за последние <?= $period ?> дней</h2>
        <table class="changes-table">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Всего</th>
                    <th>Товаров</th>
                    <th>Обновления</th>
                    <th>Новые</th>
                    <th>Удаления</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($period_stats as $stat): ?>
                <tr>
                    <td><a href="?date=<?= $stat['date'] ?>&view=overview"><?= date('d.m.Y', strtotime($stat['date'])) ?></a></td>
                    <td><?= $stat['total'] ?></td>
                    <td><?= $stat['products'] ?></td>
                    <td><?= $stat['updates'] ?></td>
                    <td><?= $stat['inserts'] ?></td>
                    <td><?= $stat['deletes'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="grid-3">
            <div>
                <h2>🔄 Последние изменения</h2>
                <table class="changes-table">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Время</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['model']) ?></td>
                            <td><?= date('d.m.Y H:i', strtotime($product['last_change'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div>
                <h2>📊 Часто изменяемые поля</h2>
                <table class="changes-table">
                    <thead>
                        <tr>
                            <th>Поле</th>
                            <th>Изменений</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top_fields as $field): ?>
                        <tr>
                            <td><?= htmlspecialchars($field['field_name']) ?></td>
                            <td><?= $field['change_count'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>📋 Детальные изменения за <?= date('d.m.Y', strtotime($date)) ?></h2>
        <table class="changes-table">
            <thead>
                <tr>
                    <th>Время</th>
                    <th>Товар</th>
                    <th>Тип</th>
                    <th>Поле</th>
                    <th>Было</th>
                    <th>Стало</th>
                    <th>Пользователь</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detailed as $change): ?>
                <tr>
                    <td><?= date('H:i:s', strtotime($change['changed_at'])) ?></td>
                    <td><?= htmlspecialchars($change['model']) ?></td>
                    <td>
                        <?php if ($change['action_type'] == 'update'): ?>
                            <span class="badge update">update</span>
                        <?php elseif ($change['action_type'] == 'insert'): ?>
                            <span class="badge insert">insert</span>
                        <?php elseif ($change['action_type'] == 'delete'): ?>
                            <span class="badge delete">delete</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($change['field_name']) ?></td>
                    <td><?= htmlspecialchars(isset($change['old_value']) ? mb_substr($change['old_value'], 0, 30) : '-') ?></td>
                    <td><?= htmlspecialchars(isset($change['new_value']) ? mb_substr($change['new_value'], 0, 30) : '-') ?></td>
                    <td class="username-cell">
                        <?php if (isset($change['username']) && $change['username']): ?>
                            <a href="?view=users&username=<?= urlencode($change['username']) ?>" class="user-link">
                                <?= htmlspecialchars($change['username']) ?>
                            </a>
                        <?php else: ?>
                            Система
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php elseif ($view == 'users'): ?>
        
        <h2>👥 Статистика по пользователям за последние <?= $period ?> дней</h2>
        
        <?php if ($username && isset($user_changes)): ?>
            <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h3>Детальная история пользователя: <?= htmlspecialchars($username) ?></h3>
                <a href="?view=users&period=<?= $period ?>" class="user-link">← Назад к списку пользователей</a>
            </div>
            
            <table class="changes-table">
                <thead>
                    <tr>
                        <th>Время</th>
                        <th>Товар</th>
                        <th>Тип</th>
                        <th>Поле</th>
                        <th>Было</th>
                        <th>Стало</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_changes as $change): ?>
                    <tr>
                        <td><?= date('d.m.Y H:i:s', strtotime($change['changed_at'])) ?></td>
                        <td><?= htmlspecialchars($change['model']) ?></td>
                        <td>
                            <?php if ($change['action_type'] == 'update'): ?>
                                <span class="badge update">update</span>
                            <?php elseif ($change['action_type'] == 'insert'): ?>
                                <span class="badge insert">insert</span>
                            <?php elseif ($change['action_type'] == 'delete'): ?>
                                <span class="badge delete">delete</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($change['field_name']) ?></td>
                        <td><?= htmlspecialchars(isset($change['old_value']) ? mb_substr($change['old_value'], 0, 30) : '-') ?></td>
                        <td><?= htmlspecialchars(isset($change['new_value']) ? mb_substr($change['new_value'], 0, 30) : '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php else: ?>
        
        <table class="changes-table">
            <thead>
                <tr>
                    <th>Пользователь</th>
                    <th>Всего изменений</th>
                    <th>Товаров изменено</th>
                    <th>Обновления</th>
                    <th>Новые</th>
                    <th>Удаления</th>
                    <th>Последнее действие</th>
                    <th>Детали</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_stats as $user): ?>
                <tr>
                    <td class="username-cell"><?= htmlspecialchars($user['username']) ?></td>
                    <td><strong><?= $user['total_changes'] ?></strong></td>
                    <td><?= $user['products_affected'] ?></td>
                    <td><?= $user['updates'] ?></td>
                    <td><?= $user['inserts'] ?></td>
                    <td><?= $user['deletes'] ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($user['last_action'])) ?></td>
                    <td>
                        <a href="?view=users&username=<?= urlencode($user['username']) ?>&period=<?= $period ?>" class="user-link">История</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php endif; ?>
        
        <?php endif; ?>
        
    </div>
</body>
</html>