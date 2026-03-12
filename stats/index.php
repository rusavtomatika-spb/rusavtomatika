<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '256M');

require_once(__DIR__ . '/auth.php');

require_once(__DIR__ . '/direct_db.php');
require_once(__DIR__ . '/products_all_history.php');

global $mysqli_db;
if (!$mysqli_db) {
    die('Database connection failed');
}

$period = isset($_GET['period']) ? (int)$_GET['period'] : 30;
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$today_stats = Core_database_products_all_history::get_changes_count_by_date($date);
$period_stats = Core_database_products_all_history::get_changes_by_period($period);
$recent_products = Core_database_products_all_history::get_recently_changed_products(10);
$top_fields = Core_database_products_all_history::get_top_changed_fields(10);
$detailed = Core_database_products_all_history::get_detailed_changes($date, 50);
?>

<?php if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net' || $_SERVER['SERVER_NAME'] == 'www.test.rusavtomatika.com') : ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Статистика изменений товаров</title>
        <meta charset="utf-8">
        <style>
            body { font-family: Arial; margin: 20px; background: #f5f5f5; }
            .container { max-width: 1200px; margin: 0 auto; }
            .header { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
            .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
            .stat-card { background: white; padding: 20px; border-radius: 8px; }
            .stat-card h3 { margin: 0 0 10px 0; color: #666; font-size: 14px; }
            .stat-card .number { font-size: 32px; font-weight: bold; color: #333; }
            .changes-table { width: 100%; background: white; border-collapse: collapse; }
            .changes-table th { background: #4CAF50; color: white; padding: 12px; text-align: left; }
            .changes-table td { padding: 12px; border-bottom: 1px solid #ddd; }
            .date-picker { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
            .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
            .badge.update { background: #ffd700; }
            .badge.insert { background: #4CAF50; color: white; }
            .badge.delete { background: #f44336; color: white; }
            .field-name { font-weight: bold; color: #2196F3; }
            .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 30px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📊 Статистика изменений товаров</h1>
            </div>
            
            <div class="date-picker">
                <form method="GET">
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
                        <td><a href="?date=<?= $stat['date'] ?>"><?= date('d.m.Y', strtotime($stat['date'])) ?></a></td>
                        <td><?= $stat['total'] ?></td>
                        <td><?= $stat['products'] ?></td>
                        <td><?= $stat['updates'] ?></td>
                        <td><?= $stat['inserts'] ?></td>
                        <td><?= $stat['deletes'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="grid-2">
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
        </div>
    </body>
    </html>
<?php endif; ?>