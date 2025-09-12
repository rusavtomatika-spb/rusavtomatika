<?
$vta = (explode('?', $_SERVER['REQUEST_URI']));

$var_to_array = str_replace("/index.php/", "", $vta[0]);

$var_to_array = str_replace("/index.php", "", $var_to_array);

$CANONICAL = $var_to_array;

$var_to_array = str_replace(".php/", "", $var_to_array);
$var_to_array = str_replace(".php", "", $var_to_array);
$var_to_array = str_replace("//", "/", $var_to_array);

$var_array = explode("/", $var_to_array);
$levels = count($var_array);
$end_page = $levels - 1;

if (($end_page == 2) AND ( $var_array[$end_page] != '')) {
    include ("products_newo.php");
} else {
//$num="MT8070iH";
//$num=str_replace(".php", "", basename($_SERVER['PHP_SELF']));


    session_start();
    define("bullshit", 1);
    include $_SERVER['DOCUMENT_ROOT'] . "/sc/dbcon.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php";


    database_connect();
    mysql_query("SET NAMES 'cp1251'");
//---------------content ---------------------






    $outs = "<h1 class=series_name>ѕромышленные мониторы ( встраиваемые, сенсорные ) IFC</h1>";

    $outs .= "<br><center><div class=series_descr>
 омпани€ IFC (  итай ) это профессиональный производитель встраиваемых <strong>промышленных мониторов</strong>, работающий более 10 лет.  омпани€ IFC динамично развиваетс€,
и качество продукции непрерывно повышаетс€. <strong>ћониторы IFC</strong> Ч новинка на –оссийском рынке.<br /><br />

„увствительный €ркий резистивный сенсорный дисплей с LED подсветкой, 6 мм водо- и пылезащищенна€ передн€€ панель с закаленным стеклом, тонкое модульное исполнение, прочна€ конструкци€ и широкий спектр возможностей креплени€ делают <strong>мониторы IFC</strong> надежными помощниками в управлении технологическими процессами в любом месте.<br /><br />
<strong>Ўирочайший выбор диагоналей</strong> ( 5,7&Prime; Ч 22&Prime; ) позвол€ет подобрать оптимальный размер дл€ решени€ каждой задачи.
</div></center><br /><br />";


    $outs .= "<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_ifc("IFC-M057");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_ifc("IFC-M080");  // end row
    $outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_ifc("IFC-M104");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_ifc("IFC-M121");  // end row
    $outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_ifc("IFC-M150");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_ifc("IFC-M170");  // end row
    $outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_ifc("IFC-M190");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_ifc("IFC-M220");  // end row
    $outs .= "</td></tr>


</table></center><br /><br />
<h2 class=series_name>ѕромышленные мониторы Cincoze</h2><br />
<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_cincoze("CV-108/M1001");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_cincoze("CV-110/M1001");   // end row
    $outs .= "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_cincoze("CV-112/M1001");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_cincoze("CV-112H/M1001");   // end row
    $outs .= "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_cincoze("CV-115/M1001");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_cincoze("CV-W115/M1001");   // end row
    $outs .= "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    $outs .= show_cincoze("CV-117/M1001");
    $outs .= "</td><td align=center valign=top>";
    $outs .= show_cincoze("CV-119/M1001"); // end row
    $outs .= "</td></tr>

</table></center><br /><br />";


//------------------end content---------------


    $template_file = 'head.html';

    $title = 'ѕромышленные мониторы ( встраиваемые, сенсорные )';
    $keywords = 'монитор, IFC, Cincoze, LED, 5,7&Prime;, 22&Prime; диагональ, VGA, DVI, USB, сенсор, резистивный, подстветка, наработка, операторский, промышленный, 8&Prime;, 10.4&Prime; , 15&Prime;, 17&Prime;, 19&Prime;, 22&Prime;';
    $description = 'ѕромышленные LED мониторы IFC и Cincoze с диагональю 5,7&Prime;-22&Prime; с напр€жением питани€ 12 V, качество, простота, функциональность, тонкий корпус, IP65 передней панели, входы VGA, DVI, Audio, USB-выход и умеренные цены';

    $head = head($template_file, $title, $description, $keywords);

    echo $head;
    ?>
    <div id="mes_backgr"> </div>
    <div id="body_cont">
    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_menu.php"; ?>
        <table width="100%" bgcolor="white">
            <tr height="93">
                <td width="300px">
                    <a href="/"><img src="/images/logo2017.png" /></a>
                </td>
                <td> </td>
            </tr>
        </table>
        <?
        top_menu();
//usd_rate();
        search();
        compare();
        backup_call();
        top_buttons();
        basket();
        temp1_no_menu();
        show_price_val();
//temp1();
//left_menu();
        temp2();
        add_to_basket();

        popup_messages();
        echo "<article>";
        echo $outs;
        echo "</article>";
        temp3();
    };
    ?>