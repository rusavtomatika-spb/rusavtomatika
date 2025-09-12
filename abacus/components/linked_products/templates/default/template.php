<?php


require_once "inc_functions_linked_products.php";


CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
//
C_LinkedProducts::set_model($arguments["model"]);


$arr_linked_products = C_LinkedProducts::getLinkedModels();

if(count($arr_linked_products) > 0):
?>
<div class="linked_products_wrapper">
    <div class="linked_products">

        <div id="responsive_wrapper">
            <h2>С этим товаром часто покупают:</h2>
            <div id="linked_products_slider">
                <?
                foreach ($arr_linked_products as $model) {
                    //var_dump_pre($model["product_identifier"]);

                    $url_for_link = str_replace("www.rusavtomatika.com", $_SERVER["HTTP_HOST"], $model["url"]);
                    if (!(isset($model["url"]) and $model["url"] != "")) continue;
				?>
                    <div class="item">
                            <a href="<?= $url_for_link ?>">
                                <span class="picture"
                                      style="background-image: url('<?=C_LinkedProducts::getPicture($model["product_identifier"]); ?>')">

                                </span>
                                <span class="text"><? echo mb_substr($model["title"], 0, 80);  ?></span>
                            </a>

                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php

endif;



