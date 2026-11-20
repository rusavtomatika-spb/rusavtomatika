<?php
global $arSettings;

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

$popCurrentType = isset($_GET['type']) ? $_GET['type'] : 'all';
$popTypeLabels = array(
    'all'      => 'везде',
    'products' => 'по товарам',
    'articles' => 'по статьям'
);
if (!isset($popTypeLabels[$popCurrentType])) {
    $popCurrentType = 'all';
}
$popCurrentTypeLabel = $popTypeLabels[$popCurrentType];

$searchInstanceId = isset($search_instance_id) ? $search_instance_id : 'catalog_search_' . uniqid();
?>
<div class="catalog_toolbar__search_block pop_menu_search_block"
     id="<?= htmlspecialchars($searchInstanceId) ?>"
     data-search-instance="<?= htmlspecialchars($searchInstanceId) ?>"
     style="width: 100%; margin-bottom: 10px;">
    <form action="/catalog/search/" class="catalog_toolbar__form_search" method="get">
        <input type="hidden"
               name="type"
               value="<?= htmlspecialchars($popCurrentType) ?>"
               class="search_type_input">
        <input type="text"
               name="search"
               placeholder="Поиск (ищу даже по трём символам)"
               <?php if (isset($_GET['search']) && $_GET['search'] != ''): ?>
                   value="<?= htmlspecialchars(strip_tags($_GET['search']), ENT_QUOTES, 'UTF-8') ?>"
               <?php endif; ?>>
        <button type="submit"></button>
    </form>
    <div class="catalog_toolbar__search_type">
        <span class="search_type_label">искать:</span>
        <div class="search_type_dropdown">
            <button type="button" class="search_type_toggle">
                <span class="search_type_current"><?= htmlspecialchars($popCurrentTypeLabel) ?></span>
                <svg class="search_type_arrow" width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="search_type_menu">
                <a href="#" class="search_type_option <?= $popCurrentType == 'all' ? 'active' : '' ?>" data-type="all">везде</a>
                <a href="#" class="search_type_option <?= $popCurrentType == 'products' ? 'active' : '' ?>" data-type="products">по товарам</a>
                <a href="#" class="search_type_option <?= $popCurrentType == 'articles' ? 'active' : '' ?>" data-type="articles">по статьям</a>
            </div>
        </div>
    </div>
</div>