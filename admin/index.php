<?php
require_once 'admin_auth.php';

$isAllowed = false;

$allowedDomains = array('www.rusavto.moisait.net', 'rusavtomatika.local');

if (in_array($_SERVER['SERVER_NAME'], $allowedDomains)) {
    $isAllowed = true;
}

if (preg_match('/\.local$/i', $_SERVER['SERVER_NAME'])) {
    $isAllowed = true;
}

if (!$isAllowed && !empty($_COOKIE['m'])) {
    $isAllowed = true;
}

if (!$isAllowed) {
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

$core_admin_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/admin/';
include $core_admin_path . 'template/header.php';
include $core_admin_path . 'menu.php';
include $core_admin_path . 'classes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/databases.php';

$db_work = new DBWORK();
$result = $db_work->get_list_catalog_elements();

foreach ( $result as $row ) {
  $arrIndexProdut[] = $row[ "index" ];
}
$comma_separated = implode( ",", $arrIndexProdut );

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])) {
    if (isset($_POST['id']) && $_POST['id'] > 0) {
        $element_id = intval($_POST['id']);
        
        $result = $db_work->edit_catalog_element($element_id, $_POST);
        
        if (isset($result) && $result["success"] == true) {
            $url = '/admin?success=' . $result["success"];
            if (isset($result["element_id"])) $url .= '&element_id=' . $result["element_id"];
            if (isset($_POST["section_code"])) $url .= '§ion_code=' . $_POST["section_code"];
            $url .= '&message=' . urlencode($result["message"]);
            
            echo "<div class='success_message'>" . $result["message"] . "</div>";
            echo "<script>setTimeout(function(){ window.location.href = '" . $url . "'; }, 1500);</script>";
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
session_start();
$sync_toast = null;
if (!empty($_SESSION['sync_toast'])) {
  $sync_toast = $_SESSION['sync_toast'];
  unset($_SESSION['sync_toast']);
}
?>
<? if ($sync_toast): ?>
<div id="sync-toast" class="sync-toast sync-toast--<?= htmlspecialchars($sync_toast['type']) ?>">
  <?= htmlspecialchars($sync_toast['text']) ?>
</div>
<script>
(function () {
  var el = document.getElementById('sync-toast');
  if (!el) return;
  requestAnimationFrame(function () { el.classList.add('sync-toast--visible'); });
  setTimeout(function () {
    el.classList.remove('sync-toast--visible');
    setTimeout(function () { if (el.parentNode) el.parentNode.removeChild(el); }, 400);
  }, 5000);
})();
</script>
<? endif; ?>

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

if (!empty($result) && $isAllowed) {
  echo "<div class='table-container'>";
  echo "<div class='sticky-header'>";
  echo "<table class='fixed-table'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th style='width:17%'>Модель</th>";
  echo "<th style='width:12%'>ВКЛ</th>";
  echo "<th style='width:12%'>Фоток</th>";
  echo "<th style='width:12%'>Цена</th>";
  echo "<th style='width:12%'>Скрыть цену</th>";
  echo "<th style='width:12%'>На складе</th>";
  echo "<th style='width:12%'>На складе СПБ</th>";
  echo "<th style='width:13%'>Показ На складе</th>";
  echo "<th style='width:13%'>Показ в каталоге</th>";
  echo "<th style='width:12%'>Сортировка</th>";
  echo "<th style='width:17%' class='td_center'>Действия</th>";
  echo "</tr>";
  echo "</thead>";
  echo "</table>";
  echo "</div>";
  echo "<div class='table-content'>";
  echo "<table class='fixed-table' id='list' >";
  echo "<colgroup>";
  echo "<col style='width:17%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:13%'>";
  echo "<col style='width:13%'>";
  echo "<col style='width:12%'>";
  echo "<col style='width:17%'>";
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
      $link = "/admin/?index=" . $row[ 'index' ] . "&action=edit_element";
      
      if ( isset( $_GET[ "element_id" ] )and isset( $row[ "index" ] )and $_GET[ "element_id" ] == $row[ "id" ] ):
        echo "<tr class='tr_green'>";
      else :
        echo "<tr><form action='$link' method='post'>";
      endif;
      
      echo "<td class='name'><a target='_blank' class='' href='/admin/edit_element.php?index=" . $row[ 'index' ] . "'>" . $row[ 'model' ] . "</a><input type='hidden' name='field_model' value='" . $row[ 'model' ] . "'><span style='display:none;'>" . $row[ 'type' ] . "</span><span style='display:none;'>" . $row[ 'series' ] . "</span><span style='display:none;'>" . $row[ 'brand' ] . "</span><br><p style='font-size:12px;text-align:center;'><a target='_blank' href='/".strtolower($row[ 'brand' ])."/".$row[ 'model' ]."/' name='menu' class='nav-link'>См. на МС</a></p></td>";
      echo "<td class='code'><select name='field_status' id='status' class='status' style='font-size: 0.7em;min-width:70px;'><option value='0'";
      if ( $row[ 'status' ] == "0" )echo " selected class='status-off'";
      echo ">ВЫКЛ</option><option value='1'";
      if ( $row[ 'status' ] == "1" )echo " selected class='status-on'";
      echo ">ВКЛ</option><option value='2'";
      if ( $row[ 'status' ] == "2" )echo " selected";
      echo ">2</option></select></td>";
      echo "<td class='code'><input type='text' name='field_pics_number' value='" . $row[ 'pics_number' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_retail_price' value='" . $row[ 'retail_price' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_retail_price_hide' value='" . $row[ 'retail_price_hide' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_onstock' value='" . $row[ 'onstock' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_onstock_spb' value='" . $row[ 'onstock_spb' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_show_on_stock' value='" . $row[ 'show_on_stock' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_show_in_cat' value='" . $row[ 'show_in_cat' ] . "'></td>";
      echo "<td class='code'><input type='text' name='field_sort' value='" . $row[ 'sort' ] . "'></td>";
      echo '<td class="td_center actions-wrapper">';
      echo "<input type='hidden' name='id' value='" . $row['index'] . "'>";
      echo '<div style="display: flex; align-items: center; gap: 5px; width: 100%;">';
      echo '<button type="submit" name="Submit" class="product__action-button green">Прим.</button>';
      echo '<a href="?action=copy_element&id=' . $row['index'] . '" class="product__action-button green">Копир.</a>';
      echo '</div>';
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
  echo "</div>";
}
?>

<script type="javascript>">
document.addEventListener('DOMContentLoaded', function() { const links = document.querySelectorAll('.nav-link'); const currentUrl = window.location.href; // Проверка при загрузке (если вернулись назад) links.forEach(link => { if (link.href === currentUrl) { link.classList.add('active'); } }); // Обработчик клика links.forEach(link => { link.addEventListener('click', function() { links.forEach(l => l.classList.remove('active')); this.classList.add('active'); }); }); });    
</script>
<?
include $core_admin_path . 'template/footer.php';
?>