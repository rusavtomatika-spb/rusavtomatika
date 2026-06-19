<div class="actions-wrapper">
  <div class="filters-wrapper">
    <input type="text" id="search" placeholder="🔍 Поиск по артикулу или названию..." autofocus>
    <input type="text" id="search-qty" placeholder="🔍 Поиск по количеству...">
    <input type="text" id="search-price" placeholder="🔍 Поиск по цене...">
  </div>
  <div class="filters-wrapper">
    <div class="sort-blocks">
      <div class="sort__item">
        <span class="filter-title">По типу:</span>
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
        <span class="filter-title">По диагонали:</span>
        <select id="sort-diagonal">
          <option value="">--По диагонали--</option>
          <option value="asc">По возрастанию</option>
          <option value="desc">По убыванию</option>
        </select>
      </div>
      <div class="sort__item">
        <span class="filter-title">По цене:</span>
        <select id="sort-price">
          <option value="">--По цене--</option>
          <option value="asc">По возрастанию</option>
          <option value="desc">По убыванию</option>
        </select>
      </div>
    </div>
    <div class="filter-blocks">
      <div class="filter-group" id="filter-brand">
        <span class="filter-title">Бренд:</span>
        <div class="filter-items-wrapper">
          <label><input type="checkbox" value="weintek" onchange="applyFilters()"> Weintek</label>
          <label><input type="checkbox" value="ifc" onchange="applyFilters()"> IFC</label>
          <label><input type="checkbox" value="samkoon" onchange="applyFilters()"> Samkoon</label>
          <label><input type="checkbox" value="aplex" onchange="applyFilters()"> Aplex</label>
          <label><input type="checkbox" value="spiktek" onchange="applyFilters()"> Спиктек</label>
        </div>
      </div>
      <div class="filter-group" id="filter-type">
        <span class="filter-title">Тип:</span>
        <div class="filter-items-wrapper">
          <label><input type="checkbox" value="panel" onchange="applyFilters()">Панели оператора</label>
          <label><input type="checkbox" value="monitor" onchange="applyFilters()">Промышленные мониторы</label>
          <label><input type="checkbox" value="panelpc" onchange="applyFilters()">Панельные компьютеры</label>
          <label><input type="checkbox" value="boxpc" onchange="applyFilters()">Встраиваемые компьютеры</label>
          <label><input type="checkbox" value="moduleinpout" onchange="applyFilters()">Модули ввода-вывода</label>
          <label><input type="checkbox" value="communicationmodule" onchange="applyFilters()">Коммуникационные модули</label>
          <label><input type="checkbox" value="commutator" onchange="applyFilters()">Коммутаторы</label>
          <label><input type="checkbox" value="gateway" onchange="applyFilters()">Шлюзы данных</label>
          <label><input type="checkbox" value="server" onchange="applyFilters()">Серверы</label>
          <label><input type="checkbox" value="other_type" onchange="applyFilters()">Остальное</label>
        </div>
      </div>
    </div>
  </div>
</div>