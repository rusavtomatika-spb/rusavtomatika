<?php
header( "Cache-Control: no-store, no-cache, must-revalidate" );
header( "Expires: " . date( "r" ) );
@header( "Content-Type: text/html; charset=utf-8" );
define( 'admin', true );
define( 'PRODUCTS_ALL', true );
//if (1) {
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
//}
$core_admin_path = $_SERVER[ 'DOCUMENT_ROOT' ] . '/admin/';
include_once $core_admin_path . 'template/header.php';
include_once $core_admin_path . 'products_all/menu.php';
require_once $core_admin_path . 'classes/functions.php';
@header( "Content-Type: text/html; charset=utf-8" );

if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
  $file = $_FILES['picture'];
  $product_id = $_POST['product_id'];

  $db_work = new DBWORK();
  $current_element = $db_work->get_catalog_element_by_id($product_id);

  $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($file['type'], $allowed_types)) {
    echo "<div class='error_message'>Недопустимый тип файла. Разрешены только JPG, PNG и GIF.</div>";
  }
  elseif ($file['size'] > 5 * 1024 * 1024) {
    echo "<div class='error_message'>Файл слишком большой. Максимальный размер - 5MB.</div>";
  } else {
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/images/catalog/';
    $brand_path = $base_path . strtolower($current_element['brand']) . '/';
    $model_path = $brand_path . $current_element['model'] . '/';
    
    if (!file_exists($brand_path)) mkdir($brand_path, 0755, true);
    if (!file_exists($model_path)) mkdir($model_path, 0755, true);
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $file_path = $model_path . $filename;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
      echo "<div class='success_message'>Изображение успешно загружено</div>";
    } else {
      echo "<div class='error_message'>Ошибка при загрузке файла</div>";
    }
  }
}

$row = array();
global $db_work;
$db_work = new DBWORK();
if ( isset( $_GET[ "index" ] )and $_GET[ "index" ] > 0 ) {
  $element_id = intval( $_GET[ "index" ] );
  if ( isset( $_GET[ "action" ] )and $_GET[ "action" ] == "edit_element" ) {

    $result = $db_work->edit_catalog_element( $element_id, $_POST );
    if ( isset( $result )and $result[ "success" ] == true ) {
      file_put_contents( 'tmp.txt', json_encode( $_POST, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
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
} else {
  echo "что то не так";
  exit();
}
$current_element = $db_work->get_catalog_element_by_id( $element_id );
$table_fields = $db_work->getlist_table_fields();

function cmp( $a, $b ) {
  return strcmp( $a[ 0 ], $b[ 0 ] );
}

usort( $table_fields, "cmp" );
//var_dump($table_fields);
//file_put_contents( 'tmp.txt', json_encode( $table_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
if ( is_array( $table_fields )and count( $table_fields ) > 0 ) {
  $x = 0;
  foreach ( $table_fields as $value ) {


    switch ( $value[ 0 ] ) {
      case "isolation_resistance":
        $rus_name = "Cопротивления изоляции";
        break;
      case "voltage_resistance":
        $rus_name = "Пробивная прочность корпуса";
        break;
      case "vibration":
        $rus_name = "Виброустойчивость";
        break;
      case "humidity":
        $rus_name = "Относительная влажность";
        break;
      case "power_isolation":
        $rus_name = "Развязка по питанию";
        break;
      case "graphics":
        $rus_name = "Графика(Графическая карта)";
        break;
      case "ftp_access_sd_usb":
        $rus_name = "Ftp доступ к SD карте и флешке";
        break;
      case "ftp_access_hmi_mem":
        $rus_name = "Ftp доступ к памяти панели";
        break;
      case "ethernet_full":
        $rus_name = "Ethernet (ethernet_full) заполнять именно его";
        break;
      case "sdcard":
        $rus_name = "Слот карт памяти";
        break;
      case "chipset":
        $rus_name = "Чипсет";
        break;
      case "certification":
        $rus_name = "Сертификаты";
        break;
      case "can_bus":
        $rus_name = "CAN BUS (Есть/нет/CANopen протокол)";
        break;
      case "brutto":
        $rus_name = "Вес&nbsp;брутто";
        break;
      case "audio":
        $rus_name = "Звуковая&nbsp;плата";
        break;
      case "av_input":
        $rus_name = "Аудио/видео&nbsp;вход";
        break;
      case "backlight":
        $rus_name = "Тип&nbsp;подсветки";
        break;
      case "backlight_life":
        $rus_name = "Время&nbsp;жизни&nbsp;подсветки";
        break;
      case "brightness":
        $rus_name = "Яркость";
        break;
      case "case_material":
        $rus_name = "Материал&nbsp;корпуса (Canning Material)";
        break;
      case "colors":
        $rus_name = "Цветность";
        break;
      case "contrast":
        $rus_name = "Контрастность";
        break;
      case "cpu_speed":
        $rus_name = "Частота";
        break;
      case "cpu_type":
        $rus_name = "Процессор";
        break;
      case "current":
        $rus_name = "Потребляемый ток";
        break;
      case "cutout":
        $rus_name = "Посадочное отверстие (Вырез под посадку, Hole Size)";
        break;
      case "diagonal":
        $rus_name = "Диагональ";
        break;
      case "dimentions":
        $rus_name = "Габариты(Overall Dimension)";
        break;
      case "ethernets":
        $rus_name = "Количество входов ethernet";
        break;
      case "flash":
        $rus_name = "Flash(встроенный) в МБ";
        break;
      case "front_ip":
        $rus_name = "Степень защиты по фронту (Level of Protection)";
        break;
      case "history_data_size_mb":
        $rus_name = "Объем памяти для сохранения архивов в панели";
        break;
      case "netto":
        $rus_name = "Вес";
        break;
      case "power_connector":
        $rus_name = "Разъем питания";
        break;
      case "project_size_mb":
        $rus_name = "Максимальный размер проекта";
        break;
      case "ram":
        $rus_name = "ОЗУ";
        break;
      case "resolution":
        $rus_name = "Разрешение";
        break;
      case "retail_price":
        $rus_name = "Цена";
        break;
      case "rtc":
        $rus_name = "часы реального времени";
        break;
      case "serial":
        $rus_name = "(COM)";
        break;
      case "serial_full":
        $rus_name = "Последовательные интерфейсы";
        break;
      case "set":
        $rus_name = "Комплект поставки";
        break;
      case "software":
        $rus_name = "ПО для разработки проектов";
        break;
      case "temp":
        $rus_name = "Рабочая температура";
        break;
      case "temp_max":
        $rus_name = "Раб.темп. ДО";
        break;
      case "temp_min":
        $rus_name = "Раб.темп. ОТ";
        break;
      case "touch":
        $rus_name = "Тип сенсора";
        break;
      case "touch_light_transmission":
        $rus_name = "Светопропускание сенсора";
        break;
      case "ts_usb":
        $rus_name = "Интерфейс сенсора";
        break;

      case "usb_host":
        $rus_name = "USB Host";
        break;
      case "voltage_max":
        $rus_name = "Напряжение питания ДО";
        break;
      case "voltage_min":
        $rus_name = "Напряжение питания ОТ";
        break;
      case "thickness":
        $rus_name = "Толщина(Глубина)";
        break;
      case "onstock":
        $rus_name = "Наличие";
        break;

      default:
        $rus_name = "";
        break;
    }


    $x++;
        $sin_name = "";

    $rus_name_from_db = $db_work->is_suitable_for_type( $value[ 0 ], $current_element[ "type" ] );
    $sinonimy_from_db = $db_work->get_sin_for_table_fields( $value[ 0 ], $current_element[ "type" ] );
    $distinct_from_db = $db_work->get_distinct_for_field( $value[ 0 ] );
    $field_type = $db_work->get_field_type( $value[ 0 ] );
    //$field_type = print_r($field_type);
    $dist_res = "";
    foreach ( $distinct_from_db as $n => $row ) {
      $dist_res .= $row[ 0 ] . "<br>\r\n";
    }
    //$distinct_from_db = '<pre>'.print_r($distinct_from_db).'</pre>';
    //var_dump($rus_name_from_db);
    if ( $rus_name_from_db != '' ) {
      $is_suitable_for_type = " is_suitable_for_type ";
      $rus_name = $rus_name_from_db;
    } else {
      $is_suitable_for_type = " is_not_suitable_for_type ";
    }
    if ( $sinonimy_from_db != '' ) {
      $is_suitable_for_type = " is_suitable_for_type ";
      $sin_name = $sinonimy_from_db;
    } else {
      $is_suitable_for_type = " is_not_suitable_for_type ";
    }
    if ( !isset( $_COOKIE[ "show_all_fields" ] ) ) {
      $_COOKIE[ "show_all_fields" ] = 1;
    }

    if ( ( $rus_name_from_db != ''
        and $_COOKIE[ "show_all_fields" ] != '1' )or $_COOKIE[ "show_all_fields" ] == '1'
      or 1 ) {
      $row = '<tr class="' . $is_suitable_for_type . '"><td style="width:5%">' . $x . ': <span><b title="' . $value[ 1 ] . '">' . $value[ 0 ] . '</b>' .
      '</span></td><td style="width:10%">' . $rus_name . '</td><td><input type="text" name="field_' . $value[ 0 ] .
      '" value="' . htmlspecialchars( $current_element[ $value[ 0 ] ] ) . '"> <span class="spoiler-zagolovok-' . $x . '" style="float:right; cursor: pointer;line-height:31px">&#9660;</span>
<div class="spoiler-body-' . $x . '" style="font-size:7pt;"><b>Как это поле (' . $field_type[ 0 ][ 0 ] . ') заполнено в других товарах (повторы убраны):</b><br>' .$dist_res . '</div><script>$(\'.spoiler-body-' . $x . '\').css({\'display\':\'none\'});  
$(\'.spoiler-zagolovok-' . $x . '\').click(function(){
   $(this).next(\'.spoiler-body-' . $x . '\').slideToggle(500)
});</script></td><td class="hidden" style="width:10%;font-size:7pt;">' . $sin_name . '</td></tr>';
      $pos_varchar = strpos( $value[ 1 ], "varchar" );
      $pos_text = strpos( $value[ 1 ], "text" );
      $pos_enum = strpos( $value[ 1 ], "enum" );
      $pos_set = strpos( $value[ 1 ], "set" );
      $pos_timestamp = strpos( $value[ 1 ], "timestamp" );
      if ( $pos_enum !== false OR $pos_set !== false ) {
        $zn = preg_replace( '/(.+)\((.*)\)/', '$2', $value[ 1 ] );
        $zn = str_ireplace( "'", "", $zn );
        //echo $zn.'<br>';
        $zn = explode( ',', $zn );
        $zn_res = "";
        foreach ( $zn as $n => $zna4 ) {
          if ( $current_element[ $value[ 0 ] ] == $zna4 ) {
            $zn_res .= "<option value=" . $zna4 . " selected>" . $zna4 . "</option>\r\n";
          } else {
            $zn_res .= "<option value=" . $zna4 . ">" . $zna4 . "</option>\r\n";
          }
        }
        //  $zn_res .="</select>\r\n";
        $row = '<tr class="' . $is_suitable_for_type . '"><td style="width:5%">' . $x . ': <span><b title="' . $value[ 1 ] . '">' . $value[ 0 ] . '</b> </span></td><td style="width:10%">' . $rus_name . '</td><td><select name="field_' . $value[ 0 ] . '">' . $zn_res . '</select></td></tr>';

      }
      if ( $pos_varchar !== false or $pos_text !== false ) {
        $length = preg_replace( "/[^0-9]/", '', $value[ 1 ] );
        if ( $length > 256 or $value[ 1 ] == "text" )
          $row = '<tr class="' . $is_suitable_for_type . '"><td style="width:5%">' . $x . ': <span><b title="' . $value[ 1 ] . '">' . $value[ 0 ] . '</b> </span></td><td style="width:10%">' . $rus_name . '</td><td><textarea rows="3" name="field_' . $value[ 0 ] . '">' . htmlentities( $current_element[ $value[ 0 ] ] ) . '</textarea></td></tr>';
      }
      if ( $pos_timestamp !== false) {
          $row = '<tr class="' . $is_suitable_for_type . '"><td style="width:5%">' . $x . ': <span><b title="' . $value[ 1 ] . '">' . $value[ 0 ] . '</b> </span></td><td style="width:10%">' . $rus_name . '</td><td><input type="date" name="field_' . $value[ 0 ] . '" value="' . mb_substr(htmlentities( $current_element[ $value[ 0 ] ] ),0,10) . '"></td></tr>';
      }
      $rows[] = $row;
    }
  }
}
?>
<h1>
  <?= $current_element['model'] ?>
  [
  <?= $element_id ?>
  ]
  <?= $current_element[ "type" ] ?>
</h1>
<div style="text-align: center;width: 100%;">Открыть товар на: [<a href="http://www.rusavto.moisait.net/<?= strtolower($current_element["brand"]) ?>/<?= $current_element["model"] ?>/" target="ms">moisait</a>]&nbsp;&nbsp;
  [<a href="http://www.test.rusavtomatika.com/<?= strtolower($current_element["brand"]) ?>/<?= $current_element["model"] ?>/" target="test">test</a>]&nbsp;&nbsp;
  [<a href="http://www.rusavtomatika.com/<?= strtolower($current_element["brand"]) ?>/<?= $current_element["model"] ?>/" target="proda">proda</a>] </div>

  <div style="display: flex; flex-direction: column; align-items: flex-start; margin: 20px 0 50px; gap: 10px;">
    <h2 style="margin: 0;">Добавление изображений</h2>
    <? 
    echo '
      <form name="formUploadImage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="'.$current_element['index'].'">
        <input type="file" autocomplete="off" name="picture" multiple>
        <input type="submit" value="Загрузить" style="margin: 0;">
      </form>
    ';
    ?>
  </div>
  <form action="/admin/edit_element.php?index=<?= $current_element["index"] ?>&action=edit_element" method="post">
  <table class="show_all_fields_<?= $_COOKIE["show_all_fields"] ?>">
    <tr>
      <td colspan="3" class="td_buttons"><div class="sticky">
          <input type="reset" value="Сбросить поля к исходным">
          <input type="submit" value="Применить">
          <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
          <a href="/admin" style="color: black;">
          <div style="cursor: pointer;
    width: 270px;
    box-sizing: border-box;
    padding: 5px 1px;
    display: inline-block;
    font-size: 1em;
	background-color: #E7FFD9;
    margin: 10px 10px;border-width: 2px;
    border-style: outset;
    border-color: buttonborder;">К списку элементов</div>
          <a/> </div></td>
    </tr>
    <tr>
      <td colspan="3" class=""><div>
          <?
          process_product_pictures( array( "model" => $current_element[ 'model' ], "brand" => $current_element[ "brand" ], "type" => $current_element[ "type" ] ) );
          $arr_images = getImagesFullArray( $current_element );
          //echo $current_element;
          //echo '<pre>';
          //var_dump($files_to_delete);
          //echo '</pre>';

          if ( is_array( $arr_images ) ) {
            foreach ( $arr_images as $image ) {

              echo "<span class='edit_element__image_item'><a target='_blank' href='" . $image[ "lg" ] . "'><img src='" . $image[ "130" ] . "' /></a><span data-brand='" . $current_element[ 'brand' ] . "' data-type='" . $current_element[ 'type' ] . "' data-model='" . $current_element[ 'model' ] . "' data-pic_url='" . $image[ "sm" ] . "' class='button_delete_red_small_round'>X</span></span> ";
            }
          }
          ?>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="3" class=""><table id="list">
          <?
          $table_fields = $db_work->getlist_table_fields();
          //var_dump($table_fields);
          if ( is_array( $table_fields )and count( $table_fields ) > 0 ) {
            foreach ( $rows as $row ) {
              echo $row;
            }
          }
          ?>
        </table></td>
    </tr>
    <tr>
      <td colspan="3" class="td_buttons"><input type="reset" value="Сбросить поля к исходным">
        <input type="submit" value="Применить">
        <input name="submit_and_close" type="submit" value="Сохранить и закрыть">
        <a href="/admin">
        <button style="cursor: pointer;
    width: 270px;
    box-sizing: border-box;
    padding: 5px 1px;
    display: inline-block;
    font-size: 1em;
	background-color: #E7FFD9;
    margin: 10px 10px;">К списку элементов</button>
        <a/></td>
    </tr>
  </table>
</form>
<div></div>
<script src="/admin/edit_element_scripts.js"></script>
<? include $core_admin_path . 'template/footer.php'; ?>
