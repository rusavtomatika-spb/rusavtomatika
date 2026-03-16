<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/stats/goods_changes_history.php');

if (!defined('admin'))
    exit;

class DBWORK {
    public function add_product_element($arguments) {
        $errors = "";
        if ($arguments["name"] == "") {
            $success = false;
            $errors = " Имя ";
        }

        if ($errors) {
            $out["message"] = "Элемент не добавлен!<br>Заполните обязательные поля:" . $errors;
            $out["success"] = false;
            return $out;
        }

        $this->query = "INSERT INTO `products_all`" .
                " (`model`, `s_name`, `h1`, `title`, `description`, `keywords`, `text_preview`, `text_detail`)" .
                " VALUES ('" . strip_tags($arguments['name']) .
                "', '" . strip_tags($arguments['name']) .
                "', '" . strip_tags($arguments['h1']) .
                "', '" . addslashes(strip_tags($arguments['title'])) .
                "', '" . addslashes(strip_tags($arguments['description'])) .
                "', '" . addslashes(strip_tags($arguments['keywords'])) .
                "', '" . addslashes($arguments['text_preview']) .
                "', '" . addslashes($arguments['text_detail']) .
                "');";

        database_connect();
        global $mysqli_db;
        mysqli_query($mysqli_db,"SET NAMES utf8");
        $result = mysqli_query($mysqli_db,$this->query);

        if ($result) {
            $new_id = mysqli_insert_id($mysqli_db);
            $model = strip_tags($arguments['name']);
            
            $h1_text = !empty($arguments['h1']) ? strip_tags($arguments['h1']) : $model;
            
            Core_database_goods_changes_history::save_change(
                $model,
                'PRODUCT_CREATED',
                '',
                'Создан новый товар: ' . $h1_text,
                'insert'
            );
            
            $out["message"] = "Элемент " . $arguments['name'] . " добавлен. ID: " . $new_id;
            $out["success"] = true;
            return $out;
        } else {
            $out["message"] = "Ошибка! " . mysqli_error($mysqli_db);
            $out["success"] = false;
            return $out;
        }
    }

    public function edit_catalog_element($element_id, $arguments) {
        global $db;
        $out["errors"] = "";
        
        if (!isset($arguments["field_model"])) {
            $out["success"] = false;
            $out["errors"] = " Имя ";
            return $out;
        }
        
        database_connect();
        global $mysqli_db;
        
        $old_data_query = mysqli_query($mysqli_db, "SELECT * FROM products_all WHERE `index` = " . intval($element_id));
        if (!$old_data_query) {
            $out["message"] = "Ошибка получения данных: " . mysqli_error($mysqli_db);
            $out["success"] = false;
            return $out;
        }
        
        $old_data = mysqli_fetch_assoc($old_data_query);
        $model = isset($old_data['model']) ? $old_data['model'] : '';
        
        $query = "UPDATE `products_all` SET ";
        $update_fields = array();
        
        foreach ($arguments as $key => $value) {
            if (strpos($key, "field_") !== false) {
                $real_field_name = substr($key, 6);
                $update_fields[] = "`" . $real_field_name . "` = '" . addslashes($value) . "'";
            }
        }
        
        $query .= implode(", ", $update_fields);
        $query .= " WHERE `index` = '$element_id';";

        mysqli_query($mysqli_db, "SET NAMES utf8");
        $result = mysqli_query($mysqli_db, $query);

        if ($result) {
            $changes_count = 0;
            $changed_fields = array();
            
            $new_data_query = mysqli_query($mysqli_db, "SELECT * FROM products_all WHERE `index` = " . intval($element_id));
            $new_data = mysqli_fetch_assoc($new_data_query);
            
            $all_possible_fields = array();
            foreach ($arguments as $key => $value) {
                if (strpos($key, "field_") === 0) {
                    $field_name = substr($key, 6);
                    $all_possible_fields[$field_name] = true;
                }
            }
            
            foreach ($all_possible_fields as $field_name => $dummy) {
                if (isset($old_data[$field_name]) || isset($new_data[$field_name])) {
                    $old_value = isset($old_data[$field_name]) ? $old_data[$field_name] : '';
                    $new_value = isset($new_data[$field_name]) ? $new_data[$field_name] : '';
                    
                    $old_str = (string)$old_value;
                    $new_str = (string)$new_value;
                    
                    if ($old_str !== $new_str) {
                        Core_database_goods_changes_history::save_change(
                            $model,
                            $field_name,
                            $old_value,
                            $new_value,
                            'update'
                        );
                        
                        $changes_count++;
                        $changed_fields[] = $field_name;
                    }
                }
            }
            
            $field_model = isset($arguments['field_model']) ? $arguments['field_model'] : '';
            $out["message"] = "Элемент " . $field_model . " (ID: $element_id) сохранен. Изменений: $changes_count";
            $out["element_id"] = $element_id;
            $out["success"] = true;
            $out["changes_count"] = $changes_count;
            
            return $out;
        } else {
            $out["message"] = "Ошибка! Элемент не сохранен! " . mysqli_error($mysqli_db);
            $out["success"] = false;
            return $out;
        }
    }

    public function delete_product_element($id) {
        if ($id > 0) {
            global $mysqli_db;
            database_connect();
            
            $old_data_query = mysqli_query($mysqli_db, "SELECT * FROM products_all WHERE `index` = " . intval($id));
            if (!$old_data_query) {
                $out["message"] = "Ошибка получения данных: " . mysqli_error($mysqli_db);
                $out["success"] = false;
                return $out;
            }
            
            $old_data = mysqli_fetch_assoc($old_data_query);
            
            if (!$old_data) {
                $out["message"] = "Элемент с ID " . $id . " не найден!";
                $out["success"] = false;
                return $out;
            }
            
            $model = isset($old_data['model']) ? $old_data['model'] : '';
            $h1 = isset($old_data['h1']) ? $old_data['h1'] : '';
            
            $query = "DELETE FROM `products_all` WHERE `index` = " . intval($id);
            $result = mysqli_query($mysqli_db, $query);
            
            if ($result) {
                if (!empty($model)) {
                    $description = 'Товар удален';
                    if (!empty($h1)) {
                        $description .= ': ' . $h1;
                    }
                    
                    Core_database_goods_changes_history::save_change(
                        $model,
                        'DELETE',
                        $description,
                        '',
                        'delete'
                    );
                }
                
                $out["message"] = "Элемент " . $id . " удален.";
                $out["success"] = true;
                return $out;
            } else {
                $out["message"] = "Ошибка! Элемент " . $id . " не удален! " . mysqli_error($mysqli_db);
                $out["success"] = false;
                return $out;
            }
        }
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
}