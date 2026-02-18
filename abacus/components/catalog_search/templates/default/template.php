<?php
CoreApplication::add_style( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/style.css" );
CoreApplication::add_script( str_replace( $_SERVER[ "DOCUMENT_ROOT" ], "", __DIR__ ) . "/script.js" );
global $H1, $TITLE;
global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';
/*!!!!!!!!!!!!!!!!!!!!!!*/
require "inc_functions.php";
/*!!!!!!!!!!!!!!!!!!!!!!*/
$extra_h1 = '';
function myStrToLower($string) {
    $upperCaseRu = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'];
    $lowerCaseRu = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];

    return str_replace($upperCaseRu, $lowerCaseRu, $string);
}
if (isset($_GET['search']) && $_GET['search'] != "") {
  $search_text = strip_tags($_GET['search']);
  $search_text = $search_text_orig = myStrToLower($search_text);
  
  $vesa_filter = false;
  if (isset($_GET['vesa']) && $_GET['vesa'] == 'yes') {
      $vesa_filter = true;
  }

  $arr_sinonims = CoreApplication::get_rows_from_table('search_sinonim', '', '');
  $sinonims = $arr_sinonims[0]['sinonim'];

  $lines = explode(",\n", trim($sinonims));

  $synonyms = [];

  foreach ($lines as $line) {
    $parts = array_map('trim', explode("=", $line));
    
    $key = strtolower($parts[0]);
    $value = strtolower($parts[1]);

    $synonyms[$key] = $value;
  }

  function replaceSynonyms($query, $synonyms) {
    $query_lower = strtolower($query);

    if (isset($synonyms[$query_lower])) {
      return $synonyms[$query_lower];
    }

    return $query;
  }

  $search_text = replaceSynonyms($search_text, $synonyms);

  $arr_search_words = search_string_to_array($search_text);
  $extra_h1 = ": «" . $search_text_orig . "»";
}
if ( isset( $arr_search_words )and is_array( $arr_search_words )and count( $arr_search_words ) > 0 ) {
  global $arr_catalog_types;
  $arr_all_catalog_types = CoreApplication::get_rows_from_table( 'catalog_types', "", "" );


  foreach ( $arr_all_catalog_types as $type ) {
    $arr_catalog_types[ $type[ 'code' ] . $type[ 'series' ] ] = $type[ "template_h1" ];
  }

  $arrResult = search_by_words($arr_search_words, $vesa_filter);
  
  if (isset($_GET['vesa']) && $_GET['vesa'] == 'yes') {
      global $mysqli_db;
      
      $sql = "SELECT * FROM products_all 
              WHERE parent='' 
              AND status!='0' 
              AND (vesa75 IS NOT NULL AND vesa75 != '' 
                   OR vesa100 IS NOT NULL AND vesa100 != '')";
      
      $result = mysqli_query($mysqli_db, $sql);
      
      if ($result) {
          $existing_indices = array();
          foreach ($arrResult as $item) {
              $existing_indices[] = $item['index'];
          }
          
          while ($row = mysqli_fetch_assoc($result)) {
              if (!in_array($row['index'], $existing_indices)) {
                  if (empty($row['model_fullname'])) {
                      global $arr_catalog_types;
                      if (isset($arr_catalog_types[$row['type'] . $row['series']])) {
                          $name = $arr_catalog_types[$row['type'] . $row['series']];
                          $name = str_replace("#brand#", $row['brand'], $name);
                          $name = str_replace("#model#", $row['model'], $name);
                          if (isset($row['diagonal']) && $row['diagonal'] > 0 && $row['diagonal_hide'] != '1') {
                              $name = str_replace("#diagonal#", $row['diagonal'], $name);
                          } else {
                              $name = str_replace("#diagonal#", '', $name);
                          }
                          $row['model_fullname'] = $name;
                      }
                  }
                  $row['freqs'] = 500;
                  $arrResult[] = $row;
              }
          }
          mysqli_free_result($result);
      }
  }
  
  if (isset($_GET['interfaces']) && $_GET['interfaces'] == 'wifi') {
      global $mysqli_db;
      
      $sql = "SELECT * FROM products_all 
              WHERE parent='' 
              AND status!='0' 
              AND (wifi IS NOT NULL AND wifi != '' AND wifi != '0')";
      
      $result = mysqli_query($mysqli_db, $sql);
      
      if ($result) {
          $existing_indices = array();
          foreach ($arrResult as $item) {
              $existing_indices[] = $item['index'];
          }
          
          while ($row = mysqli_fetch_assoc($result)) {
              if (!in_array($row['index'], $existing_indices)) {
                  if (empty($row['model_fullname'])) {
                      global $arr_catalog_types;
                      if (isset($arr_catalog_types[$row['type'] . $row['series']])) {
                          $name = $arr_catalog_types[$row['type'] . $row['series']];
                          $name = str_replace("#brand#", $row['brand'], $name);
                          $name = str_replace("#model#", $row['model'], $name);
                          if (isset($row['diagonal']) && $row['diagonal'] > 0 && $row['diagonal_hide'] != '1') {
                              $name = str_replace("#diagonal#", $row['diagonal'], $name);
                          } else {
                              $name = str_replace("#diagonal#", '', $name);
                          }
                          $row['model_fullname'] = $name;
                      }
                  }
                  $row['freqs'] = 500;
                  $arrResult[] = $row;
              }
          }
          mysqli_free_result($result);
      }
  }
  
  usort($arrResult, function($a, $b) {
      $a_discontinued = isset($a['discontinued']) && $a['discontinued'] == 1 ? 1 : 0;
      $b_discontinued = isset($b['discontinued']) && $b['discontinued'] == 1 ? 1 : 0;
      
      if ($a_discontinued != $b_discontinued) {
          return $a_discontinued - $b_discontinued;
      }
      
      $a_freqs = isset($a['freqs']) ? $a['freqs'] : 0;
      $b_freqs = isset($b['freqs']) ? $b['freqs'] : 0;
      
      if ($a_freqs == $b_freqs) {
          return 0;
      }
      return ($a_freqs > $b_freqs) ? -1 : 1;
  });
  
  $arrResult_texts = search_by_words_texts( $arr_search_words );
  if ( count( $arrResult ) == 0 ) {
    $extra_h1 = '';
  }
}
$H1 = "Поиск" . $extra_h1;
$TITLE = "Поиск по сайту www.rusavtomatika.com";
if ( isset( $search_text )and $search_text != "" ) {
  $TITLE = "Поиск - &laquo;" . $search_text . "&raquo; - www.rusavtomatika.com";
}
CoreApplication::add_breadcrumbs_chain( $H1 );
?>
<div class="component_catalog_search" id="vue_app_component_catalog_search">
  <div class="component_wrapper">
    <?
    CoreApplication::include_component( array( "component" => "breadcrumbs" ) );
    ?>
    <?php
    ?>
    <h1>
      <?= $H1 ?>
    </h1>
    <div class="view-mode-list">
      <div class="catalog_search__results">
        <?
        if ( ( isset( $arrResult )and is_array( $arrResult )and count( $arrResult ) > 0 )or( isset( $arrResult_texts )and is_array( $arrResult_texts )and count( $arrResult_texts ) > 0 ) ) {
          $count_products = count( $arrResult );
          $count_texts = count( $arrResult_texts );
          if ( $count_products > 0 and $count_texts > 0 ) {
            $two_columns = true;
          } else $two_columns = false;
          if ( $two_columns ) {
            ?>
        <div class="columns ">
          <div class="column is-half">
            <h2>Каталог</h2>
            <?
            }
            if ( $count_products > 0 ) {
              ?>
            <table class="series_products  <? if ($two_columns) {
                            echo "in_two_cols";
                        } ?>">
              <?
              global $product;
              foreach ( $arrResult as $product ) {
                include "inc_template_result_item.php";
              }
              ?>
            </table>
            <?
            }
            if ( $two_columns ) {
              ?>
          </div>
          <div class="column is-half">
            <h2>Текстовые материалы</h2>
            <?
            }
            global $article;
            if ( count( $count_texts ) > 0 ) {
              ?>
            <table class="series_products">
              <tr class="separator">
                <td colspan="2"></td>
              </tr>
              <?
foreach ($arrResult_texts as &$item) {
    if (!isset($item['date'])) continue;
    $date = trim($item['date']);
    if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}(?: \d{2}:\d{2}:\d{2})?$/', $date)) {
        unset($item['date']);
        continue;
    }
    if (strlen($date) <= 10) {
        $date .= ' 00:00:00';
    }
    $item['date'] = $date;
}
unset($item);

usort($arrResult_texts, function ($a, $b) {
    if (!isset($a['date']) || !isset($b['date'])) return 0;
    return strcmp($b['date'], $a['date']);
});
				
				
				foreach ( $arrResult_texts as $article ) {
                include "inc_template_result_item_article.php";
              }
              ?>
            </table>
            <?
            }
            if ( $two_columns ) {
              ?>
          </div>
        </div>
        <?
        }
        } else {
          if ( isset( $search_text )and $search_text != "" ) {
            ?>
        <h2>По запросу
          <?= ": &laquo;" . $search_text . "&raquo;" ?>
          ничего не найдено...</h2>
        <?
        } else {
          ?>
        <h2>Введите текст для поиска...</h2>
        <?
        }
        }
        ?>
      </div>
    </div>
  </div>
</div>