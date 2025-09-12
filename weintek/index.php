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



        <h1>Панели оператора Weintek, облачные интерфейсы, шлюзы данных, панельные компьютеры,

            промышленные мониторы</h1>



    <br/>

    <div style="margin:auto;padding-top: 20px;overflow: hidden">

        <div style="display:inline-block;text-align:right;margin:auto;padding:0px;font-family: Arial, 'MS Sans Serif', sans-serif;">

            <div style="float:left;margin:0px 0 -10px 45px;width:50%;text-align:left;">

                <a style="text-decoration: underline;" target="_blank" class="compare_table_link"

                   href="/weintek-stavnenie-seriy.php"><span class="compare_table_icon"></span><span>Таблица сравнения всех серий по функционалу</span></a>

                <a style="text-decoration: underline;" target="_blank" class="download_linkext_online"

                   href="/weintek-easybuilder-instrukciya-na-russkom/"><span>Онлайн руководство пользователя EasyBuilder Pro <b>на русском языке</b></span></a>

            </div>

            <div class="block_distributor_certificate_fam_electric">

                <a href="//www.rusavtomatika.com/upload_files/weintek/distributor_certificate_rusavtomatika.png"

                   rel="lightbox[1]">

                    <img src="/images/weintek/distributor_certificate_rusavtomatika_small.png"

                         alt="Сертификат официального дистрибьютора Weintek">

                    Сертификат официального дистрибьютора Weintek

                </a>

            </div>

        </div>

    </div>

    <div style="overflow: hidden;height: 20px;"></div>

    <div class="sub-menu"

         style="box-sizing:border-box;margin: 20px auto;padding: 10px 5px;background: #dff3df;">

        <ul id="table_of_contents" style="text-align: center;">

            <li><a href="/weintek/cmt-x.php"><span>cMT X</span> (самая инновационная серия с максимальной

                    производительностью)</a></li>

            <li><a href="/weintek/CloudHMI.php"><span>cMT</span> (серия с богатым функционалом)</a></li>

            <li><a href="/weintek/series_MT8000iP.php"><span>MT8000iP</span> (бюджетная серия)</a></li>

            <li><a href="/weintek/series_MT8000iE.php"><span>MT8000iE</span> (стандартная серия)</a></li>

            <li><a href="/weintek/series_MT8000XE.php"><span>MT8000XE</span> (оптимальная серия)</a></li>

            <li><a href="/weintek/series_eMT3000.php"><span>eMT3000</span> (с одобрением РМР)</a></li>

            <li><a href="#mTV"><span>mTV-100</span> (интерфейс Machine-TV) <span>&#8681</span></a></li>

            <li><a href="/weintek/cMT-CTRL01.php"><span>cMT-CTRL01</span> (ПЛК)</a></li>

            <li><a href="/plc/weintek/"><span>Серия iR</span> (модули ввода-вывода)</a></li>

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

            Модульная система ввода вывода Weintek серии iR:<br> Коммуникационные модули (coupler) и Модули ввода-вывода (digital i/o)

        </a>

        <a class="plc_link_img" style="float:right;width:48%;display: block;" href="/plc/weintek/"><img src="/images/controllers/weintek/plc_weintek_banner.jpg" alt="Модульная система ввода вывода Weintek серии iR Коммуникационные модули (coupler) и модули ввода-вывода (digital i/o)"/></a>

    </div>

<?*/ ?>

    <?

    include 'inc_functions.php';



    show_weintek_series(

        'iP', 'Панели оператора Weintek серия MT8000iP', $link = '/weintek/series_MT8000iP.php', $text = 'Сенсорные панели оператора Weintek серии MT8000iP 2016 года.  Их отличительными особенностями являются быстрый процессор Cortex A8, темный компактный корпус. У нас вы можете купить панели оператора серии MT8000iP, которые мы поставляем напрямую от производителя.'

    );

    show_weintek_series(

        'cMT-X', 'Cерия cMT X', $link = '/weintek/cmt-x.php', $text =

        "<p><strong style='font-size: 1.1em'>Серия cMT X</strong> — новинка 2020 года и результат 25-летней работы компании Weintek в области автоматизации управления

        производственными процессами.</p>

        <p><b>Данная серия предлагает:</b></p>

        <div style=\"margin-left: 15px;\">

            <ul>

                <li><b style='font-size: 1.1em'>Быстродействие:</b> самые мощные процессоры для решения <b> сложных вычислительных задач</b> и выделенные процессоры для

                    <b>обработки графики</b>.

                </li>

                <li><b style='font-size: 1.1em'>Управление жестами:</b> ёмкостный сенсорный экран позволяет выполнять операции с помощью интуитивных <b>жестов</b>.</li>

                <li><b style='font-size: 1.1em'>Яркость:</b> интегрированное <b>сенсорное решение oTP</b> - позволяет увеличить коэффициент пропускания света,

                    что увеличивает <b>яркость изображения</b></li>

                <li><b style='font-size: 1.1em'>Удаленное управление:</b> технология <b>WebView</b> - управление панелью оператора <b>через веб-браузер</b>, без установки

                    специального ПО.

                </li>

                <li><b style='font-size: 1.1em'>Дополнительные функции:</b> обновленный веб-интерфейс <b>Web 2.0</b> позволяет легко настраивать не только настройки панели

                    оператора,

                    но и <b>просматривать выборки данных и журнал событий</b>. Веб-доступ защищен зашифрованной передачей

                    данных.

                </li>

            </ul>

        </div>





        "

    );



    show_weintek_series(

        'cMT', 'Cерия cMT', $link = '/weintek/CloudHMI.php',

        $text = "Серия cMT — популярная серия с богатым функционалом. В нее в входят не только наиболее продвинутые панели

(оснащенные быстрыми процессорами и новыми программными функциями), но также такие продукты как:

шлюзы данных, облачные серверы, панельные компьютеры, программируемые контроллеры.  <br>

<a href='/articles/opisanie-serii-cmt.php'>Подробное описание серии cMT</a><br><br>С 2016 года все интерфейсы серии cMT поддерживают протокол <a href='/mqtt/'>MQTT</a>."

    );

    show_weintek_series(

        'MT8000iE', 'Панели оператора Weintek серия MT8000iE', $link = '/weintek/series_MT8000iE.php', $text = "Сенсорные панели оператора Weintek серии MT8000iE появились в 2013 году. Их отличительными особенностями являются быстрый процессор Cortex A8, графический сопроцессор, ускоряющий до десяти раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, влагозащитное покрытие платы. Операторские панели этой серии не имеют порта USB slave (за исключением MT6070iE), поэтому загрузка проекта с ПК возможна только через Ethernet. У нас вы можете купить панели оператора серии MT8000iE, которые мы поставляем напрямую от производителя."

    );

    show_weintek_series(

        'MT8000XE', 'Панели оператора Weintek серия MT8000XE', $link = '/weintek/series_MT8000XE.php', $text = "Сенсорные панели оператора серии MT8000XE появились в 2013 году. Отличительными особенностями этой серии операторских панелей Weintek являются быстрый процессор Cortex A8, с тактовой частотой 1 ГГц, графический сопроцессор, ускоряющий до 15 раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, а также влагозащитное покрытие платы. С 2016 года во все панели серии XE добавлена поддержка протокола <a href='/mqtt/'>MQTT</a>."

    );



    show_weintek_series(

        'MT6000i', 'Панели оператора Weintek cерия MT6000i', $link = '/weintek/series_MT6000i.php', $text = "Панели оператора Weintek серии MT6000i появились в 2009 году и сразу же стали очень популярны во всем мире благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT6000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, следуя успешному опыту Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи."

    );

    show_weintek_series(

        'MT8000', 'Панели оператора Weintek серия MT8000i', $link = '/weintek/series_MT8000i.php', $text = "Панели оператора Weintek серии MT8000i появились в 2009 году и быстро приобрели широкую популярность благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT8000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, переняв успешный опыт Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи."

    );



    show_weintek_series(

        'eMT3000', 'Панели оператора Weintek серия eMT3000', $link = '/weintek/series_eMT3000.php', $text = "Панели оператора Weintek серии eMT3000 появились в 2012 году. Отличительными особенностями этой серии по сравнению с сериями MT6000i и eMT8000i является более быстрый процессор, увеличенный объем ОЗУ и флэш-памяти, алюминиевый корпус, интерфейс CAN. Операторская панель Weintek eMT3070A имеет расширенный диапазон рабочих температур (от -20&#8451;). Также панели оператора этой серии программируется более новым ПО EasyBuilder Pro."

    );

    show_weintek_series(

        'Open HMI', 'Панельные компьютеры Weintek серия Open HMI eMT600', $link = '/weintek/series_eMT600.php', $text = "Панельные компьютеры Weintek серии eMT600 появились в 2012 году. Они являются продолжением серии MT600. На панельных компьютерах Weintek серии eMT600 установлена операционная система Windows CE 6.0"

    );

    ?>

    <div id="mTV"></div><?

    show_weintek_series(

        'mTV', 'Интерфейс Machine-TV Weintek серия mTV', $link = '', $text = "Интерфейс Machine-TV серии mTV появился в 2013 году. Компактный mTV-интерфейс дает возможность использовать в качестве дисплея телевизоры различных размеров или мониторы с HDMI интерфейсом, расширяя возможности традиционной архитектуры HMI."

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

