<?php
require_once __DIR__ . '/inc_data_preparator.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

if (isset($arResult['product']['model']) && strtolower($arResult['product']['model']) == 'codesys') {
    $userCountry = CountryDetector::getCountry();

    if (!$userCountry) {
        $userCountry = 'UNKNOWN';
    }

    if ($userCountry != 'RU') {
        header("HTTP/1.0 404 Not Found");

        global $TITLE;
        global $H1;
        $TITLE = $H1 = "Ошибка 404";

        CoreApplication::add_style("/abacus/components/catalog/templates/default/style.css");
        CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");

        include "inc_404.php";
        exit();
    }
}

global $TITLE;
global $DESCRIPTION;
global $DESCRIPTION_micro;
global $KEYWORDS;
global $CANONICAL;
global $H1;
global $SEO_URL;
global $UPPER_SEO_TEXT, $LOWER_SEO_TEXT, $model, $fi4i_out;

if (!function_exists('catalogDetail_formatMemoryField')) {
    function catalogDetail_formatMemoryField(&$fieldName, &$fieldValue, $fieldUnits) {
        if (strpos($fieldName, 'Flash') !== false || strpos($fieldName, 'flash') !== false) {

            $numericValue = floatval($fieldValue);
            $mbValue = $numericValue * 1024;

            if ($mbValue < 1024) {
                $newUnit = 'Мб';
                $displayValue = round($mbValue) . ' Мб';
            } else {
                $newUnit = 'Гб';
                $gbValue = $numericValue;
                if ($gbValue == intval($gbValue)) {
                    $displayValue = intval($gbValue) . ' Гб';
                } else {
                    $displayValue = rtrim(rtrim(number_format($gbValue, 2, '.', ''), '0'), '.') . ' Гб';
                }
            }

            $fieldValue = $displayValue;

            if (strpos($fieldName, ',') !== false) {
                $parts = explode(',', $fieldName);
                array_pop($parts);
                $fieldName = implode(',', $parts);
            }

            $fieldName = rtrim($fieldName, ', ');
            $fieldName .= ', ' . $newUnit;

            return true;
        }
        return false;
    }
}

if (!function_exists('catalogDetail_isHtmlString')) {
    /**
     * Есть ли в строке HTML-теги.
     */
    function catalogDetail_isHtmlString($str) {
        if (!is_string($str) || trim($str) === '') {
            return false;
        }
        return (bool) preg_match('/<[a-z][\s\S]*>/i', $str);
    }
}

if (!function_exists('catalogDetail_formatPreviewText')) {
    /**
     * Приводит text_features к HTML:
     *  - HTML возвращает как есть (с лёгкой санитизацией мусора);
     *  - обычный текст разбивает по строкам в <ul><li>.
     * PHP 5.6-совместимо.
     */
    function catalogDetail_formatPreviewText($text) {
        if (!is_string($text) || trim($text) === '') {
            return '';
        }

        // --- Санитайзер мусора от старых импортов ---
        // убираем обрывки вида  "=""&gt;   , "&gt;   '=""&gt;
        $text = preg_replace('/["\']\s*=\s*["\'][^>]*&gt;/u', '', $text);
        $text = preg_replace('/,\s*["\'][^>]*&gt;/u', '', $text);
        // одиночные &gt; вне тегов
        $text = preg_replace('/(?<![<\w])&gt;(?![^<]*>)/u', '', $text);

        // если есть <li> без <ul> — обернём
        if (preg_match('/<li\b/i', $text) && !preg_match('/<ul\b/i', $text)) {
            $text = '<ul>' . $text . '</ul>';
        }

        // Если это уже HTML — отдаём как есть
        if (catalogDetail_isHtmlString($text)) {
            return $text;
        }

        // Иначе — обычный текст: режем по строкам, оборачиваем в <ul>
        $text = str_replace(array("\r\n", "\r"), "\n", $text);
        $lines = preg_split('/\n+/', $text);

        $items = array();
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            // убираем маркеры списка в начале строки
            $line = preg_replace('/^[\-\*•·]\s*/u', '', $line);
            if ($line !== '') {
                $items[] = htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
            }
        }

        if (count($items) === 0) {
            return '';
        }

        return '<ul class="preview_text_list"><li>' . implode('</li><li>', $items) . '</li></ul>';
    }
}

if (!function_exists('catalogDetail_fileExistsOnFtp')) {
    function catalogDetail_fileExistsOnFtp($filePath) {
        global $ftp_server, $ftp_user, $ftp_password;

        $connection = ftp_connect($ftp_server);

        if (!$connection) {
            throw new Exception("Невозможно подключиться к FTP серверу.");
        }

        if (!ftp_login($connection, $ftp_user, $ftp_password)) {
            throw new Exception("Ошибка авторизации на FTP сервере.");
        }

        $size = ftp_size($connection, $filePath);

        return $size !== -1;
    }
}

if (!function_exists('catalogDetail_startsWith')) {
    function catalogDetail_startsWith($haystack, $needle) {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}

if (!function_exists('catalogDetail_transformString')) {
    function catalogDetail_transformString($str) {
        if (!catalogDetail_startsWith($str, 'Faraday')) {
            return $str;
        }

        list($prefix, $suffix) = explode(' ', trim($str), 2);
        $transformedSuffix = preg_replace('/[\s\/]+/', '-', $suffix);
        return "$prefix-$transformedSuffix";
    }
}

/* =========================================================================
   ОСНОВНОЙ ВЫВОД
   ========================================================================= */

if (ERROR_404) {
    global $TITLE;
    global $H1;
    $TITLE = $H1 = "Ошибка 404";
    CoreApplication::add_style("/abacus/components/catalog/templates/default/style.css");
    CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
    include "inc_404.php";
} else {
    CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
    CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

    CoreApplication::add_breadcrumbs_chain($arResult['section']["name"], "/catalog/" . $arResult['section']["code"] . "/");
    CoreApplication::add_breadcrumbs_chain($arResult['product']["model"]);
    $schemes = get_schemes($arResult['product']["model"]);
    ?>
<div id="vue_component_catalog_detail" data-model="<?= $arResult['product']["model"] ?>">
<div class="component_catalog_detail" itemscope itemtype="https://schema.org/Product">
<meta itemprop="model" content="<?= $arResult['product']['model'] ?>">
<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<?php
    if (intval($arResult['product']["price_usd_value"]) > 0 and $arResult['product']['retail_price_hide'] == "0"): ?>
<meta itemprop="price" content="<?= $arResult['product']['price_usd_value'] ?>">
<meta itemprop="priceCurrency" content="<?= $arResult['product']['currency'] ?>">
<?php endif; ?>
<?php if ($arResult['product']["onstock_spb"] > 0): ?>
<link itemprop="availability" href="http://schema.org/InStock">
<?php else: ?>
<link itemprop="availability" href="https://schema.org/PreOrder">
<?php endif; ?>
<span itemprop="seller" itemscope itemtype="https://schema.org/Organization">
<meta itemprop="name" content="ООО Русавтоматика">
<meta itemprop="description"
              content="Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, Samkoon.">
<link itemprop="url" href="https://www.rusavtomatika.com/">
<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
<meta itemprop="addressLocality" content="Санкт-Петербург">
<meta itemprop="postalCode" content="199178">
<meta itemprop="streetAddress" content="Малый пр. В.О. 57 корп. 3">
</span>
<meta itemprop="telephone" content="+7 812 648-03-47">
<meta itemprop="email" content="sales@rusavtomatika.com">
</span> </span> <span itemprop="brand" itemscope itemtype="https://schema.org/Brand">
<meta itemprop="name" content="<?= $arResult['product']['brand'] ?>">
</span>
<div class="component_wrapper">
<?php
    CoreApplication::include_component(array("component" => "breadcrumbs"));
    ?>
<section id="start">
  <div class="sticky_block_wrapper">
    <div class="sticky_block">
      <div class="sticky_block_wrap_inn">
        <div class="container is-widescreen">
          <div class="sticky_block_inner_wrapper">
            <div class="left"> <span class="metadata"
                                                  data-brand="<?= $arResult['product']["brand"] ?>"
                                                  data-type="<?= $arResult['product']["type"] ?>"
                                                  data-series="<?= $arResult['product']["series"] ?>"
                                            > </span>
              <h1 itemprop="name">
                <?= $H1; echo $arrChunks__; ?>
              </h1>
              <?php
              if ($arResult['product']['brand'] == "eWON") {
                  include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/widgets/inc_no_ewon.php";
              }
              ?>
              <?php if ($arResult['product']["replace_detail_text_with_file"] == ""): ?>
              <div class="component_catalog_detail__nav">
                <nav>
                  <div class="tabs is-boxed is-primary">
                    <ul>
                      <li class="is-active"> <a href="#start"> <span>Краткий обзор</span> </a> </li>
                      <li> <a href="#specifications"> <span>Характеристики</span> </a> </li>
                      <li> <a href="#dimensions"> <span>Габариты</span> </a> </li>
                      <?php
                      if ($schemes != ''):
                          ?>
                      <li> <a href="#schemes"> <span>Схемы</span> </a> </li>
                      <?php endif; ?>
                      <?php
                      if ($arResult['product']["set_tab_html"] != ''):
                          ?>
                      <li> <a href="#set_tab_html"> <span>Комплектность</span> </a> </li>
                      <?php endif; ?>
                      <li> <a href="#files"> <span>Файлы</span> </a> </li>
                      <?php if (isset($arResult['product']['text_seo']) && $arResult['product']['text_seo'] != '') : ?>
                      <li> <a href="#text"> <span>Описание</span> </a> </li>
                      <?php endif ?>
                      <?php if (count($arSelected_articles) > 0) : ?>
                      <li> <a href="#articles"> <span>Статьи</span> </a> </li>
                      <?php endif ?>
                      <?php if (count($arSelected_videos) > 0) : ?>
                      <li> <a href="#videos"> <span>Видео</span> </a> </li>
                      <?php endif ?>
                      <li class="button_open_this_menu"> <span class="button_open_menu__icon"></span> </li>
                    </ul>
                  </div>
                </nav>
              </div>
              <?php endif; ?>
            </div>
            <div class="right">
              <div class="component_catalog_detail__panel_info_currency_rate is-hidden-touch">
                <?php
                global $usd_currency;
                if (isset($usd_currency) and $usd_currency > 0): ?>
                <div class="section_list_currency_block">
                  <div class="info">
                    <?php
                    echo "1&nbsp;USD&nbsp;=&nbsp;" . $usd_currency . "&nbsp;РУБ";
                    ?>
                  </div>
                </div>
                <?php endif; ?>
              </div>
              <button
                class="button is-success burger-mobile"
                @click="toggleBurgerMenu"
                style="padding: 5px 10px;"
                ref="burgerBtn"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                  <g id="SVGRepo_iconCarrier">
                    <circle cx="18" cy="12" r="1.5" transform="rotate(90 18 12)" fill="#fff"/>
                    <circle cx="12" cy="12" r="1.5" transform="rotate(90 12 12)" fill="#fff"/>
                    <circle cx="6" cy="12" r="1.5" transform="rotate(90 6 12)" fill="#fff"/>
                  </g>
                </svg>
              </button>
              <div class="component_catalog_detail__small_info_block" v-if="isBurgerOpen || !isMobile" ref="burgerWrapper">
                <div class="component_catalog_detail__price">
                  <?php
                  if (intval($arResult['product']["price_usd_value"]) > 0 and $arResult['product']['retail_price_hide'] == "0") {
                      if ($arResult['product']['currency'] == 'USD') {
                          if (intval($arResult['product']['show_rub_po_kursu_usd']) == 1) {
                    ?>
                  <div class="item price">
                    <div> <span class="price_usd_value">
                      <?= $arResult['product']['price_rub_value'] ?>
                      </span> <span class="price_usd_currency">
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php if (intval($arResult['product']["price_rub_act_value"]) > 0) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_rub_act_value'] ?>
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php } ?>
                    </div>
                  </div>
                  <?php
                          } else {
                    ?>
                  <div class="item price">
                    <div> <span class="price_usd_value">
                      <?= $arResult['product']['price_usd_value'] ?>
                      </span> <span class="price_usd_currency">
                      <?= $arResult['product']['price_usd_currency'] ?>
                      </span>
                      <?php if (intval($arResult['product']["price_usd_act_value"]) > 0) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_usd_act_value'] ?>
                      <?= $arResult['product']['price_usd_currency'] ?>
                      </span>
                      <?php } ?>
                    </div>
                    <?php
                    if (intval($arResult['product']["price_rub_value"]) > 0) {
                      ?>
                    <div> <span class="price_rub_value">
                      <?= $arResult['product']['price_rub_value'] ?>
                      </span> <span class="price_rub_currency">
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php if (intval($arResult['product']["price_rub_act_value"]) > 0) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_rub_act_value'] ?>
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php } ?>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                  <?php
                          }
                  } elseif ($arResult['product']['currency'] == 'RUR') {
                    ?>
                  <div class="item price">
                    <?php
                    if (intval($arResult['product']["price_rub_value"]) > 0) {
                      ?>
                    <div> <span class="price_usd_value">
                      <?= $arResult['product']['price_rub_value'] ?>
                      </span> <span class="price_usd_currency">
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php if (intval($arResult['product']["price_rub_act_value"]) > 0) { ?>
                      <span class="price_act">
                      <?= $arResult['product']['price_rub_act_value'] ?>
                      <?= $arResult['product']['price_rub_currency'] ?>
                      </span>
                      <?php } ?>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                  <?php
                  }
                  } else {
                    ?>
                  <div class="button button_demand_price"
                                                         idm="<?= $arResult['product']["model"] ?>"
                                                         onclick="show_backup_call(6, &quot;<?= $arResult['product']["model"] ?>&quot;)"> Запросить&nbsp;цену </div>
                </div>
                <?php
                  }
                ?>
                <?php if ($arResult['product']["discontinued"] != '1') { ?>
                <div @click="add_too_box" class='button is-primary add_to_cart'
                                                         data-model='<?= $arResult['product']["model"] ?>'
                                                         data-box="cart"> <span class="btn_icon_order"></span> <span class="btn_icon_order_text">В заказ</span> </div>
                <?php } ?>
                <div
                  @click="add_too_box"
                  class='button button_like_link add_to_compare'
                  data-model='<?= $arResult['product']["model"] ?>'
                  data-box="compare"
                  style="background: #fff;"
                >
                    <span class="btn_icon"></span>
                    <span class="btn_text">В сравнение</span>
                </div>
                <div
                  @click="add_too_box"
                  class='button button_like_link add_to_favorites'
                  data-model='<?= $arResult['product']["model"] ?>'
                  data-box="favorites"
                  style="background: #fff;"
                >
                    <i class="fa-regular fa-heart"></i>&nbsp;
                    <span class="btn_text">В избранное</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="columns">
      <div class="column is-6">
        <div class="component_catalog_detail__images_wrapper">
          <?php
          $counter = 0;
          if (isset($arResult['product']["arr_pics"]) and count($arResult['product']["arr_pics"]) > 0) {
              foreach ($arResult['product']["arr_pics"] as $image_url):
                  $counter++;
            ?>
          <a class="component_catalog_detail__image-main_link"
                                               id="component_catalog_detail__image-main_link_<?= $counter ?>"
                                               style="display: none;" data-fancybox="product"
                                                <?php
                                                if ($arResult['product']["brand"] != "IFC") $brand = $arResult['product']["brand"];
                                                else $brand = "";
                                                ?>
                                               data-caption="<?php
                                               if($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]." ";
                                               echo $arResult['product']["model"];
                                               ?>"
                                               href="<?php echo $arResult['imgRemoteDir'] . "1330/" . $image_url ?>"> <img class="img_product-inner"
                                                     src="<?php echo $arResult['imgRemoteDir'] . "580/" . $image_url ?>"
                                                     alt="<?= $arResult['product']["model"] . '_' . $counter ?>"> </a>
          <?php
          endforeach;
          }
          ?>
          <?php

          if (isset($arResult['product']["arr_pics"]) and count($arResult['product']["arr_pics"]) > 0):
              $num_pics = count($arResult['product']["arr_pics"]);
          ?>
          <div class="component_catalog_detail__images-mini__wrapper num_pics_<?= $num_pics ?>">
            <div class="component_catalog_detail__images-mini__inner">
              <?php

              $counter = 0;
              foreach ($arResult['product']["arr_pics"] as $image_url):
                  $counter++;
              ?>
              <div data-rel="component_catalog_detail__image-main_link_<?= $counter ?>"
                                                         class="component_catalog_detail__images-mini"> <img src="<?php echo $arResult['imgRemoteDir'] . "67/" . $image_url; ?>"
                                                             alt="<?= $arResult['product']["model"] . '_' . $counter ?>"/> </div>
              <?php
              endforeach;
              ?>
            </div>
          </div>
          <?php
          endif;
          ?>
        </div>
        <?php
        if (isset($arResult['product']['youtube_video']) && $arResult['product']['youtube_video'] != '') {
            $youtube_video = $arResult['product']['youtube_video'];
        } else $youtube_video = '';
        echo $youtube_video;
        ?>
        <?php
        if (isset($arResult['product']['view360']) && $arResult['product']['view360'] != '') {
            $view360 = $arResult['product']['view360'];
        } else $view360 = '';
        echo $view360;
        ?>
      </div>
      <div class="column is-6">
        <div class="component_catalog_detail__info_block">
          <div class="component_catalog_detail__info1">
            <div class="item">
              <?php
              $prod_serie = isset($product["series"]) ? $product["series"] : '';
              $prod_warning_message = isset($product["warning_message"]) ? $product["warning_message"] : '';
              $prod_series = explode(',', isset($product['series']) ? $product['series'] : '');
              $all_series = function_exists('get_all_series') ? get_all_series() : array();
              if (in_array($arResult['product']['brand'], array("Weintek", "IFC", "Aplex", "Samkoon", "Spiktek", "eWON", "Faraday", "Cincoze"))) {
                ?>
              <a href="/<?php echo strtolower($arResult['product']['brand']); ?>/"> <span
                                                        class="info_tag info_brand">
              <?= $arResult['product']['brand'] ?>
              </span> </a>
              <?php
              } else {
                ?>
              <span><span
                                                        class="info_tag info_brand">
              <?= $arResult['product']['brand'] ?>
              </span> </span>
              <?php
              }
              ?>
              <?php
              if (count($prod_series) > 0) {
                  echo '';
                  foreach ($prod_series as $ind => $serie) {
                      foreach ($all_series as $i => $all_serie) {
                          $pattern = '/' . $product["type"] . '/';
                          if ($all_serie['name'] != 'INDUSTRIAL' && $all_serie['name'] == $serie && preg_match($pattern, $all_serie["type"]))
                              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Серия: <a class="tag mr-1" href="/catalog/' . $all_serie['menu_category_item_code'] . '/?&series=' . $all_serie['name'] . '">' . $all_serie['name'] . '</a>';
                      }
                  }
                  echo '</span>';
              }
              ?>
            </div>
            <div class="item">
              <?php if ($arResult['product']["discontinued"] == "1"): ?>
              <span class="info_button info_discontinued">снят с производства<br>
              недоступен для заказа</span>
              <?php if ($arResult['product']["analogs"] != ""): ?>
              <br>
              <span class="info_button info_analogs">Аналоги:
              <?= $arResult['product']["analogs"] ?>
              </span>
              <?php endif; ?>
              <?php elseif ($arResult['product']["discontinued"] == "0"):?>
              <?php if ($arResult['product']["onstock_spb"] > 0): ?>
              <span class="info_tag info_available">в наличии</span>
              <?php elseif ($arResult['product']["onstock_spb"] < 0): ?>
              <span class="info_tag info_not_available">наличие уточняйте</span>
              <?php elseif ($arResult['product']["discontinued"] != "1"): ?>
              <span class="info_tag info_not_available">под заказ</span>
              <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="component_catalog_detail__info2"> </div>
          <div class="component_catalog_detail__price">
            <?php if ($arResult['product']["discontinued"] != '1') { ?>
            <div class="item price">
              <?php
              if (intval($arResult['product']["price_usd_value"]) > 0 and $arResult['product']['retail_price_hide'] == "0"):
                  if ($arResult['product']['currency'] == 'USD' && intval($arResult['product']['show_rub_po_kursu_usd']) == 1):
                ?>
              <div>
                <span class="price_usd_value">
                <?= $arResult['product']['price_rub_value'] ?>
                </span> <span class="price_usd_currency">
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <?php if (intval($arResult['product']["price_rub_act_value"]) > 0) { ?>
                <span class="price_act">
                <?= $arResult['product']['price_rub_act_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <?php } ?>
              </div>
              <?php
                  else:
                ?>
              <div>
                <?php if ($arResult['product']['currency'] == 'USD') { ?>
                <span class="price_usd_value">
                <?= $arResult['product']['price_usd_value'] ?>
                </span> <span class="price_usd_currency">
                <?= $arResult['product']['price_usd_currency'] ?>
                </span>
                <?php } ?>
                <?php if (intval($arResult['product']["price_usd_act_value"]) > 0) { ?>
                <span class="price_act">
                <?= $arResult['product']['price_usd_act_value'] ?>
                <?= $arResult['product']['price_usd_currency'] ?>
                </span>
                <?php } ?>
                <?php if ($arResult['product']['currency'] == 'USD') { ?>
                <br><span class="price_rub_value">
                <?= $arResult['product']['price_rub_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <?php } ?>
              </div>
              <?php
                  endif;
                  if (intval($arResult['product']["currency"]) == "RUR") {
                ?>
              <div>
                <?php if ($arResult['product']['currency'] == 'RUR') { ?>
                <span class="price_usd_value">
                <?= $arResult['product']['price_rub_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <?php } ?>
                  <?php if (intval($arResult['product']["price_rub_act_value"]) > 0) { ?>
 <span class="price_act">
                <?= $arResult['product']['price_rub_act_value'] ?>
                <?= $arResult['product']['price_rub_currency'] ?>
                </span>
                <?php } ?>
              </div>
              <?php
              }
              ?>
            </div>
            <div class="item">
              <div class="component_catalog_detail__price_extra_info"> Цена указана с учетом НДС 22% </div>
            </div>
            <?php
            else :
              ?>
            <div class="button button_demand_price"
                                             data-rel-model="<?= $arResult['product']["model"] ?>"> Запросить&nbsp;цену </div>
            <?php
            endif;
            ?>
            <?php } ?>
          </div>
        </div>
        <div class="component_catalog_detail__buttons1">
          <?php if ($arResult['product']["discontinued"] != '1') { ?>
          <div @click="add_too_box" class='button is-primary add_to_cart'
                                             data-model='<?= $arResult['product']["model"] ?>' data-box="cart"> <span class="btn_icon_order"></span> <span class="btn_icon_order_text">В заказ</span> </div>
          <?php } ?>
              <?php if ($arResult['product']["analogs"] != "") { ?>
          <div
            style="background: #fff;"
            @click="add_too_box"
            class='button button_like_link add_to_compare'
            data-model='<?= $arResult['product']["model"] ?>' data-box="compare"
          >
            <span class="btn_icon"></span>
            <span class="btn_text">В сравнение</span>
          </div>
          <div
            style="background: #fff;"
            @click="add_too_box"
            class='button button_like_link add_to_favorites'
            data-model='<?= $arResult['product']["model"] ?>' data-box="favorites"
          >
            <i class="fa-regular fa-heart"></i>
            <span class="btn_text">&nbsp;В избранное</span>
          </div>
              <?php }
    if (($arResult['product']["discontinued"] == "1") && ($arResult['product']['analogs'] == "")) { ?>
          Мы готовы предложить<br>
более новые модели: <a href="<?php echo "/catalog/" . $arResult['section']["code"] . "/"; ?>"><div class='button is-primary'>  <span class="btn_text"><?= $arResult['section']["name"] ?></span> </div></a>
              <?php }
            ?>
        <div
          @click="add_too_box"
          class='button button_like_link add_to_compare'
          data-model='<?= $arResult['product']["model"] ?>'
          data-box="compare"
          style="background: #fff;"
        >
          <span class="btn_icon"></span>
          <span class="btn_text">В сравнение</span>
        </div>
        <div
          @click="add_too_box"
          class='button button_like_link add_to_favorites'
          data-model='<?= $arResult['product']["model"] ?>'
          data-box="favorites"
          style="background: #fff;"
        >
          <i class="fa-regular fa-heart"></i>&nbsp;
          <span class="btn_text">В избранное</span>
        </div>
        <?php if ($arResult['product']['view3d'] == 1): ?>
          <?php
            $modelName = $arResult['product']["model"];
            $cleanModelName = preg_replace('/[\s\/]+/', '-', $modelName);
            $model3dPath = "models/{$cleanModelName}-model/";
          ?>
          <button class='button button-3d-link' id="viewButton">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="16" height="16" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
              <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path d="M1450 4481 l-1105 -638 0 -1283 0 -1283 1106 -638 1106 -639 1106 638 1106 637 0 1285 0 1285 -1101 635 c-606 349 -1104 636 -1107 637 -3 2 -503 -285 -1111 -636z m1963 -203 c469 -270 865 -499 880 -508 l28 -17 -873 -504 c-479 -277 -879 -505 -888 -506 -16 -3 -1753 997 -1754 1010 -1 8 1730 1014 1747 1016 5 1 392 -220 860 -491z m-1887 -1296 l879 -507 3 -1018 c1 -559 -1 -1017 -5 -1017 -3 0 -402 228 -885 507 l-878 507 0 1018 c0 560 1 1018 3 1018 2 0 399 -228 883 -508z m2944 -511 l0 -1019 -872 -504 c-479 -276 -875 -505 -880 -506 -4 -2 -8 455 -8 1015 l0 1018 878 507 c482 279 878 507 880 508 1 0 2 -459 2 -1019z"/>
              </g>
            </svg>
            <span>3D просмотр</span>
          </button>
        <?php endif; ?>
        </div>
        <div class="component_catalog_detail__advantages">
          <?php echo catalogDetail_formatPreviewText(isset($arResult['product']["text_features"]) ? $arResult['product']["text_features"] : ''); ?>
          <?php
          if ($UPPER_SEO_TEXT) {
            ?>
          <div class="UPPER_SEO_TEXT">
            <?= $UPPER_SEO_TEXT ?>
          </div>
          <?php } ?>
        </div>
        <div class="component_catalog_detail__buttons2">
          <div>
            <?= isset($link_advanced_search) ? $link_advanced_search : '' ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php
$product_field_descriptions = get_product_field_descriptions($arResult['product']["type"]);

if (($arResult['product']['type'] == 'controllers'
  or $arResult['product']['type'] == 'coupler')
  && $arResult['product']['brand'] == 'Weintek') {
    include "inc_io_modules_table.php";
}
?>
<meta itemprop="description" content="<?= $DESCRIPTION_micro ?>">
<?php
if (count($product_field_descriptions) > 0 and $arResult['product']["replace_detail_text_with_file"] == ""):
  ?>
<section id="specifications">
  <h2>Технические
    характеристики
    <?= $product_type_genitive_case ?>
    <?php if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <?php
  foreach ($product_field_descriptions as $group) {
    ob_start();
    ?>
  <h3 class="table_characteristics_group_name">
    <?= $group['name'] ?>
  </h3>
  <div class="table-container">
    <table class="table_characteristics table is-striped is-fullwidth is-bordered">
      <tbody>
        <?php
        $groups_counter = 0;
        foreach ($group['items'] as $field) {
          if ($arResult['product'][$field["field_code"]] == '' || $arResult['product'][$field["field_code"]] == '0') continue;
          $groups_counter++;

          $fieldName = $field["field_name"];
          $fieldValue = $arResult['product'][$field["field_code"]];
          $fieldUnits = $field["field_units"];

          if ($field["field_type"] == 'text'):
            ?>
        <tr>
          <td colspan="2"><?= $fieldValue ?></td>
        </tr>
        <?php
        else :
          catalogDetail_formatMemoryField($fieldName, $fieldValue, $fieldUnits);
          ?>
        <tr>
          <td class="field_code__<?= $field["field_code"] ?>"><?= $fieldName ?></td>
          <td><?= $fieldValue ?></td>
        </tr>
        <?php
        endif;
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php
  $group = ob_get_clean();
  if ($groups_counter > 0) echo $group;
  }
  ?>
</section>
<?php
endif;
if (
    ($arResult['product']["type"] == 'box-pc') &&
    (
        (isset($arResult['product']["standby_power_consumption"]) && $arResult['product']["standby_power_consumption"] != '') ||
        (isset($arResult['product']["power_consumption_under_average_load"]) && $arResult['product']["power_consumption_under_average_load"] != '') ||
        (isset($arResult['product']["maximum_power_consumption"]) && $arResult['product']["maximum_power_consumption"] != '')
    )
) {
    echo $prim_power;
}

if ($arResult['product']['articuls'] != '') {
  ?>
<h2>Информация для заказа:</h2>
<div class="table-container">
<table class="table  is-bordered is-hoverable">
<tr>
  <td class="is-size-7 has-text-grey-light has-text-weight-light" style="border: none;">АРТИКУЛ</td>
  <td style="border: none;" class="is-size-7 has-text-grey-light has-text-weight-light">КОНФИГУРАЦИЯ</td>
</tr>
<?php
$arts = explode("\n", $arResult['product']['articuls']);
foreach ($arts as $art) {
    $articul = explode(":", $art);
    echo '<tr id="' . $articul[0] . '"><td class="is-size-7" style="border-bottom:1px solid white;background:#dbdbdb"><strong>';
    echo $articul[0] . '</strong></td><td class=" is-size-7">' . (isset($articul[1]) ? $articul[1] : '') . '</td><td style="border:none;    vertical-align: middle;"><a title="Скопировать" class="is-pulled-right" style="text-decoration: none;" onclick="copyToClipboard(\'' . htmlentities($art) . '\')"><i class="fa-regular fa-copy" style="color:#ccc;"></i></a></td></tr>';
}
echo '</table></div><br>';
}
?>
<?php
if ($arResult['product']["replace_detail_text_with_file"] == ""):
    $model = str_replace("/", "_", $product["model"]);
$model = str_replace(" ", "_", $model);
$dim_picture_src = "/images/" . strtolower($arResult['product']["brand"]) . "/dim/" . $model . ".png";
if (!CoreApplication::fileExistsOnFtp($dim_picture_src)) {
    $dim_picture_src = "";
    if ($arResult['product']["brand"] == "Faraday") {
        $dim_picture_src = "/images/faraday/dim/" . $arResult['product']["s_name"] . ".png";
        if (!CoreApplication::fileExistsOnFtp($dim_picture_src)) {
            $dim_picture_src = "";
        }
    }
}
?>
<section id="dimensions">
  <?php if ($arResult['product']["dimentions"] != '' or $arResult['product']["cutout"] != '' or $dim_picture_src != ''): ?>
  <h2> Габариты
    <?= $product_type_genitive_case ?>
    <?php if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <?php endif; ?>
  <?php if ($arResult['product']["dimentions"] != '') { ?>
  <div class="component_catalog_detail__dimentions"> Габариты:
    <?= $arResult['product']["dimentions"] ?>
  </div>
  <?php } ?>
  <?php if ($arResult['product']["cutout"] != '') { ?>
  <div class="component_catalog_detail__dimentions">Посадочное
    отверстие:
    <?= $arResult['product']["cutout"] ?>
  </div>
  <?php } ?>
  <?php

  if ($dim_picture_src != '') {
    ?>
  <img alt="Габариты <?= $arResult['product']["model"] ?>"
                             class="component_catalog_detail__image_dimensions"
                             src="<?= $dim_picture_src ?>"/>
  <?php
  }
  ?>
</section>
<?php endif; ?>
<?php
if ($schemes != ''
  and $arResult['product']["replace_detail_text_with_file"] == ""):
  ?>
<section id="schemes">
  <h2>Схема
    соединения
    <?php if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="component_catalog_detail__schemes_wrapper">
    <?php
    echo $schemes;
    ?>
  </div>
</section>
<?php endif; ?>
<?php
if ($arResult['product']["set_tab_html"] != ''):
  ?>
<section id="set_tab_html">
  <h2>Комплектность</h2>
  <?= $arResult['product']["set_tab_html"] ?>
</section>
<?php endif; ?>
<?php if (isset($arResult['product']['files']) and is_array($arResult['product']['files']) and count($arResult['product']['files']) > 0 and $arResult['product']["replace_detail_text_with_file"] == "") : ?>
  <?php if (!empty($prod_warning_message)): ?>
    <section style="display: flex; justify-content: flex-start; margin-bottom: 30px;">
		<?php echo $prod_warning_message; ?>
    </section>
    <?php endif; ?>
  <section id="files">
  <h2>Файлы для работы
    с
    <?php if ($arResult['product']["brand"] != "IFC") echo $arResult['product']["brand"]; ?>
    <?= $arResult['product']["model"] ?>
  </h2>
  <?php
  require_once __DIR__ . "/inc_template_detail_files.php";
  ?>
</section>
<?php endif; ?>
<?php if (isset($arResult['product']['text_seo']) && $arResult['product']['text_seo'] != '') : ?>
<section id="text">
  <h2>Информация о продукте</h2>
  <?php
  echo $arResult['product']['text_seo'];
  ?>
</section>
<?php endif; ?>
<?php if (isset($arResult['product']['questions_about_model']) && $arResult['product']['questions_about_model'] != '') : ?>
<section id="text">
  <h2>Часто задаваемые вопросы</h2>
  <?php echo $arResult['product']['questions_about_model']; ?>
  <p>У нас разобраны и более комплексные вопросы на странице <a href="/faq">Часто Задаваемых Вопросов</a></p>
</section>
<?php endif; ?>

<?php if ($arResult['product']['view3d'] == 1): ?>
  <?php
    $modelName = $arResult['product']["model"];
    $cleanModelName = preg_replace('/[\s\/]+/', '-', $modelName);
    $model3dPath = "models/{$cleanModelName}-model/";
  ?>
  <iframe src="/<?= $model3dPath ?>" style="width: 100%; height: 0; visibility: hidden;" id="modelItem"></iframe>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const viewButton = document.getElementById('viewButton')
  const modelItem = document.getElementById('modelItem')

  if (viewButton && modelItem) {
    function scrollToModel() {
      const elementPosition = modelItem.getBoundingClientRect().top
      const offsetPosition = elementPosition + window.pageYOffset - 350
      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      })
      setTimeout(() => {
        modelItem.style.visibility = 'visible'
        modelItem.style.height = '600px'
      }, 300)
    }
    viewButton.addEventListener('click', scrollToModel)
  }
})
</script>
<?php
if (isset($arResult['product']["replace_detail_text_with_file"]) and $arResult['product']["replace_detail_text_with_file"] != ""):
  ?>
<section id="replace_detail_text_with_file">
  <?php
  if (defined('ENCODING') and ENCODING == "UTF-8") {
      $path = $_SERVER["DOCUMENT_ROOT"] . $arResult['product']["replace_detail_text_with_file"];
      $path = str_replace("/include/", "/include_utf_8/", $path);
      include $path;
  } else {
      include $_SERVER["DOCUMENT_ROOT"] . $arResult['product']["replace_detail_text_with_file"];
  }
  ?>
</section>
<?php
endif;
?>

<?php if (count($arSelected_articles) > 0) : ?>
<section id="articles">
  <h2>Статьи о
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="fixed-grid has-5-cols has-1-cols-mobile has-3-cols-tablet has-4-cols-desktop has-5-cols-widescreen has-5-cols-fullhd">
    <div class="grid">
      <?php
      foreach ($arSelected_articles as $article) {
        ?>
      <div class="cell">
        <div class="card product__item-card">
          <div class="card-image" style="padding: 30px;"><a href="/articles/<?= $article['sys_name'] ?>" target="_art">
            <figure class="image is-3by2"> <img
        src="<?= $article['img'] ?>"
        alt="<?= htmlspecialchars($article['name']) ?>"
      /> </figure>
            </a> </div>
          <div class="card-content pt-0">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2"><a href="/articles/<?= $article['sys_name'] ?>" target="_art">
                <?= $article['name'] ?>
                </a></p>
              <p class="is-6 is-size-7">
                <?= date("m.d.Y", strtotime($article['date'])) ?>
              </p>
            </div>
            <div class="content is-size-7">
              <?= mb_substr($article['description'], 0, 150) ?>
              ... </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if (count($arSelected_videos) > 0) : ?>
<section id="videos">
  <h2>Видео о
    <?= $arResult['product']["model"] ?>
  </h2>
  <div class="fixed-grid has-5-cols has-1-cols-mobile has-3-cols-tablet has-4-cols-desktop has-5-cols-widescreen has-5-cols-fullhd">
    <div class="grid">
      <?php
      foreach ($arSelected_videos as $video) {
        ?>
      <div class="cell">
        <div class="card product__item-card">
          <div class="card-image"><a href="/video/<?= $video['code'] ?>" target="_art">
            <figure class="image is-3by2"><img
        src="<?= $video['picture_preview'] ?>"
        alt="<?php echo htmlspecialchars($video['name']); ?>"/> </figure>
            </a> </div>
          <div class="card-content">
            <div class="media-content">
              <p class="title is-4 is-size-6 mb-2"><a href="/video/<?= $video['code'] ?>" target="_art">
                <?= $video['name'] ?>
                </a></p>
              <p class="is-6 is-size-7">
                <?= date("m.d.Y", strtotime($video['date'])) ?>
              </p>
            </div>
            <div class="content is-size-7">
              <?= mb_substr($video['text_preview'], 0, 150) ?>
              ... </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<?php endif; ?>
</section>
</div>
</div>
<div class="component_catalog_detail_section_3">
  <div class="linked_products_block">
    <?php //LinkedProducts::printPanel($arResult['product']["model"], $mysqli_db);
    ?>
  </div>
</div>

<?php
CoreApplication::include_component(array("component" => "linked_products", "model" => $arResult['product']["model"]));
?>
    <?php
if (isset($LOWER_SEO_TEXT) and $LOWER_SEO_TEXT != "") {
  ?>
<div class="section_description p-5">
  <?= $LOWER_SEO_TEXT ?>
</div>
<?php
}
?>
</div>
</div>
</div>
<div class="result" v-html="result"></div>
</div>
<script type="text/javascript">
function sortTable(table_id, sortColumn){
    var tableData = document.getElementById(table_id).getElementsByTagName('tbody').item(0);
    var rowData = tableData.getElementsByTagName('tr');
    for(var i = 0; i < rowData.length - 1; i++){
        for(var j = 0; j < rowData.length - (i + 1); j++){
            if(Number(rowData.item(j).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, "")) > Number(rowData.item(j+1).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, ""))){
                tableData.insertBefore(rowData.item(j+1),rowData.item(j));
            }
        }
    }
}
$(document).ready(function() {
    sortTable('table-download-files',5);
});
</script>

<style>
  .button-3d-link {
    text-decoration: none;
  }

  .button-3d-link svg {
    margin-right: 5px;
  }

  @media (max-width: 768px) {
    .button-3d-link span {
      display: none;
    }

    .button-3d-link svg {
      margin-right: 0;
    }
  }
</style>

<?php
}

CoreApplication::include_component(array("component" => "form_require_price", "template" => "default"));
?>