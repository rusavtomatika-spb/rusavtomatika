<?php
define('ENCODING', "UTF-8");
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph,$CANONICAL;
$TITLE = 'Поставщик оборудования для автоматизации производства с 2007 года';
$DESCRIPTION = 'Официальный дистрибьютор Weintek, IFC, Samkoon, eWON, прямые поставки панелей оператора, панельных компьютеров, vpn-роутеров, мониторов и др. от производителей до складов в Санкт-Петербурге и Москве, тех.поддержка';
$KEYWORDS = 'Weintek, IFC, Samkoon, eWON, операторские панели, автоматизация производства, прямые поставки, vpn-роутеры, со склада, в наличии, тех.поддержка, Русавтоматика, официальный дистрибьютор';
$CANONICAL = "https://www.rusavtomatika.com/about/";
$extra_openGraph = array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/about.png",
    "openGraph_title" => "О компании Русавтоматика",
    "openGraph_siteName" => "Русавтоматика"
);
?>

    <article>
        <h1 class="title">О компании</h1>
        <p>
            Компания Русавтоматика была основана в 2007 году и является одним из ведущих российских поставщиков
            оборудования для автоматизации. Мы предлагаем высокотехнологичные решения для промышленных и жилых объектов
            в управлении климатом и умным домом, ЖКХ, автоматизации зданий и производств, энергетике.
        </p>
        <p>
            Мы сотрудничаем с известными мировыми брендами и предлагаем продукцию высокого качества от ведущих мировых
            производителей. Компания «Русавтоматика» осуществляет прямые поставки с заводов производителей продукции
            <strong>Weintek</strong> и <strong>Samkoon</strong> (операторские панели), <strong>IFC</strong> (панельные
            компьютеры, встраиваемые компьютеры, промышленные мониторы), <strong>Aplex</strong> (панельные компьютеры).
            Всего на нашем сайте представлено более 100 наименований продукции.
        </p>

        <div class="about__panel_images columns is-mobile is-multiline">
            <div class="column is-half-mobile">
                <a href="/catalog/operator_panels/?&brand=weintek" title="Панели оператора Weintek">
                    <img src="/images/Weintek-eMT-series.png" alt="Панели оператора Weintek">
                    <div>Панели оператора Weintek</div>
                </a>
            </div>
            <div class="column is-half-mobile">
                <a href="/catalog/operator_panels/?&brand=samkoon" title="Панели оператора Samkoon">
                    <img src="/images/samkoon/SK-102AS/SK-102AS_1.png" alt="Панели оператора Samkoon">
                    <div>Панели оператора Samkoon</div>
                </a>
            </div>
            <div class="column is-half-mobile">
                <a href="/catalog/panel_computers/?&brand=ifc" title="Панельные компьютеры IFC">
                    <img src="/images/ifc/IFC-622i3/IFC-622i3_1.png" alt="Панельные компьютеры IFC">
                    <div>Панельные компьютеры IFC</div>
                </a>
            </div>
            <div class="column is-half-mobile">
                <a href="/catalog/embedded_computers/?&brand=ifc" title="Встраиваемые компьютеры IFC">
                    <img src="/images/box-pc/IFC-BOX2800/IFC-BOX2800_5.png"
                         alt="Встраиваемые компьютеры IFC">
                    <div>Встраиваемые компьютеры IFC</div>
                </a>
            </div>
            <div class="column is-half-mobile">
                <a href="/catalog/panel_computers/?&brand=aplex" title="Панельные компьютеры Aplex">
                    <img src="/images/aplex/Aplex-APC1.png" alt="Панельные компьютеры Aplex">
                    <div>Панельные компьютеры Aplex</div>
                </a>
            </div>
            <!--div-- class="column is-half-mobile">
                <a href="/catalog/vpn_routers/" title="Vpn-роутеры eWON">
                    <img src="/images/ewon/Extention/Flexy-with-modules.png" alt="Vpn-роутеры eWON">
                    <div>Vpn-роутеры eWON</div>
                </a>
            </div-->
        </div>

        <p>
            Мы осуществляем прямые поставки от заводов производителя до наших складов в Санкт-Петербурге и Москве.
            Доставка клиентам осуществляется компанией DPD и другими транспортными компаниями до терминала в Вашем
            городе или до Вашего адреса.</p>
        <p>
            Для удобства наших клиентов в Санкт-Петербурге действует крупнейший склад продукции Weintek, Samkoon, IFC, Aplex в России,
            который единовременно вмещает несколько тысяч единиц продукции этих и других производителей. Также наши
            специалисты постоянно анализируют потребности клиентов и стараются держать продукцию с запасом, чтобы
            необходимый товар всегда был в наличии. В 90% случаев при обращении к нам он будет на складе.
        </p>
        <p>
            ООО «Русавтоматика» ежегодно представляет свою продукцию на крупнейших тематических выставках. Кроме того,
            мы оказываем техническую поддержку по всей линейке поставляемой нами продукции. Вы всегда можете обратиться
            к нам за помощью по телефонам, указанным ниже или написать в чат, который появляется справа внизу.
        </p>
    </article>


    <!--div class="message  my-1 has-background-light">
        <div class="p-5">
            <div class="columns">
                <div class="column is-8">
                    <div class="my-2"><span class="has-text-weight-bold is-size-5">Обратный звонок</span> - мы
                        перезваниваем на Ваш мобильный номер через 10 секунд:
                    </div>
                </div>
                <div class="column is-4">
                    <?
                    include $_SERVER["DOCUMENT_ROOT"] . "/include_utf_8/widgets/inc_button_callback_call.php";
                    ?>
                </div>
            </div>
        </div>
    </div-->


    <!--div class="columns">
        <div class="column is-12">
            <div class="message has-background-light mb-5">
                <div class="p-5">
                    <h3>Свяжитесь с нами:</h3>
                    <div class="columns">
                        <div class="column is-2">
                            <h4>Санкт-Петербург</h4>
                            <p><a href="tel:+78126480347" class="nowrap header_phone">+7 <span
                                            class="to-ltsp">(812)</span> 648-03-47</a></p>
                            <p><a href="tel:+79110021342" class="nowrap header_phone">+7 (911)<span class="to-ltsp"> 002-13-42</span></a>
                            </p>
                            <p><a href="tel:+79046306767" class="nowrap header_phone">+7 (904)<span class="to-ltsp"> 630-67-67</span></a>
                            </p>
                        </div>
                        <div class="column is-2">
                            <h4>Москва</h4>
                            <p><a href="tel:+74951081275" class="nowrap header_phone">+7 (495)<span class="to-ltsp"> 108-12-75</span></a>
                            </p>
                        </div>
                        <div class="column is-2">
                            <h4>Skype (чат)</h4>
                            <p><a href='skype:artemfam?chat' class='wei_link'
                                  title='Отправить нам сообщение в Скайпе на аккаунт artemfam77'>
                                    artemfam</a></p>
                        </div>
                        <div class="column is-6">
                            <h4>Тех.поддержка</h4>
                            <p>Для обращений перейдите в раздел <span class="has-text-weight-bold"><a href="/support/">ТЕХПОДДЕРЖКА &gt;&gt;</a></span>
                            </p>
                            <h4>E-mail</h4>
                            <p><span id='emailsh'> </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
<?php

//include $_SERVER['DOCUMENT_ROOT'] . "/core/templates/rusavtomatika_bulma/include/inc_backup_call.php";

include $_SERVER['DOCUMENT_ROOT'] . "/include_utf_8/widgets/inc_block_small_contacts.php";


//include $_SERVER["DOCUMENT_ROOT"]."/sc/lib_new_includes/functions_messages.php";

?>
    <style>
        .about__panel_images img {
            max-height: 70px;
            display: block;
            margin: 1rem auto;
        }

        .about__panel_images a {
            display: block;
            text-align: center;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .about__panel_images a > div {
            padding: 0 1rem;
        }

        @media (max-width: 480px) {
            .about__panel_images a > div {
                padding: 0;
            }
        }
    </style>



<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";