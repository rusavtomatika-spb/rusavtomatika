<?php

class Core_database_products_all_history
{
    private static $history_table = 'products_all_history';
    
    public static function get_changes_count_by_date($date)
    {
        global $mysqli_db;
        
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
            return [
                'total_changes' => 0, 
                'affected_products' => 0,
                'updates' => 0,
                'inserts' => 0,
                'deletes' => 0
            ];
        }
        
        return mysqli_fetch_assoc($result);
    }
    
    public static function get_detailed_changes($date, $limit = 50)
    {
        global $mysqli_db;
        
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
                    h.user_ip,
                    h.admin_user,
                    p.brand, 
                    p.type, 
                    p.series, 
                    p.pic_small
                FROM `" . self::$history_table . "` h
                LEFT JOIN products_all p ON h.model = p.model
                WHERE DATE(h.changed_at) = '" . $date . "'
                ORDER BY h.changed_at DESC
                LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        if (!$result) {
            return [];
        }
        
        $changes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            if (!isset($row['admin_user'])) $row['admin_user'] = '-';
            if (!isset($row['user_ip'])) $row['user_ip'] = '-';
            
            $changes[] = $row;
        }
        
        return $changes;
    }
    
    public static function get_changes_by_period($days = 30)
    {
        global $mysqli_db;
        
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
        
        return $stats;
    }
    
    public static function get_recently_changed_products($limit = 20)
    {
        global $mysqli_db;
        
        $limit = (int)$limit;
        
        $query = "SELECT 
                    h.model,
                    p.brand,
                    p.type,
                    p.series,
                    p.pic_small,
                    MAX(h.changed_at) as last_change,
                    COUNT(*) as total_changes,
                    GROUP_CONCAT(DISTINCT h.field_name SEPARATOR ', ') as changed_fields
                  FROM `" . self::$history_table . "` h
                  LEFT JOIN products_all p ON h.model = p.model
                  WHERE h.field_name NOT IN ('NEW_PRODUCT', 'DELETE')
                  GROUP BY h.model
                  ORDER BY last_change DESC
                  LIMIT " . $limit;
        
        $result = mysqli_query($mysqli_db, $query);
        
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        return $products;
    }
    
    public static function get_product_history($model, $limit = 50)
    {
        global $mysqli_db;
        
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
        
        return $history;
    }
    
    public static function get_top_changed_fields($limit = 20)
    {
        global $mysqli_db;
        
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
        
        return $fields;
    }
}