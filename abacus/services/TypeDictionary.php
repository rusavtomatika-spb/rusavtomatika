<?php
class TypeDictionary
{
    private static $map = null;

    private static function load($sectionCode = '')
    {
        if (self::$map !== null) {
            return;
        }
        self::$map = array();
        $rows = CoreApplication::get_rows_from_table('catalog_types', 'code, short_name, show_filter_in_section', "`active` = '1'", "`position` ASC");
        if (is_array($rows)) {
            foreach ($rows as $row) {
                $code = trim($row['code']);
                $label = trim($row['short_name']);
                if ($code !== '' && $label !== '' && !isset(self::$map[$code])) {
                    self::$map[$code] = $label;
                }
            }
            if ($sectionCode !== '') {
                foreach ($rows as $row) {
                    $code = trim($row['code']);
                    $label = trim($row['short_name']);
                    $sec = trim($row['show_filter_in_section']);
                    if ($code !== '' && $label !== '' && $sec === $sectionCode) {
                        self::$map[$code] = $label;
                    }
                }
            }
        }
    }

    public static function get($code, $sectionCode = '')
    {
        self::load($sectionCode);
        return isset(self::$map[$code]) ? self::$map[$code] : $code;
    }

    public static function all($sectionCode = '')
    {
        self::load($sectionCode);
        return self::$map;
    }
}