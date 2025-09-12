<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/sc/lib_new_includes/inc_dbconnect.php');


global $mysqli_db;

//if((!isset($current_model) or $current_model != '') and isset($r->model) and $r->model != '')$current_model = $r->model;


class LinkedProducts {

    protected static $_instance;
    private static $_db;
    private static $_current_model;

    private static function __constructor() {
        
    }

    public static function printPanel($model, $mysqli_db) {
        
        if (self::$_instance === null) {
            self::$_instance = new self;
            self::$_db = $mysqli_db;
        }
        
        self::$_current_model = $model;
        $arrLinkedModels = self::getLinkedModels();

        if (is_array($arrLinkedModels)) {
            ?>
<!-- nosearch -->
            <div class="panelLinkedModels">
                <div class="blockofcols_container">
                    <div class="blockofcols_row">
                        <div class="col-2"><div class="panelLinkedModels_title">— этим товаром<br>часто покупают:</div></div>
                        <div class="col-10">
                            <div class="horizontal_slider_default">
                            <div id="carouselhAuto">
                        
                        <? 
                        $totalItems = count($arrLinkedModels);
                        $counter_totalItems = 0;
                        foreach ($arrLinkedModels as $model) {
                            $url_for_link = str_replace("www.rusavtomatika.com", $_SERVER["HTTP_HOST"], $model["url"]);
                            if (!(isset($model["url"]) and $model["url"] != "")) continue;
                            $counter_totalItems ++;
                            ?>
                            <div class="panelLinkedModels_item">
                                <a href="<?= $url_for_link ?>">
                                    <span class="panelLinkedModels_picture" style="background-image: url('<?= $model["preview_image"] ?>')"></span>
                                    <span class="panelLinkedModels_ItemTitle"><?= $model["title"] ?></span>
                                </a>
                            </div>
                            <?
                        }
                        ?></div></div>
                        </div>
                        <div class="panelLinkedModels_topline"></div>
                        <div class="panelLinkedModels_bottomline"></div>
                    </div>                    
                </div>
            </div>
<!-- /nosearch -->
<style type="text/css">
.horizontal_slider_default{margin-right: -20px;}
    /*√оризонтальна€ карусель CSS*/
    .jscarousal-horizontal{
        width: 100%;  /* ширина и высота коробки дл€ слайдов */
        box-sizing: border-box;        
        height: 63px;
        margin: 0;
        padding: 0;
        padding: 2px 0px 2px 41px;
        position: relative;
    }
    .jscarousal-contents-horizontal{
        width: 100%;  /* ширина и высота области где слайды */
        height: 63px;
        float: left;
        position: relative;
        overflow: hidden;}

    .jscarousal-horizontal-back, .jscarousal-horizontal-forward{
        position: absolute;
        z-index: 10;
        width: 30px;
        height: 50px;
        margin-top: -23px;
        
        background-position:center;
        background-repeat: no-repeat;
        
        top: 50%;
        cursor: pointer;
        opacity: 0.6;
        transition: 0.2s;
    }
    .jscarousal-horizontal-back.active, .jscarousal-horizontal-forward.active{
        background-color: #555;
    }    
    .jscarousal-horizontal-back{
        background-image: url(/images//arr-left-gray.png);
        background-repeat: no-repeat;
        left: 7px;
    }
    .jscarousal-horizontal-forward{
        background-image: url(/images/arr-right-gray.png);
        right:7px;
    }

    .jscarousal-horizontal-back:hover, .jscarousal-horizontal-forward:hover{
        opacity: 1;
    }


    .jscarousal-contents-horizontal > div{
        position: absolute;
        width: 100%;}
    .jscarousal-contents-horizontal > div > div{
        float: left;
        margin-left: 0px;
        margin-right: 0px;}
    /*√оризонтальна€ карусель CSS*/


    /*ќбщие*/
    .hidden{	display: none;    }
    .visible{	display: block;}
    .thumbnail-active{
        filter: alpha(opacity=100);
        opacity: 1.0;
        cursor: pointer;}
    .thumbnail-inactive{
        filter: alpha(opacity=95);
        opacity: 0.95;
        cursor: pointer;}
    .thumbnail-text {
        color: #E0E0E0;
        font-weight: bold;
        text-align: left;
        display: block;
        padding: 2px 2px 2px 0px;
        line-height: 16px;
        font-size: 12px;
    }
    .thumbnail-text a{
        color: #E0E0E0; text-decoration: none;    font-size: 12px;}
    .thumbnail-text a:hover{
        color: #fff;}
</style>
<script src="/cms/components/vertical_slider/templates/default/jsCarousel-2.0.0.js" type="text/javascript"></script>
<? if ($counter_totalItems > 4):?>
<script type="text/javascript">
    $(document).ready(function () {
//¬ертикальна€
        $('#carouselhAuto').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //функци€ при нажатии на картинку
            autoscroll: true, //вкл/выкл автопрокрутку
            itemstodisplay: 4, //сколько слайдов отображать
            scrollspeed: 600, //врем€ эффекта прокрутки
            delay: 7000, //врем€ прокрутки слайдов
            orientation: 'h', //горизонтальна€ h или вертикальна€ v карусель
            circular: false
        });
    });
</script>
<?endif;?>
                <?
        }else{echo "<br>";}
    }

    private static function getLinkedModels() {
        $arrLinkedProducts = self::getElementLinkedProducts();
        
        if (is_array($arrLinkedProducts)) {
            foreach ($arrLinkedProducts as $model) {

                if ($model != "")
                {
                    $modelInfo = self::getElementInfoByProductIdentifier($model);
                    if (is_array($modelInfo)){$out[]=$modelInfo;}
                }                
            }
            return $out;
        }
    }
    
    
private static function getElementInfoByProductIdentifier($product_identifier) {
        $query = "SELECT `url_original`,`h1`,`product_identifier`,`preview_image` "
                . "FROM `search_index_pages` where `product_identifier` = '$product_identifier';";
        $result = mysqli_query(self::$_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error(self::$_db));
        if (mysqli_num_rows($result) == 0) {
            return array();
        }        
        $element = mysqli_fetch_array($result);
        
        if ($element){
           $out['product_identifier'] = $element['product_identifier'];
           $out['title'] = $element['h1'];
           $out['preview_image'] = $element['preview_image'];
           $out['url'] = $element['url_original'];           
        }
        
        return $out;        
    }

    public static function getElementLinkedProducts() {
        
        $query = "SELECT `index`,`model`,`linked_products` FROM `products_all` "
                . "where `model` = '".self::$_current_model."' and `linked_products` != '';";
        $result = mysqli_query(self::$_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error(self::$_db));
        if (mysqli_num_rows($result) == 0) {
            return FALSE;
        }
        $element = mysqli_fetch_array($result);
        if ($element['linked_products']) {
            $arrLinkedProducts = explode(",", $element['linked_products']);
            foreach ($arrLinkedProducts as $item) {
                $out[] = trim($item);
            }
        }
        return $out;
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}

 
