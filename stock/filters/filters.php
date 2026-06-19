<div class="actions-wrapper">
  <div class="search-filters-wrapper">
    <input type="text" id="search" placeholder="🔍 Поиск по артикулу или названию..." autofocus>
    <div class="filter-blocks">
      <div class="filter-group" id="filter-brand">
        <span style="font-size:13px;color:#888;">Бренд:</span>
        <div class="filter-items-wrapper">
          <label><input type="checkbox" value="weintek" onchange="applyFilters()"> Weintek</label>
          <label><input type="checkbox" value="ifc" onchange="applyFilters()"> IFC</label>
          <label><input type="checkbox" value="other" onchange="applyFilters()"> Другое</label>
        </div>
      </div>
      <div class="filter-group" id="filter-type">
        <span style="font-size:13px;color:#888;">Тип:</span>
        <div class="filter-items-wrapper">
          <label><input type="checkbox" value="panel" onchange="applyFilters()"> Панель оператора</label>
          <label><input type="checkbox" value="server" onchange="applyFilters()"> Сервер</label>
          <label><input type="checkbox" value="gateway" onchange="applyFilters()"> Шлюз</label>
          <label><input type="checkbox" value="other_type" onchange="applyFilters()"> Другое</label>
        </div>
      </div>
    </div>
  </div>
  <div class="sort-blocks">
    <div class="sort__item">
      <span style="font-size:13px;color:#888;">По типу:</span>
      <select id="sort-type">
        <option>Панели оператора</option>
        <option>Промышленные мониторы</option>
        <option>Панельные компьютеры</option>
        <option>Встраиваемые компьютеры</option>
        <option>Модули ввода-вывода</option>
        <option>Коммуникационные модули</option>
        <option>Коммутаторы</option>
        <option>Шлюзы данных</option>
        <option>Серверы</option>
        <option>Остальное</option>
      </select>
    </div>
    <div class="sort__item">
      <span style="font-size:13px;color:#888;">По диагонали:</span>
      <select id="sort-diagonal">
        <option value="">--По диагонали--</option>
        <option value="asc">По возрастанию</option>
        <option value="desc">По убыванию</option>
      </select>
    </div>
    <div class="sort__item">
      <span style="font-size:13px;color:#888;">По цене:</span>
      <select id="sort-price">
        <option value="">--По цене--</option>
        <option value="asc">По возрастанию</option>
        <option value="desc">По убыванию</option>
      </select>
    </div>
  </div>
</div>