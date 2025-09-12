<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style($current_folder_url . "/style.css");
//CoreApplication::add_script($current_folder_url . "/script.js");

$extra_openGraph = array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/new-products.png",
    "openGraph_title" => "Новая продукция и технологии Weintek, IFC, Samkoon, eWON от официального дистрибьютора",
    "openGraph_siteName" => "Русавтоматика"
);
global $TITLE, $H1, $DESCRIPTION, $KEYWORDS, $CANONICAL, $extra_openGraph;
global $current_component;
$TITLE = 'Новая продукция и технологии Weintek, IFC, Samkoon, eWON от официального дистрибьютора';
$H1 = 'Новая продукция и технологии Weintek, IFC, Samkoon, eWON';
$DESCRIPTION = 'Самые новые модели Weintek, IFC, Samkoon в Русавтоматике. Фото, описание, характеристики.';
$KEYWORDS = 'Weintek, Samkoon, IFC, Aplex, eWON,  операторские панели, новинки, автоматизация производства';
$CANONICAL = "https://www.rusavtomatika.com/new-products/";



CoreApplication::add_breadcrumbs_chain("Новая продукция");
CoreApplication::include_component(array("component" => "breadcrumbs"));
//var_dump_pre($arguments);
if ($arguments["table"] != '') {
    $arr_elements = CoreApplication::get_rows_from_table($arguments["table"], "*", " `active` != '0'", " `date` DESC ");
}
?>
<div>
    <div class="component_new_products">
        <article>
            <div class="component_wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $H1 ?></h1>
                        <?
                        foreach ($arr_elements as $element) {
                            // var_dump_pre($element);
                            ?>
                            <div class="col-md-12 ">
                                <a href="<?= $element["url_page_detail2"] ?>" style="text-decoration: none">
                                    <div class="new_products__item box has-background-light is-shadowless">
                                        <div class="new_products_item__preview_image_wrapper">
                                            <div class="new_products_item__preview_image"
                                                 style="background-image: url('<?= $element["picture_preview"] ?>');"></div>
                                        </div>
                                        <div class="new_products_item__text_wrapper">
                                            <div class="new_products_item__title">
                                                <span class="name"><?= $element["name"] ?></span>
                                                <span class="date"><?= date('d.m.Y', strtotime($element["date"])); ?></span>
                                            </div>
                                            <div></div>
                                            <div class="new_products_item__text">
                                                <span>
                                                    <?= $element["text_preview"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>



