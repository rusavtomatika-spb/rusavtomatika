<?php

if (!isset($arguments['table'])) {
    $arguments['table'] = '';
}

if ($arguments['table'] === 'videos') {
    $code = isset($arguments['component_route_params']['detail'])
        ? $arguments['component_route_params']['detail']
        : '';

    $arResult['element'] = array();
    if ($code !== '') {
        $rows = CoreApplication::get_rows_from_table(
            'videos',
            '*',
            "`code` = '" . addslashes($code) . "'",
            '',
            '1'
        );
        if (isset($rows[0])) {
            $arResult['element'] = $rows[0];
        }
    }
} else {
    $DB_WORK_NEWS_DETAIL = new C_DB_WORK_NEWS_DETAIL();

    if (!isset($arguments['name_of_code_field'])) {
        $arguments['name_of_code_field'] = 'sys_name';
    }

    $arResult = $DB_WORK_NEWS_DETAIL->get_element_by_code(
        $arguments['component_route_params']['detail'],
        $arguments['table'],
        $arguments['name_of_code_field']
    );
}

class C_DB_WORK_NEWS_DETAIL
{
    public function get_element_by_code($code, $table, $name_of_code_field = 'sys_name')
    {
        global $mysqli_db, $arguments;

        if (strpos($code, '.php') !== false) {
            $code = str_replace('.php', '', $code);
            header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/' . $arguments['root_folder_url'] . '/' . $code . '/');
            exit();
        }

        $query = "SELECT * FROM `$table` WHERE `" . $name_of_code_field . "` = '" . addslashes($code) . "'";
        $result = mysqli_query($mysqli_db, $query);

        if (!$result) {
            die('INVALID QUERY: ' . $query . ' ' . mysqli_error($mysqli_db) . ' <br>FILE: ' . __FILE__ . ' <br>LINE: ' . __LINE__);
        }

        if (mysqli_num_rows($result) === 0) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            header('Location: https://' . $_SERVER['HTTP_HOST'] . '/404.php');
            exit();
        }

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (isset($row['date'])) {
            $row['date'] = date('d.m.Y', strtotime($row['date']));
        }

        return $row;
    }
}