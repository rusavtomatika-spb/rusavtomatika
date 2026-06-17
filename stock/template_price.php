<?php if (!isset($prices)) $prices = array(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Цены — ETM Stock</title>
    <link rel="stylesheet" href="/stock/style.css">
</head>
<body>
    <div class="container">
      <div class="header">
        <h1>Цены товаров</h1>
        <div class="header-info">
          <span>Всего позиций: <?= count($prices) ?></span>
          <span>Курс USD: <?= $usd_rate > 0 ? $usd_rate : 'не задан' ?></span>
          <a href="/stock" class="btn-back">Склад</a>
        </div>
      </div>
      <div class="filters">
        <input type="text" id="search" placeholder="🔍 Поиск по артикулу или описанию..." autofocus>
      </div>
      <div class="table-wrap">
        <table id="price-table">
          <thead>
            <tr>
              <th>Артикул</th>
              <th>Цена USD</th>
              <th>Цена RUB</th>
              <th>Описание</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($prices)): ?>
              <tr>
                <td colspan="4" class="empty">Нет данных</td>
              </tr>
            <?php else: ?>
              <?php foreach ($prices as $item): 
                $article = htmlspecialchars($item['articul']);
                $price_usd = $item['price_usd'] ? floatval($item['price_usd']) : 0;
                $price_rub = $item['price_rub'] ? floatval($item['price_rub']) : 0;
                $desc = htmlspecialchars($item['description'] ?: '');
              ?>
              <tr data-search="<?= strtolower($article . ' ' . $desc) ?>">
                <td class="article"><?= $article ?></td>
                <td class="price"><?= formatPrice($price_usd, $usd_rate, true) ?></td>
                <td class="price"><?= $price_rub ? '₽' . number_format($price_rub, 2, '.', ' ') : '—' ?></td>
                <td class="desc"><?= $desc ?: '—' ?></td>
              </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <script>
    document.getElementById('search').addEventListener('input', function() {
      var query = this.value.toLowerCase();
      var rows = document.querySelectorAll('#price-table tbody tr')
      
      rows.forEach(function(row) {
        var searchData = row.getAttribute('data-search')
        if (searchData && searchData.indexOf(query) !== -1) {
          row.style.display = ''
        } else if (searchData) {
          row.style.display = 'none'
        }
      })
    })
    </script>
</body>
</html>