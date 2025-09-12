<?php

namespace abacus\admin\classes;

use abacus\admin\classes\Config;

class Database
{
    private $db;

    public function __construct()
    {
        $this->db = mysqli_connect(
            "localhost",
            Config::$database_credentials["db_user"],
            Config::$database_credentials["db_password"],
            Config::$database_credentials["db_name"]
        );
        if (!$this->db) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit();
        } else mysqli_query($this->db, "SET NAMES utf8");
    }

    public function products_get_list(): array
    {
        $out = [];
        $query = "select * from `test_products_all` order by `index` desc;";
        $result = mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[] = $row;
        }
        return $out;
    }

    public function get_catalog_field_descriptions(): array
    {
        $out = [];
        $query = "select * from `catalog_field_descriptions` order by `id` asc;";
        $result = mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[$row["code"]] = $row;
        }
        return $out;
    }
    public function get_catalog_field_descriptions2(): array
    {
        $out = [];
        $query = "SHOW COLUMNS FROM `test_products_all`";
        $result = mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[$row['Field']] = $row;
        }
        return $out;
    }


    public function product_get($product_id): array
    {
        $out = [];
        $query = "select * from `test_products_all` where `index` = $product_id limit 1;";
        $result = mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        return mysqli_fetch_assoc($result);
    }

    public function product_save($arr_product): bool
    {

        if (intval($arr_product["index"]) > 0) {
            $query = "UPDATE `test_products_all` SET ";
            foreach ($arr_product as $key => $val) {
                if ($key != "index") {
                    $query .= " `$key` = '".addcslashes($val, "'")."', ";
                }
            }
            $query = trim($query, ", ");
            $query .= " WHERE `index` = '" . $arr_product["index"] . "'; ";

            //echo $query = $this->db->real_escape_string($query);
            return mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
            return true;
        } else {
            return false;
        }
    }
    public function product_delete($data): bool
    {

        if (intval($data["index"]) > 0) {
            $query = "DELETE FROM `test_products_all` WHERE `index`= '{$data["index"]}'";
            var_dump_pre($query);
            return mysqli_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);

        } else {
            return false;
        }
    }
    public function product_copy($data): bool
    {

        if (intval($data["index"]) > 0) {
            $query = "CREATE TEMPORARY TABLE tmp SELECT * from test_products_all WHERE `index`='{$data["index"]}'; ALTER TABLE tmp drop `index`; INSERT INTO test_products_all SELECT 0,tmp.* FROM tmp; DROP TEMPORARY TABLE tmp;";
            return mysqli_multi_query($this->db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($this->db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);

        } else {
            return false;
        }
    }


}
