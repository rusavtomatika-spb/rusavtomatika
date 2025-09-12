<?php
global $TITLE;
$TITLE = "Каталог программного обеспечения, драйверов, макросов, проектов, документации и графических библиотек.";
$CANONICAL = "https://www.rusavtomatika.com/downloads/";
$DESCRIPTION = 'Каталог программного обеспечения, драйверов, макросов, проектов, документации и графических библиотек. Каталог ежедневно обновляется.';
require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";
CoreApplication::add_style(str_replace($_SERVER["DOCUMENT_ROOT"], "", __DIR__) . "/style.css");
$arr_data = [
    [
        "title" => "Скачать",
        "extra_text" => "приложения и драйверы",
        "link" => "/download/",
    ],
    [
        "title" => "Документация",
        "extra_text" => "мануалы, руководство, документы",
        "link" => "/documents/",
    ],
    [
        "title" => "Демо проекты",
        "extra_text" => " и макросы Weintek",
        "link" => "/weintek_projects/",
    ],
    [
        "title" => "Макросы Weintek",
        "extra_text" => "",
        "link" => "/weintek_projects/?section=Macro_Sample",
    ],
    [
        "title" => "Графические библиотеки",
        "extra_text" => "для Weintek EasyBuilder Pro",
        "link" => "/weintek_libraries/",
    ],
    [
        "title" => "Weintek драйверы",
        "extra_text" => "для контроллеров ПЛК PLC",
        "link" => "/weintek_drivers/",
    ],
];

?>

    <h1>Скачать</h1>
    <p><br></p>
    <div class="page_library">

        <div class="columns is-multiline ">

            <?
            foreach ($arr_data as $item){
                ?>
                <a href="<?=$item['link']?>" class="page_library__a column is-4-desktop is-6-tablet">
                    <div class="panel has-background-light">
                        <div>
                            <?=$item['title']?>
                            <?
                            if($item['extra_text'] != ''){
                                ?><div class="extra_text"><?=$item['extra_text']?></div><?
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
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

