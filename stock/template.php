<?php if (!isset($stock_data)) $stock_data = array(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Склад</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
      <div class="header">
        <h1>📦 Склад</h1>
        <div class="header-info">
          <span>Всего позиций: <?= count($stock_data) ?></span>
          <a href="/stock/price.php" class="btn-back">Указать цены</a>
        </div>
      </div>
      <div class="filters">
        <input type="text" id="search" placeholder="🔍 Поиск по артикулу или названию..." autofocus>
      </div>
      <div class="table-wrap">
        <table id="stock-table">
          <thead>
            <tr>
              <th>Артикул</th>
              <th>Наименование</th>
              <th>Остаток</th>
              <th>ГТД</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($stock_data)): ?>
              <tr>
                <td colspan="4" class="empty">Нет данных</td>
              </tr>
            <?php else: ?>
              <?php 
              uasort($stock_data, function($a, $b) {
                return strcasecmp($a['article_original'], $b['article_original']);
              });
              
              foreach ($stock_data as $item): 
                $article = htmlspecialchars($item['article_original']);
                $name = htmlspecialchars($item['name']);
                $qty = $item['quantity'];
                $gtd = htmlspecialchars($item['gtd'] ? $item['gtd'] : '');
                
                $qty_class = 'qty-ok';
                if ($qty == 0) $qty_class = 'qty-zero';
                elseif ($qty < 5) $qty_class = 'qty-low';
              ?>
              <tr data-search="<?= strtolower($article . ' ' . $name) ?>">
                <td class="article"><?= $article ?></td>
                <td class="name-full" title="<?= $name ?>"><?= $name ?></td>
                <td class="<?= $qty_class ?>"><?= $qty ?></td>
                <td class="gtd"><?= $gtd ?: '—' ?></td>
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
        var rows = document.querySelectorAll('#stock-table tbody tr')
        
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