<?php



session_start();

define("bullshit", 1);

include("../sc/dbcon.php");

include("../sc/lib_new.php");

include("../sc/vars.php");

global $extra_openGraph;

$extra_openGraph = Array(

    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/cmt-x.png",

    "openGraph_title" => "Weintek ����� cMT-X: ������ ���������, �������� ����������",

    "openGraph_siteName" => "�������������"

);





global $mysqli_db;

database_connect();

mysqli_query($mysqli_db, "SET NAMES 'cp1251'");

//---------------content ---------------------



$template_file = 'head.html';

$title = 'cMT X ����� Weintek: ������ ���������, �������� ����������';

$keywords = 'HMI, Weintek, ��������, ���������, ������, ����������, ���������, ���������, ������, ������������';

$description = '����� cMT X - �������� ������������� ����� � ������� ��������� Weintek. � ��� � ������ ����� ����������� ������, ���������� ������ �������� ������������ � ������ ������ ������������ ���������.';



$head = head($template_file, $title, $description, $keywords);



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

add_to_basket();

popup_messages();



temp2();

?>

    <div style="margin: 20px auto -20px;width: 98%;">

        <nav style="max-width: 770px; margin-left: 15px;">

            <a href="/">�������</a>&nbsp;/&nbsp;<a href="/weintek/">������ ���������, ��������� ���������� � ��������

                Weintek</a>&nbsp;/&nbsp;C���� cMT-X

        </nav>

    </div>





<?

echo "<article><div class='block_content'>";

/*     * ******************************** */

?>

    <h1>Weintek ����� cMT-X: ������ ���������, �������� ����������</h1>





    <div class="color_text_block" style="text-align: left;">

        <p><strong>����� cMT X</strong> - �������� ������������� ����� � ������� ��������� Weintek.</p>

        <p>������ ����� ����������:</p>

        <div style="margin-left: 15px;">

        <ul>

            <li>����� ������ ���������� ��� ������� <b> ������� �������������� �����</b> � ���������� ���������� ��� <b>��������� �������</b>.</li>

            <li>��������� ��������� ����� ��������� ��������� �������� � ������� ����������� <b>������</b>.</li>

            <li>��������������� <b>��������� ������� oTP</b> - ��������� ��������� ����������� ����������� �����, ��� ����������� <b>������� �����������</b></li>

            <li>���������� <b>WebView</b> - ���������� ������� ��������� <b>����� ���-�������</b>, ��� ��������� ������������ ��.</li>

            <li>����������� ���-��������� <b>Web 2.0</b> ��������� ����� ����������� �� ������ ��������� ������ ���������,

                �� � ������������� ������� ������ � ������ �������. ���-������ ������� ������������� ��������� ������.

            </li>



        </ul>

        </div>

    </div>

    <div style="text-align: center;margin-top: 27px;">

        <ul id="table_of_contents" style="text-align: center;">

            <li><a href="#anchor_hmi">������ ��������� <span>&#8681</span></a></li>

            <li><a href="#anchor_cloud_hmi">�������� ���������� <span>&#8681</span></a></li>

        </ul>

    </div>



    <br>

    <h2 id="anchor_hmi" class='h2_style1'>������ ���������</h2>

<?

$component->show(array(

    "component_name" => "news.list",

    "component_template" => "main_page_type",

    "template_arguments" => array()),

    array(

        "table" => "products_all",

        "brand" => "Weintek",

        "type" => "hmi",

        "series" => "cMT-X",

        "order" => "diagonal",

    ));



?>

    <h2 id="anchor_cloud_hmi" class='h2_style1'>�������� ����������</h2>

<?

$component->show(array(

    "component_name" => "news.list",

    "component_template" => "main_page_type",

    "template_arguments" => array()), array(

    "table" => "products_all",

    "brand" => "Weintek",

    "type" => "cloud_hmi",

    "series" => "cMT-X",

    "order" => "index",

    "order_direction" => "DESC",

));

echo "</div></article>";

/*     * ******************************** */

temp3();

?>

