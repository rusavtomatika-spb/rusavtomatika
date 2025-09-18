<?php
define("refresh_styles_and_scripts","4".date("dmYH"));
class CoreApplication
{
    public static $arrScripts;
    public static $arrStyles;
    public static $arrBreadcrumbs;

    public function __construct()
    {
        self::$arrScripts = array();
        self::$arrStyles = array();
        self::$arrBreadcrumbs = array();
    }


    public static function test_file_existing_by_url($url)
    {
        //var_dump_pre($url);
        if ($url != "") {
            $urlHeaders = @get_headers($url);
            if (strpos($urlHeaders[0], '200')) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function add_breadcrumbs_chain($anchor, $link = "")
    {
        self::$arrBreadcrumbs[] = ["anchor" => $anchor, "link" => $link];


    }

    public static function add_style($path_to_style) {
        $fixed_path = self::fix_asset_path($path_to_style);
        self::$arrStyles[] = $fixed_path;
    }

    public static function add_script($path_to_script) {
        $fixed_path = self::fix_asset_path($path_to_script);
        self::$arrScripts[] = $fixed_path;
    }

    private static function fix_asset_path($path) {
        $path = str_replace('\\', '/', $path);
        
        $path = str_replace('D:/projects/rusavtomatika/', '', $path);
        $path = str_replace($_SERVER["DOCUMENT_ROOT"] . '/', '', $path);
        
        if (strpos($path, '/') !== 0) {
            $path = '/' . $path;
        }
        
        return $path;
    }

    public static function print_styles_including()
    {
        if (isset(self::$arrStyles) and is_array(self::$arrStyles) and count(self::$arrStyles) > 0) {
            echo '
                ';
            foreach (self::$arrStyles as $item) {
                echo '<link rel="stylesheet" type="text/css" href="' . $item . '" />
                ';
            }
        }
    }

    public static function print_scripts_including()
    {
        if (isset(self::$arrScripts) and is_array(self::$arrScripts) and count(self::$arrScripts) > 0) {
            echo '
                ';
            foreach (self::$arrScripts as $item) {
                echo '<script type="text/javascript" src="' . $item . '"></script>
';
            }
        }
    }

    public static function include_component($arguments)
    {

        include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/{$arguments["component"]}/component.php";
    }

    public static function include_template($arguments)
    {
        $component = $arguments["component"];
        if (!isset($arguments["template"]) or $arguments["template"] == "") $template = "default";
        else $template = $arguments["template"];

        include $_SERVER["DOCUMENT_ROOT"] . "/abacus/components/$component/templates/$template/template.php";
    }

    public static function direct_sql_query($query)
    {
        if($query == '') return array();
        global $mysqli_db;
        $out = array();
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[] = $row;
        }
        return $out;
    }


    public static function get_rows_from_table($table_name, $selected_fields = "", $condition = "", $order = "", $limit = "")
    {

        global $mysqli_db;
        $out = array();
        $query = "SELECT ";
        if ($selected_fields != '') $query .= " " . $selected_fields . " ";
        else $query .= " * ";
        $query .= " FROM " . $table_name . " ";
        if ($condition != '') $query .= " WHERE " . $condition . " ";
        if ($order != '') $query .= " ORDER BY  " . $order . " ";
        if ($limit != '') $query .= " LIMIT  " . $limit . " ";

        /*        var_dump($query);
                echo "<br>";*/

        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        while ($row = mysqli_fetch_assoc($result)) {
            $out[] = $row;
        }

        return $out;
    }

    public static function get_row_by_id($table_name, $element_id, $id_name = "id", $selected_fields = "")
    {
        if(!($element_id > 0) or ($table_name == '')) return array();
        global $mysqli_db;
        $query = "SELECT ";
        if ($selected_fields != '') $query .= " " . $selected_fields . " ";
        else $query .= " * ";
        $query .= " FROM " . $table_name . " ";
        $query .= " WHERE " . $id_name . " = '".$element_id."'";
        $result = mysqli_query($mysqli_db, $query) or die("INVALID QUERY: " . $query . "  " . mysqli_error($mysqli_db) . " <br>FILE: " . __FILE__ . " <br>LINE: " . __LINE__);
        return  mysqli_fetch_assoc($result);
    }


    public static function get_cache_content($url)
    {
        $CACHE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/cache/";
        $path = preg_replace("/\/|\?|=/", '_', $url);
        $file = $CACHE_PATH . $path . ".html";
        if (file_exists($file)) {
            return file_get_contents($file);
        } else return '';
    }

    public static function print_pictures_in_detail_template($brand, $type, $model, $pics_number)
    {
        $imgRemoteDir = "/images/" . mb_strtolower($brand) . "/" . mb_strtolower($type) . "/" . $model . "/";

        if ($pics_number > 0) {
            for ($x = 1; $x <= ($pics_number); $x++) {
                $new_path_picture[] = $model . "_" . $x . ".webp";
            }
        }
        ob_start();
        ?>
        <div class="component_catalog_detail__wrapper">
            <? $counter = 1; ?>
            <? foreach ($new_path_picture as $image_url): ?>
                <a class="component_catalog_detail__image-main_link"
                   id="component_catalog_detail__image-main_link_<?= $counter++ ?>"
                   style="display: none;" data-fancybox="product"
                   data-caption="<?= $brand . " " . $model ?>"
                   href="<? echo $imgRemoteDir . "1330/" . $image_url ?>">
                    <img class="img_product-inner" src="<? echo $imgRemoteDir . "580/" . $image_url ?>"
                         alt="<?= $model ?>">
                </a>
            <? endforeach; ?>
            <? if ($model == "FLEXY205" || $model == "COSY131"): ?>
                <div class="3d-panel component_catalog_detail__image-main_link"
                     id="component_catalog_detail__image-main_link_0"
                     style="display: none;width: 450px;margin:0 auto;height: 300px;box-shadow: 0 0 9px 0px rgba(0,0,0,0.2);">
                    <? include $_SERVER["DOCUMENT_ROOT"] . "/3D/component/index.php"; ?>
                </div>
            <? endif; ?>
            <div class="component_catalog_detail__images-mini__wrapper">
                <div class="component_catalog_detail__images-mini__inner">
                    <?
                    $counter = 1;
                    foreach ($new_path_picture as $image_url):?>
                        <div data-rel="component_catalog_detail__image-main_link_<?= $counter++ ?>"
                             class="component_catalog_detail__images-mini">
                            <img src="<? echo $imgRemoteDir . "67/" . $image_url; ?>" alt=""/>
                        </div>
                    <? endforeach; ?>
                    <? if ($model == "FLEXY205" || $model == "COSY131"): ?>
                        <div data-rel="component_catalog_detail__image-main_link_0"
                             class="component_catalog_detail__images-mini launch_3d"
                             style="background-image:url('/3D/assets/ewon/FLEXY205/prev_icon.gif');"></div>
                    <? endif; ?>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $(".component_catalog_detail__images-mini").bind("click", function () {
                    data_rel = $(this).attr("data-rel");
                    $(".component_catalog_detail__images-mini").removeClass("active");
                    $(this).addClass("active");
                    $(".component_catalog_detail__image-main_link").hide();
                    $("#" + data_rel).show();
                });
                $(".component_catalog_detail__images-mini__inner .component_catalog_detail__images-mini:first").click();
            });
        </script>
        <?
        $out = ob_get_clean();
        return $out;
    }


}
