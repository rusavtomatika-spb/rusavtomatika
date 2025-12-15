<?
if (!defined('PROLOG_INCLUDED')) exit;
/* NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH */
$arrPagesWithNoCash = ["/catalog/favorites/", "/catalog/cart/", "/catalog/viewed/", "/catalog/compare/", "/catalog/search/",];
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];
if (in_array($url, $arrPagesWithNoCash)) {
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Expires: " . date("r"));
}
/* NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH  NO CASH */
global $CONTENT_ON_WIDE_SCREEN;
$cms_template_url = "/abacus/templates/rusavtomatika_bulma/";
$current_page = str_replace("index.php", "", $_SERVER['REQUEST_URI']);
$current_page = str_replace("index2.php", "", $current_page);
$current_page = trim($current_page, "/ ");
$current_page = str_replace("/", "_", $current_page);
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- titles -->
    <meta http-equiv=Content-Type content=text/html; charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/js/jquery-3.6.0.js"></script>
    <script src="/sc/jBox.all.min.js?310120201008"></script>
	<!--script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script-->    <?

    /* ?><title><?= (3.5mm jack ?></title>
      <meta name="description" content="<?= $DESCRIPTION ?>">
      <meta name="keywords" content="<?= $KEYWORDS ?>"><? */ ?>
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>bootstrap-grid.css" /-->
    <link href="/lightbox/css/lightbox.css" rel="stylesheet"/>
    <link href="/abacus/templates/rusavtomatika_bulma/assets/all.min.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" href="/css/ra.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/menu4.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/tabs.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/button.css" /-->
    <!--link rel="stylesheet" type="text/css" href="/css/tango/skin.css" /-->
    <link rel="stylesheet" href="/js/jquery-ui.css">
    <link rel="stylesheet" href="/sc/jBox.all.min.css">
    <? if (!defined('IS_LOCAL') || !IS_LOCAL): ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
    <? endif; ?>
    <!--script src="/js/jquery-1.10.2.js?310120201008"></script-->
    <?
    if ($current_page != ''):
    //if ($current_page == '7987987877779876445546'):
        if (defined('IS_LOCAL') && IS_LOCAL): ?>
        <script src="/js/jquery-ui.js"></script>
        <? else: ?>
        <!--script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script-->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <? endif;
    endif;
    if ($_SERVER['SERVER_NAME'] == 'www.rusavto.moisait.net'):
        ?>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@latest/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@latest/dist/jspdf.min.js"></script>
	<?
    endif;
    ?>

    <!--script type="text/javascript" src="/js/jquery.jcarousel.js"></script-->
    <!--script src="/lightbox/js/lightbox.js"></script-->
    <!--script type="text/javascript" src="/js/ra_scripts.js"></script-->
    <!--script type="text/javascript" src="/js/s.js"></script-->
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/js/clipboard.min.js"></script>
    <!--script type="text/javascript" src="/js/sha512.js"></script-->

    <!--script src="/js/search.js"></script-->
    <link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>fancybox3/jquery.fancybox.min.css"/>
    <!--script type="text/javascript" src="<?= $cms_template_url ?>fancybox3/jquery.fancybox.min.js"></script-->
    <link rel="stylesheet" type="text/css" href="/css/fancybox.css"/>
    <?
    include "include/inc_extra_open_graph.php";
    ?>
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>bulma/css/bulma.css"/-->
    <!--link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>css/template_styles_bulma_overriding.css"/-->
    <!--script src="//cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js"></script-->
<link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>css/template_styles.css"/>
    <!--    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_colors_and_sizes.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_links_and_buttons.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_common.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_header.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_footer.css?<? /*= rand() */ ?>"/>
    <link rel="stylesheet" type="text/css" href="<? /*= $cms_template_url */ ?>template_styles_responsive.css?<? /*= rand() */ ?>"/>
-->
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <?
    global $SEO_URL;
    if (isset($SEO_URL) and $SEO_URL != "") {
        ?>
        <meta name="component_seo" content="<?= $SEO_URL ?>"/>
        <?
    }
    ?>
<link rel="icon" type="image/png" href="/images/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/images/favicon.svg" />
<link rel="shortcut icon" href="/images/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Rusavtomatika" />
<link rel="manifest" href="/images/site.webmanifest" />
</head>
<body class="template_rusavtomatika_bulma current_page_<?= $current_page ?>" style="opacity: 0;">
<div class="popup_background"></div>
<noscript>
    This page needs JavaScript activated to work.<br>
    Пожалуйста, включите Javascript чтобы просмотреть эту страницу
    <style>div {
            display: none;
        }</style>
</noscript>
<!--[if IE 7]>
Вы используете устаревший браузер Internet explorer 7<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div {
    display: none;
}</style>
<![endif]-->

<!--[if IE 6]>
Вы используете устаревший браузер Internet explorer 6<br>
Пожалуйста, обновите браузер, чтобы просмотреть эту страницу
<style> div {
    display: none;
}</style>
<![endif]-->
<style>
    .garland-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px;
        overflow: hidden;
        z-index: 100;
        pointer-events: none;
    }

    .bulb-wrapper {
        position: absolute;
        top: 10px;
        transform-origin: top center;
        z-index: 101;
    }

    @keyframes swing {
        0% {
            transform: rotate(calc(var(--swing-angle) * -1deg));
        }
        50% {
            transform: rotate(calc(var(--swing-angle) * 1deg));
        }
        100% {
            transform: rotate(calc(var(--swing-angle) * -1deg));
        }
    }

    .bulb-wrapper {
        animation: swing var(--swing-speed) ease-in-out infinite;
        animation-delay: var(--swing-delay);
    }

    .bulb {
        position: relative;
        width: 35px;
        height: 45px;
        cursor: pointer;
        pointer-events: auto;
        transition: transform 0.3s ease, filter 0.3s ease;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }

    .bulb:hover {
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4)) brightness(1.2);
        z-index: 102;
    }

    .bulb::after {
        content: '';
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 1.5px;
        height: 15px;
        background: #000;
        border-radius: 1px;
        z-index: 1;
    }

    .bulb::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 12px;
        height: 18px;
        background: linear-gradient(45deg, #1d1c1b 0%, #1a1613 25%, #1d1d1d 50%, #24211f 75%, #22201e 100%);
        border-radius: 4px 4px 0 0;
        z-index: 2;
        box-shadow: 
            inset 0 0 5px rgba(255,255,255,0.3),
            0 2px 5px rgba(0,0,0,0.3);
    }

    .bulb .glass {
        position: absolute;
        top: 18px;
        left: 50%;
        transform: translateX(-50%);
        width: 25px;
        height: 35px;
        background: 
            radial-gradient(
                ellipse at 50% 40%,
                rgba(var(--color-rgb), 0.7) 0%,
                rgba(var(--color-rgb), 0.5) 30%,
                rgba(var(--color-rgb), 0.2) 70%,
                transparent 100%
            ),
            radial-gradient(
                ellipse at 50% 30%,
                rgba(255, 255, 255, 0.95) 0%,
                rgba(255, 255, 255, 0.6) 25%,
                rgba(255, 255, 255, 0.2) 50%,
                transparent 100%
            );
        clip-path: polygon(
            50% 0%,
            35% 10%,
            25% 30%,
            20% 60%,
            30% 85%,
            50% 100%,
            70% 85%,
            80% 60%,
            75% 30%,
            65% 10%,
            50% 0%
        );
        border-radius: 50% 50% 40% 40%;
        box-shadow: 
            0 0 20px 5px rgba(var(--color-rgb), 0.7),
            0 0 40px 10px rgba(var(--color-rgb), 0.3),
            0 0 60px 15px rgba(var(--color-rgb), 0.1),
            0 2px 5px rgba(0, 0, 0, 0.3);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: bulbGlow 2s infinite alternate;
        z-index: 1;
    }

    @keyframes bulbGlow {
        0% {
            box-shadow: 
                0 0 15px 5px rgba(var(--color-rgb), 0.6),
                0 0 30px 8px rgba(var(--color-rgb), 0.2),
                0 0 45px 12px rgba(var(--color-rgb), 0.05),
                0 2px 5px rgba(0, 0, 0, 0.3);
        }
        100% {
            box-shadow: 
                0 0 25px 8px rgba(var(--color-rgb), 0.8),
                0 0 50px 15px rgba(var(--color-rgb), 0.4),
                0 0 75px 20px rgba(var(--color-rgb), 0.15),
                0 2px 5px rgba(0, 0, 0, 0.3);
        }
    }

    .bulb .filament {
        position: absolute;
        top: 35px;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 5px;
        height: 20px;
        background: linear-gradient(
            to bottom,
            #ffff00 0%,
            #ffd700 30%,
            #ff8c00 50%,
            #ff4500 70%,
            transparent 100%
        );
        border-radius: 3px;
        z-index: 2;
        transition: all 0.3s ease;
        filter: blur(1px);
        animation: filamentGlow 1.5s infinite alternate;
    }

    .explosion {
        position: absolute;
        top: 35px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
        pointer-events: none;
        z-index: 103;
        opacity: 0;
        transition: opacity 0.1s;
    }

    .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: radial-gradient(
            circle at 30% 30%,
            white 0%,
            currentColor 70%,
            rgba(var(--color-rgb), 0.8) 100%
        );
        opacity: 0;
        filter: blur(1px);
    }

    .particle:nth-child(1) { animation-delay: 0.05s; --angle: 0deg; }
    .particle:nth-child(2) { animation-delay: 0.1s; --angle: 45deg; }
    .particle:nth-child(3) { animation-delay: 0.15s; --angle: 90deg; }
    .particle:nth-child(4) { animation-delay: 0.2s; --angle: 135deg; }
    .particle:nth-child(5) { animation-delay: 0.25s; --angle: 180deg; }
    .particle:nth-child(6) { animation-delay: 0.3s; --angle: 225deg; }
    .particle:nth-child(7) { animation-delay: 0.35s; --angle: 270deg; }
    .particle:nth-child(8) { animation-delay: 0.4s; --angle: 315deg; }

    .bulb:nth-child(1) .glass { 
        color: #cc4444; 
        --color-rgb: 204, 68, 68;
    }
    .bulb:nth-child(2) .glass { 
        color: #44cc44; 
        --color-rgb: 68, 204, 68;
    }
    .bulb:nth-child(3) .glass { 
        color: #4444cc; 
        --color-rgb: 68, 68, 204;
    }
    .bulb:nth-child(4) .glass { 
        color: #cccc44; 
        --color-rgb: 204, 204, 68;
    }
    .bulb:nth-child(5) .glass { 
        color: #cc44cc; 
        --color-rgb: 204, 68, 204;
    }
    .bulb:nth-child(6) .glass { 
        color: #44cccc; 
        --color-rgb: 68, 204, 204;
    }
    .bulb:nth-child(7) .glass { 
        color: #cc6644; 
        --color-rgb: 204, 102, 68;
    }
    .bulb:nth-child(8) .glass { 
        color: #66cc44; 
        --color-rgb: 102, 204, 68;
    }
    .bulb:nth-child(9) .glass { 
        color: #4466cc; 
        --color-rgb: 68, 102, 204;
    }
    .bulb:nth-child(10) .glass { 
        color: #cc4488; 
        --color-rgb: 204, 68, 136;
    }
    .bulb:nth-child(11) .glass { 
        color: #8844cc; 
        --color-rgb: 136, 68, 204;
    }
    .bulb:nth-child(12) .glass { 
        color: #44cc88; 
        --color-rgb: 68, 204, 136;
    }
    .bulb:nth-child(13) .glass { 
        color: #cc8844; 
        --color-rgb: 204, 136, 68;
    }
    .bulb:nth-child(14) .glass { 
        color: #88cc44; 
        --color-rgb: 136, 204, 68;
    }
    .bulb:nth-child(15) .glass { 
        color: #4488cc; 
        --color-rgb: 68, 136, 204;
    }

    .header_top {
        position: relative;
        padding-top: 60px;
    }

    @media (max-width: 768px) {
        .garland-container {
            display: none;
        }
        .header_top {
            padding-top: 0;
        }
    }
</style>
<div class="padding_wrapper">
    <header>
	    <div class="garland-container">
            <div class="garland-line"></div>
        </div>
        <div class="container is-widescreen">
            <div class="header_top">
                <div class="header_top__item">
                    <div class="header_top__logo">
                        <a href="/">
                            <img width="249" height="50" alt="Русавтоматика" src="/abacus/templates/rusavtomatika_bulma/images/logo.svg"/>
                        </a>
                    </div>
                </div>
                <div class="header_top__item">
                    <? include "include/inc_short_contacts.php"; ?>
                    <div class="header_top__contacts is-hidden-touch">
                        <button class="button is-success button_open_panel_contacts" style="z-index: 0;">Контакты</button>
                    </div>
                    <div class="header_top__contacts is-hidden-desktop">
                        <a href="#" class="header-link-contacts">
                            <button class="button_open_panel_contacts button is-success"><span
                                        class="icon_hamburger no_text"></span></button>
                        </a>
                    </div>
                    <div class="pop_panel_contacts is-hidden-touch">
                        <? include "include/inc_pop_panel_contacts.php"; ?>
                    </div>
                    <div class="panel_background"></div>
                    <div class="pop_panel_contacts mobile is-hidden-desktop">
                        <? include "include/inc_pop_panel_contacts_mobile.php"; ?>
                    </div>
                    <div class="panel_background"></div>

                </div>
            </div>
            <div class="header_top__separator is-hidden-touch"></div>
            <div class="header_top is-hidden-touch">
                <div class="header_top__item">
                    <div class="header_top__menu">
                        <div class="top_menu">
                            <? include "include/inc_main_menu.php" ?>
                        </div>
                    </div>
                </div>
                <div class="header_top__item">
                    <div class="header_top__soc_buttons">
                        <? include "include/inc_social_nets.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const garlandContainer = document.querySelector('.garland-container');
        const bulbCount = 15;
        
        const colors = [
            {hex: '#cc4444', rgb: '204, 68, 68'},
            {hex: '#44cc44', rgb: '68, 204, 68'},
            {hex: '#4444cc', rgb: '68, 68, 204'},
            {hex: '#cccc44', rgb: '204, 204, 68'},
            {hex: '#cc44cc', rgb: '204, 68, 204'},
            {hex: '#44cccc', rgb: '68, 204, 204'},
            {hex: '#cc6644', rgb: '204, 102, 68'},
            {hex: '#66cc44', rgb: '102, 204, 68'},
            {hex: '#4466cc', rgb: '68, 102, 204'},
            {hex: '#cc4488', rgb: '204, 68, 136'},
            {hex: '#8844cc', rgb: '136, 68, 204'},
            {hex: '#44cc88', rgb: '68, 204, 136'},
            {hex: '#cc8844', rgb: '204, 136, 68'},
            {hex: '#88cc44', rgb: '136, 204, 68'},
            {hex: '#4488cc', rgb: '68, 136, 204'}
        ];
        
        for (let i = 0; i < bulbCount; i++) {
            const bulbWrapper = document.createElement('div');
            bulbWrapper.className = 'bulb-wrapper';
            
            const basePosition = (i / (bulbCount - 1)) * 100;
            const randomOffset = (Math.random() - 0.5) * 3;
            const leftPosition = Math.max(2, Math.min(98, basePosition + randomOffset));
            bulbWrapper.style.left = `${leftPosition}%`;
            
            const swingSpeed = (2 + Math.random() * 4) + 's';
            const swingAngle = 5 + Math.random() * 10;
            const swingDelay = Math.random() * 3 + 's';
            
            bulbWrapper.style.setProperty('--swing-speed', swingSpeed);
            bulbWrapper.style.setProperty('--swing-angle', swingAngle);
            bulbWrapper.style.setProperty('--swing-delay', swingDelay);
            
            const bulb = document.createElement('div');
            bulb.className = 'bulb';
            
            const glass = document.createElement('div');
            glass.className = 'glass';
            glass.style.color = colors[i].hex;
            glass.style.setProperty('--color-rgb', colors[i].rgb);
            
            const filament = document.createElement('div');
            filament.className = 'filament';
            
            const explosion = document.createElement('div');
            explosion.className = 'explosion';
            
            for (let j = 0; j < 8; j++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.color = colors[i].hex;
                particle.style.setProperty('--color-rgb', colors[i].rgb);
                particle.style.setProperty('--angle', `${(j / 8) * 360}deg`);
                explosion.appendChild(particle);
            }
            
            bulb.appendChild(glass);
            bulb.appendChild(filament);
            bulb.appendChild(explosion);
            bulbWrapper.appendChild(bulb);
            garlandContainer.appendChild(bulbWrapper);
            
            setInterval(() => {
                if (!bulb.matches(':hover')) {
                    const flicker = 0.7 + Math.random() * 0.3;
                    glass.style.opacity = flicker;
                }
            }, 500 + Math.random() * 1000);
        }
        
        setInterval(() => {
            const bulbWrappers = document.querySelectorAll('.bulb-wrapper');
            const randomIndex = Math.floor(Math.random() * bulbCount);
            const randomWrapper = bulbWrappers[randomIndex];
            
            if (randomWrapper) {
                const bulb = randomWrapper.querySelector('.bulb');
                if (bulb && !bulb.matches(':hover')) {
                    const glass = bulb.querySelector('.glass');
                    const filament = bulb.querySelector('.filament');
                    
                    glass.style.opacity = 0.3;
                    glass.style.filter = 'brightness(2)';
                    filament.style.opacity = 0.3;
                    
                    setTimeout(() => {
                        if (!bulb.matches(':hover')) {
                            glass.style.opacity = 1;
                            glass.style.filter = 'brightness(1)';
                            filament.style.opacity = 1;
                        }
                    }, 80);
                    
                    setTimeout(() => {
                        if (!bulb.matches(':hover')) {
                            glass.style.opacity = 0.7;
                            glass.style.filter = 'brightness(1.3)';
                            filament.style.opacity = 0.7;
                        }
                    }, 160);
                    
                    setTimeout(() => {
                        if (!bulb.matches(':hover')) {
                            glass.style.opacity = 1;
                            glass.style.filter = 'brightness(1)';
                            filament.style.opacity = 1;
                        }
                    }, 240);
                }
            }
        }, 2000);
    });
</script>

<?

$arguments = array(
    "component" => "catalog_toolbar",
    "template" => "default",
    "template_section_detail" => "default",
);
CoreApplication::include_component($arguments);

?>
<?
if ($current_page == '') {
    include "./include_utf_8/main_page/content/block_big_banner3.php";
    //include "./include_utf_8/main_page/content/block_big_banner_apm25.php";
}
?>

<div class="padding_wrapper">
    <main>
        <?
        if (!$CONTENT_ON_WIDE_SCREEN):
        ?>
        <div class="container is-widescreen">
            <div class="columns">
                <div class="column is-12">
<?
endif;
?>