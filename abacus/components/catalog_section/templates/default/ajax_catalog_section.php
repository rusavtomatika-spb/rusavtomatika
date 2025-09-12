<?php

$_POST = json_decode( file_get_contents( 'php://input' ), true );


if ( !defined( 'ENCODING' ) ) {
  define( 'ENCODING', "UTF-8" );
}


header( 'Content-Type: text/html; charset=utf-8' );
if ( !defined( "SERVER_RENDERING" ) ) {
  ini_set( 'error_reporting', E_ALL && ~e_deprecated );
  ini_set( 'display_errors', 1 );
  ini_set( 'display_startup_errors', 1 );
  header( 'Content-Type: text/html; charset=utf-8' );
  define( "bullshit", 1 );
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
require_once "functions/inc_class_C_DB_WORK_CATALOG.php";
require_once "functions/inc_functions.php";
header( 'Content-Type: text/html; charset=utf-8' );
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
global $ajax_message;
$ajax_message = '';


global $arSettings;
$arSettings[ 'path_to_product_images' ] = '/images/';

global $usd_currency;
if ( file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/usdrate.txt" ) ) {
  $usd_currency = floatval( file_get_contents( $_SERVER[ "DOCUMENT_ROOT" ] . "/usdrate.txt" ) );
} else $usd_currency = 0;


global $mysqli_db;
global $db;
if ( !defined( "SERVER_RENDERING" ) ) {
  require_once $_SERVER[ "DOCUMENT_ROOT" ] . "/sc/dbcon.php";
  database_connect();
  mysqli_set_charset( $mysqli_db, "utf8" );
}
if ( !function_exists( 'var_dump_pre' ) ) {
  function var_dump_pre( ... $values ) {
    foreach ( $values as $value ) {
      echo "<pre style='font-size: 12px;color: red;max-width: 1000px;overflow: scroll;padding: 10px;text-align: left;'>";
      var_dump( $value );
      echo "</pre>";
    }
  }
}


$DB_WORK_CATALOG = new C_DB_WORK_CATALOG( array( "current_section_code" => $_GET[ "section" ] ) );
ob_start();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ( isset( $_POST[ 'view_mode' ] )and $_POST[ 'view_mode' ] != "" ) {
  $view_mode = $_POST[ 'view_mode' ];
  //echo $view_mode;
} else $view_mode = 'list';
$sort_cookie_name = 'section_catalog_view_sort_' . $DB_WORK_CATALOG->get_section_by_code( $_GET[ "section" ] )[ 'code' ];
if ( isset( $_POST[ 'sort' ] )and $_POST[ 'sort' ] != "" ) {
  $sort_mode = $_POST[ 'sort' ];
} elseif ( isset( $_COOKIE[ $sort_cookie_name ] ) ) {
  $sort_mode = $_COOKIE[ $sort_cookie_name ];
} else {
  $sort_mode = 'recommended';
}


require_once "functions/inc_build_mysql_filter.php";
global $mysql_product_filter;
$ajax_message .= $mysql_product_filter;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ( isset( $_GET[ "section" ] )and $_GET[ "section" ] != "" ) {
  $arr_current_section = $DB_WORK_CATALOG->get_section_by_code( $_GET[ "section" ] );
  //echo '<pre>';
  //	var_dump($arr_current_section);
  //echo '</pre>';
  if ( $arr_current_section[ "products_selected_by_query" ] != "" ) {
    $sort_mode = "products_selected_by_query";
    $query = $arr_current_section[ "products_selected_by_query" ];
  }
}

///
///

switch ( $sort_mode ) {
  case "products_selected_by_query":
    $arr_products_result = array();
    $arr_products = array();
    $arr_products = $DB_WORK_CATALOG->get_products_by_query( $query );
    foreach ( $arr_products as $product ) {
      if ( $product[ "currency" ] == "RUR"
        and $usd_currency > 0 ) {
        $product[ "retail_price_usd" ] = intval( $product[ "retail_price" ] / $usd_currency );
      }
      $arr_products_result[] = $product;
    }

    print_product_list( $arr_products_result, $view_mode );
    break;
  case "price_small":
    $arr_products = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {
          if ( $product[ "currency" ] == "RUR"
            and $usd_currency > 0 ) {
            $product[ "retail_price_usd" ] = intval( $product[ "retail_price" ] / $usd_currency );
          }
          $arr_products[] = $product;
        }
      }
    }
    sort_array_by( $arr_products, [ "field_name" => "retail_price", "sort_direction" => "ASC" ] );
    print_product_list( $arr_products, $view_mode );
    break;
  case "price_big":
    $arr_products = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {
          if ( $product[ "currency" ] == "RUR"
            and $usd_currency > 0 ) {
            $product[ "retail_price_usd" ] = intval( $product[ "retail_price" ] / $usd_currency );
          }
          $arr_products[] = $product;
        }
      }
    }
    sort_array_by( $arr_products, [ "field_name" => "retail_price", "sort_direction" => "DESC" ] );
    print_product_list( $arr_products, $view_mode );
    break;
  case "diagonal_small":
    $arr_products = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {
          $arr_products[] = $product;
        }
      }
    }
    sort_array_by( $arr_products, [ "field_name" => "diagonal", "sort_direction" => "ASC" ] );
    print_product_list( $arr_products, $view_mode );
    break;
  case "diagonal_big":
    $arr_products = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {
          $arr_products[] = $product;
        }
      }
    }
    sort_array_by( $arr_products, [ "field_name" => "diagonal", "sort_direction" => "DESC" ] );
    print_product_list( $arr_products, $view_mode );
    break;
  case "new":
    $arr_products = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {
          $arr_products[] = $product;
        }
      }
    }
    sort_array_by( $arr_products, [ "field_name" => "index", "sort_direction" => "DESC" ] );
    print_product_list( $arr_products, $view_mode );
    break;
  case "recommended":
    $arr_products_sorted_by_recommended = array();
    $arr_products_sorted_by_diagonal = array();
    $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
    foreach ( $arrSeries as $key => $brand ) {
      foreach ( $brand as $series ) {
        foreach ( $series[ "products" ] as $product ) {

          if ( $product[ "recommended" ] != "0" ) {
            $arr_products_sorted_by_recommended[] = $product;

          } else {
            $arr_products_sorted_by_diagonal[] = $product;
          }

        }
      }
    }
    sort_array_by( $arr_products_sorted_by_recommended, [ "field_name" => "recommended", "sort_direction" => "DESC" ] );
    sort_array_by( $arr_products_sorted_by_diagonal, [ "field_name" => "diagonal", "sort_direction" => "ASC" ] );
    $arr_products = array_merge( $arr_products_sorted_by_recommended, $arr_products_sorted_by_diagonal );
    print_product_list( $arr_products, $view_mode );
    break;

  default:
    ?>
<div class=" <? if($_POST["is_ajax"]) {  echo "is_ajax";   } ?> view-mode-<?= $view_mode ?>">
  <?php
  $arrSeries = $DB_WORK_CATALOG->get_series_by_section_code_grouped_by_brand( $_GET[ "section" ], $mysql_product_filter );
  foreach ( $arrSeries as $key => $brand ) {
    if ( in_array( $key, $arBrands )or count( $arBrands ) == 0 ) {
      ?>
  <div class='brand_logo_wrapper'>
    <div class="brand_logo"
                             style="background-image: url('<?= $brand[0]['brand']["preview_picture"] ?>'"></div>
    <div class="brand_name font_md">
      <?= $brand[0]['brand']["name"] ?>
    </div>
  </div>
  <?php
  foreach ( $brand as $series ) {

    if ( isset( $only_series )and $only_series != ""
      and $only_series != $series[ "name" ] ) continue;
    if ( count( $series[ "products" ] ) == 0 ) {
      continue;
    }
    if ( isset( $series[ "set_of_preview_fields" ] )and $series[ "set_of_preview_fields" ] != '' ) {
      $arrPreviewFields = explode( ",", trim( $series[ "set_of_preview_fields" ], ", " ) );
      $arrPreviewFields_withNames = array();
      foreach ( $arrPreviewFields as $arrPreviewField ) {
        $field_description = $DB_WORK_CATALOG->get_field_describtion_by_code( $arrPreviewField );
        $arrPreviewFields_withNames[] = [ "name_short" => $field_description[ "name_short" ], "code" => $arrPreviewField, "units" => $field_description[ "units" ] ];
      }

    }

    ?>
  <div class='series_title'>
    <?= $series["name_russian"] ?>
  </div>
  <?php
  switch ( $view_mode ) {
    case 'table':
      include "templates/inc.template_list_of_products_table.php";
      break;
    case 'list':
      include "templates/inc.template_list_of_products_list.php";
      break;
    case 'tiles':
      include "templates/inc.template_list_of_products_tile.php";
      break;
    case 'tile':
      include "templates/inc.template_list_of_products_tile.php";
      break;
  }
  echo "<div></div>";
  }
  }
  }

  ?>
</div>
<?
break;
}


?>
<div id="ajax_message" style="display: none">
  <?= $ajax_message ?>
</div>
<?php

$buffer = ob_get_clean();
/*if (mb_detect_encoding($buffer) == 'UTF-8') {
    $buffer = iconv("utf-8", "windows-1251", $buffer);
}*/
echo $buffer;


if ( !defined( "SERVER_RENDERING" ) ) {
  $HTTP_REFERER = $_SERVER[ "HTTP_REFERER" ];
} else {
  $HTTP_REFERER = $_SERVER[ "REQUEST_URI" ];
}


$HTTP_REFERER = str_replace( "https://www.rusavto.moisait.net", "", $HTTP_REFERER );
$HTTP_REFERER = str_replace( "https://www.rusavtomatika.com", "", $HTTP_REFERER );
$HTTP_REFERER = str_replace( "https://www.test.rusavtomatika.com", "", $HTTP_REFERER );

if ( $HTTP_REFERER != "" ) {
  global $H1, $TITLE, $DESCRIPTION, $KEYWORDS, $CANONICAL, $UPPER_SEO_TEXT, $LOWER_SEO_TEXT, $pretext, $posttext;
  global $H1_original;
  global $TITLE_original;
  global $SEO_URL;

  $url = $HTTP_REFERER;
  ?>
<meta name="fragment" content="!">
<?
$row = $DB_WORK_CATALOG->get_rows_from_table( 'seo', '', "url = '$url'", '', '1' );
if ( isset( $row[ 0 ] ) ) {
  $seo_data = $row[ 0 ];
  if ( $seo_data[ "active" ] == "1" ) {
if ( $seo_data[ "TITLE" ] != "" ) {
      $TITLE = $TITLE_original = $seo_data[ "TITLE" ]; // идёт в я-вебмастер
      if ( $TITLE != "" ) {
        ?>
<meta name="component_seo_title" content="<?= $TITLE ?>">
<?php
}
}
if ( $seo_data[ "H1" ] != "" ) {
  $H1 = $H1_original = $seo_data[ "H1" ];
  //$H1 = $seo_data[ "H1" ];
  if ( $H1 != "" ) {
    ?>
<meta name="component_seo_h1" content="<?= $H1 ?>">
<?php
}
}
if ( $seo_data[ "DESCRIPTION" ] != "" ) {
  $DESCRIPTION = $DESCRIPTION_original = $seo_data[ "DESCRIPTION" ];
  if ( $DESCRIPTION != "" ) {
    ?>
<meta name="component_seo_DESCRIPTION" content="<?= $DESCRIPTION ?>">
<?php
}
}
if ( $seo_data[ "KEYWORDS" ] != "" ) {
  $KEYWORDS = $KEYWORDS_original = $seo_data[ "KEYWORDS" ];
  if ( $KEYWORDS != "" ) {
    ?>
<meta name="component_seo_KEYWORDS" content="<?= $KEYWORDS ?>">
<?php
}
}
	//echo "#############".$seo_data[ "UPPER_SEO_TEXT" ]."#################";

if ( isset($seo_data[ "UPPER_SEO_TEXT" ])) {
  //$UPPER_SEO_TEXT = $UPPER_SEO_TEXT_original = $seo_data[ "UPPER_SEO_TEXT" ];
  $UPPER_SEO_TEXT = $seo_data[ "UPPER_SEO_TEXT" ];
  if ( $UPPER_SEO_TEXT != "" ) {
    ?>
<noindex><slot class="is-hidden" id="component_seo_UPPER_SEO_TEXT" u1111="111"><?= $UPPER_SEO_TEXT ?></slot></noindex>
<?php
}
}

if ( $seo_data[ "LOWER_SEO_TEXT" ] != "" ) {
  //$LOWER_SEO_TEXT = $LOWER_SEO_TEXT_original = $seo_data[ "LOWER_SEO_TEXT" ];
  $LOWER_SEO_TEXT = $seo_data[ "LOWER_SEO_TEXT" ];
  if ( $LOWER_SEO_TEXT != "" ) {
    ?>
<noindex><slot class="is-hidden" id="component_seo_LOWER_SEO_TEXT" l2222="222"><?= $LOWER_SEO_TEXT ?></slot></noindex>
<?php
}
}
if ( isset( $seo_data[ "rel_canonical" ] )and $seo_data[ "rel_canonical" ] != "" ) {
  $CANONICAL = $seo_data[ "rel_canonical" ];
}
}
} else {
    ?>
<slot type="hidden" id="component_seo_UPPER_SEO_TEXT"></slot>
<slot type="hidden" id="component_seo_LOWER_SEO_TEXT"></slot>
<?php
}
}


//echo json_encode($out);
