<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph,$CANONICAL;
$TITLE = 'Партнеры ООО Русавтоматика - Weintek, Samkoon, IFC, Aplex, EWON, Faraday';
$DESCRIPTION = 'Официальный дистрибьютор Weintek, IFC, Samkoon, eWON, прямые поставки панелей оператора, панельных компьютеров, vpn-роутеров, мониторов и др. от производителей до складов в Санкт-Петербурге и Москве, тех.поддержка';
$KEYWORDS = 'Weintek, IFC, Samkoon, eWON, операторские панели, автоматизация производства, прямые поставки, vpn-роутеры, со склада, в наличии, тех.поддержка, Русавтоматика, официальный дистрибьютор';
$CANONICAL = "https://www.rusavtomatika.com/partners/";
$extra_openGraph = array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/partners.png",
    "openGraph_title" => "Партнеры Русавтоматика",
    "openGraph_siteName" => "Русавтоматика"
);
?>


    <article>
        <h1 class="title">Партнеры компании Русавтоматика</h1>
        <p>
            Компания Русавтоматика работает только с профессионалами! Это лучшие решения для российской промышленности.
        </p>
        <p>
            Все наши партнеры – высококлассные производители оборудования мирового уровня.
        </p>
        <p>
            Мы представляем в России:
        </p>
        <div class="partners__panel_images columns is-mobile is-multiline">
            <div class="column">
                <a href="/weintek/" title="Weintek">
                    <img src="/images/partners/weintek.png" alt="Панели оператора Weintek">
                </a>
                <p>Панели оператора, шлюзы данных, панельные компьютеры с Windows, контроллеры и модули ввода-вывода</p>
            </div>
            <div class="column">
                <a href="/ifc/" title="IFC">
                    <img src="/images/partners/ifc.png" alt="IFC">
                </a>
                <p>Панельные компьютеры с Windows и Android, встраиваемые компьютеры, промышленные мониторы</p>
            </div>
            <div class="column">
                <a href="/aplex/" title="Aplex">
                    <img src="/images/partners/aplex.png" alt="Aplex">
                </a>
                <p>Панельные компьютеры с Windows и WinCE, промышленные компьютеры Full IP65, встраиваемые компьютеры, промышленные мониторы</p>
            </div>
            <div class="column">
                <a href="/samkoon/" title="Samkoon">
                    <img src="/images/partners/samkoon.png" alt="Samkoon">
                </a>
                <p>Панели оператора</p>
            </div>
            <div class="column">
                <a href="/ewon/" title="eWON">
                    <img src="/images/partners/ewon.png" alt="eWON">
                </a>
                <p>VPN-роутеры</p>
            </div>
            <div class="column">
                <a href="/faraday/" title="Faraday">
                    <img src="/images/partners/faraday.png" alt="Faraday">
                </a>
                <p>Блоки питания</p>
            </div>
        </div>
        <style>
            .partners__panel_images img {
                max-height: 100px;
                display: block;
                margin: 1rem auto;
                background: #000;
            }

            .partners__panel_images a {
                width: 400px;
                height: 150px;
                display: flex;
                justify-items: center;
                align-items: center;
                text-align: center;
                font-size: 0.9rem;
                text-decoration: none;
                border: 1px solid #eee;
            }
            .partners__panel_images a:hover {
                transform: scale(1.1);
                transition: 0.1s;
            }

            .partners__panel_images p {
                max-width: 400px;
            }

            .partners__panel_images a > div {
                padding: 0 1rem;
            }

            @media (max-width: 900px) {
                .partners__panel_images a {
                    width: 320px;
                }
            }
            @media (max-width: 700px) {
                .partners__panel_images a {
                    width: 250px;
                }
            }
            @media (max-width: 600px) {
                .partners__panel_images a {
                    width: 450px;
                }
            }
            @media (max-width: 500px) {
                .partners__panel_images a {
                    width: 300px;
                }
            }
            @media (max-width: 480px) {
                .partners__panel_images a > div {
                    padding: 0;
                }
            }
        </style>
    </article>



<?php



//include $_SERVER["DOCUMENT_ROOT"]."/sc/lib_new_includes/functions_messages.php";


require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";