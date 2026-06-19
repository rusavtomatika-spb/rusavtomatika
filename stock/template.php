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
            <span>Всего позиций на складе: <?= count($stock_data) ?></span>
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
            <th style="width: 16px;"></th>
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
              $hasSamkoon = (strpos($article_lower, 'samkoon') !== false || strpos($name_lower, 'samkoon') !== false) ? '1' : '0';
              $hasAplex = (strpos($article_lower, 'aplex') !== false || strpos($name_lower, 'aplex') !== false) ? '1' : '0';
              $hasSpiktek = (strpos($article_lower, 'спиктек') !== false || strpos($name_lower, 'спиктек') !== false) ? '1' : '0';
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
              data-qty="<?= $qty ?>"
              data-price="<?= $price ?>"
              data-diagonal="<?= isset($diagonal_data[$article_lower]) ? $diagonal_data[$article_lower] : '0' ?>"
              data-weintek="<?= $hasWeintek ?>"
              data-ifc="<?= $hasIfc ?>"
              data-samkoon="<?= $hasSamkoon ?>"
              data-aplex="<?= $hasAplex ?>"
              data-spiktek="<?= $hasSpiktek ?>"
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
              <td class="name-full" title="<?= $name ?>"><?= $name ?></td>
              <td><?= $diagonal ?></td>
              <td class="gtd"><?= $dimensions ?></td>
              <td class="<?= $qty_class ?>"><?= $qty ?></td>
              <td class="gtd"><?= $gtd ?: '—' ?></td>
              <td class="price"><?= $price > 0 ? number_format($price, floor($price) == $price ? 0 : 2, '.', ' ') . ' ₽' : '—' ?></td>
              <td class="price"><?= $sum > 0 ? number_format($sum, floor($sum) == $sum ? 0 : 2, '.', ' ') . ' ₽' : '—' ?></td>
              <td class="info">
                <?php if (mb_strlen($name_raw, 'UTF-8') > 48 || mb_strlen($gtd, 'UTF-8') > 23) : ?>
                  <button class="item__info-button">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="15" viewBox="0 0 256 256" xml:space="preserve">
                      <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path d="M 90 24.25 c 0 -0.896 -0.342 -1.792 -1.025 -2.475 c -1.366 -1.367 -3.583 -1.367 -4.949 0 L 45 60.8 L 5.975 21.775 c -1.367 -1.367 -3.583 -1.367 -4.95 0 c -1.366 1.367 -1.366 3.583 0 4.95 l 41.5 41.5 c 1.366 1.367 3.583 1.367 4.949 0 l 41.5 -41.5 C 89.658 26.042 90 25.146 90 24.25 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #00acc1; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                      </g>
                    </svg>
                  </button>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.querySelectorAll('.item__info-button').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var row = this.closest('tr')
        row.classList.toggle('expanded')
        this.style.transform = row.classList.contains('expanded') ? 'rotate(180deg)' : 'rotate(0deg)'
      })
    })
  </script>
  <script src="/stock/filters/filters.js"></script>
</body>
</html>