<?php

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

if(EX != "_"){



    include $_SERVER["DOCUMENT_ROOT"]."/weintek_/index.php";

    exit();

}

$start = microtime(true);

session_start();

define("bullshit", 1);

include_once "../sc/dbcon.php";







include("../sc/lib_new.php");





$section_setup = '.section.php';

if (file_exists($section_setup)) {

    include $section_setup;

}



database_connect();



temp0("weintek");

top_buttons();

basket();

temp1_no_menu();

show_price_val();

//temp1();

//left_menu();





temp2();

//---------------content ---------------------



add_to_basket();





popup_messages();



//show_com_connector("MT6070iH");

?>

    <div class="block_content">

<article>



        <h1>������ ��������� Weintek, �������� ����������, ����� ������, ��������� ����������,

            ������������ ��������</h1>



    <br/>

    <div style="margin:auto;padding-top: 20px;overflow: hidden">

        <div style="display:inline-block;text-align:right;margin:auto;padding:0px;font-family: Arial, 'MS Sans Serif', sans-serif;">

            <div style="float:left;margin:0px 0 -10px 45px;width:50%;text-align:left;">

                <a style="text-decoration: underline;" target="_blank" class="compare_table_link"

                   href="/weintek-stavnenie-seriy.php"><span class="compare_table_icon"></span><span>������� ��������� ���� ����� �� �����������</span></a>

                <a style="text-decoration: underline;" target="_blank" class="download_linkext_online"

                   href="/weintek-easybuilder-instrukciya-na-russkom/"><span>������ ����������� ������������ EasyBuilder Pro <b>�� ������� �����</b></span></a>

            </div>

            <div class="block_distributor_certificate_fam_electric">

                <a href="//www.rusavtomatika.com/upload_files/weintek/distributor_certificate_rusavtomatika.png"

                   rel="lightbox[1]">

                    <img src="/images/weintek/distributor_certificate_rusavtomatika_small.png"

                         alt="���������� ������������ ������������� Weintek">

                    ���������� ������������ ������������� Weintek

                </a>

            </div>

        </div>

    </div>

    <div style="overflow: hidden;height: 20px;"></div>

    <div class="sub-menu"

         style="box-sizing:border-box;margin: 20px auto;padding: 10px 5px;background: #dff3df;">

        <ul id="table_of_contents" style="text-align: center;">

            <li><a href="/weintek/cmt-x.php"><span>cMT X</span> (����� ������������� ����� � ������������

                    �������������������)</a></li>

            <li><a href="/weintek/CloudHMI.php"><span>cMT</span> (����� � ������� ������������)</a></li>

            <li><a href="/weintek/series_MT8000iP.php"><span>MT8000iP</span> (��������� �����)</a></li>

            <li><a href="/weintek/series_MT8000iE.php"><span>MT8000iE</span> (����������� �����)</a></li>

            <li><a href="/weintek/series_MT8000XE.php"><span>MT8000XE</span> (����������� �����)</a></li>

            <li><a href="/weintek/series_eMT3000.php"><span>eMT3000</span> (� ���������� ���)</a></li>

            <li><a href="#mTV"><span>mTV-100</span> (��������� Machine-TV) <span>&#8681</span></a></li>

            <li><a href="/weintek/cMT-CTRL01.php"><span>cMT-CTRL01</span> (���)</a></li>

            <li><a href="/plc/weintek/"><span>����� iR</span> (������ �����-������)</a></li>

        </ul>

    </div>

    <style>

        a h2.series_name {

            text-decoration: none;

            cursor: pointer;

        }



        td a {

            text-decoration: none;

        }



        .block_distributor_certificate_fam_electric {

            text-align: right;

            float: right;

            margin-top: -30px;

            margin-right: 40px;

        }



        .block_distributor_certificate_fam_electric a {

            display: block;

            width: 335px;

            padding-top: 33px;

            text-decoration: underline;

        }



        .block_distributor_certificate_fam_electric img {

            float: right;

            margin: -18px 0 10px 20px;

            width: 110px;

            display: block;

            box-shadow: 0 0 4px rgba(0, 0, 0, 0.4);

            transition: 0.2s;

        }



        .block_distributor_certificate_fam_electric a:hover img {

            transform: scale(1.05);

        }



        a.plc_link_a {

            text-decoration: none;

        }



        a.plc_link_a:hover {

            text-decoration: underline;

        }



        .plc_link_img {

            transition: 0.2s;

            transform: scale(0.95);

        }



        .weintek_series_panel.plc:hover .plc_link_img {

            transform: scale(1);

        }



    </style>



    <? /*?><div class="weintek_series_panel plc" style="overflow: hidden;padding: 0 30px 0 40px;">

        <a class="plc_link_a" style="float:left;width:48%;display: block;font-weight: bold;font-size: 18px;padding: 60px 0 0 0;" href="/plc/weintek/">

            ��������� ������� ����� ������ Weintek ����� iR:<br> ���������������� ������ (coupler) � ������ �����-������ (digital i/o)

        </a>

        <a class="plc_link_img" style="float:right;width:48%;display: block;" href="/plc/weintek/"><img src="/images/controllers/weintek/plc_weintek_banner.jpg" alt="��������� ������� ����� ������ Weintek ����� iR ���������������� ������ (coupler) � ������ �����-������ (digital i/o)"/></a>

    </div>

<?*/ ?>

    <?

    include 'inc_functions.php';



    show_weintek_series(

        'iP', '������ ��������� Weintek ����� MT8000iP', $link = '/weintek/series_MT8000iP.php', $text = '��������� ������ ��������� Weintek ����� MT8000iP 2016 ����.  �� �������������� ������������� �������� ������� ��������� Cortex A8, ������ ���������� ������. � ��� �� ������ ������ ������ ��������� ����� MT8000iP, ������� �� ���������� �������� �� �������������.'

    );

    show_weintek_series(

        'cMT-X', 'C���� cMT X', $link = '/weintek/cmt-x.php', $text =

        "<p><strong style='font-size: 1.1em'>����� cMT X</strong> � ������� 2020 ���� � ��������� 25-������ ������ �������� Weintek � ������� ������������� ����������

        ����������������� ����������.</p>

        <p><b>������ ����� ����������:</b></p>

        <div style=\"margin-left: 15px;\">

            <ul>

                <li><b style='font-size: 1.1em'>��������������:</b> ����� ������ ���������� ��� ������� <b> ������� �������������� �����</b> � ���������� ���������� ���

                    <b>��������� �������</b>.

                </li>

                <li><b style='font-size: 1.1em'>���������� �������:</b> ��������� ��������� ����� ��������� ��������� �������� � ������� ����������� <b>������</b>.</li>

                <li><b style='font-size: 1.1em'>�������:</b> ��������������� <b>��������� ������� oTP</b> - ��������� ��������� ����������� ����������� �����,

                    ��� ����������� <b>������� �����������</b></li>

                <li><b style='font-size: 1.1em'>��������� ����������:</b> ���������� <b>WebView</b> - ���������� ������� ��������� <b>����� ���-�������</b>, ��� ���������

                    ������������ ��.

                </li>

                <li><b style='font-size: 1.1em'>�������������� �������:</b> ����������� ���-��������� <b>Web 2.0</b> ��������� ����� ����������� �� ������ ��������� ������

                    ���������,

                    �� � <b>������������� ������� ������ � ������ �������</b>. ���-������ ������� ������������� ���������

                    ������.

                </li>

            </ul>

        </div>





        "

    );



    show_weintek_series(

        'cMT', 'C���� cMT', $link = '/weintek/CloudHMI.php',

        $text = "����� cMT � ���������� ����� � ������� ������������. � ��� � ������ �� ������ �������� ����������� ������

(���������� �������� ������������ � ������ ������������ ���������), �� ����� ����� �������� ���:

����� ������, �������� �������, ��������� ����������, ��������������� �����������.  <br>

<a href='/articles/opisanie-serii-cmt.php'>��������� �������� ����� cMT</a><br><br>� 2016 ���� ��� ���������� ����� cMT ������������ �������� <a href='/mqtt/'>MQTT</a>."

    );

    show_weintek_series(

        'MT8000iE', '������ ��������� Weintek ����� MT8000iE', $link = '/weintek/series_MT8000iE.php', $text = "��������� ������ ��������� Weintek ����� MT8000iE ��������� � 2013 ����. �� �������������� ������������� �������� ������� ��������� Cortex A8, ����������� �����������, ���������� �� ������ ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, ������������� �������� �����. ������������ ������ ���� ����� �� ����� ����� USB slave (�� ����������� MT6070iE), ������� �������� ������� � �� �������� ������ ����� Ethernet. � ��� �� ������ ������ ������ ��������� ����� MT8000iE, ������� �� ���������� �������� �� �������������."

    );

    show_weintek_series(

        'MT8000XE', '������ ��������� Weintek ����� MT8000XE', $link = '/weintek/series_MT8000XE.php', $text = "��������� ������ ��������� ����� MT8000XE ��������� � 2013 ����. �������������� ������������� ���� ����� ������������ ������� Weintek �������� ������� ��������� Cortex A8, � �������� �������� 1 ���, ����������� �����������, ���������� �� 15 ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, � ����� ������������� �������� �����. � 2016 ���� �� ��� ������ ����� XE ��������� ��������� ��������� <a href='/mqtt/'>MQTT</a>."

    );



    show_weintek_series(

        'MT6000i', '������ ��������� Weintek c���� MT6000i', $link = '/weintek/series_MT6000i.php', $text = "������ ��������� Weintek ����� MT6000i ��������� � 2009 ���� � ����� �� ����� ����� ��������� �� ���� ���� ��������� ��������� ����������� ����/��������, � ����� �������� �������� ������� � �� �� USB ������. ������������� ������������ ������������ ������� Weintek ����� MT6000i ��� ������� � ���� ����������� �� ������� ��������� �������������� �������. � ��������� �����, ������ ��������� ����� Weintek, ����������� ��������������, � ������� ����� ������ ������ ���������, ����� ���������� �������������� �������."

    );

    show_weintek_series(

        'MT8000', '������ ��������� Weintek ����� MT8000i', $link = '/weintek/series_MT8000i.php', $text = "������ ��������� Weintek ����� MT8000i ��������� � 2009 ���� � ������ ��������� ������� ������������ ��������� ��������� ����������� ����/��������, � ����� �������� �������� ������� � �� �� USB ������. ������������� ������������ ������������ ������� Weintek ����� MT8000i ��� ������� � ���� ����������� �� ������� ��������� �������������� �������. � ��������� �����, ������� �������� ���� Weintek, ����������� ��������������, � ������� ����� ������ ������ ���������, ����� ���������� �������������� �������."

    );



    show_weintek_series(

        'eMT3000', '������ ��������� Weintek ����� eMT3000', $link = '/weintek/series_eMT3000.php', $text = "������ ��������� Weintek ����� eMT3000 ��������� � 2012 ����. �������������� ������������� ���� ����� �� ��������� � ������� MT6000i � eMT8000i �������� ����� ������� ���������, ����������� ����� ��� � ����-������, ����������� ������, ��������� CAN. ������������ ������ Weintek eMT3070A ����� ����������� �������� ������� ���������� (�� -20&#8451;). ����� ������ ��������� ���� ����� ��������������� ����� ����� �� EasyBuilder Pro."

    );

    show_weintek_series(

        'Open HMI', '��������� ���������� Weintek ����� Open HMI eMT600', $link = '/weintek/series_eMT600.php', $text = "��������� ���������� Weintek ����� eMT600 ��������� � 2012 ����. ��� �������� ������������ ����� MT600. �� ��������� ����������� Weintek ����� eMT600 ����������� ������������ ������� Windows CE 6.0"

    );

    ?>

    <div id="mTV"></div><?

    show_weintek_series(

        'mTV', '��������� Machine-TV Weintek ����� mTV', $link = '', $text = "��������� Machine-TV ����� mTV �������� � 2013 ����. ���������� mTV-��������� ���� ����������� ������������ � �������� ������� ���������� ��������� �������� ��� �������� � HDMI �����������, �������� ����������� ������������ ����������� HMI."

    );

    ?>

</article>

    </div>

        <?

//-----------------------------------series iP ---------------------------

//show_series_ip();

//----------------------series CloudHMI

//show_series_cloud_hmi();

//-----------------------------------series IE ---------------------------

//show_series_ie();

//-----------------------------------series XE ---------------------------

//show_series_xe();

//------------------------------series 6000 ------------------------------------------- MT6000i

//show_series_6000();

//----------------------------series 8000 -------------------------------------

//show_series_8000();

//-----------------------series EMT -----------------------------

//show_series_emt();

//----------------------series OpenHMI

//show_series_open_hmi();

//show_series_open_hmi_emt();

//----------------------series mTV

// mTV

//show_series_mTV();

//-----------------end content

//echo microtime(true) - $start;

temp3();

?>

