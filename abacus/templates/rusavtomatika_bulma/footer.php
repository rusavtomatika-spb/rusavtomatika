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
<script type="text/javascript" src="/js/vue.js?26022026"></script>
<script type="text/javascript" src="/js/axios.min.js?26022026"></script>
<script type="text/javascript" src="/js/vue-router.js?26022026"></script>
<script type="text/javascript" src="/js/vue-meta.min.js?26022026"></script>
<?php if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net'): ?>
    <script defer src="https://185.106.94.36/weinbot-plugin-1.0.0.js"></script>

    <script>
    (function() {
        function addStylesToShadow(shadowRoot) {
            if (shadowRoot.querySelector('#custom-bot-styles')) return;
            
            const style = document.createElement('style');
            style.id = 'custom-bot-styles';
            style.textContent = `
                .fab-style.custom-bot-button {
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    gap: 10px !important;
                    width: 300px !important;
                    height: auto !important;
                    background: #424867 !important;
                    border-radius: 50px !important;
                    padding: 10px 20px !important;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
                    transition: all 0.3s ease !important;
                    border: none !important;
                    cursor: pointer !important;
                    outline: none !important;
                    color: #fff !important;
                    font-size: 16px !important;
                    font-weight: bold !important;
                    filter: none !important;
                    line-height: normal !important;
                    animation: none !important;
                    margin-right: 10px;
                }
                .fab-style.custom-bot-button:hover {
                    transform: scale(1.05) !important;
                    box-shadow: 0 6px 16px rgba(0,0,0,0.2) !important;
                }
                .fab-style.custom-bot-button img {
                    width: 40px !important;
                    height: 40px !important;
                    border-radius: 50% !important;
                    margin: 0 !important;
                }
                .fab-style.custom-bot-button span {
                    font-size: 16px !important;
                    color: #fff !important;
                    font-weight: bold !important;
                    font-family: sans-serif !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }
            `;
            shadowRoot.appendChild(style);
        }

        function customizeBotButton() {
            document.querySelectorAll('[id^="weinbot-agent-container-"]').forEach(container => {
                if (container.shadowRoot) {
                    addStylesToShadow(container.shadowRoot);
                    
                    const button = container.shadowRoot.querySelector('.fab-style');
                    
                    if (button && !button.classList.contains('customized')) {
                        console.log('Кастомизируем кнопку...');
                        
                        const originalImg = button.querySelector('img');
                        
                        if (originalImg) {
                            const imgSrc = originalImg.src;
                            
                            button.innerHTML = '';
                            
                            const img = document.createElement('img');
                            img.src = imgSrc;
                            img.alt = 'Chat Agent';
                            
                            const span = document.createElement('span');
                            span.textContent = 'Бот от Weintek Labs';
                            
                            button.appendChild(img);
                            button.appendChild(span);
                            
                            button.classList.add('custom-bot-button', 'customized');
                            
                            button.style.cssText = '';
                        }
                    }
                }
            });
        }

        customizeBotButton();
        
        let attempts = 0;
        const interval = setInterval(() => {
            customizeBotButton();
            attempts++;
            
            if (attempts > 20) {
                clearInterval(interval);
            }
        }, 500);
        
        const observer = new MutationObserver(() => {
            customizeBotButton();
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    })();
    </script>
<?php endif; ?>
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