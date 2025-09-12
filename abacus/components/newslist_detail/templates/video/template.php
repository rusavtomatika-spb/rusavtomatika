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

global $TITLE, $DESCRIPTION, $KEYWORDS, $EXTENTIONPARAM, $CANONICAL;

if($arResult["element"]["title"] != ''){
    $TITLE = $arResult["element"]["title"];
}{
    $TITLE = 'Видео: '.$arResult["element"]["name"];
}

$DESCRIPTION = strip_tags($arResult["element"]["text_preview"]);
$CANONICAL = "https://www.rusavtomatika.com/video/".$arResult["element"]["code"]."/";
$EXTENTIONPARAM = get_extra_openGraph();

CoreApplication::add_breadcrumbs_chain("Видео", "/video/");
CoreApplication::add_breadcrumbs_chain($arResult["element"]["name"]);
CoreApplication::include_component(array("component" => "breadcrumbs"));


?>

<div class="news_element_default">
    <div class="columns news_element">
            <div class="column is-8">
                <article>
                    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
                        <h1 class="title"><?= $arResult["element"]["h1"] ?></h1>
                    <? else: ?>
                        <h1 class="title"><?= $arResult["element"]["name"] ?></h1>
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
            <div class="column is-4">
                <?
                $vertical_slider_arguments = Array(
                    "component" => "vertical_slider",
                    "db_table" => "videos",
                    "template" => "default",
                    "SEF" => "/video/#element_code#/"
                );
                CoreApplication::include_component($vertical_slider_arguments);

                /*
                                $APPLICATION->IncludeComponent("vertical_slider", "default", $vertical_slider_arguments);*/
                ?>
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
    .news_element_default_code_video{padding: 10px 0px;}
    .news_element_default_text_detail{padding: 0px;}

</style>