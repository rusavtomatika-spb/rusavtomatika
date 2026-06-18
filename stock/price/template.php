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
    <div class="toast <?= $message_type ?>" id="toast"><?= htmlspecialchars($message) ?></div>
    <header class="header-wrapper">
      <div class="header-actions-container">
        <div class="header">
          <h1>Цены товаров</h1>
          <div class="header-info">
            <span>Всего позиций: <?= count($prices) ?></span>
            <span>Курс USD: <?= $usd_rate > 0 ? $usd_rate : 'не задан' ?></span>
            <a href="/stock" class="btn-back">Склад 1С</a>
          </div>
        </div>
        <?php require __DIR__ . '/../filters/filters.php'; ?>
      </div>
    </header>
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
              <td class="price"><?= $price_rub ? number_format($price_rub, floor($price_rub) == $price_rub ? 0 : 2, '.', ' ') . ' ₽' : '—' ?></td>
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
  <script src="/stock/filters/filters.js"></script>
</body>
</html>