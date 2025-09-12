<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/sc/lib_new_includes/inc_dbconnect.php');
global $db;

youWatchedPanel::getInstance($db);
class YouWatchedPanel {
    private static $db;
    private static $currentCookie;
    private static $currentUrl;
    private static $listOfWatchedProducts;
    protected static $_instance;
    //
    public static function printProduct($arrProduct, $position) {

        ?><div class="YouWatchedProductItem">
            <?


        $arrProduct['url'] = str_replace("www.rusavtomatika.com", $_SERVER["HTTP_HOST"], $arrProduct['url']); ?>


            <a href="<?= $arrProduct['url'] ?>">
        <?if( isset($arrProduct['preview_image']) and $arrProduct['preview_image'] != ""):?><span style="background-image: url('<?= $arrProduct['preview_image'] ?>')" class="YouWatchedProductItem_preview_image"></span><?endif;?>
                <span class="YouWatchedProductItem_title"><?= $arrProduct['title'] ?></span>
            </a>
            <span class="button_delete_from_list" data-position="<?=$position?>" data-rel="<?= $arrProduct['product_identifier'] ?>"></span>
        </div>
            <?
    }

    public static function printItself() {
        if (self::$currentCookie and isset(self::$listOfWatchedProducts) and is_array(self::$listOfWatchedProducts) and count(self::$listOfWatchedProducts)>0){
        echo '<div class="ListOfWatchedProducts closed">';
        echo '<div class="ListOfWatchedProducts_title">Вы смотрели</div>';
        echo '<div class="ListOfWatchedProducts_viewport">';
        self::printListOfWatchedProducts();
        echo "</div>";
        echo '<div class="ListOfWatchedProducts_clear_button">Очистить список</div>';
        echo "</div>";
        }
        echo "<script>";
        include_once 'functions_you_watched_panel.js';
        echo "</script>";
    }

    private function __construct() {
        self::$listOfWatchedProducts = array();
        $currentUrl = explode("?", $_SERVER['REQUEST_URI']);

        self::$currentUrl = "https://www.rusavtomatika.com".$currentUrl[0];
        if (isset($_COOKIE["listOfWatchedProducts"])){
            self::$currentCookie = $_COOKIE["listOfWatchedProducts"];
            self::$currentCookie = preg_replace('/,{2,}/', ',', trim(self::$currentCookie, ','));
        }
        else{
            setcookie("listOfWatchedProducts", "", time() + 31622400, "/");
        }
        if (self::$currentCookie){
            self::$listOfWatchedProducts = explode(",", self::$currentCookie);
        }

        self::addElementToListOfWatchedProducts();
    }

    public static function printListOfWatchedProducts() {
        if (is_array(self::$listOfWatchedProducts) and count(self::$listOfWatchedProducts) > 0) {
            $counter=0;
            foreach (self::$listOfWatchedProducts as $element) {
                $arrProduct = self::getElementInfoByProductIdentifier($element);
                if(isset($arrProduct) and is_array($arrProduct) and count($arrProduct)>0){
//                    if(isset($arrProduct['preview_image']) and $arrProduct['preview_image'] != ""){
                    self::printProduct($arrProduct, $counter++);
                }
            }
        }
    }
    public static function addElementToListOfWatchedProducts() {
        $element = self::getElementInfoByUrl(self::$currentUrl);
        if (!isset($element['product_identifier']))
            return;
        if (is_array(self::$listOfWatchedProducts) and count(self::$listOfWatchedProducts) > 0) {
            $key = array_search($element['product_identifier'], self::$listOfWatchedProducts);
            if ($key !== FALSE) {
                unset(self::$listOfWatchedProducts[$key]);
            }
            array_unshift(self::$listOfWatchedProducts, $element['product_identifier']);
            self::$currentCookie = implode(",", self::$listOfWatchedProducts);
            setcookie("listOfWatchedProducts", self::$currentCookie, time() + 31622400, "/");
        } else {
            self::$currentCookie = $element['product_identifier'];
            array_unshift(self::$listOfWatchedProducts, $element['product_identifier']);
            setcookie("listOfWatchedProducts", self::$currentCookie, time() + 31622400, "/");
        }
    }

    public static function getElementInfoByProductIdentifier($product_identifier) {
        global $mysqli_db;
        $query = "SELECT `url_original`,`h1`,`product_identifier`,`preview_image` "
                . "FROM `search_index_pages` where `product_identifier` = '$product_identifier';";
        $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
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
    public static function getElementInfoByUrl($page_id) {
        global $mysqli_db;

        $page_id = str_replace('"', '', $page_id);
        $page_id = str_replace("'", '', $page_id);
        
        $out = array();
        if (is_numeric($page_id)) {
            $query = "SELECT `id`,`url`,`url_original`,`h1`,`product_identifier`,`preview_image` FROM `search_index_pages` where `id` = '$page_id';";
        } else {
            $query = "SELECT `id`,`url`,`url_original`,`h1`,`product_identifier`,`preview_image` FROM `search_index_pages` where `url` = '$page_id' or `url_original` = '$page_id';";
        }

            $result = mysqli_query($mysqli_db, $query) or die("Invalid query: " . $query . " error: " . mysqli_error($mysqli_db));
            if (mysqli_num_rows($result) == 0) {
                return array();
            }
            $element = mysqli_fetch_array($result);

        if (isset($element['product_identifier']) and $element['product_identifier'] != ''){
           $out['product_identifier'] = $element['product_identifier'];
           $out['title'] = $element['h1'];
           $out['preview_image'] = $element['preview_image'];
           $out['url'] = $element['url_original'];
        }
        return $out;
    }

    public static function getInstance($db) {
        if (self::$_instance === null) {
            self::$_instance = new self;
            self::$db = $db;
        }

        return self::$_instance;
    }

    private function __clone() {

    }

    private function __wakeup() {

    }

}
?>
