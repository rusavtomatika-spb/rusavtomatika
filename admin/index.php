<?php
require_once 'admin_auth.php';

if ($_SERVER['SERVER_NAME'] != 'www.rusavto.moisait.net') {
    header('HTTP/1.0 403 Forbidden');
    echo 'Доступ запрещен. Неизвестный маршрут.';
    exit;
}

$current_admin = check_admin_auth();
if (!$current_admin) {
    header('Location: /admin/_right.php');
    exit;
}

header( "Cache-Control: no-store, no-cache, must-revalidate" );
header( "Expires: " . date( "r" ) );

define( 'admin', true );
define('PRODUCTS_ALL', true);

global $ftpConnectionID;
global $db_work;

file_put_contents( "error_log", "" );
$core_admin_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/admin/';
include $core_admin_path . 'template/header.php';
?>
<header class="admin__header">
  <h1>Административная панель</h1>

  <div class="header__user-info">
    <p><?= htmlspecialchars($current_admin['username']) ?></p>
    <a href="/admin/logout.php" class="logout-button">
      Выход
      <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <style>
            .cls-1 {
              fill: none;
              stroke: #fff;
              stroke-linecap: round;
              stroke-linejoin: round;
              stroke-width: 2px;
            }
            path {
              fill: #fff;
              stroke: none;
            }
          </style>
        </defs>
        <title/>
        <g id="logout">
          <line class="cls-1" x1="15.92" x2="28.92" y1="16" y2="16"/>
          <path d="M23.93,25v3h-16V4h16V7h2V3a1,1,0,0,0-1-1h-18a1,1,0,0,0-1,1V29a1,1,0,0,0,1,1h18a1,1,0,0,0,1-1V25Z"/>
          <line class="cls-1" x1="28.92" x2="24.92" y1="16" y2="20"/>
          <line class="cls-1" x1="28.92" x2="24.92" y1="16" y2="12"/>
          <line class="cls-1" x1="24.92" x2="24.92" y1="8.09" y2="6.09"/>
          <line class="cls-1" x1="24.92" x2="24.92" y1="26" y2="24"/>
        </g>
      </svg>
    </a>
  </div>
</header>
<?
include $core_admin_path . 'menu.php';
include $core_admin_path . 'classes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';

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
        $url = 'https://www.rusavto.moisait.net/admin?success=' . $result[ "success" ];
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

if (!empty($result) && $_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net') {
  echo "<div class='table-container'>";
  echo "<div class='sticky-header'>";
  echo "<table class='fixed-table'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th style='width:17%'>Модель</th>";
  echo "<th style='width:12%'>ВКЛ</th>";
  echo "<th style='width:12%'>Фоток</th>";
  echo "<th style='width:12%'>Старьё</th>";
  echo "<th style='width:12%'>Цена</th>";
  echo "<th style='width:12%'>Скрыть цену</th>";
  echo "<th style='width:12%'>COM</th>";
  echo "<th style='width:12%'>На складе</th>";
  echo "<th style='width:12%'>На складе СПБ</th>";
  echo "<th style='width:13%'>Показ На складе</th>";
  echo "<th style='width:13%'>Показ в каталоге</th>";
  echo "<th style='width:12%'>Сортировка</th>";
  echo "<th style='width:12%' class='td_center'>Действия</th>";
  echo "</tr>";
  echo "</thead>";
  echo "</table>";
  echo "</div>";
  echo "<div class='table-content'>";
  echo "<table class='fixed-table' id='list'>";
  echo "<colgroup>";
  echo "<col style='width:17%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:13%'>";
  echo "<col style='width:13%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "</colgroup>";
  echo "<tbody>";
  
  $counter = 0;
  if ( is_array( $result ) ) {
    foreach ( $result as $row ) {
      $counter++;
      if ( isset( $row[ 'section_code' ] ) && $row[ 'section_code' ] ) {
        $sub_section = "sub_section";
        $mark = "-> ";
      } else {
        $sub_section = "";
        $mark = "";
      }
      $link = "/admin?index=" . $row[ 'index' ] . "&action=edit_element";
      
      if ( isset( $_GET[ "element_id" ] )and isset( $row[ "index" ] )and $_GET[ "element_id" ] == $row[ "id" ] ):
        echo "<tr class='tr_green'>";
      else :
        echo "<tr><form action='$link' method='post'>";
      endif;
      
      echo "<td class='name'><a target='_blank' class='' href='/admin/edit_element.php?index=" . $row[ 'index' ] . "'>" . $row[ 'model' ] . "</a><input type='hidden' name='field_model' value='" . $row[ 'model' ] . "'><span style='display:none;'>" . $row[ 'type' ] . "</span><span style='display:none;'>" . $row[ 'series' ] . "</span><span style='display:none;'>" . $row[ 'brand' ] . "</span></td>";
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
  } else {
    echo "<tr>";
    echo "<td colspan='13'> - пусто - </td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
  
  echo "<div class='table-footer'>";
  echo "<table class='fixed-table'>";
  echo "<tr>";
  echo "<td colspan='13' class='td_center'> Всего $counter строк </td>";
  echo "</tr>";
  echo "</table>";
  echo "</div>";
  echo "</div>";
}
?>

<style>
.table-container {
  width: 100%;
  max-width: 1920px;
  margin: 0 auto;
  position: relative;
}

.sticky-header {
  position: sticky;
  top: 0;
  z-index: 100;
  background: #293133 !important;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.table-content {
  max-height: 70vh;
  overflow-y: auto;
  border: 1px solid #ddd;
}

.table-footer {
  background: #f5f5f5;
  border-top: 1px solid #ddd;
}

.fixed-table {
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
}

.fixed-table th,
.fixed-table td {
  padding: 8px;
  border: 1px solid #ddd;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  box-sizing: border-box;
}

.fixed-table th {
  background: #f9f9f9;
  font-weight: bold;
  text-align: left;
}

.fixed-table .name {
  width: 18%;
}

.fixed-table .code {
  width: 8%;
  text-align: center;
}

.fixed-table .code input,
.fixed-table .code select {
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
  text-align: center;
}

.fixed-table .td_center {
  text-align: center;
  width: 100%;
}
.fixed-table th {
  background: #293133 !important;
  font-weight: bold;
  text-align: left;
  border-bottom: 2px solid #ccc;
}
.actions-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 5px;
  min-height: 60px;
  width: max-content;
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
  box-sizing: border-box;
}

.green {
  background: #34AB5E;
  border: solid 1px #34AB5E;
}

.red {
  background: red;
  border: solid 1px red;
}

.tr_green {
  background-color: #e8f5e8 !important;
}

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

.button_create_webp {
  display: inline-block;
  padding: 3px 5px;
  color: white;
  background: #44bb6e;
  cursor: pointer;
}

.success_message, .error_message {
  padding: 10px;
  margin: 10px 0;
  border-radius: 4px;
}

.success_message {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.error_message {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

.admin__header {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  margin-bottom: 50px;
}

.header__user-info {
  position: absolute;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  width: max-content;
  top: 0;
  right: 0;
}

.header__user-info p {
  font-size: 20px;
  color: #000;
  font-weight: 600;
  line-height: 150%;
  margin: 0;
}

.header__user-info a {
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #4CAF50;
  background: #4CAF50;
  border-radius: 5px;
  color: #fff;
  font-size: 17px;
  width: 100px;
  text-decoration: none;
  gap: 5px;
}

.header__user-info a svg {
  height: 20px;
  width: auto;
  color: #fff;
}
</style>
<?
include $core_admin_path . 'template/footer.php';
?>