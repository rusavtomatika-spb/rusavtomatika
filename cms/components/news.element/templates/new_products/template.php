<?
if (!defined('cms'))
    exit;
$properties = $arResult["element"]["properties"];
?><nav style="max-width:1080px;"><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/new-products/">Новые продукты</a>&nbsp;/&nbsp;<?= $arResult["element"]["name"] ?></nav>
<style>
    .news_element__date{
        background: #bce9bc;
        padding: 1px 5px;
        margin-right: 1px;
        font-size: 12px;
        line-height: 11px;

    }
</style>
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
                
                    <? if (isset($arResult["element"]["date"]) and $arResult["element"]["date"] != "" and $arResult["element"]["date"] != "0000-00-00"): ?>
                        <div>
                            <span class="news_element__date"><?
                                echo date("d.m.Y", strtotime($arResult["element"]["date"]));
                                ?>
                            </span>
                        </div>
                    <? endif; ?>
                    <? if (isset($arResult["element"]["code_video"]) and $arResult["element"]["code_video"] != ""): ?>
                        <div class="news_element_default_code_video">
                            <?= $arResult["element"]["code_video"] ?>
                        </div>
                    <? endif; ?>
                    <div class="news_element_default_text_detail">
                        <?= $arResult["element"]["text_detail"] ?>
                    </div>
                </article>
            </div>
            <div class="col-4">
                <?
                $vertical_slider_arguments = Array(
                    "db_table" => "new_products",
                    "template" => "new_products",
                    "SEF" => Array("element" => "/new-products/#element_code#/"),
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
        margin: 0px;display: block;
    }
    .news_element_default_code_video{margin: 10px 0px;padding: 20px;background: #eee;}
    .news_element_default_text_detail{}

</style>