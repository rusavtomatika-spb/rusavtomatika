<?
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $current_component;
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
$DESCRIPTION = 'EasyAccess 2.0';
$KEYWORDS = '';
$TITLE = 'EasyAccess 2.0';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";

require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new.php';

$num = "easyaccess";
$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";
$res = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_object($res);

?>
<script>


    (function($) {
        $(function() {
            var widthlist = $('.tabs__guide__caption').width() - 2;
            $('.tabs__guide__content').css("marginLeft", widthlist);
            window.onload = function() {
                asd = $('.tabs__guide.vertical').height();

            var topblocktabs = $('.tabs__guide').offset().top;

 var dsa = $('.tabs__guide__caption').height();
            asd = $('.tabs__guide.vertical').height();
            topdowindownext = asd - dsa;
            slicktabs();


            function slicktabs() {
                $('.tabs__guide__content').css("marginLeft", widthlist);
                topblocktabs = $('.tabs__guide').offset().top;

                var difer = $(window).scrollTop() - topblocktabs + 25;


                if(difer > 0 && difer < topdowindownext){
                    $('.tabs__guide__caption').css({'position' : 'fixed', 'top' : '25px'});
                }else if(difer < 0){
                    $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : '0px'});
                }
                else if( difer > topdowindownext){
                    $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : 'auto', 'bottom' : '0px'});
                }


                $(window).scroll(function() {

                    var difer = $(window).scrollTop() - topblocktabs + 25;


                    if(difer > 0 && difer < topdowindownext){
                        $('.tabs__guide__caption').css({'position' : 'fixed', 'top' : '25px'});
                    }else if(difer < 0){
                        $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : '0px'});
                    }
                    else if( difer > topdowindownext){
                        $('.tabs__guide__caption').css({'position' : 'absolute', 'top' : 'auto', 'bottom' : '0px'});
                    }

                });
            }
            $("ul.tabs__guide__caption").on("click", "li:not(.active)", function() {
                $(this)
                    .addClass("active")
                    .siblings()
                    .removeClass("active")
                    .closest("div.tabs__guide")
                    .find("div.tabs__guide__content")
                    .removeClass("active")
                    .eq($(this).index())
                    .addClass("active");
                if ($("#topper").length !== 0) { // проверим существование элемента чтобы избежать ошибки
                    $('html, body').animate({ scrollTop: $("#topper").offset().top }, 300); // анимируем скроолинг к элементу scroll_el
                }
                asd = $('.tabs__guide.vertical').height();
                topdowindownext = asd - dsa;
                slicktabs();
            });
            };
        });

    })(jQuery);








</script>

<style>
    table.eatable tr{border-bottom: 1px solid grey;}

    table.eatable td{
        padding: 4px 0;
    }
    h2{
        color: #000000;
    }
    .block_content h2{
        margin-left: 0px;
    }
    #tabs {
        min-height: auto;
        font-size: 16px;
    }
    #tabs div{
        min-height: auto;
        font-size: 16px;
    }
    #tabs small{
        font-size: 14px;
    }

</style>
<article>
    <div class="blockofcols_container">

        <?/*?>
        <section>



            <h2>Как работает EasyAccess 2.0?</h2>
            <p>Технология доступа EasyAccess 2.0 сильно отличается от традиционного способа удаленного доступа. Вот несколько примечательных моментов:</p>





            <div class="blockofcols_row" style="margin: 25px 0">
                <div class="col-6" style="padding: 15px">
                    <div style="background-color: rgba(91, 155, 213, 0.1);padding: 25px;border-bottom: 4px solid #5b9bd5;height: 181px;">
                    <p><b>Классическое удаленное соединение (синие линии)</b></p>

            <ul class="spisok">
                <li>Трафик будет проходить через несколько межсетевых экранов, по этому требуется сетевая настройка.</li>
                <li>Для одного внешнего IP можно подключить только одно устройство.</li>
                <li>Если панели оператора подключена через два (или несколько) роутера, подключение может быть невозможно.</li>
            </ul>

    </div>

                </div>
                <div class="col-6" style="padding: 15px">
                    <div style="background-color: rgba(142, 206, 99, 0.23);padding: 25px;border-bottom: 4px solid #466531;height: 181px;">
                    <p><b>Соединение с помощью EasyAccess 2.0 (зеленные линии)</b></p>

                        <ul class="spisok">
                            <li>ПК и панель оператора подключаются к выделенному VPN-серверу, через который осуществляется обмен данными</li>
                            <li>Никаких дополнительных настроек сети не требуется.</li>
                            <li>К одному внешнему IP можно подключить несколько устройств.</li>
                            <li>Нахождение за несколькими маршрутизаторами никак не влияет на соединение EasyAccess 2.0.</li>
                        </ul>


                    </div>
                </div>

            </div>
<img style="width: 100%" alt="схема 1" src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip0.png">

        </section>
 <?*/?>

        <section>

            <h1>EasyAccess 2.0</h1>
            <div id="topper"></div>
            <?/*?>
            <h2>Как начать работать с EasyAccess 2.0</h2>

            <?*/?>
            <div class="color_text_block" style="    margin: 25px 0px;">
                <p>EasyAcces 2.0 является платной. Стоимость лицензии <b>55$</b> .Действие лицензии распространяется на одну панель на весь период её использования.</p>
            </div>

            <div class="tabs__guide  vertical">

                <ul class="tabs__guide__caption">
                    <li class="active">1. Обзор и особенности</li>
                    <li>2. Системные требования и установка</li>
                    <li>3. Начало работы</li>
                    <li>4. Управление доменом (аккаунтом)</li>
                    <li>5. Добавление панели в домен<br>(Trial 30 дней)</li>
                    <li>6. Добавление панели в домен<br></li>
                    <li>7. EasyAccess 2.0 на ПК</li>
                </ul>
                <div class="tabs__guide__content  active">
                    <h2>Что такое EasyAccess 2.0?</h2>
                    <p>EasyAccess 2.0 это сервис, с помощью которого вы можете получить доступ к вашим панелям оператора и ПЛК из любой точки мира.
                        Вам достаточно активировать панели оператора и добавить их к вашему аккаунту EasyAccess 2.0 (на сайте account.ihmi.net), и убедиться, что панели имеют выход в Интернет.
                        После настройки, вы сможете работать с удаленными панелями и ПЛК в вашей локальной сети. Каждое устройство внутри этой сети будет иметь уникальный IP.
                        Данные, передаваемые через данную сеть защищены протоколом SSL 128 бит. Данный протокол обеспечивает безопасность и надежность передачи данных.</p>
                    <div class="blockofcols_row" style="margin: 25px 0">
                        <div class="col-1"></div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/icon-security.png')"></div>
                            <div class="under_text">Безопасность —шифрование SSL</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/icon-users.png')"></div>
                            <div class="under_text">Управление доступом пользователей</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/icon-circle2.png')"></div>
                            <div class="under_text">Без выделенного IP панели оператора</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/icon-passphrough.png')"></div>
                            <div class="under_text">PassThrough — управление PLC через HMI</div>
                        </div>
                        <div class="col-2">
                            <div class="image_bg_cover" style="background-image: url('http://www.rusavtomatika.com/upload_files/images/icon-ipad2.png')"></div>
                            <div class="under_text">Управление HMI с мобильных устройств</div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <h2>
                    Для чего нужен EasyAccess 2.0?
                    </h2>
                    <p>
                        В последние время все больше стали появляться запросы на удаленное управление панелями оператора.
                        Если у вас задача удаленно подключится к панели оператора, которая установлена на вашем производстве, то вам нужно узнать IP адрес вашей панели, чтобы к ней подключиться. Что делать если вы не знаете какой IP у панели? Есть несколько способов как это сделать.
                    </p>
                    <p>Первый способ – это классическое подключиться к панели по ее белому IP адресу. Данный способ имеет ряд затруднений:</p>
                    <ul class="spisok">
                        <li>Необходимо просить у оператора связи, чтобы он выдал вам белый IP (Бывают случаи, когда это невозможно)</li>
                        <li>Необходимо настраивать сетевое оборудование</li>
                        <li>Для каждой панели нужен свой уникальный белый IP</li>
                    </ul>
                    <p>Второй способ – использовать EasyAccess 2.0.</p>
                    <p>С EasyAccess 2.0 вы избавляетесь от проблем, описанных в первом способе.
                        Данный сервис создает вириальную сеть между вашими устройствами, выдавая каждому устройству уникальный IP.
                        Используя данный IP Адрес, вы можете удаленно подключаться к панелям оператора и выполнять манипуляции с ними.
                    </p>
                    <h2>Что позволяет делать EasyAccess 2.0?</h2>
                    <ol class="spisok">
                        <li>Управлять панелью через VNC-клиент, CMT Viewer (доступна только для серии панелей оператора CMT).
                            Вы можете видеть, что происходит на экране вашей панели, наживать кнопки.
                        </li>
                        <li>Перезаливать проект</li>
                        <li>Просматривать журнал событий</li>
                        <li>Загружать файлы через FTP. (Если панель поддерживает ftp)</li>
                        <li>Производить диагностику</li>
                    </ol>

                </div>
                <div class="tabs__guide__content">
                    <h2>Системные требования</h2>
                    <ul class="spisok">
                        <li>Операционная система: Windows XP, Windows 7, Windows 8 (32 / 64бит), Windows 10 (32 / 64бит) (Необходимы права администратора)</li>
                        <li>Панель оператора Weintek с активированным EasyAccess 2.0 </li>
                        <li>Интернет-соединение</li>
                        <li>EasyBuilder Pro v4.10.05 или новее</li>
                        <li>IOS: 7.0 или старше</li>
                        <li>Android: v4.1.2 или старше</li>
                    </ul>



                </div>
                <div class="tabs__guide__content">

                    <h2>Порядок дейсвтией</h2>
                    <p>Чтобы начать использовать EasyAccess 2.0, нужно выполнить следующие шаги. Смотрите соответствующие разделы, подробно описывающие шаги.</p>
                    <ol class="spisok">
                        <li>Панель оператора должна быть активирована (Если ваша панель не имеет уже активированный EasyAccess2.0, то обратитесь к нашим менеджерам в онлайн-чате.)</li>
                        <li>Управление доменом (аккаунтом) (Пункт 4)<br> Должен быть создан аккаунт (Домен) на сайте <a href="https://account.ihmi.net">account.ihmi.net</a></li>
                        <li>Добавление панели в домен (Пункт 6)<br>Если вы хотите попробовать 30 дневную версию, то переходите к (Пункт 5)<br>Панель оператора должна быть добавлена в Домен</li>
                        <li>Добавление пользователя и открытия ему доступа к панели<br>Должна быть создана учетная запись Пользователя, к которой будет привязана панель оператора</li>
                        <li>EasyAccess 2.0 должен быть установлен на ПК</li>
                    </ol>
                    <p>После того, как все шаги выполнины, пользователь сможет удаленно подключиться к панели оператора</p>


<h2>Активация панели</h2>
                            <p>Нужно активировать панель оператора, чтобы начать пользоваться EasyAccess 2.0.
                                В модельной линейке имеются уже активированные панели оператора, например <a href="/weintek/cMT3072.php">cMT3072</a>.
                                У таких панелей у нас на сайте написано “Лицензия EasyAccess 2.0 входит в стоимость”.
                                В ином случае вам необходимо обраться к нам, чтобы активировать вашу панель.
                                Также убедитесь, что ваша панель поддерживает EasyAccess 2.0.
                                Модели, которые поддерживают данную технологию имеют пометку “Удаленный доступ по EasyAccess”.</p>

                    <h2>Терминалогия</h2>

                    <ul class="spisok">
                        <li><b>Домен и администратора домена</b>
                            <p>Доменом называется аккаунт, к которому привязываются панели оператора.
                                <b>Панель оператора может быть привязана только к одному домену.</b>
                                Администратора домена, это пользователь, который может управлять панелями оператора
                                и пользователями через веб интерфейс на сайте (<a href="https://account.ihmi.net">account.ihmi.net</a>).
                                Аккаунт администратора домена не используется для входа в клиентскую программу EasyAccess 2.0.</p></li>
                        <li> <b>Группа панелей оператора</b>
                            <p>Панели оператора можно объединять в группы. Такие группы можно назначать пользователям.
                                Пользователи получат возможность управлять всеми панелями из группы, которую им назначили.
                                Панель оператора может быть назначена в разные группы. Группы формирует и назначает администратор домена.</p></li>
                        <li>
                            <b>Пользователь</b>
                            <p>Пользователь — это аккаунт, который может авторизоваться в клиентской программе
                                EasyAccess 2.0 и удаленно управлять панелями оператора, а также группами панелей,
                                которые ранее ему назначил администратор домена.</p></li>
                    </ul>


                            <h2>Пример распределения прав</h2>
                            <p>Рассмотрим следующий рисунок для иллюстративного примера домена.</p>
                            <ol class="spisok">
                                <li>В этом примере домен с именем «Мой домен» имеет двух пользователей, Петра и Нину.</li>
                                <li>В этом примере панели оператора сгруппированы в группы: Группа 1, Группа 2, Группа 3 и т.д. Панель оператора A принадлежит к двум группам</li>
                                <li>Пользователи могут принадлежать ко многим группам. А так же иметь доступ к панелям оператора, которые не имеют группы. (Пользователь Петр и группа 1)</li>
                                <li>Пользователи могут быть напрямую связаны с панелями оператора и иметь к ним доступ. (Пользователь Нина и панель оператора J).
                                    Несколько пользователей могут получить доступ к одной и той же панели оператора,
                                    независимо от того, назначены ли они группам (панелей оператора А) или путем прямой связи (панель оператора H).</li>
                            </ol>
<p>Доступы настраиваются администратором домена. </p>

                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.png" data-fancybox="gallery0"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.png"></a></p>


                </div>

                <div class="tabs__guide__content">
                    <h2>Создание аккаунта (Домена)</h2>
                    <ol>
                    <li><p>Система управления доменами находится по адресу: <a href="https://account.ihmi.net">account.ihmi.net</a></p>
                    <p>Зайдите на сайт, нажмите кнопку [Create Domain account] и переходите к заполнению формы вашими данными</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.png"></a></p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.png"></a></p>
                    </li>
                        <li>
                    <p>Если вы все заполнили верно, то вам на почту придет письмо со ссылкой на подтверждение. Найдите это письмо и подтвердите регистрацию переходом по ссылке.</p>
                    <p>Теперь можно авторизоваться в системе управления доменом. Для этого на главной странице
                        <a href="https://account.ihmi.net/">account.ihmi.net/</a> нажмите кнопку [Domain]</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.png"></a></p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.png" data-fancybox="gallery1"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.png"></a></p>
                        </li>
                    </ol>


<h2>Добавление пользователя и открытие ему доступа</h2>

                    <ol>
                        <li>
                            <p>Найдите вкладку [User] (Пользователь). На нашей картинке в списке уже есть один пользователь.
                                Ваш список изначально будет пустым. Нажмите кнопку [+Add User] для добавления пользователя. </p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.png"></a></p>
                        </li>
                        <li>
                            <p>Для нового пользователя введите логин и его почту, на которую придет сгенерированный автоматически пароль. </p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.png"></a></p>
                        </li>
                        <li>
                            <p> Найдите панель в списке. Отметьте ее и нажмите значок редактирования или кнопку [Edit HMI]. Отметьте галочкой нужного пользователя и нажмите [Save].</p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.png"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.png"></a></p>
                            <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.png"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>Добавление панели в домен (Trial 30 дней)</h2>
                    <ol>
                        <li>
                    <p>В своем домене на сайте <a href="//account.ihmi.net">account.ihmi.net</a>, на вкладке "Devices" - "HMI List"  нажмите кнопку [+ Add HMI]</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.png" data-fancybox="gallery2"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.png"></a></p>
                        </li>
                        <li>
                    <p>Выберите тип активации:  30 days Free Trial</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.png" data-fancybox="gallery2"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.png"></a></p>

                    <p>Введите Hardware key (аппаратный ключ)  и подтвердите их кнопкой [Free Trial].</p>

                    <p>HWkey (Hardware key - аппаратный ключ) вы можете узнать, зайдя в вашей панели на страницу системных настроек [System Settings] на вкладке [EasyAccess 2]</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.png" data-fancybox="gallery2"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.png"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>Добавление панели в домен</h2>
                    <ol>
                        <li>
                    <p>Свяжитесь с нашими менеджерами и сообщите им HW-key (Hardware key  - аппаратный ключ). Как узнать ключ смотреть в предыдущем шаге.
                        Мы поддвердим вам, что активация произошла.</p>
                        </li>
                        <li>
                    <p>С помощью программы EasyBuilderPro нужно создать и загрузить в панель проект, позволяющий открывать на панели страницу с настройками EasyAccess 2.0.
                        Создайте в EasyBuilderPro новый проект. </p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.png"></a></p>
                        </li>
                        <li>
                        <p>В системных настройках проверьте расположение сервера EasyAccess2.0. Должен быть выбран "Глобальный"</p>
                        <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.png"></a></p>
                        </li>
                        <li>
                    <p>Добавьте функциональную кнопку, которая открывает окно №76 EasyAccess 2.0 Settings. Загрузите проект в панель.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.png"></a></p>
                        </li>
                        <li>
                    <p>Теперь в новом проекте вашей панели есть кнопка, при нажатии которой, откроется окно с настройками EasyAccess 2.0.
                        Подключите вашу панель к интернету и откройте окно EasyAccess 2.0. После нажатия кнопки [Start] в полях [Session ID] и [Password] появятся значения,
                        которые вам будут нужны в следующем шаге.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.png"></a></p>
                        </li>
                        <li>
                        <p>В своем домене на сайте <a href="//account.ihmi.net">account.ihmi.net</a>, на вкладке "Devices" - "HMI List"  нажмите кнопку [+ Add HMI]</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.png" data-fancybox="gallery2"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.png"></a></p>
                        </li>
                        <li>
                            <p> Выберите тип активации:  [Add by session Id/password]. Введите Session ID и [Password], полученные на предыдушем шаге. Подтвердите кнопкой [Assign]. Вы добавили панель оператора в домен. Теперь нужно создать пользователя и открыть ему доступ к панели.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.png"></a></p>
                        </li>
                    </ol>
                </div>

                <div class="tabs__guide__content">
                    <h2>EasyAccess 2.0 на ПК</h2>
                    <p>EasyAccess 2.0 предоставляется как отдельная программа, которую можно установить на ПК. Он может использоваться независимо от программного пакета EasyBuilder.</p>
                    <p><a href="/soft/EasyAccess/EasyAccess20_setup.zip">
                            <div class="download__inner" style="width: 250px;">
                                <div class="download__img" style="background-image: url(/images/zip.svg)"></div>
                                <div class="download__text"><div class="download__text__title">Дистрибутив ver 2.3.0 для PC</div><div class="download__text__p">[23-11-2016 65.12 Мб]</div></div>
                                <div class="clearfix"></div>
                            </div>
                        </a></p>
                    <h3>Авторизация</h3>
                    <p>Заполните имя Домена, Имя пользователя Домена, пароль.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.png"></a></p>
<h3>Главный экран</h3>
                    <p>После того, как вы зайдете в систему, вы окажетесь на главном экране.
                        Тут отображаются все панели оператора доступные пользователю.
                        Также отображаются статусы панелей. Вы можете подключаться к неограниченному количеству панелей.
                        Однако после того, как вы подключились к панели, то эта панель получает статус “Занято”.
                        К такой панели больше никто не сможет подключиться, до тех пор, пока вы не будет разорвано текущее соединение.</p>
                    <p style="text-align: center"><a class="img__easyaccess" href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.png" data-fancybox="gallery3"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.png"></a></p>
                    <p><b>Функции иконок на главном экране:</b></p>
                    <table class="eatable">
                        <tbody>
                        <tr>
                            <td>Иконка</td>
                            <td>Функция</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea3.png"></p></td>
                            <td>Трафик домена</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea4.png"></p></td>
                            <td>Поиск панели оператора</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea5.png"></p></td>
                            <td>
                                Вид: плитка/список</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea6.png"></p></td>
                            <td>Настройки</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea7.png"></p></td>
                            <td>Выход из текущего пользователя</td>
                        </tr>
                        <tr>
                            <td style="width: 260px;"><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea8.png"></p></td>
                            <td>Журналы подключений</td>
                        </tr>
                        </tbody>
                    </table>

                    <h3>Состояния панели оператора и настройка доступа</h3>
                    <p>Панель оператора может находиться в одном из состояний: Офлайн, Онлайн, Соединено, Занято.</p>
                    <table class="eatable">
                    <tbody>
                    <tr style="border-bottom: none;">
                        <td><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea9.png"></p></td>
                        <td><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea10.png"></p></td>
                    </tr>
                    <tr>
                        <td>Офлайн</td>
                        <td>Онлайн</td>
                    </tr>
                    <tr style="border-bottom: none;">
                        <td><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea11.png"></p></td>
                        <td><p style="text-align: left"><img src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea12.png"></p></td>
                    </tr>
                    <tr>
                        <td>Соедино</td>
                        <td>Занято</td>
                    </tr>
                    </tbody>
                    </table>

                </div>





            </div>

        </section>



        <section class="all_panel_with_ea20">
        <h2>Панели оператора с поддержкой EasyAccess 2.0</h2>

            <div id="tabs">
                 <ul>

                    <li class="urlup" data="functions">
                        <a href="#tabs-1">
                        Серия: <strong>MT8000iE</strong>
                        </a>
                    </li>
                    <li class="urlup" data="dimensions">
                        <a href="#tabs-2">
                            Серия: <strong>MT8000XE</strong>
                        </a>
                    </li>
                    <li class="urlup" data="scheme">
                        <a href="#tabs-3">
                            Серия: <strong>cMT</strong>
                        </a>
                    </li>
                     <li class="urlup" data="scheme">
                         <a href="#tabs-4">
                             Серия: <strong>mTV</strong>
                         </a>
                     </li>
                </ul>

                <div id="tabs-1">
                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "MT8000iE",
                            "background" => "#f0f0f0;",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "MT8000iE",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>
                </div>

                <div id="tabs-2">
                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "MT8000XE",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "MT8000XE",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>
                </div>
                <div id="tabs-3">

                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "cMT",
                            "background" => "#f0f0f0;",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "cMT",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>


                    </div>
                <div id="tabs-4">

                    <?
                    $component->show(array(
                        "component_name" => "news.list",
                        "component_template" => "easyaccess_list",
                        "template_arguments" => array(
                            "title" => "Weintek",
                            "series" => "mTV",
                            "title_link" => "/weintek/"
                        )),array(
                            "table" => "products_all",
                            "order" => "diagonal",
                            "series" => "mTV",
                            "custom_sql_query" => "and ((`easy_access` like 'optional') or (`easy_access` like 'build_in'))"
                        )
                    );
                    ?>


                </div>
            </div>


        </section>



        <section>
        <h2>Скачать</h2>
            <div class="blockofcols_row">
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">
                    <div class="download__inner">
                        <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>
                        <div class="download__text"><div class="download__text__title">Руководство (eng)</div><div class="download__text__p">[25-03-2016 3.01 Мб]</div></div>
                        <div class="clearfix"></div>
                    </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">
                    <div class="download__inner">
                        <div class="download__img" style="background-image: url(/images/android.svg)"></div>
                        <div class="download__text"><div class="download__text__title">Дистрибутив для Android</div><div class="download__text__p">[Последняя версия]</div></div>
                        <div class="clearfix"></div>
                    </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="/soft/EasyAccess/EasyAccess20_setup.zip">
                    <div class="download__inner">
                        <div class="download__img" style="background-image: url(/images/zip.svg)"></div>
                        <div class="download__text"><div class="download__text__title">Дистрибутив ver 2.3.0 для PC</div><div class="download__text__p">[23-11-2016 65.12 Мб]</div></div>
                        <div class="clearfix"></div>
                    </div>
                    </a>
                </div>
            </div>
        </section>

    </div>






</article>

<?

include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/epilog.php";
?>

