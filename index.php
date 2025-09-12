<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = true;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

CoreApplication::add_style("/include_utf_8/main_page/main_page_styles.css");
CoreApplication::add_style("/include_utf_8/main_page/js/glide-master/dist/css/glide.core.min.css");
CoreApplication::add_style("/include_utf_8/main_page/css/cloud.css");
CoreApplication::add_script("/include_utf_8/main_page/js/glide-master/dist/glide.min.js");
CoreApplication::add_script("/include_utf_8/main_page/js/main_page_scripts.js");
CoreApplication::add_script("/include_utf_8/main_page/js/cloud.js");


?>
    <article>


        <div class="mb-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_now_in_stock.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="has-background-light pt-5 mb-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_news.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_catalog.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="has-background-light py-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_video.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_new_products.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="has-background-light">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_cloud_tags.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        include "./include_utf_8/main_page/content/block_remote_monitorings.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="has-background-light py-5">
        <div class="container is-widescreen">
            <div class="columns">
                <div class="column is-12">
                    <?
                    include "./include_utf_8/main_page/content/block_spheres.php";
                    include "./include_utf_8/main_page/content/block_spheres_cloud_tags.php";
                    ?>
                </div>
            </div>
        </div>
        </div>
        <!--div class="py-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">
                        <?
                        //include "./include_utf_8/main_page/content/block_production.php";
                        //include "./include_utf_8/main_page/content/block_partners.php";
                        ?>
                    </div>
                </div>
            </div>
        </div-->

        <!--div class="container is-widescreen block_certificates">
            <div class="columns">
                <div class="column is-12">
                    <?
        //include "./include_utf_8/main_page/content/block_certificates.php";
        ?>
                </div>
            </div>
        </div-->
        <div class="py-5">
            <div class="container is-widescreen">
                <div class="columns">
                    <div class="column is-12">

                        <?
                        include "./include_utf_8/main_page/content/block_company_pluses.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?
        //include "./include_utf_8/main_page/content/block_contacts.php";
        ?>



    </article>
<?php



global $TITLE, $DESCRIPTION, $KEYWORDS;
$TITLE = "Поставщик оборудования для промышленной автоматизации Weintek, Aplex, Samkoon, IFC со склада по доступным ценам";
$DESCRIPTION = "Официальный дистрибьютор Weintek, Samkoon, Aplex, IFC, панели оператора, операторские панели, промышленные панельные компьютеры, поставки со склада, техподдержка";
$KEYWORDS = "операторская панель, панель оператора, промышленные компьютеры, промышленные панельные компьютеры, промышленные компьютеры цена, промышленные компьютеры заказ, безвентиляторные промышленные компьютеры, встраиваемые компьютеры, автоматизация оборудования, разработка ПО, операторские панели, панели оператора, сенсорные панели, HMI, Weintek, EasyView, интерфейс, пользовательский интерфейс, графический интерфейс, дисплей, сенсорный дисплей, бесплатное ПО, ewon, IFC, Samkoon, Aplex";



// checking currencies
$now = time();
$usdrate_time = filemtime($_SERVER['DOCUMENT_ROOT'] . "/usdrate.txt");
if($now - $usdrate_time > 10800){ // each 3 hours (10800)
    include('get_usd_rate.php');
    

}
// end checking currencies



require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";