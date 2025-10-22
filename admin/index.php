<?php
header( "Cache-Control: no-store, no-cache, must-revalidate" );
header( "Expires: " . date( "r" ) );
//echo "PHP_MAJOR_VERSION " . PHP_MAJOR_VERSION;
//ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
/*
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
define( 'admin', true );
define( 'PRODUCTS_ALL', true );
global $ftpConnectionID;
global $db_work;
file_put_contents( "error_log", "" );
$core_admin_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/admin/';
include $core_admin_path . 'template/header.php';
?>
<h1>Административная панель</h1>
<?
include $core_admin_path . 'products_all/menu.php';
include $core_admin_path . 'products_all/classes/functions.php';
/* * *************************************************************************** */
/* $db_work = new DBWORK();
  $db_work->show_tables(); */
$db_work = new DBWORK();
$result = $db_work->get_list_catalog_elements();

foreach ( $result as $row ) {
  $arrIndexProdut[] = $row[ "index" ];
}
$comma_separated = implode( ",", $arrIndexProdut );

if ( isset( $_GET[ "index" ] )and $_GET[ "index" ] > 0 ) {
  $element_id = intval( $_GET[ "index" ] );
  if ( isset( $_GET[ "action" ] )and $_GET[ "action" ] == "edit_element" ) {

    $result = $db_work->edit_catalog_element( $element_id, $_POST );
    if ( isset( $result )and $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
      if ( isset( $_POST[ "submit_and_close" ] ) ) {
        $url = 'https://www.rusavto.moisait.net/admin/products_all/mini.php?success=' . $result[ "success" ];
        if ( isset( $result[ "element_id" ] ) )$url .= '&element_id=' . $result[ "element_id" ];
        if ( isset( $_POST[ "section_code" ] ) )$url .= '&section_code=' . $_POST[ "section_code" ];
        $url .= '&message=' . urlencode( $result[ "message" ] );
        header( 'Location: ' . $url );
        echo "<script>window.location.replace('" . $url . "');</script>";
      }
    }
  }
}

if ( isset( $_GET[ "brands" ] )and $_GET[ "brands" ] > 0 ) {
  $brand = $_GET[ "brands" ];
  $result = $db_work->get_list_catalog_elements( '', $_GET[ "brands" ] );
}


?>
<script type="text/javascript" src="/js/vue.js"></script> 
<script type="text/javascript" src="/js/axios.min.js"></script>
<?
if ( isset( $_GET[ "message" ] ) ) {
  if ( $_GET[ "success" ] ) {
    echo "<div class='success_message'>" . strip_tags( urldecode( $_GET[ "message" ] ) ) . "</div>";
  } else
    echo "<div class='error_message'>" . strip_tags( urldecode( $_GET[ "message" ] ) ) . "</div>";
}

if ( isset( $_GET[ "action" ] )and isset( $_GET[ "id" ] ) ) {
  if ( $_GET[ "action" ] == "delete_element" ) {
    $db_work = new DBWORK();
    $result = $db_work->delete_catalog_element( intval( $_GET[ "id" ] ) );
    if ( $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
    } else {
      echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
    }
    header( 'Refresh:0; list_elements.php?section_code=' . $_GET[ "section_code" ] . '&success=' . $result[ "success" ] . '&message=' . urlencode( $result[ "message" ] ) );
  } elseif ( $_GET[ "action" ] == "delete_product_element" ) {
    $db_work = new DBWORK();
    $result = $db_work->delete_product_element( intval( $_GET[ "id" ] ) );
    if ( $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
    } else {
      echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
    }
    echo "<script>setTimeout(function(){ window.location.href = '/admin'; }, 1000);</script>";
  } elseif ( $_GET[ "action" ] == "move_up" ) {
    $db_work = new DBWORK();
    $result = $db_work->move_up_catalog_element( intval( $_GET[ "id" ] ), $_GET[ "section_code" ] );
    if ( $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
    } else {
      echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
    }
    header( 'Refresh:0; list_elements.php?section_code=' . $_GET[ "section_code" ] . '&success=' . $result[ "success" ] . '&message=' . urlencode( $result[ "message" ] ) );
  } elseif ( $_GET[ "action" ] == "move_down" ) {
    $db_work = new DBWORK();
    $result = $db_work->move_down_catalog_element( intval( $_GET[ "id" ] ), $_GET[ "section_code" ] );
    if ( $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
    } else {
      echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
    }
    header( 'Refresh:0; list_elements.php?section_code=' . $_GET[ "section_code" ] . '&success=' . $result[ "success" ] . '&message=' . urlencode( $result[ "message" ] ) );
  } elseif ( $_GET[ "action" ] == "set_position" ) {
    $db_work = new DBWORK();
    $result = $db_work->set_position_catalog_element( intval( $_GET[ "id" ] ), intval( $_GET[ "position" ] ) );
    if ( $result[ "success" ] == true ) {
      echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
    } else {
      echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
    }
    header( 'Refresh:0; list_elements.php?section_code=' . $_GET[ "section_code" ] . '&success=' . $result[ "success" ] . '&message=' . urlencode( $result[ "message" ] ) );
  } elseif ( $_GET[ "action" ] == "copy_element" ) {
    $db_work = new DBWORK();
    $class_info = new ReflectionClass('DBWORK');
    $class_file = $class_info->getFileName();
    $methods = get_class_methods($db_work);
    $result = $db_work->copy_product_element(intval($_GET["id"]));
  }
}
if ( isset( $_GET[ "action" ] )and $_GET[ "action" ] == "recalculate_positions"
  and isset( $_GET[ "section_code" ] )and $_GET[ "section_code" ] != "" ) {
  $db_work = new DBWORK();
  $result = $db_work->recalculate_positions_catalog_element( $_GET[ "section_code" ] );
  if ( $result[ "success" ] == true ) {
    echo "<div class='success_message'>" . $result[ "message" ] . "</div>";
  } else {
    echo "<div class='error_message'>" . $result[ "message" ] . "</div>";
  }
  //header('Refresh:0; list_elements.php?section_code=' . $_GET["section_code"] . '&success=' . $result["success"] . '&message=' . urlencode($result["message"]));
}


$db_work = new DBWORK();
if ( isset( $_GET[ "sort_by" ] ) ) {
  $result = $db_work->get_list_catalog_elements( $_GET[ "sort_by" ] );
} elseif ( isset( $_GET[ "brands" ] ) ) {
  $result = $db_work->get_list_catalog_elements( '', $_GET[ "brands" ] );
} elseif ( isset( $_GET[ "types" ] ) ) {
  $result = $db_work->get_list_catalog_elements( '', '', $_GET[ "types" ] );
} elseif ( isset( $_GET[ "series" ] ) ) {
  $result = $db_work->get_list_catalog_elements( '', '', '', $_GET[ "series" ] );
} else {
  $result = $db_work->get_list_catalog_elements();
}

if ( !empty( $result ) ) {
  echo "<div class='sticky' style='    max-width: 1920px;
    box-sizing: border-box;
    background: #f9f9f9;
    '><table>";
  echo "<tr>";
  echo "<th style='width:18%'>Модель</th>";
  echo "<th style='width:7%'>ВКЛ</th>";
  echo "<th style='width:7%'>Фоток</th>";
  echo "<th style='width:7%'>Старьё</th>";
  echo "<th style='width:7%'>Цена</th>";
  echo "<th style='width:7%'>Скрыть цену</th>";
  echo "<th style='width:7%'>COM</th>";
  echo "<th style='width:7%'>На складе</th>";
  echo "<th style='width:7%'>На складе СПБ</th>";
  echo "<th style='width:7%'>Показ На складе</th>";
  echo "<th style='width:7%'>Показ в каталоге</th>";
  echo "<th style='width:7%'>Сортировка</th>";
  echo "<th style='width:12%' class='td_center'>Действия</th>";
  echo "</tr></table></div>";
  echo "<table id='list'>";
  echo "<colgroup>";
  echo "<col style='width:18%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:7%'>";
  echo "<col style='width:12%'>";
  echo "</colgroup>";
  echo "<!--tr>";
  echo "<th style='width:18%'>Модель</th>";
  echo "<th style='width:7%'>ВКЛ</th>";
  echo "<th style='width:7%'>Фоток</th>";
  echo "<th style='width:7%'>Старьё</th>";
  echo "<th style='width:7%'>Цена</th>";
  echo "<th style='width:7%'>Скрыть цену</th>";
  echo "<th style='width:7%'>COM</th>";
  echo "<th style='width:7%'>На складе</th>";
  echo "<th style='width:7%'>На складе СПБ</th>";
  echo "<th style='width:7%'>Показ На складе</th>";
  echo "<th style='width:7%'>Показ в каталоге</th>";
  echo "<th style='width:7%'>Сортировка</th>";
  echo "<th style='width:12%' class='td_center'>Действия</th>";
  echo "</tr-->";
  $counter = 0;
  if ( is_array( $result ) ) {
    //connectToFTP();
    foreach ( $result as $row ) {

      //            $imagesHtml = getImagesHtml($row);
      //$imagesHtml = getRemoteFTPImagesHtml( $row );

      $counter++;
      if ( isset( $row[ 'section_code' ] ) && $row[ 'section_code' ] ) {
        $sub_section = "sub_section";
        $mark = "-> ";
      } else {
        $sub_section = "";
        $mark = "";
      }
      $link = "/admin/products_all/mini.php?index=" . $row[ 'index' ] . "&action=edit_element";
//      foreach ( $_GET as $key => $value ) {
//        $link .= "&$key=$value";
//      }
      if ( isset( $_GET[ "element_id" ] )and isset( $row[ "index" ] )and $_GET[ "element_id" ] == $row[ "id" ] ):
        echo "<tr class='tr_green'>";
      else :
        echo "<tr style='border-bottom: 1px solid #000;'><form action='$link' method='post'>";
      endif;
      echo "<td class='name'><a target='new' class='' href='/admin/edit_element.php?index=" . $row[ 'index' ] . "'>" . $row[ 'model' ] . "</a><input type='hidden' name='field_model' value='" . $row[ 'model' ] . "'><span style='display:none;'>" . $row[ 'type' ] . "</span><span style='display:none;'>" . $row[ 'series' ] . "</span><span style='display:none;'>" . $row[ 'brand' ] . "</span></td>";
      //echo "<td class='code'><input type='text' name='field_status' value='" . $row['status'] . "'></td>";
      echo "<td class='code'><select name='field_status' id='status' class='status' style='font-size: 0.7em;min-width:70px;'><option value='0'";
      if ( $row[ 'status' ] == "0" )echo " selected class='status-off'";
      echo ">ВЫКЛ</option><option value='1'";
      if ( $row[ 'status' ] == "1" )echo " selected class='status-on'";
      echo ">ВКЛ</option><option value='2'";
      if ( $row[ 'status' ] == "2" )echo " selected";
      echo ">2</option></select></td>";
      echo "<td class='code'><input type='text' name='field_pics_number' value='" . $row[ 'pics_number' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_discontinued' value='" . $row[ 'discontinued' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_retail_price' value='" . $row[ 'retail_price' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_retail_price_hide' value='" . $row[ 'retail_price_hide' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_serials' value='" . $row[ 'serials' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_onstock' value='" . $row[ 'onstock' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_onstock_spb' value='" . $row[ 'onstock_spb' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_show_on_stock' value='" . $row[ 'show_on_stock' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_show_in_cat' value='" . $row[ 'show_in_cat' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_sort' value='" . $row[ 'sort' ] . "'></td>";
      echo '<td class="td_center actions-wrapper">';
      echo '<button type="submit" name="Submit" class="product__action-button green">Применить</button>';
      echo '<a href="?action=copy_element&id=' . $row['index'] . '" class="product__action-button green">Копировать</a>';
      echo '<a href="?action=delete_product_element&id=' . $row['index'] . '" class="product__action-button red">Удалить</a>';
      echo "</td>";
      echo "</form></tr>";
    }
    
    //disconnectFTP();
  } else {
    echo "<tr>";
    echo "<th colspan='8'> - пусто - </th>";
    echo "</tr>";
  }
  echo "<tr>";
  echo "<th colspan='8' class='td_center'> Всего $counter строк </th>";
  echo "</tr>";
  echo "</table>";
}
?>
<style>
    .btn_start_programm {
        color: white;
        background: #44bb6e;
        padding: 10px 20px;
        font-size: 17px;
        display: inline-block;
        line-height: 17px;
        cursor: pointer;
        margin: 0px 0px 17px 0px;
    }

    .btn_start_programm__small {
        margin-top: 20px;
        color: white;
        background: grey;
        padding: 5px 10px;
        font-size: 15px;
        display: inline-block;
        cursor: pointer;
    }

    .document_container {
        text-align: center;
    }

    .button_create_webp{display: inline-block;
    padding: 3px 5px;
        color: white;
        background: #44bb6e;
        cursor: pointer;
    }
  .actions-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 175px;
    gap: 5px;
  }
  .actions-wrapper a {
    text-decoration: none;
    width: 100%;
  }
  .product__action-button {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3px 5px;
    width: 100%;
    color: #fff;
    border-radius: 5px;
    font-size: 12px;
  }
  .green {
    background: #34AB5E;
    border: solid 1px #34AB5E;
  }
  .red {
    background: red;
    border: solid 1px red;
  }
</style>
<script>
$(window).load(function(){
$(".success_message").delay(3200).fadeOut(300);
});
</script>
<?

/* * *************************************************************************** */
include $core_admin_path . 'template/footer.php';
?>
