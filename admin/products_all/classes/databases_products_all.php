<?php

if (!defined('admin'))
    exit;

class DBWORK {

    // объявление свойства
    private $query = '';
    private $db = 'moisait_ra';
    private $ib_catalog_sections = 'ib_catalog_sections';
    private $ib_catalog_elements = 'ib_catalog_elements';

    public function show_tables() {
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db, "SET NAMES utf8");
        $query = "SHOW TABLES FROM moisait_ra";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        while ($row = mysqli_fetch_row($mysqli_db,$result)) {
            echo "<a href='#'>" . $row[0] . "</a> &nbsp; ";
        }
    }

    // объявление метода
    public function add_catalog_section($arguments) {
        global $db;
        $errors = "";
        if ($arguments["name"] == "") {
            $success = false;
            $errors = " Имя ";
        }
        if ($arguments["code"] == "") {
            $success = false;
            $errors .= " Код";
        }
        if ($errors) {
            return "Секция не добавлена!<br>Заполните обязательные поля:" . $errors;
        }
        $ptn = "/[^a-zA-Zа-яА-ЯЁё0-9&\/ ]/w";
        $this->query = "INSERT INTO `products_all`" .
                " (`id`, `name`, `code`, `parent_code`, `picture_preview`, `text_preview`, `text_detail`, `extra_text1`, `title`, `description`, `keywords`, `template_element`)" .
                " VALUES (NULL, '" . strip_tags($arguments['name']) .
                "', '" . strip_tags($arguments['code']) .
                "', '" . strip_tags($arguments['parent_code']) .
                "', '" . addslashes($arguments['picture_preview']) .
                "', '" . addslashes($arguments['text_preview']) .
                "', '" . addslashes($arguments['text_detail']) .
                "', '" . addslashes($arguments['extra_text1']) .
                "', '" . addslashes(strip_tags($arguments['title'])) .
                "', '" . addslashes(strip_tags($arguments['description'])) .
                "', '" . addslashes(strip_tags($arguments['keywords'])) .
                "', '" . addslashes(strip_tags($arguments['template_element'])) .
                "');";
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db, $this->query) or die("Invalid query: " . mysqli_error($mysqli_db));

        if ($result) {
            $out["message"] = "Секция " . $arguments['name'] . " добавлена.";
            $out["success"] = true;
            return $out;
        } else {
            $out["message"] = "Ошибка! Секция " . $arguments['name'] . " не добавлена!<br>" . $this->query;
            $out["success"] = false;
            return $out;
        }
    }

    public function update_pics_number($model, $number) {
        global $db;
        global $mysqli_db;
        if ($model == "" ) {return;}
        $query = "UPDATE `products_all` SET `pics_number` = '$number' WHERE `model` = '$model';";
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");

        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
        //echo ("!1<br>");
    }
    public function incrementing_pics_number($product_id) {
        global $db;
        if ($product_id == '') {return;}
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        echo $query = "UPDATE `products_all` SET `pics_number` = `pics_number`+1 WHERE `index` = '$product_id';";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);
        
    }


    public function edit_catalog_element($element_id, $arguments) {


        global $db;
        $out["errors"] = "";
        if (!isset($arguments["field_model"])) {
            $out["success"] = false;
            $out["errors"] = " Имя ";
        }
        if ($out["errors"] != "") {
            return $out;
        }
        $query = "UPDATE `products_all` SET ";
        foreach ($arguments as $key => $value) {
            if (strpos($key, "field_") !== false) {
                $real_field_name = substr($key, 6);
//                $query .= "`" . $real_field_name . "` = '" . addslashes(html_entity_decode($arguments[$key])) . "',";
                $query .= "`" . $real_field_name . "` = '" . addslashes(($arguments[$key])) . "',";
            }
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE `index` = '$element_id';";

        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db) . "<br>" . $query);

        if ($result) {
            $out["message"] = "Элемент " . $arguments['field_model'] . " (ID: $element_id)" . " сохранен.";
            $out["element_id"] = $element_id;
            $out["success"] = true;
            return $out;
        } else {
            $out["message"] = "Ошибка! Элемент " . $arguments['field_model'] . "($element_id)" . " не сохранен!<br>" . $this->query;
            $out["success"] = false;
            return $out;
        }
    }

    public function save_catalog_section_fields_text_value($element_id, $field_id, $value = "", $value_rus = "") {
        $value = trim($value);
        $value_rus = trim($value_rus);
        if (isset($element_id) and $element_id > 0 and isset($field_id) and $field_id > 0) {
            $element_id = intval($element_id);
            $field_id = intval($field_id);
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            if ($value == "" and $value_rus == "") {
                $query = "DELETE FROM `ib_catalog_section_fields_text_values` WHERE (`catalog_section_fields_text_id` = '$field_id')" .
                        " AND (`element_id` = '$element_id') ;";
                $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . $query . "<br>" . mysqli_error($mysqli_db));
                if ($result) {
                    $out["success"] = true;
                    return $out;
                } else {
                    $out["success"] = false;
                    return $out;
                }
            }
            $value = addslashes($value);
            $value_rus = addslashes($value_rus);
            $query = "UPDATE `ib_catalog_section_fields_text_values` SET `value` = '$value', `value_rus` = '$value_rus', `modified_time` = '" . date("Y-m-d H.i.s") . "' WHERE (`catalog_section_fields_text_id` = '$field_id')" .
                    " AND (`element_id` = '$element_id') ;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . $query . "<br>" . mysqli_error($mysqli_db));
            if ($result) {
                if (mysqli_affected_rows($mysqli_db) == 0 and ( $value != "" or $value_rus != "")) {
                    $query = "INSERT INTO `ib_catalog_section_fields_text_values` (`id`, `section_code`, `value`, `value_rus`, `catalog_section_fields_text_id`, `element_id`) "
                            . " VALUES (NULL, '', '$value', '$value_rus', '$field_id',  '$element_id');";
                    $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . $query . "<br>" . mysqli_error($mysqli_db));
                    if ($result) {
                        $out["success"] = true;
                        return $out;
                    }
                }
                $out["success"] = true;
                return $out;
            } else {
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function edit_catalog_section($section_id, $arguments) {
        global $db,$mysqli_db;
        $out["errors"] = "";
        if ($arguments["name"] == "") {
            $out["success"] = false;
            $out["errors"] = " Имя ";
        }
        if ($arguments["code"] == "") {
            $out["success"] = false;
            $out["errors"] .= " Код ";
        }
        if ($out["errors"] != "") {
            return $out;
        }
        if (isset($arguments['name']))
            $arguments['name'] = strip_tags($arguments['name']);
        if (isset($arguments['code']))
            $arguments['code'] = strip_tags($arguments['code']);
        if (isset($arguments['parent_code']))
            $arguments['parent_code'] = strip_tags($arguments['parent_code']);
        if (isset($arguments['picture_preview']))
            $arguments['picture_preview'] = addslashes($arguments['picture_preview']);
        if (isset($arguments['text_preview']))
            $arguments['text_preview'] = addslashes($arguments['text_preview']);
        if (isset($arguments['text_detail']))
            $arguments['text_detail'] = addslashes($arguments['text_detail']);
        if (isset($arguments['extra_text1']))
            $arguments['extra_text1'] = addslashes($arguments['extra_text1']);
        if (isset($arguments['title']))
            $arguments['title'] = addslashes(strip_tags($arguments['title']));
        if (isset($arguments['description']))
            $arguments['description'] = addslashes(strip_tags($arguments['description']));
        if (isset($arguments['keywords']))
            $arguments['keywords'] = addslashes(strip_tags($arguments['keywords']));
        if (isset($arguments['template_element']))
            $arguments['template_element'] = addslashes(strip_tags($arguments['template_element']));
        $element_fields_text = "";
        if (isset($arguments['bind_fields'])) {

            foreach ($arguments['bind_fields'] as $value) {
                $element_fields_text .= intval($value) . ", ";
            }
            $element_fields_text = addslashes($element_fields_text);
        }
        $this->query = "UPDATE `products_all` "
                . "SET "
                . "`name` = '" . $arguments['name'] . "',"
                . "`code` = '" . $arguments['code'] . "',"
                . "`parent_code` = '" . $arguments['parent_code'] . "',"
                . "`picture_preview` = '" . $arguments['picture_preview'] . "',"
                . "`text_preview` = '" . $arguments['text_preview'] . "',"
                . "`text_detail` = '" . $arguments['text_detail'] . "',"
                . "`extra_text1` = '" . $arguments['extra_text1'] . "',"
                . "`title` = '" . $arguments['title'] . "',"
                . "`description` = '" . $arguments['description'] . "',"
                . "`keywords` = '" . $arguments['keywords'] . "', "
                . "`template_element` = '" . $arguments['template_element'] . "', "
                . "`element_fields_text` = '" . $element_fields_text . "' "
                . "WHERE `products_all`.`id` = '$section_id';";
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,$this->query) or die("Invalid query: " . $this->query . "<br>" . mysqli_error($mysqli_db));

        if ($result) {
            $out["message"] = "Секция " . $arguments['name'] . "($section_id)" . " сохранена.";
            $out["success"] = true;
            return $out;
        } else {
            $out["message"] = "Ошибка! Секция " . $arguments['name'] . "($section_id)" . " не сохранена!<br>" . $this->query;
            $out["success"] = false;
            return $out;
        }
    }

    public function get_list_catalog_sections() {
        global $mysqli_db;
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        if (isset($_GET["table"])) {
            $table = $_GET["table"];
        } else {
            $table = "products_all";
        }

        $query = "SELECT * FROM `$table`;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_catalog_section() {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `products_all`;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_brands() {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `catalog_brands`;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_series() {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `catalog_series`;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_types() {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `catalog_types`;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_catalog_section_by_id($section_id) {
        global $mysqli_db;
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `products_all` WHERE `id` = '" . $section_id . "';";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_catalog_section_field_text_by_id($field_id) {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `ib_catalog_section_fields_text` WHERE `id` = '" . $field_id . "';";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out = $current_row;
            }
        }
        return $out;
    }

    public function get_catalog_element_by_id($index) {
        global $mysqli_db;
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `products_all` WHERE `index` = " . $index . ";";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function getlist_table_fields() {
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,"SHOW COLUMNS FROM `products_all`");
        while ($col = mysqli_fetch_row($result)) {
            $out[] = $col;
        }
        return $out;
    }

    public function is_suitable_for_type($name,$type) {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,"SELECT * FROM `catalog_field_descriptions` where `code`='$name' and FIND_IN_SET('$type',product_types)>0");
        $num_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($num_rows > 0) return $row["name"];
        else return '';
    }

    public function get_sin_for_table_fields($name,$type) {
        global $mysqli_db;
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,"SELECT * FROM `catalog_field_descriptions` where `code`='$name' and FIND_IN_SET('$type',product_types)>0");
        $num_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($num_rows > 0) return $row["spec_sinonimy"];
        else return '';
    }

    public function get_distinct_for_field($name) {
        global $mysqli_db;
		$out = array();
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,"SELECT DISTINCT `$name` FROM `products_all` ORDER BY `$name` ASC");
        $num_rows = mysqli_num_rows($result);
		if($num_rows > 0) {
        while ($col = mysqli_fetch_row($result)) {
            $out[] = $col;
        }
		}
        return $out;
    }

    public function get_field_type($name) {
        global $mysqli_db;
		$out = array();
        database_connect();
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,"SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'products_all' AND COLUMN_NAME = '$name'");
		while ($col = mysqli_fetch_row($result)) {
            $out[] = $col;
        }
//$out2 = unserialize($out);
        return $out;
    }


    public function get_list_catalog_elements($order_by = "",$brand = "",$type = "",$serie = "") {
        global $mysqli_db;
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");

        if ($order_by != "") {
            if ($order_by == "index") {
                $query = "SELECT * FROM `products_all` ORDER BY `index` DESC LIMIT 1000 ";
            } elseif ($order_by == "brand") {
                $query = "SELECT * FROM `products_all` ORDER BY `brand` ASC,`index` DESC  LIMIT 1000 ";
            } elseif ($order_by == "model") {
                $query = "SELECT * FROM `products_all` ORDER BY `model` LIMIT 1000 ";
            } elseif ($order_by == "type") {
                $query = "SELECT * FROM `products_all` ORDER BY `type` LIMIT 1000 ";
            } else {
                $query = "SELECT * FROM `products_all` ORDER BY `index` DESC, `model` LIMIT 1000 ";
            }
        } elseif ($brand != "") {
            $query = "SELECT * FROM `products_all` WHERE `brand` = '".$brand."' ORDER BY `index` DESC, `model` ASC LIMIT 1000 ";
        } elseif ($type != "") {
            $query = "SELECT * FROM `products_all` WHERE `type` = '".$type."' ORDER BY `index` DESC, `model` ASC LIMIT 1000 ";
        } elseif ($serie != "") {
            $query = "SELECT * FROM `products_all` WHERE `series` REGEXP '".$serie."' ORDER BY `index` DESC, `model` ASC LIMIT 1000 ";
        } else {
            $query = "SELECT * FROM `products_all` ORDER BY `index` DESC, `model` ASC LIMIT 1000 ";
        }
        //echo $query;
        //$query = "SELECT * FROM `products_all` ORDER BY `brand`, `model` LIMIT 1000 ";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_list_catalog_section_fields_text($arguments = Array()) {
        if (isset($arguments["sort"])) {
            if (isset($arguments["sort_direction"])) {
                $sort_direction = $arguments["sort_direction"];
            } else {
                $sort_direction = "ASC";
            }
            $extra = " ORDER BY `" . $arguments["sort"] . "` " . $sort_direction . " ";
        }
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $query = "SELECT * FROM `ib_catalog_section_fields_text` $extra;";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $out[] = $current_row;
            }
        } else {
            $out = 'пусто';
        };
        return $out;
    }

    public function get_list_catalog_element_fields_text($arguments = Array()) {
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
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        // узнать родительскую секцию
        $query = "SELECT `section_code` FROM `ib_catalog_elements` WHERE `id`= " . $arguments["id"] . ";";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
        $row = mysqli_fetch_assoc($result);
        if (!isset($row["section_code"]))
            die("ошибка // узнать родительскую секцию");
        $section_code = $row["section_code"];
        // получить все привязки секции к полям
        $binds_section_to_fields = $this->get_list_section_element_fields_text_by_code($section_code);
        // найти имеющиеся значения для этих полей для элемента
        $query = "SELECT * FROM `ib_catalog_section_fields_text_values` WHERE `element_id`='" . $arguments["id"] . " ORDER BY `name`';";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            $values = array();
            for ($row = 0; $row < $rows; $row++) {
                $current_row = mysqli_fetch_assoc($result);
                $values[] = $current_row;
            }
        }
        // сортировать значения по id поля
        $sorted_values = array();
        if (isset($values)) {
            foreach ($values as $value) {
                $sorted_values[$value["catalog_section_fields_text_id"]] = array("value" => $value["value"], "value_rus" => $value["value_rus"]);
            }
        }
        if (is_array($binds_section_to_fields)) {
            $arResult = array();
            // выдать информацию массив полей id значение
            foreach ($binds_section_to_fields as $value) {
                $field = $this->get_catalog_section_field_text_by_id($value);
                if (isset($sorted_values[$value])) {

                    $arResult[] = Array("id" => $value, "code" => $field["code"], "name" => $field["name"], "type" => $field["type"], "value" => $sorted_values[$value]);
                } else
                    $arResult[] = Array("id" => $value, "code" => $field["code"], "name" => $field["name"], "type" => $field["type"], "value" => "");
            }
            return $arResult;
        }
    }

    public function get_list_section_element_fields_text_by_code($code) {
        if (!isset($code))
            return;
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");

        $query = "SELECT `element_fields_text` FROM `ib_catalog_sections` WHERE `code`= '$code';";
        $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
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

    public function delete_catalog_section($id) {
        if ($id > 0) {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "DELETE FROM `products_all` WHERE `products_all`.`id` = $id;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
            if ($result) {
                $out["message"] = "Секция " . $id . " удалена.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Секция " . id . " не удалена!";
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function add_catalog_element($arguments) {
        $errors = "";
        if ($arguments["name"] == "") {
            $success = false;
            $errors = " Имя ";
        }
        if ($arguments["code"] == "") {
            $success = false;
            $errors .= " Код";
        }
        if ($arguments["section_code"] == "") {
            $success = false;
            $errors .= " Код родительского раздела ";
        }
        if ($errors) {
            $out["message"] = "Элемент не добавлен!<br>Заполните обязательные поля:" . $errors;
            $out["success"] = false;
            return $out;
        }

        $ptn = "/[^a-zA-Zа-яА-ЯЁё0-9&\/ ]/w";
        $this->query = "INSERT INTO `$this->ib_catalog_elements`" .
                " (`id`, `name`, `h1`, `code`, `section_code`, `picture_preview`, `picture_detail`, `text_preview`, `text_detail`, `price`, `in_stock`, `title`, `description`, `keywords`)" .
                " VALUES (NULL, '" . strip_tags($arguments['name']) .
                "', '" . strip_tags($arguments['h1']) .
                "', '" . strip_tags($arguments['code']) .
                "', '" . strip_tags($arguments['section_code']) .
                "', '" . addslashes($arguments['picture_preview']) .
                "', '" . addslashes($arguments['picture_detail']) .
                "', '" . addslashes($arguments['text_preview']) .
                "', '" . addslashes($arguments['text_detail']) .
                "', '" . addslashes($arguments['price']) .
                "', '" . addslashes($arguments['in_stock']) .
                "', '" . addslashes(strip_tags($arguments['title'])) .
                "', '" . addslashes(strip_tags($arguments['description'])) .
                "', '" . addslashes(strip_tags($arguments['keywords'])) .
                "');";
        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,$this->query) or die("Invalid query: " . mysqli_error($mysqli_db));

        if ($result) {
            $out["message"] = "Элемент " . $arguments['name'] . " добавлен.";
            $out["success"] = true;
            return $out;
        } else {
            $out["message"] = "Ошибка! Элемент " . $arguments['name'] . " не добавлен!";
            $out["success"] = false;
            return $out;
        }
    }

    public function delete_catalog_element($id) {

        if ($id > 0) {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "DELETE FROM `$this->ib_catalog_elements` WHERE `$this->ib_catalog_elements`.`id` = $id;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysql_error($mysqli_db));
            if ($result) {
                $out["message"] = "Элемент " . $id . " удален.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Элемент " . id . " не удален!";
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function set_position_catalog_element($id, $position) {

        if ($id > 0 and $position > 0) {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "UPDATE `$this->ib_catalog_elements` SET `position` = '$position' WHERE `$this->ib_catalog_elements`.`id` = $id;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
            if ($result) {
                $out["message"] = "Позиция $position элемента " . $id . " установлена.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Позиция элемента " . id . " не установлена!";
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function move_up_catalog_element($id, $section_code = "") {
        if ($id > 0) {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "UPDATE `$this->ib_catalog_elements` SET `position` = `position` - 101 WHERE `$this->ib_catalog_elements`.`id` = $id;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
            if ($result) {
                if ($section_code != "") {
                    $this->recalculate_positions_catalog_element($section_code);
                }
                $out["message"] = "Элемент " . $id . " перемещен вверх.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Элемент " . id . " не перемещен!";
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function move_down_catalog_element($id, $section_code = "") {
        if ($id > 0) {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "UPDATE `$this->ib_catalog_elements` SET `position` = `position` + 101 WHERE `$this->ib_catalog_elements`.`id` = $id;";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
            if ($result) {
                if ($section_code != "") {
                    $this->recalculate_positions_catalog_element($section_code);
                }
                $out["message"] = "Элемент " . $id . " перемещен вниз.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Элемент " . id . " не перемещен!";
                $out["success"] = false;
                return $out;
            }
        }
    }

    public function recalculate_positions_catalog_element($section_code) {
        if ($section_code != "") {
            database_connect();
            global $mysqli_db;
            mysqli_query($mysqli_db,"SET NAMES utf8");
            $query = "(SELECT `id`, `position` FROM `$this->ib_catalog_elements`  WHERE `section_code`='$section_code'  ORDER BY `id` LIMIT 5000) ORDER BY `position` ";
            $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysql_error($mysqli_db));
            $rows = mysqli_num_rows($result);
            if ($rows > 0) {
                for ($row = 0; $row < $rows; $row++) {
                    $current_row = mysqli_fetch_assoc($result);
                    $arElements[] = $current_row;
                }
            } else {
                $out["message"] = "Что-то пошло не так в recalculate_positions_catalog_element($section_code) ";
                $out["success"] = true;
                return $out;
            };
            $counter = 0;
            foreach ($arElements as $element) {
                $counter += 100;
                $query = "UPDATE `$this->ib_catalog_elements` SET `position` = '$counter' WHERE `$this->ib_catalog_elements`.`id` = '" . $element["id"] . "';";
                $result = mysqli_query($mysqli_db,$query) or die("Invalid query: " . mysqli_error($mysqli_db));
            }
            $out["message"] = "Произведен пересчет позиций в '$section_code'";
            $out["success"] = true;
            return $out;
        }
    }
    
    public function copy_product_element($element_id) {
        global $mysqli_db;
        
        $debug_info = [];
        $debug_info[] = "Начало копирования элемента: " . $element_id;
        
        database_connect();
        mysqli_query($mysqli_db, "SET NAMES utf8");
        $debug_info[] = "Подключение к БД установлено";
        
        $query = "SELECT * FROM `products_all` WHERE `index` = " . intval($element_id);
        $debug_info[] = "Выполняем запрос: " . $query;
        
        $result = mysqli_query($mysqli_db, $query);
        
        if (!$result) {
            $error = mysqli_error($mysqli_db);
            $debug_info[] = "ОШИБКА запроса SELECT: " . $error;
            return [
                "success" => false,
                "message" => "Ошибка базы данных: " . $error,
                "debug" => $debug_info
            ];
        }
        
        if (mysqli_num_rows($result) == 0) {
            $debug_info[] = "Элемент не найден";
            return [
                "success" => false,
                "message" => "Элемент с ID $element_id не найден!",
                "debug" => $debug_info
            ];
        }
        
        $original_element = mysqli_fetch_assoc($result);
        $debug_info[] = "Элемент найден: " . $original_element['model'];
        
        $max_index_query = "SELECT MAX(`index`) as max_index FROM `products_all`";
        $max_result = mysqli_query($mysqli_db, $max_index_query);
        
        if (!$max_result) {
            $error = mysqli_error($mysqli_db);
            $debug_info[] = "ОШИБКА запроса MAX: " . $error;
            return [
                "success" => false,
                "message" => "Ошибка при получении максимального ID: " . $error,
                "debug" => $debug_info
            ];
        }
        
        $max_row = mysqli_fetch_assoc($max_result);
        $new_index = $max_row['max_index'] + 1;
        $debug_info[] = "Новый index: " . $new_index;
        
        $fields = [];
        $values = [];
        
        foreach ($original_element as $field => $value) {
            if ($field == 'index') {
                $fields[] = "`$field`";
                $values[] = "'$new_index'";
                continue;
            }
            
            if ($field == 'model') {
                $new_value = $value . '_copy';
                $fields[] = "`$field`";
                $values[] = "'" . mysqli_real_escape_string($mysqli_db, $new_value) . "'";
                $debug_info[] = "Поле model изменено: " . $value . " -> " . $new_value;
            }
            elseif (in_array($field, ['s_name', 'h1', 'title'])) {
                $new_value = $value . ' (копия)';
                $fields[] = "`$field`";
                $values[] = "'" . mysqli_real_escape_string($mysqli_db, $new_value) . "'";
                $debug_info[] = "Поле $field изменено: " . $value . " -> " . $new_value;
            }
            else {
                $fields[] = "`$field`";
                $values[] = "'" . mysqli_real_escape_string($mysqli_db, $value) . "'";
            }
        }
        
        $fields_str = implode(', ', $fields);
        $values_str = implode(', ', $values);
        
        $insert_query = "INSERT INTO `products_all` ($fields_str) VALUES ($values_str)";
        $debug_info[] = "INSERT запрос подготовлен";
        
        $insert_result = mysqli_query($mysqli_db, $insert_query);
        
        if ($insert_result) {
            $debug_info[] = "КОПИРОВАНИЕ УСПЕШНО! Новый элемент создан с ID: " . $new_index;
            return [
                "success" => true,
                "message" => "Элемент успешно скопирован. Новый ID: $new_index",
                "new_element_id" => $new_index,
                "debug" => $debug_info
            ];
        } else {
            $error = mysqli_error($mysqli_db);
            $debug_info[] = "ОШИБКА INSERT: " . $error;
            $debug_info[] = "Запрос: " . $insert_query;
            return [
                "success" => false,
                "message" => "Ошибка при копировании в базу данных: " . $error,
                "debug" => $debug_info
            ];
        }
    }
}
