<?php





session_start();

define("bullshit", 1);

include "../sc/dbcon.php";

include("../sc/lib_new.php");



//echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));



global $mysqli_db;

mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

$num = str_replace(".php", "", basename($_SERVER['PHP_SELF']));





$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";

$res = mysqli_query($mysqli_db, $sql) or die(mysqli_error($mysqli_db));

$r = mysqli_fetch_object($res);









//$im1 = get_big_pic($r->model);

$imgRemoteDir = "/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) . "/" . $r->model . "/";

$extra_openGraph = array(

    "openGraph_image" => "http://www.rusavtomatika.com/upload_files" . $imgRemoteDir . 'md/' . $r->model . '_1.png',

    "openGraph_title" => get_kw("title"),

    "openGraph_siteName" => "�������������"

);





$vta = (explode('?', $_SERVER['REQUEST_URI']));



$var_to_array = str_replace("/index.php", "/", $vta[0]);

$var_to_array = str_replace("index.php", "", $var_to_array);

//echo $_SERVER['QUERY_STRING'];

$CANONICAL = $var_to_array;



global $root_php;



$title = get_kw("title");



$title = "Samkoon ".$r->model." ". $r->diagonal."&Prime;"." ������ ���������";







//$title = $r->title;

$description = get_kw("descr");

$keywords = get_kw("kw");



$template_file = 'head_canonical.html';

$head = head($template_file, $title, $description, $keywords);

$head = str_replace('[>CANONICAL<]', 'https://' . $_SERVER["HTTP_HOST"] . $CANONICAL, $head);



echo $head;

?>

<div id='mes_backgr'></div>

<div id='body_cont'>

    <? include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/header_menu.php"; ?>

    <table width='100%' bgcolor='white'>

        <tr height='93'>

            <td width='300px'>

                <a href="/"><img src="/images/logo2017.png"/></a>

            </td>

            <td></td>

        </tr>

    </table>

    <?

    top_menu();

    // usd_rate();

    search();

    compare();

    backup_call();



    top_buttons();

    basket();

    temp1_no_menu();

    show_price_val($r->currency);



    add_to_basket();

    popup_messages();

    temp2();



    //echo "sss=".$_SERVER['SCRIPT_FILENAME'];

    //echo "sss=".$_SERVER['DOCUMENT_ROOT'];

    //---------------content ---------------------

    ?>

    <script>

        function dich(num) {

            $("#dd").html("<img src='" + num + "'>");

        }



        /*

         $(function() {

         $( "#tabs" ).tabs({

         event: "mouseover"

         });

         });

         */

        $(function () {

            $("#tabs").tabs();

        });





    </script>



    <style>



        article {

            text-align: center;

        }

    </style>

    <?

    //$num="MT8070iH";





    $onst = show_stock($r, 1);

    // $min_table = miniatures($r->model, 5, 10, 350); // mins_in_row, mins_max, table_width



    $nav = '<br /><nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/samkoon/">������ ��������� Samkoon</a>&nbsp;/&nbsp;������ ��������� ' . $r->diagonal . '&#8243; ' . $r->brand . ' ' . $r->model . '</nav>';





    $search_diagonal = intval($r->diagonal) - 1;



    if ($search_diagonal == 4)

        $search_diagonal = 3;



    if ($search_diagonal == 10)

        $search_diagonal = 9;

    /* if ($search_diagonal == 11)

      $search_diagonal = 10; */



    $search_diagonal2 = intval($r->diagonal) + 1;;

    /* if ($search_diagonal2 == 10)

      $search_diagonal2 = $search_diagonal2 + 1;

     */

    $nominal_diagonal = $r->diagonal;

    switch ($r->type) {

        case "hmi":

            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .

                'diagonal=' . $nominal_diagonal .

                '&min_diagonal=' . $search_diagonal .

                '&max_diagonal=' . $search_diagonal2 .

                '&types=0"><span class="link_advanced_search_icon"></span>��������� ������� ������ � ���������� ' . $nominal_diagonal . '&Prime;</a>';

            break;

        case "open_hmi":

            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?' .

                'diagonal=' . $nominal_diagonal .

                'min_diagonal=' .

                $search_diagonal .

                '&max_diagonal=' .

                $search_diagonal2 .

                '&types=0"><span class="link_advanced_search_icon"></span>��������� ������� ������ � ���������� ' . $nominal_diagonal . '&Prime;</a>';

            break;

        case "panel_pc":

            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?'

                . 'diagonal=' . $nominal_diagonal .

                '&min_diagonal=' .

                $search_diagonal .

                '&max_diagonal=' .

                $search_diagonal2 .

                '&types=1"><span class="link_advanced_search_icon"></span>��������� ��������� ���������� � ���������� ' . $nominal_diagonal . '&Prime;</a>';

            break;

        case "cloud_hmi":

        case "Gateway":

        case "machine-tv-interface":

            $podbor_text = "��������� ��� ���������� Weintek ��� �������";

            $link_advanced_search = '<a class="link_advanced_search"  href="/advanced_search.php?diagonals=1&brand=Weintek&types=456"><span class="link_advanced_search_icon"></span>' . $podbor_text . '</a>';

            break;



        default:

            $podbor_text = "";

            $link_advanced_search = '';

            break;

    }





    ob_start(); ?>

    <div class="block_content">



        <article>

            <?= $nav ?><br>

            <table style="width: 100%; padding: 0px 0px 50px;">

                <tr>

                    <td colspan=2 height=50px>

                        <table>

                            <tr>

                                <td width=840 align=left bfcolor=#cccccc>

                                    <h1 class=big_pan_name>������ ��������� <?= $r->diagonal ?>&#8243;

                                        <b><?= $r->brand ?> <?= $r->model ?></b></h1>

                                </td>

                                <td width=120>

                                    <div class=pan_price_big title='��������� ����'> ���� � ���</div>

                                </td>

                                <? if (($r->retail_price != '0') and ($r->retail_price != '')): ?>

                                    <? if ($r->currency === "USD"): ?>

                                        <td width=60 class=prpr

                                            title='������� ��� ��������� � ���'><?= $r->retail_price ?></td>

                                        <td class=val_name title='������� ��� ��������� � ���'> USD</td>

                                    <? elseif ($r->currency === "RUR"): ?>

                                        <td width=60><?= $r->retail_price ?></td>

                                        <td> ���</td>

                                    <? endif; ?>

                                <? else: ?>

                                    <td width="60" colspan="2" style="padding: 0px 20px;border: none;background: none;"

                                        class="zakazbut" idm="<?= $r->model ?>"

                                        onclick="show_backup_call(6,'<?= $r->model ?>')">

                                        <div> ��&nbsp;�������</div>

                                    </td>



                                <? endif; ?>



                            </tr>





                        </table>

                        <div class="hc1">&nbsp;</div>

                        <br>

                    </td>

                </tr>

                <tr>

                    <td valign=top align=center valign=center width="50%" bfcolor=#eeeeee>

                        <?= print_pictures_in_detail_template($r->brand, $r->type, $r->model, $r->pics_number) ?>

                    </td>





                    <td valign=top><?

                        echo ob_get_clean();



                        ob_start(); ?>

                        <div id=cont_rp>



                            <table width=100%>



                                <tr>

                                    <td colspan=3> &nbsp;</td>

                                </tr>

                                <tr>

                                    <td width=5>&nbsp;</td>

                                    <td width=80 class=h2_text>�������:</td>

                                    <td><?= $onst ?></td>

                                    <td></td>

                                </tr>



                            </table>

                            <br>



                            <table>

                                <tr>

                                    <td>

                                        <div class="but_wr">

                                            <div class="zakazbut addToCart" idm="<?= $r->model ?>">

                                                <span>� �������</span></div>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="but_wr">

                                            <div class="zakazbut" idm="<?= $r->model ?>" onclick="show_compare(this)">

                                                <span>� ���������</span></div>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="but_wr">

                                            <div class="zakazbut" idm="<?= $r->model ?>"

                                                 onclick="show_backup_call(2,'<?= $r->model ?>')">

                                                <span>����� � 1 ����</span></div>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="but_wr">

                                            <div class="zakazbut" idm="<?= $r->model ?>"

                                                 onclick="show_backup_call(1,'<?= $r->model ?>')">

                                                <span>�������� ������</span></div>

                                        </div>

                                    </td>

                                </tr>

                                <? if ($link_advanced_search): ?>

                                    <tr>

                                        <td colspan="4">

                                            <div class=but_wr>

                                                <div class='link_advanced_search_wrapper'><?= $link_advanced_search ?></div>

                                            </div>

                                        </td>

                                    </tr>

                                <? endif; ?>





                                <tr>

                                    <td colspan=4><br>

                                        <div class=hc1></div>

                                    </td>

                                </tr>

                            </table>





                            <?

                            echo ob_get_clean();



                            $proj_load = "";



                            if ($r->text_features == '') {





                                //----------------------------------right part content -----------------------





                                $im = "<img src='../images/tick.png' width=15 style='vertical-align: middle;'>";

                                $he = "height=40 class=hl_text";

                                $vc = "valign=center";

                                echo "<br>";





                                if ($r->usb_client != "")

                                    $proj_load .= "� �� �� USB";

                                if ($r->ethernet != "") {

                                    if ($proj_load != "")

                                        $proj_load .= ", ";

                                    $proj_load .= "� �� �� Ethernet";

                                }



                                if ($r->usb_host != "")

                                    $proj_load .= ", � ������";

                                if ($r->sdcard != "")

                                    $proj_load .= ", � SD �����";



                                $inter = $r->serial . ", RTC";

                                if ($r->ethernet != "")

                                    $inter .= ", Ethernet";

                                if ($r->usb_host != "")

                                    $inter .= ", USB host";

                                if ($r->sdcard != "")

                                    $inter .= ", SD �����";

                                if ($r->can_bus != "")

                                    $inter .= ", CAN";

                                if ($r->linear_out != "")

                                    $inter .= ", �������� ����� �����";



                                $remote = "";

                                if ($r->ethernet != "")

                                    $remote = "<tr><td>$im </td><td $he>��������� ������ �� VNC, FTP, EasyAccess </td></tr>";



                                $fastgr = "";

                                if ($r->series == "iE")

                                    $fastgr = "<tr><td>$im </td><td $he>������� ������ � �������� <br>( �� 10 ��� �������, ��� � ������ ������ )</td></tr>";

                                $isoports = "";

                                if ($r->series == "iE")

                                    $isoports = "<tr><td>$im </td><td $he>������ �������������� �������� ���� ������</td></tr>";



                                if ($r->os != '') {

                                    $ospus = "<tr><td>$im </td><td $he>������������ �������: $r->os </td></tr>";

                                } else {

                                    $ospus = "";

                                };



                                echo "<br>

<table width=100%>

<tr><td width=30>$im </td><td $he>��������� ��������� ������ ���������</td></tr>

<tr><td valign=center>$im </td><td valign=middle $he>��: $r->software (����������)</td></tr>



<tr><td>$im </td><td $he>$inter</td></tr>

<tr><td>$im </td><td $he>�������� �������: $proj_load</td></tr>

$fastgr

$isoports

$ospus







</table>

</div>

";

                            }else{

                                echo "<div class='catalog_detail_features'>".$r->text_features."</div>";

                            }



                            if ($r->usb_client != "")

                                $proj_load .= "� �� �� USB";

                            if ($r->ethernet != "") {

                                if ($proj_load != "")

                                    $proj_load .= ", ";

                                $proj_load .= "� �� �� Ethernet";

                            }



                            if ($r->usb_host != "")

                                $proj_load .= ", � ������";

                            if ($r->sdcard != "")

                                $proj_load .= ", � SD �����";













                            // --------------------- end right part content -----------------------



                            echo "</td></tr></table>"; // end big table

                            //----------------------------------------end pics ----------------------------



                            $bg1 = "style='background: #fefefe';";

                            $bg2 = "style='background: #f5f5f5';";

                            $table_start = "<table width=100% class=mytab2 cellpadding=0 cellspacing=0 border=1 bordercolor=#dddddd>";





                            //----------------------------tab1 -----------------------------------------

                            if ($r->software == "EasyBuilder8000")

                                $soft = " <tr><td class='par_name1  '>�� ��� ���������� ��������</td><td class='par_val1  '>EasyBuilder8000</td></tr> ";



                            if ($r->software == "EasyBuilderPro")

                                $soft = " <tr><td class='par_name1  '>�� ��� ���������� ��������</td><td class='par_val1  '>EasyBuilderPro</td></tr> ";



                            if ($r->software == "")

                                $soft .= "

 <tr><td class='par_name1  '>������������ �������</td><td class='par_val1  '>$r->os</td></tr> ";



                            if ($r->ethernet != "" && $r->software != "") {

                                $dop = "<tr><td class='par_name1  '>��������� ������ � ������</td><td class='par_val1  '>FTP(������, �������, ������ �������), VNC (��������� ������),<br>

   EasyAccess (��������� ������, �������� ������� )</td></tr>

   <tr><td class='par_name1  '>Ftp ������ � ������ ������</td><td class='par_val1  '>" . ($r->ftp_access_hmi_mem ? "����" : "-") . "</td></tr>

   <tr><td class='par_name1  '>Ftp ������ � SD ����� � ������</td><td class='par_val1  '>" . ($r->ftp_access_sd_usb ? "����" : "-") . "</td></tr>

   ";

                            } else

                                $dop = "";



                            $arch = "������ ������";

                            if ($r->usb_host != "")

                                $arch .= ", ������";

                            if ($r->sdcard != "")

                                $arch .= ", SD �����";



                            $modbus = "RTU, ASCII, Master, Slave";

                            if ($r->ethernet != "")

                                $modbus .= ", TCP/IP";



                            $mount = "";

                            if ($r->wall_mount != "")

                                $mount .= "� ���";

                            if ($r->vesa75 != "")

                                $mount .= ", VESA 75x75";

                            if ($r->vesa100 != "")

                                $mount .= ", VESA 100x100";



                            $sp_data1 = "

 <div style='width:90%;'>

 <span class=hpar>�������</span><br>

 $table_start

 <tr><td class='par_name1  '>���������</td><td class='par_val1  '>$r->diagonal" . "&#8243;</td></tr>

 <tr><td class='par_name1  '>����������</td><td class='par_val1  '>$r->resolution</td></tr>

 <tr><td class='par_name1  '>�������</td><td class=par_val1   >$r->brightness ��/�2</td></tr>

 <tr><td class='par_name1  '>�������������</td><td class='par_val1  '>$r->contrast</td></tr>

 <tr><td class='par_name1  '>���������</td><td class='par_val1  '>$r->colors ������</td></tr>

 <tr><td class='par_name1  '>��� ���������</td><td class='par_val1  '>$r->backlight</td></tr>

 <tr><td class='par_name1  '>����� ����� ���������</td><td class='par_val1  '>$r->backlight_life �</td></tr>

 <tr><td class='par_name1  '>��� �������</td><td class='par_val1  '>$r->touch</td></tr>

 </table><br><br>



 <span class=hpar>���������</span><br>

 $table_start



 <tr><td class='par_name1  '>���������</td><td class='par_val1  '>$r->cpu_type</td></tr>

 <tr><td class='par_name1  '>�������</td><td class='par_val1 cpu_speed '>$r->cpu_speed ���</td></tr>

 <tr><td class='par_name1  '>���</td><td class='par_val1  '>$r->ram ��</td></tr>

 <tr><td class='par_name1  '>Flash ( ���������� )</td><td class='par_val1  '>$r->flash ��</td></tr>

 <tr><td class='par_name1  '>RTC ( ���� ��������� ������� )</td><td class='par_val1  '>" . ($r->rtc ? $r->rtc : '-') . "</td></tr>

 <tr><td class='par_name1  '>���������� �������</td><td class='par_val1  '>$r->voltage_min-$r->voltage_max � DC</td></tr>

 <tr><td class='par_name1  '>������������ ���</td><td class='par_val1  '>$r->current �</td></tr>

 </table><br><br>



 <span class=hpar>����������</span><br>

 $table_start

 <tr><td class='par_name1  '>���������������� ����������</td><td class='par_val1  '>$r->serial_full</td></tr>

 <tr><td class='par_name1  '>��������� Modbus</td><td class='par_val1  '>$modbus</td></tr>

 <tr><td class='par_name1  '>��������� MPI</td><td class='par_val1  '>-</td></tr>

 <tr><td class='par_name1  '>USB Host</td><td class='par_val1  '>" . ($r->usb_host ? $r->usb_host : '-') . "</td></tr>

 <tr><td class='par_name1  '>USB Client</td><td class='par_val1  '>" . ($r->usb_client ? $r->usb_client : '-') . "</td></tr>

 <tr><td class='par_name1  '>���� SD �����</td><td class='par_val1  '>" . ($r->sdcard ? $r->sdcard : '-') . "</td></tr>";

                            ob_start(); ?>



                <tr>

                    <td class=par_name1>Ethernet</td>

                    <td class=par_val1><?= ($r->ethernet ? $r->ethernet : '-') ?></td>

                </tr>

                <?

                $sp_data1 .= ob_get_clean();

                $sp_data1 .= "

 <tr><td class='par_name1  '>�������� ����������</td><td class='par_val1  '>" . ($r->linear_out ? $r->linear_out : '-') . "</td></tr>

 <tr><td class='par_name1  '>���������</td><td class='par_val1  '>" . ($r->video_input ? $r->video_input : '-') . "</td></tr>

 <tr><td class='par_name1  '>CAN</td><td class='par_val1  '>" . ($r->can_bus ? $r->can_bus : '-') . "</td></tr>

 </table><br><br>



 <span class=hpar>�����������</span><br>

 $table_start

 <tr><td class='par_name1  '>�������� �������</td><td class='par_val1  '>$r->case_material</td></tr>

 <tr><td class='par_name1  '>������� ������ �� ������</td><td class='par_val1  '>IP65</td></tr>

 <tr><td class='par_name1  '>������ ����������</td><td class='par_val1  '>" . ($r->cpu_fan ? $r->cpu_fan : "����������������") . "</td></tr>

 <tr><td class='par_name1  '>�������� ���������</td><td class='par_val1  '>$mount</td></tr>

 <tr><td class='par_name1  '>�������� ��������</td><td class='par_val1  '>$r->set</td></tr>

 <tr><td class='par_name1  '>������ �������</td><td class='par_val1  '>$r->power_connector</td></tr>

 <tr><td class='par_name1  '>��������</td><td class='par_val1  '>$r->dimentions ��</td></tr>

 <tr><td class='par_name1  '>����� ��� �������</td><td class='par_val1  '>$r->cutout ��</td></tr>

 <tr><td class='par_name1  '>���</td><td class='par_val1  '>$r->netto ��</td></tr>

 <tr><td class='par_name1  '>������� �����������</td><td class='par_val1  '>$r->temp_min&deg - $r->temp_max&deg</td></tr>

 </table><br><br>";



                if ($r->model != "SK-070HE" and $r->model != "SK-043HE") {

                    $sp_data1 .= "

  <span class=hpar>�O</span><br>

 $table_start

 <tr><td class='par_name1  '>�� ��� ���������� ��������</td><td class='par_val1  '>$r->software</td></tr>

 <tr><td class='par_name1  '>������������ ���������� ������� � �������</td><td class='par_val1  '>$r->max_windows_in_project</td></tr>

 <tr><td class='par_name1  '>�������� USB (��� �������� ������� � �� � ������ )</td><td class='par_val1  '>���������� ������� � ���������� ( �� ������� \"�������\")</td></tr>

 <tr><td class='par_name1  '>�������� ��� ������ � �������������</td><td class='par_val1  '>��� ����������� � ������</td></tr>

 <tr><td class='par_name1  '>����������� ���������� ������� ������</td><td class='par_val1  '>$arch</td></tr>

 <tr><td class='par_name1  '>������� �������� ������� � ������</td><td class='par_val1  '>$proj_load</td></tr>

 <tr><td class='par_name1  '>������������ ������ �������</td><td class='par_val1  '>$r->project_size_mb ��</td></tr>

 <tr><td class='par_name1  '>����� ������ ��� ���������� ������� � ������</td><td class='par_val1  '>$r->history_data_size_mb ��</td></tr>



 <tr><td class='par_name1  '>����������� �������� ���������������� ����������</td><td class='par_val1  '>����</td></tr>

 <tr><td class='par_name1  '>������������ �������</td><td class='par_val1  '>" . (($r->os != '') ? $r->os : "��������, ��� � ���� � ������, �� � �� �������� ���������� �������� ������. ���������� ��������� �������

���������������� ����������� �����. ����������� �����

  ������������ ������ ���� �������������, ������� ������������� $r->software") . " </td></tr>



 </table></div><br><br>

  ";

                } else {

                    $sp_data1 .= "

  <span class=hpar>�O</span><br>

 $table_start

 <tr><td class='par_name1  '>�� ��� ���������� ��������</td><td class='par_val1  '>$r->software</td></tr></table></div><br><br>";

                }





                //---------------------end tab1 -------------------------

                //-------------spec ---------------------------





                if ($GLOBALS["net"] == 0) {

                    if (file_exists($GLOBALS["path_to_real_files"] . '/images/samkoon/dim/' . $r->model . '.png')) {

                        $dimensions = "<img src='/images/samkoon/dim/" . $r->model . ".png'>";

                    }

                } else {

                    $re = cu($GLOBALS["path_to_real_files"] . '/images/samkoon/dim/' . $r->model . '.png');

                    if ($re[0] > 0) {

                        $dimensions = "<img src='/images/samkoon/dim/" . $r->model . ".png' style='max-width:900px;'>";

                    } else {

                        $dimensions = '';

                    };

                };



                echo "<br><br>

<div style='width:100%; min-height: 500px; overflow: auto; display: inline-block;'>

<div id='tabs'>

  <ul>

    <li class='urlup' data='functions'><a href='#tabs-1'>��������������</a></li>

    " . (($dimensions != '') ? "<li class='urlup' data='dimensions'><a href='#tabs-2'>��������</a></li>" : "") . "

    <li class='urlup' data='scheme'><a href='#tabs-3'>�����</a></li>

    <li class='urlup' data='software'><a href='#tabs-4'>�������</a></li>

  </ul>

  <div id='tabs-1'>

  <h2>����������� �������������� $r->model</h2>

    $sp_data1

  </div>";



                if ($dimensions != '') {

                    echo "<div id='tabs-2'>

	  <h2>�������� $r->model</h2>

	   $dimensions

	  </div>";

                }



                echo "<div id='tabs-3'>

  <div class=connectors>

  <h2>COM-����� ������ ��������� $r->model</h2>

  </div><br><br>

  ";



                show_com_connector($r->model);

                echo "

  </div>

  <div id='tabs-4'>";

                //------------------------------download section --------------------------------

                // $sk="/soft/SKWorkshop/setup_SK_V5_3100900.rar";

                $sk = $GLOBALS["SKWorkshop_link"];

                $drv = "/soft/SKWorkshop/usb_drivers_sk_series.rar";

                $skm = "/manuals/SK-User manual_RUS.pdf";

                $Software_samkoon_sktool = "/soft/SKTOOL/setup_SKTOOL.rar";

                $Software_samkoon_satool = "/soft/SATOOL/setup_SATOOL.zip";

                $Software_samkoon_satool_version = "6.0.0.36";



                $Software_samkoon_sktool_help = "/soft/SKTOOL/SKTOOL Help.pdf";

                $Software_samkoon_satool_help = "/manuals/SATOOL/SATOOL-Software_Help_E.chm.zip";



                $Software_samkoon_sktool_version = "/soft/SKTOOL/setup_SKTOOL.rar";





                if ($r->brochure != '') {

                    $bro = "manuals/$r->brochure";

                } else {

                    $bro = 'manuals' . $r->model . '.pdf';

                };



                $scat = "/manuals/samkoon_catalogue.pdf";

                $ver = file_get_contents($GLOBALS["SKWorkshop_version"]);

                echo "

  <div class=connectors>

  <h2>����� ��� ������ �  ������� ��������� $r->model</h2>

  </div><br><br>



   <table cellpadding=0 cellspacing=0 border=1 bordercolor=#cccccc width=900>

   <tr><td><div class=down_h>  ������������ </div></td><td width=100><div class=down_h>  ����, ������</div></td><td><div class=down_h> ������</div></td></tr>";



                if ($r->series == 'SK' and $r->software != 'SKTOOL') {

                    echo "<tr><td><div class=down_item>�� SK Workshop $ver </div>

   <div class=down_item_descr>

   �� SK Workshop  - ����������� ����������� ��� �������� �������� ��� ������������ ������� Samkoon ����� SK.

   �� ��������� ���������, ��� ����� ��������� � ������������ ��� �����-���� �����������.

   ����� ��������� �� ���������� ��������� USB �������� ��� �������� ������� � ������������ ������ �� USB( ��. ���� )

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($sk);

                    echo "</div>

   </td><td style='text-align:center;'><div class=down_item><a href='$sk'><img src=/images/soft.jpg></a><div> </td> </tr>";

                };





                if ($r->software == 'SKTOOL') {

                    echo "<tr><td><div class=down_item>�� SKTool  </div>

   <div class=down_item_descr>

   �� SKTOOL  - ����������� ����������� ��� �������� �������� ��� ������������ ������� Samkoon: SK-035F,

SK-043F,  SK-043H,  SK-050H,  SK-070F,  SK-070H,SK-070F,  SK-102H,  SK-121F.<br>

   �� ��������� ���������, ��� ����� ��������� � ������������ ��� �����-���� �����������.

   ����� ��������� �� ���������� ��������� USB �������� ��� �������� ������� � ������������ ������ �� USB( ��. ���� )

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($Software_samkoon_sktool);

                    echo "</div>

   </td><td style='text-align:center;'><div class=down_item><a href='http://rusavtomatika.com$Software_samkoon_sktool'><img src=/images/soft.jpg></a><div> </td> </tr>";

                };

                if ($r->software == 'SATOOL') {

                    echo "<tr><td><div class=down_item>�� SATool ������ $Software_samkoon_satool_version </div>

   <div class=down_item_descr>

   ����������� ����������� ��� �������� �������� ��� ������������ ������� Samkoon ����� EA. �� ��������� ���������, ��� ����� ��������� � ������������ ��� �����-���� �����������.

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($Software_samkoon_satool);

                    echo "</div>

   </td> </td>

   <td style='text-align:center;'>

   <div class=down_item>"

                        . "<a href='http://rusavtomatika.com$Software_samkoon_satool'><img src=/images/zip-small.png></a>"

                        . "<div>"

                        . "</td>"

                        . "</tr>";

                    /*         * ************************** */

                    echo "<tr><td><div class=down_item>����������� �� SATool</div>

   <div class=down_item_descr> �� ���������� �����</div></td>

   <td><div class=dt_item>";

                    echo get_file_date($Software_samkoon_satool_help);

                    echo "</div>

   </td> </td>

   <td style='text-align:center;'>

   <div class=down_item>"

                        . "<a href='http://rusavtomatika.com$Software_samkoon_satool_help'><img src=/images/chm.png></a>"

                        . "<div>"

                        . "</td>"

                        . "</tr>";

                };





                if ($r->software == 'SKTOOL') {

                    echo "<tr><td><div class=down_item>  �������� �� SKTOOL </div>

   <div class=down_item_descr>

   ����������� ������������ �� �� SK SKTOOL �� ���������� �����

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($Software_samkoon_sktool_help);

                    echo "</div>

   </td> </td><td style='text-align:center;'><div class=down_item><a href='/$Software_samkoon_sktool_help'><img src=/images/pdf.png></a><div> </td> </tr>";

                };



                if ($r->series != 'EA') {

                    echo "<tr><td><div class=down_item>USB ��������</div>

   <div class=down_item_descr>

   USB �������� ��� �������� ������� � �� � ������������ ������ Samkoon

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($drv);

                    echo "</div>

   </td> <td style='text-align:center;'><div class=down_item><a href='$drv'><img src=/images/soft.jpg></a><div> </td> </tr>";

                }

                if ($r->model == 'OP-835') {

                    echo "<tr><td><div class=down_item>SamDrawV3.3</div></td>



   <td><div class='dt_item'>09-11-2016<br>19.1&nbsp;��</div>

   </td>

   <td style='text-align:center;'><div class=down_item><a href='/images/samkoon/soft/SamDrawV3.3.zip'><img src=/images/soft.jpg></a><div> </td> </tr>";

                }

                if ($r->series == 'SK' and $r->software != 'SKTOOL') {



                    echo "<tr><td><div class=down_item>  �������� �� SK Workshop </div>

   <div class=down_item_descr>

   ����������� ������������ �� �� SK Workshop �� ������� �����

   </div></td>

   <td><div class=dt_item>";

                    echo get_file_date($skm);

                    echo "</div>

   </td> </td><td style='text-align:center;'><div class=down_item><a href='$skm'><img src=/images/pdf.png></a><div> </td> </tr>";

                };



                if (in_array($r->series, array("AK", "EA", "SA", "SK",))) {

                    ?>

                    <tr>

                        <td>

                            <div class=down_item> ����������� �� ����������� ������� Samkoon ����� AK, EA, SA, SK</div>

                        </td>

                        <td>

                            <div class=dt_item>02.11.2018 18.4 ��</div>

                        </td>

                        <td style='text-align:center;'>

                            <div class=down_item>

                                <a href='/manuals/Samkoon-HMI-instruction.pdf'>

                                    <img src="/images/pdf.png">

                                </a>

                            </div>

                        </td>

                    </tr>

                    <?

                };



                //������



                /*                if ($GLOBALS["net"] == 0) {

                                    if (file_exists($root_php . $bro)) {

                                        $ine = 1;

                                        $fs = (sprintf("%u", filesize($root_php . $bro)) + 0) / 1000;

                                        $t = date("d-m-Y", filemtime($root_php . $bro));

                                    } else {

                                        $ine = 0;

                                    };

                                } else {

                                    $re = cu($root_php . '/' . $bro);

                                    if ($re[0] > 0) {

                                        $ine = 1;

                                        $t = date("d-m-Y", $re[1]);

                                        $fs = (sprintf("%u", $re[0]) + 0) / 1000;

                                    } else {

                                        $ine = 0;

                                    };

                                };



                                if ($fs > 1000) {

                                    $s = round($fs / 1000, 2) . '&nbsp;��';

                                } else {

                                    $s = round($fs, 0) . '&nbsp;��';

                                };

                                if ($ine == 1) {

                                    $soft5 = "

                 <tr><td><div class=down_item> �������� ������������ ������ $r->model </div></td>

                   <td><div class=dt_item>" . $t . "<br>" . $s . "</div></td>

                   <td style='text-align:center;'><div class=down_item><a href='/$bro'><img src=/images/pdf.png></a></div></td></tr>

                 ";

                                } else {

                                    $soft5 = '';

                                };*/





                /*                //����������� ������������

                                if (preg_match('/OP.*?835/', $r->model)) {

                                    $bro = "manuals/OP835_user_manual.pdf";



                                    if ($GLOBALS["net"] == 0) {

                                        if (file_exists($root_php . $bro)) {

                                            $ine = 1;

                                            $fs = (sprintf("%u", filesize($root_php . $bro)) + 0) / 1000;

                                            $t = date("d-m-Y", filemtime($root_php . $bro));

                                        } else {

                                            $ine = 0;

                                        };

                                    } else {

                                        $re = cu($root_php . '/' . $bro);

                                        if ($re[0] > 0) {

                                            $ine = 1;

                                            $t = date("d-m-Y", $re[1]);

                                            $fs = (sprintf("%u", $re[0]) + 0) / 1000;

                                        } else {

                                            $ine = 0;

                                        };

                                    };



                                    if ($fs > 1000) {

                                        $s = round($fs / 1000, 2) . '&nbsp;��';

                                    } else {

                                        $s = round($fs, 0) . '&nbsp;��';

                                    };

                                    if ($ine == 1) {

                                        $soft6 = "

                 <tr><td><div class=down_item> ����������� ������������ $r->model </div></td>

                   <td><div class=dt_item>" . $t . "<br>(eng)<br />" . $s . "</div></td>

                   <td style='text-align:center;'><div class=down_item><a href='/$bro'><img src=/images/pdf.png></a></div></td></tr>

                 ";

                                    } else {

                                        $soft6 = '';

                                    };

                                } else {

                                    $soft6 = '';

                                };



                                echo "$soft5

                   $soft6";*/

                ?>

                <tr>

                    <td>

                        <div class=down_item> ������� ������� Samkoon</div>

                        <div class=down_item_descr> ������� ������� Samkoon, ������� �������������</div>

                    </td>

                    <td>

                        <div class=dt_item><? echo get_file_date($scat); ?></div>

                    </td>

                    <td style='text-align:center;'>

                        <div class=down_item><a href='<?= $scat ?>'><img src="/images/pdf.png"></a>

                            <div>

                    </td>

                </tr>

            </table>

            <br/><br/>

    </div>

</div></div>

</div>

<?

$uuu = "";

if (isset($_GET["tab"]) && !empty($_GET["tab"])) {

    if ($_GET["tab"] == 'accessories') {

        $uuu = '$(\'a[href="#tabs-5"]\').click();';

    } else if ($_GET["tab"] == 'functions') {

        $uuu = '$(\'a[href="#tabs-1"]\').click();';

    } else if ($_GET["tab"] == 'software') {

        $uuu = '$(\'a[href="#tabs-4"]\').click();';

    } else if ($_GET["tab"] == 'dimensions') {

        $uuu = '$(\'a[href="#tabs-2"]\').click();';

    } else if ($_GET["tab"] == 'scheme') {

        $uuu = '$(\'a[href="#tabs-3"]\').click();';

    };

};



echo "

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





echo "<br><br>";

//-----------------end content

?></article><?

temp3();

?>

