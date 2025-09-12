<?php
if ($_SERVER["HTTP_HOST"] != "https://www.rusavtomatika.com") {
    $site = "https://www.rusavtomatika.com";
} else $site = "";

function printDefiningLink($link, $site) {
    $pos = strripos($link, 'http');

    if ($pos === false) {
        $link = $site . $link;
    }

    return $link;
}


if (isset($files) and is_array($files)) {
    ?>
    <table id="table-download-files" class="table-style1 ">
    <tbody>
    <tr>
        <th style="text-align: left"> Наименование</th>
        <th> Дата, размер</th>
        <th> Ссылка</th>
    </tr>
    <?
    foreach ($files as $file) { ?>

        <tr>
        <td>
            <?
            if (isset($file["name"]) and $file["name"] != ""): ?>
                <div class="down_item">
                    <a download title="Скачать" target="_blank"
                       href="<?=  printDefiningLink($file["path"], $site)?>">
                        <?= $file["name"] ?>
                    </a>
                </div>
            <? endif; ?>
            <?
            if (isset($file["annotation"]) and $file["annotation"] != ""): ?>
                <div class="down_item_descr"><?= $file["annotation"] ?></div><? endif; ?>
        </td>
        <td>
        <div class="">

        <?
        if ($file["path"] == "/soft/EBPro/EBpro_setup.zip" and 0) {
            $so = $GLOBALS["EBPro_link"];
            $re1 = cu($path_to_real_files . $so);
            $tso = date("d-m-Y", $re1[1]);
            $fsso = (sprintf("%u", $re1[0]) + 0) / 1000;
            $sso = round($fsso / 1000, 2) . '&nbsp;Мб';
            $ver = file_get_contents($GLOBALS["EBPro_version"]);
            if ($ver != "") $ver = "V".$ver;
            echo "<div>$ver</div>";
            if ($fsso > 0) {
                echo "<div>$tso</div><div>$sso</div>";
            }
        } else {
            if (isset($file["date"]) and $file["date"] != "") {  echo "<div>{$file['date']}</div>"; }
            if (isset($file["language"]) and $file["language"] != ""){ echo "<div>{$file['language']}</div>";}
            if (isset($file["size"]) and $file["size"] != ""){ echo "<div>{$file['size']}</div>";}
            }
            ?>
            </div>
            </td>
            <td>

                <a download class="download_icon download_<?= $file["type"] ?>" title="Скачать" target="_blank"
                   href="<?=  printDefiningLink($file["path"], $site)?>"></a>


            </td>
            </tr>
            <?
        }
        ?>
        </tbody>
        </table>

        <?

    }
