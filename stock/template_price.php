<?php if (!isset($prices)) $prices = array(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Цены</title>
    <link rel="stylesheet" href="/stock/style.css">
    <style>
      .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 1000;
        justify-content: center;
        align-items: center;
      }
      .modal-overlay.active { display: flex; }
      .modal {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        width: 500px;
        max-width: 90%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      }
      .modal h3 { margin-bottom: 20px; color: #1a1a2e; }
      .form-group { margin-bottom: 15px; }
      .form-group label {
        display: block;
        font-size: 13px;
        color: #666;
        margin-bottom: 5px;
        font-weight: 500;
      }
      .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
      }
      .form-group input:focus, .form-group textarea:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 0 3px rgba(0,188,212,0.1);
      }
      .form-group textarea { resize: vertical; min-height: 60px; }
      .form-row { display: flex; gap: 15px; }
      .form-row .form-group { flex: 1; }
      .modal-buttons { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
      .btn { padding: 10px 24px; border: none; border-radius: 6px; font-size: 14px; cursor: pointer; font-weight: 500; }
      .btn-save { background: #00bcd4; color: #fff; }
      .btn-save:hover { background: #00acc1; }
      .btn-cancel { background: #eee; color: #333; }
      .btn-cancel:hover { background: #ddd; }
      .btn-delete { background: #ef5350; color: #fff; }
      .btn-delete:hover { background: #e53935; }
      .btn-add { background: #00ad61; color: #fff; text-decoration: none; display: inline-block; }
      .btn-add:hover { background: #00be6c; }
      .btn-edit, .btn-del {
        padding: 5px 12px;
        font-size: 12px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
        font-weight: 500;
      }
      .btn-edit { background: #fff3e0; color: #e65100; }
      .btn-edit:hover { background: #ffe0b2; }
      .btn-del { background: #ffebee; color: #c62828; }
      .btn-del:hover { background: #ffcdd2; }
      .actions { display: flex; gap: 5px; }
      .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 14px 24px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        pointer-events: none;
      }
      .toast.show {
        opacity: 1;
        transform: translateX(0);
      }
      .toast.ok {
        background: #e8f5e9;
        color: #2e7d32;
        border-left: 4px solid #4caf50;
      }
      .toast.error {
        background: #ffebee;
        color: #c62828;
        border-left: 4px solid #ef5350;
      }
    </style>
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
      <div class="toast <?= $message_type ?>" id="toast"><?= htmlspecialchars($message) ?></div>
      <div class="filters" style="display: flex; gap: 10px; align-items: center;">
        <input type="text" id="search" placeholder="🔍 Поиск по артикулу или описанию..." autofocus style="flex: 1;">
        <button class="btn btn-add" onclick="openAddModal()">Добавить товар</button>
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
                $article = htmlspecialchars($item['articul']);
                $price_usd = $item['price_usd'] ? floatval($item['price_usd']) : 0;
                $price_rub = $item['price_rub'] ? floatval($item['price_rub']) : 0;
                $desc = htmlspecialchars($item['description'] ?: '');
                $id = $item['id'];
              ?>
              <tr data-search="<?= strtolower($article . ' ' . $desc) ?>"
                data-id="<?= $id ?>"
                data-articul="<?= $article ?>"
                data-price-usd="<?= $price_usd ?>"
                data-price-rub="<?= $price_rub ?>"
                data-description="<?= htmlspecialchars($item['description'] ?: '') ?>">
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
        var toast = document.getElementById('toast');
        setTimeout(function() { toast.classList.add('show'); }, 100);
        setTimeout(function() { 
            toast.classList.remove('show');
        }, 5000);
    })();
    <?php endif; ?>
    document.getElementById('search').addEventListener('input', function() {
      var query = this.value.toLowerCase();
      var rows = document.querySelectorAll('#price-table tbody tr');
      rows.forEach(function(row) {
        var searchData = row.getAttribute('data-search');
        if (!searchData) return;
        row.style.display = searchData.indexOf(query) !== -1 ? '' : 'none';
      });
    });
    
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