<?

include $_SERVER["DOCUMENT_ROOT"]."/config.php";

if(EX != "_"){

    include $_SERVER["DOCUMENT_ROOT"]."/samkoon_/index.php";

    exit();

}



session_start();

define("bullshit", 1);

include "../sc/dbcon.php";

include ("../sc/lib_new.php");



$section_setup = '.section.php';

if (file_exists($section_setup)) {

    include $section_setup;

}



//database_connect();

global $mysqli_db;

mysqli_query($mysqli_db,"SET NAMES 'cp1251'");

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

?>

<article>

    <div class="block_content">

<br><center><h1>Панели оператора Samkoon со склада в России</h1></center><br>

<br><center><div class=series_descr>Компания Samkoon (Китай) производит <strong>панели оператора</strong> более 10 лет. Ее продукция отличается

        невысокой ценой и хорошим качеством.   </div></center>





<?

$arrSerieses = array("EA", "SK", "OP", "AK");

foreach ($arrSerieses as $series) {

    samkoon_print_products_list($series);

}



function samkoon_print_products_list($seriesName) {

    global $mysqli_db;

    $sql_query = "SELECT `model` FROM `products_all` WHERE `brand` = 'Samkoon' and `series` = '{$seriesName}' and `discontinued` != '1' order by `diagonal` ";

    $result = mysqli_query($mysqli_db,$sql_query) or die("ошибка запроса " . $sql_query);

    while ($row = mysqli_fetch_array($result)) {

        $arrModels[] = $row["model"];

    }

    echo '<br><table width=100%><tr><td colspan="2"><h2 id="series-' . $seriesName . '">Серия ' . $seriesName . '</h2></td></tr>

';

    $counter = 0;

    foreach ($arrModels as $current_model) {

        $counter++;

        if ($counter == 1) {

            echo "<tr class='item-collector' >";

        }

        echo "<td  align=center valign=top>";

        echo show_panel1($current_model);

        echo "</td>";

        if ($counter == 2) {

            echo "</tr>";

            $counter = 0;

        }

    }

    echo '</table>';

}

?>

    </div>

</article>



<? /* ?>

  <table style="width:90%;margin: 10px auto 10px;" >



  <tr><td colspan="2"><h2 id="series-ea">Серия EA</h2></td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("EA-035A-T"); ?>

  </td><td align=center valign=top><? echo show_panel1("EA-043A"); ?></td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("EA-070B"); ?>

  </td><td align=center valign=top> </td></tr>

  <tr><td colspan="2"><h2 id="series-sk">Серия SK</h2></td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("SK-035AE"); ?>

  </td><td align=center valign=top>

  <? echo show_panel1("SK-043AE"); ?>

  </td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("SK-043AEB"); ?>

  </td><td align=center valign=top>

  <? echo show_panel1("SK-043ASB"); ?>

  </td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("SK-043HE"); ?>

  </td><td align=center valign=top>

  <? echo show_panel1("SK-050AE"); ?>

  </td></tr>

  <tr height=300><td width=50% align=center valign=top>

  <? echo show_panel1("SK-050AS"); ?>

  </td>

  <td align=center valign=top>

  <? echo show_panel1("SK-070BE"); ?>

  </td>

  </tr>

  <tr height=300>

  <td width=50% align=center valign=top>

  <? echo show_panel1("SK-070HE"); ?>

  </td>

  <td align=center valign=top>

  <? echo show_panel1("SK-070BS"); ?>

  </td>

  </tr>

  <tr height=300>

  <td width=50% align=center valign=top>

  <? echo show_panel1("SK-102AE"); ?>

  </td>

  <td align=center valign=top>

  <? echo show_panel1("SK-102AS"); ?>

  </td>

  </tr>

  <tr height=300>

  <td width=50% align=center valign=top>

  <? echo show_panel1("SK-102HS"); ?>

  </td>

  <td align=center valign=top>



  </td>

  </tr>



  <tr><td colspan="2"><h2 id="series-sk">Серия OP</h2></td></tr>

  <tr height=300>

  <td width=50% align=center valign=top>

  <? echo show_panel1("OP-835"); ?>

  </td>

  <td align=center valign=top></td>

  </tr>

  <tr><td colspan="2"><h2 id="series-sk">Серия AK</h2></td></tr>

  <tr height=300>

  <td align=center valign=top>

  <? echo show_panel1("AK-035A-T"); ?>

  </td>

  <td width=50% align=center valign=top>

  <? echo show_panel1("AK-070BS"); ?>

  </td>

  </tr>







  </table>

  <? */ ?>

<?

//------------------end content---------------

temp3();

