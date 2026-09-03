<?php
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );

CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
//CoreApplication::add_style( "/abacus/components/catalog_section/templates/default/style.css" );

global $TITLE, $CANONICAL, $DESCRIPTION, $usd_currency;
$TITLE = "Новинки каталога РУСАВТОМАТИКА от Weintek, IFC, Спиктек и Samkoon";
$CANONICAL = "https://www.rusavtomatika.com/new-products/";
$DESCRIPTION = "Самые новые модели Weintek, IFC, Samkoon в Русавтоматике. Фото, описание, характеристики.";
CoreApplication::add_breadcrumbs_chain( "Новая продукция", "/new-products/" );

include 'functions.php';

$rows_sale = get_rows_from_table( "products_all", "", "`status` != '0' AND `discontinued` !='1'", " `date_pub` DESC LIMIT 16" );

$typeDictionary = [
  'hmi' => 'Панель оператора',
  'cloud_hmi' => 'Облачная панель',
  'panel-terminal' => 'Панель-терминал',
  'web-panel' => 'Web-панель',
  'panel_pc' => 'Панельный компьютер',
  'panel_pc_wce' => 'Панельный компьютер Windows CE',
  'panel_pc_ip65' => 'Панельный компьютер IP65',
  'monitor' => 'Промышленный монитор',
  'monitors' => 'Промышленный монитор',
  'box-pc' => 'Встраиваемый компьютер',
  'pc_module' => 'PC-модуль',
  'vpn-router' => 'VPN-роутер',
  'serial-server' => 'Serial-сервер',
  'ethernet-switch' => 'Ethernet-коммутатор',
  'controllers' => 'Контроллер ПЛК',
  'module' => 'Модуль ввода-вывода',
  'bloki-pitaniya' => 'Блок питания',
  'ps' => 'Блок питания',
  'Gateway' => 'Шлюз данных',
  'frame' => 'Рамка',
  'accessories' => 'Аксессуар',
  'antenna' => 'Антенна',
  'monitor_m_series' => 'Промышленные мониторы 10" - 23.8"'
];

$filteredRowsSale = array();
$ifcMProducts = array();
$hasIfcMProducts = false;

foreach ( $rows_sale as $product_item ) {
  $brand = $product_item[ "brand" ];
  $model = $product_item[ "model" ];

  $filteredRowsSale[] = $product_item;
}

if ( $hasIfcMProducts ) {
  $minPrice = PHP_INT_MAX;
  $maxPrice = 0;
  $hasStock = false;
  $firstProduct = $ifcMProducts[ 0 ];

  foreach ( $ifcMProducts as $item ) {
    $price = floatval( $item[ "retail_price" ] );
    if ( $price > 0 && $price < $minPrice )$minPrice = $price;
    if ( $price > $maxPrice )$maxPrice = $price;
    if ( ( $item[ "onstock_spb" ] > 0 || $item[ "onstock_msk" ] > 0 ) )$hasStock = true;
  }

  $firstMProductTextFeatures = !empty( $firstProduct[ "text_features" ] ) ? $firstProduct[ "text_features" ] : "";
  $mergedProduct = array(
    "brand" => "IFC",
    "model" => "IFC-M-Series",
    "name" => "IFC M-Series",
    "s_name" => "Промышленные мониторы IFC серии M",
    "short_name" => "Промышленные мониторы IFC серии M",
    "type" => "monitor_m_series",
    "currency" => "USD",
    "retail_price" => $minPrice,
    "action_price" => $maxPrice,
    "onstock_spb" => $hasStock ? 1 : 0,
    "onstock_msk" => $hasStock ? 1 : 0,
    "preview_text" => "Промышленные мониторы IFC серии M. Диагонали от 10.1 до 21.5 дюймов",
    "preview_text_extra" => "Сенсорный экран (емкостный/резистивный), интерфейсы: VGA, DVI, HDMI",
    "text_features" => $firstMProductTextFeatures,
    "link_detail_page" => "/catalog/industrial_monitors/?&series=IFC-200",
    "preview_picture_override" => "/images/ifc/monitor/IFC-M210C/580/IFC-M210C_1.webp",
    "price_range" => true,
    "min_price" => $minPrice,
    "max_price" => $maxPrice
  );

  //array_unshift( $filteredRowsSale, $mergedProduct );
}

$rowsSale = $filteredRowsSale;


$productsFromAll = [];


$rowsDiscounted = $productsFromAll;

function getFirstLiElements( $html, $count = 3 ) {
  if ( empty( $html ) ) return '';

  $html = str_replace( '</ li>', '</li>', $html );
  $html = preg_replace( '/(\S)\s+li>/', '$1</li>', $html );

  if ( preg_match( '/<ul[^>]*>(.*?)<\/ul>/s', $html, $ulMatch ) ) {
    $ulContent = $ulMatch[ 1 ];
  } else {
    $ulContent = $html;
  }

  preg_match_all( '/<li[^>]*>(.*?)<\/li>/s', $ulContent, $matches );

  if ( empty( $matches[ 1 ] ) ) return '';

  $shortItems = [];
  $longItems = [];

  foreach ( $matches[ 1 ] as $index => $item ) {
    $cleanItem = $item;
    $cleanItem = preg_replace( '/<a[^>]*>(.*?)<\/a>/s', '$1', $cleanItem );
    $cleanItem = strip_tags( $cleanItem );
    $cleanItem = trim( $cleanItem );

    $cleanLi = '<li>' . $cleanItem . '</li>';

    if ( !empty( $cleanItem ) ) {
      if ( mb_strlen( $cleanItem ) <= 45 ) {
        $shortItems[] = $cleanLi;
      } else {
        $longItems[] = $cleanLi;
      }
    }
  }

  if ( !empty( $shortItems ) ) {
    $items = array_slice( $shortItems, 0, $count );
  } else {
    $items = array_slice( $longItems, 0, 1 );
  }

  if ( empty( $items ) ) return '';

  $output = '<ul>';
  foreach ( $items as $item ) {
    $output .= $item;
  }
  $output .= '</ul>';

  return $output;
}
function clean_features($html) {
    $html = preg_replace('#<span\b[^>]*?>.*?</span>#si', '', $html);
    if (!preg_match_all('#<li\b[^>]*?>.*?</li>#si', $html, $matches)) {
        return '';
    }
    return '<ul>' . implode('', array_slice($matches[0], 0, 3)) . '</ul>';
}
?>
<div class="component_newslist" id="vue_component_catalog_section">
  <? CoreApplication::include_component(array("component"=> "breadcrumbs")); ?>
  <div class="component_wrapper">
    <div class="row" style="position: relative;">
      <div class="col-md-12">
        <h1 style="text-align: center">Новинки каталога РУСАВТОМАТИКА от Weintek, IFC, Спиктек и Samkoon</h1>
      </div>
      <div class="sale__page-wrapper">
        <section class="component_catalog_section__panel_of_products sale__section-wrapper view-mode-tile">
          <div class="series_products_tiles fixed-grid has-1-cols-mobile has-2-cols-tablet has-4-cols-desktop view-mode-tile sale__items-wrapper">
            <div class="grid">
              <? foreach ($rowsSale as $product_item): ?>
              <?php
              $brand = strtolower( $product_item[ "brand" ] );
              $type = isset( $product_item[ "type" ] ) ? strtolower($product_item[ "type" ]) : "monitor";
              $model = $product_item[ "model" ];
              $size = "580";

              $typeTranslated = isset( $typeDictionary[ $type ] ) ? $typeDictionary[ $type ] : $type;

              if ( isset( $product_item[ "preview_picture_override" ] ) ) {
                $preview_picture = $product_item[ "preview_picture_override" ];
              } else {
                $preview_picture = "/images/{$brand}/{$type}/{$model}/{$size}/{$model}_1.webp";
              }

              $product_name = !empty( $product_item[ "s_name" ] ) ? $product_item[ "s_name" ] : $product_item[ "model" ];
              $onstock = ( $product_item[ "onstock_spb" ] > 0 || $product_item[ "onstock_msk" ] > 0 );
              $preview_text = !empty( $product_item[ "preview_text" ] ) ? $product_item[ "preview_text" ] : "";
              $preview_text_extra = !empty( $product_item[ "preview_text_extra" ] ) ? $product_item[ "preview_text_extra" ] : "";
              $text_features = !empty( $product_item[ "text_features" ] ) ? $product_item[ "text_features" ] : "";

              if ( isset( $product_item[ "link_detail_page" ] ) ) {
                $detail_link = $product_item[ "link_detail_page" ];
              } else {
                $detail_link = "/{$brand}/{$model}/";
              }

              $display_model = $product_item[ "model" ];
              if ( $display_model == "IFC-M-Series" ) {
                $display_model = "M-Series";
              } elseif ( strtoupper( $brand ) === 'IFC' && strtoupper( substr( $display_model, 0, 4 ) ) === 'IFC-' ) {
                $display_model = substr( $display_model, 4 );
              }

              $hidePrice = ( $product_item[ "model" ] == "IFC-M-Series" );
              $isMSeries = ( $product_item[ "model" ] == "IFC-M-Series" );

              $discountPercent = 0;
              if ( !$hidePrice && isset( $product_item[ "action_price" ] ) && $product_item[ "action_price" ] > 0 && isset( $product_item[ "retail_price" ] ) && $product_item[ "retail_price" ] > 0 ) {
                $oldPrice = floatval( $product_item[ "action_price" ] );
                $newPrice = floatval( $product_item[ "retail_price" ] );
                if ( $oldPrice > $newPrice && $newPrice > 0 ) {
                  $discountPercent = round( 100 - ( $newPrice / $oldPrice * 100 ) );
                }
              }

              $series = isset( $product_item[ "series" ] ) ? $product_item[ "series" ] : "";
              ?>
              <div class="tr_product_<?= $product_item["model"] ?> tile" data-type="<?=$product_item['type']?>" data-series="<?=$series?> cell">
                <div class="preview">
                  <div class="preview_image">
                    <?
                    if ( $_SERVER[ "HTTP_HOST" ] == "www.rusavtomatika.com" ) {
                      $image_src = $preview_picture;
                    }
                    if ( $product_item[ "brand" ] == 'IFC'
                      and 0 ) {
                      $brand = '';
                    } else {
                      $brand = $product_item[ "brand" ];
                    }
                    if ( $product_item[ 'model' ] == 'IFC-M-Series' ) {
                      $discountPercent = 5;
                    }

                      ?>
                    <span class="brand_plate"><i>НОВИНКА</i></span>
                    <a href="<?= $detail_link ?>"> <img alt="<?= $product_item["short_name"]?> <? if ($product_item["brand"] != 'IFC') { echo $product_item["brand"];} ?> <?= $product_item["model"] ?>" loading="lazy" src="<?=$preview_picture?>"></a> </div>
                </div>
                <div class="td_short_description"><a href="<?= $detail_link; ?>"><span
                                class="model"> <? echo $product_item["model"];?> </span>
                  <div class="preview_text_block">
                    <div class="has-text-weight-bold"><? echo $product_item["short_name"]; ?></div>
                    </a>
                    <p>
                      <?
                      //if ( count( $series ) > 0 ) {
                      echo '<span>Серия: ' . $series . '</span> ';
                      //                    $prev_ser = $series;
                      //                    foreach ( $series as $ind => $serie ) {
                      //                      foreach ( $all_series as $i => $all_serie ) {
                      //                        $pattern = '/[^_,\w]*' . $product[ "type" ] . '[^_,\w]*/im';
                      //                        if ( $all_serie[ 'name' ] != 'INDUSTRIAL' && $all_serie[ 'name' ] != $prev_ser && $all_serie[ 'name' ] == $serie && preg_match( $pattern, $all_serie[ "type" ] ) && preg_match( $pattern, $all_serie[ "type" ] ) )
                      //                          echo '<a class="tag mr-1" href="/catalog/' . $all_serie[ 'menu_category_item_code' ] . '/?&series=' . $all_serie[ 'name' ] . '">' . $all_serie[ 'name' ] . '</a>';
                      //                        $prev_ser = $all_serie[ 'name' ];
                      //                      }
                      //                    }
                      //                    echo '</span> ';
                      // }
                      ?>
                    </p>
						<span class="preview_text">
							                <? if (!empty($text_features)): 
                //= getFirstLiElements($text_features, strpos($model, 'iR') !== false ? 1 : 3) 
				echo clean_features($text_features);
                endif; ?>

							
                    </span>
					</div>
                </div>
                <? //////////////////////////////////////////////////////////////////////////// 
                if ( $product_item[ 'model' ] == 'IFC-M-Series' ) {
					$product_item[ 'retail_price' ]=0;
					$product_item[ 'retail_price_hide ' ]=1;
				}
                  ?>
                <div class="td_buttons">
                  <div class="series_products__panel_buttons">
                    <div class="price_block">
                      <div class="price_block_wrapper">
                        <div class="price_block">
                        <div class="noflex">
                          <?
                          if ( isset( $product_item[ 'retail_price' ] )and intval( $product_item[ 'retail_price' ] ) > 0 and $product_item[ "retail_price_hide" ] == 0 and $product_item[ 'model' ] != 'IFC-M-Series' ) {
                            switch ( $product_item[ 'currency' ] ) {
                              case 'USD':
                                if ( $product_item[ 'action_price' ] > 0 ) {
                                  echo '<span class="act_price"><span class="value">' . $product_item[ 'action_price' ] . '</span>';
                                  echo '&nbsp;<span class="usd">$</span></span>';
                                }
                                echo '<div class="price_block m-0">';
                                if ( intval( $product_item[ 'show_rub_po_kursu_usd' ] ) != 1 ) {
                                  echo '<div class="usd_price"><span class="value">' . $product_item[ 'retail_price' ] . '</span>';
                                  echo '&nbsp;<span class="usd">$</span>';
                                } else {
                                  echo '<div class="usd_price"><span class="value">' . ( int )round( $product_item[ 'retail_price' ] * $usd_currency ) . '</span>';
                                  echo '&nbsp;<span class="usd">&#8381;</span>';
                                }
                                echo '</div>';
                                if ( $usd_currency ) {
                                  if ( intval( $product_item[ 'show_rub_po_kursu_usd' ] ) != 1 ) {
                                    ?>
                          <div class="rub_price"><? echo intval($product_item['retail_price'] * $usd_currency); ?> &#8381; </div></div>
                          <?
                          }
                          }
                          break;
                          case 'RUR':
                            if ( $usd_currency ) {
                              ?>
                          <?
                          if ( $product_item[ 'action_price' ] > 0 ) {
                            echo '<span class="act_price"><span class="value">' . $product_item[ 'action_price' ] . '</span>';
                            echo '&nbsp;<span class="usd">&#8381;</span></span>';
                          }
                          } else {
                            echo $product_item[ 'retail_price' ] . ' <span class="rub">&#8381;</span>';
                          }
                          ?>
                          <span><span class="value"><? echo intval($product_item['retail_price']); ?>&nbsp;&#8381;</span> </span>
                          <?
                          break;
                          }
                          } else {
                            echo '<span class="no_price series_products__button" data-rel-model="' . $product_item[ 'model' ] . '" @click="open_form_require_price"><i class="fa-solid fa-comment-dollar"></i>&nbsp;Запросить цену</span>';
                            if ( isset( $_COOKIE[ "dev_mode" ] )and $_COOKIE[ "dev_mode" ] > 0 ) {
                              echo '<span class="show_in_dev_mode">' . $product_item[ 'retail_price' ] . '</span>';
                            }
                          }
                          ?>
                        
                        </div>
                        </div>
                      </div>
                      <div class="indicator_availability">
                        <?
                        if ( ( $product_item[ 'onstock_spb' ] ) > 0 ) {
                          echo '<span style="color:#00ad61"><i class="fa-solid fa-check"></i>&nbsp;В&nbsp;наличии</span> ';
                        } else {
                          echo '<span class="red"><i class="fa-solid fa-clipboard-check"></i>&nbsp;Под&nbsp;заказ </span>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="buttons_panel">
                    <div class="buttons_add">
                      <div title="Добавить в сравнение" class="series_products__button compare butt fa-solid fa-align-right fa-rotate-90" @click="add_too_box" data-model="<?= $product_item["model"]; ?>" data-box="compare"></div>
                      <div title="Добавить в избранное" class="series_products__button favorites butt fa-regular fa-heart" @click="add_too_box" data-model="<?= $product_item["model"]; ?>" data-box="favorites"></div>
                    </div>
                    <button title="Добавить в заказ" class="series_products__button cart" @click="add_too_box"
                                data-model="<?= $product_item["model"]; ?>" data-box="cart"><i class="fa-solid fa-cart-plus" style="font-size: 20px"></i><span style="position: relative;top: -1px; font-size: 18px;">&nbsp;&nbsp;&nbsp;В&nbsp;ЗАКАЗ</span></button>
                  </div>
                </div>
                <?  //////////////////////////////////////////////////////////////////////////// ?>
              </div>
              <?
              endforeach;
              ?>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const link = document.getElementById('discounted-link');
    const discountedWrapper = document.getElementById('discounted-wrapper');

    if (link && discountedWrapper) { // Полезная проверка на существование элементов
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const offset = 150;
            const elementPosition = discountedWrapper.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        });
    }
});
</script>
<?
CoreApplication::include_component( array( "component" => "form_require_price", "template" => "default", ) );
?>
