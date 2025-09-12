<?php





/*

define("ERRORS", 0);

if (ERRORS) {

    ini_set('error_reporting', E_ALL);

    ini_set('display_errors', 1);

    ini_set('display_startup_errors', 1);

}*/

if (!defined('cms'))

    exit;



class CApplication {



    public function translitURL($string) {



        $tr = array(

            "�" => "a", "�" => "b", "�" => "v", "�" => "g",

            "�" => "d", "�" => "e", "�" => "e", "�" => "j", "�" => "z", "�" => "i",

            "�" => "y", "�" => "k", "�" => "l", "�" => "m", "�" => "n",

            "�" => "o", "�" => "p", "�" => "r", "�" => "s", "�" => "t",

            "�" => "u", "�" => "f", "�" => "h", "�" => "ts", "�" => "ch",

            "�" => "sh", "�" => "sch", "�" => "", "�" => "yi", "�" => "",

            "�" => "e", "�" => "yu", "�" => "ya", "�" => "a", "�" => "b",

            "�" => "v", "�" => "g", "�" => "d", "�" => "e", "�" => "e", "�" => "j",

            "�" => "z", "�" => "i", "�" => "y", "�" => "k", "�" => "l",

            "�" => "m", "�" => "n", "�" => "o", "�" => "p", "�" => "r",

            "�" => "s", "�" => "t", "�" => "u", "�" => "f", "�" => "h",

            "�" => "ts", "�" => "ch", "�" => "sh", "�" => "sch", "�" => "y",

            "�" => "yi", "�" => "", "�" => "e", "�" => "yu", "�" => "ya",

            " -" => "", "," => "", " " => "-", "." => "", "/" => "_",

            "-" => ""

        );

        if (preg_match('/[^A-Za-z0-9_\-]/', $string)) {

            $string = strtr($string, $tr);

            $string = preg_replace('/[^A-Za-z0-9_\-]/', '', $string);

        }

        return strtolower($string);

    }



    public function IncludeComponent($component, $template, $arguments)

    {

        global $cms_path_components;



        include $cms_path_components . "/" . $component . "/" . 'component.php';

    }



}



global $APPLICATION;

global $CDBWork;

global $DBWORK;

$APPLICATION = new CApplication();

$DBWORK = new CDBWork();



class CDBWork

{

    public function CDBWork()

    {

        global $mysqli_db;

        database_connect();

        /*

        $host = "localhost"; // ��� �����

        $port = "3306";      // ����� �����, 3306 - �� ���������

        if ($_SERVER['DOCUMENT_ROOT'] == '/home/weblec/public_html/rusavtomatika.com') {

            $user = "weblec_den";      // ��� ������������

            $pass = '646111';  // ������

            $dbnm = "weblec_weintek";      // ��� ��

        } elseif (preg_match("/www.test.rusavtomatika.com/i", $_SERVER['HTTP_HOST'])) {

            $dbnm = "weblec_weintek_test";

            $user = 'weblec_testuser';

            $pass = '243344';

        } elseif (preg_match("/moisait/i", $_SERVER['DOCUMENT_ROOT'])) {

            $user = "moisait_olga";      // ��� ������������

            $pass = 'olgaglr';  // ������

            $dbnm = "moisait_ra";      // ��� ��

        } elseif ($_SERVER['HTTP_HOST'] == "www.rusavto.valovenko2.tmweb.ru") {

            $user = "valovenko2_rusav";      // ��� ������������

            $pass = 'NQ1U22wt';  // ������

            $dbnm = "valovenko2_rusav";      // ��� ��

        } elseif (preg_match("/olgaglr/i", $_SERVER['DOCUMENT_ROOT'])) {



            $port = "";      // ����� �����, 3306 - �� ���������

            $user = "olgaglr_rusavto";      // ��� ������������

            $pass = 'pGrk5V2S';  // ������

            $dbnm = "olgaglr_rusavto";      // ��� ��

        } else {

            $user = "valovenko_rusavt";      // ��� ������������

            $pass = 'wyZM836401WL7x99';  // ������

            $dbnm = "valovenko_rusavt";      // ��� ��

        };



*/





    }



    public function get_list_catalog_sections($filter = "", $table_name = "", $order_by = "", $group_by = "")

    {

        if ($table_name == "")

            $table_name = "ib_catalog_sections";

        if ($order_by == "")

            $order_by = "position";



        if ($order_by == "") {

            $order_by = " ORDER BY `id`) ORDER BY `position` ";

            $order_by_before = "(";

        }





        $filter_str = "";



        if (is_array($filter)) {

            $filter_str = " WHERE ";

            $x = 0;

            foreach ($filter as $key => $value) {

                if ($x++ == 0) {

                    $filter_str .= "`$key`='$value' ";

                } else {

                    $filter_str .= " and `$key`='$value' ";

                }

            }

        }

        global $mysqli_db;

        $query = "SELECT * FROM `$table_name` $filter_str $group_by ORDER BY `$order_by` ";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        } else {

            $out = '';

        };

        return $out;

    }



    public function get_list_catalog_section($filter = "", $table_name = "", $order_by = "")

    {

        if ($table_name == "")

            $table_name = "ib_catalog_elements";





        if (is_array($filter)) {

            $filter_str = " WHERE ";

            $x = 0;

            foreach ($filter as $key => $value) {

                if ($x++ == 0) {

                    $filter_str .= "`$key`='$value' ";

                } else {

                    $filter_str .= " and `$key`='$value' ";

                }

            }

        }

        global $mysqli_db;

        $query =  "SELECT * FROM `$table_name`" . $filter_str . "  " . $order_by;

        $result = mysqli_query($mysqli_db, $query) or die("<br>Invalid query: $query  <br>" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        } else {

            $out = '';

        };



        return $out;

    }



    public function get_list_section_element_fields_text_by_code($code)

    {

        if (!isset($code))

            return;

        global $mysqli_db;

        database_connect();

        $query = "SELECT `element_fields_text` FROM `ib_catalog_sections` WHERE `code`= '$code';";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $row = mysqli_fetch_assoc($result);

        if ($row != "") :

            $fields = array();

            $element_fields_text = preg_split("/[\s,]+/", trim($row["element_fields_text"]));

            foreach ($element_fields_text as $value) {

                //echo "=" . $value . "=<br>";

                if ($value != "")

                    $fields[] = $value;

            }

            return $fields;

        endif;

        return;

    }



    public function get_catalog_section_field_text_by_id($field_id)

    {

        global $mysqli_db;

        database_connect();

        $query = "SELECT * FROM `ib_catalog_section_fields_text` WHERE `id` = '" . $field_id . "';";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        }

        return $out;

    }



    public function get_catalog_section_field_by_section_code($section_code, $field_name)

    {

        global $mysqli_db;

        $out = array();

        database_connect();

        $query = "SELECT `" . $field_name . "` FROM `ib_catalog_sections` WHERE `code` = '" . $section_code . "';";

        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        }

        return $out;

    }



    public function get_list_catalog_element_fields_by_id($arguments = Array())

    {

        if (!isset($arguments["id"])) {

            return;

        }

        if (isset($arguments["sort"])) {

            if (isset($arguments["sort_direction"])) {

                $sort_direction = $arguments["sort_direction"];

            } else {

                $sort_direction = "ASC";

            }

            $extra = " ORDER BY `" . $arguments["sort"] . "` " . $sort_direction . " ";

        }

        global $mysqli_db;

        database_connect();

        // ������ ������������ ������

        $query = "SELECT `section_code` FROM `ib_catalog_elements` WHERE `id`= " . $arguments["id"] . ";";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $row = mysqli_fetch_assoc($result);

        if (!isset($row["section_code"]))

            die("������ // ������ ������������ ������");

        $section_code = $row["section_code"];

        // �������� ��� �������� ������ � �����

        $binds_section_to_fields = $this->get_list_section_element_fields_text_by_code($section_code);

        // ����� ��������� �������� ��� ���� ����� ��� ��������

        $query = "SELECT * FROM `ib_catalog_section_fields_text_values` WHERE `element_id`='" . $arguments["id"] . "';";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            $values = array();

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $values[] = $current_row;

            }

        }

        // ����������� �������� �� id ����

        $sorted_values = array();

        if (isset($values)) {

            foreach ($values as $value) {

                if (!isset($value["value_rus"]))

                    $value["value_rus"] = "";

                $sorted_values[$value["catalog_section_fields_text_id"]] = array("value" => $value["value"], "value_rus" => $value["value_rus"]);

            }

        }

        if (is_array($binds_section_to_fields)) {

            $arResult = array();

            // ������ ���������� ������ ����� id ��������

            foreach ($binds_section_to_fields as $value) {

                $field = $this->get_catalog_section_field_text_by_id($value);

                if (isset($sorted_values[$value])) {



                    $arResult[] = Array("id" => $value, "code" => $field["code"], "name" => $field["name"], "name_rus" => $field["name_rus"], "type" => $field["type"], "value" => $sorted_values[$value]);

                } else

                    $arResult[] = Array("id" => $value, "code" => $field["code"], "name" => $field["name"], "name_rus" => $field["name_rus"], "type" => $field["type"], "value" => "");

            }

            return $arResult;

        }

    }



    public function get_catalog_element_by_code($element_code, $section_code = "")

    {

        global $mysqli_db;

        database_connect();

        if ($section_code != "")

            $extra = "' AND `section_code` = '" . $section_code . "' ";

        $query = "SELECT * FROM `ib_catalog_elements` WHERE `code` = '" . $element_code . " $extra;";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        } else {

            $out = '';

        };

        return $out;

    }



    public function get_catalog_element_by_section_code_and_rand($section_code)

    {

        if ($section_code != "") {

            global $mysqli_db;

            database_connect();

            $query = "SELECT * FROM `ib_catalog_elements` WHERE `section_code` = '" . $section_code . "'  ORDER BY RAND() LIMIT 1;";



            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

            $rows = mysqli_num_rows($result);

            if ($rows > 0) {

                for ($row = 0; $row < $rows; $row++) {

                    $current_row = mysqli_fetch_assoc($result);

                    $out = $current_row;

                }

            } else {

                $out = '';

            };

            return $out;

        }

    }



    public function get_catalog_file_by_id($file_id)

    {

        global $mysqli_db;

        database_connect();

        $query = "SELECT * FROM `ib_catalog_files` WHERE `id` = '" . $file_id . "';";

        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        }

        return $out;

    }





    public function get_news_list($db_table, $order_by, $filter = "", $limit = "", $str_fields_to_select = "")

    {

        if (!isset($db_table)) return false;

        $filter_str = '';

        if (is_array($filter) and count($filter) > 0) {

            $filter_str = " WHERE ";

            $x = 0;

            foreach ($filter as $key => $value) {

                if ($x++ == 0) {

                    $filter_str .= "`$key`='$value' ";

                } else {

                    $filter_str .= " and `$key`='$value' ";

                }

            }

        }

        if ($order_by == "") {

            $order_by = "id DESC";

        }

        if ($limit == "") {

            $limit = "10000";

        }

        if ($str_fields_to_select == "") {

            $str_fields_to_select = "*";

        }



        $ORDER_BY_STR = " ORDER BY $order_by ";





        $query = "SELECT $str_fields_to_select FROM `$db_table`" . $filter_str . $ORDER_BY_STR . " limit $limit";

        global $mysqli_db;

        $result = mysqli_query($mysqli_db, $query) or die("Classes.php Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        } else {

            $out = '';

        };



        return $out;

    }

    public function get_news_list_from_two_tables($db_table1, $db_table2, $order_by, $filter = "", $limit = "", $str_fields_to_select = "")

    {





        if (!isset($db_table1) or !isset($db_table2)  or $str_fields_to_select == "" ) return false;





        $filter_str = '';

        if (is_array($filter) and count($filter) > 0) {

            $filter_str = " WHERE ";

            $x = 0;

            foreach ($filter as $key => $value) {

                if ($x++ == 0) {

                    $filter_str .= "`$key`='$value' ";

                } else {

                    $filter_str .= " and `$key`='$value' ";

                }

            }

        }



        if ($order_by == "") {

            $order_by = "id DESC";

        }

        if ($limit == "") {

            $limit = "10000";

        }

        if ($str_fields_to_select == "") {

            $str_fields_to_select = "*";

        }



        $ORDER_BY_STR = " ORDER BY $order_by ";



        //echo $query = "SELECT $str_fields_to_select FROM `$db_table`" . $filter_str . $ORDER_BY_STR . " limit $limit";

        $query = "select * from (select $str_fields_to_select,'$db_table1' as `table` from $db_table1 $filter_str UNION ALL select $str_fields_to_select,'$db_table2'  as `table`   from $db_table2 $filter_str) as b ORDER BY date desc limit $limit";

        global $mysqli_db;

        $result = mysqli_query($mysqli_db, $query) or die("Classes.php Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        } else {

            $out = '';

        };

        return $out;

    }





    public function get_news_element_by_code($db_table, $element_code)

    {

        global $mysqli_db;

        if (!isset($db_table) or !isset($element_code))

            return false;

        $query = "SELECT * FROM `$db_table` WHERE `code` = '" . $element_code . "';";

        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        }

        return $out;

    }



    public function get_gallery_images_for_products_all($model)

    {

        $out = "";

        if (!isset($model) or $model == "")

            return false;

        $query = "SELECT * FROM `gallery` WHERE `model` = '" . $model . "' ORDER BY `position`;";

        global $mysqli_db;

        $result = mysqli_query($mysqli_db, $query) or die("<br>get_gallery_images_for_products_all: ������ � �������: $query <br><br>" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        }

        return $out;

    }



    public function get_element_by_code_for_products_all($model)

    {

        global $mysqli_db;

        database_connect();

        $query = "SELECT * FROM `products_all` WHERE `model` = '" . $model . "'";

        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out = $current_row;

            }

        } else {

            $out = '';

        };

        return $out;

    }



    public function get_products_files($model)

    {

        global $mysqli_db;

        database_connect();

        $query = "SELECT * FROM `products_files` WHERE `product_name` = '" . $model . "' ORDER BY `position`";

        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));

        $rows = mysqli_num_rows($result);

        if ($rows > 0) {

            for ($row = 0; $row < $rows; $row++) {

                $current_row = mysqli_fetch_assoc($result);

                $out[] = $current_row;

            }

        } else {

            $out = '';

        };

        return $out;

    }





    function get_list_of_files($arguments)

    {

        global $mysqli_db;

        database_connect();



        if (isset($arguments["where"]) and $arguments["where"] != "") {

            $WHERE = " WHERE {$arguments["where"]}";

        } else $WHERE = "";



        if (isset($arguments["order"]) and $arguments["order"] != "") {

            $ORDER = " ORDER BY {$arguments["order"]} ";

        } else $ORDER = "";

         $query = "SELECT * FROM `products_files` $WHERE $ORDER";

        



        $result = mysqli_query($mysqli_db, $query) or die("������ � ����� classes.php: " . mysqli_error($mysqli_db) . " " . $query);

        $out = array();

        while ($row = mysqli_fetch_assoc($result)) {

            $out[] = $row;

        }

        return $out;

    }



}

function setTitle($title, $keys, $desc, $canonical = "",$extentionParam = "")

{ //���������� �������, ����������� 4 ����������, ��������� � body

    $out = ob_get_contents();

    ob_end_clean();  //������� �����

    //� ���������� ��� ����� "setTitle('����','�����,����,�������','���� � �������')"

    echo "<title>" . $title . "</title>\n";

    echo "<meta name='keywords' content='" . $keys . "'>\n";

    echo "<meta name='description' content='" . $desc . "'>\n";

    if ($extentionParam != ""){

        echo $extentionParam;

    }

    if ($canonical != "")

        echo "<link rel='canonical' href='" . $canonical . "' />\n";

    echo $out;  //������� ���, ��� ���� �� "setTitle('����','�����,����,�������','���� � �������')"







}

