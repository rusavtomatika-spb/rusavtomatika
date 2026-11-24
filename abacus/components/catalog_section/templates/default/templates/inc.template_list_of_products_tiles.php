<?php
global $usd_currency, $arSettings;
?>
<div class="<?php echo defined('SERVER_RENDERING') ? 'IS_SERVER_RENDERING' : 'IS_NOT_SERVER_RENDERING'; ?> series_products_tiles">
  <?php if (isset($series['products']) && is_array($series['products'])): ?>
    <?php foreach ($series['products'] as $product): ?>
      <?php
      $diagonal = '';
      if (
          isset($product['diagonal'])
          && $product['diagonal'] != ''
          && $product['diagonal'] != 0
          && $product['diagonal_hide'] == 0
      ) {
          $product['diagonal'] = str_replace('.0', '', $product['diagonal']);
          $diagonal = '<b>' . $product['diagonal'] . '&Prime;&nbsp;</b>';
      }

      $short_description = '';
      if (isset($arrPreviewFields_withNames) && is_array($arrPreviewFields_withNames)) {
          $parts = [];
          foreach ($arrPreviewFields_withNames as $field) {
              $code = $field['code'];
              if (isset($product[$code]) && $product[$code] != '') {
                  $parts[] = '<span class="name_short">' . $field['name_short'] . ':</span>&nbsp;'
                      . $product[$code] . $field['units'];
              }
          }
          $short_description = implode(', ', $parts);
      }

      $model = $product['model'];
      if ($product['brand'] === 'Faraday') {
          $model = str_replace(['/', ' '], '_', $model);
      }
      $image_src = $arSettings['path_to_product_images']
          . mb_strtolower($product['brand']) . '/'
          . mb_strtolower($product['type']) . '/'
          . $model . '/580/' . $model . '_1.webp';

      if ($_SERVER['HTTP_HOST'] === 'www.rusavtomatika.com') {
          $image_src = '/upload_files' . $image_src;
      }

      $brand = $product['brand'];

      $price_html = '';
      if (
          isset($product['retail_price'])
          && intval($product['retail_price']) > 0
          && $product['retail_price_hide'] == 0
      ) {
          switch ($product['currency']) {
              case 'USD':
                  if ($product['action_price'] > 0) {
                      $price_html .= '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>&nbsp;<span class="usd">$</span></span>';
                  }
                  $price_html .= '<div class="usd_price"><span class="value">' . $product['retail_price'] . '</span>&nbsp;<span class="usd">$</span></div>';
                  if ($usd_currency) {
                      $price_html .= '<div class="rub_price">' . intval($product['retail_price'] * $usd_currency) . '&nbsp;&#8381;</div>';
                  }
                  break;

              case 'RUR':
                  if ($product['action_price'] > 0) {
                      $price_html .= '<span class="act_price"><span class="value">' . $product['action_price'] . '</span>&nbsp;<span class="usd">&#8381;</span></span>';
                  }
                  if ($usd_currency) {
                      $price_html .= '<span><span class="value">' . intval($product['retail_price'] / $usd_currency) . '&nbsp;$</span></span>';
                  }
                  $price_html .= '<span class="rub_price">'
                      . $product['retail_price'] . ' <span class="rub">&#8381;</span>'
                      . '</span>';
                  break;
          }
      } else {
          $price_html .= '<span class="no_price series_products__button" data-rel-model="' . $product['model'] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i>&nbsp;Запросить цену</span>';
          if (isset($_COOKIE['dev_mode']) && $_COOKIE['dev_mode'] > 0) {
              $price_html .= '<span class="show_in_dev_mode">' . $product['retail_price'] . '</span>';
          }
      }
      ?>

      <div class="tr_product_<?= $product['model'] ?> tile"
           data-type="<?= $product['type'] ?>"
           data-series="<?= $product['series'] ?>">

        <div class="preview">
          <div class="preview_image">
            <?php if (in_array($brand, ['Weintek', 'IFC', 'Aplex', 'Spiktek', 'Samkoon', 'eWON', 'Faraday'])): ?>
              <a class="brand_plate" href="/<?= strtolower($brand) ?>/"><?= $brand ?></a>
            <?php else: ?>
              <span class="brand_plate"><?= $brand ?></span>
            <?php endif; ?>

            <a href="<?= $product['link_detail_page'] ?>">
              <img alt="<?= $product['short_name'] ?> <?= $product['brand'] !== 'IFC' ? $product['brand'] : '' ?> <?= $product['model'] ?>"
                   loading="lazy"
                   src="<?= $image_src ?>">
            </a>
          </div>
        </div>

        <div class="td_short_description">
          <a href="<?= $product['link_detail_page'] ?>">
            <span class="model"><?= $product['model'] ?></span>
          </a>
          <p>Серия: <?= $product['series'] ?></p>

          <div class="preview_text_block">
            <div><?= $diagonal . ' ' . $product['short_name'] ?></div>
            <span class="preview_text"><?= $product['preview_text'] ?></span>;
            <span class="preview_text_extra"><?= $product['preview_text_extra'] ?></span>
          </div>
        </div>

        <div class="td_buttons">
          <div class="series_products__panel_buttons">
            <div class="price_block">
              <div class="price_block_wrapper">
                <div class="price_block"><?= $price_html ?></div>
              </div>
              <div class="indicator_availability">
                <?php if ($product['onstock_spb'] > 0 || $product['onstock_msk'] > 0): ?>
                  <span style="color:#00ad61"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span>
                <?php else: ?>
                  <span class="red"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Под&nbsp;заказ</span>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="buttons_panel">
            <div class="buttons_add">
              <div title="Добавить в сравнение"
                   class="series_products__button compare fa-solid fa-align-right fa-rotate-90"
                   @click="add_too_box"
                   data-model="<?= $product['model'] ?>"
                   data-box="compare"></div>
              <div title="Добавить в избранное"
                   class="series_products__button favorites fa-regular fa-heart"
                   @click="add_too_box"
                   data-model="<?= $product['model'] ?>"
                   data-box="favorites"></div>
            </div>

            <button title="Добавить в заказ"
                    class="series_products__button cart"
                    @click="add_too_box"
                    data-model="<?= $product['model'] ?>"
                    data-box="cart">
              <i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp;&nbsp;В&nbsp;ЗАКАЗ
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <hr>Нет товаров...<hr>
  <?php endif; ?>
</div>