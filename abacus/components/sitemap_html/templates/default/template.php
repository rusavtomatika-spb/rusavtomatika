<?php
global $TITLE;
$TITLE = "Карта сайта - Русавтоматика";
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");
include "inc_sitemap_data.php";
?>
<div class="component_site_map">
    <h1>Карта сайта</h1>
    <div class="columns is-multiline">
        <?
        foreach ($ar_main_static_links as $ar_block) {
            ?>
            <div class="column">
                <h2><?= $ar_block["title"] ?></h2>
                <ul>
                    <?
                    foreach ($ar_block["items"] as $link) {
                        ?>
                        <li><a href="<?= $link["link"] ?>"><?= $link["anchor"] ?></a></li>
                        <?
                    }
                    ?>
                </ul>
            </div>
            <?
        }
        ?>
    </div>


    <?
    foreach ($ar_dynamic_links as $ar_dynamic_link) {
        ?>
        <h2><a href="<?= $ar_dynamic_link["link"] ?>"><?= $ar_dynamic_link["anchor"] ?></a></h2>
        <div class="folded_block folded">
            <div class="folded_block_content">
                <div class="columns">
                    <div class="column">
                        <ul>
                            <?
                            $num_news = count($ar_dynamic_link["items"]);
                            $news_divider = intval($num_news / 2) + 3;
                            $counter = 0;
                            foreach ($ar_dynamic_link["items"] as $link) {
                                $counter++;
                                ?>
                                <li><a href="<?= $link["link"] ?>"><?= $link["anchor"] ?></a></li>
                                <?
                                if ($counter == $news_divider) {
                                    echo '</ul></div><div class="column"><ul>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="folded_block_content_shadow"></div>
            </div>
            <div class="folded_block__button_unfold button is-fullwidth is-outlined">Развернуть</div>
            <div class="folded_block__button_fold button is-fullwidth is-outlined">Свернуть</div>
        </div>

        <?
    }
    /////////////////////////////////////////////
    ?>


    <h2><a href="<?= $ar_catalog_links["link"] ?>"><?= $ar_catalog_links["anchor"] ?></a></h2>
    <div class="folded_block folded_block_catalog folded">
        <div class="folded_block_content">
            <?
            foreach ($ar_catalog_links["items"] as $ar_catalog_section) {
                ?>
                <div>
                    <h4><a href="<?= $ar_catalog_section["link"] ?>"><?= $ar_catalog_section["anchor"] ?></a></h4>
                    <?
                    foreach ($ar_catalog_section["series"] as $series) {
                        ?>
                        <p>
                            <? if($series['brand'] != '' or $series['series_name'] != ''){?>
                            <b><?= $series['brand'] ?> серия <?= $series['series_name'] ?> :</b>  &nbsp;
                            <?}?>
                            <?
                            foreach ($series['items'] as $item) {
                                $brand = strtolower($item['brand']);
                                if(isset($item['section']) and $item['section'] == 'accessories'){
                                    $brand = 'accessories';
                                }
                                if($brand == "faraday"){
                                    $model = $item["s_name"];
                                }else{
                                    $model = $item["model"];
                                }
                                ?> <a href="/<?= $brand.EX."/".$model ?>/"><?= $item['model'] ?></a><?
                                if($item != end($series['items'])) {
                                    echo ", &nbsp; ";
                                }else echo " &nbsp; ";
                            }
                            ?>
                        </p>
                        <!--                        <a href="<?/*= $link["link"] */ ?>"><?/*= $product["anchor"] */ ?></a>-->
                        <?
                    }
                    ?>
                </div>
                <?
            }
            ?>
            <div class="folded_block_content_shadow"></div>
        </div>
        <div class="folded_block__button_unfold button is-fullwidth is-outlined">Развернуть</div>
        <div class="folded_block__button_fold button is-fullwidth is-outlined">Свернуть</div>
    </div>


</div>
