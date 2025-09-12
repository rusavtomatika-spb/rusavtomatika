<?php

function get_product_field_descriptions($product_type = '')
{

    global $mysqli_db;
    $out = array();
    $where_product_type = '';
    if($product_type != ''){
        $where_product_type = " and FIND_IN_SET('$product_type',product_types)>0 ";
    }
    $query = "SELECT f.field_type, g.name as group_name, f.code as field_code,f.name as field_name, f.units as field_units, f.field_group as group_code, product_types FROM `catalog_field_groups` g, `catalog_field_descriptions` f 
where g.code = f.field_group and do_not_show_in_detail != '1' $where_product_type	 order by g.position, f.position";



    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[$row["group_code"]]['name'] = $row['group_name'];
        $out[$row["group_code"]]['items'][] = array("field_name" => $row['field_name'], "field_code" => $row['field_code'], "field_units" => $row['field_units'],"product_types" => $row['product_types'],"field_type" => $row['field_type']);
    }

    return $out;
}

function show_com_connector_temp($panel)
{  //main func for show all panels connectors
    $file = $_SERVER['DOCUMENT_ROOT'] . "/panelnie-computery/aplex/com_port/$panel.txt";
    if (!file_exists($file)) {
        echo "no file";
        return;
    }
    $f = file_get_contents($file);
    $conns = explode("#", $f);  // get connectors;
//echo "connectors=$conns[0] <br>";
    $arr = [];
    for ($i = 0; $i < sizeof($conns); $i++) {
        $con_d = explode("---", $conns[$i]);
        $conn_d1 = explode("--", $con_d[0]);
        if ($conn_d1[1] == "M") {
            $imcon = "/images/com_m.png";
            $typcon = "DB-9 M ( Папа )";
        }
        if ($conn_d1[1] == "F") {
            $imcon = "/images/com_f.png";
            $typcon = "DB-9 F ( Мама )";
        }
        if ($conn_d1[1] == "RJ25F") {
            $imcon = "/images/rj-25.png";
            $typcon = "RJ25-6 F ( Мама )";
        }
        $items = explode("\n", $con_d[1]);

        if (isset($items) and count($items) > 0) {
            $counter1 = 0;
            foreach ($items as $item) {
                $item_parts = explode("=", $item);
                if (isset($item_parts[0]) and strlen($item_parts[0]) > 2) {
                    echo "<br>port_name: " . $item_parts[0] . "<br>";
                    $arr[$i][$counter1]["name"] = $item_parts[0];
                    if (isset($item_parts[1]) and $item_parts[1] != '') {
                        $item_parts2 = explode("|", $item_parts[1]);
                        $counter3 = 0;
                        foreach ($item_parts2 as $pin) {
                            $pin_parts = explode(" ", $pin);
                            echo "<br>" . $pin_parts[0] . " -- " . $pin_parts[1];
                            $arr[$i][$counter1]["items"][$pin_parts[0]] = $pin_parts[1];
                            $counter3++;
                        }
                    }
                }
                $counter1++;
            }
        }
    }


    $num_tables = count(($arr));

    for($t=0;$t<$num_tables;$t++){
        $table = $arr[$t];

        $num_cols = count($table);
        ?><table class="table is-bordered is-striped">
        <tr class="is-selected"><th>#pin</th>
            <?
        for($col=1;$col<=$num_cols;$col++) {
            echo '<th>'.$table[$col]['name'].'</th>';
        }
    ?>
        </tr>
        <?php
        for($pin=1;$pin<10;$pin++){
            ?><tr><td><?=$pin?></td><?
            for($col=1;$col<=$num_cols;$col++) {
                echo '<td>';
                if(isset($table[$col]['items'][$pin])){echo $table[$col]['items'][$pin];}
                echo '</td>';
            }
            ?></tr><?

        }

        ?></table><?php
    }






}

function show_com_ports_temp($connector)
{  // show one connector
    $a = explode("\n", $connector);
    $ports = sizeof($a);
//echo "ports=$ports<br>";
    echo "<tr>";
    /*
      echo "<td>";
      show_1_port($a[0]);
      echo "</td>";
      echo "</tr></table>";
     */

    for ($y = 1; $y < $ports - 1; $y++) {  // from 1 because becaus 0 is before first \n
        echo "<td>" . $y . "</td>";
        echo "<td>";
        show_1_port_temp($a[$y]);
        echo "</td>";
    }
    echo "</tr>";
}

function show_1_port_temp($port)
{   // show one port
    $b = explode("=", $port);
//echo "<br>";
    $c = explode("|", $b[1]);
    $pins = sizeof($c);
//echo $pins;
    echo "<span>$b[0]</span>";
    for ($i = 1; $i < 10; $i++) {
        $out = "";
        for ($j = 0; $j < $pins; $j++) {
            $p = explode(" ", $c[$j]);
            if ($p[0] == $i)
                $out = $p[1];
        }
        if ($out == "")
            $out = " &nbsp";
        echo "<span> $out</span>";
    }
}


function get_schemes($model)
{

    global $mysqli_db;
    $query2 = "SELECT * FROM `com` WHERE `model`='{$model}';";
    $h2_scheme = 'COM-порты устройства ' . $model;
    $query2 = mysqli_query($mysqli_db, $query2) or die("ошибка запроса0212" . $query2);
    $j2 = mysqli_num_rows($query2);
    $scheme = '';
// $row2_time = mysqli_fetch_assoc($query2);
// $sname_time = str_replace("\r\n", "<br />", $row2_time[name]);
    if ($j2 > 0) {
        for ($i2 = 0; $i2 < $j2; $i2++) {
            $row2 = mysqli_fetch_assoc($query2);
            $sname = str_replace("\r\n", "<br />", $row2['name']);
            if (!empty($row2['data_table_html'])) {
                if ($sname != '' or $row2['type'] != '') {
                    $scheme .= '<div class="component_catalog_detail__schemes">';
                    if ($sname != '') {
                        $scheme .= '<div class="com_about"><div><b>Название разъема:</b></div><div>' . $sname . '</div>';
                    }
                    if ($row2['type'] != '') {
                        $scheme .= '<div><b>Тип:</b></div><div>' . $row2['type'] . '</div>';
                    }
                    if (isset($row2['image']) and $row2['image'] != '') $scheme .= '<img class="" src="/images/' . $row2['image'] . '" />';
                    $scheme .= '</div>';
                }
                $scheme .= '<div class="scheme"><div>';
                $scheme .= $row2['data_table_html'];
                $scheme .= '</div></div></div>';
            } else {
                $scheme .= '<div class="component_catalog_detail__schemes"><div class="com_about"><b>Название разъема:</b><br />' . $sname . '<br /><b>Тип:</b><br />' . $row2['type'] . '<img class="" src="/images/' . $row2['image'] . '" /><br /></div>';
                $scheme .= '<div class="scheme">';
                $com = str_replace("\"", "", $row2['com']);
                $com = str_replace("(", " (", $com);
                $com = explode(",", $com);
                $coms = count($com);
                $contacts = str_replace("\"", "", $row2['contacts']);
                $contacts = explode(";", $contacts);
                $scheme .= '<div class="table-container"><table class="table is-bordered is-striped is-narrow"><tr class="is-selected"><th>Pin #</th>';
                for ($d = 0; $d < $coms; $d++) {
                    $scheme .= '<th>' . $com[$d] . '</th>';
                };
                $scheme .= '</tr>';
                $cc = 1;
                for ($c = 0; $c < 9; $c++) {
                    $scheme .= '<tr><td>' . $cc . '</td>';
                    $contact = explode(",", $contacts[$c]);
                    for ($d = 0; $d < $coms; $d++) {
                        if(isset($contact[$d])){
                            $scheme .= '<td>' . $contact[$d] . '</td>';
                        }
                    };
                    $scheme .= '</tr>';
                    $cc++;
                };

                $scheme .= '</table></div></div></div>';
            }
        };
    } else {
        $scheme = 'У ' . $model . ' схемы com-портов отсутствуют.';
        $scheme = '';
    }

    return $scheme;
}


function get_list_of_files($arguments)
{
    global $mysqli_db;
    if (isset($arguments["where"]) and $arguments["where"] != "") {
        $WHERE = " WHERE {$arguments["where"]}";
    } else $WHERE = "";

    if (isset($arguments["order"]) and $arguments["order"] != "") {
        $ORDER = " ORDER BY {$arguments["order"]} ";
    } else $ORDER = "";
    $query = "SELECT * FROM `products_files` $WHERE $ORDER";

    $result = mysqli_query($mysqli_db, $query) or die("Ошибка в файле classes.php: " . mysqli_error($mysqli_db) . " " . $query);
    $out = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row;
    }
    return $out;
}




