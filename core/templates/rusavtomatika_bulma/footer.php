<? if (!defined('PROLOG_INCLUDED')) exit;
if (!$CONTENT_ON_WIDE_SCREEN):
    ?>
    </div>
    </div>
    </div>
<?
endif;
?>
</main>
</div>
<!-- /maincontent -->
<? if ($current_page != '' and $current_page != 'catalog_viewed') { ?>
    <div class="block_viewed">
        <?
        CoreApplication::include_component(["component" => "catalog_viewed_bar"]);
        ?>
    </div>
<?php }
?>
<footer id="footer">
    <div class="padding_wrapper">
        <div class="container is-widescreen">
            <? include "include/inc_footer_content.php" ?>
        </div>
    </div>
</footer>

<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/axios.min.js"></script>
<script type="text/javascript" src="/js/vue-router.js"></script>
<script type="text/javascript" src="/js/vue-meta.min.js"></script>
<!--script type="text/javascript" src="/sc/popup_catalog_menu/popup_catalog_menu.js?r=<?= rand() ?>"></script-->

<?
if ($current_page != ''):
    ?>
    <script type="text/javascript" src="/js/fancybox.umd.js"></script>
<?
endif;
?>
<script type="text/javascript" src="<?= $cms_template_url ?>template_scripts.js"></script>
<!-- <script type="text/javascript" src="/documents/documents.js"></script> -->


<? if ($_SERVER['HTTP_HOST'] != "www.rusavto.moisait.net" && $_SERVER['HTTP_HOST'] != "www.rusavtomatika.valovenko.tmweb.ru"): ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="gno75izSm3" async></script>
    <? /*?>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type="text/javascript">
            (function () {
                var widget_id = '9991';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//code.jivosite.ru/script/widget/' + widget_id;
                var ss = document.getElementsByTagName('script')[0];
                ss.parentNode.insertBefore(s, ss);
            })();</script> <div id='jivo_copyright' style='display: none'>Модуль <a href='http://www.jivosite.ru' target='_blank'>онлайн консультант</a><br> работает на JivoSite</div>
        <!-- {/literal} END JIVOSITE CODE -->
        <?*/ ?>
<? endif; ?>


<!-- <?= "PHP_MAJOR_VERSION " . PHP_MAJOR_VERSION ?> -->

<style>
    <?
    include  $_SERVER["DOCUMENT_ROOT"]."/core/templates/rusavtomatika_bulma/bulma/css/bulma.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/core/templates/rusavtomatika_bulma/css/template_styles_start.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/core/templates/rusavtomatika_bulma/css/template_styles_bulma_overriding.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/core/templates/rusavtomatika_bulma/css/template_styles_footer.css";


    //include  $_SERVER["DOCUMENT_ROOT"]."/core/templates/rusavtomatika_bulma/css/template_styles_header.css";
    ?>
</style>

<link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>tiny-slider/tiny-slider.css"/>
<script type="text/javascript" src="<?= $cms_template_url ?>tiny-slider/tiny-slider.js"></script>
<!-- print_styles_including -->
<?
CoreApplication::print_styles_including();
CoreApplication::print_scripts_including();
?>
<div id='mes_backgr'></div>
<link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>css/last_css.css"/>


<?php
if ($_SERVER['HTTP_HOST'] != "www.rusavto.moisait.net") {
    ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(114217, "init", {
            id: 114217,
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/114217" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
<? };

/*if($_SERVER['HTTP_HOST'] == "www.test.rusavtomatika.com"){

}*/

?>


</body>
</html>


