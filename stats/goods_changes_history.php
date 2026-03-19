<?php

class Core_database_goods_changes_history
{
    private static $history_table = 'goods_changes_history';
    
    private static function get_main_db_connection() {
        $db_host = 'localhost';
        $db_user = 'moisait_ilval';
        $db_pass = 'ilval2398';
        $db_name = 'moisait_weintek';
        
        $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
        if (!$connection) {
            error_log("Main DB connection failed: " . mysqli_connect_error());
            return false;
        }
        
        mysqli_set_charset($connection, "utf8");
        return $connection;
    }
    
    private static function get_current_user() {
        if (!isset($_COOKIE['admin_token'])) {
            return null;
        }
        
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) {
            return null;
        }
        
        $token = mysqli_real_escape_string($mysqli_db, $_COOKIE['admin_token']);
        
        $query = "SELECT id, username FROM admins WHERE auth_token = '$token' LIMIT 1";
        $result = mysqli_query($mysqli_db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            mysqli_close($mysqli_db);
            return $user;
        }
        
        mysqli_close($mysqli_db);
        return null;
    }
    
    public static function save_change($model, $field_name, $old_value, $new_value, $action_type = 'update', $user_id = null, $username = null)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return false;
        
        $model = mysqli_real_escape_string($mysqli_db, $model);
        $field_name = mysqli_real_escape_string($mysqli_db, $field_name);
        $old_value = mysqli_real_escape_string($mysqli_db, $old_value);
        $new_value = mysqli_real_escape_string($mysqli_db, $new_value);
        $action_type = mysqli_real_escape_string($mysqli_db, $action_type);
        
        if ($user_id === null || $username === null) {
            $user = self::get_current_user();
            if ($user) {
                $user_id = $user['id'];
                $username = $user['username'];
            } else {
                $user_id = 'NULL';
                $username = 'NULL';
            }
        } else {
            $user_id = (int)$user_id;
            $username = "'" . mysqli_real_escape_string($mysqli_db, $username) . "'";
        }
        
        $query = "INSERT INTO `" . self::$history_table . "` 
                (model, field_name, old_value, new_value, action_type, user_id, username, changed_at) 
                VALUES 
                ('$model', '$field_name', '$old_value', '$new_value', '$action_type', $user_id, $username, NOW())";
        
        $result = mysqli_query($mysqli_db, $query);
        
        mysqli_close($mysqli_db);
        return $result;
    }
    
    public static function get_changes_count_by_date($date)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return false;
        
        $date = mysqli_real_escape_string($mysqli_db, $date);
        
        $query = "SELECT 
                    DATE(changed_at) as change_date,
                    COUNT(*) as total_changes,
                    COUNT(DISTINCT model) as affected_products,
                    SUM(CASE WHEN action_type = 'update' THEN 1 ELSE 0 END) as updates,
                    SUM(CASE WHEN action_type = 'insert' THEN 1 ELSE 0 END) as inserts,
                    SUM(CASE WHEN action_type = 'delete' THEN 1 ELSE 0 END) as deletes
                  FROM `" . self::$history_table . "` 
                  WHERE DATE(changed_at) = '" . $date . "'
                  GROUP BY DATE(changed_at)";
        
        $result = mysqli_query($mysqli_db, $query);
        if (!$result || mysqli_num_rows($result) == 0) {
            mysqli_close($mysqli_db);
            return [
                'total_changes' => 0, 
                'affected_products' => 0,
                'updates' => 0,
                'inserts' => 0,
                'deletes' => 0
            ];
        }
        
        $data = mysqli_fetch_assoc($result);
        mysqli_close($mysqli_db);
        return $data;
    }
    
    public static function get_detailed_changes($date, $limit = 50)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $date = mysqli_real_escape_string($mysqli_db, $date);
        $limit = (int)$limit;
        
        $query = "SELECT 
                    h.id,
                    h.model,
                    h.changed_at,
                    h.field_name,
                    h.old_value,
                    h.new_value,
                    h.action_type,
                    h.user_id,
                    h.username
                FROM `" . self::$history_table . "` h
                WHERE DATE(h.changed_at) = '" . $date . "'
                ORDER BY h.changed_at DESC
                LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        if (!$result) {
            mysqli_close($mysqli_db);
            return [];
        }
        
        $changes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $changes[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $changes;
    }
    
    public static function get_changes_by_period($days = 30)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $days = (int)$days;
        
        $query = "SELECT 
                    DATE(changed_at) as date,
                    COUNT(*) as total,
                    COUNT(DISTINCT model) as products,
                    SUM(CASE WHEN action_type = 'update' THEN 1 ELSE 0 END) as updates,
                    SUM(CASE WHEN action_type = 'insert' THEN 1 ELSE 0 END) as inserts,
                    SUM(CASE WHEN action_type = 'delete' THEN 1 ELSE 0 END) as deletes
                  FROM `" . self::$history_table . "` 
                  WHERE changed_at >= DATE_SUB(NOW(), INTERVAL " . $days . " DAY)
                  GROUP BY DATE(changed_at)
                  ORDER BY date DESC";
        
        $result = mysqli_query($mysqli_db, $query);
        
        $stats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $stats[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $stats;
    }
    
    public static function get_recently_changed_products($limit = 20)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $limit = (int)$limit;
        
        $query = "SELECT 
                    model,
                    MAX(changed_at) as last_change,
                    COUNT(*) as total_changes,
                    GROUP_CONCAT(DISTINCT field_name SEPARATOR ', ') as changed_fields
                  FROM `" . self::$history_table . "` 
                  WHERE field_name NOT IN ('NEW_PRODUCT', 'DELETE')
                  GROUP BY model
                  ORDER BY last_change DESC
                  LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $products;
    }
    
    public static function get_product_history($model, $limit = 50)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $model = mysqli_real_escape_string($mysqli_db, $model);
        $limit = (int)$limit;
        
        $query = "SELECT * FROM `" . self::$history_table . "` 
                  WHERE model = '" . $model . "'
                  ORDER BY changed_at DESC
                  LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        $history = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $history;
    }
    
    public static function get_top_changed_fields($limit = 20)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $limit = (int)$limit;
        
        $query = "SELECT 
                    field_name,
                    COUNT(*) as change_count,
                    COUNT(DISTINCT model) as products_affected
                  FROM `" . self::$history_table . "` 
                  WHERE field_name NOT IN ('NEW_PRODUCT', 'DELETE')
                  GROUP BY field_name
                  ORDER BY change_count DESC
                  LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        $fields = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $fields[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $fields;
    }
    
    public static function get_user_stats($period = 30)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $period = (int)$period;
        
        $query = "SELECT 
                    COALESCE(username, 'Система') as username,
                    COUNT(*) as total_changes,
                    COUNT(DISTINCT model) as products_affected,
                    SUM(CASE WHEN action_type = 'update' THEN 1 ELSE 0 END) as updates,
                    SUM(CASE WHEN action_type = 'insert' THEN 1 ELSE 0 END) as inserts,
                    SUM(CASE WHEN action_type = 'delete' THEN 1 ELSE 0 END) as deletes,
                    MAX(changed_at) as last_action
                  FROM `" . self::$history_table . "` 
                  WHERE changed_at >= DATE_SUB(NOW(), INTERVAL " . $period . " DAY)
                  GROUP BY username
                  ORDER BY total_changes DESC";
        
        $result = mysqli_query($mysqli_db, $query);
        
        $stats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $stats[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $stats;
    }
    
    public static function get_user_changes($username, $limit = 50)
    {
        $mysqli_db = self::get_main_db_connection();
        if (!$mysqli_db) return [];
        
        $username = mysqli_real_escape_string($mysqli_db, $username);
        $limit = (int)$limit;
        
        $query = "SELECT 
                    h.*
                  FROM `" . self::$history_table . "` h
                  WHERE h.username = '" . $username . "'
                  ORDER BY h.changed_at DESC
                  LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        $changes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $changes[] = $row;
        }
        
        mysqli_close($mysqli_db);
        return $changes;
    }
}