<?php
global $CONTENT_ON_WIDE_SCREEN, $TITLE;
$TITLE = "Контакты - Русавтоматика, Weintek, Samkoon, IFC, Aplex в Санкт-Петербурге и Москве";
$CONTENT_ON_WIDE_SCREEN = true;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
$CANONICAL = "https://www.rusavtomatika.com/contacts/";
$DESCRIPTION = 'В нашем офисе вы всегда сможете ознакомиться со всей нашей продукцией, получить консультацию по применению всего модельного ряда.';
?>
    <article>
        <div class="container is-widescreen" itemscope itemtype="https://schema.org/Organization">
            <div class="columns">
                <div class="column is-12">
                    <h1>Контакты</h1>
                    <div class="my-3 p-4 has-text-centered has-background-light">
                        <h3>Заявки с реквизитами отправлять на почту: <a class="bright_text"
                                                                         href='mailto:sales@rusavtomatika.com'
                                                                         title='Отправить нам сообщение на sales@rusavtomatika.com'>sales@rusavtomatika.com</a>
                        </h3>
                        <h3>Задавайте вопросы в чат, в правом нижнем углу экрана. Отвечают живые люди. Роботов нет!</h3>
                    </div>
                    <div class="columns is-multiline">
                        <div class="column is-3-desktop is-6-tablet">
                            <p class="is-nowrap">
                                <span class="icon"><i class="fa-solid fa-phone"></i></span>
								<a itemprop="telephone" href="tel:+88006003347" class="nowrap header_phone">8 (800) 600-33-47</a>
								<meta itemprop="telephone" content="+88006003347">
                            </p>
                        </div>
                        <div class="column is-3-desktop is-6-tablet">
                            <p class="is-nowrap">
                                <span class="icon"><i class="fa-solid fa-phone"></i></span>
								<a itemprop="telephone" href="tel:+78127650160" class="nowrap header_phone">7 (812) 765-01-60</a>
								<meta itemprop="telephone" content="+78127650160">
                            </p>
                        </div>
                        <div class="column  is-3-desktop is-6-tablet">
                            <p class="is-nowrap">
                                <span class="icon"><i class="fa-solid fa-envelope"></i></span>&nbsp;<a
                                        href='mailto:sales@rusavtomatika.com'
                                        title='Отправить нам сообщение на sales@rusavtomatika.com'>sales@rusavtomatika.com</a>
                            </p>
                        </div>
                        <div class="column  is-3-desktop is-6-tablet">
                            <p class="is-nowrap">
                                <span class="icon"><i class="fa-solid fa-gears"></i></span> <a href='/support/'>Техподдержка</a>
                            </p>
                        </div>
                    </div>

                    <div class="message  my-1 has-background-light">
                        <div class="p-5">
                            <div class="columns">
                                <div class="column is-8">
                                    <div class="my-2"><span
                                                class="has-text-weight-bold is-size-5">Обратный звонок</span> - мы
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
                    </div>


                    <div>
                        <h3><span class="icon"><i class="fa-solid fa-building"></i></span> <span itemprop="name">Головной офис и склад в Санкт-Петербурге</span>
                        </h3>
                        <meta itemprop="description"
                              content="Поставка оборудования для автоматизации производства. Официальный дистрибьютор брендов Weintek, IFC, Aplex, eWON, Yottacontrol.">
                        <p>На основном складе в Санкт-Петербурге всегда поддерживается в наличии
                            весь модельный ряд <a href="/catalog/operator_panels/?brand=Weintek">операторских панелей
                                Weintek</a>, <a href="/catalog/operator_panels/?brand=Samkoon">панелей оператора
                                Samkoon</a>,
                            а также промышленных <a href="/catalog/panel_computers/?&brand=Aplex">панельных компьютеров
                                Aplex</a> и <a href="/catalog/panel_computers/?&brand=IFC">IFC</a></p>
                        <p>В нашем офисе вы всегда сможете ознакомиться со всей нашей продукцией,
                            получить консультацию по применению всего модельного ряда.</p>

                        <div class="columns" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                            <div class="column is-6">
                                <h3><span class="icon"><i class="fa-solid fa-location-dot"></i></span> Адрес:</h3>
                                <div class="box has-background-light is-shadowless">
                                    <p><span itemprop="postalCode">199178</span>, <span itemprop="addressLocality">Санкт-Петербург</span>,
                                        <span itemprop="streetAddress"
                                              class="nowrap">Малый пр. В.О., 57 корп. 3</span></span>
                                    </p>

                                </div>
                            </div>
                            <div class="column is-6">
                                <h3><span class="icon"><i class="fa-solid fa-clock"></i></span> Время работы:</h3>
                                <div class="box has-background-light is-shadowless">
                                    <p>Пн-Чт: с 9.00 до 18.00, Пт: с 9.00 до 17.00.<br>Обеденный перерыв с 13.00 до
                                        14.00.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h3><span class="icon"><i class="fa-solid fa-map-location-dot"></i></span> &nbsp;Схема проезда к
                        головному офису и складу в Санкт-Петербурге</h3>


                    <div class="box has-background-light is-shadowless">
                        <p><b>Построить маршрут в яндекс-картах до адреса:</b> <a
                                    href="https://yandex.ru/maps/-/CBFbMCQesB">Санкт-Петербург, Малый пр. В.О.
                                57 корп. 3</a></p>
                        <p><b>Ссылка на изображение карты:</b> <span>https://www.rusavtomatika.com/upload_files/images/map.png</span>
                        </p>
                        <p><span class="icon"><i class="fa-solid fa-print"></i></span>
                            <a href="javascript:print1()">Напечатать схему проезда</a>
                            <script type="text/javascript">// <![CDATA[
                                function print1() {
                                    var win = window.open();
                                    win.document.write('<img src="/upload_files/images/map.png">');
                                    win.print();
                                    win.close()
                                }

                                // ]]></script>
                        </p>
                        <p>
                            <a target="_blank" href="//www.rusavtomatika.com/upload_files/images/map.png"
                               title="Открыть схему проезда в новом окне">
                                <img src="//www.rusavtomatika.com/upload_files/images/map.png" alt="Схема проезда"/>
                            </a>
                        </p>
                    </div>
                    <h3><span class="icon"><i class="fa-solid fa-map-location-dot"></i></span> &nbsp;Интерактивная карта
                        головного офиса и склада в Санкт-Петербурге</h3>
                    <div class="box has-background-light is-shadowless">
                        <script type="text/javascript" charset="utf-8" async
                                src="//api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8bedbdfe30d11e418ba92f068977945135c87ec9df474e49afb3ebdee1b2d00c&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
                    </div>

                    <h2><span class="icon"><i class="fa-solid fa-truck"></i></span> &nbsp;Доставка по Российской
                        Федерации</h2>
                    <div class="box has-background-light is-shadowless">
                        <p>Осуществляем доставку по всей территории РФ.</p>
                        <p>
                            <img style="float: right;margin: -3px 0 10px 25px;" alt="СДЭК" src="/images/logo-cdek.svg"/>
                            Мы работаем с курьерской службой &laquo;СДЭК&raquo;. Они доставляют продукцию до адреса покупателя.<br>Срок доставки уточняйте при заказе у
                            нашего менеджера.
                        </p>
                        <p>Отгрузка возможна любой транспортной компанией за счет получателя.</p>
                        <h3>Бесплатная доставка</h3>
                        <p>Бесплатная доставка до адреса покупателя осуществляется при заказе от 10000 рублей курьерской службой &laquo;СДЭК&raquo;</p>

                    </div>
                    <!--h2>Реквизиты компании ООО «РУСАВТОМАТИКА»</h2>
                    <div class="box has-background-light is-shadowless">
                        <div class="columns">
                            <div class="column is-6">
                                <p><b>Юридический адрес:</b> 199178, Санкт-Петербург, Малый проспект Васильевского
                                    острова, дом 57, корпус 3, литера А, помещение 12Н</p>
                                <p>ИНН 7801325780</p>
                                <p>КПП 780101001</p>
                                <p>ОГРН 1167847501161</p>
                            </div>
                            <div class="column is-6">
                                <p><b>Банковские реквизиты:</b></p>
                                <p>ПАО Банк ЗЕНИТ</p>
                                <p>р/с 40702810200420004759</p>
                                <p>к/с 3О1О1810000000000272</p>
                                <p>БИК 044525272</p>
                            </div>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
        </div>
    </article>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";
