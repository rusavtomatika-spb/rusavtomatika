<?php

global $CONTENT_ON_WIDE_SCREEN;

$CONTENT_ON_WIDE_SCREEN = false;

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/abacus/services/CountryDetector.php';

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph;

$TITLE = 'Поставщик оборудования для автоматизации производства с 2007 года';

$CANONICAL = "https://www.rusavtomatika.com/certificates/";

$DESCRIPTION = 'Официальный дистрибьютор Weintek, IFC, Samkoon, прямые поставки панелей оператора, панельных компьютеров, vpn-роутеров, мониторов и др. от производителей до складов в Санкт-Петербурге и Москве, тех.поддержка';

$KEYWORDS = 'Weintek, IFC, Samkoon, операторские панели, автоматизация производства, прямые поставки, vpn-роутеры, со склада, в наличии, тех.поддержка, Русавтоматика, официальный дистрибьютор';

$extra_openGraph = array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/about.png",
    "openGraph_title" => "О компании Русавтоматика",
    "openGraph_siteName" => "Русавтоматика"
);

$userCountry = CountryDetector::getCountry();

if (!$userCountry) {
    $userCountry = 'UNKNOWN';
}

?>

    <article>

        <h1>Сертификаты дистрибьютора</h1>

        <p style="margin-bottom:20px;">Компания &laquo;Русавтоматика&raquo;&nbsp; является официальным

            дистрибьютором на территории России продукции <strong>Weintek</strong> и

            <strong>Samkoon</strong> (операторские панели), <strong>IFC</strong> (панельные компьютеры,

            встраиваемые компьютеры, промышленные мониторы), <strong>Aplex</strong> (панельные

            компьютеры), <strong>Haiwell</strong>, <strong>Yottacontroll</strong>

            (vpn-роутеры). Всего на нашем сайте представлено более 100 наименований продукции.</p>

        <div class="block_sertificates" >

            <div class="columns">

                <? if ( $userCountry === 'RU' ) { ?>

                <div class="column  is-12-mobile has-text-centered">

                    <a data-fancybox="gallery"

                       class="block_sertificates__link"

                       href="/images/certificates/distributor_certificate_rusavtomatika.png"

                    >

                        <div class="block_sertificates__item" title="Нажмите для увеличения"

                             style="background-image: url('/images/certificates/distributor_certificate_rusavtomatika_preview.png')">

                        </div>

                        <div class="block_sertificates__item_title">Weintek</div>

                    </a>

                    <a target="_blank" href="/images/certificates/distributor_certificate_rusavtomatika.png">Скачать сертификат Weintek</a>

                    <a class="button is-success my-5" href="/weintek/">Перейти к Weintek</a>

                </div>

                <? } ?>

                <div class="column  is-12-mobile has-text-centered">

                    <a data-fancybox="gallery"

                       class="block_sertificates__link"

                       href="/images/certificates/distributor_certificate_ifc.png"                    >

                        <div class="block_sertificates__item" title="Нажмите для увеличения"

                             style="background-image: url('/images/certificates/distributor_certificate_ifc_preview.png')">

                        </div>

                        <div class="block_sertificates__item_title">IFC</div>

                    </a>

                    <a target="_blank" href="/images/certificates/distributor_certificate_ifc.png">Скачать сертификат IFC</a>

                    <a class="button is-success my-5" href="/ifc/">Перейти к IFC</a>

                </div>

                <div class="column is-12-mobile has-text-centered">

                    <a data-fancybox="gallery"

                       class="block_sertificates__link"

                       href="/images/certificates/distributor_certificate_aplex.png"

                    >

                        <div class="block_sertificates__item" title="Нажмите для увеличения"

                             style="background-image: url('/images/certificates/distributor_certificate_aplex_preview.png')">

                        </div>

                        <div class="block_sertificates__item_title">Aplex</div>

                    </a>

                    <a target="_blank" href="/images/certificates/distributor_certificate_aplex.png">Скачать сертификат Aplex</a>

                    <a class="button is-success my-5" href="/aplex/">Перейти к Aplex</a>

                </div>

                <div class="column  is-12-mobile has-text-centered">

                    <a data-fancybox="gallery"

                       class="block_sertificates__link"

                       href="/images/certificates/distributor_certificate_samkoon.png">

                        <div class="block_sertificates__item" title="Нажмите для увеличения"

                             style="background-image: url('/images/certificates/distributor_certificate_samkoon.png')">

                        </div>

                        <div class="block_sertificates__item_title">Samkoon</div>

                    </a>

                    <a target="_blank" href="/images/certificates/distributor_certificate_samkoon.png">Скачать сертификат Samkoon</a>

                    <a class="button is-success my-5" href="/samkoon/">Перейти к Samkoon</a>

                </div>

            </div>

        </div>

    </article>

    <style>

        .block_sertificates a.block_sertificates__link {

            box-sizing: border-box;

            display: block;

            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);

            padding: 10px;

            margin-bottom: 20px;

            text-align: center;

            font-weight: 700;

            text-decoration: none;

            color: #333;

            border-radius: 4px;

        }

        .block_sertificates .block_sertificates__item {

            max-width: 100%;

            height: 190px;

            background: center/auto 100% no-repeat #fff;

            box-sizing: border-box;

            display: block;

        }

        .block_sertificates a.block_sertificates__link .block_sertificates__item_title {

            text-align: center;

            font-weight: 700;

            text-decoration: none;

            color: #333;

            margin-top: 10px;

        }

    </style>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";