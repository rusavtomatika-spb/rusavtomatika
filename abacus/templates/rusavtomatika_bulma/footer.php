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
<? if (!defined('IS_LOCAL') || !IS_LOCAL): ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="gno75izSm3" async></script>
<? endif; ?>
<?php if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net'): ?>
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                var script = document.createElement('script');
                script.src = 'https://chatbot.weincloud.net/weinbot-plugin.js';
                script.async = true;
                document.body.appendChild(script);
            }, 3000);
        });
    </script>
    <script>
        (function() {
            function isMobileEmulationMode() {
                const hasMobileUA = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                const hasTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
                const hasCoarsePointer = window.matchMedia('(pointer:coarse)').matches;
                const hasHighDPR = window.devicePixelRatio >= 2;
                const hasMobilePlatform = /iPhone|iPad|iPod|Android/i.test(navigator.platform);
                
                let hasMobileUAData = false;
                if (navigator.userAgentData) {
                    hasMobileUAData = navigator.userAgentData.mobile;
                }
                
                return hasMobileUA || hasMobileUAData || hasMobilePlatform || 
                    (hasTouch && (hasCoarsePointer || hasHighDPR));
            }
            
            function updateBotContainers() {
                const isMobile = isMobileEmulationMode();
                const containers = document.querySelectorAll('[id^="weinbot-agent-container-"]');
                
                containers.forEach(container => {
                    if (isMobile) {
                        container.classList.add('bot-container-mobile');
                        container.style.right = '20px';
                    } else {
                        container.classList.remove('bot-container-mobile');
                        container.style.right = '';
                    }
                });
            }
            
            function updateWidgetPopups() {
                const isMobile = isMobileEmulationMode();
                const popups = document.querySelectorAll('[id^="widget-popup-"]');
                
                popups.forEach(popup => {
                    if (isMobile) {
                        popup.classList.add('widget-popup-mobile');
                        popup.style.bottom = '100px';
                    } else {
                        popup.classList.remove('widget-popup-mobile');
                        popup.style.bottom = '';
                    }
                });
            }
            
            function addStylesToShadow(shadowRoot) {
                if (shadowRoot.querySelector('#custom-bot-styles')) return;
                
                const style = document.createElement('style');
                style.id = 'custom-bot-styles';
                
                function updateStyleContent() {
                    const isMobile = isMobileEmulationMode();
                    
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
                        .fab-style.custom-bot-button p {
                            font-size: 16px !important;
                            color: #fff !important;
                            font-weight: bold !important;
                            font-family: sans-serif !important;
                            margin: 0 !important;
                            padding: 0 !important;
                            text-align: center;
                        }

                        .fab-style.custom-bot-button span {
                            font-size: 12px !important;
                            color: #fff !important;
                        }
                        
                        .fab-style.custom-bot-button.mobile-emulation {
                            width: 65px !important;
                            height: 65px !important;
                            margin-right: 0 !important;
                            margin-bottom: 30px !important;
                            min-width: 65px !important;
                            max-width: 65px !important;
                            padding: 0 !important;
                        }
                        
                        .fab-style.custom-bot-button.mobile-emulation p, .fab-style.custom-bot-button.mobile-emulation span {
                            display: none !important;
                        }
                        
                        .fab-style.custom-bot-button.mobile-emulation img {
                            width: 40px !important;
                            height: 40px !important;
                            margin: 0 auto !important;
                        }
                        
                        ${isMobile ? '.popup-style { bottom: 100px !important; }' : ''}
                    `;
                }
                
                updateStyleContent();
                shadowRoot.appendChild(style);
                
                style.updateCallback = updateStyleContent;
                
                updateButtonClass(shadowRoot);
            }
            
            function updateButtonClass(shadowRoot) {
                const isMobile = isMobileEmulationMode();
                const button = shadowRoot.querySelector('.fab-style');
                
                if (button) {
                    if (isMobile) {
                        button.classList.add('mobile-emulation');
                        button.classList.remove('desktop-emulation');
                    } else {
                        button.classList.add('desktop-emulation');
                        button.classList.remove('mobile-emulation');
                    }
                }
            }
            
            function customizeBotButton() {
                document.querySelectorAll('[id^="weinbot-agent-container-"]').forEach(container => {
                    if (container.shadowRoot) {
                        if (!container.shadowRoot.querySelector('#custom-bot-styles')) {
                            addStylesToShadow(container.shadowRoot);
                        }
                        
                        const button = container.shadowRoot.querySelector('.fab-style');
                        
                        if (button && !button.classList.contains('customized')) {
                            const originalImg = button.querySelector('img');
                            
                            if (originalImg) {
                                const imgSrc = originalImg.src;
                                
                                button.innerHTML = '';
                                
                                const img = document.createElement('img');
                                img.src = imgSrc;
                                img.alt = 'Chat Agent';
                                
                                const text = document.createElement('p');
                                text.innerHTML = 'Бот от Weintek Labs<br><span>Только технические вопросы</span>';
                                
                                button.appendChild(img);
                                button.appendChild(text);
                                
                                button.classList.add('custom-bot-button', 'customized');
                                
                                updateButtonClass(container.shadowRoot);
                            }
                        }
                    }
                });
            }
            
            function updateAllShadowStyles() {
                const isMobile = isMobileEmulationMode();
                
                document.querySelectorAll('[id^="weinbot-agent-container-"]').forEach(container => {
                    if (container.shadowRoot) {
                        const style = container.shadowRoot.querySelector('#custom-bot-styles');
                        if (style && style.updateCallback) {
                            style.updateCallback();
                        }
                        
                        updateButtonClass(container.shadowRoot);
                    }
                });
            }
            
            const containerStyles = document.createElement('style');
            containerStyles.textContent = `
                [id^="weinbot-agent-container-"].bot-container-mobile {
                    right: 20px !important;
                }
                
                [id^="widget-popup-"].widget-popup-mobile {
                    bottom: 100px !important;
                }
            `;
            document.head.appendChild(containerStyles);
            
            customizeBotButton();
            updateBotContainers();
            updateWidgetPopups();
            
            let lastIsMobile = isMobileEmulationMode();
            setInterval(() => {
                const currentIsMobile = isMobileEmulationMode();
                if (currentIsMobile !== lastIsMobile) {
                    lastIsMobile = currentIsMobile;
                    
                    customizeBotButton();
                    updateBotContainers();
                    updateWidgetPopups();
                    updateAllShadowStyles();
                }
            }, 500);
            
            const observer = new MutationObserver(() => {
                customizeBotButton();
                updateBotContainers();
                updateWidgetPopups();
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