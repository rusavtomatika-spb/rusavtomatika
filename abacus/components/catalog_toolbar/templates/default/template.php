<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

$currentType = isset($_GET['type']) ? $_GET['type'] : 'all';
$typeLabels = array(
    'all' => 'везде',
    'products' => 'по товарам',
    'articles' => 'по статьям'
);
$currentTypeLabel = isset($typeLabels[$currentType]) ? $typeLabels[$currentType] : 'везде';

?>
<div class="catalog_toolbar_wrapper">
    <div class="catalog_toolbar" style="opacity: 0">
    <div class="container is-widescreen">
                <div class="catalog_toolbar__wrapper">
                    <div class="catalog_toolbar__item_group">

                            <a href="/catalog/">
                                <div class="button is-success is-small-mobile"><span class="icon_hamburger"></span>Каталог</div>
                            </a>
                            <span class="open_pop_catalog"></span>
                        <?
                        CoreApplication::include_component(array("component" => "catalog_pop_menu"));
                        ?>
                        <div class="catalog_toolbar__search_block" style="width: 100%;">
                            <form action="/catalog/search/" class="catalog_toolbar__form_search">
                                <input type="hidden" name="type" value="<?= htmlspecialchars($currentType) ?>" class="search_type_input">
                                <input type="text" placeholder="Поиск по каталогу (ищу даже по трём символам)" <?
                                if(isset($_GET['search']) and $_GET['search'] != ''){
                                    echo 'value="'.strip_tags($_GET['search']).'"';
                                }
                                ?>>
                                <button></button>
                            </form>
                            <div class="catalog_toolbar__search_type">
                                <span class="search_type_label">искать:</span>
                                <div class="search_type_dropdown">
                                    <button type="button" class="search_type_toggle">
                                        <span class="search_type_current"><?= htmlspecialchars($currentTypeLabel) ?></span>
                                        <svg class="search_type_arrow" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <div class="search_type_menu">
                                        <a href="#" class="search_type_option <?= $currentType == 'all' ? 'active' : '' ?>" data-type="all">
                                            везде
                                        </a>
                                        <a href="#" class="search_type_option <?= $currentType == 'products' ? 'active' : '' ?>" data-type="products">
                                            по товарам
                                        </a>
                                        <a href="#" class="search_type_option <?= $currentType == 'articles' ? 'active' : '' ?>" data-type="articles">
                                            по статьям
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.search_type_toggle').on('click', function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    $('.search_type_menu').toggleClass('open');
                                    $('.search_type_dropdown').toggleClass('open');
                                });
                                
                                $('.search_type_option').on('click', function(e) {
                                    e.preventDefault();
                                    
                                    var type = $(this).data('type');
                                    var label = $(this).text().trim();
                                    
                                    $('.search_type_input').val(type);
                                    
                                    $('.search_type_current').text(label);
                                    
                                    $('.search_type_option').removeClass('active');
                                    $(this).addClass('active');
                                    $('.search_type_check').text('');
                                    $(this).find('.search_type_check').text('✓');
                                    
                                    $('.search_type_menu').removeClass('open');
                                    $('.search_type_dropdown').removeClass('open');
                                });
                                
                                $(document).on('click', function(e) {
                                    if (!$(e.target).closest('.search_type_dropdown').length) {
                                        $('.search_type_menu').removeClass('open');
                                        $('.search_type_dropdown').removeClass('open');
                                    }
                                });
                            });
                            
                            $('.catalog_toolbar__form_search').on("submit", function (event) {
                                event.preventDefault();
                                let link = $(this).attr('action');
                                let text = $('.catalog_toolbar__form_search input[type=text]').val();
                                let type = $('.search_type_input').val();
                                
                                if(text != undefined && text != ''){
                                    text = text.replace(/[^a-zа-я\d\s\(\) -ёЁ]+/gi, "");
                                    
                                    let params = [];
                                    
                                    if (/(wi-?fi|wifi)/i.test(text)) {
                                        params.push('interfaces=wifi');
                                        text = text.replace(/wifi/ig, 'wi-fi');
                                    }
                                    
                                    if (/(vesa)/i.test(text)) {
                                        params.push('vesa=yes');
                                    }
                                    
                                    let url = link + "?search=" + encodeURIComponent(text);
                                    
                                    if (type && type != 'all') {
                                        url += "&type=" + type;
                                    }
                                    
                                    if (params.length > 0) {
                                        url += "&" + params.join('&');
                                    }
                                    
                                    window.location.href = url;
                                }
                            })
                        </script>
                    </div>

                    <div class="catalog_toolbar__item_group">
                        <a class="catalog_toolbar__item compare" href="/catalog/compare/">
                           <span class="fa-solid fa-align-right fa-rotate-90"></span>&nbsp;<span class="catalog_toolbar__item_text">Сравнение</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                        <a class="catalog_toolbar__item favorites" href="/catalog/favorites/">
                            <span class="fa-solid fa-heart"></span>&nbsp;<span class="catalog_toolbar__item_text">Избранное</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                        <a class="catalog_toolbar__item cart" href="/catalog/cart/">
                            <span class="fa-solid fa-cart-shopping"></span>&nbsp;<span class="catalog_toolbar__item_text">Корзина</span><span class="catalog_toolbar__item_number"></span>
                        </a>
                    </div>
                </div>
    </div>
    <div class="catalog_toolbar__dialog_wrapper"><div class="catalog_toolbar__dialog"><div class="title"></div><div class="question"></div><div class="buttons"><div class="button button_confirm"></div><div class="button button_cancel"></div></div></div></div>
    </div>
</div>