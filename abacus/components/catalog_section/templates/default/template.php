<?php
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
global $arrSection;
$sections = CoreApplication::get_rows_from_table( "`catalog_sections`" );
$arrSection = CoreApplication::get_rows_from_table( "catalog_sections", "", "`is_main_item`='1' and `code`='" . $arguments[ "component_route_params" ][ "section" ] . "'" )[ 0 ];

global $TITLE;
global $H1;
global $DESCRIPTION;
global $H1_original;
global $TITLE_original;
global $SEO_URL;
global $UPPER_SEO_TEXT, $LOWER_SEO_TEXT, $pretext, $posttext;

$currentSectionCode = $arguments["component_route_params"]["section"];

$products = CoreApplication::get_rows_from_table(
    "products_all", 
    "", 
    "`type` = 'monitor'"
);

$uniqueDiagonals = array();

if (!empty($products) && is_array($products)) {
    foreach ($products as $product) {
        if (isset($product['diagonal']) && $product['diagonal'] > 0) {
            $diag = (float)$product['diagonal'];
            $uniqueDiagonals[(string)$diag] = $diag;
        }
    }
}

if (empty($uniqueDiagonals)) {
    $groupedDiagonals = array();
} else {
    $uniqueDiagonals = array_values($uniqueDiagonals);
    sort($uniqueDiagonals, SORT_NUMERIC);
    
    $groupedDiagonals = array();
    foreach ($uniqueDiagonals as $value) {
        $groupedDiagonals[] = array(
            'value' => $value,
            'label' => $value
        );
    }
}

if ( isset( $TITLE_original )and $TITLE_original != "" ) {
  $TITLE = $TITLE_original;
} else $TITLE = $arrSection[ "title" ];
$do_not_add_extra_h1 = false;

if ( isset( $H1_original )and $H1_original != "" ) {
  $H1 = $H1_original;
  $do_not_add_extra_h1 = true;
} elseif ( $arrSection[ "h1" ] != "" ) {
  $H1 = $arrSection[ "h1" ];
} else $H1 = $arrSection[ "name" ];
if ( $arrSection[ "description" ] != "" ) {
  $DESCRIPTION = $arrSection[ "description" ];
}

if ( !$do_not_add_extra_h1 ) {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  include "inc_handle_h1.php";
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

//CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
if ( isset( $arrSection[ "name_breadcrumbs" ] )and $arrSection[ "name_breadcrumbs" ] != '' ) {
  $breadcrumbs_name = $arrSection[ "name_breadcrumbs" ];
} else $breadcrumbs_name = $arrSection[ "name" ];

CoreApplication::add_breadcrumbs_chain( $breadcrumbs_name );

//var_dump_pre($arrSection["product_sort"]);

$arr_product_sort = [];


if ( $arrSection[ "product_sort" ] != "" ) {
  $arr_product_sort = explode( ",", $arrSection[ "product_sort" ] );
}

//var_dump_pre($arr_product_sort);
$HTTP_REFERER = $_SERVER[ "REQUEST_URI" ];

$HTTP_REFERER = str_replace( "https://www.rusavto.moisait.net", "", $HTTP_REFERER );
$HTTP_REFERER = str_replace( "https://www.rusavtomatika.com", "", $HTTP_REFERER );
$HTTP_REFERER = str_replace( "https://www.test.rusavtomatika.com", "", $HTTP_REFERER );
if ( $HTTP_REFERER != "" ) {
  global $H1, $TITLE, $DESCRIPTION, $KEYWORDS, $CANONICAL, $UPPER_SEO_TEXT, $LOWER_SEO_TEXT;
  global $H1_original;
  global $TITLE_original;
  global $SEO_URL;

  $url = $HTTP_REFERER;
	//$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
	$url = preg_replace('/[&\?]*ysclid=[^&]+/', '', $url);

?>
  <?
  global $extra_openGraph;
  if ( isset( $arrSection[ "preview_picture" ] )and $arrSection[ "preview_picture" ] != "" ) {
    $extra_openGraph = array(
      "openGraph_image" => $arrSection[ "preview_picture" ],
      "openGraph_title" => $arrSection[ "title" ],
      "openGraph_description" => $arrSection[ "description" ],
      "openGraph_siteName" => "Русавтоматика - поставка оборудования для автоматизации",
    );
  }
  CoreApplication::include_component( array( "component" => "breadcrumbs" ) );
  ?>
  <div id="vue_component_catalog_section" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="component_catalog_section">
      <div class="component_wrapper">
        <? /*?>
<div class="row">
  <div class="col-md-12">
    <div class="component_catalog_section__tags">
      <h3>Тэги</h3>
    </div>
  </div>
</div>
        <?*/ ?>
        <div class="columns is-gapless">
          <div class="is-hidden-touch column is-2-desktop column_filter is-narrow" style="min-width: 250px">
            <?
            $arguments[ "template" ] = "default";
            $arguments[ "component" ] = "catalog_filter";
            $arguments[ "section" ] = $arrSection;
            //$arguments["filter_items"] = $arrSection["filters"];
            CoreApplication::include_component( $arguments );
            ?>
         </div>
          <div class=" column is-10-desktop is-12-tablet column_content">
            <?
            if ( $arrSection[ "code" ] == "vpn_routers" ) {
              include $_SERVER[ "DOCUMENT_ROOT" ] . "/include_utf_8/widgets/inc_no_ewon.php";
            }
            /////////////////
            $all_series = CoreApplication::get_rows_from_table( 'catalog_series', '', "active = '1'", 'position' );
            ////////////////////			

            global $H1_original;
            global $TITLE_original;
            $row = CoreApplication::get_rows_from_table( 'seo', '', "url = '$url'", '', '1' );
            if ( isset( $row[ 0 ] ) ) {
              $seo_data = $row[ 0 ];
              if ( $seo_data[ "active" ] == "1" ) {
                if ( isset( $seo_data[ "UPPER_SEO_TEXT" ] ) ) {
                  $pretext = $seo_data[ "UPPER_SEO_TEXT" ];
                }
                if ( isset( $seo_data[ "LOWER_SEO_TEXT" ] ) ) {
                  $posttext = $seo_data[ "LOWER_SEO_TEXT" ];
                }
              }
            }
            ?>
            <h1 class="title" v-cloak>
                <?php
                $special_filters = [
                    'remote_control_phone' => 'Панели оператора (Удаленное управление с телефона)',
                    'personnel_access_control' => 'Панели оператора (Контроль доступа для персонала)',
                    'sending_by_email' => 'Панели оператора (Отправка сообщений на почту)',
                    'with_database' => 'Панели оператора (Панель с базой данных на SQL-сервере)'
                ];
                
                $found = false;
                if (isset($_GET['interfaces'])) {
                    $interfaces = explode(',', $_GET['interfaces']);
                    foreach ($interfaces as $interface) {
                        if (isset($special_filters[$interface])) {
                            echo $special_filters[$interface];
                            $found = true;
                            break;
                        }
                    }
                }
                
                if (!$found) {
                    echo $H1;
                }
                ?>
            </h1>
            <?
            if ( isset( $pretext )and $pretext != "" ) {
              ?>
            <div class="pretext">
              <?= $pretext ?>
            </div>
            <?
            }
            include "inc_weintek_info.php";
            ?>
            <!--meta name="original_h1" content="<?= $H1_original ?>"--> 
            <!--meta name="original_title" content="<?= $TITLE_original ?>"-->
            <noindex>
              <div class="panel_chosen_filters"
                         v-if="filterSelectedBrands.length > 0
                         || filterSelectedSeries != ''
                         || filterSelectedInterfaces.length > 0
                         || filterSelectedCodesys
                         || filterSelectedVesa
                         || filterSelectedSdcard
                         || filterSelectedCmtviewer
                         || filterSelectedWebView
                         || filterSelectedpoe
                         || filterSelectedScreenless
                         || filterSelectedPlcWebBrowser
                         || filterSelectedCameraIP
                         || filterSelectedCameraUSB
                         || filterSelectedOss.length > 0
                         || filterSelectedResolutions.length > 0
                         || filterSelectedProcessors.length > 0
                         || filterSelectedAvailablity > 0
                         || filterSelectedSensorType  != ''
                         || filterSelectedPlast
                         || filterSelectedPlastAlum
                         || filterSelectedAlum
                         || filterSelectedRangePrice_min > 0
                         || filterSelectedRangePrice_max < filterSelectedRangePrice_max_start
                         || filterSelectedRangeDiagonal_min > filterSelectedRangeDiagonal_min_start
                         || filterSelectedRangeDiagonal_max < filterSelectedRangeDiagonal_max_start
                         || filterSelectedRangerammax_min > filterSelectedRangerammax_min_start
                         || filterSelectedRangerammax_max < filterSelectedRangerammax_max_start
                         || filterSelectedRangeCOM_min > filterSelectedRangeCOM_min_start
                         || filterSelectedRangeCOM_max < filterSelectedRangeCOM_max_start
                         || filterSelectedRangeEthernets_min > filterSelectedRangeEthernets_min_start
                         || filterSelectedRangeEthernets_max < filterSelectedRangeEthernets_max_start
                         || filterSelectedRangeUSB_min > filterSelectedRangeUSB_min_start
                         || filterSelectedRangeUSB_max < filterSelectedRangeUSB_max_start"
                         v-cloak> <span class="item"><span class="clear_all">очистить фильтры <span
                                                                 @click="clear_filter_item('all','')"
                                                                 class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedSeries != ''"><span>серия: <b>{{filterSelectedSeries}}</b> <span
                                        @click="clear_filter_item('filterSelectedSeries','')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedBrands.length > 0"><span
                                    v-for="brand in filterSelectedBrands">бренд: <b>{{ brand }}</b> <span
                                        @click="clear_filter_item('filterSelectedBrands',brand)"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedCodesys"><span>Codesys <span
                                        @click="clear_filter_item('filterSelectedCodesys')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedVesa"><span>VESA <span
                                        @click="clear_filter_item('filterSelectedVesa')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedSdcard"><span>SD-карта <span
                                        @click="clear_filter_item('filterSelectedSdcard')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedCmtviewer"><span>CMT Viewer <span
                                        @click="clear_filter_item('filterSelectedCmtviewer')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedWebView"><span>WebView <span
                                        @click="clear_filter_item('filterSelectedWebView')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedpoe"><span>POE <span
                                        @click="clear_filter_item('filterSelectedpoe')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedScreenless"><span>Безэкранные <span
                                        @click="clear_filter_item('filterSelectedScreenless')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedPlcWebBrowser"><span>PLC Web-Browser <span
                                        @click="clear_filter_item('filterSelectedPlcWebBrowser')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedCameraIP"><span>IP-камера <span
                                        @click="clear_filter_item('filterSelectedCameraIP')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedCameraUSB"><span>USB-камера <span
                                        @click="clear_filter_item('filterSelectedCameraUSB')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedOss.length > 0"><span
                                    v-for="Os in filterSelectedOss">ОС: <b>{{ Os }}</b> <span
                                        @click="clear_filter_item('filterSelectedOss',Os)"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedInterfaces.length > 0"><span
                                    v-for="Interface in filterSelectedInterfaces">интерфейс: <b>{{ Interface }}</b> <span
                                        @click="clear_filter_item('filterSelectedInterfaces',Interface)"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedResolutions.length > 0"><span
                                    v-for="Resolution in filterSelectedResolutions">разрешение: <b>{{ Resolution }}</b> <span
                                        @click="clear_filter_item('filterSelectedResolutions',Resolution)"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedProcessors.length > 0"><span
                                    v-for="Processor in filterSelectedProcessors">процессор: <b>{{ Processor }}</b> <span
                                        @click="clear_filter_item('filterSelectedProcessors',Processor)"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedAvailablity > 0"><span>доступность: <b
                                        v-if="filterSelectedAvailablity == 1">В наличии</b><b
                                        v-if="filterSelectedAvailablity == 2">Под заказ</b> <span
                                        @click="clear_filter_item('filterSelectedAvailablity','')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedSensorType!=''"><span>тип сенсора: <b
                                        v-if="filterSelectedSensorType == 'resistive'">Резистивный</b><b
                                        v-if="filterSelectedSensorType == 'capacitive'">Емкостный</b> <span
                                        @click="clear_filter_item('filterSelectedSensorType','')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedPlast"><span>Пластик <span
                                        @click="clear_filter_item('filterSelectedPlast')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedAlum"><span>Алюминий <span
                                        @click="clear_filter_item('filterSelectedAlum')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedPlastAlum"><span>Пластик+Металл <span
                                        @click="clear_filter_item('filterSelectedPlastAlum')"
                                        class="button_clear_filter"> </span></span></span> <span class="item" v-if="filterSelectedRangePrice_min > 0"><span>цена от: <b>{{ filterSelectedRangePrice_min }} $</b> <span
                                        @click="clear_filter_item('filterSelectedRangePrice_min','')"
                                        class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedRangePrice_max < filterSelectedRangePrice_max_start"><span>цена до: <b>{{ filterSelectedRangePrice_max }} $</b> <span
                                        @click="clear_filter_item('filterSelectedRangePrice_max','')"
                                        class="button_clear_filter"> </span></span></span> 
                
                <!--span class="item"
                              v-if="filterSelectedRangeDiagonal_min > filterSelectedRangeDiagonal_min_start"><span>диагональ от: <b>{{ filterSelectedRangeDiagonal_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeDiagonal_min', '')"
                                        class="button_clear_filter"> </span></span></span>
                        <span-- class="item"
                              v-if="filterSelectedRangeDiagonal_max < filterSelectedRangeDiagonal_max_start"><span>диагональ до: <b>{{ filterSelectedRangeDiagonal_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeDiagonal_max', '')"
                                        class="button_clear_filter"> </span></span></span--> 
                
                <span class="item"
                              v-if="filterSelectedRangeEthernets_min > filterSelectedRangeEthernets_min_start"><span>количество Ethernet от: <b>{{ filterSelectedRangeEthernets_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeEthernets_min', '')"
                                        class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedRangeEthernets_max < filterSelectedRangeEthernets_max_start"><span>количество Ethernet до: <b>{{ filterSelectedRangeEthernets_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeEthernets_max', '')"
                                        class="button_clear_filter"> </span></span></span> 
				
                <span class="item"
                              v-if="filterSelectedRangeCOM_min > filterSelectedRangeCOM_min_start"><span>количество COM-портов от: <b>{{ filterSelectedRangeCOM_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeCOM_min', '')"
                                        class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedRangeCOM_max < filterSelectedRangeCOM_max_start"><span>количество COM-портов до: <b>{{ filterSelectedRangeCOM_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeCOM_max', '')"
                                        class="button_clear_filter"> </span></span></span> 
				
                <span class="item"
                              v-if="filterSelectedRangerammax_min > filterSelectedRangerammax_min_start"><span>max Размер ОЗУ от: <b>{{ filterSelectedRangerammax_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangerammax_min', '')"
                                        class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedRangerammax_max < filterSelectedRangerammax_max_start"><span>max Размер ОЗУ до: <b>{{ filterSelectedRangerammax_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangerammax_max', '')"
                                        class="button_clear_filter"> </span></span></span> 
				
                <span class="item"
                              v-if="filterSelectedRangeUSB_min > filterSelectedRangeUSB_min_start"><span>количество USB от: <b>{{ filterSelectedRangeUSB_min }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeUSB_min', '')"
                                        class="button_clear_filter"> </span></span></span> <span class="item"
                              v-if="filterSelectedRangeUSB_max < filterSelectedRangeUSB_max_start"><span>количество USB до: <b>{{ filterSelectedRangeUSB_max }}&Prime;</b> <span
                                        @click="clear_filter_item('filterSelectedRangeUSB_max', '')"
                                        class="button_clear_filter"> </span></span></span> </div>
				
				<? if ($arrSection[ 'filter_brands' ] != 'NO_BRANDS' && $arrSection[ 'code' ] != 'industrial-computers') {?>
              <div class="is-hidden-touch is-size-12" style="margin-left: 30px;line-height: 45px;">Серии:
                <?
                //$all_series = get_all_series();
                //print_r($all_series);
                $sub0 = $arrSection[ 'subsection_brands' ];
			  if (preg_match('/,/',$sub0)) {
                $arr_section_sub = explode( ",", $sub0 );
			  } else {
				  $arr_section_sub[] = $sub0;
			  }
                if ( count( $arr_section_sub ) >= 1 ) {
                  foreach ( $arr_section_sub as $section_sub ) {
                    ?>
                <a class="button is-dark is-small" title="Производитель <?= $section_sub ?>" href="<?= $arrSection["category_link"].'?&brand='.$section_sub ?>">
                <?= $section_sub ?>
                </a> :
                <?
                foreach ( $all_series as $i => $all_serie ) {
					$pattern = '/('.$all_serie["type"].')/i';
                  if ( $all_serie[ 'menu_category_item_code' ] == $arrSection[ "code" ] && $all_serie[ 'brand' ] == $section_sub && (preg_match($pattern,$arrSection["product_types"] ) == 1)) {
                  //if ( $all_serie[ 'menu_category_item_code' ] == $arrSection[ "code" ] && $all_serie[ 'brand' ] == $section_sub) {
                    echo '<a class="button is-small mr-1 is-uppercase" href="/catalog/' . $all_serie[ 'menu_category_item_code' ] . '/?&series=' . $all_serie[ 'name' ] . '" title="' . $all_serie[ 'name_russian' ] . '">' . $all_serie[ 'name' ] . '</a>';
                  }
                }
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                } ?>
				<div id="inc_srav" class="is-hidden" style="display: inline-block"><a href="/weintek-stavnenie-seriy/"><span class="section_list__set_availablity__button seo_buttons" style="top: -8px; position: relative;">Таблица сравнения всех серий Weintek</span></a></div>
				<div id="inc_srav_spik" class="is-hidden" style="display: inline-block"><a href="/srav_spiktek_weintek.php"><span class="section_list__set_availablity__button seo_buttons" style="top: -8px; position: relative;">Таблица сравнения Weintek iP и СПИКТЕК СТК</span></a></div>
              <? echo '</div>';
}
                ?>
				
              <div class="section_list_view_mode_button_wrapper" v-cloak>
                <div class="is-hidden-desktop button is-success  is-small button_open_filter"> <span class="button_open_filter__icon"></span> <span class="button_open_filter___text">Фильтры</span> </div>
                <div class="is-hidden-touch is-hidden-desktop-only111 section_list__set_diagonal_span" v-if="section_list__set_diagonal_span_show">
                  <div class="is-size-7">Диагональ</div>
                  <div class="elements">
                      <?php if (!empty($groupedDiagonals)): ?>
                          <?php foreach ($groupedDiagonals as $diag): ?>
                              <span 
                                  v-bind:class="['section_list__set_diagonal_span__button', 
                                      {'active': filterSelectedDiagonals.indexOf(<?= $diag['value'] ?>) !== -1}]" 
                                  @click="toggleDiagonalFilter(<?= $diag['value'] ?>, '', $event)">
                                  <?= $diag['value'] ?>" 
                              </span>
                          <?php endforeach; ?>
                      <?php endif; ?>
                      
                      <span 
                          v-bind:class="['section_list__set_diagonal_span__button clear_button', 
                              {'active': filterSelectedDiagonals.length === 0}]" 
                          @click="clearDiagonalFilters()">
                      </span>
                  </div>
                </div>
                <div class="is-hidden-touch section_list__set_availablity"
                             v-if="section_list__set_availability_show">
                  <div class="is-size-7">Наличие</div>
                  <div class="elements "> <span v-bind:class="['section_list__set_availablity__button is-size-7' , {'active': (filterSelectedAvailablity == '1')} ]"
                                  @click="change_availablity" style="white-space: nowrap;">На складе</span> </div>
                </div>
                <? if (count($arr_product_sort) > 0): ?>
                <div class="section_list_view_sort">
                  <div class="is-size-7 is-hidden-touch ">Сортировка</div>
                  <div class="elements">
                    <select v-model="product_sort" @change="change_view_sort">
                      <?
                      $arr_product_sort_names = [
                        "recommended" => 'рекомендуемые',
                        "new" => 'по новизне',
                        "popular" => 'по популярности',
                        "series" => 'по сериям',
                        "diagonal_small" => 'меньше диагональ',
                        "diagonal_big" => 'больше диагональ',
                        "price_small" => 'меньше цена',
                        "price_big" => 'больше цена',
                      ];
                      foreach ( $arr_product_sort as $item ) {
                        echo '<option value="' . $item . '">' . $arr_product_sort_names[ $item ] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <? endif; ?>
                <div class="section_list_view_mode is-hidden-touch ">
                  <div class="is-size-7">Вид</div>
                  <div class="elements"> <span v-bind:class="['section_list_view_mode_button button_view_mode_list' , {'active': (view_mode == 'list')} ]" @click="change_view_mode('list')"></span> 
                    <!--span v-bind:class="['section_list_view_mode_button button_view_mode_table' , {'active': (view_mode == 'table')} ]" @click="change_view_mode('table')"></span> 
                  <span v-bind:class="['section_list_view_mode_button button_view_mode_tiles' , {'active': (view_mode == 'tiles')} ]" @click="change_view_mode('tiles')"></span--> 
                    <span v-bind:class="['section_list_view_mode_button button_view_mode_tiles' , {'active': (view_mode == 'tile')} ]" @click="change_view_mode('tile')"></span>
                    <? /*?><span class="section_list_view_mode_button button_view_mode_tiles"></span><?*/ ?>
                  </div>
                </div>
                <?
                global $usd_currency;
                if ( isset( $usd_currency )and $usd_currency > 0 ): ?>
                <div class="section_list_currency_block is-hidden-touch ">
                  <div class="is-size-7">Курс</div>
                  <div class="has-text-weight-normal is-size-7" style="white-space: nowrap;">
                    <?
                    echo "1$ = " . $usd_currency . " ₽";
                    ?>
                  </div>
                </div>
                <? endif; ?>
                <!--div class="filter_string" v-html="filter_string"></div--> 
              </div>
            </noindex>
            <div class="component_catalog_section__panel_of_products_wrapper">
              <div class="component_catalog_section__panel_of_products" v-html="html_filtered_products" >
                <?
                include "catalog_section_products.php";
                ?>
              </div>
            </div>
            <?
            if ( isset( $posttext )and $posttext != "" ) {
              ?>
            <div class="posttext p-5">
              <?= $posttext ?>
            </div>
            <?
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="result" v-html="result"></div>
    <div class="component_catalog_section__bottom_of_list"></div>
    <div style="display: none" class="vue-data"> <span class="current_section" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span> <span class="current_min_price" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span> <span class="current_max_price" data-value="<?= $arguments["component_route_params"]["section"] ?>"></span> <span class="filter_diagonal_min" data-value="<?= $arrSection["filter_diagonal_min"] ?>"></span> <span class="filter_diagonal_max" data-value="<?= $arrSection["filter_diagonal_max"] ?>"></span> <span class="filter_price_min" data-value="<?= $arrSection["filter_price_min"] ?>"></span> <span class="filter_price_max" data-value="<?= $arrSection["filter_price_max"] ?>"></span> <span class="filter_com_min" data-value="<?= $arrSection["filter_com_min"] ?>"></span> <span class="filter_com_max" data-value="<?= $arrSection["filter_com_max"] ?>"></span> <span class="filter_ethernets_min" data-value="<?= $arrSection["filter_ethernets_min"] ?>"></span> <span class="filter_ethernets_max" data-value="<?= $arrSection["filter_ethernets_max"] ?>"></span> <span class="filter_rammax_min" data-value="<?= $arrSection["filter_rammax_min"] ?>"></span> <span class="filter_rammax_max" data-value="<?= $arrSection["filter_rammax_max"] ?>"></span><span class="filter_USB_min" data-value="<?= $arrSection["filter_USB_min"] ?>"></span> <span class="filter_USB_max" data-value="<?= $arrSection["filter_USB_max"] ?>"></span> <span class="filter_processor" data-value="<?= $arrSection["filter_processors"] ?>"></span> </div>
  </div>
  <?
  CoreApplication::include_component( array( "component" => "form_require_price", "template" => "default", ) );
  ?>
