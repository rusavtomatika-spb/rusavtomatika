<?php
global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = true;
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
global $TITLE, $DESCRIPTION, $KEYWORDS,$CANONICAL;
$TITLE = 'Поддержка и сервис Weintek, Samkoon, IFC, Aplex';
$DESCRIPTION = 'Техническая поддержка по операторским панелям Weintek, Samkoon, панельным промышленным компьютерам IFC, Aplex';
$KEYWORDS = 'Техническая поддержка Weintek, техническая поддержка Samkoon, техническая поддержка IFC, техническая поддержка Aplex';
$CANONICAL = "https://www.rusavtomatika.com/support/";
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css?" . rand());
$arr_data = [
    [
        "title" => "Статьи",
        "extra_text" => "",
        "link" => "/articles" . EX . "/",
    ],
    [
        "title" => "Видео",
        "extra_text" => "",
        "link" => "/video" . EX . "/",
    ],
    [
        "title" => "Скачать",
        "extra_text" => "приложения и драйверы",
        "link" => "/download/",
    ],
    [
        "title" => "Документация",
        "extra_text" => "мануалы, руководство, документы",
        "link" => "/documents" . EX . "/",
    ],
    [
        "title" => "Демо проекты",
        "extra_text" => " и макросы Weintek",
        "link" => "/weintek_projects" . EX . "/",
    ],
    [
        "title" => "Макросы Weintek",
        "extra_text" => "",
        "link" => "/weintek_projects" . EX . "/?section=Macro_Sample",
    ],
    [
        "title" => "Графические библиотеки",
        "extra_text" => "для Weintek EasyBuilder Pro",
        "link" => "/weintek_libraries" . EX . "/",
    ],
    [
        "title" => "Weintek драйверы",
        "extra_text" => "для контроллеров ПЛК PLC",
        "link" => "/weintek_drivers" . EX . "/",
    ],
];


?>

    <articles>
        <div class="container is-widescreen">
            <h1 class="title">Поддержка и сервис</h1>
        </div>

        <div class="has-background-light py-3">
            <div class="container is-widescreen">
                <div class="column">
                    <h2>Техническая поддержка</h2>
                    <p>Мы осуществляем техническую поддержку по всему спектру поставляемого нами оборудования. Наши
                        инженеры
                        постоянно находятся в контакте с техническими специалистами заводов производителей оборудования.
                        Нам отвечают максимально быстро.</p>
                    <p>Но, чаще всего, наше обращение к заводу производителю и не требуется, так как наши специалисты
                        ежедневно
                        отвечают на десятки технических вопросов в чате, по телефонам, по email и на форуме. </p>
                    <p>
                        На нашем <a target="_blank" href="/forum/">форуме</a> по продукции Weintek более 4000 сообщений,
                        а
                        на нашем <a
                                target="_blank" href="/video/">Rutube канале</a> более 70 обучающих видео.</p>
                    <p>Для получения технической поддержки <b>пишите на почту</b> <a href="mailto:support@rusavtomatika.com"
                                                                              title="Отправьте нам сообщение по электронной почте">support@rusavtomatika.com</a>.
                        В письме необходимо представиться - сообщить ваше имя и название вашей
                        компании.</p>
                    <p>Или <b>задавайте вопросы в чат</b>, в правом нижнем углу экрана. Отвечают живые люди. Роботов нет!</p>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container is-widescreen">
                <div class="column">
                    <div class="columns is-multiline">
                        <div class="column">
                            <h2>Сервисный центр</h2>
                            <p>Мы осуществляем гарантийный и не гарантийный ремонт всей поставляемой нами линейки
                                оборудования.</p>
                            <p>Мы заказываем комплектующие напрямую на заводах производителях.</p>
                            <p>Наши инженеры регулярно консультируются со специалистами производителей оборудования.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="has-background-light py-3">
            <div class="container  is-widescreen">
                <div class="column">
                    <h2>Тестирование</h2>
                    <p>Мы предлагаем вам бесплатно взять оборудование на тестирование сроком обычно в 1 мес. В процессе
                        тестирования мы оказываем техническую поддержку, например, консультируем по созданию проекта для
                        операторской панели, по связке панели с ПЛК, либо другими вашими устройствами.</p>
                    <p>Можем провести тестирование у себя на предмет совместимости разного оборудования, либо убедиться
                        в
                        работоспособности специальной операционной системы, либо специального софта на наших
                        промышленных
                        компьютерах.</p>
                </div>
            </div>
        </div>

        <div class="py-3">
            <div class="container is-widescreen">
                <div class="column">
                    <h2>Библиотека</h2>
                    <div class="page_library">

                        <div class="columns is-multiline ">

                            <?
                            foreach ($arr_data as $item) {
                                ?>
                                <a href="<?= $item['link'] ?>" class="page_library__a column is-4-desktop is-6-tablet">
                                    <div class="panel has-background-light">
                                        <div>
                                            <?= $item['title'] ?>
                                            <?
                                            if ($item['extra_text'] != '') {
                                                ?>
                                                <div class="extra_text"><?= $item['extra_text'] ?></div><?
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </a>
                                <?
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container is-widescreen">
            <div class="column">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/include_utf_8/widgets/inc_block_small_contacts.php";
                ?>
            </div>
        </div>


        <!--div class="py-3">
            <div class="container is-widescreen">
                <div class="column">
                    <h2>Цифры</h2>
                    <div class="columns is-multiline block_digitals">
                        <div class="column is-4"><b>3000</b> клиентов</div>
                        <div class="column is-4"><b>16</b> лет работы</div>
                        <div class="column is-4"><b>50000</b> ед. оборудования реализовано</div>
                        <div class="column is-4"><b>900+</b> подписчиков и <br><b>4000+</b> сообщений<br>на нашем
                            техническом форуме
                        </div>
                        <div class="column is-4"><b>70+</b> обучающих видео <br>на нашем youtube-канале</div>
                        <div class="column is-4"><b>1700+</b> подписчиков и <br><b>280 000+</b> просмотров <br>на нашем
                            youtube-канале
                        </div>
                    </div>
                </div>
            </div>
        </div-->


    </articles>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";