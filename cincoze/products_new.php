<?php
session_start();
define("bullshit", 1);
include $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
include $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php";
$prices_out = '';
//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));

database_connect();
mysql_query("SET NAMES 'cp1251'");

$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php", "/", $vta[0]);
$var_to_array = str_replace("index.php", "", $var_to_array);
//echo $_SERVER['QUERY_STRING'];
$CANONICAL = $var_to_array;


//echo "sss=".$_SERVER['SCRIPT_FILENAME'];
//echo "sss=".$_SERVER['DOCUMENT_ROOT'];
//---------------content ---------------------
$out = '
<style>
.gray {background-color: rgb(245, 245, 245);}
</style>
<script>
function dich(num,link)
 {
if (link != "0") {
   $("#dd").html("<a id=\"biglightbox\" href=\'"+link+"\' rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" /><img src=\'"+num+"\'\"></span></a>");
} else {
 $("#dd").html("<img src=\'"+num+"\'\">");

};


 }
 /*
 $(function() {
    $( "#tabs" ).tabs({
      event: "mouseover"
    });
  });
*/
$(function() {
    $( "#tabs" ).tabs();
  });


$(document).ready(function(){
 $(\'.toclick\').click(function() {
  $(\'.lightbox\').prop(\'rel\', \'lightbox[1]\');
   $(this).children(\'.lightbox\').prop(\'rel\', \'box[1]\');
	});
	});

$(document).ready(function(){
 $(\'.mytab2 tr:even\').addClass(\'gray\');

	});

  </script> ';
//  echo $out;
//$num="MT8070iH";
$num = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
//echo $num;
$sql = "SELECT * FROM products_all WHERE `s_name` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);

$title = 'Cincoze ' . $r->model . ', ' . $r->diagonal . ' промышленный компьютер, ' . $r->cpu_type;
//$title = "Панельный компьютер ".$r->diagonal."&#8243; $r->model Cincoze, емкостной сенсорный дисплей, безвентиляторный, моноблок, поставки со склада";
$description = "Безвентиляторные промышленные панельные компьютеры Cincoze, емкостной сенсорный дисплей, мультитач";
$keywords = "Cincoze, безвентиляторный панельный компьютер, промышленный панельный компьютер, встраиваемый компьютер, панельный компьютер с сенсорным экраном,
панельный компьютер с пассивным охлаждением, промышленный компьютер с емкостным сенсором, промышленный компьютер мультитач, промышленный компьютер";
$alt = $r->diagonal . "&#8243; $r->model панельный компьютер Cincoze, изображение панельного компьютера $r->model, фото панельного компьютера $r->model";

$nav = '<br /><nav><a href="/">Главная</a>&nbsp;/&nbsp;<a href="/cincoze/">Компьютеры и мониторы ' . $r->brand . '</a>&nbsp;/&nbsp;Панельный компьютер Cincoze ' . $r->model . ' ' . $r->diagonal . '&#8243;</nav>';

$onst = show_stock($r, 1);
$min_table = min_ps($r->s_name . ',P1001', 5, 10, 350); // mins_in_row, mins_max, table_width
//$min_table .=''.min_ps('P1001', 6, 10, 350);

$vars = show_pc_variants($r->model);
//$im1=get_big_pic($r->model);

$im1 = '/images/cincoze/' . $r->s_name . '/' . $r->s_name . '_1.png';
if ($GLOBALS["net"] == 0) {
    if (file_exists($GLOBALS["path_to_real_files"] . '/images/cincoze/' . $r->s_name . '/lg/' . $r->s_name . '_1.png')) {
        $bim1 = '/images/cincoze/' . $r->s_name . '/lg/' . $r->s_name . '_1.png';
    } else {
        $bim1 = '';
    };
} else {
    $re = cu($GLOBALS["path_to_real_files"] . '/images/cincoze/' . $r->s_name . '/lg/' . $r->s_name . '_1.png');
    if ($re[0] > 0) {
        $bim1 = '/images/cincoze/' . $r->s_name . '/lg/' . $r->s_name . '_1.png';
    } else {
        $bim1 = '';
    };
};

if (!empty($bim1)) {
    $kartinka = "
<a id=\"biglightbox\" href=\"$bim1\" rel=\"lightbox[1]\"><span id=\"bigimage\" title=\"Увеличить\"><img class=\"lupa\" src=\"/images/zoom.png\" />
<img src='$im1' alt='$alt'></span></a>";
} else {
    $kartinka = "
<img src='$im1' alt='$alt'>";
};

if (($r->retail_price != '0') and ($r->retail_price != '')) {
    $price = "<td width=60 class=prpr title='Нажмите для пересчета в РУБ' >$r->retail_price</td><td class=val_name title='Нажмите для пересчета в РУБ'> USD </td>";
} else {
    $price = "<td width=100 style='  box-shadow: none;border: none;background: none;' class='zakazbut inline' idm='$r->model' onclick='show_backup_call(6, \"$r->model\")' >Цена&nbsp;по&nbsp;запросу</td><td></td>";
};
//----------------------------------right part content -----------------------
ob_start();
?>


<?= $nav ?><br>
    <table height=400px style="margin: 0 auto;">
    <tr>
        <td colspan=2 height=50px>
            <table>
                <tr>
                    <td width=840 align=left bfcolor=#cccccc><h1 class=big_pan_name>ПАНЕЛЬНЫЙ
                            КОМПЬЮТЕР <?= $r->diagonal ?> &#8243; <b><?= $r->brand ?> <?= $r->model ?></b></h1></td>
                    <td width=120>
                        <div class=pan_price_big title='Розничная цена'> Цена с НДС</div>
                    </td><?= $price ?></tr>
            </table>
            <div class=hc1>&nbsp;</div>
            <br>
        </td>
    </tr>
    <tr>
    <td valign=top align=center valign=center width=450px bfcolor=#eeeeee>
        <?
        $extra_model_name = str_replace("/", "_", $r->model);
        $extra_model_name = str_replace(" ", "_", $extra_model_name);
        $extra_model_name = str_replace("®", "_", $extra_model_name);
        echo print_pictures_in_detail_template($r->brand, $r->type, $extra_model_name, $r->pics_number); ?>
    </td>
    <td valign=top>


    <div id=cont_rp>

    <table width="100%">

        <tr>
            <td colspan="3"> &nbsp;</td>
        </tr>
        <tr>
            <td width="5">&nbsp;</td>
            <td width=80 class=h2_text>Наличие:</td>
            <td> <?= $onst ?></td>
            <td></td>
        </tr>

    </table><br>

    <table width="100%">
        <?
        if ($r->type == "panel_pc" && $r->diagonal > 0) {

            $search_diagonal = intval($r->diagonal) - 1;
            $search_diagonal2 = intval($r->diagonal) + 1;
            $nominal_diagonal = $r->diagonal;
            ?>
            <tr>
                <? if ($r->retail_price > 0): ?>
                    <td>
                        <div class=but_wr>
                            <div class='zakazbut addToCart' idm='<?= $r->model ?>'><span>В корзину</span></div>
                        </div>
                    </td>
                <? else: ?>
                    <td>
                        <div class=but_wr>
                            <div class='zakazbut disabled'><span>В корзину</span></div>
                        </div>
                    </td>
                <? endif; ?>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(2, "<?= $r->model ?>")'>
                            <span>Заказ в 1 клик</span></div>
                    </div>
                </td>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(1, "<?= $r->model ?>")'>
                            <span>Получить скидку</span></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_compare(this)'>
                            <span>В сравнение</span></div>
                    </div>
                </td>
                <td colspan=2>
                    <div class=but_wr>
                        <div class='link_advanced_search_wrapper'>
                            <a class="link_advanced_search"
                               href="/advanced_search.php?diagonal=<?= $nominal_diagonal ?>&min_diagonal=<?= $search_diagonal ?>&max_diagonal=<?= $search_diagonal2 ?>&types=1">
                                <span class="link_advanced_search_icon"></span>Подобрать панельные комп. с диагональю
                                <?= $r->diagonal ?>&Prime;
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        <? } else { ?>
            <tr>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut addToCart' idm='<?= $r->model ?>'><span>В корзину</span></div>
                    </div>
                </td>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_compare(this)'>
                            <span>В сравнение</span></div>
                    </div>
                </td>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(2, "<?= $r->model ?>")'>
                            <span>Заказ в 1 клик</span></div>
                    </div>
                </td>
                <td>
                    <div class=but_wr>
                        <div class='zakazbut' idm='<?= $r->model ?>' onclick='show_backup_call(1, "<?= $r->model ?>")'>
                            <span>Получить скидку</span></div>
                    </div>
                </td>
            </tr>

        <? } ?>
        <tr>
            <td colspan=4><br>
                <div class=hc1></div>
            </td>
        </tr>
    </table>

<?
$out .= ob_get_contents();
ob_end_clean();

$im = "<img src='/images/tick.png' width=15 style='vertical-align: middle;'>";
$he = "height=40 class=hl_text";
$vc = "valign=center";
if (preg_match('/P/i', $r->model)) {
    $with = 'емкостным сенсором';
} else {
    $with = 'резистивным сенсором';
}
;
$out .= "<br>
<table width=100%>
<tr><td valign=center>$im </td><td valign=middle $he>$r->diagonal\" безвентиляторный панельный компьютер с процессором $r->cpu_type " . ($r->cpu_speed / 1000) . "ГГц</td></tr>
<tr><td width=30>$im </td><td $he>Дисплей с разрешением $r->resolution и емкостным / резистивным сенсором</td></tr>
<tr><td width=30>$im </td><td $he>Полностью готов к работе, жесткий диск и оперативная память уже установлены</td></tr>
<tr><td>$im </td><td $he>Hапряжение питания компьютера " . $r->voltage_min . "-" . $r->voltage_max . " VDC, блок питания 220VAC - 12 VDC (опция)</td></tr>
<tr><td>$im </td><td $he>Возможна установка Windows 8, Windows 7</td></tr>
<tr><td>$im </td><td $he>Пылевлагозащита по фронту ( IP65 )</td></tr>
<tr><td>$im </td><td $he>2xGb LAN, 2хCOM, 4xUSB 2.0, 1xVGA, 4xDI/4xDO, 1xDP </td></tr>



</table>
</div>
";


// --------------------- end right part content -----------------------

$out .= "</td></tr></table>"; // end big table
// --------------------- end right part content -----------------------

if (!empty($vars)) {
    $out .= "<br><span class=big_pan_name><b>Возможные модификации:</b></span> <br><br>" . $vars;
}
;
//----------------------------------------end pics ----------------------------
//----------------------------tab1 -----------------------------------------
$bg1 = "style='background: #fefefe';"; //bgdedede";
$bg2 = "style='background: #f5f5f5';"; //bgdedede";

$ram = ($r->ram / 1000) . " Гб $r->ram_type";
$ram_max = (string)($r->ram_max / 1000) . " Гб";
$hdd = "$r->hdd_size_gb Гб $r->hdd_type $r->hdd_interface";
$dom = "<font color=#970207>зависит от модификации</font>";
$table_start = "<table width=100% class=mytab2 >";
$freq = $r->cpu_speed / 1000;

$mount = "";
if ($r->wall_mount != "")
    $mount .= "крепление в щит";
if ($r->vesa75 != "")
    $mount .= ", VESA 75x75";
if ($r->vesa100 != "")
    $mount .= ", VESA 100x100";

if ($r->cpu_fan == '') {
    $fan = 'безвентиляторное';
} else {
    $fan = $r->cpu_fan;
}
;

//  <tr><td class=par_name1>Аудио</td><td class=par_val1>$r->audio</td></tr>

$video_outputs = array();
if (!empty($r->vga_port))
    $video_outputs[] = $r->vga_port;
if (!empty($r->dvi_port)) {
    $video_outputs[] = $r->dvi_d;
} else if (!empty($r->dvi_d)) {
    $video_outputs[] = $r->dvi_d;
}
;
if (!empty($r->displayport))
    $video_outputs[] = $r->displayport;
if (!empty($r->hdmi))
    $video_outputs[] = $r->hdmi;

$sp_data1 = "
 <div>
 <span class=hpar>Дисплей</span><br>
 $table_start
 <tr><td class=par_name1>Диагональ</td><td class=par_val1>$r->diagonal\" " . (!preg_match('/-W/i', $r->model) ? '(4:3)' : '(16:9)') . "</td></tr>
 <tr><td class=par_name1>Разрешение</td><td class=par_val1>$r->resolution</td></tr>
 <tr><td class=par_name1>Яркость</td><td class=par_val1 >$r->brightness кд/м2</td></tr>
 <tr><td class=par_name1>Контрастность</td><td class=par_val1>$r->contrast</td></tr>
 <tr><td class=par_name1>Цветность</td><td class=par_val1>$r->colors цветов</td></tr>
 <tr><td class=par_name1>Углы обзора</td><td class=par_val1>$r->view_angle</td></tr>
 <tr><td class=par_name1>Размер пикселя</td><td class=par_val1>$r->pixel_pitch</td></tr>
 <tr><td class=par_name1>Время жизни подсветки (LED)</td><td class=par_val1>$r->backlight_life</td></tr>
 </table><br><br>

 <span class=hpar>Сенсор</span><br>
 $table_start
 <tr><td class=par_name1>Тип сенсора</td><td class=par_val1><strong>$r->touch</strong></td></tr>
 <tr><td class=par_name1>Контроллер сенсора</td><td class=par_val1>$r->touch_contr</td></tr>
 </table><br><br>

 <span class=hpar>Параметры</span><br>
 $table_start
 <tr><td class=par_name1>Процессор</td><td class=par_val1>$r->cpu_type</td></tr>
 <tr><td class=par_name1>Частота</td><td class=par_val1>$freq ГГц</td></tr>
 <tr><td class=par_name1>Чипсет</td><td class=par_val1>$r->chipset</td></tr>
  <tr><td class=par_name1>BIOS</td><td class=par_val1>AMI 64Mbit SPI</td></tr>

 <tr><td class=par_name1>Объем ОЗУ</td><td class=par_val1>" . ($r->ram / 1000) . "Гб </td></tr>
 <tr><td class=par_name1>Тип ОЗУ</td><td class=par_val1>" . $r->ram_slots . "x" . $r->ram_type . " 1066/1333МГц</td></tr>
 <tr><td class=par_name1>Максимально возможный объем ОЗУ</td><td class=par_val1>$ram_max</td></tr>
 <tr><td class=par_name1>Объем жесткого диска, тип</td><td class=par_val1>$r->hdd_size_gb Гб $r->hdd_type</td></tr>
 <tr><td class=par_name1>Место под жесткие диски, форм-фактор, интерфейс</td><td class=par_val1>$r->hdd_places X $r->hdd_inch\" $r->hdd_interface</td></tr>

    <tr><td class=par_name1>Сторожевой таймер</td><td class=par_val1>Поддерживает 1~255 секундный интервал </td></tr>
 <tr><td class=par_name1 >Беспроводные сети</td><td class=par_val1 >" . ((!empty($r->wifi) && ($r->sim)) ? $r->wifi . ', ' . $r->sim : $r->wifi . $r->sim) . "</td></tr>
 </table><br><br>

 <span class=hpar>Интерфейсы</span><br>
 $table_start
 <tr><td class=par_name1>Посл. интерфейсы</td><td class=par_val1>$r->serial_full</td></tr>
 <tr><td class=par_name1>USB Host</td><td class=par_val1>$r->usb_host</td></tr>
 <tr><td class=par_name1>Ethernet</td><td class=par_val1>$r->ethernet</td></tr>
 <tr><td class=par_name1>Слот SD карты </td><td class=par_val1>-</td></tr>
 <tr><td class=par_name1>Слот CFast </td><td class=par_val1>1xCFast</td></tr>
 <tr><td class=par_name1>PCI</td><td class=par_val1>" . ($r->pci_slot ? $r->pci_slot : '-') . "</td></tr>
 <tr><td class=par_name1>Видеовыходы</td><td class=par_val1>" . (implode(', ', $video_outputs)) . "</td></tr>
  <tr><td class=par_name1>Дискретные входы / выходы</td><td class=par_val1>4xDI/4xDO</td></tr>
    <tr><td class=par_name1>Встроенные динамики</td><td class=par_val1>" . ($r->speakers ? $r->speakers : '-') . "</td></tr>
   <tr><td class=par_name1>Линейный аудиовыход</td><td class=par_val1>$r->linear_out</td></tr>
    <tr><td class=par_name1>Вход микрофона</td><td class=par_val1>" . ($r->mic_in ? $r->mic_in : '-') . "</td></tr>
 </table></br></br>

  <span class=hpar>ОС</span><br>
 $table_start
 <tr><td class=par_name1>Возможна установка OC</td><td class=par_val1>$r->os</td></tr>
  </table><br><br>
 <span class=hpar>Конструкция</span><br>
 $table_start
 <tr><td class=par_name1>Материал корпуса</td><td class=par_val1>" . $r->case_material . "</td></tr>
 <tr><td class=par_name1>Степень защиты по фронту</td><td class=par_val1>IP65</td></tr>
 <tr><td class=par_name1>Способ охлаждения</td><td class=par_val1>" . $fan . "</td></tr>
 <tr><td class=par_name1>Варианты установки</td><td class=par_val1>" . $mount . "</td></tr>
 <tr><td class=par_name1>Выключатель питания</td><td class=par_val1> - </td></tr>
 <tr><td class=par_name1>Разъем питания</td><td class=par_val1>" . $r->power_connector . "</td></tr>
 <tr><td class=par_name1>Напряжение питания компьютера</td><td class=par_val1>" . $r->voltage_min . "-" . $r->voltage_max . " В</td></tr>
 <tr><td class=par_name1>Мощность</td><td class=par_val1>" . $r->power . " Вт</td></tr>
 <tr><td class=par_name1>Внешний блок питания</td><td class=par_val1>" . $r->power_adapter . "</td></tr>

 <tr><td class=par_name1>Габариты</td><td class=par_val1>$r->dimentions мм</td></tr>
 <tr><td class=par_name1>Вырез под посадку</td><td class=par_val1>$r->cutout мм</td></tr>
 <tr><td class=par_name1>Вес</td><td class=par_val1>$r->netto кг</td></tr>
 <tr><td class=par_name1>Рабочая температура</td><td class=par_val1>$r->temp_min&deg - $r->temp_max&deg</td></tr>
 <tr><td class=par_name1>Температура хранения</td><td class=par_val1>$r->temp_storage</td></tr>
  <tr><td class=par_name1>Относительная влажность</td><td class=par_val1>$r->humidity</td></tr>
    <tr><td class=par_name1>Вес</td><td class=par_val1>$r->netto кг</td></tr>
	 <tr><td class=par_name1>Комплект поставки</td><td class=par_val1>$r->set</td></tr>
 </table><br><br>

   <span class=hpar>Качество и безопасность</span><br>
 $table_start
 <tr><td class=par_name1>Сертификация</td><td class=par_val1>$r->certification</td></tr>

  ";

$sp_data1 .= "
</table><br><br>
</div>
";

//<tr><td class=par_name1>Установленная OC</td><td class=par_val1>$r->installed_os</td></tr>
//---------------------end tab1 -------------------------
//-------------spec ---------------------------

$dimim = '/images/cincoze/dim/' . $r->s_name . '.png';


$out .= "<br><br>
<div style='min-height: 500px; overflow: auto; margin: 0 auto;'>
<div id='tabs'>
  <ul>
    <li class='urlup' data='functions'><a href='#tabs-1'>ХАРАКТЕРИСТИКИ</a></li>
    <li class='urlup' data='dimensions'><a href='#tabs-2'>ГАБАРИТЫ</a></li>
    <!--li class='urlup' data='scheme'><a href='#tabs-3'>СХЕМЫ</a></li-->
    <li class='urlup' data='software'><a href='#tabs-4'>СКАЧАТЬ</a></li>
  </ul>
  <div id='tabs-1'><br />
   <h2>Технические характеристики $r->model</h2>
    $sp_data1
  </div>
  <div id='tabs-2'><br />
  <h2>Габариты $r->model</h2>
  <img src='$dimim' style='max-width:100%;'>
  <!--/div>
  <div id='tabs-3'><br /><h2>COM-порты панельного компьютера $r->model</h2><br /-->";

//------------------------
//$template_file = 'head.html';
$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $extra_model_name . "/";
ob_start(); ?>


    <meta property="og:title" content="<?= $title ?>"/>
    <meta property="og:image"
          content="<? echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $extra_model_name . '_1.png' ?>"/>
    <meta property='og:site_name' content='Русавтоматика'/>
    <link rel='image_src'
          href="<? echo 'http://www.rusavtomatika.com' . $imgRemoteDir . 'md/' . $extra_model_name . '_1.png' ?>">

<? $expansionParam = ob_get_clean();
$prices_out .= "<br><br>";
//-----------------end content
//$template_file = 'head.html';
$template_file = 'head_canonical.html';

//$head = head($template_file, $r->title, $r->description, $r->keywords, $expansionParam);
$head = setHeaderExpansionParam($template_file, $title, $r->description, $r->keywords, $expansionParam);

echo $head;
?>
    <div id="mes_backgr"></div>
    <div id="body_cont">
<? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
    <table width="100%" bgcolor="white">
        <tr height="93">
            <td width="300px">
                <a href="/"><img src="/images/logo2017.png"/></a>
            </td>
            <td></td>
        </tr>
    </table>
<?
top_menu();
search();
compare();
backup_call();
top_buttons();
basket();

/**/

//usd_rate();
//search();
//compare();
//backup_call();
//top_buttons();
temp1_no_menu();
show_price_val();
//temp1();
//left_menu();
/*
  echo "<br><br><div class=filter_case> <div class=filter>
  <center>ПОДБОР ПРОДУКЦИИ</center><br>
  СЕРИЯ 6000i<br>
  ДИАГОНАЛЬ 7\"<br>
  c SD картой
  c Ethernet
  с VNC сервером
  c алюмин. корпусом<br>";
 */
//basket();
add_to_basket();
popup_messages();
temp2();
echo "<article><div class='article_content_width_restriction'>";


$uuu = '';
if (!empty($_GET['tab'])) {
    if ($_GET[tab] == 'accessories') {
        $uuu = '$(\'a[href="#tabs-5"]\').click();';
    } else if ($_GET['tab'] == 'functions') {
        $uuu = '$(\'a[href="#tabs-1"]\').click();';
    } else if ($_GET['tab'] == 'software') {
        $uuu = '$(\'a[href="#tabs-4"]\').click();';
    } else if ($_GET['tab'] == 'dimensions') {
        $uuu = '$(\'a[href="#tabs-2"]\').click();';
    } else if ($_GET['tab'] == 'scheme') {
        $uuu = '$(\'a[href="#tabs-3"]\').click();';
    };
};

$out .= "
<script>
	$(document).ready(function(){
var urlbase = '$CANONICAL';
	$uuu
 $('.urlup').click(function() {
	 var dat = $(this).attr('data');
var nnew = 'https://'+location.hostname+urlbase+'?tab='+dat;

  if(nnew != window.location){
            window.history.pushState(null, null, nnew);
        }

	});

	});

function doclick(e) {

$('a[href=#'+e+']').click();

}
</script>";

echo $out;

//show_com_connector($r->model);
$out = "<br><br>


  </div>
  <div id='tabs-4'><br />";
//------------------------------download section --------------------------------

$mb = "/manuals/Manual_CV-100-P1001.pdf"; //Добавить мануал

$bro = "/manuals/$r->s_name.pdf";


$out .= "
  <div class=connectors>
  <h2>Файлы для работы с  панельным компьютером $r->model</h2>
  </div><br><br>

   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>
   <tr><td><div class=down_h>  Наименование </div></td><td width=100><div class=down_h >  Дата, размер</div></td><td><div class=down_h> Ссылка</div></td></tr>

   <tr><td><div class=down_item>  Описание панельного компьютера $r->model </div>
   <div class=down_item_descr>
   Описание панельного компьютера $r->model
   </div></td>
   <td><div class=dt_item>";
$out .= get_file_date($bro);
$out .= "</div>
   </td> </td><td><div class=down_item><a href='$bro'><img src=/images/manual.jpg></a><div> </td> </tr>

   <tr><td><div class=down_item>  Руководство пользователя панельных компьютеров Cincoze Crystal </div>
   <div class=down_item_descr>
    Характеристики моделей серии, начала работу с панельным компьютером, настройка BIOS.
   </div></td>
   <td><div class=dt_item>";
$out .= get_file_date($mb);
$out .= "</div>
   </td> </td><td><div class=down_item><a href='$mb'><img src=/images/manual.jpg></a><div> </td> </tr>


   </table><br /><br />
  ";


$out .= "
  </div>
</div><br /><br />
</div>
";


$out .= "<br /><br />";
//-----------------end content

echo $out;
echo "</div></article>";


temp3();
?>