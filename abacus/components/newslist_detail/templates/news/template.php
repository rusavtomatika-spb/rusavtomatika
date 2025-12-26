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
$CANONICAL = "https://www.rusavtomatika.com/news/".$arResult["sys_name"]."/";

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

$showRecommended = false;
$recommendedItems = [];

$typeDictionary = [
    'hmi' => 'Панель оператора',
    'cloud_hmi' => 'Облачный интерфейс',
    'web-panel' => 'Web-панель',
    'plc' => 'ПЛК',
    'coupler' => 'Коммуникационный модуль'
];

function getHumanReadableType($type, $dictionary) {
    $type = strtolower(trim($type));
    return isset($dictionary[$type]) ? $dictionary[$type] : $type;
}

function formatBrandName($brand) {
    $brand = trim($brand);
    
    $specialCases = [
        'weintek' => 'Weintek',
        'ifc' => 'IFC',
    ];
    
    $lowerBrand = strtolower($brand);
    if (isset($specialCases[$lowerBrand])) {
        return $specialCases[$lowerBrand];
    }
    
    return ucfirst(strtolower($brand));
}

$keywordProducts = [];

if (!empty($KEYWORDS)) {
    $keywordElements = explode(' ', trim($KEYWORDS));
    
    foreach ($keywordElements as $keywordElement) {
        $keywordElement = trim($keywordElement);
        if (empty($keywordElement)) continue;
        
        $productParts = explode(',', $keywordElement);
        if (count($productParts) >= 3) {
            $productType = trim($productParts[0]);
            $productBrand = trim($productParts[1]);
            $productModel = trim($productParts[2]);
            
            $formattedBrand = formatBrandName($productBrand);
            
            $humanReadableType = getHumanReadableType($productType, $typeDictionary);
            
            $productUrl = '/' . strtolower($productBrand) . '/' . $productModel . '/';
            $productImage = "/images/" . strtolower($productBrand) . "/" . $productType . "/" . $productModel . "/130/" . $productModel . "_1.webp";
            
            $keywordProducts[] = [
                'type' => $productType,
                'type_human' => $humanReadableType,
                'brand' => $productBrand,
                'brand_formatted' => $formattedBrand,
                'model' => $productModel,
                'url' => $productUrl,
                'image' => $productImage,
                'title' => $productModel . ' - ' . $humanReadableType . ' ' . $formattedBrand
            ];
        }
    }
}

if (!empty($arResult["query_for_karusel_tovarov"])) {
    $custom_query = $arResult["query_for_karusel_tovarov"];
    
    $recommendedItems = array();
    
    if (isset($GLOBALS['db']) && is_object($GLOBALS['db'])) {
        echo "<script>console.log('Trying db connection');</script>";
        $result = $GLOBALS['db']->query($custom_query);
        if ($result && method_exists($result, 'fetch_assoc')) {
            while ($row = $result->fetch_assoc()) {
                $recommendedItems[] = $row;
            }
        } else {
            echo "<script>console.log('db query failed or no results');</script>";
        }
    } else {
        echo "<script>console.log('db not available');</script>";
    }
    
    if (empty($recommendedItems) && isset($GLOBALS['mysqli_db']) && is_object($GLOBALS['mysqli_db'])) {
        $result = $GLOBALS['mysqli_db']->query($custom_query);
        if ($result && method_exists($result, 'fetch_assoc')) {
            while ($row = $result->fetch_assoc()) {
                $recommendedItems[] = $row;
            }
            echo "<script>console.log('mysqli_db result count: " . count($recommendedItems) . "');</script>";
        }
    }
    
    if (empty($recommendedItems) && isset($GLOBALS['mysql_db']) && is_object($GLOBALS['mysql_db'])) {
        $result = $GLOBALS['mysql_db']->query($custom_query);
        if ($result && method_exists($result, 'fetch_assoc')) {
            while ($row = $result->fetch_assoc()) {
                $recommendedItems[] = $row;
            }
            echo "<script>console.log('mysql_db result count: " . count($recommendedItems) . "');</script>";
        }
    }
    
    if (empty($recommendedItems) && class_exists('DBWORK')) {
        $db_work = new DBWORK();
        if (method_exists($db_work, 'query')) {
            $result = $db_work->query($custom_query);
            if ($result) {
                $recommendedItems = $result;
                echo "<script>console.log('DBWORK result count: " . count($recommendedItems) . "');</script>";
            }
        }
    }
    
    
    if (!empty($recommendedItems)) {
        $showRecommended = true;
    } else {
        echo "<script>console.log('Show recommended: NO');</script>";
    }
} else {
    echo "<script>console.log('No query_for_karusel_tovarov found');</script>";
}

function getProductImage($product) {
    $brand = isset($product['brand']) ? strtolower($product['brand']) : '';
    $type = isset($product['type']) ? strtolower($product['type']) : '';
    $model = isset($product['model']) ? $product['model'] : '';
    
    $image_path = "/images/{$brand}/{$type}/{$model}/580/{$model}_1.webp";
    return $image_path;
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
            <a class="button_window_history_back" onclick="window.history.back();return false;" href="/<?= $arguments["root_folder_url"] ?>/">Возврат к списку новостей</a>
            <?php if (!empty($keywordProducts)): ?>
                <div class="links-wrapper">
                    <?php foreach ($keywordProducts as $product): ?>
                        <div class="product__link">
                            <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['model']) ?>" />
                            <div>
                                <h3><?= htmlspecialchars($product['model']) ?> - <?= htmlspecialchars($product['type_human']) ?> <?= htmlspecialchars($product['brand_formatted']) ?></h3>
                                <a class="button_window_history_back" href="<?= htmlspecialchars($product['url']) ?>">посмотреть и заказать</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        </div>
        <?php if ($showRecommended && $count > 0): ?>
            <div class="recommended__items-wrapper">
                <h2 class="recommended__title">Подходящие товары</h2>
                <div class="recommended__items-row">
                    <?php foreach ($recommendedItems as $item): ?>
                        <?php
                        $pagePath = isset($item["page_path"]) ? $item["page_path"] : '';
                        $model_name = isset($item["model"]) ? $item["model"] : '';
                        $brand_name = isset($item["brand"]) ? $item["brand"] : '';
                        $short_name = isset($item["short_name"]) ? $item["short_name"] : '';
                        $itemUrl = '/' . trim($pagePath, '/') . '/' . $model_name . '/';
                        
                        $itemImg = getProductImage($item);
                        ?>
                        <a class="card link__swiper-item" href="<?= $itemUrl ?>">
                            <div class="card-image">
                                <figure class="model_image" itemscope="" itemtype="https://schema.org/ImageObject">
                                    <img itemprop="contentUrl" src="<?= $itemImg; ?>" alt="<?= $model_name ?>" style="max-height: 150px; object-fit: contain;" onerror="this.src='/images/no-image.jpg'">
                                    <meta itemprop="caption" content="<?= $model_name ?>">
                                </figure>
                            </div>
                            <div class="text-wrapper">
                                <?php if ($short_name): ?>
                                    <p class="model" style="margin"><?= $short_name; ?></p>
                                <?php endif; ?>
                                <p class="brand"><?= $brand_name; ?></p>
                                <p class="model" style="margin-bottom: 20px;"><?= $model_name; ?></p>
                                <span class="button_link">подробнее</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .articles-page-wrapper {
        display: flex;
        align-items: flex-start;
        width: 100%;
        gap: 30px;
    }

    .recommended__items-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        margin: 0;
        gap: 20px;
    }
    .recommended__items-wrapper .recommended__title {
        margin: 0;
        margin-bottom: 10px;
        margin-top: 50px;
    }
    .recommended__items-row {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        flex-wrap: wrap;
        gap: 20px;
    }

    .recommended__items-wrapper .link__swiper-item {
        width: 100%;
        max-width: 300px;
    }
    .recommended__items-wrapper .model_image{
        padding: 10px 10px 0;
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
        padding: 0 15px 15px;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
    }
    .recommended__items-wrapper a {
        text-decoration: none !important;
        border-bottom: none !important;
    }
    .text-wrapper .model {
        font-size: 15px;
        width: 100%;
        margin: 0;
        margin-bottom: 10px;
    }
    .text-wrapper .brand {
        font-size: 0.875rem;
        color: #888888;
        margin: 0;
        margin-bottom: 10px;
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

    .links-wrapper {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        width: 100%;
        gap: 10px;
        margin-top: 50px;
    }
    .product__link {
        display: flex;
        align-items: center;
        display: flex;
        padding: 20px;
        min-height: 120px;
        background-color: #fff;
        border-radius: .25rem;
        box-shadow: 0 .2em 0.7em -.125em rgba(10, 10, 10, .2), 0 0 0 1px rgba(10, 10, 10, .02);
        width: 380px;
        gap: 10px;
    }
    .product__link img {
        width: 120px;
        height: auto;
        object-fit: cover;
    }
    .product__link h3 {
        font-size: 14px !important;
        font-weight: 400;
        text-align: left !important;
    }
</style>