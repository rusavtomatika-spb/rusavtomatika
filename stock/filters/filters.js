function applyFilters() {
  document.querySelectorAll('.filter-group input[type="checkbox"]').forEach(function(cb) {
    cb.parentElement.classList.toggle('active', cb.checked)
  })
  
  var tableId = document.querySelector('table[id]').id;
  var rows = document.querySelectorAll('#' + tableId + ' tbody tr')
  var searchQuery = document.getElementById('search').value.toLowerCase()
  
  var brandWeintek = document.querySelector('#filter-brand input[value="weintek"]').checked
  var brandIfc = document.querySelector('#filter-brand input[value="ifc"]').checked
  var brandOther = document.querySelector('#filter-brand input[value="other"]').checked
  var typePanel = document.querySelector('#filter-type input[value="panel"]').checked
  var typeServer = document.querySelector('#filter-type input[value="server"]').checked
  var typeGateway = document.querySelector('#filter-type input[value="gateway"]').checked
  var typeOtherType = document.querySelector('#filter-type input[value="other_type"]')?.checked || false
  
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

document.getElementById('search').addEventListener('input', function() {
  applyFilters()
  sortTable()
})

document.querySelectorAll('#filter-brand input[type="checkbox"]').forEach(function(cb) {
  cb.addEventListener('change', function() {
    if (this.checked) {
      document.querySelectorAll('#filter-brand input[type="checkbox"]').forEach(function(other) {
        if (other !== cb) other.checked = false
        other.parentElement.classList.toggle('active', other.checked)
      })
    }
    applyFilters()
    sortTable()
  })
})

document.querySelectorAll('#filter-type input[type="checkbox"]').forEach(function(cb) {
  cb.addEventListener('change', function() {
    applyFilters()
    sortTable()
  })
})

document.getElementById('sort-diagonal').addEventListener('change', sortTable)
document.getElementById('sort-price').addEventListener('change', sortTable)

document.getElementById('sort-type').addEventListener('change', sortTable)
document.getElementById('sort-diagonal').addEventListener('change', sortTable)
document.getElementById('sort-price').addEventListener('change', sortTable)
document.addEventListener('DOMContentLoaded', function() {
  sortTable()
})

function sortTable() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  })
  var table = document.querySelector('table[id]')
  var tbody = table.querySelector('tbody')
  var rows = Array.from(tbody.querySelectorAll('tr[data-search]'))
  
  var typeSort = document.getElementById('sort-type').value
  var diagonalSort = document.getElementById('sort-diagonal').value
  var priceSort = document.getElementById('sort-price').value
  
  var visibleRows = rows.filter(function(row) {
    return row.style.display !== 'none'
  })
  
  var hiddenRows = rows.filter(function(row) {
    return row.style.display === 'none'
  })
  
  visibleRows.sort(function(a, b) {
    if (typeSort) {
      var typeOrder = {
        'Панели оператора': 'panel',
        'Промышленные мониторы': 'monitor',
        'Панельные компьютеры': 'panelpc',
        'Встраиваемые компьютеры': 'boxpc',
        'Встраиваемые компьютеры': 'moduleinpout',
        'Коммуникационные модули': 'communicationmodule',
        'Коммутаторы': 'commutator',
        'Шлюзы данных': 'gateway',
        'Серверы': 'server',
        'Остальное': 'other'
      }
      
      var sortKey = typeOrder[typeSort] || ''
      
      if (sortKey === 'other') {
        var aOther = (
          a.getAttribute('data-panel') !== '1' && 
          a.getAttribute('data-server') !== '1' && 
          a.getAttribute('data-gateway') !== '1' && 
          a.getAttribute('data-monitor') !== '1' &&
          a.getAttribute('data-panelpc') !== '1' &&
          a.getAttribute('data-boxpc') !== '1' &&
          a.getAttribute('data-moduleinpout') !== '1' &&
          a.getAttribute('data-communicationmodule') !== '1' &&
          a.getAttribute('data-commutator') !== '1'
        ) ? 0 : 1
        var bOther = (
          b.getAttribute('data-panel') !== '1' && 
          b.getAttribute('data-server') !== '1' && 
          b.getAttribute('data-gateway') !== '1' && 
          b.getAttribute('data-monitor') !== '1' &&
          b.getAttribute('data-panelpc') !== '1' &&
          b.getAttribute('data-boxpc') !== '1' &&
          b.getAttribute('data-moduleinpout') !== '1' &&
          b.getAttribute('data-communicationmodule') !== '1' &&
          b.getAttribute('data-commutator') !== '1'
        ) ? 0 : 1
        return aOther - bOther
      }
      
      if (sortKey) {
        var aMatch = a.getAttribute('data-' + sortKey) === '1' ? 0 : 1
        var bMatch = b.getAttribute('data-' + sortKey) === '1' ? 0 : 1
        if (aMatch !== bMatch) return aMatch - bMatch
      }
    }
    
    if (diagonalSort) {
      var diagA = parseFloat(a.getAttribute('data-diagonal')) || 0
      var diagB = parseFloat(b.getAttribute('data-diagonal')) || 0
      
      if (diagonalSort === 'asc') return diagA - diagB
      if (diagonalSort === 'desc') return diagB - diagA
    }
    
    if (priceSort) {
      var priceA = parseFloat(a.getAttribute('data-price')) || 0
      var priceB = parseFloat(b.getAttribute('data-price')) || 0
      
      if (priceSort === 'asc') return priceA - priceB
      if (priceSort === 'desc') return priceB - priceA
    }
    
    return 0
  })
  
  if (!typeSort && !diagonalSort && !priceSort) {
    visibleRows.sort(function(a, b) {
      var aSearch = a.getAttribute('data-search') || ''
      var bSearch = b.getAttribute('data-search') || ''
      return aSearch.localeCompare(bSearch)
    })
  }
  
  tbody.innerHTML = ''
  visibleRows.forEach(function(row) { tbody.appendChild(row) })
  hiddenRows.forEach(function(row) { tbody.appendChild(row) })
}