<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/catalog_viewed_bar_style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
if (isset($arguments["viewed_products"]) and count($arguments["viewed_products"]) > 0):
    ?>
    <div class="catalog_viewed_bar_wrapper">
        <div class="catalog_viewed_bar">
            <div class="container is-widescreen">
                <h2 class="is-size-3 has-text-weight-medium bright_text mb-0">
                    <a class="bright_text" href="/catalog/viewed/">Вы смотрели</a>
                </h2>
                <div class="viewed_products_wrapper">
                    <div class="viewed_products">
                        <div id="responsive_wrapper">
                            <div id="viewed_products_slider">
                                <?
                                $types = CoreApplication::get_rows_from_table("`catalog_types`", "code,short_name", "`active` = '1'", "position");
                                foreach ($types as $item) {
                                    $arr_types[$item["code"]] = $item["short_name"];
                                }
                                foreach ($arguments["viewed_products"] as $model) {
                                    $url_for_link = str_replace("www.rusavtomatika.com", $_SERVER["HTTP_HOST"], $model["link_detail_page"]);
									
                                    if (!(isset($model["type"]) and $model["type"] != "")) continue;
                                    if (!(isset($model["link_detail_page"]) and $model["link_detail_page"] != "")) continue;
                                    if (!(isset($arr_types[$model["type"]]) and $arr_types[$model["type"]] != "")) continue;

//                                    $pic = '/images/' . strtolower($model["brand"]) . '/' . strtolower($model["type"]) . '/' . $model["model"] . '/130/' . $model["model"] . '_1.webp';
									$fname = str_replace(array(')', '(', '/',' '),  array('\)', '\(', '_', '_'), $model["model"]);
//									$mod_name = explode("/",$model["link_detail_page"]);
//									$mod_name = array_slice($mod_name,2);
//									array_pop($mod_name);
//									$mod_name = str_replace(array(')', '(', '/',' '),  array('\)', '\(', '_', '_'), implode("/",$mod_name));
//                                    $url_for_link = '//'.$_SERVER["HTTP_HOST"].'/'.strtolower($model["brand"]).'/'.$mod_name.'/';
                                    $pic = '/images/' . strtolower($model["brand"]) . '/' . strtolower($model["type"]) . '/' . $fname . '/130/' . $fname . '_1.webp';
                                    $name = $arr_types[$model["type"]] . " " . $model["model"];
                                    $pos = strpos($arr_types[$model["type"]], "#model_fullname#");
                                    if ($pos !== false) {
                                        if (isset($model["model_fullname"]) and $model["model_fullname"] != "") {
                                            $name = $model["model_fullname"];
                                        }
                                    }
                                    ?>
                                    <div class="item">
                                        <a href="<?= $url_for_link ?>">
                                <span class="picture"
                                      style="background-image: url(<?= $pic ?>)"></span>
                                            <span class="text"><? echo substr($name, 0, 80); ?></span>
                                        </a><br>
                                    </div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
<?php
endif;
