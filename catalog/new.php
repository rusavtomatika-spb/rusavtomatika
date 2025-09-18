<?php
if (!defined('ENCODING')) {
	define('ENCODING', "UTF-8");
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
CoreApplication::add_breadcrumbs_chain("Каталог оборудования", "/catalog/");
$is_core_catalog_page = explode('?', $_SERVER['REQUEST_URI'])[0] == "/catalog/";
if ($is_core_catalog_page):
    CoreApplication::include_component(array("component" => "breadcrumbs"));
endif;

global $H1;
$H1 = 'Каталог оборудования';
$arguments = array(
    "component" => "catalog",
    "template" => "new",
    "template_section_detail" => "default",
);


CoreApplication::include_component($arguments);

if ($is_core_catalog_page):
    ?>
    <div class="catalog_description">
        <div class="">


            <p>
                Компания «Русавтоматика» была основана в 2007 году и является одним из ведущих российских поставщиков
                оборудования для автоматизации производства. Мы предлагаем высокотехнологичные решения для промышленных
                и жилых объектов в управлении климатом и умным домом, ЖКХ, автоматизации зданий и производств,
                энергетике. &nbsp;</p>
            <p>
                Мы сотрудничаем с известными мировыми брендами и предлагаем продукцию высокого качества от ведущих
                мировых производителей. Компания «Русавтоматика»&nbsp; поставляет на территории
                России продукцию <strong>Weintek</strong> и <strong>Samkoon</strong> (операторские панели),
                <strong>IFC</strong> (панельные компьютеры, встраиваемые компьютеры, промышленные мониторы), <strong>Aplex</strong>
                (панельные компьютеры), <strong>eWON</strong> (vpn-роутеры). Всего на нашем сайте представлено более 100
                наименований продукции.</p>

            <div style="width: 1035px;height:140px;margin-top:50px;    margin-bottom: 35px;">

                <a href="/panelnie-computery/ifc/" title="Панельные компьютеры IFC">
                    <img src="/images/ifc/IFC-622i3/IFC-622i3_1.png" alt="Панельные компьютеры IFC"
                         style="float:left; width:140px;margin-right:14px;"></a>

                <a href="/samkoon/" title="Панели оператора Samkoon">
                    <img src="/images/samkoon/SK-102AS/SK-102AS_1.png" alt="Панели оператора Samkoon"
                         style="float:left; width:130px;margin-right:15px;"></a>

                <a href="/panelnie-computery/aplex/" title="Панельные компьютеры Aplex">
                    <img src="/images/aplex/Aplex-APC1.png" alt="Панельные компьютеры Aplex"
                         style="float:left;     width: 118px;    margin-right: 35px;"></a>
                <a href="/ewon/" title="Vpn-роутеры eWON">
                    <img src="/images/ewon/Extention/Flexy-with-modules.png" alt="Vpn-роутеры eWON" style="float: left;
width: 100px;
margin-right: 26px;
margin-top: 23px;"></a>
                <a href="/box-pc/" title="Встраиваемые компьютеры IFC">
                    <img src="/images/box-pc/IFC-BOX2800/IFC-BOX2800_5.png" alt="Встраиваемые компьютеры IFC"
                         style="float:left; width:175px;"></a>


                <a href="/weintek/" title="Панели оператора Weintek">
                    <img src="/images/Weintek-eMT-series.png" alt="Панели оператора Weintek" style="float: left;
width: 232px;

margin-top: 3px;float: right;"></a>
            </div>

            <p>
                Мы осуществляем прямые поставки от производителя до наших складов в Санкт-Петербурге и Москве. Доставка
                клиентам осуществляется Деловыми линиями и другими транспортными компаниями до терминала в Вашем городе
                или до Вашего адреса.</p>
            <p>
                Для удобства наших клиентов в Санкт-Петербурге действует крупнейший склад продукции
                <strong>Weintek</strong><strong>, </strong><strong>Samkoon</strong><strong>, </strong><strong>IFC</strong><strong>, </strong><strong>Aplex</strong><strong>, </strong><strong>eWON</strong>
                в России, который единовременно вмещает более 1000 единиц продукции этого и других производителей.&nbsp;
                Также наши специалисты постоянно анализируют потребности клиентов и стараются держать продукцию с
                запасом, чтобы необходимый товар всегда был в наличии. В 90% случаев при обращении к нам он будет на
                складе.</p>
            <p>
                Компания «Русавтоматика» ежегодно представляет свою продукцию на крупнейших тематических выставках.&nbsp;
                Кроме того, мы оказываем техническую поддержку, как нашим клиентам, так и тем, кто приобрел продукцию не
                у нас. Вы всегда можете обратиться к нам за помощью по телефонам, указанным ниже или написать через
                форму обратной связи:</p>

        </div>
    </div>
<?php
endif;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
