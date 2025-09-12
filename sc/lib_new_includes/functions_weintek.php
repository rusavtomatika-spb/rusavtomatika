<?php
function show_series_open_hmi_emt() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_eMT600.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панельные компьютеры Weintek серия Open HMI eMT600</$h>$a2

<br><center><div class=series_descr>Панельные компьютеры Weintek серии eMT600 появились в 2012 году. Они являются продолжением серии MT600. На панельных компьютерах Weintek серии eMT600 установлена операционная система Windows CE 6.0</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT607A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT610P");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT612A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT615A");   // end row
    echo "</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_open_hmi() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT600.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name id='mt-600-windows-ce'>Панельные компьютеры Weintek серия Open HMI MT600</$h>$a2

<br><center><div class=series_descr>Сенсорные панельные компьютеры  Weintek серии MT600 работают под управлением Windows CE 5.0 (предустановлена). При создании проектов разработчику предоставляются все возможности операционной системы.
   </div></center><br>

   <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT607i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT610i");   // end row
    echo "</td></tr>
</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_xe() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000XE.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия MT8000XE</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора серии MT8000XE появились в 2013 году. Отличительными особенностями этой серии операторских панелей Weintek являются быстрый процессор Cortex A8, с тактовой частотой 1 ГГц, графический сопроцессор, ускоряющий до 15 раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, а также влагозащитное покрытие платы. С 2016 года во все панели серии XE добавлена поддержка протокола <a href='/mqtt/'>MQTT</a>.
  </div></center><br>

  <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8090XE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8092XE") .
    "</td></tr>


<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8150XE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8121XE") .
    "</td></tr>


</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_mTV() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/mTV-100.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>


$a1<$h class=series_name>Интерфейс Machine-TV Weintek серия mTV</$h>$a2

<br><center><div class=series_descr>Интерфейс Machine-TV серии mTV появился в 2013 году. Компактный mTV-интерфейс дает возможность использовать в качестве дисплея телевизоры различных размеров или мониторы с HDMI интерфейсом, расширяя возможности традиционной архитектуры HMI.
  </div></center><br>

<center><table width=90%>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("mTV-100");
    echo "</td><td align=center valign=top>&nbsp;</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}


function show_series_cloud_hmi() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/CloudHMI.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Cерия Cloud HMI — облачный интерфейс Weintek</$h>$a2

<br><center><div class=series_descr>Серия Cloud HMI — новинка 2014 года и результат 18-летней работы компании Weintek в области автоматизации управления производственными процессами. Инновационные технологии и оригинальные идеи Weintek выводят функциональность, гибкость и мобильность управления производством на качественно новый уровень. <br><br>С 2016 года все интерфейсы серии cMT поддерживают протокол <a href='/mqtt/'>MQTT</a>.
   </div></center><br>

   <center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT3071");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT3072"); // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top id=pc>";
    echo show_panel1("cMT-iV5");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT-iPC10");  // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top id=pc>";
    echo show_panel1("cMT3090");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT3103"); // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top id=pc>";
    echo show_panel1("cMT-iPC15");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT3151");    // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT-HDMI");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT-SVR-100");   // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT-G01");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT-G02");   // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("cMT-G03");
    echo "</td><td align=center valign=top>";
    echo show_panel1("cMT-G04");   // end row
    echo "</td></tr>
</table>
</center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_ie() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000iE.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия MT8000iE</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора Weintek серии MT8000iE появились в 2013 году. Их отличительными особенностями являются быстрый процессор Cortex A8, графический сопроцессор, ускоряющий до десяти раз загрузку страниц, насыщенных графикой, новый дизайн (более светлые цвета и компактный корпус), гальваническая изоляция всех портов, влагозащитное покрытие платы. Операторские панели этой серии не имеют порта USB slave (за исключением MT6070iE), поэтому загрузка проекта с ПК возможна только через Ethernet. У нас вы можете купить панели оператора серии MT8000iE, которые мы поставляем напрямую от производителя.

  </div></center><br>

  <center><table width=90%>



<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8050iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT6070iE") . // end row
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT6071iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8070iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8071iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8073iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8070iER") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8100iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8101iE") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8102iE") .
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT8103iE") .
    "</td><td align=center valign=top>&nbsp;</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_ip() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000iP.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>

$a1<$h class=series_name>Панели оператора Weintek серия MT8000iP</$h>$a2

<br><center><div class=series_descr>Сенсорные панели оператора Weintek серии MT8000iP 2016 года.  Их отличительными особенностями являются быстрый процессор Cortex A8, темный компактный корпус. У нас вы можете купить панели оператора серии MT8000iP, которые мы поставляем напрямую от производителя.

  </div></center><br>

  <center><table class='weintek_list_items' width=90%>



<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT6051iP") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8051iP") . // end row
    "</td></tr>
<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT6071iP") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8071iP") . // end row
    "</td></tr>

<tr height=300><td width=50% align=center valign=top>" .
    show_panel1("MT6103iP") .
    "</td><td align=center valign=top>" .
    show_panel1("MT8102iP") .
    "</td></tr>

</table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_emt() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_eMT3000.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek серия eMT3000</$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии eMT3000 появились в 2012 году. Отличительными особенностями этой серии по сравнению с сериями MT6000i и eMT8000i является более быстрый процессор, увеличенный объем ОЗУ и флэш-памяти, алюминиевый корпус, интерфейс CAN. Операторская панель Weintek eMT3070A имеет расширенный диапазон рабочих температур (от -20&#8451;). Также панели оператора этой серии программируется более новым ПО EasyBuilder Pro.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3070A");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT3070B");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3105P");
    echo "</td><td align=center valign=top>";
    echo show_panel1("eMT3120A");   // end row
    echo "</td></tr>

<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("eMT3150A");
    echo "</td> <td> </td>
</tr></table></center>";


    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_8000() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT8000i.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek серия MT8000i</$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии MT8000i появились в 2009 году и быстро приобрели широкую популярность благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT8000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, переняв успешный опыт Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8050i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8100i");   // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8070iH");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8104iH");  // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8104XH");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT8150X");  // end row
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT8121X");
    echo "</td> <td> </td>
</tr></table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}

function show_series_6000() {
    $h = h();
    if ($h == 'h2') {
        $a1 = "<a href='/weintek/series_MT6000i.php'>";
        $a2 = '</a>';
    } else {
        $a1 = '';
        $a2 = '';
    };
    echo "<br><br>";

    echo "$a1<$h class=series_name>Панели оператора Weintek cерия MT6000i </$h>$a2

<br><center><div class=series_descr>Панели оператора Weintek серии MT6000i появились в 2009 году и сразу же стали очень популярны во всем мире благодаря отличному соотношению цена/качество, а также удобству загрузки проекта с ПК по USB кабелю. Отличительной особенностью операторских панелей Weintek серии MT6000i был впервые в мире примененный на панелях оператора широкоугольный дисплей. В настоящее время, следуя успешному опыту Weintek, большинство производителей, у которых можно купить панели оператора, также предлагают широкоугольные дисплеи.</div></center><br>

<center><table width=90%>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT6050i");
    echo "</td><td align=center valign=top>";
    echo show_panel1("MT6100i");
    echo "</td></tr>
<tr height=300><td width=50% align=center valign=top>";
    echo show_panel1("MT6070iH");
    echo "</td> <td> </td>
</tr></table></center>";
    if (!preg_match('/index.php/i', $_SERVER['PHP_SELF'])) {
        echo '<br /><br />';
    };
}
