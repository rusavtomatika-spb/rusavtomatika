<?php
global $arSettings;
$arSettings['path_to_product_images'] = '/images/';
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_style("/core/components/catalog_section/templates/default/style.css");


//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
global $arResult;
global $TITLE;
global $H1;
global $DESCRIPTION;
$TITLE = "Просмотренные товары";
$H1 = "Просмотренные товары";

//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
CoreApplication::add_breadcrumbs_chain("Просмотренные товары");
$series["products"] = $arResult["ITEMS"];
var_dump_pre();
?>
<div class="catalog_viewed">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?
                CoreApplication::include_component(array("component" => "breadcrumbs"));
                ?>
                <h1><?= $H1 ?></h1>


                <?
                if (count($series["products"]) > 9):
                    ?>
                    <div class="catalog_viewed__button_clearall_wrapper">
                        <div class="catalog_viewed__button_clearall">Очистить список просмотренных товаров</div>
                    </div>
                <?
                endif;
                ?>
                <div class="component_catalog_section__panel_of_products">
                    <div class="view-mode-list">
                        <?
                        include __DIR__ . "/inc_template_list_of_products_list.php";
                        ?>
                    </div>
                </div>
            </div>
            <?
            if (count($series["products"]) > 0):
            ?>
            <div class="col-lg-12">
                <div class="catalog_viewed__button_clearall_wrapper">
                    <div class="catalog_viewed__button_clearall">Очистить список просмотренных товаров</div>
                </div>
            </div>
            <?
            endif;
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.addEventListener('storage', function (event) {
            if (event.key == 'compare' || event.key == 'favorites') {
                setTimeout(function () {
                    location.reload();
                }, 1);
            }
        });
        if ($('table.series_products tr').length == 0) {
            $('.catalog_viewed__button_clearall').css('display', 'none');
        }

        $('.catalog_viewed__button_clearall').on('click', function () {
            setCookie('box2_viewed', "", {'max-age': -1});
            $('.component_catalog_section__panel_of_products .view-mode-list').html('<hr>Нет товаров...<hr>');
            $('.catalog_viewed__button_clearall').css('display', 'none');
            $('.catalog_toolbar__item.viewed .number').html('');
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


