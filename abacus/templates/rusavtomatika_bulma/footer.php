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
<? if (!defined('IS_LOCAL') || !IS_LOCAL): ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="gno75izSm3" async></script>
<? endif; ?>
<!-- <?= "PHP_MAJOR_VERSION " . PHP_MAJOR_VERSION ?> -->
<style>
    <?
    include  $_SERVER["DOCUMENT_ROOT"]."/abacus/templates/rusavtomatika_bulma/bulma/css/bulma.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/abacus/templates/rusavtomatika_bulma/css/template_styles_start.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/abacus/templates/rusavtomatika_bulma/css/template_styles_bulma_overriding.css";
    include  $_SERVER["DOCUMENT_ROOT"]."/abacus/templates/rusavtomatika_bulma/css/template_styles_footer.css";
    //include  $_SERVER["DOCUMENT_ROOT"]."/abacus/templates/rusavtomatika_bulma/css/template_styles_header.css";
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
if (!defined('IS_LOCAL') || !IS_LOCAL) {
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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RK888QLSF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);} 
        gtag('js', new Date());
        gtag('config', 'G-1RK888QLSF');
    </script>
<? };
/*if($_SERVER['HTTP_HOST'] == "www.test.rusavtomatika.com"){
}*/
?>
</body>
</html>
