<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
</head>

<?php
$current_folder_url = str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__);
CoreApplication::add_style( $current_folder_url . "/style.css");

global $TITLE;
global $DESCRIPTION;
global $KEYWORDS;
global $CANONICAL;

$TITLE = $arResult["title_cat"];
$DESCRIPTION = $arResult["description"];
$KEYWORDS = $arResult["keywords"];
$CANONICAL = "https://www.rusavtomatika.com/articles/".$arResult["sys_name"]."/";

global $extra_openGraph;
$extra_openGraph = Array(
    "openGraph_image" => "https://www.rusavtomatika.com".$arResult["img"],
    "openGraph_title" => $arResult["name"],
    "openGraph_siteName" => "Русавтоматика"
);

global $CURRENT_TEMPLATE;
if(isset($CURRENT_TEMPLATE) and $CURRENT_TEMPLATE == "rusavtomatika_bulma"){
    CoreApplication::add_breadcrumbs_chain("Статьи", "/articles/");
}
CoreApplication::add_breadcrumbs_chain($arResult["name"]);

$arResult["items"] = CoreApplication::get_rows_from_table( "`new_products`", "date,name,url_page_detail2,text_preview,picture_preview", "`onmainpage` = '1'", "date DESC", 15 );
$arResultPrall = CoreApplication::get_rows_from_table( "`products_all`", "model", "`status` != '0'" );
$models = array();

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

foreach ($arResultPrall as $k) {
    array_push($models, $k["model"]);
}

// $debug_product = CoreApplication::get_rows_from_table("`products_all`", "*", "`status` != '0'", "", 1);
// if(isset($debug_product[0])) {
//     echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;'>";
//     echo "<h3>Отладка - все поля товара:</h3>";
//     echo "<pre>";
//     print_r($debug_product[0]);
//     echo "</pre>";
//     echo "</div>";
// }

$count = count( $arResult[ "items" ] );
?>
<div id="vue_app_articles_detail">
    <div class="component_newslist_detail">
        <?php
            CoreApplication::include_component(array("component"=> "breadcrumbs"));
        ?>
        <div class="component_wrapper">
            <div class="row">
                <div class="row" style="display: flex;">
                    <div class="col-md-12" style="width: 100%;">
                        <div class="h1_wrapper"><h1><?=$arResult["name"]?></h1></div>
                        <div class="date"><?=$arResult["date"]?></div>
                    </div>
                    <?php if ( $count > 0 ): ?>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php
                            for ( $x = 0; $x < $count; $x++ ) {
                                if ( isset( $arResult[ "items" ][ $x ] ) ) {
                                    $item = $arResult[ "items" ][ $x ];
                                    $iturl = $item[ "url_page_detail2" ];
                                    $iturl = explode('/',$iturl);
                                    $model = $iturl[2];
                                    debug_to_console($model);
                                    if (in_array($model, $models )) {
                                        $d = new DateTime( $item[ "date" ] );
                                        $item[ "date" ] = $d->format( 'd.m.Y' );

                                        $item[ "stext" ] = $item[ "text_preview" ];
                                        $item[ "img" ] = $item[ "picture_preview" ];

                                        $text = strip_tags( $item[ "stext" ] );
                                        $text = substr( $text, 0, 150 );
                                        $text = rtrim( $text, "!,.-" );
                                        $text = substr( $text, 0, strrpos( $text, ' ' ) );
                                        $text = $text . "… ";
                            ?>
                            <div class="swiper-slide">
                                <a class="link__swiper-item" href="<?= $item["url_page_detail2"] ?>">
                                    <div class="card-image">
                                        <figure class="model_image" itemscope="" itemtype="https://schema.org/ImageObject">
                                            <img itemprop="contentUrl" src="<?= $item["img"]; ?>" alt="<?= $item["name"] ?>">
                                            <meta itemprop="caption" content="<?= $item["name"] ?>">
                                        </figure>
                                    </div>
                                    <div class="text-wrapper">
                                        <p class="model"><?= $item["name"]; ?></p>
                                        <span class="button_link">подробнее</span>
                                    </div>
                                </a>
                            </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
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

<script>
    const swiper = new Swiper('.swiper', {
        direction: 'vertical',
        loop: true,
        autoplay: true
    });
</script>

<style>
    .swiper {
        width: 300px;
        height: 300px;
        margin: 0;
    }
    .swiper-slide {
        width: 100%;
        height: 300px;
    }
    .link__swiper-item {
        width: 100% !important;
    }
    .swiper-slide .model_image{
        height: 150px;
        width: max-content;
        overflow: hidden;
    }
    .swiper-slide .card-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .swiper-slide .model_image{
        margin: 0.3rem auto 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .swiper-slide .text-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 15px;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
    }
    .text-wrapper .model {
        font-size: 15px;
        width: 100%;
    }
    .swiper-slide .button_link{
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #00ad61;
        color: #fff;
        border-radius: 6px 0px 6px 0px;
        padding: 6px 8px;
        font-size: 12px;
        font-weight: 500;
        opacity: 0.4;
    }
    .swiper-slide a:hover .button_link {
        opacity: 1;
        transition: 0.2s;
    }
</style>