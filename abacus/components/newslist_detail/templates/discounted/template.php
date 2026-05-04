<?php
global $arResult;

// Если данные не пришли через $arResult, пробуем получить из базы напрямую
if (!isset($arResult['product']) || empty($arResult['product'])) {
    global $mysqli_db, $arguments;
    
    // Получаем ID товара из параметров компонента
    $item_id = isset($arguments['id']) ? intval($arguments['id']) : 0;
    
    if ($item_id > 0 && function_exists('database_connect')) {
        $query = "SELECT * FROM `discounted` WHERE `id` = $item_id AND `show` = 1 LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        $product = mysqli_fetch_assoc($result);
        
        if ($product) {
            $arResult['product'] = $product;
        }
    }
}

if (!isset($arResult['product']) || empty($arResult['product'])) {
    echo "<h1>404 - Товар не найден</h1>";
    echo "<a href='/discounted/'>Вернуться к списку</a>";
    return;
}

$product = $arResult['product'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> | Уцененный товар | Русавтоматика</title>
    <meta name="description" content="<?= htmlspecialchars($product['name']) ?> по цене <?= $product['price'] ?> руб.">
    <link rel="stylesheet" href="/abacus/templates/rusavtomatika_bulma/bulma/css/bulma.min.css">
    <style>
        body { background: #fff; padding: 20px; }
        .discounted-badge { background: #e00; color: #fff; padding: 10px 20px; display: inline-block; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .discounted-price { font-size: 32px; color: #e00; font-weight: bold; margin: 20px 0; }
        .info-box { background: #f5f5f5; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .markdown-reason { margin: 20px 0; padding: 15px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107; }
        .button-buy { background: #e00; border-color: #e00; color: #fff; padding: 12px 30px; font-size: 18px; border-radius: 4px; cursor: pointer; border: none; }
        .button-buy:hover { background: #cc0000; }
    </style>
</head>
<body>
<div class="container is-widescreen">
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/discounted/">Уцененные товары</a></li>
            <li class="is-active"><a href="#" aria-current="page"><?= htmlspecialchars($product['name']) ?></a></li>
        </ul>
    </nav>
    
    <div class="columns">
        <div class="column is-6">
            <? if (!empty($product['preview_picture'])): ?>
                <img src="<?= $product['preview_picture'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <? endif; ?>
        </div>
        <div class="column is-6">
            <div class="discounted-badge">⚡ УЦЕНЕННЫЙ ТОВАР ⚡</div>
            <h1 class="title is-2"><?= htmlspecialchars($product['name']) ?></h1>
            <div class="discounted-price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</div>
            
            <div class="info-box">
                <p><strong>Бренд:</strong> <?= htmlspecialchars($product['brand']) ?></p>
                <p><strong>Модель:</strong> <?= htmlspecialchars($product['model']) ?></p>
                <p><strong>Раздел:</strong> <?= htmlspecialchars($product['section']) ?></p>
            </div>
            
            <? if (!empty($product['reason_of_markdown'])): ?>
                <div class="markdown-reason">
                    <strong>📢 Причина уценки:</strong><br>
                    <?= nl2br(htmlspecialchars($product['reason_of_markdown'])) ?>
                </div>
            <? endif; ?>
            
            <? if (!empty($product['text'])): ?>
                <div style="margin: 20px 0;">
                    <h3 class="title is-5">Описание</h3>
                    <div><?= nl2br(htmlspecialchars($product['text'])) ?></div>
                </div>
            <? endif; ?>
            
            <div style="margin-top: 30px; display: flex; gap: 15px; flex-wrap: wrap;">
                <button class="button-buy" onclick="show_backup_call(2, '<?= htmlspecialchars($product['name']) ?>')">
                    📞 Купить со скидкой
                </button>
                <a href="/discounted/" class="button is-light">← Вернуться к списку</a>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.6.0.js"></script>
<script>
function show_backup_call(type, text) {
    if (typeof window.show_backup_call === 'function') {
        window.show_backup_call(type, text);
    } else {
        alert('Заказ: ' + text + '\nПожалуйста, свяжитесь с нами по телефону 8 (800) 600-33-47');
    }
}
</script>
</body>
</html>