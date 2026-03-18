<?php

CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css?" . rand());

//CoreApplication::add_script(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/script.js");

?>

<div id="vue_app_easyaccess">

    <div class="columns is-multiline">

        <div class="column is-3-desktop is-12-mobile">

            <ul class="tabs__guide__caption">

                <li class="button is-fullwidth" @click="change_section(1)"

                    :class="{ 'is-success': current_section==1 }">Обзор и особенности

                </li>

                <li class="button is-fullwidth" @click="change_section(2)"

                    :class="{ 'is-success': current_section==2 }">Системные требования <br>и установка

                </li>

                <li class="button is-fullwidth" @click="change_section(3)"

                    :class="{ 'is-success': current_section==3 }">Начало работы

                </li>

                <li class="button is-fullwidth" @click="change_section(4)"

                    :class="{ 'is-success': current_section==4 }">Управление доменом <br>(аккаунтом)

                </li>

                <li class="button is-fullwidth" @click="change_section(5)"

                    :class="{ 'is-success': current_section==5 }">Добавление панели в домен<br>(Trial 30 дней)

                </li>

                <li class="button is-fullwidth" @click="change_section(6)"

                    :class="{ 'is-success': current_section==6 }">Добавление панели в домен<br></li>

                <li class="button is-fullwidth" @click="change_section(7)"

                    :class="{ 'is-success': current_section==7 }">EasyAccess 2.0 на ПК

                </li>

                <li class="button is-fullwidth" @click="change_section(8)"

                    :class="{ 'is-success': current_section==8 }">Ограничения

                </li>

            </ul>

        </div>

        <div class="column is-9-desktop is-12-mobile">

            <section>

                <div id="topper"></div>

                <div class="tabs__guide  vertical">

                    <div class="tabs__guide__content" v-if="current_section == 1">

                        <h2>Обзор и особенности</h2>

                        <h3>Что такое EasyAccess 2.0?</h3>

                        <p>EasyAccess 2.0 это сервис, с помощью которого вы можете получить доступ к вашим панелям

                            оператора и ПЛК

                            из любой точки мира.

                            Вам достаточно активировать панели оператора и добавить их к вашему аккаунту EasyAccess 2.0

                            (на сайте

                            weincloud.net), и убедиться, что панели имеют выход в Интернет.

                            После настройки, вы сможете работать с удаленными панелями и ПЛК в вашей локальной сети.

                            Каждое

                            устройство внутри этой сети будет иметь уникальный IP.

                            Данные, передаваемые через данную сеть защищены протоколом SSL 128 бит. Данный протокол

                            обеспечивает

                            безопасность и надежность передачи данных.</p>

                        <div class="columns">

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-security.png')"></div>

                                <div class="under_text">Безопасность —шифрование SSL</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-users.png')"></div>

                                <div class="under_text">Управление доступом пользователей</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-circle2.png')"></div>

                                <div class="under_text">Без выделенного IP панели оператора</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-passphrough.png')"></div>

                                <div class="under_text">PassThrough — управление PLC через HMI</div>

                            </div>

                            <div class="column is-2-desktop is-12-mobile">

                                <div class="image_bg_cover"

                                     style="background-image: url('https://www.rusavtomatika.com/upload_files/images/icon-ipad2.png')"></div>

                                <div class="under_text">Управление HMI с мобильных устройств</div>

                            </div>

                        </div>

                        <h2>

                            Для чего нужен EasyAccess 2.0?

                        </h2>

                        <p>

                            В последние время все больше стали появляться запросы на удаленное управление панелями

                            оператора.

                            Если у вас задача удаленно подключится к панели оператора, которая установлена на вашем

                            производстве, то

                            вам нужно узнать IP адрес вашей панели, чтобы к ней подключиться. Что делать если вы не

                            знаете какой IP

                            у панели? Есть несколько способов как это сделать.

                        </p>

                        <p>Первый способ – это классическое подключиться к панели по ее белому IP адресу. Данный способ

                            имеет ряд

                            затруднений:</p>

                        <ul class="spisok">

                            <li>Необходимо просить у оператора связи, чтобы он выдал вам белый IP (Бывают случаи, когда

                                это

                                невозможно)

                            </li>

                            <li>Необходимо настраивать сетевое оборудование</li>

                            <li>Для каждой панели нужен свой уникальный белый IP</li>

                        </ul>

                        <p>Второй способ – использовать EasyAccess 2.0.</p>

                        <p>С EasyAccess 2.0 вы избавляетесь от проблем, описанных в первом способе.

                            Данный сервис создает вириальную сеть между вашими устройствами, выдавая каждому устройству

                            уникальный

                            IP.

                            Используя данный IP Адрес, вы можете удаленно подключаться к панелям оператора и выполнять

                            манипуляции с

                            ними.

                        </p>

                        <h2>Что позволяет делать EasyAccess 2.0?</h2>

                        <ol class="spisok">

                            <li>Управлять панелью через VNC-клиент, CMT Viewer (доступна только для серии панелей

                                оператора CMT).

                                Вы можете видеть, что происходит на экране вашей панели, наживать кнопки.

                            </li>

                            <li>Перезаливать проект</li>

                            <li>Просматривать журнал событий</li>

                            <li>Загружать файлы через FTP. (Если панель поддерживает ftp)</li>

                            <li>Производить диагностику</li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>

                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 2">

                        <h2>Системные требования и установка</h2>

                        <ul class="spisok">

                            <li>Операционная система: Windows XP, Windows 7, Windows 8 (32 / 64бит), Windows 10 (32 /

                                64бит)

                                (Необходимы права администратора)

                            </li>

                            <li>Панель оператора Weintek с активированным EasyAccess 2.0</li>

                            <li>Интернет-соединение</li>

                            <li>EasyBuilder Pro v4.10.05 или новее</li>

                            <li>IOS: 7.0 или старше</li>

                            <li>Android: v4.1.2 или старше</li>

                        </ul>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 3">

                        <h2>Начало работы</h2>

                        <h3>Порядок действий</h3>

                        <p>Чтобы начать использовать EasyAccess 2.0, нужно выполнить следующие шаги. Смотрите

                            соответствующие

                            разделы, подробно описывающие шаги.</p>

                        <ol class="spisok">

                            <li>Панель оператора должна быть активирована (Если ваша панель не имеет уже активированный

                                EasyAccess2.0, то обратитесь к нашим менеджерам в онлайн-чате.)

                            </li>

                            <li>Управление доменом (аккаунтом) (Пункт 4)<br> Должен быть создан аккаунт (Домен) на сайте

                                <a

                                        href="https://www.weincloud.net/">weincloud.net</a></li>

                            <li>Добавление панели в домен (Пункт 6)<br>Если вы хотите попробовать 30 дневную версию, то

                                переходите к

                                (Пункт 5)<br>Панель оператора должна быть добавлена в Домен

                            </li>

                            <li>Добавление пользователя и открытия ему доступа к панели<br>Должна быть создана учетная

                                запись

                                Пользователя, к которой будет привязана панель оператора

                            </li>

                            <li>EasyAccess 2.0 должен быть установлен на ПК</li>

                        </ol>

                        <p>После того, как все шаги выполнины, пользователь сможет удаленно подключиться к панели

                            оператора</p>





                        <h2>Активация панели</h2>

                        <p>Нужно активировать панель оператора, чтобы начать пользоваться EasyAccess 2.0.

                            В модельной линейке имеются уже активированные панели оператора, например <a

                                    href="/weintek/cMT3072/">cMT3072</a>.

                            У таких панелей у нас на сайте написано “Лицензия EasyAccess 2.0 входит в стоимость”.

                            В ином случае вам необходимо обратиться к нам, чтобы активировать вашу панель.

                            Также убедитесь, что ваша панель поддерживает EasyAccess 2.0.

                            Модели, которые поддерживают данную технологию имеют пометку “Удаленный доступ по

                            EasyAccess”.</p>



                        <h2>Терминология</h2>



                        <ul class="spisok">

                            <li><b>Домен и администратора домена</b>

                                <p>Доменом называется аккаунт, к которому привязываются панели оператора.

                                    <b>Панель оператора может быть привязана только к одному домену.</b>

                                    Администратора домена, это пользователь, который может управлять панелями оператора

                                    и пользователями через веб интерфейс на сайте (<a href="https://www.weincloud.net/">weincloud.net</a>).

                                    Аккаунт администратора домена не используется для входа в клиентскую программу

                                    EasyAccess 2.0.

                                </p></li>

                            <li><b>Группа панелей оператора</b>

                                <p>Панели оператора можно объединять в группы. Такие группы можно назначать

                                    пользователям.

                                    Пользователи получат возможность управлять всеми панелями из группы, которую им

                                    назначили.

                                    Панель оператора может быть назначена в разные группы. Группы формирует и назначает

                                    администратор домена.</p></li>

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

                            <li>В этом примере панели оператора сгруппированы в группы: Группа 1, Группа 2, Группа 3 и

                                т.д. Панель

                                оператора A принадлежит к двум группам

                            </li>

                            <li>Пользователи могут принадлежать ко многим группам. А так же иметь доступ к панелям

                                оператора,

                                которые не имеют группы. (Пользователь Петр и группа 1)

                            </li>

                            <li>Пользователи могут быть напрямую связаны с панелями оператора и иметь к ним доступ.

                                (Пользователь

                                Нина и панель оператора J).

                                Несколько пользователей могут получить доступ к одной и той же панели оператора,

                                независимо от того, назначены ли они группам (панелей оператора А) или путем прямой

                                связи (панель

                                оператора H).

                            </li>

                        </ol>

                        <p>Доступы настраиваются администратором домена. </p>



                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp"

                                                         data-fancybox="gallery0"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/mceclip1.webp"></a>

                        </p>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>





                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 4">

                        <h2>Управление доменом (аккаунтом)</h2>

                        <h3>Создание аккаунта (Домена)</h3>

                        <ol>

                            <li><p>Система управления доменами находится по адресу: <a href="https://www.weincloud.net/">weincloud.net</a>

                                </p>

                                <p>Зайдите на сайт, нажмите кнопку [Create Domain account] и переходите к заполнению

                                    формы вашими

                                    данными</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/1.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/2.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>Если вы все заполнили верно, то вам на почту придет письмо со ссылкой на

                                    подтверждение. Найдите

                                    это письмо и подтвердите регистрацию переходом по ссылке.</p>

                                <p>Теперь можно авторизоваться в системе управления доменом. Для этого на главной

                                    странице

                                    <a href="https://www.weincloud.net/">weincloud.net</a> нажмите кнопку [Domain]

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/3.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp"

                                                                 data-fancybox="gallery1"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/4.webp"></a>

                                </p>

                            </li>

                        </ol>





                        <h2>Добавление пользователя и открытие ему доступа</h2>



                        <ol>

                            <li>

                                <p>Найдите вкладку [User] (Пользователь). На нашей картинке в списке уже есть один

                                    пользователь.

                                    Ваш список изначально будет пустым. Нажмите кнопку [+Add User] для добавления

                                    пользователя. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/13.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>Для нового пользователя введите логин и его почту, на которую придет сгенерированный

                                    автоматически пароль. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/14.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p> Найдите панель в списке. Отметьте ее и нажмите значок редактирования или кнопку

                                    [Edit HMI].

                                    Отметьте галочкой нужного пользователя и нажмите [Save].</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/15.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/16.webp"></a>

                                </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/17.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 5">

                        <h2>Добавление панели в домен (Trial 30 дней)</h2>

                        <ol>

                            <li>

                                <p>В своем домене на сайте <a href="https://www.weincloud.net/">weincloud.net</a>, на вкладке

                                    "Devices" -

                                    "HMI List" нажмите кнопку [+ Add HMI]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>Выберите тип активации: 30 days Free Trial</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/6.webp"></a>

                                </p>



                                <p>Введите Hardware key (аппаратный ключ) и подтвердите их кнопкой [Free Trial].</p>



                                <p>HWkey (Hardware key - аппаратный ключ) вы можете узнать, зайдя в вашей панели на

                                    страницу

                                    системных настроек [System Settings] на вкладке [EasyAccess 2]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/7.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 6">

                        <h2>Добавление панели в домен</h2>

                        <ol>

                            <li>

                                <p>Свяжитесь с нашими менеджерами и сообщите им HW-key (Hardware key - аппаратный ключ).

                                    Как узнать

                                    ключ смотреть в предыдущем шаге.

                                    Мы подтвердим вам, что активация произошла.</p>

                            </li>

                            <li>

                                <p>С помощью программы EasyBuilderPro нужно создать и загрузить в панель проект,

                                    позволяющий

                                    открывать на панели страницу с настройками EasyAccess 2.0.

                                    Создайте в EasyBuilderPro новый проект. </p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/8.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>В системных настройках проверьте расположение сервера EasyAccess2.0. Должен быть

                                    выбран

                                    "Глобальный"</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/9.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>Добавьте функциональную кнопку, которая открывает окно №76 EasyAccess 2.0 Settings.

                                    Загрузите

                                    проект в панель.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/10.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>Теперь в новом проекте вашей панели есть кнопка, при нажатии которой, откроется окно

                                    с

                                    настройками EasyAccess 2.0.

                                    Подключите вашу панель к интернету и откройте окно EasyAccess 2.0. После нажатия

                                    кнопки [Start]

                                    в полях [Session ID] и [Password] появятся значения,

                                    которые вам будут нужны в следующем шаге.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/11.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p>В своем домене на сайте <a href="https://www.weincloud.net/">weincloud.net</a>, на вкладке

                                    "Devices" -

                                    "HMI List" нажмите кнопку [+ Add HMI]</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"

                                                                 data-fancybox="gallery2"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/5.webp"></a>

                                </p>

                            </li>

                            <li>

                                <p> Выберите тип активации: [Add by session Id/password]. Введите Session ID и

                                    [Password],

                                    полученные на предыдушем шаге. Подтвердите кнопкой [Assign]. Вы добавили панель

                                    оператора в

                                    домен. Теперь нужно создать пользователя и открыть ему доступ к панели.</p>

                                <p style="text-align: center"><a class="img__easyaccess"

                                                                 href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp"

                                                                 data-fancybox="gallery3"><img loading="lazy"

                                                                                               src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/12.webp"></a>

                                </p>

                            </li>

                        </ol>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 7">

                        <h2>EasyAccess 2.0 на ПК</h2>

                        <p>EasyAccess 2.0 предоставляется как отдельная программа, которую можно установить на ПК. Он

                            может

                            использоваться независимо от программного пакета EasyBuilder.</p>

                        <p><a href="/soft/EasyAccess/EasyAccess20_setup.zip">

                                <div class="download__inner" style="width: 250px;">

                                    <div class="download__img" style="background-image: url(/images/zip.svg)"></div>

                                    <div class="download__text">

                                        <div class="download__text__title">Дистрибутив ver 2.3.0 для PC</div>

                                        <div class="download__text__p">[23-11-2016 65.12 Мб]</div>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </a></p>

                        <h3>Авторизация</h3>

                        <p>Заполните имя Домена, Имя пользователя Домена, пароль.</p>

                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp"

                                                         data-fancybox="gallery3"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea1.webp"></a>

                        </p>

                        <h3>Главный экран</h3>

                        <p>После того, как вы зайдете в систему, вы окажетесь на главном экране.

                            Тут отображаются все панели оператора доступные пользователю.

                            Также отображаются статусы панелей. Вы можете подключаться к неограниченному количеству

                            панелей.

                            Однако после того, как вы подключились к панели, то эта панель получает статус “Занято”.

                            К такой панели больше никто не сможет подключиться, до тех пор, пока вы не будет разорвано

                            текущее

                            соединение.</p>

                        <p style="text-align: center"><a class="img__easyaccess"

                                                         href="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp"

                                                         data-fancybox="gallery3"><img loading="lazy"

                                                                                       src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea2.webp"></a>

                        </p>

                        <p><b>Функции иконок на главном экране:</b></p>

                        <table class="eatable">

                            <tbody>

                            <tr>

                                <td>Иконка</td>

                                <td>Функция</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea3.webp">

                                    </p></td>

                                <td>Трафик домена</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea4.webp">

                                    </p></td>

                                <td>Поиск панели оператора</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea5.webp">

                                    </p></td>

                                <td>

                                    Вид: плитка/список

                                </td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea6.webp">

                                    </p></td>

                                <td>Настройки</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea7.webp">

                                    </p></td>

                                <td>Выход из текущего пользователя</td>

                            </tr>

                            <tr>

                                <td style="width: 260px;"><p style="text-align: left"><img loading="lazy"

                                                                                           src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea8.webp">

                                    </p></td>

                                <td>Журналы подключений</td>

                            </tr>

                            </tbody>

                        </table>



                        <h3>Состояния панели оператора и настройка доступа</h3>

                        <p>Панель оператора может находиться в одном из состояний: Офлайн, Онлайн, Соединено,

                            Занято.</p>

                        <table class="eatable">

                            <tbody>

                            <tr style="border-bottom: none;">

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea9.webp">

                                    </p></td>

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea10.webp">

                                    </p></td>

                            </tr>

                            <tr>

                                <td>Офлайн</td>

                                <td>Онлайн</td>

                            </tr>

                            <tr style="border-bottom: none;">

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea11.webp">

                                    </p></td>

                                <td><p style="text-align: left"><img loading="lazy"

                                                                     src="//www.rusavtomatika.com/upload_files/images/easyaccess20guide/ea12.webp">

                                    </p></td>

                            </tr>

                            <tr>

                                <td>Соедино</td>

                                <td>Занято</td>

                            </tr>

                            </tbody>

                        </table>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="next_section">Далее</div>

                        </div>



                    </div>

                    <div class="tabs__guide__content" v-if="current_section == 8">



                        <h2>Ограничения EasyAccess 2.0</h2>



                        <ul style="margin-left:25px;">

                            <li>Пропускная способность</li>

                            <li>Количество доменов в которых можно зарегистрировать Панель оператора</li>

                            <li>Максимальное количество пользователей которые могут подключиться к Панели оператора в

                                одно время

                            </li>

                            <li>Порт</li>

                            <li>Ethernet-Ethernet Pass-through</li>

                        </ul>

                        <div class="is-clearfix has-background-light mt-5">

                            <div class="button is-pulled-right is-success" @click="change_section(1)">В начало</div>

                        </div>



                    </div>

                </div>

            </section>

        </div>

    </div>

    <section style="margin-top: 50px;">

        <h2>Видео</h2>

        <div class="columns">

            <div class="column is-4-desktop is-12-mobile">

                <h3>EasyAccess 2.0 - подключение к удаленной панели без выделенного IP адреса</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/KViooU5gljA"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/KViooU5gljA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe-->





            </div>

            <div class="column is-4-desktop is-12-mobile">

                <h3>Удаленное подключение к панели оператора Weintek через EasyAccess 2.0</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/nTNuSA2aQcg"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/nTNuSA2aQcg" frameborder="0"                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"                    allowfullscreen></iframe-->



            </div>

            <div class="column is-4-desktop is-12-mobile">

                <h3>EasyAccess 2.0 многопользовательское управление</h3>

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/XhrRn2tuig0?rel=0"

                        title="YouTube video player" frameborder="0"

                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"

                        allowfullscreen></iframe>

                <!--iframe width="100%" height="315" src="https://www.youtube.com/embed/XhrRn2tuig0?rel=0" frameborder="0"                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"                    allowfullscreen></iframe-->



            </div>

        </div>



    </section>

    <section>

        <h2>Скачать</h2>

        <div class="columns">

            <div class="column is-4-desktop is-12-mobile">

                <a href="/soft/EasyAccess/EasyAccess20_manual.pdf">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/pdf.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">Руководство (eng)</div>

                            <div class="download__text__p">[3.6 Мб]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

            <div class="column is-4-desktop is-12-mobile">

                <a href="https://play.google.com/store/apps/details?id=com.weintek.easyaccess">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/android.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">Дистрибутив для Android</div>

                            <div class="download__text__p">[Последняя версия]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

            <div class="column is-4-desktop is-12-mobile">

                <a href="/soft/EasyAccess/EasyAccess20_setup.zip">

                    <div class="download__inner">

                        <div class="download__img" style="background-image: url(/images/zip.svg)"></div>

                        <div class="download__text">

                            <div class="download__text__title">Дистрибутив для PC</div>

                            <div class="download__text__p">[69 Мб]</div>

                        </div>

                        <div class="clearfix"></div>

                    </div>

                </a>

            </div>

        </div>

    </section>

</div>





