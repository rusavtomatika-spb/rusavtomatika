<?php if (!isset($stock_data)) $stock_data = array(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Склад 1С</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header class="header-wrapper">
      <div class="header-actions-container">
        <div class="header">
          <div class="header__logo-wrapper">
            <h1>Склад</h1>
            <img src="./assets/1c-logo.jpg">
          </div>
          <div class="header-info">
            <span>Всего позиций: <?= count($stock_data) ?></span>
            <a href="/stock/price" class="btn-back">Указать цены</a>
          </div>
        </div>
        <?php require __DIR__ . '/filters/filters.php'; ?>
      </div>
    </header>
    <div class="table-wrap">
      <table id="stock-table">
        <thead>
          <tr>
            <th>Артикул</th>
            <th>Наименование</th>
            <th>Диагональ</th>
            <th>Габариты</th>
            <th>Остаток</th>
            <th>ГТД</th>
            <th>Цена</th>
            <th>Сумма</th>
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
              $article_raw = $item['article_original'];
              $name_raw = $item['name'];
              
              $article = htmlspecialchars($article_raw);
              $name = htmlspecialchars($name_raw);
              $qty = $item['quantity'];
              $gtd = htmlspecialchars($item['gtd'] ? $item['gtd'] : '');
              $price = isset($item['price_stock']) ? floatval($item['price_stock']) : 0;
              $sum = $price * $qty;
              
              $qty_class = 'qty-ok';
              if ($qty == 0) $qty_class = 'qty-zero';
              elseif ($qty < 5) $qty_class = 'qty-low';
              
              $searchData = mb_strtolower($article_raw . ' ' . $name_raw, 'UTF-8');
              $article_lower = mb_strtolower($article_raw, 'UTF-8');
              $name_lower = mb_strtolower($name_raw, 'UTF-8');

              $diagonal = '—';
              if (isset($diagonal_data[$article_lower])) {
                $d = $diagonal_data[$article_lower];
                $diagonal = floor($d) == $d ? number_format($d, 0) : number_format($d, 1);
                $diagonal .= '"';
              }

              $dimensions = '—';
              if (isset($dimensions_data[$article_lower]) && !empty($dimensions_data[$article_lower])) {
                $dimensions = htmlspecialchars($dimensions_data[$article_lower]);
              }

              $hasWeintek = (strpos($article_lower, 'weintek') !== false || strpos($name_lower, 'weintek') !== false) ? '1' : '0';
              $hasIfc = (strpos($article_lower, 'ifc') !== false || strpos($name_lower, 'ifc') !== false) ? '1' : '0';
              $hasPanel = (strpos($article_lower, 'панель оператора') !== false || strpos($name_lower, 'панель оператора') !== false || strpos($article_lower, 'операторская панель') !== false || strpos($name_lower, 'операторская панель') !== false) ? '1' : '0';
              $hasServer = (strpos($article_lower, 'сервер') !== false || strpos($name_lower, 'сервер') !== false) ? '1' : '0';
              $hasGateway = (strpos($article_lower, 'шлюз') !== false || strpos($name_lower, 'шлюз') !== false) ? '1' : '0';
              $hasMonitor = (strpos($article_lower, 'промышленный монитор') !== false || strpos($name_lower, 'промышленный монитор') !== false) ? '1' : '0';
              $hasPanelPc = (strpos($article_lower, 'панельный компьютер') !== false || strpos($name_lower, 'панельный компьютер') !== false) ? '1' : '0';
              $hasBoxPc = (strpos($article_lower, 'встраиваемый компьютер') !== false || strpos($name_lower, 'встраиваемый компьютер') !== false) ? '1' : '0';
              $hasModuleInpOut = (strpos($article_lower, 'модуль ввода') !== false || strpos($name_lower, 'модуль ввода') !== false) ? '1' : '0';
              $hasCommunicationModule = (strpos($article_lower, 'коммуникационный модуль') !== false || strpos($name_lower, 'коммуникационный модуль') !== false) ? '1' : '0';
              $hasCommutator = (strpos($article_lower, 'коммутатор') !== false || strpos($name_lower, 'коммутатор') !== false) ? '1' : '0';
              
            
            
            ?>
            <tr data-search="<?= $searchData ?>"
              data-diagonal="<?= isset($diagonal_data[$article_lower]) ? $diagonal_data[$article_lower] : '0' ?>"
              data-price="<?= $price ?>"
              data-weintek="<?= $hasWeintek ?>"
              data-ifc="<?= $hasIfc ?>"
              data-panel="<?= $hasPanel ?>"
              data-server="<?= $hasServer ?>"
              data-gateway="<?= $hasGateway ?>"
              data-monitor="<?= $hasMonitor ?>"
              data-panelpc="<?= $hasPanelPc ?>"
              data-boxpc="<?= $hasBoxPc ?>"
              data-moduleinpout="<?= $hasModuleInpOut ?>"
              data-communicationmodule="<?= $hasCommunicationModule ?>"
              data-commutator="<?= $hasCommutator ?>"
            >
              <td class="article"><?= $article ?></td>
              <td class="name-full" title="<?= $name ?>">
                <p><?= $name ?></p>
                <?php if (mb_strlen($name_raw, 'UTF-8') > 48): ?>
                  <button class="open__fullname-button">Открыть</button>
                <?php endif; ?>
              </td>
              <td><?= $diagonal ?></td>
              <td class="gtd"><?= $dimensions ?></td>
              <td class="<?= $qty_class ?>"><?= $qty ?></td>
              <td class="gtd"><?= $gtd ?: '—' ?></td>
              <td class="price"><?= $price > 0 ? number_format($price, floor($price) == $price ? 0 : 2, '.', ' ') . ' ₽' : '—' ?></td>
              <td class="price"><?= $sum > 0 ? number_format($sum, floor($sum) == $sum ? 0 : 2, '.', ' ') . ' ₽' : '—' ?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.querySelectorAll('.open__fullname-button').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var td = this.parentElement
        td.classList.toggle('expanded')
        this.textContent = td.classList.contains('expanded') ? 'Скрыть' : 'Открыть'
      })
    })
  </script>
  <script src="/stock/filters/filters.js"></script>
</body>
</html>