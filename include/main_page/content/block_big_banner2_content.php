<?php
define('PROLOG_INCLUDED', true);
if(!defined('bullshit')) {
    define('bullshit', 1);
}
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/init.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/config.php';

/*define('ROUTE_STRING', (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "");
define('URL_PATH_TO_PRODUCT_PICTURES', "/images/");*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/sc/dbcon.php";
require_once $_SERVER["DOCUMENT_ROOT"] . '/core/config.php';
include_once($_SERVER['DOCUMENT_ROOT'] . "/sc/lib_new.php");
require_once CORE_PATH . '/application/CoreApplication.php';

?>
<section class="big_slider_block" style="display: none">
    <?
    $arguments["component"] = "big_slider";
    $arguments["template"] = "big_slide_banner";
    CoreApplication::include_component($arguments);
    $arguments["component"] = "news_slider";
    $arguments["template"] = "brands_gallery_tray";
    CoreApplication::include_component($arguments);
    ?>
</section>
<script>
    if ($('#glide_brands_gallery_tray').length > 0) {
        new Glide('#glide_brands_gallery_tray',
            {
                type: 'carousel',
                startAt: 0,
                perView: 5,
                gap: 15,
                autoplay: false,
                focusAt: 0,
                breakpoints: {
                    1199: {
                        perView: 5,
                    },
                    768: {
                        autoplay: 3000,
                        perView: 4,
                        gap: 2,
                    },
                    480: {
                        perView: 3,
                        gap: 1,
                    }
                }
            }).mount();
    }

</script>

