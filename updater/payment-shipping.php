<?php
define("bullshit", 1);
include ("sc/dbcon.php");
include ("sc/lib_new.php");
database_connect();

$extra_openGraph = Array(
    "openGraph_image" => "http://www.rusavtomatika.com/upload_files/images/openGraph_images/payment-shipping.png",
    "openGraph_title" => "Оплата и доставка",
    "openGraph_siteName" => "Русавтоматика"
);
temp0("weintek");
top_buttons();
basket();
temp1_no_menu();
//temp1();
//left_menu();
temp2();
//---------------content ---------------------
?><article>
<div class="block_payment_shipping_cities">
    <div class="blockofcols_container">
        <div class="blockofcols_row">
            
            <div class="col-12">
                <h1>Оплата и доставка</h1></div>
            
                <div class="col-12"><h3 style="margin: 10px auto;">Оплата</h3>
                    <p>Оплата товара производится путем безналичного перечисления денежных средств на расчетный счет.</p>
                    <p>Если цена товара установлена в евро или долларах США, оплата производится в рублях по курсу ЦБ на день платежа.</p>
                </div>
                <div class="col-12"><h3 style="margin: 10px auto;color:#000;">Доставка по Российской Федерации</h3>
                    <p>Мы осуществляем доставку по всей территории РФ.</p>
                    <p>
                        <img style="float: right;margin: -3px 0 10px 25px;" alt="DPD" src="/images/logo-dpd.png" />
                        Мы работаем с курьерской службой
                        <!--noindex-->
                        <a href="https://www.dpd.ru" rel="nofollow" target="_blank">&laquo;DPD&raquo;</a>
                        <!--/noindex-->
                        . Они доставляют продукцию до адреса покупателя.<br>Срок доставки уточняйте при заказе у нашего менеджера.
                    </p>
                    <p>Отгрузка возможна любой транспортной компанией за счет получателя.</p>

                </div>
                <div class="col-12">
                    <h3>Бесплатная доставка</h3>
                    <p>Бесплатная доставка до адреса покупателя осуществляется при заказе от 10000 рублей курьерской службой <a href="https://www.dpd.ru" rel="nofollow" target="_blank">&laquo;DPD&raquo;</a></p>

                </div>
                <div class="col-12"><p style="margin: 10px auto 5px;">Список городов, в которые осуществляется <strong>БЕСПЛАТНАЯ</strong> доставка до адреса покупателя курьерской службой <a href="https://www.dpd.ru" rel="nofollow" target="_blank">&laquo;DPD&raquo;</a>:</p>
                <small>Список городов вы можете уточнить на сайте курьерской службой <a href="https://www.dpd.ru" rel="nofollow" target="_blank">&laquo;DPD&raquo;</a></small>
                </div>
                <div class="col-3">
                    <div class="cities-group">
                        <div class="letter">
                            А
                        </div>
                        <ul>
                            <li>
                                Абакан
                            </li>
                            <li>
                                Адлер</li>
                            <li>
                                Альметьевск</li>

                            <li>
                                Ангарск
                            </li>
                            <li>
                                Апатиты
                            </li>
                            <li>
                                Арзамас
                            </li>
                            <li>
                                Армавир
                            </li>
                            <li>
                                Архангельск
                            </li>
                            <li>
                                Асбест
                            </li>
                            <li>
                                Астрахань
                            </li>
                            <li>
                                Ачинск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Б
                        </div>
                        <ul>
                            <li>
                                Балаково
                            </li>
                            <li>
                                Балашиха
                            </li>
                            <li>
                                Барнаул
                            </li>
                            <li>
                                Белгород
                            </li>
                            <li>Белорецк</li>
                            <li>Бердск</li>
                            <li>Березники</li>
                            <li>
                                Бийск
                            </li>
                            <li>
                                Благовещенск
                            </li>
                            <li>Борисоглебск</li>
                            <li>Боровичи</li>
                            <li>
                                Братск
                            </li>
                            <li>
                                Брянск
                            </li>
                            <li>
                                Бугульма
                            </li>
                            <li>Бузулук</li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            В
                        </div>
                        <ul>
                            <li>
                                Великие Луки
                            </li>
                            <li>
                                Великий Новгород
                            </li>
                            <li>
                                Владивосток
                            </li>
                            <li>
                                Владикавказ
                            </li>
                            <li>
                                Владимир
                            </li>
                            <li>
                                Волгоград
                            </li>
                            <li>
                                Волгодонск
                            </li>
                            <li>
                                Волжский
                            </li>
                            <li>
                                Вологда
                            </li>
                            <li>Воркута</li>
                            <li>
                                Воронеж
                            </li>
                            <li>Воскресенск</li>
                            <li>Воткинск</li>
                            <li>
                                Всеволожск
                            </li>
                            <li>Выборг</li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Г
                        </div>
                        <ul>
                            <li>
                                Гатчина
                            </li>
                            <li>
                                Глазов
                            </li>
                            <li>
                                Горелово
                            </li>
                            <li>
                                Грозный
                            </li>
                        </ul>
                    </div>

                    <div class="cities-group">
                        <div class="letter">
                            Д
                        </div>
                        <ul>
                            <li>
                                Дзержинск
                            </li>
                            <li>
                                Димитровград
                            </li>
                            <li>
                                Дмитров
                            </li>
                            <li>Домодедово</li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Е
                        </div>
                        <ul>
                            <li>Ейск</li>
                            <li>
                                Екатеринбург
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cities-group">
                        <div class="letter">
                            Ж
                        </div>
                        <ul>
                            <li>
                                Железнодорожный
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            З
                        </div>
                        <ul>
                            <li>
                                Забайкальск
                            </li>
                            <li>
                                Зеленоград
                            </li>
                            <li>Златоуст</li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            И
                        </div>
                        <ul>
                            <li>
                                Иваново
                            </li>
                            <li>
                                Ижевск
                            </li>
                            <li>
                                Иркутск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Й
                        </div>
                        <ul>
                            <li>
                                Йошкар-Ола
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            К
                        </div>
                        <ul>
                            <li>
                                Казань
                            </li>
                            <li>
                                Калининград
                            </li>
                            <li>
                                Калуга
                            </li>
                            <li>
                                Каменск-Уральский
                            </li>
                            <li>Каменск-Шахтинский</li>
                            <li>
                                Камышин
                            </li>
                            <li>Качканар</li>
                            <li>
                                Кемерово
                            </li>
                            <li>Керчь</li>
                            <li>
                                Киров
                            </li>
                            <li>Кирово-Чепецк</li>
                            <li>
                                Клин
                            </li>
                            <li>Клинцы</li>
                            <li>Ковров</li>
                            <li>
                                Коломна
                            </li>
                            <li>Колпино</li>
                            <li>
                                Комсомольск-на-Амуре
                            </li>
                            <li>
                                Кострома
                            </li>
                            <li>
                                Котлас
                            </li>
                            <li>
                                Красногорск
                            </li>
                            <li>
                                Краснодар
                            </li>
                            <li>Краснокамск</li>
                            <li>
                                Красноярск
                            </li>
                            <li>Кузнецк</li>
                            <li>
                                Курган
                            </li>
                            <li>
                                Курск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Л
                        </div>
                        <ul>
                            <li>
                                Ленинск-Кузнецкий
                            </li>
                            <li>
                                Ливны
                            </li>
                            <li>
                                Липецк
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            М
                        </div>
                        <ul>
                            <li>
                                Магнитогорск
                            </li>
                            <li>Майкоп</li>
                            <li>Махачкала</li>
                            <li>
                                Миасс
                            </li>
                            <li>
                                Москва
                            </li>
                            <li>
                                Мурманск
                            </li>
                            <li>
                                Муром
                            </li>
                            <li>
                                Мытищи
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cities-group">
                        <div class="letter">
                            Н
                        </div>
                        <ul>
                            <li>
                                Набережные Челны
                            </li>
                            <li>Наро-Фоминск</li>
                            <li>Находка</li>


                            <li>
                                Нижневартовск
                            </li>
                            <li>
                                Нижнекамск
                            </li>
                            <li>
                                Нижний Новгород
                            </li>
                            <li>
                                Нижний Тагил
                            </li>
                            <li>
                                Новокузнецк
                            </li>
                            <li>
                                Новомосковск
                            </li>
                            <li>
                                Новороссийск
                            </li>
                            <li>
                                Новосибирск
                            </li>
                            <li>
                                Новочеркасск
                            </li>
                            <li>Новый Уренгой</li>
                            <li>
                                Ногинск
                            </li>
                            <li>Ноябрьск</li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            О
                        </div>
                        <ul>
                            <li>
                                Обнинск
                            </li>
                            <li>Одинцово</li>
                            <li>Октябрьский</li>
                            <li>
                                Омск
                            </li>
                            <li>
                                Орел
                            </li>
                            <li>
                                Оренбург
                            </li>
                            <li>Орехово-Зуево</li>
                            <li>
                                Орск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            П
                        </div>
                        <ul>
                            <li>
                                Пенза
                            </li>
                            <li>
                                Первоуральск
                            </li>
                            <li>
                                Пермь
                            </li>
                            <li>
                                Петрозаводск
                            </li>
                            <li>
                                Подольск
                            </li>
                            <li>
                                Псков
                            </li>
                            <li>
                                Пушкин
                            </li>
                            <li>
                                Пушкино
                            </li>
                            <li>
                                Пятигорск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Р
                        </div>
                        <ul>
                            <li>Рославль</li>
                            <li>Россошь</li>
                            <li>
                                Ростов-на-Дону
                            </li>
                            <li>
                                Рыбинск
                            </li>
                            <li>
                                Рязань
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            С
                        </div>
                        <ul>
                            <li>Салават</li>
                            <li>
                                Самара
                            </li>
                            <li>
                                Санкт-Петербург
                            </li>
                            <li>
                                Саранск
                            </li>
                            <li>
                                Саратов
                            </li>
                            <li>
                                Севастополь
                            </li>
                            <li>
                                Северодвинск
                            </li>
                            <li>
                                Серов
                            </li>
                            <li>
                                Серпухов
                            </li>
                            <li>
                                Симферополь
                            </li>
                            <li>
                                Смоленск
                            </li>
                            <li>
                                Солнечногорск
                            </li>
                            <li>Сосновый Бор</li>
                            <li>
                                Сочи
                            </li>
                            <li>
                                Ставрополь
                            </li>
                            <li>
                                Старый Оскол
                            </li>
                            <li>
                                Стерлитамак
                            </li>
                            <li>
                                Ступино
                            </li>
                            <li>
                                Сургут
                            </li>
                            <li>
                                Сызрань
                            </li>
                            <li>
                                Сыктывкар
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-3">
                    <div class="cities-group">
                        <div class="letter">
                            Т
                        </div>
                        <ul>
                            <li>
                                Таганрог
                            </li>
                            <li>
                                Тамбов
                            </li>
                            <li>
                                Тверь
                            </li>
                            <li>
                                Тольятти
                            </li>
                            <li>
                                Томилино
                            </li>
                            <li>
                                Томск
                            </li>
                            <li>
                                Тула
                            </li>
                            <li>
                                Тюмень
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            У
                        </div>
                        <ul>
                            <li>
                                Улан-Удэ
                            </li>
                            <li>
                                Ульяновск
                            </li>
                            <li>Усинск</li>
                            <li>Уссурийск</li>
                            <li>Усть-Кут</li>
                            <li>
                                Уфа
                            </li>
                            <li>
                                Ухта
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Х
                        </div>
                        <ul>
                            <li>
                                Хабаровск
                            </li>
                            <li>
                                Ханты-Мансийск
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Ч
                        </div>
                        <ul>
                            <li>
                                Чебоксары
                            </li>
                            <li>
                                Челябинск
                            </li>
                            <li>
                                Череповец
                            </li>
                            <li>
                                Чехов
                            </li>
                            <li>
                                Чита
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Ш
                        </div>
                        <ul>
                            <li>
                                Шахты
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Э
                        </div>
                        <ul>
                            <li>
                                Энгельс
                            </li>
                        </ul>
                    </div>
                    <div class="cities-group">
                        <div class="letter">
                            Я
                        </div>
                        <ul>
                            <li>
                                Ярославль
                            </li>
                        </ul>
                    </div>
                </div>
            
        </div>
    </div>
</div>
</article>
<?
//------------------------------body
//-----------------end content
temp3();
?>
