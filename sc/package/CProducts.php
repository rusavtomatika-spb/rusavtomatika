<?

namespace tools;
if (!MAIN_FILE_EXECUTED) die();

class CProducts {
    static public $db;

    public static function init(){
        global $mysqli_db;
        self::$db = $mysqli_db;
    }
    public static function getItems($arguments){
        $default_settings = [
            "parent" => "",
            "order" => "sort",
            "order_direction" => "ASC",
            "discontinued" => "0"
        ];


        $diff_arguments = \array_diff_key($default_settings, $arguments);
        $result_arguments = \array_merge($arguments, $diff_arguments); // расширенный список аргументов

        /* Вытаскиваем table и order */
        $counter = 0;
        $custom_sql_query = "";
        foreach ($result_arguments as $key => $value) {
            $value_conditions = '';
            switch ($key) {
                case 'custom_sql_query':
                $custom_sql_query = "$value";
                unset($result_arguments["custom_sql-query"]);
                break;
                case 'table':
                    $table_argument = $value;
                    unset($result_arguments["table"]);
                    break;
                case 'order':
                    $order_argument = $value;
                    unset($result_arguments["order"]);
                    break;
                case 'order_direction':
                    $order_direction = $value;
                    unset($result_arguments["order_direction"]);
                    break;
                default:
                if($counter == 0){
                    $sql_parametrs[] = "`$key` like '$value'";
                }else{
                    $sql_parametrs[] = "and `$key` like '$value'";
                }
                $counter++;
                    break;
            }
        }

        $sql_parametrs = implode(" ", $sql_parametrs);
/*         if(!empty($custom_sql_query)){
            $sql_query = "SELECT * FROM $table_argument WHERE $custom_sql_query order by `$order_argument` ";
        }else{
            $sql_query = "SELECT * FROM $table_argument WHERE $sql_parametrs order by `$order_argument` ";
        }      */
        $sql_query = "SELECT * FROM $table_argument WHERE $sql_parametrs $custom_sql_query order by `$order_argument` $order_direction";
        $result = mysqli_query(self::$db,$sql_query) or die("Invalid query: " . $sql_query . " error: " . mysqli_error(self::$db));

    while ($row = mysqli_fetch_assoc($result)) {

        $arrResult[]=$row;

    }

        if (isset($arrResult) && is_array($arrResult)) return $arrResult;
        else return false;

    }

    public static function show_stock($item) {
        if($item["discontinued"] == '1') {
            $out = "<span style='color:red'>Снято с производства</span> ";
            return $out;
        }

        if ($item["onstock"] == 0 && $item["onstock_spb"] == 0 && $item["onstock_msk"] == 0 && $item["onstock_ptg"] == 0) {
          $sql_query = "SELECT * FROM `products_all` where `parent` like '{$item['model']}'";
          $result = mysqli_query(self::$db,$sql_query) or die("Invalid query: " . $sql_query . " error: " . mysqli_error(self::$db));

          if(!empty($result)){
            while ($row = mysqli_fetch_assoc($result)) {
                $arrResult[]=$row;
            }
            $co = 0;
            if(!empty($arrResult)){
            foreach ($arrResult as $string ) {
              if (($string["onstock_spb"] > 0) or ($string["onstock_msk"] > 0) or ($string["onstock_ptg"] > 0)) {

                  $out = "<div class='onstock2'> <img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp на складе</div>";
                  return $out;
              }

            }
            }
          }

                $out ="<img src='/images/red_sq.gif'>&nbsp;&nbsp;&nbsp;Под заказ";
        }else{
            $co = 0;
            $v = 0;
            $out1 = "";
            if ($item["onstock_spb"] > 0) {
             //   $out1 .= "<span title='Санкт-Петербург' style='cursor:default;'>СПБ</span>";
                $v = 1;
                $co++;
            }

            if ($item["onstock_msk"] > 0) {
                if ($v == 1) {
                    $out1 .= ", ";
                }
              //  $out1 .= "<span title='Москва' style='cursor:default;'>МСК</span>";
                $v = 1;
                $co++;
            }

            if ($item["onstock_ptg"] > 0) {
                if ($v == 1) {
                    $out1 .= ", ";
                }
             //   $out1 .= "<span title='Пятигорск' style='cursor:default;'>ПГСК</span>";
                $co++;
            }


            if ($co == 1)
                $s = "на складе";
            else
                $s = "на складе";
                $out = "<div class='onstock2'> <img src='/images/green_sq.gif' >&nbsp;&nbsp;&nbsp $s  </div>";
        }

         return $out;
    }


    public static function get_imgSrc_small($item){
        $sql_query = "SELECT * FROM gallery WHERE `model` LIKE '{$item["model"]}'";

        $item_model = str_replace("/", "_", $item["model"]);


        $imgRemoteDir = "/images/" . mb_strtolower($item["brand"]) . "/" . mb_strtolower($item["type"]) . "/" . $item_model . "/130/" .  $item_model . "_1.webp";
        /*
        $result = mysqli_query(self::$db,$sql_query) or die("Invalid query: " . $sql_query . " error: " . mysqli_error(self::$db));
        while ($row = mysqli_fetch_assoc($result)) {

            $arrResult[]=$row;
        }
        if(!empty($arrResult[0]["img_path"])){

            switch ($item["brand"] ) {

                case 'APLEX':
                if($item["type"] == 'box-pc'){
                    $out = '/images/aplex/vstraivaemye-kompyutery/'. $item["series"] . '/'. $item["model"] . '/' .  $arrResult[0]["img_path"];
                }
                if($item["type"] == 'monitors'){
                    $out = '/images/' . strtolower($item["brand"]) . '/' . $item["type"] . '/'. $item["series"] . '/'. $item["model"] . '/' .  $arrResult[0]["img_path"];
                }

                    break;

                    case '2N':
                  //  $imm = '/images/skud/'. $item["s_name"] . '/' . get_imgSrc_small($item["model"]);
                  $out = '/images/skud/'. $item["s_name"] . '/' . $arrResult[0]["img_path"];
                        break;
                default:

                $out = '/images/' . strtolower($item["brand"]) . '/' . $item["model"] . '/' . $item["model"] . '_1.png';
                break;
            }

            return $out;
        }*/

        return $imgRemoteDir;
/*         while ($row = mysqli_fetch_assoc($result)) {
            $arrResult[]=$row;
        } */



/*
Легаси функция

$fps_im = "/images/" . strtolower($item["brand"]) . "/" . $item["pic_small"];

    if ($GLOBALS["net"] == 0) {
        if ((file_exists($GLOBALS["path_to_real_files"] . $fps_im)) AND ( !empty($item["pic_small"]))) {

            return $fps_im;
        }
        else {
            $pic = get_big_pic($item["model"]);

            if (!empty($pic) AND ( $pic != '/')) {

                return get_big_pic($item["model"]);
            } else {


                if (file_exists($GLOBALS["path_to_real_files"] . '/images/' . strtolower($item["brand"]) . '/' . $item["model"] . '/' . $item["model"] . '_1.png')) {
                    return '/images/' . strtolower($item["brand"]) . '/' . $item["model"] . '/' . $item["model"] . '_1.png';
                };
            };
        };
    } else {

        $re = cu($GLOBALS["path_to_real_files"] . $fps_im);

        if (($re[0] > 0) AND ( !empty($item["pic_small"]))) {
            return $fps_im;
        } else {
            $pic = get_big_pic($item["model"]);
            if (!empty($pic)) {
                return get_big_pic($item["model"]);
            } else {


                $file = $GLOBALS["path_to_real_files"] . '/images/' . strtolower($item["brand"]) . '/' . $item["model"] . '/' . $item["model"] . '_1.png';
                $re = cu($file);
                if ($re[0] > 0) {
                    return '/images/' . strtolower($item["brand"]) . '/' . $item["model"] . '/' . $item["model"] . '_1.png';
                };
            };
        };



        ;
    };

/*
Конец легаси
*/



    }
}
