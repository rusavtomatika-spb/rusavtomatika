<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style( $current_folder_url . "/style.css?" . rand());

global $TITLE;
global $DESCRIPTION;
global $KEYWORDS;


$TITLE = $arResult["title_cat"];
$DESCRIPTION = $arResult["description"];
$KEYWORDS = $arResult["keywords"];

CoreApplication::add_breadcrumbs_chain("Статьи", "/blog/");
CoreApplication::add_breadcrumbs_chain($arResult["name"]);
?>
<div id="vue_app_blog_detail">
    <div class="component_newslist_detail">
        <?
        CoreApplication::include_component(array("component"=> "breadcrumbs"));
        ?>
        <div class="component_wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="h1_wrapper"><h1><?=$arResult["name"]?></h1></div>
                    <div class="date"><?=$arResult["date"]?></div>
                </div>
                <div class="col-md-12">
                    <div class="detail_text">
                        <?=($arResult["btext"])?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div>
            <a class="button_window_history_back" onclick="window.history.back();return false;" href="/<?=$arguments["root_folder_url"]?>/">Возврат к списку новостей</a>
        </div>
    </div>
</div>
