<?php if (!isset($prices)) $prices = array(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Цены товаров</title>
  <link rel="stylesheet" href="/stock/style.css">
</head>
<body>
    <div class="container">
      <div class="header">
        <h1>Цены товаров</h1>
        <div class="header-info">
          <span>Всего позиций: <?= count($prices) ?></span>
          <span>Курс USD: <?= $usd_rate > 0 ? $usd_rate : 'не задан' ?></span>
          <a href="/stock" class="btn-back">Склад 1С</a>
        </div>
      </div>
      <div class="toast <?= $message_type ?>" id="toast"><?= htmlspecialchars($message) ?></div>
      <div class="actions-wrapper">
        <div class="filters">
          <input type="text" id="search" placeholder="🔍 Поиск по артикулу или описанию..." autofocus style="flex: 1;">
          <button class="btn btn-add" onclick="openAddModal()">Добавить товар</button>
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
          </div>
        </div>
      </div>
      <div class="table-wrap">
        <table id="price-table">
          <thead>
            <tr>
              <th>Артикул</th>
              <th>Цена USD</th>
              <th>Цена RUB</th>
              <th>Описание</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($prices)): ?>
              <tr>
                <td colspan="5" class="empty">Нет данных</td>
              </tr>
            <?php else: ?>
              <?php foreach ($prices as $item): 
                $article_raw = $item['articul'];
                $desc_raw = $item['description'] ?: '';
                
                $article = htmlspecialchars($article_raw);
                $price_usd = $item['price_usd'] ? floatval($item['price_usd']) : 0;
                $price_rub = $item['price_rub'] ? floatval($item['price_rub']) : 0;
                $desc = htmlspecialchars($desc_raw);
                $id = $item['id'];
                
                $searchData = mb_strtolower($article_raw . ' ' . $desc_raw, 'UTF-8');
                $article_lower = mb_strtolower($article_raw, 'UTF-8');
                $desc_lower = mb_strtolower($desc_raw, 'UTF-8');
                
                $hasWeintek = (strpos($article_lower, 'weintek') !== false || strpos($desc_lower, 'weintek') !== false) ? '1' : '0';
                $hasIfc = (strpos($article_lower, 'ifc') !== false || strpos($desc_lower, 'ifc') !== false) ? '1' : '0';
                $hasPanel = (strpos($article_lower, 'панель') !== false || strpos($desc_lower, 'панель') !== false) ? '1' : '0';
                $hasServer = (strpos($article_lower, 'сервер') !== false || strpos($desc_lower, 'сервер') !== false) ? '1' : '0';
                $hasGateway = (strpos($article_lower, 'шлюз ') !== false || strpos($desc_lower, 'шлюз') !== false) ? '1' : '0';
              ?>
              <tr data-search="<?= $searchData ?>"
                data-id="<?= $id ?>"
                data-articul="<?= $article ?>"
                data-price-usd="<?= $price_usd ?>"
                data-price-rub="<?= $price_rub ?>"
                data-description="<?= htmlspecialchars($item['description'] ?: '') ?>"
                data-weintek="<?= $hasWeintek ?>"
                data-ifc="<?= $hasIfc ?>"
                data-panel="<?= $hasPanel ?>"
                data-server="<?= $hasServer ?>"
                data-gateway="<?= $hasGateway ?>"
              >
                <td class="article"><?= $article ?></td>
                <td class="price"><?= formatPrice($price_usd, $usd_rate, true) ?></td>
                <td class="price"><?= $price_rub ? '₽' . number_format($price_rub, 2, '.', ' ') : '—' ?></td>
                <td class="desc"><?= $desc ?: '—' ?></td>
                <td class="actions">
                  <button class="btn-edit" onclick="openEditModal(this)">✎</button>
                  <button class="btn-del" onclick="deleteItem(<?= $id ?>, '<?= $article ?>')">✕</button>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-overlay" id="modal">
      <div class="modal">
        <h3 id="modal-title">Добавить товар</h3>
        <form method="post" id="modal-form">
          <input type="hidden" name="action" id="form-action" value="add">
          <input type="hidden" name="id" id="form-id" value="">
          <div class="form-group">
            <label>Артикул *</label>
            <input type="text" name="articul" id="form-articul" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Цена USD</label>
              <input type="number" name="price_usd" id="form-price-usd" step="0.01" min="0">
            </div>
            <div class="form-group">
              <label>Цена RUB</label>
              <input type="number" name="price_rub" id="form-price-rub" step="0.01" min="0">
            </div>
          </div>
          <div class="form-group">
            <label>Описание</label>
            <textarea name="description" id="form-description" rows="3"></textarea>
          </div>
          <div class="modal-buttons">
            <button type="button" class="btn btn-cancel" onclick="closeModal()">Отмена</button>
            <button type="submit" class="btn btn-save">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
    <form method="post" id="delete-form" style="display: none;">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" id="delete-id" value="">
    </form>
    <script>
    <?php if ($message): ?>
    (function() {
      var toast = document.getElementById('toast')
      setTimeout(function() { toast.classList.add('show'); }, 100)
      setTimeout(function() { toast.classList.remove('show'); }, 5000)
    })()
    <?php endif; ?>
    
    function applyFilters() {
      document.querySelectorAll('.filter-group input[type="checkbox"]').forEach(function(cb) {
        cb.parentElement.classList.toggle('active', cb.checked)
      })
      
      var brandGroup = document.querySelectorAll('#filter-brand input[type="checkbox"]')
      brandGroup.forEach(function(cb) {
        cb.addEventListener('change', function() {
          if (this.checked) {
            brandGroup.forEach(function(other) {
              if (other !== cb) other.checked = false
              other.parentElement.classList.toggle('active', other.checked)
            })
          }
          applyFilters()
        })
      })
      
      var rows = document.querySelectorAll('#price-table tbody tr')
      var searchQuery = document.getElementById('search').value.toLowerCase()
      
      var brandWeintek = document.querySelector('#filter-brand input[value="weintek"]').checked
      var brandIfc = document.querySelector('#filter-brand input[value="ifc"]').checked
      var brandOther = document.querySelector('#filter-brand input[value="other"]').checked
      var typePanel = document.querySelector('#filter-type input[value="panel"]').checked
      var typeServer = document.querySelector('#filter-type input[value="server"]').checked
      var typeGateway = document.querySelector('#filter-type input[value="gateway"]').checked
      
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
        
        if (show && (typePanel || typeServer || typeGateway)) {
          var p = row.getAttribute('data-panel') === '1'
          var s = row.getAttribute('data-server') === '1'
          var g = row.getAttribute('data-gateway') === '1'
          
          if (typePanel && !p) show = false
          if (typeServer && !s) show = false
          if (typeGateway && !g) show = false
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
    
    function openAddModal() {
      document.getElementById('modal-title').textContent = 'Добавить товар';
      document.getElementById('form-action').value = 'add';
      document.getElementById('form-id').value = '';
      document.getElementById('form-articul').value = '';
      document.getElementById('form-price-usd').value = '';
      document.getElementById('form-price-rub').value = '';
      document.getElementById('form-description').value = '';
      document.getElementById('form-articul').readOnly = false;
      document.getElementById('modal').classList.add('active');
    }
    
    function openEditModal(btn) {
      var row = btn.closest('tr');
      document.getElementById('modal-title').textContent = 'Редактировать товар';
      document.getElementById('form-action').value = 'edit';
      document.getElementById('form-id').value = row.getAttribute('data-id');
      document.getElementById('form-articul').value = row.getAttribute('data-articul');
      document.getElementById('form-price-usd').value = row.getAttribute('data-price-usd');
      document.getElementById('form-price-rub').value = row.getAttribute('data-price-rub');
      document.getElementById('form-description').value = row.getAttribute('data-description');
      document.getElementById('form-articul').readOnly = true;
      document.getElementById('modal').classList.add('active');
    }
    
    function closeModal() {
      document.getElementById('modal').classList.remove('active');
    }
    
    function deleteItem(id, articul) {
      if (confirm('Удалить товар "' + articul + '"?')) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-form').submit();
      }
    }
    
    document.getElementById('modal').addEventListener('click', function(e) {
      if (e.target === this) closeModal()
    })
    </script>
</body>
</html>