<?php
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_style("/abacus/components/catalog_cart/templates/default/style.css");


//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
$TITLE = "Избранное - Русавтоматика";
$H1 = "Избранное";

//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
CoreApplication::add_breadcrumbs_chain("Избранное");
$series["products"] = $arResult["ITEMS"];
?>
<div class="catalog_favorites">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?
                CoreApplication::include_component(array("component" => "breadcrumbs"));
                ?>
                <h1><?= $H1 ?></h1><br>

                <div class="component_catalog_section__panel_of_products">
                    <div class="view-mode-list">
                        <?
                        include __DIR__ . "/inc_template_list_of_products_list.php";
                        ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="catalog_favorites__button_clearall_wrapper">
                    <div class="catalog_favorites__button_clearall">Очистить список избранных товаров&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle-xmark fa-lg"></i></div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        window.addEventListener('storage', function(event) {
            if(event.key == 'favorites'){
                setTimeout(function () {
                            location.reload();
                },1);
            }
        });

        if($('div.series_products div').length == 0){
            $('.catalog_favorites__button_clearall').css('display','none');
        }

        $('.catalog_favorites__button_clearall').on('click', function () {
            setCookie('box2_favorites', "", {'max-age': -1});
            $('.component_catalog_section__panel_of_products .view-mode-list').html('<hr>Нет товаров...<hr>');
            $(this).css('display','none');
            $('.catalog_toolbar__item.favorites .number').html('');
            localStorage.setItem('favorites',Date.now());
            location.href = '/catalog/favorites/';
        });
        function setCookie(name, value, options = {}) {
            // Пример использования:
            //setCookie('user', 'John', {secure: true, 'max-age': 3600});
            let date = new Date;
            date.setDate(date.getDate() + 365);
            date = date.toUTCString();
            options = {
                path: '/',
                'expires': date,
                domain: '.' + window.location.host,
            };
            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }
            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }
            document.cookie = updatedCookie;
        }

    });
</script>


