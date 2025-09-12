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
if ( isset( $_GET[ 'search' ] )and $_GET[ 'search' ] != "" ) {
  $search_text = $search_text_orig = strip_tags( $_GET[ 'search' ] );
  $arr_sinonims = CoreApplication::get_rows_from_table( 'search_sinonim', "", "" );
  $sinonims = $arr_sinonims[ 0 ][ 'sinonim' ];
  //file_put_contents('syn.txt',$sinonims);
  // Разбиваем строку на отдельные строки
  $lines = explode( ",\n", trim( $sinonims ) );
  // Инициализируем пустой массив для хранения синонимов
  $synonyms = [];
  foreach ( $lines as $line ) {
    // Убираем лишние пробелы и разделители в строке
    $parts = array_map( 'trim', explode( "=", $line ) );

    // Добавляем пару ключ-значение в массив синонимов
    $synonyms[ $parts[ 0 ] ] = $parts[ 1 ];
  }
  // Преобразуем массив в JSON для наглядности
  //echo json_encode($synonyms, JSON_PRETTY_PRINT);
  // Функция замены запроса на синонимы
  function replaceSynonyms( $query, $synonyms ) {
    // Приводим строку к нижнему регистру для нечувствительности к регистру
    $query = strtolower( $query );

    // Проверяем, есть ли синоним для данного запроса
    if ( isset( $synonyms[ $query ] ) ) {
      return $synonyms[ $query ]; // Возвращаем значение синонима
    }

    return $query; // Если синонима нет, возвращаем исходный запрос
  }
  // Пример использования
  $search_text = replaceSynonyms( $search_text, $synonyms ); // Заменяем на синоним

  $arr_search_words = search_string_to_array( $search_text );
  $extra_h1 = ": &laquo;" . $search_text_orig . "&raquo;";
}
if ( isset( $arr_search_words )and is_array( $arr_search_words )and count( $arr_search_words ) > 0 ) {
  global $arr_catalog_types;
  $arr_all_catalog_types = CoreApplication::get_rows_from_table( 'catalog_types', "", "" );


  foreach ( $arr_all_catalog_types as $type ) {
    $arr_catalog_types[ $type[ 'code' ] . $type[ 'series' ] ] = $type[ "template_h1" ];
  }
  $arrResult = search_by_words( $arr_search_words );
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
//$arrSections = CoreApplication::get_rows_from_table("catalog_sections", '', "active='1'", "position ASC");
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
				//file_put_contents('arrResult_texts.txt', json_encode($arrResult_texts, JSON_PRETTY_PRINT));
// Фильтруем и приводим даты к единому формату Y-m-d H:i:s
foreach ($arrResult_texts as &$item) {
    if (!isset($item['date'])) continue; // Пропускаем элементы без даты
    $date = trim($item['date']); // Удаляем пробелы
    if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}(?: \d{2}:\d{2}:\d{2})?$/', $date)) {
        unset($item['date']); // Удаляем неправильные даты
        continue;
    }
    // Добавляем недостающие части даты (если отсутствуют часы/минуты/секунды)
    if (strlen($date) <= 10) {
        $date .= ' 00:00:00'; // Стандартизация формата даты
    }
    $item['date'] = $date;
}
unset($item); // Освобождаем ссылку

// Сортируем массив по дате в обратном порядке
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
