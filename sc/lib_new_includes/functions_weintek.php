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

$a1<$h class=series_name>��������� ���������� Weintek ����� Open HMI eMT600</$h>$a2

<br><center><div class=series_descr>��������� ���������� Weintek ����� eMT600 ��������� � 2012 ����. ��� �������� ������������ ����� MT600. �� ��������� ����������� Weintek ����� eMT600 ����������� ������������ ������� Windows CE 6.0</div></center><br>

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

$a1<$h class=series_name id='mt-600-windows-ce'>��������� ���������� Weintek ����� Open HMI MT600</$h>$a2

<br><center><div class=series_descr>��������� ��������� ����������  Weintek ����� MT600 �������� ��� ����������� Windows CE 5.0 (���������������). ��� �������� �������� ������������ ��������������� ��� ����������� ������������ �������.
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

$a1<$h class=series_name>������ ��������� Weintek ����� MT8000XE</$h>$a2

<br><center><div class=series_descr>��������� ������ ��������� ����� MT8000XE ��������� � 2013 ����. �������������� ������������� ���� ����� ������������ ������� Weintek �������� ������� ��������� Cortex A8, � �������� �������� 1 ���, ����������� �����������, ���������� �� 15 ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, � ����� ������������� �������� �����. � 2016 ���� �� ��� ������ ����� XE ��������� ��������� ��������� <a href='/mqtt/'>MQTT</a>.
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


$a1<$h class=series_name>��������� Machine-TV Weintek ����� mTV</$h>$a2

<br><center><div class=series_descr>��������� Machine-TV ����� mTV �������� � 2013 ����. ���������� mTV-��������� ���� ����������� ������������ � �������� ������� ���������� ��������� �������� ��� �������� � HDMI �����������, �������� ����������� ������������ ����������� HMI.
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

$a1<$h class=series_name>C���� Cloud HMI � �������� ��������� Weintek</$h>$a2

<br><center><div class=series_descr>����� Cloud HMI � ������� 2014 ���� � ��������� 18-������ ������ �������� Weintek � ������� ������������� ���������� ����������������� ����������. ������������� ���������� � ������������ ���� Weintek ������� ����������������, �������� � ����������� ���������� ������������� �� ����������� ����� �������. <br><br>� 2016 ���� ��� ���������� ����� cMT ������������ �������� <a href='/mqtt/'>MQTT</a>.
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

$a1<$h class=series_name>������ ��������� Weintek ����� MT8000iE</$h>$a2

<br><center><div class=series_descr>��������� ������ ��������� Weintek ����� MT8000iE ��������� � 2013 ����. �� �������������� ������������� �������� ������� ��������� Cortex A8, ����������� �����������, ���������� �� ������ ��� �������� �������, ���������� ��������, ����� ������ (����� ������� ����� � ���������� ������), �������������� �������� ���� ������, ������������� �������� �����. ������������ ������ ���� ����� �� ����� ����� USB slave (�� ����������� MT6070iE), ������� �������� ������� � �� �������� ������ ����� Ethernet. � ��� �� ������ ������ ������ ��������� ����� MT8000iE, ������� �� ���������� �������� �� �������������.

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

$a1<$h class=series_name>������ ��������� Weintek ����� MT8000iP</$h>$a2

<br><center><div class=series_descr>��������� ������ ��������� Weintek ����� MT8000iP 2016 ����.  �� �������������� ������������� �������� ������� ��������� Cortex A8, ������ ���������� ������. � ��� �� ������ ������ ������ ��������� ����� MT8000iP, ������� �� ���������� �������� �� �������������.

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

    echo "$a1<$h class=series_name>������ ��������� Weintek ����� eMT3000</$h>$a2

<br><center><div class=series_descr>������ ��������� Weintek ����� eMT3000 ��������� � 2012 ����. �������������� ������������� ���� ����� �� ��������� � ������� MT6000i � eMT8000i �������� ����� ������� ���������, ����������� ����� ��� � ����-������, ����������� ������, ��������� CAN. ������������ ������ Weintek eMT3070A ����� ����������� �������� ������� ���������� (�� -20&#8451;). ����� ������ ��������� ���� ����� ��������������� ����� ����� �� EasyBuilder Pro.</div></center><br>

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

    echo "$a1<$h class=series_name>������ ��������� Weintek ����� MT8000i</$h>$a2

<br><center><div class=series_descr>������ ��������� Weintek ����� MT8000i ��������� � 2009 ���� � ������ ��������� ������� ������������ ��������� ��������� ����������� ����/��������, � ����� �������� �������� ������� � �� �� USB ������. ������������� ������������ ������������ ������� Weintek ����� MT8000i ��� ������� � ���� ����������� �� ������� ��������� �������������� �������. � ��������� �����, ������� �������� ���� Weintek, ����������� ��������������, � ������� ����� ������ ������ ���������, ����� ���������� �������������� �������.</div></center><br>

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

    echo "$a1<$h class=series_name>������ ��������� Weintek c���� MT6000i </$h>$a2

<br><center><div class=series_descr>������ ��������� Weintek ����� MT6000i ��������� � 2009 ���� � ����� �� ����� ����� ��������� �� ���� ���� ��������� ��������� ����������� ����/��������, � ����� �������� �������� ������� � �� �� USB ������. ������������� ������������ ������������ ������� Weintek ����� MT6000i ��� ������� � ���� ����������� �� ������� ��������� �������������� �������. � ��������� �����, ������ ��������� ����� Weintek, ����������� ��������������, � ������� ����� ������ ������ ���������, ����� ���������� �������������� �������.</div></center><br>

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
