<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/prolog.php";
global $TITLE, $CANONICAL;
$TITLE = "Weintek, таблица сравнения серий по функционалу eMT, cMT, cMT3151, mTV, iE/iER, XE";
$CANONICAL = "https://www.rusavtomatika.com/weintek-stavnenie-seriy/";
$DESCRIPTION = 'В сводной таблице Вы сможете произвести сравнение различных параметров продукции Weintek по сериям. Параметры распределены по группам: Ограничения памяти, Загрузка проекта, ,Функциональные возможност Дополнительные интерфейсы, Доступные объекты в EasyBuilder, Объекты IIoT и контроль энергопотребления, Объекты работы с данными, Утилиты';

//---------------content ---------------------

?>
<?php
// Конфигурация подключения к БД
$dbConfigs = [
    'default' => [
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => '123456',
        'dbnm' => 'rusavtomatika_db'
    ],
    'test' => [
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => '123456',
        'dbnm' => 'rusavtomatika_db'
    ],
    ' Olga' => [
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => '123456',
        'dbnm' => 'rusavtomatika_db'
    ]
];

// Определение активной конфигурации
$env = 'default';
if (preg_match("/www.test.rusavtomatika.com/i", $_SERVER['HTTP_HOST'])) {
    $env = 'test';
} elseif (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {
    $env = 'Olga';
}

// Получение активной конфигурации
$config = $dbConfigs[$env] ?? $dbConfigs['default'];

// Создание единого подключения к БД
try {
    $pdo = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbnm']}",
        $config['user'],
        $config['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    die("Произошла ошибка при подключении к базе данных");
}

// Инициализация переменных
$selectedSeries = $_GET['serie'] ?? ['3', '9'];
$errors = [];

// Валидация входных параметров
if (!empty($_GET['serie'])) {
    $validSeries = array_map(fn($s) => (string)$s, $pdo->query("SELECT id FROM sravnenie_serie")->fetchAll(PDO::FETCH_COLUMN));
    $selectedSeries = array_filter($_GET['serie'], fn($s) => in_array($s, $validSeries));
}

// Получение данных
try {
    // Запросы с использованием JOIN для оптимизации
    $functions = $pdo->query("
        SELECT f.*, fg.rus AS group_rus 
        FROM sravnenie_function f
        JOIN sravnenie_function_grupp fg ON f.grupp_id = fg.id
        ORDER BY fg.id, f.id
    ")->fetchAll();

    $models = $pdo->query("
        SELECT m.*, s.serie_name 
        FROM sravnenie_models m
        JOIN sravnenie_serie s ON m.serie_id = s.id
        WHERE m.serie_id IN (" . implode(',', array_map(fn($s) => (int)$s, $selectedSeries)) . ")
    ")->fetchAll();

    $parameters = $pdo->query("
        SELECT models_id, function_id, param, note_id 
        FROM sravnenie_parameters
    ")->fetchAll();

    $notes = $pdo->query("SELECT * FROM sravnenie_notes")->fetchAll();

    // Формирование структуры параметров
    $modelParams = [];
    foreach ($models as $model) {
        $modelParams[$model['id']] = ['parameters' => []];
    }

    foreach ($parameters as $param) {
        if (isset($modelParams[$param['models_id']])) {
            $modelParams[$param['models_id']]['parameters'][$param['function_id']] = [
                'param' => $param['param'],
                'note_id' => $param['note_id']
            ];
        }
    }

    // Группировка функций
    $groupedFunctions = [];
    foreach ($functions as $func) {
        $groupedFunctions[$func['group_rus']][] = $func;
    }

} catch (PDOException $e) {
    error_log("Query Error: " . $e->getMessage());
    $errors[] = "Ошибка при получении данных";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сравнение серий Weintek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --accent-color: #00AD61;
        }

        body {
            margin: 20px;
            font-size: 0.9rem;
        }

        .divider {
            height: 1px !important;
            background-color: #A3A3A3 !important;
            margin: 0.5rem 0;
        }

        .note-link {
            font-size: 0.7rem;
            padding: 0 2px;
            text-decoration: none;
            color: #666;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .scroll-buttons {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
        }

        .scroll-left { left: 20px; }
        .scroll-right { right: 20px; }

        .scroll-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(0,0,0,0.1);
            border: none;
            color: #333;
            transition: all 0.2s ease;
        }

        .scroll-btn:hover {
            background: var(--accent-color);
            color: white;
        }

        @media (max-width: 768px) {
            .scroll-buttons { display: none; }
            .table-responsive { margin: 0 -20px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="mb-4 text-success">Сравнение серий Weintek: iP, iE, iER, eMT, mTV, XE, cMT, cMT X, cMT Gateway</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
        <?php else: ?>
            <form method="GET" class="mb-4">
                <div class="btn-group" role="group">
                    <?php
                    $allSeries = $pdo->query("SELECT id, serie_name FROM sravnenie_serie")->fetchAll();
                    foreach ($allSeries as $serie):
                        $checked = in_array($serie['id'], $selectedSeries) ? 'checked' : '';
                    ?>
                        <input type="checkbox" class="btn-check" id="serie-<?= $serie['id'] ?>" 
                               name="serie[]" value="<?= $serie['id'] ?>" <?= $checked ?>>
                        <label class="btn btn-outline-success" for="serie-<?= $serie['id'] ?>">
                            <?= htmlspecialchars($serie['serie_name']) ?>
                        </label>
                    <?php endforeach ?>
                </div>
                <button type="submit" class="btn btn-success ms-3">Применить</button>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="text-end align-middle" style="width: 300px">Серии:</th>
                            <?php
                            $currentGroup = '';
                            foreach ($models as $mod):
                                if ($currentGroup !== $mod['serie_name']):
                                    echo '<th class="text-center" colspan="' . count(array_filter($models, fn($m) => $m['serie_name'] === $mod['serie_name'])) . '">';
                                    echo '<strong>' . htmlspecialchars($mod['serie_name']) . '</strong></th>';
                                    $currentGroup = $mod['serie_name'];
                                endif;
                            endforeach;
                            ?>
                        </tr>
                        <tr>
                            <th class="text-end align-middle">Модели:</th>
                            <?php foreach ($models as $mod): ?>
                                <th class="text-center align-top">
                                    <?= str_replace(', ', '<br>', htmlspecialchars($mod['model'])) ?>
                                </th>
                            <?php endforeach ?>
                        </tr>
                        <tr class="border-bottom border-2">
                            <th class="text-end align-middle">&nbsp;</th>
                            <?php foreach ($models as $mod): ?>
                                <th class="text-center align-top"></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentGroup = '';
                        foreach ($groupedFunctions as $groupName => $funcs):
                            echo '<tr><td class="fw-bold bg-light" colspan="' . (count($models) + 1) . '"><h3 class="text-success">' . htmlspecialchars($groupName) . '</h3></td></tr>';
                            foreach ($funcs as $func):
                        ?>
                            <tr>
                                <td class="table-light" style="width: 300px">
                                    <strong><?= htmlspecialchars($func['eng']) ?></strong><br>
                                    <?= htmlspecialchars($func['rus']) ?>
                                </td>
                                <?php foreach ($models as $mod): 
                                    $param = $modelParams[$mod['id']]['parameters'][$func['id']] ?? ['param' => 'N/A', 'note_id' => null];
                                    $value = $param['param'];
                                    $notes = $param['note_id'] ? explode(',', $param['note_id']) : [];
                                ?>
                                    <td class="text-center align-middle">
                                        <?php if ($value === 'N/A'): ?>
                                            <i class="bi bi-x-square text-danger h3"></i>
                                        <?php elseif ($value === 'Y'): ?>
                                            <i class="bi bi-check-square-fill text-success h3"></i>
                                        <?php else: ?>
                                            <div class="mb-2"><?= htmlspecialchars($value) ?></div>
                                        <?php endif ?>
                                        
                                        <?php if (!empty($notes)): ?>
                                            <div class="mt-1">
                                                <?php foreach ($notes as $nid): 
                                                    $note = array_filter($notes, fn($n) => $n['id'] == $nid)[0] ?? null;
                                                ?>
                                                    <a href="#note-<?= $nid ?>" class="note-link">
                                                        [<?= $nid ?>]
                                                    </a>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <h5>Примечания:</h5>
                <?php foreach ($notes as $note): 
                    preg_match_all('/\b\d{8}\b/', $note['note_description'], $matches);
                    $ndescr = preg_replace_callback('/\b\d{8}\b/', function($m) {
                        return DateTime::createFromFormat('Ymd', $m[0])->format('d.m.Y');
                    }, $note['note_description']);
                ?>
                    <div id="note-<?= $note['id'] ?>" class="mb-2 small text-muted">
                        <strong><?= $note['id'] ?>.</strong> <?= htmlspecialchars($ndescr) ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Инициализация скролл-кнопок
            const scrollContainer = document.querySelector('.table-responsive');
            const scrollLeft = document.createElement('button');
            const scrollRight = document.createElement('button');
            
            Object.assign(scrollLeft, {
                className: 'scroll-btn scroll-left',
                innerHTML: '<i class="bi bi-arrow-left"></i>'
            });
            
            Object.assign(scrollRight, {
                className: 'scroll-btn scroll-right',
                innerHTML: '<i class="bi bi-arrow-right"></i>'
            });

            scrollLeft.addEventListener('click', () => scrollContainer.scrollLeft -= 200);
            scrollRight.addEventListener('click', () => scrollContainer.scrollLeft += 200);

            // Добавление кнопок только при необходимости
            const checkScroll = () => {
                if (scrollContainer.scrollWidth > scrollContainer.clientWidth) {
                    scrollContainer.parentElement.append(scrollLeft, scrollRight);
                } else {
                    scrollLeft.remove();
                    scrollRight.remove();
                }
            };

            window.addEventListener('resize', checkScroll);
            checkScroll();
        });
    </script>
</body>
</html><?php
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . "/abacus/epilog.php";
