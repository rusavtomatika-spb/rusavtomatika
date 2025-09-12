<?
define("bullshit", 1);
$extra_openGraph = Array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/mqtt.png",
    "openGraph_title" => "MQTT в панелях Weintek",
    "openGraph_siteName" => "Русавтоматика"
);

include $_SERVER["DOCUMENT_ROOT"]."/config.php";
if(EX != "_"){
    global $CONTENT_ON_WIDE_SCREEN;
    $CONTENT_ON_WIDE_SCREEN = false;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
    global $TITLE,$CANONICAL;
    $TITLE = "Реализация MQTT в операторских панелях Weintek";
$CANONICAL = "https://www.rusavtomatika.com/mqtt/";
$DESCRIPTION = 'Протокол MQTT разработан в рамках концепции IoT (интернет вещей), когда предполагается, что множество устройств должны обмениваться данными друг с другом. MQTT был стандартизован в 2014 году, является инновационным и перспективным протоколом, поэтому компания Weintek Labs. приняла решение применить его в своей продукции.';
}else{
    include "../sc/dbcon.php";
    include ("../sc/lib_new.php");
    include ("../sc/auth.php");

    database_connect();

    temp0("weintek");
    top_buttons();
    basket();
    temp1_no_menu();
//temp1();
//left_menu();
    add_to_basket();
    temp2();
}



echo "<article>";
//-----------------------content
?>
<div id = "cont">
    
    <h1>Реализация MQTT в панелях оператора Weintek </h1>
    <p class="pp">
        Протокол MQTT разработан в рамках концепции IoT (интернет вещей), когда предполагается, что множество устройств должны обмениваться данными друг с другом.
        MQTT был  стандартизован в 2014 году (см <a href="http://www.mqtt.org" target="_blank" rel="nofollow">www.mqtt.org</a> ), является инновационным и перспективным протоколом,
        поэтому компания Weintek Labs. приняла решение применить его в своей продукции. </p>
    <p class="pp">
        Популярность протокола MQTT быстро растет, например, MQTT применяется в таких сервисах, как мессенджер Facebook, Amazon Web Services, его поддержка реализована в облачных сервисах IBM Bluemix, AWS IoT.
    </p>
    <p class="pp"> В настоящее время  протокол MQTT реализован в операторских панелях Weintek
        <a href="https://www.rusavtomatika.com/catalog/operator_panels/?&series=MT8000iE&brand=Weintek">серии iE </a>,
        <a href="https://www.rusavtomatika.com/catalog/operator_panels/?&series=MT8000XE&brand=Weintek">серии XE </a>,
        <a href="https://www.rusavtomatika.com/catalog/operator_panels/?&series=cMT&brand=Weintek">серии cMT </a>
        и <a href="https://www.rusavtomatika.com/catalog/operator_panels/?&series=cMT-X&brand=Weintek">серии cMT-X </a>.
    </p>
    <h2> Что можно делать с помощью протокола MQTT на панелях оператора Weintek.</h2>

    <p class="pp1">

        С помощью протокола MQTT можно отправлять данные <span class="se">С ПАНЕЛИ</span> Weintek на произвольные устройства.</p>

    <p class="pp1">
        Таким образом, MQTT в панелях Weintek может служить средством для <span class="se">мониторинга</span> произвольных данных в панели, когда
        панель отправляет данные, собранные с подключенных к ней устройств, контроллеров, по событиям, либо по времени,
        например, раз в секунду на заданный <span class="se">MQTT-брокер</span>.
        Но управлять панелью по MQTT нельзя.

    </p>
    <p class="pp">

        Получателем данных может быть некий сервер, мобильное устройство, браузер, и т.д.
        Для MQTT в настоящее время разработаны клиенты  на множестве языков программирования ( C, JavaScript, PHP, Python, Java, итд ), исходники которых доступны и бесплатны.
        MQTT клиентом может выступать даже браузер ( для ПК, и для мобильных устройств).</p>
    <p class="pp">
        MQTT клиенты доступны в App Store ( например  <a href="https://itunes.apple.com/us/app/mqttinspector/id758868884?mt=8" rel="nofollow" target="_blank"> MQTTInspector </a> )
        и Play Market ( например <a href="https://play.google.com/store/apps/details?id=at.tripwire.mqtt.client&hl=ru" rel="nofollow" target="_blank">MyMQTT</a> ).</p><p class="pp">
        MQTT протокол очень «легковесный», поэтому аппаратная платформа клиента может быть любой, даже платой, собранной на микроконтроллере.</p><p class="pp">
        В протоколе MQTT предусмотрена <span class="se">авторизация MQTT клиента</span>, поэтому протокол MQTT является безопасным, в отличие от, например Modbus TCP, с помощью которого также
        можно отправлять данные от панели оператора на удаленный сервер, однако, авторизация в нем не предусмотрена.
    </p>

    <h2>Как работает MQTT</h2>
    <p class="pp">

        Работает MQTT с помощью сервера-посредника, называемого <span class="se">MQTT-брокер</span> по принципу <span class="se">«публикация/подписка»</span>.
        MQTT-клиент <span class="se">«публикует»</span> данные на MQTT -брокере под определенным <span class="se">«топиком»</span>, либо <span class="se"> «подписывается»</span> на получение данных от необходимого «топика».
        MQTT- брокер, при поступлении на него данных от <span class="se">MQTT-клиента</span> ( операторской панели, например ),
        проверяет топик, на который они поступили, и отправляет данные всем MQTT-клиентам, «подписавшимся» на этот топик.</p>

    <figure><img src="mqtt.jpg" ></figure>

    <p class="pp">

        Такая  схема отличается высокой гибкостью.

        Например, необходимо мониторить данные от операторской панели на ПК, мобильном устройстве, и архивировать их на сервере компании.
        С помощью MQTT это несложно сделать.
        Операторская панель будет MQTT – клиентом и будет «публиковать» данные на неком брокере под неким топиком. (&nbsp;например, broker.mqttdashboard.com под топиком mycompany/myproject/hmi1 )
        ПК, мобильные устройства, сервер компании будут MQTT-клиентами, «подписавшимися» на этот топик на этом брокере, и будут получать данные от панели, как только она их «опубликует» на брокере.

    </p>

    <h2>Что такое MQTT- брокер</h2>


    <p class="pp">
        <span class="se">MQTT-брокер </span>— это узел в сети Интернет, либо локальной сети, на котором установлено специальное ПО - MQTT-брокер.</p><p class="pp">
        Существует множество реализаций MQTT брокеров, например
         ActiveMQ, Apollo, HiveMQ, IBM MessageSight, JoramMQ, Mosquitto, RabbitMQ, Solace Message Routers, VerneMQ.</p><p class="pp">
        Например, <a href="http://mosquitto.org" target="=_blank" rel="nofollow">http://mosquitto.org</a> -  MQTT-брокер с открытым исходным кодом.</p><p class="pp">
        Также, в сети существует несколько бесплатных MQTT-брокеров, которыми можно свободно пользоваться,
        например broker.mqttdashboard.com, broker.hivemq.com , <a href="http://test.mosquitto.org/">test.mosquitto.org</a>.</p><p class="pp">
        Естественно, бесплатные сервисы не дают никаких гарантий относительно надежности своей работы.
        Если требуется гарантированная надежность, можно развернуть свой MQTT брокер, на своих
        серверных мощностях, воспользовавшись одной из вышеперечисленных реализаций, либо воспользоваться одним из платных брокеров MQTT,
        например <a href="https://www.cloudmqtt.com/" target="_blank" rel="nofollow">cloudmqtt.com</a>.</p><p class="pp">
        MQTT брокер также можно установить на Raspberry PI.</p><p class="pp">
        MQTT брокер также установлен в панелях Weintek  серии XE и <a href="/catalog/operator_panels/?&brand=Weintek&screenless=yes">серии cMT </a> и, в некоторых случаях, целесообразно пользоваться им.


    </p>

    <p class="pp">

        Таким образом, в панелях оператора Weintek реализован и  <span class="se">MQTT клиент</span>, и  <span class="se">MQTT брокер</span>.
        MQTT клиент можно настроить, чтобы он публиковал данные на внешнем брокере ( например, broker.mqttdashboard.com ), либо на своем локальном брокере ( встроенном в панель ).</p><p class="pp">
        Если данные публикуются на локальном брокере, то и подписаться на чтение этих данных может устройство только из локальной сети.</p><p class="pp">
        Однако, если у панели с включенным брокером есть  статический IP адрес, то подписаться на получение ее данных может любое устройство во внешней сети.</p><p class="pp">
        Также, при активированном EasyAccess2.0 на топик на сервере панели можно подписаться и удаленно.

    </p>

    <a name="manual"> </a>
    <h2>Проект для демонстрации отправки данных по MQTT <br>от операторской панели MT8090XE браузеру</h2>

    <p class="pp">
        Нами был реализован проект для демонстрации возможностей протокола MQTT. В демонстрации используется:
    </p>
    <ul style="    text-align: left;
        margin-left: 20px;
        font-family: Verdana, 'Lucida Grande';
        margin-bottom: 20px;">
        <li>операторская панель <a href="https://www.rusavtomatika.com/weintek/MT8090XE/" target="_blank">MT8090XE</a>, как MQTT клиент, публикующий данные,</li>
        <li>браузер с загруженной страницей <a href="https://www.rusavtomatika.com/mqtt/demo.php" target="_blank">www.rusavtomatika.com/mqtt/demo.php</a>, как MQTT клиент, получающий данные,</li>
        <li>бесплатный MQTT брокер broker.mqttdashboard.com,( IP адрес 212.72.74.21 ), "соединяющий" оба клиента.</li>
    </ul>

    <p class="pp">
        Проект для операторской панели <a href="https://www.rusavtomatika.com/weintek/MT8090XE/" target="_blank">MT8090XE</a> доступен <a href="mqtt_test.emtp">здесь</a>. При отсутствии панели, проект также можно запускать в Онлайн Симуляторе
        <a href="https://www.rusavtomatika.com/soft/EBPro/EBpro_setup.zip" >EasyBuilder Pro</a> ( Инструменты -> Онлайн Симуляция ).
    </p><p class="pp">

        При старте проекта необходимо задать <span class="se">топик</span>, на который панель будет публиковать данные и нажать кнопку "Старт MQTT".
        Панель соединяется с broker.mqttdashboard.com, и в случае успешного соединения начинает <span class="se">публиковать на заданном топике</span> значения Переменной 1 и Переменной 2 раз в секунду.</p><p class="pp">
        Значения переменных можно менять с помощью слайдеров.</p>

    <figure><img src="mqtt_proj.jpg">
        <figcaption class="podp">Проект на операторской панели MT8090XE</figcaption>
    </figure>

    <p class="pp">

        Просмотреть данные, опубликованные  панелью можно на странице <a href="https://www.rusavtomatika.com/mqtt/demo.php" target="_blank">www.rusavtomatika.com/mqtt/demo.php</a>.
        Для подключения к MQTT брокеру на данной  странице используются бесплатная JavaScript библиотека
        <a href="http://www.hivemq.com/blog/full-featured-mqtt-client-browser" rel="nofollow" target="_blank">HiveMQ</a>. </p><p class="pp"> С ее помощью браузер работает как MQTT клиент.</p><p class="pp">
        Для отображения приборов и графика используется бесплатная JavaScript библиотека <a href="http://www.jqplot.com/" rel="nofollow" target="_blank">JqPlot</a>.</p><p class="pp">
        При нажатии на кнопку "Подключиться" браузер пытается соединиться с broker.mqttdashboard.com, и в случае успеха автоматически подписывается на заданный топик.</p><p class="pp">

        Вы можете наблюдать на странице значения Переменной 1 и Переменной 2, отправляемые из операторской панели раз в секунду.
        В поле данных можно видеть, что данные от операторской панели поступают в формате <span class="se">JSON</span>, который широко применяется в различных языках программирования.
        Например, в JavaScript строка JSON преобразовывается в объект стандартной функцией.

    </p>

    <figure><img src="mqtt_page.jpg">
        <figcaption class="podp">Страница demo.php на www.rusavtomatika.com</figcaption>
    </figure>

    <p class="pp">

        Таким образом, мы можем наблюдать, что для обмена данными по протоколу MQTT разные устройства должны подключиться к одному и тому же брокеру на один и тот же топик.</p><p class="pp">

        Можно открыть страницу  <a href="https://www.rusavtomatika.com/mqtt/demo.php" target="_blank">www.rusavtomatika.com/mqtt/demo.php</a>  с браузеров мобильных устройств,
        либо других компьютеров, и, если подписаться на тот же топик, увидеть данные от операторской панели.</p><p class="pp">
        Можно также установить, например,  приложение  для Андроид <a href="https://play.google.com/store/apps/details?id=at.tripwire.mqtt.client&hl=ru" rel="nofollow" target="_blank">MyMQTT</a>
        , и через приложение подключиться к этому же брокеру на тот же топик, получать данные от панели в приложении. </p><p class="pp">
        В приложении также можно публиковать данные, и если это сделать на тот же топик, то на странице demo.php в поле данных  можно будет видеть то, что вы отправили из приложения.
        Так как вряд ли вы отправите строку в формате JSON, она не будет преобразована в значения переменных, а просто отобразится в логе данных.

    </p>
    <p class="pp">
        <br />
        Надеемся, данный материал поможет вам в освоении протокола MQTT и его использовании в операторских панелях Weintek. Операторские панели, поддерживающие протокол MQTT, всегда на наших складах в Санкт-Петербурге и Москве. Вопросы можно задавать по телефонам ( в шапке сайта ), email ( в шапке сайта ), или в чате, который всплывает справа.
    </p>



    <br><br>
</div>
<?
echo "</article>";
//------------------- end content

if(EX != "_"){
    require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

}else{
    ?>
    <style>
        article{max-width: 1000px;margin: 0 auto;text-align: center;}
        h1,h2{
            font-family: Verdana, 'Lucida Grande';
            font-size: 20px;
            margin-bottom:20px;
        }
        h2{
            font-size:18px;
            margin-top: 35px;
        }

        .pp,.pp1,.pp2{
            font-family: Verdana, 'Lucida Grande';
            font-size: 16px;
            text-align: justify;
            width: 1000px;
            margin-bottom: 20px;
        }

        .se{
            color: firebrick;
            font-weight: bold;
        }
        .podp{
            font-family: Verdana, 'Lucida Grande';
            font-size: 14px;
            font-weight: bold;
        }
        figcaption {
            margin-bottom: 30px;
        }
    </style>



    <?php
    temp3();
}
?>