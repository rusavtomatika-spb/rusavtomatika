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

    @keyframes lineGlow {
        0% {
            box-shadow: 
                0 0 10px gold,
                0 0 20px rgba(255, 215, 0, 0.5),
                0 0 30px rgba(255, 215, 0, 0.3);
        }
        100% {
            box-shadow: 
                0 0 15px gold,
                0 0 25px rgba(255, 215, 0, 0.6),
                0 0 35px rgba(255, 215, 0, 0.4);
        }
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
        background: linear-gradient(to bottom, #ffd700, #b8860b);
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
        background: linear-gradient(45deg, #a0522d 0%, #cb5a0a 25%, #d07405 50%, #d2691e 75%, #8b4513 100%);
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
        background: radial-gradient(
            ellipse at 30% 40%,
            rgba(255, 255, 255, 0.95) 0%,
            rgba(255, 255, 255, 0.8) 30%,
            rgba(255, 255, 255, 0.4) 70%,
            transparent 100%
        );
        border-radius: 40% 40% 30% 30%;
        box-shadow: 
            inset 0 0 15px rgba(255, 255, 255, 0.9),
            inset 0 -5px 20px rgba(0, 0, 0, 0.2),
            0 0 30px currentColor,
            0 0 50px rgba(var(--color-rgb), 0.5);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: bulbGlow 2s infinite alternate;
        z-index: 1;
    }

    @keyframes bulbGlow {
        0% {
            box-shadow: 
                inset 0 0 15px rgba(255, 255, 255, 0.9),
                inset 0 -5px 20px rgba(0, 0, 0, 0.2),
                0 0 20px currentColor,
                0 0 40px rgba(var(--color-rgb), 0.4);
            opacity: 0.9;
        }
        100% {
            box-shadow: 
                inset 0 0 20px rgba(255, 255, 255, 1),
                inset 0 -5px 25px rgba(0, 0, 0, 0.3),
                0 0 40px currentColor,
                0 0 60px rgba(var(--color-rgb), 0.6);
            opacity: 1;
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

    @keyframes filamentGlow {
        0% {
            opacity: 0.8;
            background: linear-gradient(
                to bottom,
                #ffff00 0%,
                #ffd700 30%,
                #ff8c00 50%,
                #ff4500 70%,
                transparent 100%
            );
        }
        100% {
            opacity: 1;
            background: linear-gradient(
                to bottom,
                #ffffcc 0%,
                #ffff00 30%,
                #ffd700 50%,
                #ff8c00 70%,
                transparent 100%
            );
        }
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

    .bulb:hover .glass {
        opacity: 0;
        transform: translateX(-50%) scale(2);
        filter: blur(2px);
    }

    .bulb:hover .filament {
        opacity: 0;
        transform: translate(-50%, -50%) scale(1.5);
    }

    .bulb:hover .explosion {
        opacity: 1;
    }

    .bulb:hover .particle {
        animation: explode 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    @keyframes explode {
        0% {
            opacity: 0;
            transform: translate(0, 0) scale(0.1) rotate(0deg);
        }
        20% {
            opacity: 1;
            transform: translate(
                calc(cos(var(--angle)) * 20px),
                calc(sin(var(--angle)) * 20px)
            ) scale(1.2) rotate(180deg);
        }
        80% {
            opacity: 0.8;
            transform: translate(
                calc(cos(var(--angle)) * 60px),
                calc(sin(var(--angle)) * 60px)
            ) scale(1) rotate(360deg);
        }
        100% {
            opacity: 0;
            transform: translate(
                calc(cos(var(--angle)) * 80px),
                calc(sin(var(--angle)) * 80px)
            ) scale(0.5) rotate(540deg);
        }
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
        color: #ff5555; 
        --color-rgb: 255, 85, 85;
    }
    .bulb:nth-child(2) .glass { 
        color: #55ff55; 
        --color-rgb: 85, 255, 85;
    }
    .bulb:nth-child(3) .glass { 
        color: #5555ff; 
        --color-rgb: 85, 85, 255;
    }
    .bulb:nth-child(4) .glass { 
        color: #ffff55; 
        --color-rgb: 255, 255, 85;
    }
    .bulb:nth-child(5) .glass { 
        color: #ff55ff; 
        --color-rgb: 255, 85, 255;
    }
    .bulb:nth-child(6) .glass { 
        color: #55ffff; 
        --color-rgb: 85, 255, 255;
    }
    .bulb:nth-child(7) .glass { 
        color: #ff8855; 
        --color-rgb: 255, 136, 85;
    }
    .bulb:nth-child(8) .glass { 
        color: #88ff55; 
        --color-rgb: 136, 255, 85;
    }
    .bulb:nth-child(9) .glass { 
        color: #5588ff; 
        --color-rgb: 85, 136, 255;
    }
    .bulb:nth-child(10) .glass { 
        color: #ff55aa; 
        --color-rgb: 255, 85, 170;
    }
    .bulb:nth-child(11) .glass { 
        color: #aa55ff; 
        --color-rgb: 170, 85, 255;
    }
    .bulb:nth-child(12) .glass { 
        color: #55ffaa; 
        --color-rgb: 85, 255, 170;
    }
    .bulb:nth-child(13) .glass { 
        color: #ffaa55; 
        --color-rgb: 255, 170, 85;
    }
    .bulb:nth-child(14) .glass { 
        color: #aaff55; 
        --color-rgb: 170, 255, 85;
    }
    .bulb:nth-child(15) .glass { 
        color: #55aaff; 
        --color-rgb: 85, 170, 255;
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
                        <button class="button is-success button_open_panel_contacts">Контакты</button>
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
            {hex: '#ff5555', rgb: '255, 85, 85'},
            {hex: '#55ff55', rgb: '85, 255, 85'},
            {hex: '#5555ff', rgb: '85, 85, 255'},
            {hex: '#ffff55', rgb: '255, 255, 85'},
            {hex: '#ff55ff', rgb: '255, 85, 255'},
            {hex: '#55ffff', rgb: '85, 255, 255'},
            {hex: '#ff8855', rgb: '255, 136, 85'},
            {hex: '#88ff55', rgb: '136, 255, 85'},
            {hex: '#5588ff', rgb: '85, 136, 255'},
            {hex: '#ff55aa', rgb: '255, 85, 170'},
            {hex: '#aa55ff', rgb: '170, 85, 255'},
            {hex: '#55ffaa', rgb: '85, 255, 170'},
            {hex: '#ffaa55', rgb: '255, 170, 85'},
            {hex: '#aaff55', rgb: '170, 255, 85'},
            {hex: '#55aaff', rgb: '85, 170, 255'}
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