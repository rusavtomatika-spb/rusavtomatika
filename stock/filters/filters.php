<div class="actions-wrapper">
  <input type="text" id="search" placeholder="🔍 Поиск по артикулу или названию..." autofocus>
  <div class="filter-blocks">
    <div class="filter-group" id="filter-brand">
      <span style="font-size:13px;color:#888;margin-right:5px;">Бренд:</span>
      <div class="filter-items-wrapper">
        <label><input type="checkbox" value="weintek" onchange="applyFilters()"> Weintek</label>
        <label><input type="checkbox" value="ifc" onchange="applyFilters()"> IFC</label>
        <label><input type="checkbox" value="other" onchange="applyFilters()"> Другое</label>
      </div>
    </div>
    <div class="filter-group" id="filter-type">
      <span style="font-size:13px;color:#888;margin-right:5px;">Тип:</span>
      <div class="filter-items-wrapper">
        <label><input type="checkbox" value="panel" onchange="applyFilters()"> Панель оператора</label>
        <label><input type="checkbox" value="server" onchange="applyFilters()"> Сервер</label>
        <label><input type="checkbox" value="gateway" onchange="applyFilters()"> Шлюз</label>
        <label><input type="checkbox" value="other_type" onchange="applyFilters()"> Другое</label>
      </div>
    </div>
  </div>
</div>