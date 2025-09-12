<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style($current_folder_url . "/style.css");

global $TITLE;
global $DESCRIPTION;
global $KEYWORDS;


$TITLE = $arResult["title_cat"];
$DESCRIPTION = $arResult["description"];
$KEYWORDS = $arResult["keywords"];

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "https://www.rusavtomatika.com".$arResult["img"],
    "openGraph_title" => $arResult["name"],
    "openGraph_siteName" => "Русавтоматика"
);




global $CURRENT_TEMPLATE;
if(isset($CURRENT_TEMPLATE) and $CURRENT_TEMPLATE == "rusavtomatika_bulma"){
    CoreApplication::add_breadcrumbs_chain("Новости", "/news".EX."/");
}else{
    CoreApplication::add_breadcrumbs_chain("Новости", "/news/");
}

CoreApplication::add_breadcrumbs_chain($arResult["name"]);
?>
<div id="vue_app_articles_detail">
    <div class="component_newslist_detail">
        <?
        CoreApplication::include_component(array("component"=> "breadcrumbs"));
        ?>
        <div class="component_wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="h1_wrapper">

                        <h1><?= $arResult["name"] ?></h1>
                    </div>
                    <div class="date"><?= $arResult["date"] ?></div>

                </div>
                <div class="col-md-12">
                    <div class="detail_text">
                        <? if ($arResult["img"] != "" and $arResult["show_picture_preview_in_detail"] == "1"): ?>
                            <img itemprop="image" alt="<?= $arResult["alt"] ?>" class="news-img-big"
                                 src="<?= $arResult["img"] ?>">
                        <? endif; ?>
                        <?= $arResult["btext"] ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div>
            <a class="button_window_history_back" onclick="window.history.back();return false;"
               href="/<?= $arguments["root_folder_url"] ?>/">Возврат к списку новостей</a>
        </div>
    </div>
</div>
