<?php
if ($_SERVER["HTTP_HOST"] != "https://www.rusavtomatika.com") {
    $site = "https://www.rusavtomatika.com";
} else $site = "";

function printDefiningLink($link, $site)
{
    $pos = strripos($link, 'http');
    if ($pos === false) {
        $link = $site . $link;
    }
    return $link;
}


if (isset($arResult['product']['files']) and is_array($arResult['product']['files']) and count($arResult['product']['files'])>0) {
    ?>
    <div class="table-container">
        <table id="table-download-files" class="table is-bordered is-striped">
            <tbody>
            <tr class="is-selected">
                <th>Файл</th>
                <th>Дата</th>
                <th>Размер</th>
                <th>Язык</th>
            </tr>
            <?
            foreach ($arResult['product']['files'] as $file) { ?>

                <tr>
                    <td>
                        <?
                        if (isset($file["name"]) and $file["name"] != ""): ?>
                            <div class=""><a <?if($file["type"] != 'pdf'){?>download<?}?> title="Скачать" target="_blank"
                                             href="<?= printDefiningLink($file["path"], $site) ?>"><span download
                                                                                                         class="download_icon download_<?= $file["type"] ?>"></span> <?= $file["name"] ?>
                                </a>
                            </div>
                        <? endif; ?>
                        <?
                        if (isset($file["annotation"]) and $file["annotation"] != ""): ?>
                            <div class="down_item_descr"><?= $file["annotation"] ?></div><? endif; ?>
                    </td>
                    <td>
                    <span class='date'><?
                        if (isset($file["date"]) and $file["date"] != "") {
                            echo "{$file['date']}";
                        }
                        ?>
                    </span>
                    </td>
                    <td>
                    <span class='size'><? if (isset($file["size"]) and $file["size"] != "") {
                            echo "{$file['size']}";
                        } ?></span>
                    </td>
                    <td>
                            <span class='language'><?
                                if (isset($file["language"]) and $file["language"] != "") {
                                    echo "{$file['language']}";
                                }
                                ?>
                            </span>
                    </td>
                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
    </div>
    <?

}else{
    echo '<p>Файлов пока нет...</p>';
}
