<?php
global $arResult;

if (!isset($arResult['product']) || empty($arResult['product'])) {
    echo "<h1>404 - Товар не найден</h1>";
    echo "<a href='/discounted/'>Вернуться к списку</a>";
    return;
}

$product = $arResult['product'];
?>
<div class="discounted-detail container" style="padding: 20px;">
    <div class="columns">
        <div class="column is-6">
            <? if (!empty($product['preview_picture'])): ?>
                <img src="<?= $product['preview_picture'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width: 100%;">
            <? endif; ?>
        </div>
        <div class="column is-6">
            <div style="background: #e00; color: #fff; padding: 10px; display: inline-block; margin-bottom: 20px;">⚡ УЦЕНЕННЫЙ ТОВАР ⚡</div>
            <h1><?= htmlspecialchars($product['name']) ?></h1>
            <div style="font-size: 28px; color: #e00; font-weight: bold; margin: 20px 0;"><?= $product['price'] ?> ₽</div>
            <div><strong>Бренд:</strong> <?= htmlspecialchars($product['brand']) ?></div>
            <div><strong>Модель:</strong> <?= htmlspecialchars($product['model']) ?></div>
            <div><strong>Раздел:</strong> <?= htmlspecialchars($product['section']) ?></div>
            <? if (!empty($product['reason_of_markdown'])): ?>
                <div style="margin: 20px 0; padding: 15px; background: #fff3cd; border-radius: 8px;">
                    <strong>Причина уценки:</strong><br>
                    <?= nl2br(htmlspecialchars($product['reason_of_markdown'])) ?>
                </div>
            <? endif; ?>
            <div style="margin-top: 30px;">
                <button class="button is-primary" onclick="show_backup_call(2, '<?= htmlspecialchars($product['name']) ?>')" style="background: #e00; border-color: #e00;">Купить со скидкой</button>
                <a href="/discounted/" class="button is-light">← Вернуться к списку</a>
            </div>
        </div>
    </div>
</div>
<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>