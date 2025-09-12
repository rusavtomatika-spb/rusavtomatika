<?php

function get_product_field_descriptions()
{
    global $mysqli_db;
    $out = array();
    $query = "SELECT g.name as group_name, f.code as field_code,f.name as field_name, f.units as field_units, f.field_group as group_code FROM `catalog_field_groups` g, `catalog_field_descriptions` f where g.code = f.field_group order by g.position, f.position";
    $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
    while ($row = mysqli_fetch_assoc($result)) {
        $out[$row["group_code"]]['name'] = $row['group_name'];
        $out[$row["group_code"]]['items'][] = array("field_name" => $row['field_name'], "field_code" => $row['field_code'], "field_units" => $row['field_units'], );
    }
    return $out;
}



function get_schemes($model){

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
                $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">Название разъема:<br />' . $sname . '<br /><br />Тип:<br />' . $row2['type'] . '<img class="" src="/images/' . $row2['image'] . '" /><br /></div>';
                $scheme .= '<div class="scheme">';
                $scheme .= $row2['data_table_html'];
                $scheme .= '</div></div><div class="separator"></div>';
            } else {


                $scheme .= '<div class="com" style="display: inline-block;"><div class="com_about">Название разъема:<br />' . $sname . '<br /><br />Тип:<br />' . $row2['type'] . '<img class="" src="/images/' . $row2['image'] . '" /><br /></div>';
                $scheme .= '<div class="scheme">';
                $com = str_replace("\"", "", $row2['com']);
                $com = str_replace("(", " (", $com);
                $com = explode(",", $com);
                $coms = count($com);
                $contacts = str_replace("\"", "", $row2['contacts']);
                $contacts = explode(";", $contacts);
                $scheme .= '<table><tr><td>Pin #</td>';
                for ($d = 0; $d < $coms; $d++) {
                    $scheme .= '<td>' . $com[$d] . '</td>';
                };
                $scheme .= '</tr>';
                $cc = 1;
                for ($c = 0; $c < 9; $c++) {
                    $scheme .= '<tr><td>' . $cc . '</td>';
                    $contact = explode(",", $contacts[$c]);
                    for ($d = 0; $d < $coms; $d++) {

                        $scheme .= '<td>' . $contact[$d] . '</td>';
                    };
                    $scheme .= '</tr>';
                    $cc++;
                };

                $scheme .= '</table></div></div><div class="separator"></div>';
            }
        };
    } else {
        $scheme = 'У ' . $model . ' com-порты отсутствуют.';
    }

    return $scheme;
}


function  get_list_of_files($arguments)
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




