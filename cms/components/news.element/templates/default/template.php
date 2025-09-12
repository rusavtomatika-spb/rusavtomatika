<?
if (!defined('cms'))
    exit;

$properties = array();
if (isset($arResult["element"]["properties"])){
    $properties = $arResult["element"]["properties"];
}
global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files{$arResult ["element"]["picture_preview"]}",
    "openGraph_title" => $arResult ["element"]["name"],
    "openGraph_siteName" => "Русавтоматика"
);

global $EXTENTIONPARAM;
$EXTENTIONPARAM = get_extra_openGraph();


?><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/video/">Видео</a>&nbsp;/&nbsp;<?= $arResult["element"]["name"] ?></nav>

<div class="news_element_default">
    <div class="blockofcols_container news_element">
        <div class="blockofcols_row">
            <div class="col-8">
                <article>
                <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
                    <h1><?= $arResult["element"]["h1"] ?></h1>
                <? else: ?>
                    <h1><?= $arResult["element"]["name"] ?></h1>
                <? endif; ?>
                    
                <? if (isset($arResult["element"]["date"]) and $arResult["element"]["date"] != ""): ?>
                    <p><?
                        echo date("d.m.Y", strtotime($arResult["element"]["date"]));
                        ?></p>
                <? endif; ?>
                <div class="news_element_default_code_video">
                    <?= $arResult["element"]["code_video"] ?>
                </div>
                <div class="news_element_default_text_detail">
                    <?= $arResult["element"]["text_detail"] ?>
                </div>
                    </article>
            </div>
            <div class="col-4">

                <?

                $vertical_slider_arguments = Array(
                    "db_table" => "videos",
                    "template" => "default",
                    "SEF" => $arguments["SEF"]["element"]
                );
                $APPLICATION->IncludeComponent("vertical_slider", "default", $vertical_slider_arguments);
                ?>
            </div>
        </div>
    </div>
</div>


<style>
    .news_element_default ul{
        margin: 0 10px;
    }
    .news_element_default ul li{
        margin: 5px 10px;
    }
    .news_element_default iframe{
        margin: 0px auto;display: block;
    }
    .news_element_default_code_video{margin: 10px 0px;padding: 20px;background: #eee;}
    .news_element_default_text_detail{padding: 20px;}

</style>