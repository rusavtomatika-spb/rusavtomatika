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
              <a href="/stock/price.php" class="btn-back">Указать цены</a>
            </div>
          </div>
          <div class="actions-wrapper">
            <div class="filters">
              <input type="text" id="search" placeholder="🔍 Поиск по артикулу или названию..." autofocus>
            </div>
            <div style="display: flex; gap: 10px; margin-bottom: 15px; width: 100%; justify-content: flex-end;">
              <div class="filter-group" id="filter-brand">
                <span style="font-size:13px;color:#888;margin-right:5px;">Бренд:</span>
                <label><input type="checkbox" value="weintek" onchange="applyFilters()"> Weintek</label>
                <label><input type="checkbox" value="ifc" onchange="applyFilters()"> IFC</label>
                <label><input type="checkbox" value="other" onchange="applyFilters()"> Другое</label>
              </div>
              <div class="filter-group" id="filter-type">
                <span style="font-size:13px;color:#888;margin-right:5px;">Тип:</span>
                <label><input type="checkbox" value="panel" onchange="applyFilters()"> Панель оператора</label>
                <label><input type="checkbox" value="server" onchange="applyFilters()"> Сервер</label>
                <label><input type="checkbox" value="gateway" onchange="applyFilters()"> Шлюз</label>
                <label><input type="checkbox" value="other_type" onchange="applyFilters()"> Другое</label>
              </div>
            </div>
          </div>
        </div>
      </header>
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
                $article_raw = $item['article_original'];
                $name_raw = $item['name'];
                
                $article = htmlspecialchars($article_raw);
                $name = htmlspecialchars($name_raw);
                $qty = $item['quantity'];
                $gtd = htmlspecialchars($item['gtd'] ? $item['gtd'] : '');
                
                $qty_class = 'qty-ok';
                if ($qty == 0) $qty_class = 'qty-zero';
                elseif ($qty < 5) $qty_class = 'qty-low';
                
                $searchData = mb_strtolower($article_raw . ' ' . $name_raw, 'UTF-8');
                $article_lower = mb_strtolower($article_raw, 'UTF-8');
                $name_lower = mb_strtolower($name_raw, 'UTF-8');
                
                $hasWeintek = (strpos($article_lower, 'weintek') !== false || strpos($name_lower, 'weintek') !== false) ? '1' : '0';
                $hasIfc = (strpos($article_lower, 'ifc') !== false || strpos($name_lower, 'ifc') !== false) ? '1' : '0';
                $hasPanel = (strpos($article_lower, 'панель оператора') !== false || strpos($name_lower, 'панель оператора') !== false || strpos($article_lower, 'операторская панель') !== false || strpos($name_lower, 'операторская панель') !== false) ? '1' : '0';
                $hasServer = (strpos($article_lower, 'сервер') !== false || strpos($name_lower, 'сервер') !== false) ? '1' : '0';
                $hasGateway = (strpos($article_lower, 'шлюз') !== false || strpos($name_lower, 'шлюз') !== false) ? '1' : '0';
              ?>
              <tr data-search="<?= $searchData ?>"
                data-weintek="<?= $hasWeintek ?>"
                data-ifc="<?= $hasIfc ?>"
                data-panel="<?= $hasPanel ?>"
                data-server="<?= $hasServer ?>"
                data-gateway="<?= $hasGateway ?>"
              >
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
    function applyFilters() {
      document.querySelectorAll('.filter-group input[type="checkbox"]').forEach(function(cb) {
        cb.parentElement.classList.toggle('active', cb.checked)
      })
      
      var rows = document.querySelectorAll('#stock-table tbody tr')
      var searchQuery = document.getElementById('search').value.toLowerCase()
      
      var brandWeintek = document.querySelector('#filter-brand input[value="weintek"]').checked
      var brandIfc = document.querySelector('#filter-brand input[value="ifc"]').checked
      var brandOther = document.querySelector('#filter-brand input[value="other"]').checked
      var typePanel = document.querySelector('#filter-type input[value="panel"]').checked
      var typeServer = document.querySelector('#filter-type input[value="server"]').checked
      var typeGateway = document.querySelector('#filter-type input[value="gateway"]').checked
      var typeOtherType = document.querySelector('#filter-type input[value="other_type"]').checked
      
      rows.forEach(function(row) {
        var show = true
        var searchData = row.getAttribute('data-search')
        
        if (searchQuery && searchData && searchData.indexOf(searchQuery) === -1) {
          show = false
        }
        
        if (show && (brandWeintek || brandIfc || brandOther)) {
          var w = row.getAttribute('data-weintek') === '1'
          var i = row.getAttribute('data-ifc') === '1'
          
          if (brandWeintek && !w) show = false
          if (brandIfc && !i) show = false
          if (brandOther && (w || i)) show = false
        }
        
        if (show && (typePanel || typeServer || typeGateway || typeOtherType)) {
          var p = row.getAttribute('data-panel') === '1'
          var s = row.getAttribute('data-server') === '1'
          var g = row.getAttribute('data-gateway') === '1'
          
          if (typePanel && !p) show = false
          if (typeServer && !s) show = false
          if (typeGateway && !g) show = false
          if (typeOtherType && (p || s || g)) show = false
        }
        
        row.style.display = show ? '' : 'none'
      })
    }
    
    document.getElementById('search').addEventListener('input', applyFilters)
    
    document.querySelectorAll('#filter-brand input[type="checkbox"]').forEach(function(cb) {
      cb.addEventListener('change', function() {
        if (this.checked) {
          document.querySelectorAll('#filter-brand input[type="checkbox"]').forEach(function(other) {
            if (other !== cb) other.checked = false
            other.parentElement.classList.toggle('active', other.checked)
          })
        }
        applyFilters()
      })
    })
  </script>
</body>
</html>