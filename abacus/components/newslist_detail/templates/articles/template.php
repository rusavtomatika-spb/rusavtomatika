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

    $showRecommended = false;
    $recommendedItems = [];

    if (!empty($arResult["query_for_karusel_tovarov"])) {
        $recommendedItems = CoreApplication::get_rows_from_table( 
            "products_all", 
            "`index`, model, page_path", 
            "status != '0'", 
            "`index` DESC", 
            5 
        );
        
        if (!empty($recommendedItems)) {
            $showRecommended = true;
        }
    }

    $count = $showRecommended ? count($recommendedItems) : 0;
    ?>
    <div id="vue_app_articles_detail">
        <div class="articles-page-wrapper">
            <div class="component_newslist_detail">
                <?php
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
            <?php if ($showRecommended && $count > 0): ?>
                <div class="recommended__items-wrapper">
                    <?php foreach ($recommendedItems as $item): ?>
                        <?php
                        $pagePath = $item["page_path"] ? $item["page_path"] : '';
                        $model = $item["model"] ? $item["model"]  : '';
                        $itemUrl = '/' . trim($pagePath, '/') . '/' . $model . '/';
                        ?>
                        <a class="link__swiper-item" href="<?= $itemUrl ?>" target="_blank">
                            <div class="text-wrapper">
                                <p class="model"><?= $model; ?></p>
                                <span class="button_link">подробнее</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .articles-page-wrapper {
            display: flex;
            align-items: flex-start;
            width: 100%;
        }

        .recommended__items-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            width: 400px;
            margin: 0;
        }

        .recommended__items-wrapper .link__swiper-item {
            width: 100%;
        }
        .recommended__items-wrapper .model_image{
            height: 150px;
            width: max-content;
            overflow: hidden;
        }
        .recommended__items-wrapper .card-image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .recommended__items-wrapper .model_image{
            margin: 0.3rem auto 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .recommended__items-wrapper .text-wrapper {
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
        .recommended__items-wrapper .button_link{
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
            transition: .5s;
        }
        .recommended__items-wrapper a:hover .button_link {
            opacity: 1;
            transition: 0.2s;
        }
    </style>