<?php
global $arResult;

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/abacus/components/newslist_detail/templates/discounted/style.css')) {
    echo '<link rel="stylesheet" href="/abacus/components/newslist_detail/templates/discounted/style.css">' . "\n";
}

echo '
<style>
.component_catalog_detail__images-mini {
  background: none !important;
}
.component_catalog_detail__image-main_link {
  background: none !important;
}
</style>
';

if (!isset($arResult['product']) || empty($arResult['product'])) {
    global $mysqli_db, $arguments;
    $item_id = isset($arguments['id']) ? intval($arguments['id']) : 0;
    
    if ($item_id > 0) {
        $query = "SELECT * FROM `discounted` WHERE `id` = $item_id AND `show` = 1 LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        $product = mysqli_fetch_assoc($result);
        if ($product) {
            $arResult['product'] = $product;
        }
    }
}

if (!isset($arResult['product']) || empty($arResult['product'])) {
    echo "<h1>404 - Товар не найден</h1>";
    echo "<a href='/discounted/'>Вернуться к списку</a>";
    return;
}

$product = $arResult['product'];

$main_image = !empty($product['preview_picture']) ? $product['preview_picture'] : '/images/no-image.png';

$product['arr_pics'] = array();
if (!empty($product['preview_picture'])) {
    $product['arr_pics'][] = $product['preview_picture'];
}
if (!empty($product['images'])) {
    $additional = explode(',', $product['images']);
    foreach ($additional as $img) {
        if (!empty($img)) {
            $product['arr_pics'][] = trim($img);
        }
    }
}

global $H1;
$H1 = $product['name'];
?>
<div id="vue_component_catalog_detail" data-model="<?= $product['model'] ?>">
<div class="component_catalog_detail" itemscope itemtype="https://schema.org/Product">
<meta itemprop="model" content="<?= $product['model'] ?>">
<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<meta itemprop="price" content="<?= $product['price'] ?>">
<meta itemprop="priceCurrency" content="RUB">
<link itemprop="availability" href="http://schema.org/InStock">
<span itemprop="seller" itemscope itemtype="https://schema.org/Organization">
<meta itemprop="name" content="ООО Русавтоматика">
<link itemprop="url" href="https://www.rusavtomatika.com/">
<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
<meta itemprop="addressLocality" content="Санкт-Петербург">
<meta itemprop="postalCode" content="199178">
<meta itemprop="streetAddress" content="Малый пр. В.О. 57 корп. 3">
</span>
<meta itemprop="telephone" content="+7 812 648-03-47">
<meta itemprop="email" content="sales@rusavtomatika.com">
</span> </span>
<span itemprop="brand" itemscope itemtype="https://schema.org/Brand">
<meta itemprop="name" content="<?= $product['brand'] ?>">
</span>

<div class="component_wrapper">
<? CoreApplication::include_component(array("component" => "breadcrumbs")); ?>

<section id="start" class="active">
  <div class="sticky_block_wrapper">
    <div class="sticky_block">
      <div class="sticky_block_wrap_inn">
        <div class="container is-widescreen">
          <div class="sticky_block_inner_wrapper">
            <div class="left">
              <h1 itemprop="name"><?= $H1 ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="columns">
    <div class="column is-6">
      <div class="component_catalog_detail__images_wrapper">
        <? if (count($product['arr_pics']) > 0): ?>
          <? foreach ($product['arr_pics'] as $idx => $image_url): ?>
            <a class="component_catalog_detail__image-main_link" 
              id="component_catalog_detail__image-main_link_<?= ($idx+1) ?>" 
              style="display: <?= $idx == 0 ? 'block' : 'none' ?>;" 
              data-fancybox="product" 
              data-caption="<?= $product['brand'] . ' ' . $product['model'] ?>" 
              href="<?= $image_url ?>">
                <img class="img_product-inner" src="<?= $image_url ?>" alt="<?= $product['model'] . '_' . ($idx+1) ?>">
            </a>
          <? endforeach; ?>
          <div class="component_catalog_detail__images-mini__wrapper num_pics_<?= count($product['arr_pics']) ?>">
            <div class="component_catalog_detail__images-mini__inner">
              <? foreach ($product['arr_pics'] as $idx => $image_url): ?>
                <div data-rel="component_catalog_detail__image-main_link_<?= ($idx+1) ?>" 
                  class="component_catalog_detail__images-mini <?= $idx == 0 ? 'active' : '' ?>"
                >
                  <img src="<?= $image_url ?>" alt="<?= $product['model'] . '_' . ($idx+1) ?>">
                </div>
              <? endforeach; ?>
            </div>
          </div>
        <? else: ?>
          <div style="padding: 50px; text-align: center; background: #f5f5f5;">Нет изображения</div>
        <? endif; ?>
      </div>
    </div>
    
    <div class="column is-6">
      <div class="component_catalog_detail__info_block">
        <div class="component_catalog_detail__info1">
          <div class="item">
            <span class="info_tag info_brand"><?= $product['brand'] ?></span>
          </div>
          <div class="item">
            <? if ($product['quantity'] > 0): ?>
              <span class="info_tag info_available">в наличии</span>
            <? else: ?>
              <span class="info_tag info_not_available">под заказ</span>
            <? endif; ?>
          </div>
        </div>
        
        <div class="component_catalog_detail__price">
          <div class="item price">
            <div>
              <span class="price_usd_value"><?= number_format($product['price'], 0, '', ' ') ?></span>
              <span class="price_usd_currency">₽</span>
            </div>
          </div>
        </div>
      </div>
      
      <div class="component_catalog_detail__buttons1">
        <div class="button is-primary add_to_cart" data-model="<?= $product['model'] ?>" data-box="cart">
          <span class="btn_icon_order"></span>
          <span class="btn_icon_order_text">В заказ</span>
        </div>
      </div>
      
      <div class="component_catalog_detail__advantages">
        <? if (!empty($product['text'])): ?>
          <?= nl2br(htmlspecialchars($product['text'])) ?>
        <? endif; ?>
      </div>
    </div>
  </div>
</section>

<? if (!empty($product['text'])): ?>
<section id="text">
  <h2>Информация о продукте</h2>
  <?= nl2br(htmlspecialchars($product['text'])) ?>
</section>
<? endif; ?>

</div>
</div>
</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
$(function() {
  $(".component_catalog_detail__images-mini").bind("click", function() {
    var data_rel = $(this).attr("data-rel");
    $(".component_catalog_detail__images-mini").removeClass("active");
    $(this).addClass("active");
    $(".component_catalog_detail__image-main_link").hide();
    $("#" + data_rel).show();
  });
  if ($(".component_catalog_detail__images-mini__inner .component_catalog_detail__images-mini").length > 0) {
    $(".component_catalog_detail__images-mini__inner .component_catalog_detail__images-mini:first").click();
  }
});

function show_backup_call(type, text) {
  if (typeof window.show_backup_call === 'function') {
    window.show_backup_call(type, text);
  }
}
</script>
<?
CoreApplication::include_component(array("component" => "form_require_price", "template" => "default",));
?>