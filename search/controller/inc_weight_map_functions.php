<?php

class WeightMap
{
    protected static $_instance;
    static private $db;

    private function __construct()
    {
        global $mysqli_db;
        self::$db = $mysqli_db;

    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function get_list()
    {
        $query = "SELECT * FROM `search_index_weight_map`";
        $result = mysqli_query(self::$db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($db));
        if (mysqli_num_rows($result) == 0) {
            return FALSE;
        }
        while ($row = mysqli_fetch_array($result)) {
            $out[] = $row;

        }
        return $out;
    }
}
