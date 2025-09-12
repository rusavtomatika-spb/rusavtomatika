<?

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    define("bullshit", 1);
    include "../sc/dbcon.php";
    include ("../sc/lib_new.php");



    global $mysqli_db ;
    mysqli_query($mysqli_db,"SET NAMES 'cp1251'");



    $dobavlenie = "";
//---------------content ---------------------

    if (isset($_POST["m0"]))
        $m0 = mysqli_real_escape_string($mysqli_db,htmlspecialchars(trim($_POST["m0"])));
    else
        $m0 = "";
    if (isset($_POST["m1"]))
        $m1 = mysqli_real_escape_string($mysqli_db,htmlspecialchars(trim($_POST["m1"])));
    else
        $m1 = "";
    if (isset($_POST["m2"]))
        $m2 = mysqli_real_escape_string($mysqli_db,htmlspecialchars(trim($_POST["m2"])));
    else
        $m2 = "";
    if (isset($_POST["m3"]))
        $m3 = mysqli_real_escape_string($mysqli_db,htmlspecialchars(trim($_POST["m3"])));
    else
        $m3 = "";
    if (isset($_POST["mode"]))
        $mode = mysqli_real_escape_string($mysqli_db,htmlspecialchars(trim($_POST["mode"])));
    else
        $mode = "";


    /* valovenko
      $arrModels = array();
      $arrModels2 = array();
      if ($m0 != "")
      $arrModels[] = $m0;
      if ($m1 != "")
      $arrModels[] = $m1;
      if ($m2 != "")
      $arrModels[] = $m2;
      if ($m3 != "")
      $arrModels[] = $m3;
      //$f = fopen("log2.txt", "w+");
      //ob_start();
      $isHaiwell = false;
      foreach ($arrModels as $item) {
      $pos = strpos($item, "Haiwell ");
      if ($pos !== false) {
      $isHaiwell = true;
      $item = str_replace("Haiwell ", "", $item);
      }
      $arr = array("first" => "PHP",
      "second" => "MySQL",
      "third" => "Apache");
      $newItem["model"] = $item;
      $newItem["type"] = "Haiwell";
      $arrModels2[] = $newItem;
      }
      echo "<pre>";
      var_dump($arrModels2);
      echo "</pre>";
      //$output = ob_get_clean();
      //fputs($f, $output);
     */

    /*
      if ($m3!='') {
      $dobavlenie = "";
      } else {
      $dobavlenie = "<div style='width:300px;float: left;'><div id='dobavlenie' style='float: left;'><div id='plusik' onclick='do_plusik()'>Добавить к сравнению</div></div></div>";
      };
     */
//if($mode=="") die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
    if ($mode == "")
        die("<div class='error1' style='height:300px;'>неправильный запрос1</div>");
    if ($m0 != "") {


        $sql = "SELECT * FROM products_all WHERE `model` = '$m0' ";
        $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));

        $row = mysqli_fetch_assoc($res);
        $k0["name"] = $row["model"];
        if(isset($row['parent']) and $row['parent'] != '') $k0["name"] = $row["parent"];
        $k0["type"] = $row["type"];
        $k0["brand"] = $row["brand"];

        if ($r = mysqli_num_rows($res) == 0)
//die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
            die("<div class='error2'  style='height:300px;'>неправильный запрос2</div>");


    }

    if ($m1 != "") {
        $sql = "SELECT * FROM products_all WHERE `model` = '$m1'   ";
        $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
        $row = mysqli_fetch_assoc($res);
        $k1["name"] = $row["model"];
        if(isset($row['parent']) and $row['parent'] != '') $k1["name"] = $row["parent"];
        $k1["type"] = $row["type"];
        $k1["brand"] = $row["brand"];
        if ($r = mysqli_num_rows($res) == 0)
//die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
            die("<div class='error3' style='height:300px;'>неправильный запрос3</div>");
    }

    if ($m2 != "") {
        $sql = "SELECT * FROM products_all WHERE `model` = '$m2'  ";
        $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
        $row = mysqli_fetch_assoc($res);

        $k2["name"] = $row["model"];
        if(isset($row['parent']) and $row['parent'] != '') $k2["name"] = $row["parent"];
        $k2["type"] = $row["type"];
        $k2["brand"] = $row["brand"];
        if ($r = mysqli_num_rows($res) == 0)
//die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
            die("<div class='error4' style='height:300px;'>неправильный запрос4</div>");
    }

    if ($m3 != "") {
        $sql = "SELECT * FROM products_all WHERE `model` = '$m3'  ";
        $res = mysqli_query($mysqli_db,$sql) or die(mysqli_error($mysqli_db));
        $row = mysqli_fetch_assoc($res);
        $k3["name"] = $row["model"];
        if(isset($row['parent']) and $row['parent'] != '') $k3["name"] = $row["parent"];
        $k3["type"] = $row["type"];
        $k3["brand"] = $row["brand"];
        if ($r = mysqli_num_rows($res) == 0)
//die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
            die("<div class='error5' style='height:300px;'>неправильный запрос5</div>");
    }


    if ($m2 == "" && $m3 != "" || $m0 == "" && $m1 != "" || $m1 == "" && $m2 != "")
//die(iconv( "CP1251","UTF-8","<div style='height:300px;'>неправильный запрос</div>"));
        die("<div class='error6' style='height:300px;'>неправильный запрос6</div>");

    if ($m0 == "" && $m1 == "") {
        $out = "<center>
<div style='height:400px; width:80%; text-align:left;'><br><br>
<h3> Для отображения таблицы сравнения продукции добавьте в Ваш список сравнения хотя бы 2 продукта.<br>
Это можно сделать с помощью формы (сверху), а также нажав <span class=zakazbut>В сравнение</span> в описании каждого продукта.</h3><div style='margin-left:357px;'>{$dobavlenie}
</div></div></center>";
//echo iconv( "CP1251","UTF-8", $out);
        echo $out;
        die();
    } else
    if ($m0 != "" && $m1 == "") {
        $out = "<center>
<div style='height:400px; width:80%; text-align:left;'><br><br>
<h3> <span style='float: left;' >В списке сравнения: «{$m0}» </span><span class='removeb' style='float: left; cursor: pointer; margin-left: 10px; margin-top: 3px;' onclick='del_from_compare_in_big(&quot;{$m0}&quot;);' title='Удалить из сравнения'>X</span> <br><br>Для отображения таблицы сравнения продукции добавьте в Ваш список сравнения второй товар.<br>
Это можно сделать с помощью формы (сверху), а также нажав кнопку  <span class=zakazbut>В сравнение</span> в описании каждого продукта.</h3><div style='margin-left:357px;'>{$dobavlenie}
</div></div></center>";
//echo iconv( "CP1251","UTF-8", $out);
        echo $out;
        die();
    }


    $out = "<center><br><h1>Сравнение моделей ";

    $out .= $m0;
    if ($m1 != "")
        $out .= ", $m1";
    if ($m2 != "")
        $out .= ", $m2";
    if ($m3 != "")
        $out .= ", $m3";

    $out .= "</h1><br><br><br>";

    $p0 = "";
    $p1 = "";
    $p2 = "";
    $comp_mods = 0;
    if ($m0 != "") {
        $p0 = comp_pan($m0, 1);
        $comp_mods = 1;
    }
    if ($m1 != "") {
        $p1 = comp_pan($m1, 1);
        $comp_mods = 2;
    }
    if ($m2 != "") {
        $p2 = comp_pan($m2, 1);
        $comp_mods = 3;
    }
    if ($m3 != "") {
        $p3 = comp_pan($m3, 1);
        $comp_mods = 4;
    }



    $pn = comp_pan($m0, 2);

//"<div style='width:95%;'> ".
//<tr><td width=225 valign=top> $p0 </td><td width=225 valign=top> $p1</td>  <td width=225 valign=top> $p2</td>  <td valign=top> $p3</td>  </tr>
    $pw = 190;
    $tdnw = 200; //width of name
    $tdw = 220;

    $divw = $tdw * $comp_mods + $tdnw;
    $divw .= "px";
    $tit = "Удалить из сравнения";

    if ($mode == 1) {
        $cross0 = "";
        $cross1 = "";
        $cross2 = "";
        $cross3 = "";
    }
    if ($mode == 2) {
        $cross0 = "<span class='removeb' style='float: right; cursor: pointer;' onclick='del_from_compare_in_big(\"$m0\");' title='$tit'>X</span>";
        $cross1 = "<span class='removeb' style='float: right; cursor: pointer;' onclick='del_from_compare_in_big(\"$m1\");' title='$tit'>X</span>";
        $cross2 = "<span class='removeb' style='float: right; cursor: pointer;' onclick='del_from_compare_in_big(\"$m2\");' title='$tit'>X</span>";
        $cross3 = "<span class='removeb' style='float: right; cursor: pointer;' onclick='del_from_compare_in_big(\"$m3\");' title='$tit'>X</span>";
    }

/*    $imgRemoteDir = "/images/" . mb_strtolower($k0["brand"]) . "/" . mb_strtolower($k0["type"]) . "/" . $k0["name"] . "/";

    if (!empty($new_path_picture)) {
      $uk0 = $imgRemoteDir . "md/" . $k0["name"] . "_1.png";
    }
    $imgRemoteDir = "/images/" . mb_strtolower($k1["brand"]) . "/" . mb_strtolower($k1["type"]) . "/" . $k1["name"] . "/";


    if (!empty($new_path_picture)) {
      $uk1 = $imgRemoteDir . "md/" . $k1["name"] . "_1.png";
    }
    $imgRemoteDir = "/images/" . mb_strtolower($k2["brand"]) . "/" . mb_strtolower($k2["type"]) . "/" . $k2["name"] . "/";


    if (!empty($new_path_picture)) {
      $uk2 = $imgRemoteDir . "md/" . $k2["name"] . "_1.png";
    }
    $imgRemoteDir = "/images/" . mb_strtolower($k3["brand"]) . "/" . mb_strtolower($k3["type"]) . "/" . $k3["name"] . "/";


    if (!empty($new_path_picture)) {
      $uk3 = $imgRemoteDir . "md/" . $k3["name"] . "_1.png";
    }*/
    if(isset($k0) and is_array($k0)){
        $uk0 = "/images/" . mb_strtolower($k0["brand"]) . "/" . mb_strtolower($k0["type"]) . "/" . $k0["name"] . "/130/" . $k0["name"] . "_1.webp";
    }
    if(isset($k1) and is_array($k1)){
        $uk1 = "/images/" . mb_strtolower($k1["brand"]) . "/" . mb_strtolower($k1["type"]) . "/" . $k1["name"] . "/130/" . $k1["name"] . "_1.webp";
    }
    if(isset($k2) and is_array($k2)){
        $uk2 = "/images/" . mb_strtolower($k2["brand"]) . "/" . mb_strtolower($k2["type"]) . "/" . $k2["name"] . "/130/" . $k2["name"] . "_1.webp";
    }
    if(isset($k3) and is_array($k3)){
        $uk3 = "/images/" . mb_strtolower($k3["brand"]) . "/" . mb_strtolower($k3["type"]) . "/" . $k3["name"] . "/130/" . $k3["name"] . "_1.webp";
    }



    $table_start = "<table  id='comparet' cellpadding=0 cellspacing=0 border=0 >";
    $out .= "<div style='width:$divw;'>" . $table_start;
    $out .= "<tr class='no'><td> &nbsp </td>
           <td> $cross0
		   <img src=" . ($uk0 ? $uk0 : get_big_pic($p0[0])) . " width=$pw onclick='window.location=\"" . get_link_to_model($p0[0]) . "\"' style='cursor:pointer;'> </td>

           <td> $cross1
		   <img src=" . ($uk1 ? $uk1 : get_big_pic($p1[0])) . " width=$pw onclick='window.location=\"" . get_link_to_model($p1[0]) . "\"' style='cursor:pointer;'></td>";
    if ($m2 != "")
        $out .= "<td> $cross2
          <img src=" . ($uk2 ? $uk2 : get_big_pic($p2[0])) . " width=$pw onclick='window.location=\"" . get_link_to_model($p2[0]) . "\"' style='cursor:pointer;'></td>";

    if ($m3 != "")
        $out .= "<td> $cross3
       <img src=" . ($uk3 ? $uk3 : get_big_pic($p3[0])) . " width=$pw onclick='window.location=\"" . get_link_to_model($p3[0]) . "\"' style='cursor:pointer;'></td>";

    $out .= "</tr>";

//$out.="<tr><td>pr</td>".show_model_price($p0[0])."</td>
    //                  <td>".show_model_price($p1[0])."</td> <td></td> <td></td> </tr>";

    $compok = "<img src='/images/tick.png' width=15 align=right>";

    for ($i = 0; $i < sizeof($p0); $i++) {
        
        switch ($comp_mods) {
            case 2:
                if ($p0[$i] == $p1[$i] && $p0[$i] != "" && $p0[$i] != '0')
                    $coim = $compok;
                else
                    $coim = "";
                break;
            case 3:
                if ($p0[$i] == $p1[$i] && $p1[$i] == $p2[$i] && $p0[$i] != "" && $p0[$i] != '0')
                    $coim = $compok;
                else
                    $coim = "";
                break;
            case 4:
                if ($p0[$i] == $p1[$i] && $p1[$i] == $p2[$i] && $p2[$i] == $p3[$i] && $p0[$i] != "" && $p0[$i] != '0')
                    $coim = $compok;
                else
                    $coim = "";
                break;
        }
//".(($p0[$i]=="" || $p0[$i]==0)?"-":"$p0[$i]")."
        $colmns = $comp_mods + 1;

        if ($pn[$i][0] == "&")
//$out.="</table><br><br><span class=hpar>$pn[$i] </span><br>$table_start";
            $out .= "<tr class='no'><td  colspan='{$colmns}'><br><br><span class=hpar>$pn[$i] </span><br></td></tr>";
        else {

            if ($p0[$i] == "" || $p0[$i] == "0")
                $op0 = "-";
            else
                $op0 = $p0[$i];
            if ($p1[$i] == "" || $p1[$i] == "0")
                $op1 = "-";
            else
                $op1 = $p1[$i];
            if (!isset($p2[$i]) || $p2[$i] == "" || $p2[$i] == "0")
                $op2 = "-";
            else
                $op2 = $p2[$i];
            if (!isset($p3[$i]) || $p3[$i] == "" || $p3[$i] == "0")
                $op3 = "-";
            else
                $op3 = $p3[$i];

            if ($i % 2 == 0)
                $bg = "bgcolor=white";
            else
                $bg = "bgcolor=#efefef";
            $out .= "<tr $bg><td width=$tdnw class='comp_tab_n'> $pn[$i]  $coim</td>
  <td width='$tdw'><div class='comp_tab'> $op0 </div></td>
         <td width='$tdw'><div class='comp_tab'> $op1 </div></td>";

            if ($m2 != "")
                $out .= "<td width=$tdw><div class=comp_tab> $op2</div> </td>";


            if ($m3 != "")
                $out .= "<td width=$tdw><div class=comp_tab> $op3</div></td>";

            $out .= "</tr>";
        }
    }





    $out .= "</table></div></center><br><br>";

    $link = "?m0=$m0&m1=$m1";
    if ($m2 != "")
        $link .= "&m2=$m2";
    if ($m3 != "")
        $link .= "&m3=$m3";

    $out .= "<br>";
    if ($mode == 2)
        $out .= "&nbsp &nbsp Ссылка на эту страницу: <a href=https://" . $_SERVER['SERVER_NAME'] . "/comparison.php$link>
https://" . $_SERVER['SERVER_NAME'] . "/comparison.php$link
</a>";

    $out .= "<br><br>";

//echo iconv("UTF-8", "CP1251", $out);
//echo iconv( "CP1251","UTF-8", $out);
    echo $out;
} else
    echo "I don't think so";
?>
