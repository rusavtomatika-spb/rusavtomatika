<?php

function top_buttons()
{


//Выборка из 2-х таблиц
    /*
      $brands = array(
      'Weintek'=>array('products_all','model','weintek'),
      'Samkoon'=>array('products_all','model','samkoon'),
      'IFC'=>array('products_all','model'),
      'Aplex'=>array('products_all','model'),
      'Cincoze'=>array('products_all','s_name'),
      'eWON'=>array('products_all','model'),
      'Yottacontrol'=>array('controllers','model'),
      'IECON'=>array('controllers','model'),
      '2N'=>array('products_all','model'),
      'Faraday'=>array('products_all','s_name'));

      $types = array('AndroidHMI'=>'m-android"','box-pc'=>'m-box-pc','cloud_hmi'=>'m-paneli','hmi'=>'m-paneli','machine-tv-interface'=>'m-paneli','monitor'=>'m-monitors','open_hmi'=>'m-paneli','panel_pc'=>'m-panel-pc','ps'=>'m-power-supply','vpn-router'=>'m-routers','module'=>'m-plc','transmitter'=>'m-plc','controller'=>'m-plc');
      database_connect();
      mysql_query("SET NAMES 'cp1251'");
      $sql="SELECT `index`,`model`,`s_name`,`type`,`brand`,`diagonal` FROM `products_all` WHERE `modification`<>'1' AND `show_in_cat`='1' ORDER BY `brand`,`diagonal`";
      $res = mysql_query($sql) or die(mysql_error());
      while ($r=mysql_fetch_object($res))
      {
      if (in_array($r->brand,$brands)){
      }
      }
     */

    echo '
<link rel="stylesheet" type="text/css" href="/css/new_menu.css' . version('/css/new_menu.css') . '">';
    ?>
    <!-- nav -->
    <nav class="mainmenu">
        <div id="cssmenut-new" style="opacity: 0;">
            <div class="menu_top_cont">
                <div class="menu_top">
                    <ul>
                        <li class="level1"><a href="/about.php"> О компании </a></li>
                        <li class="separator">|</li>
                        <li class="level1">
                            <a href="/news/"> Новости <span class="arrow-down"></span></a>
                            <ul style="width:268px;margin-left:-9px;">
                                <li class="level2"><a href="/new-products/"><span class="store-new-badge"></span>Новинки
                                        продукции</a></li>
                                <li class="level2"><a href="/video/"><span class="youtube"></span> Видеоканал
                                        rusavtomatika.com</a></li>
                            </ul>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/articles/">Статьи</a></li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/advanced_search.php" title="Подбор оборудования по параметрам">Подбор</a>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/comparison.php">Сравнение</a></li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/payment-shipping.php">Оплата и доставка</a></li>
                        <li class="separator">|</li>
                        <li class="level1">
                            <a href="/download.php"> Скачать <span class="arrow-down"></span></a>
                            <ul style="width:253px;margin-left:-50px;">
                                <li class="level2"><a href="/download.php">Приложения и драйверы</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/documents/">Документы</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_projects/">Демо проекты Weintek</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_projects/?find_projects=Macro%20Sample">Демо
                                        макросы Weintek</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_libraries/">Библиотеки для EasyBuilder</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_drivers/">Драйверы ПЛК
                                        (совм.&nbsp;с&nbsp;Weintek)</a></li>
                            </ul>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/contacts.php"> Контакты </a></li>
                    </ul>
                </div>
            </div>
            <input type="radio" name="select-type-root" id="select-catalog" class="show-wide"/>
            <input type="radio" name="select-type-root" id="close-catalog" class="close-wide"/>

            <input type="radio" name="select-type" id="r-select-paneli" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-panel-pc" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-pc-full-ip65" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-box-pc" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-monitory" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-routery" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-plc" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-modbus" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-power-supply" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-android" class="show-models show-wide show-type"/>
            <input type="radio" name="select-type" id="r-select-wince" class="show-models show-wide show-type"/>

            <input type="radio" name="select-type" id="select-weintek" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-samkoon" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-ifc" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-aplex" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-cincoze" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-ewon" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-haiwell" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-yottacontrol" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-modbus" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-2n" class="show-models show-wide"/>
            <input type="radio" name="select-type" id="select-faraday" class="show-models show-wide"/>
            <?
            if (1 or $_SERVER["HTTP_HOST"] == "www.rusavto.moisait.net" or $_SERVER["HTTP_HOST"] == "www.rusavtomatika.com" ):
                include_once $_SERVER["DOCUMENT_ROOT"]."/sc/popup_catalog_menu/popup_catalog_menu.php";
            else: ?>
                <ul>
                    <li><label class="label" for="select-catalog">
                            <div class="top-menu-punkt full">Каталог оборудования</div>
                        </label>
                        <label class="label" for="close-catalog">
                            <div class="top-menu-punkt fill">Каталог оборудования</div>
                        </label>
                    </li>
                </ul>
                <div id="wide-menu">
                    <div id="wide-menu-category">
                        <div class="header">Оборудование</div>
                        <ul>
                            <li><label class="label" id="b-r-select-paneli" for="r-select-paneli">
                                    <div>Панели оператора</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-wince" for="r-select-wince">
                                    <div>Панельные компьютеры Windows CE</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-panel-pc" for="r-select-panel-pc">
                                    <div>Панельные компьютеры</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-box-pc" for="r-select-box-pc">
                                    <div>Встраиваемые компьютеры</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-pc-full-ip65" for="r-select-pc-full-ip65">
                                    <div>Промышленные <br/>компьютеры full IP65</div>
                                </label></li>
                            <li><label class="label utility__triger__weintek__monitor-obj-on" id="b-r-select-monitory"
                                       for="r-select-monitory">
                                    <div>Промышленные мониторы</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-routery" for="r-select-routery">
                                    <div>VPN-роутеры</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-plc" for="r-select-plc">
                                    <div>Контроллеры (PLC)</div>
                                </label></li>
                            <li><label class="label" id="b-r-select-modbus" for="r-select-modbus">
                                    <div>Модули ввода-вывода</div>
                                </label></li>
                            <li><label class="label" id="b-select-power-supply" for="r-select-power-supply">
                                    <div>Блоки питания</div>
                                </label></li>
                            <li><a href="/ucenennye-tovary.php" style="color: inherit;"><label class="label" id=""
                                                                                               for="">
                                        <div>Уцененные товары</div>
                                    </label></a></li>
                            <!--li><label class="label" id="b-r-select-android" for="r-select-android"><div>Панели оператора Android</div></label></li-->

                        </ul>
                    </div>

                    <div id="wide-menu-manufacturers">
                        <div class="header">Производители</div>
                        <ul>
                            <li><a href="/weintek/">
                                    <div class="arrow">&nbsp;</div>
                                </a> <label class="label" for="select-weintek" id="b-select-weintek">
                                    <div class="p-paneli p-plc p-panel-pc p-modbus p-monitors utility__triger__weintek__monitor-obj-off">
                                        Weintek
                                    </div>
                                </label></li>
                            <li><a href="/samkoon/">
                                    <div class="arrow">&nbsp;</div>
                                </a> <label class="label" for="select-samkoon" id="b-select-samkoon">
                                    <div class="p-paneli">Samkoon</div>
                                </label></li>
                            <li><a href="/panelnie-computery/ifc/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-ifc" id="b-select-ifc">
                                    <div class="p-panel-pc p-box-pc p-monitors">IFC</div>
                                </label></li>
                            <li><a href="/panelnie-computery/aplex/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-aplex" id="b-select-aplex">
                                    <div class="p-panel-pc p-wince p-box-pc p-pc-full-ip65  p-monitors">Aplex</div>
                                </label></li>
                            <li><a href="/cincoze/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-cincoze" id="b-select-cincoze">
                                    <div class="p-panel-pc p-monitors  p-box-pc">Cincoze</div>
                                </label></li>
                            <li><a href="/ewon/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-ewon" id="b-select-ewon">
                                    <div class="p-routers">eWON</div>
                                </label></li>
                            <li><a href="/plc/haiwell/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-haiwell" id="b-select-haiwell">
                                    <div class="p-plc p-modbus new">Haiwell</div>
                                </label></li>
                            <li><a href="/plc/yottacontrol/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-yottacontrol" id="b-select-yottacontrol">
                                    <div class="p-plc p-modbus">Yottacontrol</div>
                                </label></li>

                            <li><a href="/modules/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-modbus" id="b-select-modbus">
                                    <div class="p-modbus">IECON</div>
                                </label></li>
                            <li><a href="/HMI-android.php">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-2n" id="b-select-2n">
                                    <div class="p-paneli p-android">2N</div>
                                </label></li>
                            <li><a href="/bloki-pitaniya/faraday/">
                                    <div class="arrow">&nbsp;</div>
                                </a><label class="label" for="select-faraday" id="b-select-faraday">
                                    <div class="p-power-supply">Faraday</div>
                                </label></li>
                        </ul>
                    </div>
                    <div id="wide-menu-products">
                        <div class="header" style="width:90px;">Модели</div>
                        <div id="wide-menu-products-content">
                            <ul id="all-models">


                                <li id="m-ewon" class="m-routers">
                                    <div class="it-logo"><a href="/ewon/"><img src="/images/logo/ewon-s.jpg"
                                                                               alt="eWON лого" nopin="nopin"></a></div>

                                    <div class="free-space"></div>
                                    <div class="cat-name m-routers"><a href="/ewon/">VPN-роутеры eWON</a></div>
                                    <ul class="models m-routers">
                                        <li class="man-logo m-routers"><img src="/images/ewon/COSY131/COSY131_1.png"
                                                                            alt="COSY131" nopin="nopin"></li>
                                        <li class="m-routers"><a href="/ewon/COSY131.php"><span
                                                        class="my_span"></span><span> COSY131</span></a></li>
                                        <li class="m-routers"><a href="/ewon/COSY141.php"><span
                                                        class="my_span"></span><span> COSY141</span></a></li>
                                        <li class="m-routers"><a href="/ewon/FLEXY201.php"><span class="my_span"></span><span> FLEXY201</span></a>
                                        </li>
                                        <li class="m-routers"><a href="/ewon/FLEXY205.php"><span class="my_span"></span><span> FLEXY205</span></a>
                                        </li>
                                        <li class="m-routers"><a href="/ewon/eFive.php"><span
                                                        class="my_span"></span><span> eFive</span></a></li>
                                    </ul>

                                </li>

                                <li id="box-pc-title" class="m-panel-pc m-pc-full-ip65">
                                    <div class="cat-name m-box-pc"><a href="/vstraivaemye-kompyutery/">
                                            Посмотреть все встраиваемые компьютеры
                                        </a></div>
                                </li>
                                <li id="panel-pc-title" class="m-panel-pc m-pc-full-ip65">
                                    <div class="cat-name m-panel-pc"><a href="/panelnie-computery/">
                                            Посмотреть все панельные компьютеры
                                        </a></div>
                                </li>
                                <li id="monitory-title" class="m-panel-pc m-pc-full-ip65">
                                    <div class="cat-name m-monitors"><a href="/monitors/">
                                            Посмотреть все промышленные мониторы
                                        </a></div>
                                </li>


                                <li id="m-ifc" class="m-panel-pc m-box-pc m-monitors" data-position="2">

                                    <div class="it-logo"><a href="/panelnie-computery/ifc/"><img
                                                    src="/images/logo/ifc.png" alt="IFC лого"></a></div>

                                    <div class="free-space"></div>


                                    <div class="cat-name m-panel-pc"><a href="/panelnie-computery/ifc/IFC-L07.php">Linux
                                            панельный компьютер 7" IFC-L07 </a><br>
                                        <a href="/panelnie-computery/ifc/IFC-A10.php">Android панельный компьютер 10.1"
                                            IFC-A10 </a></div>

                                    <div class="cat-name m-panel-pc"><a href="/panelnie-computery/ifc/ifc-500.php">Панельные&nbsp;компьютеры
                                            IFC-500 <br/><span
                                                    style="font-size:smaller;">CPU Intel  Core i5-7200U</span></a></div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc" style="overflow: hidden;"><img
                                                    src="/images/ifc/panel_pc/IFC-417i5-7300/md/IFC-417i5-7300_2.png"
                                                    alt="IFC IFC-417i5-7300"
                                                    style="max-width: 133px;margin-right: -5px;"></li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-510Ri5-7200.php"><span
                                                        class="my_span">10.1&#8243;</span><span> IFC-510Ri5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-512Ri5-7200.php"><span
                                                        class="my_span">12.1&#8243;</span><span> IFC-512Ri5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-515Ri5-7200.php"><span
                                                        class="my_span">15&#8243;</span><span> IFC-515Ri5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-515WRi5-7200.php"><span
                                                        class="my_span">15.6&#8243;</span><span> IFC-515WRi5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-517Ri5-7200.php"><span
                                                        class="my_span">7&#8243;</span><span> IFC-517Ri5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-519Ri5-7200.php"><span
                                                        class="my_span">19&#8243;</span><span> IFC-519Ri5-7200</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-521WRi5-7200.php"><span
                                                        class="my_span">21.5&#8243;</span><span> IFC-521WRi5-7200</span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-panel-pc"><a href="/panelnie-computery/ifc/ifc-400.php">Панельные&nbsp;компьютеры
                                            IFC-400 <br/><span style="font-size:smaller;">CPU Intel  Core i3 / i5</span></a>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc" style="overflow: hidden;"><img
                                                    src="/images/ifc/panel_pc/IFC-417i5-7300/md/IFC-417i5-7300_2.png"
                                                    alt="IFC IFC-417i5-7300"
                                                    style="max-width: 133px;margin-right: -5px;"></li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-412i5-7300.php"><span
                                                        class="my_span">12.1&#8243;</span><span> IFC-412i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-412Ci5-7300.php"><span
                                                        class="my_span">12.1&#8243;</span><span> IFC-412Ci5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-415i5-7300.php"><span
                                                        class="my_span">15&#8243;</span><span> IFC-415i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-415Ci5-7300.php"><span
                                                        class="my_span">15&#8243;</span><span> IFC-415Ci5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-W415i5-7300.php"><span
                                                        class="my_span">15.6&#8243;</span><span> IFC-W415i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-W415Ci5-7300.php"><span
                                                        class="my_span">15.6&#8243;</span><span> IFC-W415Ci5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-417i5-7300.php"><span
                                                        class="my_span">17&#8243;</span><span> IFC-417i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-417Ci5-7300.php"><span
                                                        class="my_span">17&#8243;</span><span> IFC-417Ci5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-419i5-7300.php"><span
                                                        class="my_span">19&#8243;</span><span> IFC-419i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-419Ci5-7300.php"><span
                                                        class="my_span">19&#8243;</span><span> IFC-419Ci5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-421i5-7300.php"><span
                                                        class="my_span">21.5&#8243;</span><span> IFC-421i5-7300</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/ifc/IFC-421Ci5-7300.php"><span
                                                        class="my_span">21.5&#8243;</span><span> IFC-421Ci5-7300</span></a>
                                        </li>
                                    </ul>


                                    <div class="cat-name m-box-pc"><a href="/promyshlennye-kompyutery-box-pc/">Встраиваемые&nbsp;компьютеры
                                            IFC</a></div>
                                    <ul class="models m-box-pc">
                                        <li class="man-logo m-box-pc" style="margin-left: -50px;"><img
                                                    src="/images/box-pc/IFC-BOX5500/IFC-BOX5500_1.png" alt="IFC-BOX5500"
                                                    style="max-width: 108px;margin-right: 5px;"></li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-400J.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-400J</span> Intel Celeron J1900</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-BOX4000.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-BOX4000</span> CPU Intel i3 / i5 / i7</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-BOXJ900-6COM.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-BOXJ900-6COM</span> CPU Intel Celeron J1900 quad core</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-BOXJ1900.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-BOXJ1900</span>CPU Intel Celeron J1900 quad core</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-BOXI5-7200.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-BOXI5-7200</span> CPU Intel Kaby Lake i5-7200u 2.5 ГГц</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-BOXI5-6200-6COM.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-BOXI5-6200-6COM</span>6 COM, CPU Intel Core i5-6200 2.5 ГГц</span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a
                                                    href="/promyshlennye-kompyutery-box-pc/IFC-MBOX3455.php"><span
                                                        class="my_span"></span><span><span style="width:147px"
                                                                                           class="w100">IFC-MBOX3455</span>CPU Intel Apollo Lake Atom J3455 4 ядра, 2.3ГГц</span></a>
                                        </li>

                                    </ul>


                                    <div class="cat-name m-monitors"><a href="/monitors/#cheapmonitorsifc">Промышленные
                                            мониторы&nbsp;IFC</a></div>
                                    <ul class="models m-monitors">
                                        <li class="man-logo m-monitors"><img
                                                    src="/images/ifc/monitor/IFC-M215/md/IFC-M215_1.png" alt="IFC-M215"
                                                    style="margin-right: -15px;max-width: 151px;max-height: 113px;">
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-M212.php"><span class="my_span">12&#8243;</span><span> IFC-M212</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-M215.php"><span class="my_span">15&#8243;</span><span> IFC-M215</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-M217.php"><span class="my_span">17&#8243;</span><span> IFC-M217</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-MW217.php"><span class="my_span">17.3&#8243;</span><span> IFC-MW217</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-M219.php"><span class="my_span">19&#8243;</span><span> IFC-M219</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/IFC-MW221.php"><span class="my_span">21.5&#8243;</span><span> IFC-MW221</span></a>
                                        </li>

                                    </ul>

                                    <ul class="series">
                                        <li class="m-box-pc"><a href="/promyshlennye-kompyutery-box-pc/">BOX-PC</a></li>
                                        <li class="m-monitors"><a href="/monitors/">Мониторы</a></li>
                                    </ul>

                                </li>
                                <li id="m-aplex" class="m-panel-pc m-pc-full-ip65" data-position="1">
                                    <div class="it-logo"><a href="/panelnie-computery/aplex/"><img
                                                    src="/images/logo/aplex.png" alt="Aplex лого" nopin="nopin"></a>
                                    </div>

                                    <div class="free-space"></div>


                                    <div class="cat-name m-box-pc">
                                        <a href="/vstraivaemye-kompyutery/aplex/">Встраиваемые&nbsp;компьютеры Aplex</a>
                                    </div>
                                    <ul class="models m-box-pc">
                                        <li class="man-logo m-box-pc"><img
                                                    src="/images/aplex/vstraivaemye-kompyutery/ACS/ACS-2320/ACS-2320_1_md.png"
                                                    alt="ACS-2320" style="max-width: 108px;margin-right: 5px;"></li>
                                        <li class="m-box-pc no-after">
                                            <a href="/vstraivaemye-kompyutery/aplex/ACS/ACS-2320/"><span><span
                                                            class="w100">ACS-2320</span> CPU Intel 4th Gen. Core i3/i5 </span></a>
                                        </li>
                                        <li class="m-box-pc no-after">
                                            <a href="/vstraivaemye-kompyutery/aplex/ACS/ACS-2320A/"><span><span
                                                            class="w100">ACS-2320A</span> CPU Intel 6th Core i3/i5/i7</span></a>
                                        </li>
                                        <li class="m-box-pc no-after">
                                            <a href="/vstraivaemye-kompyutery/aplex/ACS/ACS-2330/"><span><span
                                                            class="w100">ACS-2330</span> CPU Intel 6th/7th Skylake/Kaby Lake Core i3/i5/i7</span></a>
                                        </li>
                                        <li class="m-box-pc no-after">
                                            <a href="/vstraivaemye-kompyutery/aplex/ACS/ACS-2332/"><span><span
                                                            class="w100">ACS-2332</span> CPU Intel 6th/7th Skylake/Kaby Lake Core i3/i5/i7</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-panel-pc">
                                        <a href="/panelnie-computery/aplex/#archmi-8-series">Панельные&nbsp;компьютеры
                                            APLEX ARCHMI-8</a>
                                        <p style="font-size:smaller;">CPU Celeron N2930 4 ядра 1.83 ГГц</p>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/aplex/ARCHMI-721P/ARCHMI-721P_1.png" alt="APC-3593P"
                                                    style="max-width: 129px;margin-right: -3px;" nopin="nopin"></li>

                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-807.php"><span
                                                        class="my_span">7&#8243;</span><span> ARCHMI-807</span></a></li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-807P.php"><span
                                                        class="my_span">7&#8243;</span><span> ARCHMI-807P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-808.php"><span
                                                        class="my_span">8&#8243;</span><span> ARCHMI-808</span></a></li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-808P.php"><span
                                                        class="my_span">8&#8243;</span><span> ARCHMI-808P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-810.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARCHMI-810</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-810P.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARCHMI-810P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-812.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARCHMI-812</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-812P.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARCHMI-812P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-812H.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARCHMI-812H</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-815.php"><span
                                                        class="my_span">15&#8243;</span><span> ARCHMI-815</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-815P.php"><span
                                                        class="my_span">15&#8243;</span><span> ARCHMI-815P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-816.php"><span
                                                        class="my_span">15.6&#8243;</span><span> ARCHMI-816</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-816P.php"><span
                                                        class="my_span">15.6&#8243;</span><span> ARCHMI-816P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-817.php"><span
                                                        class="my_span">17&#8243;</span><span> ARCHMI-817</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-817P.php"><span
                                                        class="my_span">17&#8243;</span><span> ARCHMI-817P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-818.php"><span
                                                        class="my_span">18.5&#8243;</span><span> ARCHMI-818</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-818P.php"><span
                                                        class="my_span">18.5&#8243;</span><span> ARCHMI-818P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-819.php"><span
                                                        class="my_span">19&#8243;</span><span> ARCHMI-819</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-819P.php"><span
                                                        class="my_span">19&#8243;</span><span> ARCHMI-819P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-821.php"><span
                                                        class="my_span">21.5&#8243;</span><span> ARCHMI-821</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-821P.php"><span
                                                        class="my_span">21.5&#8243;</span><span> ARCHMI-821P</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-panel-pc">
                                        <a href="/panelnie-computery/aplex/#archmi-9XX">Панельные&nbsp;компьютеры APLEX
                                            ARCHMI-9</a>
                                        <p style="font-size:smaller;">CPU Intel Core i5-6300U</p>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/aplex/panel_pc/ARCHMI-921AP/md/ARCHMI-921AP_1.png"
                                                    alt="APC-3593P" style="max-width: 129px;margin-right: -3px;"
                                                    nopin="nopin"></li>

                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-912AP.php"><span
                                                        class="my_span">12&#8243;</span><span> ARCHMI-912AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-912AR.php"><span
                                                        class="my_span">12&#8243;</span><span> ARCHMI-912AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-915AP.php"><span
                                                        class="my_span">15&#8243;</span><span> ARCHMI-915AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-915AR.php"><span
                                                        class="my_span">15&#8243;</span><span> ARCHMI-915AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-916AP.php"><span
                                                        class="my_span">15.6&#8243;</span><span> ARCHMI-916AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-916AR.php"><span
                                                        class="my_span">15.6&#8243;</span><span> ARCHMI-916AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-917AP.php"><span
                                                        class="my_span">17&#8243;</span><span> ARCHMI-917AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-917AR.php"><span
                                                        class="my_span">17&#8243;</span><span> ARCHMI-917AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-918AP.php"><span
                                                        class="my_span">18.5&#8243;</span><span> ARCHMI-918AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-918AR.php"><span
                                                        class="my_span">18.5&#8243;</span><span> ARCHMI-918AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-919AP.php"><span
                                                        class="my_span">19&#8243;</span><span> ARCHMI-919AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-919AR.php"><span
                                                        class="my_span">19&#8243;</span><span> ARCHMI-919AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-921AP.php"><span
                                                        class="my_span">21.5&#8243;</span><span> ARCHMI-921AP</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a
                                                    href="/panelnie-computery/aplex/ARCHMI-921AR.php"><span
                                                        class="my_span">21.5&#8243;</span><span> ARCHMI-921AR</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARCHMI-932P.php"><span
                                                        class="my_span">32&#8243;</span><span> ARCHMI-932P</span></a>
                                        </li>

                                    </ul>

                                    <!-- /**/ -->

                                    <div class="cat-name m-monitors">
                                        <a href="/monitors/aplex/">Промышленные мониторы Aplex</a>
                                    </div>
                                    <ul class="models m-monitors">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/aplex/monitors/ADP/ADP-1122A/ADP-1122A_1.png"
                                                    alt="ADP-1122A"
                                                    style="max-width: 120px;margin-top: 20px;margin-right: 3px;"
                                                    nopin="nopin"></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1050A/"><span
                                                        class="my_span">5.6&#8243;</span><span> ADP-1050A</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1070A/"><span
                                                        class="my_span">7&#8243;</span><span> ADP-1070A</span></a></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1080A/"><span
                                                        class="my_span">8&#8243;</span><span> ADP-1080A</span></a></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1100A/"><span
                                                        class="my_span">10.1&#8243;</span><span> ADP-1100A</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1120A/"><span
                                                        class="my_span">12.1&#8243;</span><span> ADP-1120A</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1122A/"><span
                                                        class="my_span">12.1&#8243;</span><span> ADP-1122A</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1154/"><span
                                                        class="my_span">15&#8243;</span><span> ADP-1154</span></a></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1174/"><span
                                                        class="my_span">17&#8243;</span><span> ADP-1174</span></a></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1194/"><span
                                                        class="my_span">19&#8243;</span><span> ADP-1194</span></a></li>
                                        <li class="m-monitors"><a href="/monitors/aplex/ADP/ADP-1224A/"><span
                                                        class="my_span">21.5&#8243;</span><span> ADP-1224A</span></a>
                                        </li>
                                    </ul>

                                    <!-- /**/ -->

                                    <div class="cat-name m-pc-full-ip65">
                                        <a href="/panelnie-computery/aplex/#vitam-series">Панельные компьютеры APLEX
                                            ViTAM Серия 8XX</a>
                                        <p style="font-size:smaller;text-decoration: none !important;">
                                            Процессор Intel Celeron N2930
                                            <br>
                                            Степень пылевлагозащиты IP66/IP69K и разъемы M12
                                        </p></div>

                                    <ul class="models m-pc-full-ip65">
                                        <li><a href="/panelnie-computery/aplex/ViTAM-810P.php"><span class="my_span">10.1&#8243;</span><span> ViTAM-810P</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-824PH.php"><span class="my_span">23,8&#8243;</span><span> ViTAM-824PH</span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-pc-full-ip65"><a
                                                href="/panelnie-computery/aplex/#vitam-series">Панельные компьютеры
                                            APLEX ViTAM Серия 9XXA</a>
                                        <p style="font-size:smaller;text-decoration: none !important;">
                                            Процессор Intel Skylake 6th Core i3-6100U (опционально i5-6300U /
                                            i7-6600U)<br>
                                            Степень пылевлагозащиты IP66/IP69K и разъемы M12
                                        </p></div>

                                    <ul class="models m-pc-full-ip65">
                                        <li><a href="/panelnie-computery/aplex/ViTAM-915AP.php"><span class="my_span">15&#8243;</span><span> ViTAM-915AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-915AR.php"><span class="my_span">15&#8243;</span><span> ViTAM-915AR</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-915AG.php"><span class="my_span">15&#8243;</span><span> ViTAM-915AG</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-916AP.php"><span class="my_span">15.6&#8243;</span><span> ViTAM-916AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-916AR.php"><span class="my_span">15.6&#8243;</span><span> ViTAM-916AR</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-916AG.php"><span class="my_span">15.6&#8243;</span><span> ViTAM-916AG</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-917AP.php"><span class="my_span">17&#8243;</span><span> ViTAM-917AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-917AR.php"><span class="my_span">17&#8243;</span><span> ViTAM-917AR</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-917AG.php"><span class="my_span">17&#8243;</span><span> ViTAM-917AG</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-919AP.php"><span class="my_span">19&#8243;</span><span> ViTAM-919AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-919AR.php"><span class="my_span">19&#8243;</span><span> ViTAM-919AR</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-919AG.php"><span class="my_span">19&#8243;</span><span> ViTAM-919AG</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-921AP.php"><span class="my_span">21.5&#8243;</span><span> ViTAM-921AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-921AR.php"><span class="my_span">21.5&#8243;</span><span> ViTAM-921AR</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-921AG.php"><span class="my_span">21.5&#8243;</span><span> ViTAM-921AG</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-924AP.php"><span class="my_span">23.8&#8243;</span><span> ViTAM-924AP</span></a>
                                        </li>
                                        <li><a href="/panelnie-computery/aplex/ViTAM-924AG.php"><span class="my_span">23.8&#8243;</span><span> ViTAM-924AG</span></a>
                                        </li>
                                    </ul>


                                    <div class="cat-name m-pc-full-ip65">
                                        <a href="/panelnie-computery/aplex/#apc-series">Панельные&nbsp;компьютеры APLEX
                                            APC</a>
                                        <p style="font-size:smaller;">из нержавеющей стали, full IP65 <br/>CPU Intel
                                            Atom D2550 2 ядра 1.8 ГГц</p>
                                    </div>
                                    <ul class="models m-pc-full-ip65">
                                        <li class="man-logo m-pc-full-ip65" style="margin-top: -11px;"><img
                                                    src="/images/aplex/APC-3593P/APC-3593P_1.png" alt="APC-3593P"
                                                    style="max-width: 120px;"
                                                    title="Копус из нержавеющей стали можно мыть со всех сторон"
                                                    nopin="nopin"><img src="/images/aplex/APC-3593P/APC-3593P_2.png"
                                                                       alt="APC-3593P"
                                                                       style="margin-top: -63px;margin-right: 142px;max-width: 111px;"
                                                                       title="Копус из нержавеющей стали можно мыть со всех сторон"
                                                                       nopin="nopin"></li>

                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3593P.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3593P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3593R.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3593R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3793P.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3793P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3793R.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3793R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3993P.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3993P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3993R.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3993R (full IP65)</span></a>
                                        </li>

                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3594P.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3594P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3594R.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3594R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3794P.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3794P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3794R.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3794R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3994P.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3994P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3994R.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3994R (full IP65)</span></a>
                                        </li>

                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3595P.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3595P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3595R.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3595R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3795P.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3795P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3795R.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3795R (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3995P.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3995P (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3995R.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3995R (full IP65)</span></a>
                                        </li>

                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3296P.php"><span
                                                        class="my_span">21.5&#8243;</span><span>APC-3296P (full IP65)</span></a>
                                        </li>

                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3597B.php"><span
                                                        class="my_span">15&#8243;</span><span>APC-3597B (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3797B.php"><span
                                                        class="my_span">17&#8243;</span><span>APC-3797B (full IP65)</span></a>
                                        </li>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/APC-3997B.php"><span
                                                        class="my_span">19&#8243;</span><span>APC-3997B (full IP65)</span></a>
                                        </li>


                                    </ul>

                                    <div class="cat-name m-panel-pc">
                                        <a href="/panelnie-computery/aplex/#armpac-6-series">Панельные&nbsp;компьютеры
                                            APLEX ARMPAC с Android
                                        </a>
                                        <p style="font-size:smaller;">CPU ARM Cortex A9 до 1 ГГц</p>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-wince"
                                            style="overflow: hidden;height: 139px;margin-bottom: -22px;"><img
                                                    src="/images/aplex/ARMPAC-612P/ARMPAC-612P_1.png" alt="ARMPAC-612P"
                                                    style="margin-top: 19px;margin-right: -23px;max-width: 167px;max-height: 125px;">
                                        </li>

                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-605.php"><span
                                                        class="my_span">5.6&#8243;</span><span> ARMPAC-605</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-605P.php"><span
                                                        class="my_span">5.6&#8243;</span><span> ARMPAC-605P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-607.php"><span
                                                        class="my_span">7&#8243;</span><span> ARMPAC-607</span></a></li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-607P.php"><span
                                                        class="my_span">7&#8243;</span><span> ARMPAC-607P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-608.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-608</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-608P.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-608P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-610.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-610</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-610P.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-610P</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-612.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARMPAC-612</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/panelnie-computery/aplex/ARMPAC-612P.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARMPAC-612P</span></a>
                                        </li>

                                    </ul>


                                    <div class="cat-name m-wince">
                                        <a href="/panelnie-computery/aplex/#armpac-series">Панельные&nbsp;компьютеры
                                            APLEX ARMPAC с Windows CE <br/><span style="font-size:smaller;">CPU ARM Cortex A8 до 1 ГГц</span></a>
                                    </div>
                                    <ul class="models m-wince">
                                        <li class="man-logo m-wince"
                                            style="overflow: hidden;height: 139px;margin-bottom: -22px;"><img
                                                    src="/images/aplex/ARMPAC-512P/ARMPAC-512P_1.png" alt="ARMPAC-512P"
                                                    style="margin-top: 19px;margin-right: -23px;max-width: 167px;max-height: 125px;">
                                        </li>

                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-505.php"><span
                                                        class="my_span">5.6&#8243;</span><span> ARMPAC-505</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-505P.php"><span
                                                        class="my_span">5.6&#8243;</span><span> ARMPAC-505P</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-507.php"><span
                                                        class="my_span">7&#8243;</span><span> ARMPAC-507</span></a></li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-507P.php"><span
                                                        class="my_span">7&#8243;</span><span> ARMPAC-507P</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-508.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-508</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-508P.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-508P</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-510.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-510</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-510P.php"><span
                                                        class="my_span">10.1&#8243;</span><span> ARMPAC-510P</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-512.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARMPAC-512</span></a>
                                        </li>
                                        <li class="m-wince"><a href="/panelnie-computery/aplex/ARMPAC-512P.php"><span
                                                        class="my_span">12.1&#8243;</span><span> ARMPAC-512P</span></a>
                                        </li>

                                    </ul>


                                    <div class="cat-name m-pc-full-ip65"><b>Другие панельные&nbsp;компьютеры APLEX</b>
                                    </div>
                                    <ul class="models m-pc-full-ip65">
                                        <?/*?><li class="man-logo m-wince" style="overflow: hidden;height: 139px;margin-bottom: -22px;"><img src="/images/aplex/ARMPAC-612P/ARMPAC-612P_1.png" alt="ARMPAC-612P" style="margin-top: 19px;margin-right: -23px;max-width: 167px;max-height: 125px;"></li><?*/ ?>
                                        <li class="m-pc-full-ip65"><a
                                                    href="/panelnie-computery/aplex/AEx-821P.php"><span class="my_span">21.5&#8243;</span><span> AEx-821P</span></a>
                                        </li>
                                    </ul>

                                </li>


                                <li id="m-paneli-title">
                                    <div class="cat-name m-paneli"><a href="/paneli-operatora/">
                                            Посмотреть все панели оператора
                                        </a></div>
                                </li>
                                <li id="m-weintek" class="m-paneli m-panel-pc m-modbus" data-position="3">
                                    <div class="it-logo"><a href="/weintek/"><img src="/images/logo/weintek.png"
                                                                                  alt="Weintek лого"></a></div>

                                    <div class="free-space"></div>
                                    <ul class="information" style="width: 100%;">
                                        <li><a href="/mqtt/"><span>MQTT</span></a></li>
                                        <li><a href="/easyaccess20.php"><span>EasyAccess 2.0</span></a></li>
                                        <li><a class="compare_table_link" href="/weintek-stavnenie-seriy.php"><span
                                                        class="compare_table_icon"></span><span>Таблица сравнения всех серий Weintek по функционалу</span></a>
                                        </li>
                                        <li><a class="download_linkext_online"
                                               href="/weintek-easybuilderpro-user-manual-en/"><span>EasyBuilder Pro V6 - руководство пользователя, онлайн и скачать</span></a>
                                        </li>
                                        <li><a class="download_linkext_online"
                                               href="/weintek-easybuilder-instrukciya-na-russkom/"><span>EasyBuilder Pro V6 - руководство пользователя <b>на русском языке</b>, онлайн</span></a>
                                        </li>
                                    </ul>


                                    <!-- /**/ -->
                                    <div class="cat-name m-monitors utility__triger__weintek__monitor-obj ">Промышленные
                                        мониторы Weintek
                                    </div>
                                    <ul class="models m-monitors utility__triger__weintek__monitor-obj">
                                        <li class="man-logo m-monitors"><img
                                                    src="/images/weintek/cMT-iM21/cMT-iM21_1.png" alt="cMT-iM21"
                                                    style="max-width: 120px;margin-top: 20px;margin-right: 3px;"
                                                    nopin="nopin"></li>
                                        <li class="m-monitors"><a href="/weintek/cMT-iM21.php"><span class="my_span">21.5&#8243;</span><span
                                                        class="new"> cMT-iM21</span></a></li>
                                    </ul>


                                    <div class="cat-name m-paneli"><a href="/weintek/series_MT8000iP.php">Панели
                                            оператора WEINTEK серия MT8000iP</a></div>
                                    <ul class="models m-paneli">
                                        <li class="man-logo m-paneli"
                                            style="overflow: hidden;height: 115px;margin-top: -34px;"><img
                                                    src="/images/weintek/MT6103iP/MT6103iP_1.png"
                                                    alt="панель оператора weintek, операторская панель weintek, hmi weintek MT6103iP"
                                                    style="margin-right: -15px;"></li>
                                        <li class="m-paneli"><a href="/weintek/MT8051iP.php"><span class="my_span">4.3&#8243;</span><span> MT8051iP</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8071iP.php"><span class="my_span">7&#8243;</span><span> MT8071iP</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8102iP.php"><span class="my_span">10.1&#8243;</span><span> MT8102iP</span></a>
                                        </li>
                                    </ul>


                                    <div class="cat-name m-paneli"><a href="/weintek/series_MT8000iE.php">Панели
                                            оператора WEINTEK серия MT8000iE</a></div>
                                    <ul class="models m-paneli">
                                        <li class="man-logo m-paneli" style="overflow: hidden;"><img
                                                    src="/images/weintek/hmi/MT8102iE/lg/MT8102iE_1.png"
                                                    alt="панель оператора weintek, операторская панель weintek, hmi weintek MT8102iE"
                                                    style="margin-right: -18px;"></li>
                                        <li class="m-paneli"><a href="/weintek/MT8050iE.php"><span class="my_span">4.3&#8243;</span><span> MT8050iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8053iE.php"><span class="my_span">4.3&#8243;</span><span> MT8053iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8070iE.php"><span class="my_span">7&#8243;</span><span> MT8070iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8071iE.php"><span class="my_span">7&#8243;</span><span> MT8071iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8073iE.php"><span class="my_span">7&#8243;</span><span> MT8073iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8070iER.php"><span class="my_span">7&#8243;</span><span> MT8070iER</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8071iER.php"><span class="my_span">7&#8243;</span><span> MT8071iER</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8100iE.php"><span class="my_span">10.1&#8243;</span><span> MT8100iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8101iE.php"><span class="my_span">10.1&#8243;</span><span> MT8101iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8102iE.php"><span class="my_span">10.1&#8243;</span><span> MT8102iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8103iE.php"><span class="my_span">10.1&#8243;</span><span> MT8103iE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8121iE.php"><span class="my_span">12.1&#8243;</span><span> MT8121iE</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-paneli"><a href="/weintek/series_MT8000XE.php">Панели
                                            оператора WEINTEK серия MT8000XE</a></div>
                                    <ul class="models m-paneli">
                                        <li class="man-logo m-paneli"><img src="/images/weintek/MT8092XE/MT8092XE_2.png"
                                                                           alt="MT8092XE" style="max-width: 115px;">
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8090XE.php"><span class="my_span">9.7&#8243;</span><span> MT8090XE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8092XE.php"><span class="my_span">9.7&#8243;</span><span> MT8092XE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8121XE3.php"><span class="my_span">12.1&#8243;</span><span> MT8121XE3</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/MT8150XE.php"><span class="my_span">15&#8243;</span><span> MT8150XE</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-paneli"><a href="/weintek/cmt-x.php">Панели оператора WEINTEK
                                            серия cMT X</a></div>
                                    <ul class="models m-paneli">

                                        <li class="man-logo m-paneli" style="overflow: hidden;"><img
                                                    src="/images/weintek/hmi/cMT3162X/cmt3162x.png" alt="cMT3162X"
                                                    style="margin-top: 21px;max-width: 110px;"></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3072X.php"><span class="my_span">7&#8243;</span><span
                                                        class="new"> cMT3072X</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3072XH.php"><span class="my_span">7&#8243;</span><span
                                                        class="new"> cMT3072XH</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3092X.php"><span class="my_span">9.7&#8243;</span><span
                                                        class="new"> cMT3092X</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3152X.php"><span class="my_span">15&#8243;</span><span
                                                        class="new"> cMT3152X</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3161X.php"><span class="my_span">15.6&#8243;</span><span
                                                        class="new"> cMT3161X</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3162X.php"><span class="my_span">15.6&#8243;</span><span
                                                        class="new"> cMT3162X</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT-FHDX.php"><span
                                                        class="my_span"></span><span class="new"> cMT-FHDX</span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-paneli"><a href="/weintek/CloudHMI.php">Панели оператора
                                            WEINTEK серия cMT (Cloud HMI)</a></div>
                                    <ul class="models m-paneli">
                                        <li class="m-paneli"><a href="/weintek/cMT-G01.php"><span> cMT-G01</span></a>
                                        </li>

                                        <li class="m-paneli"><a href="/weintek/cMT-G02.php"><span> cMT-G02</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-G03.php"><span> cMT-G03</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-G04.php"><span> cMT-G04</span></a>
                                        </li>

                                        <li class="man-logo m-paneli" style="overflow: hidden;"><img
                                                    src="/images/weintek/cMT-SVR-100/cMT-SVR-100_3.png"
                                                    alt="cMT-SVR-100" style="margin-top: 21px;max-width: 110px;"></li>
                                        <li class="m-paneli"><a href="/weintek/cMT3071.php"><span class="my_span">7&#8243;</span><span> cMT3071</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT3072.php"><span class="my_span">7&#8243;</span><span> cMT3072</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-iV6.php"><span class="my_span">9.7&#8243;</span><span> cMT-iV6</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-iPC10.php"><span class="my_span">9.7&#8243;</span><span> cMT-iPC10</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT3090.php"><span class="my_span">9.7&#8243;</span><span> cMT3090</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT3103.php"><span class="my_span">10.1&#8243;</span><span> cMT3103</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT3151.php"><span class="my_span">15&#8243;</span><span> cMT3151</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-iPC15.php"><span class="my_span">15&#8243;</span><span> cMT-iPC15</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/cMT-SVR-100.php"><span
                                                        class="my_span"></span><span> cMT-SVR-100</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT-SVR-102.php"><span
                                                        class="my_span"></span><span> cMT-SVR-102</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT-SVR-200.php"><span
                                                        class="my_span"></span><span> cMT-SVR-200</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT-FHD.php"><span
                                                        class="my_span"></span><span> cMT-FHD</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/cMT-iM21.php"><span
                                                        class="my_span"></span><span> cMT-iM21</span></a></li>
                                    </ul>

                                    <div class="cat-name m-paneli"><a href="/weintek/series_eMT3000.php">Панели
                                            оператора WEINTEK серия eMT3000</a></div>
                                    <ul class="models m-paneli">
                                        <li class="man-logo m-paneli" style="overflow: hidden;"><img
                                                    src="/images/weintek/eMT3070B/eMT3070B_1.png"
                                                    alt="панель оператора weintek, операторская панель weintek, hmi weintek eMT3070B"
                                                    style="max-width: 120px;margin-right: -5px;"></li>
                                        <? /* ?><li class="m-paneli"><a href="/weintek/eMT3070A.php"><span class="my_span">7&#8243;</span><span> eMT3070A</span></a></li><? */ ?>
                                        <li class="m-paneli"><a href="/weintek/eMT3070B.php"><span class="my_span">7&#8243;</span><span> eMT3070B</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/eMT3105P.php"><span class="my_span">10.4&#8243;</span><span> eMT3105P</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/eMT3120A.php"><span class="my_span">12.1&#8243;</span><span> eMT3120A</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/weintek/eMT3150A.php"><span class="my_span">15&#8243;</span><span> eMT3150A</span></a>
                                        </li>
                                    </ul>
                                    <? /* ?>
      <div class="cat-name m-paneli"><a href="/weintek/series_MT8000i.php">Панели оператора WEINTEK серия MT8000i</a></div>
      <ul class="models m-paneli">
      <li class="man-logo m-paneli" style="overflow: hidden;"><img src="/images/weintek/MT8104iH/MT8104iH_2.png" alt="панель оператора weintek, операторская панель weintek, hmi weintek MT8104iH" style="margin-right: -4px;max-width: 120px;"></li>
      <li class="m-paneli"><a href="/weintek/MT8050i.php"><span class="my_span">4.3&#8243;</span><span> MT8050i</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8070iH.php"><span class="my_span">7&#8243;</span><span> MT8070iH</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8100i.php"><span class="my_span">10&#8243;</span><span> MT8100i</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8104iH.php"><span class="my_span">10.4&#8243;</span><span> MT8104iH</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8104XH.php"><span class="my_span">10.4&#8243;</span><span> MT8104XH</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8121X.php"><span class="my_span">12.1&#8243;</span><span> MT8121X</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT8150X.php"><span class="my_span">15&#8243;</span><span> MT8150X</span></a></li>
      </ul>

      <div class="cat-name m-paneli"><a href="/weintek/series_MT6000i.php">Панели оператора WEINTEK серия MT6000i</a></div>
      <ul class="models m-paneli">
      <li class="man-logo m-paneli" style="overflow: hidden;"><img src="/images/weintek/MT6100i/MT6100i_2.png" alt="панель оператора weintek, операторская панель weintek, hmi weintek MT6100i" style="margin-right: -7px;max-width: 124px;"></li>
      <li class="m-paneli"><a href="/weintek/MT6050i.php"><span class="my_span">4.3&#8243;</span><span> MT6050i</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT6070iH.php"><span class="my_span">7&#8243;</span><span> MT6070iH</span></a></li>
      <li class="m-paneli"><a href="/weintek/MT6100i.php"><span class="my_span">10&#8243;</span><span> MT6100i</span></a></li>
      </ul>
      <? */ ?>
                                    <div class="cat-name m-paneli"><a href="/weintek/mTV-100.php">Панели оператора
                                            WEINTEK серия mTV (Machine-TV)</a></div>
                                    <ul class="models m-paneli">
                                        <li class="man-logo m-paneli" style="overflow: hidden;margin-top: 0px;"><img
                                                    src="/images/weintek/mTV-100/mTV-100_1.png"
                                                    alt="Интерфейс Machine-TV mTV-100"
                                                    style="margin-right: -34px;max-width: 134px;"></li>
                                        <li class="m-paneli"><a href="/weintek/mTV-100.php"><span
                                                        class="my_span"></span><span>mTV-100</span></a></li>
                                    </ul>

                                    <? /* ?><div class="cat-name m-wince"><a href="/weintek/#mt-600-windows-ce">Панельные компьютеры WEINTEK <br /><span style="font-size:smaller;">Windows CE</span></a></div>

                                  <ul class="models m-wince">
                                  <li class="man-logo m-wince"><img src="/images/weintek/eMT612A/eMT612A_2.png" alt="MT8092XE" style="max-width: 115px;"></li>
                                  <li class="m-wince"><a href="/weintek/MT607i.php"><span class="my_span">7&#8243;</span><span> MT607i</span></a></li>
                                  <li class="m-wince"><a href="/weintek/eMT607A.php"><span class="my_span">7&#8243;</span><span> eMT607A</span></a></li>
                                  <li class="m-wince"><a href="/weintek/MT610i.php"><span class="my_span">10&#8243;</span><span> MT610i</span></a></li>
                                  <li class="m-wince"><a href="/weintek/eMT610P.php"><span class="my_span">10&#8243;</span><span> eMT610P</span></a></li>
                                  <li class="m-wince"><a href="/weintek/eMT612A.php"><span class="my_span">12&#8243;</span><span> eMT612A</span></a></li>
                                  <li class="m-wince"><a href="/weintek/eMT615A.php"><span class="my_span">15&#8243;</span><span> eMT615A</span></a></li>
                                  </ul>
                                  <? */ ?>
                                    <div class="cat-name m-panel-pc"><a href="/weintek/#pc">Панельные компьютеры WEINTEK
                                            <br/><span
                                                    style="font-size:smaller;">Intel Atom E3827 2 ядра 1.75 ГГц</span></a>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/weintek/cMT-iPC15/cMT-iPC15_2.png" alt="cMT-iPC15"
                                                    style="max-width: 125px;margin-right: -5px;"></li>
                                        <li class="m-panel-pc"><a href="/weintek/cMT-iPC15.php"><span class="my_span">15&#8243;</span><span> cMT-iPC15</span></a>
                                        </li>
                                    </ul>
                                    <ul class="series">

                                        <li class="m-paneli"><a
                                                    href="/weintek/series_MT8000iE.php"><span>MT8000iE</span></a></li>
                                        <li class="m-paneli"><a
                                                    href="/weintek/series_MT8000XE.php"><span>MT8000XE</span></a></li>
                                        <li class="m-paneli"><a href="/weintek/series_eMT3000.php"><span>eMT3000</span></a>
                                        </li>
                                        <? /* ?><li class="m-paneli"><a href="/weintek/series_MT6000i.php"><span>МТ6000i</span></a></li><? */ ?>
                                        <? /* ?><li class="m-paneli"><a href="/weintek/series_MT8000i.php"><span>MT8000i</span></a></li><? */ ?>
                                        <li class="m-paneli"><a href="/weintek/mTV-100.php"><span>mTV</span></a></li>
                                        <li class="m-paneli m-panel-pc"><a
                                                    href="/weintek/CloudHMI.php"><span>Cloud HMI</span></a></li>
                                    </ul>


                                    <div class="cat-name m-paneli"><a href="/accessories/">Аксессуары для панелей
                                            оператора</a></div>
                                    <ul class="models m-paneli">
                                        <li class="m-paneli"><a href="/accessories/HF/HF-04/">Рамка для панелей 4.3&#8243;</a>
                                        </li>

                                        <li class="m-paneli"><a href="/accessories/HF/HF-07/">Рамка для панелей
                                                7&#8243;</a></li>
                                        <li class="m-paneli"><a href="/accessories/HF/HF-09/">Рамка для панелей
                                                9&#8243;</a></li>
                                        <li class="m-paneli"><a href="/accessories/HF/HF-12/">Рамка для панелей 12&#8243;</a>
                                        </li>
                                        <li class="m-paneli"><a href="/routers/md/4G/TANDEM-4GR/">Роутер 4G\3G WiFi
                                                TANDEM-4GR</a></li>
                                    </ul>

                                    <div id="m-weintek" class="m-plc m-modbus">
                                        <div class="free-space"></div>
                                        <div class="block_menu_weintek_content">
                                            <div class="cat-name m-modbus">ПЛК Weintek</div>
                                            <ul class="models m-plc m-modbus">
                                                <li class="m-plc">
                                                    <a href="/weintek/cMT-CTRL01.php">
                                                        <img src="/images/weintek/controllers/cMT-CTRL01/sm/cMT-CTRL01_2.png"
                                                             alt="cMT-CTRL01"
                                                             style="margin-top: 8px;margin-left: -9px;float:left;">
                                                        <span class="w150">Weintek cMT-CTRL01 - программируемый логический контроллер </span>
                                                        (CODESYS, MQTT, OPC UA)
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="free-space"></div>
                                        </div>

                                    </div>

                                    <div class="cat-name m-modbus"><a href="/plc/weintek/">Модульная система ввода
                                            вывода Weintek серии iR</a>
                                        <br><br>


                                        <div class="cat-name2 m-modbus"><span
                                                    class="block_menu_weintek_content_section__preview_image"
                                                    style="background-size: auto 82%;background-image: url('/images/controllers/weintek/iR-COP/sm/iR-COP_1.png');"></span>Коммуникационные
                                            модули серии iR
                                        </div>
                                        <ul class="models m-modbus">
                                            <li class="m-modbus"><a href="/plc/weintek/iR-COP.php">

                                                    <span class="w150">iR-COP <span>(CANopen)</span></span></a></li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-ETN.php"><span class="w150">iR-ETN <span>(Modbus TCP/IP)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-ECAT.php"><span class="w150">iR-ECAT <span>(EtherCAT)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/weintek/iR-ETN40R/"><span class="w150">iR-ETN40R</span></a>
                                            </li>
                                            <li style="opacity: 0;display: block" class="m-modbus"></li>
                                            <? /* <li class="man-logo m-modbus"></li> */ ?>
                                        </ul>
                                        <div class="cat-name2 m-modbus"><span
                                                    class="block_menu_weintek_content_section__preview_image"
                                                    style="background-size: auto 100%;background-image: url('/images/controllers/weintek/iR-DI16-K/sm/iR-DI16-K_1.png');"></span>Дискретные
                                            модули ввода вывода серии iR
                                        </div>
                                        <ul class="models m-modbus" style="margin-bottom: 25px;">
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DI16-K.php"><span
                                                            class="w150">iR-DI16-K <span>16DI(npn/pnp)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DM16-P.php"><span
                                                            class="w150">iR-DM16-P <span>8DI(npn/pnp) 8DO(pnp)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DM16-N.php"><span
                                                            class="w150">iR-DM16-N <span>8DI(npn/pnp) 8DO(npn)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DQ16-P.php"><span
                                                            class="w150">iR-DQ16-P <span>16DO(pnp)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DQ16-N.php"><span
                                                            class="w150">iR-DQ16-N <span>16DO(npn)</span></span></a>
                                            </li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-DQ8-R.php"><span class="w150">iR-DQ8-R <span>8DO(реле)</span></span></a>
                                            </li>
                                        </ul>
                                        <div class="cat-name2 m-modbus"><span
                                                    class="block_menu_weintek_content_section__preview_image"
                                                    style="background-size: auto 100%;background-image: url('/images/controllers/weintek/iR-AI04-TR/sm/iR-AI04-TR_1.png');"></span>Аналоговые
                                            модули ввода вывода серии iR
                                        </div>
                                        <ul class="models m-modbus">
                                            <li class="m-modbus"><a href="/plc/weintek/iR-AI04-VI.php"><span
                                                            class="w150">iR-AI04-VI <span>4AI</span></span></a></li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-AM06-VI.php"><span
                                                            class="w150">iR-AM06-VI <span>4AI 2AO</span></span></a></li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-AQ04-VI.php"><span
                                                            class="w150">iR-AQ04-VI <span>4AO</span></span></a></li>
                                            <li class="m-modbus"><a href="/plc/weintek/iR-AI04-TR.php"><span
                                                            class="w150">iR-AI04-TR <span>4AI</span></span></a></li>
                                        </ul>
                                        <div class="cat-name2 m-modbus"><span
                                                    class="block_menu_weintek_content_section__preview_image"
                                                    style="background-size: auto 100%;background-image: url('/images/controllers/weintek/iR-PU01-P/sm/iR-PU01-P_1.png');"></span>Модули
                                            для управления движением серии iR
                                        </div>
                                        <ul class="models m-modbus">
                                            <li class="m-modbus"><a href="/plc/weintek/iR-PU01-P.php"><span
                                                            class="w150">iR-PU01-P</span></a></li>
                                        </ul>

                                    </div>

                                    <div><br></div>


                                </li>
                                <li id="m-samkoon" class="m-paneli" data-position="4">
                                    <div class="it-logo"><a href="/samkoon/"><img src="/images/logo/samkoon.png"
                                                                                  alt="Samkoon лого"></a></div>

                                    <div class="free-space"></div>
                                    <div class="cat-name m-paneli"><a href="/samkoon/">Панели оператора SAMKOON</a>
                                    </div>
                                    <ul class="models m-paneli">
                                        <li style="display: block;font-size: 13px;"><b>Серия SK</b></li>
                                        <li class="m-paneli"><a href="/samkoon/SK-035AE.php"><span class="my_span">3.5&#8243;</span><span> SK-035AE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-043AE.php"><span class="my_span">4.3&#8243;</span><span> SK-043AE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-043HE.php"><span class="my_span">4.3&#8243;</span><span> SK-043HE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-043HS.php"><span class="my_span">4.3&#8243;</span><span> SK-043HS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-043AEB.php"><span class="my_span">4.3&#8243;</span><span> SK-043AEB</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-043ASB.php"><span class="my_span">4.3&#8243;</span><span> SK-043ASB</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-050AE.php"><span class="my_span">5&#8243;</span><span> SK-050AE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-050AS.php"><span class="my_span">5&#8243;</span><span> SK-050AS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-050HE.php"><span class="my_span">5&#8243;</span><span> SK-050HE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-050HS.php"><span class="my_span">5&#8243;</span><span> SK-050HS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-070BE.php"><span class="my_span">7&#8243;</span><span> SK-070BE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-070HE.php"><span class="my_span">7&#8243;</span><span> SK-070HE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-070HS.php"><span class="my_span">7&#8243;</span><span> SK-070HS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-070BS.php"><span class="my_span">7&#8243;</span><span> SK-070BS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-102AE.php"><span class="my_span">10&#8243;</span><span> SK-102AE</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/SK-102AS.php"><span
                                                        class="my_span">10" </span><span> SK-102AS</span></a></li>
                                        <li class="m-paneli"><a href="/samkoon/SK-102HS.php"><span
                                                        class="my_span">10" </span><span> SK-102HS</span></a></li>
                                        <li style="display: block;font-size: 13px;"><b>Серия EA</b></li>
                                        <li class="m-paneli"><a href="/samkoon/EA-035A-T.php"><span class="my_span">3.5&#8243;</span><span>EA-035A-T</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/EA-043A.php"><span class="my_span">4.3&#8243;</span><span>EA-043A</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/EA-070B.php"><span class="my_span">7.0&#8243;</span><span>EA-070B</span></a>
                                        </li>

                                        <li class="man-logo m-paneli" style="overflow: hidden;margin-top: -7px;"><img
                                                    src="/images/samkoon/SK-102HS/SK-102HS_1.png" alt="SK-102HS"
                                                    style="margin-right: -14px;max-width: 139px;"></li>

                                        <li style="display: block;font-size: 13px;"><b>Серия OP</b></li>
                                        <li class="m-paneli"><a href="/samkoon/OP-835.php"><span class="my_span">3.5&#8243;</span><span> OP-835</span></a>
                                        </li>
                                        <li style="display: block;font-size: 13px;"><b>Серия AK</b></li>
                                        <li class="m-paneli"><a href="/samkoon/AK-070BS.php"><span class="my_span">7&#8243;</span><span> AK-070BS</span></a>
                                        </li>
                                        <li class="m-paneli"><a href="/samkoon/AK-035A-T.php"><span class="my_span">3.5&#8243;</span><span
                                                        class="new w150"> AK-035A-T <span>(ОС Android)</span></span></a>
                                        </li>

                                    </ul>
                                </li>

                                <li id="m-haiwell" class="m-plc m-modbus" data-position="5">
                                    <div class="it-logo" style="overflow: hidden;height: 50px;margin-top: 10px;"><a
                                                href="/plc/haiwell/"><img style="overflow: hidden;height: 50px"
                                                                          src="/images/logo/haiwell.png"
                                                                          alt="Haiwell лого"></a></div>
                                    <br>
                                    <div class="free-space"></div>
                                    <div class="block_menu_haiwell_content">
                                        <?
                                        global $DBWORK;
                                        $haiwell_sections = $DBWORK->get_list_catalog_sections(array("parent_code" => "plc-controllers"));
                                        foreach ($haiwell_sections as $haiwell_section) {
                                            ?>
                                            <div class="block_menu_haiwell_content__haiwell_section">
                                                <a class="block_menu_haiwell_content__haiwell_section_title"
                                                   href="/plc/haiwell/#<?= $haiwell_section["code"] ?>">
                                                    <span class="block_menu_haiwell_content_section__preview_image"
                                                          style="background-image: url('<?= $haiwell_section["picture_preview"] ?>');"></span>
                                                    <?= $haiwell_section["name"] ?>
                                                    <? /* ?> <span style="font-size:smaller;"><?= $haiwell_section["text_preview"] ?></span></a></div><? */
                                                    ?>
                                                </a>
                                                <div class="block_menu_haiwell_content__haiwell_elements">
                                                    <ul class="models m-plc">

                                                        <?
                                                        $list_catalog_section_elements = $DBWORK->get_list_catalog_section(array("section_code" => $haiwell_section["code"]));
                                                        foreach ($list_catalog_section_elements as $list_catalog_section_element) {
                                                            ?>
                                                            <li class="m-plc"><a
                                                                    href="/plc/haiwell/<?= $list_catalog_section_element["section_code"] . "/" . $list_catalog_section_element["code"] . "/" ?>">
                                                                <span class="w150"><?= $list_catalog_section_element["name"] ?></span>
                                                            </a>
                                                            </li><? } ?>
                                                    </ul>
                                                </div>
                                                <?
                                                /* ?><pre><? var_dump($list_catalog_section_elements); ?></pre><? */
                                                ?>
                                            </div>
                                        <? } ?>

                                        <div class="free-space"></div>
                                    </div>

                                </li>
                                <li id="m-yottacontrol" class="m-plc m-modbus">
                                    <div class="it-logo"><a href="/plc/yottacontrol/"><img
                                                    src="/images/logo/yottacontrol.jpg" alt="Yottacontrol лого"></a>
                                    </div>

                                    <div class="free-space"></div>

                                    <div class="cat-name m-plc"><a href="/plc/yottacontrol/#plc-a-52">PLC YOTTACONTROL
                                            серия A-52 <br/><span style="font-size:smaller;">Wi-Fi, дисплей, RS-485, RS-232, USB2.0</span></a>
                                    </div>
                                    <ul class="models m-plc">
                                        <li class="man-logo m-plc" style="overflow: hidden;height: 142px;"><img
                                                    src="/images/controllers/yottacontrol/A-52x/A-52x_1.png"
                                                    alt="PLC Yottacontrol серия A-52"
                                                    style="margin-right: -28px;max-width: 183px;max-height: 172px;">
                                        </li>

                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5288D.php"><span class="w150">A-5288D <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5288D-T.php"><span class="w150">A-5288D-T <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5289D.php"><span class="w150">A-5289D 8DI <span>4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5289D-T.php"><span class="w150">A-5289D-T <span>8DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5290D.php"><span class="w150">A-5290D 2DI <span>4AI 2DO 2AO</span></span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-plc" style="margin-top: 0px;"><a
                                                href="/plc/yottacontrol/#plc-a-51">PLC YOTTACONTROL серия A-51
                                            <br/><span style="font-size:smaller;">RS-485x2, RS-232, USB2.0, <br/>индикаторы/дисплей/micro-SD</span></a>
                                    </div>
                                    <ul class="models m-plc">
                                        <li class="man-logo m-plc"><img
                                                    src="/images/controllers/yottacontrol/A-51x/A-51x_17.png"
                                                    alt="PLC A-51x"></li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188.php"><span class="w150">A-5188 <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188-T.php"><span class="w150">A-5188-T <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188D.php"><span class="w150">A-5188D <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188D-T.php"><span class="w150">A-5188D-T <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188M.php"><span class="w150">A-5188M <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5188M-T.php"><span class="w150">A-5188M-T <span>8DI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189.php"><span class="w150">A-5189 <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189-T.php"><span class="w150">A-5189-T <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189D.php"><span class="w150">A-5189D <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189D-T.php"><span class="w150">A-5189D-T <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189M.php"><span class="w150">A-5189M <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5189M-T.php"><span class="w150">A-5189M-T <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5190.php"><span class="w150">A-5190 <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/A-5190D.php"><span class="w150">A-5190D <span>4DI 4AI 4DO</span></span></a>
                                        </li>
                                    </ul>


                                    <div class="cat-name m-modbus"><a href="/plc/yottacontrol/#modules-a-10">Модули
                                            ввода-вывода серия A-10 <br><span
                                                    style="font-size:smaller;">RS-485 Modbus</span></a></div>
                                    <ul class="models m-modbus">
                                        <li class="man-logo m-modbus"><img
                                                    src="/images/controllers/yottacontrol/A-10x/A-10x_10.png"
                                                    alt="Yottacontrol универсальные модули ввода-вывода серии A-10"
                                                    style="margin-right: -4px;"></li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1010.php"><span class="w150">A-1010 <span>8AI 2AO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1012.php"><span class="w150">A-1012 <span>2DI 4AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1051.php"><span class="w150">A-1051 <span>16DI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1055.php"><span class="w150">A-1055 <span>8DI 8DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1055S.php"><span class="w150">A-1055S <span>8DI 8DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1057.php"><span class="w150">A-1057 <span>12DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1058.php"><span class="w150">A-1058 <span>12DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1068.php"><span class="w150">A-1068 <span>8DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1069.php"><span class="w150">A-1069 <span>8DO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1060.php"><span class="w150">A-1060 <span>8DI 4DO</span></span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-modbus"><a href="/plc/yottacontrol/#modules-a-12">Модули
                                            ввода-вывода серия A-12 <br><span style="font-size:smaller;">Wi-Fi, Modbus TCP/IP</span></a>
                                    </div>
                                    <ul class="models m-modbus">
                                        <li class="man-logo m-modbus" style="overflow: hidden;"><img
                                                    src="/images/controllers/yottacontrol/A-1212/A-1212_1.png"
                                                    alt="Yottacontrol универсальные модули ввода-вывода с Wi-Fi серии A-12"
                                                    style="margin-right: -34px;"></li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1212.php"><span class="w150">A-1212 <span>2DI 4AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1219.php"><span class="w150">A-1219 <span>2DI 8AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1251.php"><span class="w150">A-1251 <span>16DI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1255.php"><span class="w150">A-1255 <span>2DI 4AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1260.php"><span class="w150">A-1260 <span>2DI 4AI</span></span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-modbus"><a href="/plc/yottacontrol/#modules-a-18">Модули
                                            ввода-вывода серия A-18 <br><span style="font-size:smaller;">Ethernet, Modbus TCP/IP</span></a>
                                    </div>
                                    <ul class="models m-modbus">
                                        <li class="man-logo m-modbus" style="overflow: hidden;"><img
                                                    src="/images/controllers/yottacontrol/A-1855/A-1855_1.png"
                                                    alt="Yottacontrol универсальные модули ввода-вывода с Ethernet серии A-18"
                                                    style="margin-right: -34px;"></li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1812.php"><span class="w150">A-1812 <span>2DI 4AI 2AO</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1819.php"><span class="w150">A-1819 <span>8AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1851.php"><span class="w150">A-1851 <span>16DI 4AI</span></span></a>
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-1860.php"><span class="w150">A-1860 <span>2DI 4AI 4DO</span></span></a>
                                        </li>
                                    </ul>
                                    <div class="cat-name m-modbus"><a href="/plc/yottacontrol/A-3016.php">Радиомодуль
                                            YOTTACONTROL <br/><span style="font-size:smaller;">RS-485, индикаторы, пульт дистанционного управления</span></a>
                                    </div>
                                    <ul class="models m-modbus">
                                        <li class="man-logo m-modbus"
                                            style="overflow: hidden;height: 169px;width: 200px;"><img
                                                    src="/images/controllers/yottacontrol/A-3016/A-3016_1.png"
                                                    alt="радиомодуль ввода-вывода A-3016 Yottacontrol"
                                                    style="max-width: 215px;max-height: 210px;margin-right: -52px;">
                                        </li>
                                        <li class="m-modbus"><a href="/plc/yottacontrol/A-3016.php"><span class="w150">A-3016 <span>6DI 7DO</span></span></a>
                                        </li>
                                    </ul>
                                    <ul class="series" style="margin-top: -49px;">
                                        <li class="m-plc"><a href="/plc/yottacontrol/"><span
                                                        class="my_span"></span><span>Контроллеры</span></a></li>
                                        <li class="m-plc"><a href="/plc/yottacontrol/#modules-a-12"><span
                                                        class="my_span"></span><span>Модули</span></a></li>
                                    </ul>
                                </li>

                                <li id="m-faraday" class="m-power-supply">
                                    <div class="it-logo"><a href="/bloki-pitaniya/faraday/"><img
                                                    src="/images/logo/faraday.png" alt="Faraday лого"></a></div>

                                    <div class="free-space"></div>
                                    <div class="cat-name m-power-supply"><a href="/bloki-pitaniya/faraday/">Блоки&nbsp;питания
                                            FARADAY</a></div>
                                    <ul class="models m-power-supply">
                                        <li class="man-logo m-power-supply"><img
                                                    src="/images/faraday/faraday-50W/faraday-50W_2.png"
                                                    alt="Faraday 50W"></li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-12W-din.php"><span> Faraday 12W/12-24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-18W.php"><span> Faraday 18W/12-24V/78AL</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-36W.php"><span> Faraday 36W/12-24V/95AL</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-36W-din.php"><span> Faraday 36W/12-24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-50W.php"><span> Faraday 50W/12-24V/120AL</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-50W-din.php"><span> Faraday 50W/12-24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-75W.php"><span> Faraday 75W/12-24V/140AL</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-75W-din.php"><span> Faraday 75W/12-24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-120W-din.php"><span> Faraday 120W/24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-150W.php"><span> Faraday 150W/24V</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-24W-din.php"><span> Faraday 24W/12-24V/DIN</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-ups-30w-simple.php"><span> Faraday UPS 30W SIMPLE 13.8V</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-ups-30w-simple-24v.php"><span> Faraday UPS 30W SIMPLE 24V</span></a>
                                        </li>
                                        <li class="m-power-supply"><a
                                                    href="/bloki-pitaniya/faraday/faraday-ups-75w-simple.php"><span> Faraday UPS 75W SIMPLE</span></a>
                                        </li>
                                    </ul>

                                </li>

                                <li id="m-modbus" class="m-modbus" style="width: 100%;">
                                    <div class="it-logo"><a href="/modules/"><img src="/images/logo/iecon.png"
                                                                                  alt="IECON лого"></a></div>

                                    <div class="free-space"></div>
                                    <div class="cat-name m-modbus"><a href="/modules/">Модули IECON</a></div>
                                    <ul class="models m-modbus">
                                        <li class="man-logo m-modbus" style="height: 120px;overflow: hidden;"><img
                                                    src="/images/controllers/iecon/EBM-A/EBM-A_1.png" alt="модуль EBM-A"
                                                    style="margin-right: -24px;"></li>
                                        <? /* ?><li class="m-modbus"><a href="/modules/EBM-A.php">Модуль&nbsp;ввода-вывода EBM-A</a></li><? */ ?>
                                        <li class="m-modbus"><a href="/modules/EBM-B.php">Модуль&nbsp;ввода-вывода
                                                EBM-B</a></li>
                                        <li class="m-modbus"><a href="/modules/CPM-C.php">Центральный процессорный
                                                модуль CPM-C</a></li>
                                    </ul>

                                </li>
                                <li id="m-2n" class="m-paneli m-android">
                                    <div class="it-logo"><a href="/HMI-android.php"><img src="/images/logo/2n.png"
                                                                                         alt="2N лого"></a></div>

                                    <div class="free-space"></div>
                                    <div class="cat-name m-paneli m-android"><a href="/HMI-android.php">Панели оператора
                                            2N</a></div>
                                    <ul class="models m-paneli m-android">
                                        <li class="man-logo m-paneli m-android" style="overflow:hidden;"><img
                                                    src="/images/skud/2N-indoor-touch/2N-indoor-touch_1.png"
                                                    alt="2N Indoor" style="max-width: 100px;margin-right: 5px;"></li>
                                        <li class="m-paneli m-android">
                                            <div><a href="/HMI-android.php">Панель оператора Android для умного дома 2N
                                                    Indoor Touch</a>
                                        </li>
                                    </ul>

                                </li>

                                <li id="m-cincoze" class="m-panel-pc m-box-pc m-monitors">
                                    <div class="it-logo"><a href="/cincoze/"><img src="/images/logo/cincoze.png"
                                                                                  alt="Concoze лого" nopin="nopin"></a>
                                    </div>

                                    <div class="free-space"></div>

                                    <div class="cat-name m-panel-pc"><a href="/cincoze/#panels">Панельные компьютеры
                                            Cincoze&nbsp;Crystal <br/><span style="font-size:smaller;">CPU Intel Atom E3845 4 ядра 1.91ГГц</span></a>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/cincoze/CV-117-P1001/CV-117-P1001_1.png"
                                                    alt="CV-117-P1001" style="max-width: 125px;" nopin="nopin"></li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-108-P1001.php"><span
                                                        class="my_span">8.4&#8243;</span><span> CV-108/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-110-P1001.php"><span
                                                        class="my_span">10.4&#8243;</span><span> CV-110/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112-P1001.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112H-P1001.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112H/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-115-P1001.php"><span
                                                        class="my_span">15&#8243;</span><span> CV-115/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-W115-P1001.php"><span
                                                        class="my_span">15.6&#8243;</span><span> CV-W115/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-117-P1001.php"><span
                                                        class="my_span">17&#8243;</span><span> CV-117/P1001</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-119-P1001.php"><span
                                                        class="my_span">19&#8243;</span><span> CV-119/P1001</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-panel-pc  new"><a href="/cincoze/#panels">Панельные
                                            компьютеры Cincoze&nbsp;Crystal <br/><span style="font-size:smaller;">CPU Intel Core U processors (Skylake) 6-й до 3ГГц</span></a>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/cincoze/CV-117-P1001/CV-117-P1001_1.png"
                                                    alt="CV-117-P1001" style="max-width: 125px;" nopin="nopin"></li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112-P2002.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112H-P2002.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112H/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-115-P2002.php"><span
                                                        class="my_span">15&#8243;</span><span> CV-115/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-W115-P2002.php"><span
                                                        class="my_span">15.6&#8243;</span><span> CV-W115/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-117-P2002.php"><span
                                                        class="my_span">17&#8243;</span><span> CV-117/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-119-P2002.php"><span
                                                        class="my_span">19&#8243;</span><span> CV-119/P2002</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-W121-P2002.php"><span
                                                        class="my_span">21.5&#8243;</span><span> CV-W121/P2002</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-panel-pc new"><a href="/cincoze/#panels">Панельные компьютеры
                                            Cincoze&nbsp;Crystal <br/><span style="font-size:smaller;">CPU Intel Core U processors (Skylake) 6-й до 3ГГц, <br/>доп. расширение 1x PCI или 1x PCIex4</span></a>
                                    </div>
                                    <ul class="models m-panel-pc">
                                        <li class="man-logo m-panel-pc"><img
                                                    src="/images/cincoze/CV-117-P1001/CV-117-P1001_1.png"
                                                    alt="CV-117-P1001" style="max-width: 125px;" nopin="nopin"></li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112-P2002E.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-112H-P2002E.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112H/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-115-P2002E.php"><span
                                                        class="my_span">15&#8243;</span><span> CV-115/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-W115-P2002E.php"><span
                                                        class="my_span">15.6&#8243;</span><span> CV-W115/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-117-P2002E.php"><span
                                                        class="my_span">17&#8243;</span><span> CV-117/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-119-P2002E.php"><span
                                                        class="my_span">19&#8243;</span><span> CV-119/P2002E</span></a>
                                        </li>
                                        <li class="m-panel-pc"><a href="/cincoze/CV-W121-P2002E.php"><span
                                                        class="my_span">21.5&#8243;</span><span> CV-W121/P2002E</span></a>
                                        </li>
                                    </ul>

                                    <div class="cat-name m-box-pc"
                                         style="width: calc(100% - 150px);z-index: 3;position: relative;"><a
                                                href="/cincoze/#boxes">Встраиваемые компьютеры Cincoze&nbsp;Diamond</a>
                                    </div>
                                    <ul class="models m-box-pc">
                                        <li class="man-logo m-box-pc" style="width: 97px;"><img
                                                    src="/images/cincoze/DS-1000/DS-1000_1.png" alt="DS-1000"
                                                    style="margin-top: 52px;margin-right: 5px;max-width: 120px;"
                                                    nopin="nopin"></li>
                                        <li class="m-box-pc no-after"><a href="/cincoze/DA-1000.php"><span
                                                        class="my_span"></span><span><span class="w70">DA-1000</span> CPU Intel Atom E3826 2 ядра 1.46 ГГц </span></a>
                                        </li>
                                        <li class="m-box-pc no-after"><a href="/cincoze/DC-1100.php"><span
                                                        class="my_span"></span><span><span class="w70">DC-1100</span> CPU Intel Atom E3845 4 ядра 1.91 ГГц </span> </span>
                                            </a></li>
                                        <li class="m-box-pc no-after" style="z-index: 2;"><a
                                                    href="/cincoze/DS-1000.php"><span class="my_span"></span><span><span
                                                            class="w70">DS-1000</span> CPU Intel Core™ i3/ i5/ i7 2.4 ГГц </span>
                                                DS-1000</span></a></li>
                                        <li class="m-box-pc no-after"><a href="/cincoze/DS-1002.php"><span
                                                        class="my_span"></span><span><span class="w70">DS-1002</span> 	Intel Core™ i3/ i5/ i7 2.4 ГГц </span> </span>
                                            </a></li>
                                    </ul>
                                    <div class="cat-name m-monitors"><a href="/cincoze/#monitors">Мониторы Cincoze&nbsp;Crystal</a>
                                    </div>
                                    <ul class="models m-monitors">
                                        <li class="man-logo m-monitors"><img
                                                    src="/images/cincoze/CV-119-M1001/CV-119-M1001_1.png"
                                                    alt="CV-119-M1001" style="margin-top: 21px;max-width: 129px;"
                                                    nopin="nopin"></li>
                                        <li class="m-monitors"><a href="/cincoze/CV-108-M1001.php"><span
                                                        class="my_span">8.4&#8243;</span><span> CV-108/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-110-M1001.php"><span
                                                        class="my_span">10.4&#8243;</span><span> CV-110/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-112-M1001.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-112H-M1001.php"><span
                                                        class="my_span">12.1&#8243;</span><span> CV-112H/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-115-M1001.php"><span
                                                        class="my_span">15&#8243;</span><span> CV-115/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-W115-M1001.php"><span
                                                        class="my_span">15.6&#8243;</span><span> CV-W115/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-117-M1001.php"><span
                                                        class="my_span">17&#8243;</span><span> CV-117/M1001</span></a>
                                        </li>
                                        <li class="m-monitors"><a href="/cincoze/CV-119-M1001.php"><span
                                                        class="my_span">19&#8243;</span><span> CV-119/M1001</span></a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>


                        </div>
                    </div>

                </div>
            <?endif; ?>
        </div>
    </nav>
    <!-- /nav -->
    <?
    /*
      <div class="cat-name m-plc"><a href="/plc/yottacontrol/#plc-a-61">PLC YOTTACONTROL серия A-61 <br /><span style="font-size:smaller;">RS-485, индикаторы/дисплей/micro-SD</span></a></div>
      <ul class="models m-plc">
      <li class="man-logo m-plc"><img src="/images/controllers/yottacontrol/A-61x/A-61x_1.png" alt="PLC Yottacontrol серия A-61" style="margin-top: 13px;margin-right: 5px;"></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188-D.php"><span class="w150">A-6188-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188D-D.php"><span class="w150">A-6188D-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188T-D.php"><span class="w150">A-6188T-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6189T-D.php"><span class="w150">A-6189T-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6189DT-D.php"><span class="w150">A-6189DT-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188M-D.php"><span class="w150">A-6188M-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188DT-D.php"><span class="w150">A-6188DT-D <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188MT-D.php"><span class="w150">A-6188MT-D <span>8DI 4DO</span></span></a></li>

      <li class="m-plc"><a href="/plc/yottacontrol/A-6188-A.php"><span class="w150">A-6188-A <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188D-A.php"><span class="w150">A-6188D-A <span>8DI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6188M-A.php"><span class="w150">A-6188M-A <span>8DI 4DO</span></span></a></li>

      <li class="m-plc"><a href="/plc/yottacontrol/A-6189-D.php"><span class="w150">A-6189-D <span>4DI 4AI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6189D-D.php"><span class="w150">A-6189D-D <span>4DI 4AI 4DO</span></span></a></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6189M-D"><span class="w150">A-6189M-D <span>4DI 4AI 4DO</span></a></span></li>
      <li class="m-plc"><a href="/plc/yottacontrol/A-6189MT-D.php"><span class="w150">A-6189MT-D <span>4DI 4AI 4DO</span></span></a></li>
      </ul>

      <div class="cat-name m-modbus"><a href="/plc/yottacontrol/#modules-a-2">Модули YOTTACONTROL серии A-2</a></div>
      <ul class="models m-modbus">
      <li class="man-logo m-modbus" style="overflow: hidden;"><img src="/images/controllers/yottacontrol/A-2060x/A-2060x_1.png" alt="PLC Yottacontrol серия A-21" style="max-width: 110px;margin-right: -19px;"></li>
      <li class="m-modbus"><a href="/plc/yottacontrol/A-2060-D.php"><span class="w150">A-2060-D <span>8DI 4DO</span></span></a></li>
      <li class="m-modbus"><a href="/plc/yottacontrol/A-2060-A.php"><span class="w150">A-2060-A <span>4DI 4DO</span></span></a></li>
      </ul>
     */
}

function left_menu()
{
    ?>

    <br>
    <div id='cssmenu'>
        <ul>
            <li class='active'><a href='index.html'><span>КАТАЛОГ</span></a></li>
            <li class='has-sub'><a href='#'><span>ПАНЕЛИ WEINTEK</span></a>
                <ul>
                    <li class='has-sub'><a href='/weintek/series6000i.php'><span>Серия MT6000i</span></a>
                        <ul>
                            <li><a href='#'><span>MT6050i</span></a></li>
                            <li><a href='#'><span>MT6070iH</span></a></li>
                            <li class='last'><a href='#'><span>MT6100i</span></a></li>
                        </ul>
                    </li>
                    <li class='has-sub'><a href='/weintek/series8000i.php'><span>Серия MT8000i</span></a>
                        <ul>
                            <li><a href='#'><span>MT8050i</span></a></li>
                            <li><a href='#'><span>MT8070iH</span></a></li>
                            <li class='last'><a href='#'><span>MT8100i</span></a></li>

                        </ul>
                    </li>
                    <li class='has-sub'><a href='#'><span>Серия eMT3000</span></a>
                        <ul>
                            <li><a href='#'><span>eMT3070A</span></a></li>
                            <li><a href='#'><span>eMT3070B</span></a></li>
                            <li><a href='#'><span>eMT3105P</span></a></li>
                            <li><a href='#'><span>eMT3120A</span></a></li>
                            <li><a href='#'><span>eMT3150A</span></a></li>
                        </ul>
                    </li>

                    <li class='has-sub'><a href='#'><span>Серия iE</span></a>
                        <ul>
                            <li><a href='#'><span>MT8070iE</span></a></li>
                            <li><a href='#'><span>MT8100iE</span></a></li>
                            <li><a href='#'><span>MT8101iE</span></a></li>

                        </ul>
                    </li>

                    <li class='has-sub'><a href='#'><span>Серия OPEN HMI</span></a>
                        <ul>
                            <li><a href='#'><span>MT607i</span></a></li>
                            <li><a href='#'><span>MT610i</span></a></li>
                            <li><a href='#'><span>MT610XH</span></a></li>
                            <li><a href='#'><span>MT612XH</span></a></li>
                            <li><a href='#'><span>MT615XH</span></a></li>

                        </ul>
                    </li>

                </ul>
            </li>
            <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ IFC</span></a></li>
            <ul>

            </ul>
            <li class='has-sub'><a href='#'><span>КОМПЬЮТЕРЫ APLEX</span></a></li>
            <ul>

            </ul>

            <li class='has-sub'><a href='#'><span>ПАНЕЛИ SAMKOON</span></a></li>
            <li class='has-sub'><a href='#'><span>КОНТРОЛЛЕРЫ</span></a></li>


        </ul>
    </div>


    <?
}


function top_menu($new = 0)
{
    ?>

    <? include $_SERVER["DOCUMENT_ROOT"] . "/include/header_contacts.php"; ?>
    <?
    $top_menu = "<div class=menu_top_cont>"
        . ((0) ? "<div class=menu_top>
<div class='top-menu-block'><a href='/about.php'>О КОМПАНИИ&nbsp;</a>
<ul>
<a href='/news.php'><li>Новости</li></a>
<a href='/articles/'><li>Статьи</li></a>
</ul>
</div>|
<a href='/advanced_search.php' title='Подбор оборудования по параметрам'> ПОДБОР </a> |
<a href='/comparison.php'> СРАВНЕНИЕ </a>|
<a href='//www.rusavtomatika.com/forum/'> ФОРУМ </a> |
<a href='/support.php'> ТЕХ.ПОДДЕРЖКА </a> |
<a href='/download.php'>СКАЧАТЬ</a> |
<a href='/contacts.php'> КОНТАКТЫ </a>
</div>
" : " ") .
        "<!--<a href='/antikrizisnoe-predlozhenie.php' style='color: rgb(228, 14, 19);'><div id='rof' style='display:none;position: absolute;width: 300px;margin-left: 283px;font-size: 15px;margin-top: 19px;overflow: hidden;color: rgb(228, 14, 19);
  font-family: \"MS Sans Serif\";  font-weight: bold;'><div class='flying' style='position:relative;right:0px;float:left;white-space: nowrap;'>Акция !  Weintek по сниженным ценам</div></div></a>-->";

    $top_menu .= "
<script>

function run(ud) {
$('.flying').eq(ud).css('right','-300px');
  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 15000,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run(ud);
}, 22500);
}






$(document).ready(function(){
$('#rof').show();
var ud = 0;
$('.flying').clone().css({'right':'-300px','margin-top':'-18px'}).appendTo('#rof');
setTimeout(function() {

  $('.flying').eq(ud).animate({
    right: '300px'
  }, {
    duration: 7500,
    specialEasing: {
      right: 'linear'
    }
  });

setTimeout(function() {

run('0');
}, 15020);
}, 600);

setTimeout(function() {
run('1');
}, 4350);

});

</script>";

    $top_menu .= "</div>
";

    echo $top_menu;
}
