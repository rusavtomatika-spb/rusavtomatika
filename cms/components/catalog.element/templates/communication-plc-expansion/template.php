<?
if (!defined('cms'))
    exit;
$properties = $arResult["element"]["properties"];
?>
<div class="catalog_element_default">
    <nav><a href="/">�������</a>&nbsp;/&nbsp;<a href="/plc/haiwell/">����������� Haiwell</a>&nbsp;/&nbsp;<a href="/plc/haiwell/#<?= $arResult["element"]["section_code"] ?>"><?= $arResult["element"]["parent_section_name"] ?></a>&nbsp;/&nbsp;������ ���������� <?= $arResult["element"]["name"] ?></nav>
    <? if (isset($arResult["element"]["h1"]) and $arResult["element"]["h1"] != ""): ?>
        <h1><?= $arResult["element"]["h1"] ?></h1>
    <? else: ?>
        <h1>���������������� ������ ���������� ��� Haiwell: <?= $arResult["element"]["name"] ?>, �� ������</h1>
    <? endif; ?>
    <div class="blockofcols_container">
        <div class="blockofcols_row">
            <div class="col-4">
                <a data-fancybox data-fancybox="group" data-caption="<?= $arResult["element"]["name"] ?>" href="<?= $arResult["element"]["picture_detail"] ?>">
                    <div class="catalog_element_default_picture_detail_wrap">
                        <div class="catalog_element_default_picture_detail" style="background-image: url(<?= $arResult["element"]["picture_detail"] ?>);"></div>
                    </div>
                </a>
            </div>
            <div class="col-8" style="position: initial;">
                <? if (isset($arResult["element"]["name"])): ?>
                    <div class="catalog_element_default_property catalog_element_default_name  catalog_element_default_gray catalog_element_default_block_price">
                        <div class="blockofcols_container">
                            <div class="blockofcols_row">
                                <div class="col-3">
                                    <span class="field_title">������: </span>
                                    <span class="field_value"><?= $arResult["element"]["name"] ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="field_title">���� � ���: </span>
                                    <span class="field_value">
                                        <? if ($arResult["element"]["price"] > 0): ?>
                                            <span class="catalog_element_default_price">
                                                <span class="prpr" title="������� ��� ��������� � ���"><?= $arResult["element"]["price"] ?></span>
                                                <span class="val_name" title="������� ��� ��������� � ���">USD</span>
                                            </span>
                                        <? else: ?>
                                            <span class="val_no_price">���� �� �������</span>
                                        <? endif; ?>
                                    </span>
                                </div>
                                <div class="col-3">
                                    <div>
                                        <span class="field_title">�������: </span>
                                        <span class="field_value">
                                            <? if ($arResult["element"]["in_stock"] > 0): ?>
                                                <span class="val_in_stock">���� �� ������</span>
                                            <? else: ?>
                                                <span class="val_no_in_stock absent">��� �����</span>
                                            <? endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <? if ($arResult["element"]["price"] > 0 and $arResult["element"]["in_stock"] > 0): ?>
                                    <div class="but_wr"><div class="zakazbut addToCart" idm="<?= $arResult["element"]["name"] ?>"><span>� �������</span></div></div>
                                <? else: ?>
                                    <div class="but_wr"><div class="zakazbut blocked" idm="<?= $arResult["element"]["name"] ?>" ><span>� �������</span></div></div>
                                <? endif; ?>

                            </div>
                        </div>
                    </div>


                <? endif; ?>
                <div class="catalog_element_default_property catalog_element_default_buttons">
                    <div class="blockofcols_container">
                        <div class="blockofcols_row">
                            <div  style="display:none;width: 33%" class="col-5-5"><div class="but_wr"> <div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_compare(this)"><span>�&nbsp;���������</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_backup_call(2, '<?= $arResult["element"]["name"] ?>')"><span>�����&nbsp;�&nbsp;1&nbsp;����</span></div></div></div>
                            <div class="col-5-5" style="width: 50%"><div class="but_wr"><div class="zakazbut" idm="<?= $arResult["element"]["name"] ?>" onclick="show_backup_call(1, '<?= $arResult["element"]["name"] ?>')"><span>��������&nbsp;������</span></div> </div></div>
                        </div>
                    </div>
                </div>

                <? /* if (isset($properties["series"]["value"]) and $properties["series"]["value"] != ""): ?>
                  <div class="catalog_element_default_property catalog_element_default_series">
                  <span class="field_title"><?= $properties["series"]["name"] ?>: </span>
                  <span class="field_value"><?= $properties["series"]["value"] ?></span></div>
                  <? endif; */ ?>

                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_com-port">
                        <span class="field_title tick"><?= $properties["com-port"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["com-port"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["remote-io-module"]["value"]) and $properties["remote-io-module"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                        <span class="field_title tick"><?= $properties["remote-io-module"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["remote-io-module"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["isolation"]["value"]) and $properties["isolation"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                        <span class="field_title tick"><?= $properties["isolation"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["isolation"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($arResult["element"]["extra_text1"]) and $arResult["element"]["extra_text1"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_text-for-detail">
                        <?= $arResult["element"]["extra_text1"] ?>
                    </div>
                <? endif; ?>
                <? if (isset($arResult["element"]["text_detail"]) and $arResult["element"]["text_detail"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_text_detail">
                        <?= $arResult["element"]["text_detail"] ?>
                    </div>
                <? endif; ?>

            </div>
            <div class="col-12"><br></div>
            <div class="col-12">
                <?
                $dimension_img_url = "";
                switch ($properties["dimension"]["value"]) {
                    case "30*95*82mm":
                        $dimension_img_url = "/images/haiwell/dimensions/30_95_82.png";
                        break;
                    case "93*95*82mm":
                        $dimension_img_url = "/images/haiwell/dimensions/93_95_82.png";
                        break;
                    case "131*95*82mm":
                        $dimension_img_url = "/images/haiwell/dimensions/131_95_82.png";
                        break;
                    case "177*95*82mm":
                        $dimension_img_url = "/images/haiwell/dimensions/177_95_82.png";
                        break;
                    default:
                        break;
                }
                ?>
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="functions"><a href="#tabs-1">��������</a></li>
                        <?
                        if ($dimension_img_url != "") {
                            ?>
                            <li class="urlup" data="dimension"><a href="#tabs-2">��������</a></li>
                        <? } ?>

                        <?
                        if ($properties["terminal-wiring-diagram"]["value"] != ""
                                or $properties["wiring-principle"]["value"] != ""
                                or $properties["rs485-and-rs232-wiring-diagram"]["value"] != ""
                                or $properties["wiring-diagram"]["value"] != ""
                                or $properties["schemes-extra-text"]["value"] != ""
                        ) {
                            ?>
                            <li class="urlup" data="presentation"><a href="#tabs-3">�����</a></li>
                        <? } ?>
                        <?
                        if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) {
                            ?>
                            <li class="urlup" data="software"><a href="#tabs-4">�������</a></li>
                        <? } ?>
                    </ul>
                    <div id="tabs-1">
                        <h2>�������� <?= $arResult["element"]["name"] ?></h2>
                        <div>
                            <table class="table_style2">
                                <colgroup><col style="width:33%"/><col/></colgroup>
                                <tbody>
                                    <tr>
                                        <th>��������������</th>
                                        <th>��������</th>
                                    </tr>
                                    <tr>
                                        <td><?= $properties["specification"]["name"] ?></td>
                                        <?
                                        $specification_text = str_replace(";", "<br>", $properties["specification"]["value"]);
                                        ?>
                                        <td><?= $specification_text ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $properties["com-port"]["name"] ?></td>
                                        <td><?= $properties["com-port"]["value"] ?></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="catalog_element_default_specifications">
                                <? if (isset($properties["technical-specification"]["value"]) and $properties["technical-specification"]["value"] != "") { ?>
                                    <h3><?= $properties["technical-specification"]["name"] ?></h3>
                                    <div><?= $properties["technical-specification"]["value"] ?></div>
                                <? } ?>

                            </div>
                            <div class="catalog_element_default_extra_tables">
                                <?
                                if (isset($properties["consumed-watt"]["value"]) and $properties["consumed-watt"]["value"] != "") {
                                    $consumed_watt = '<tr><td>' . $properties["consumed-watt"]["name"] . '</td><td>' . $properties["consumed-watt"]["value"] . '</td></tr>';
                                }
                                $pos = strpos($properties["power"]["value"], "24");
                                if ($pos !== false) {
                                    include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/power-specification-24.php';
                                }
                                $pos = strpos($properties["power"]["value"], "220");
                                if ($pos !== false) {
                                    include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/power-specification-220.php';
                                }
                                ?>
                                <?
                                $dimensions = "";
                                if (isset($properties["dimension"]["value"]) and $properties["dimension"]["value"] != "") {
                                    $dimensions = '<tr><td>' . $properties["dimension"]["name"] . '</td><td>' . $properties["dimension"]["value"] . '</td></tr>';
                                }
                                if (isset($properties["net-weight"]["value"]) and $properties["net-weight"]["value"] != "") {
                                    $dimensions .= '<tr><td>' . $properties["net-weight"]["name"] . '</td><td>' . $properties["net-weight"]["value"] . '</td></tr>';
                                }
                                if (isset($properties["gross-weight"]["value"]) and $properties["gross-weight"]["value"] != "") {
                                    $dimensions .= '<tr><td>' . $properties["gross-weight"]["name"] . '</td><td>' . $properties["gross-weight"]["value"] . '</td></tr>';
                                }
                                include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/product-environment-specification.php';
                                ?>
                            </div>

                        </div>
                    </div>
                    <? if ($dimension_img_url != "") { ?>
                        <div id="tabs-2">

                            <h2>��������</h2>
                            <p><b><?= $properties["dimension"]["value"] ?></b></p>
                            <p><img src="<?= $dimension_img_url ?>" alt="�������� <?= $arResult["element"]["name"] ?>" /></p>

                        </div>
                    <? }
                    ?>
                    <?
                    if ($properties["terminal-wiring-diagram"]["value"] != ""
                            or $properties["wiring-principle"]["value"] != ""
                            or $properties["rs485-and-rs232-wiring-diagram"]["value"] != ""
                            or $properties["wiring-diagram"]["value"] != ""
                            or $properties["schemes-extra-text"]["value"] != ""
                    ) {
                        ?>

                        <div id="tabs-3"><h2>����� <?= $arResult["element"]["name"] ?></h2>
                            <div class="catalog_element_default_diagrams">
                                <? if ($properties["schemes-extra-text"]["value"] != "") { ?>
                                    <div>
                                        <? echo $properties["schemes-extra-text"]["value"]; ?>
                                    </div>
                                <? } ?>
                                <? if ($properties["terminal-wiring-diagram"]["value"] != "") { ?>
                                    <h3><?= $properties["terminal-wiring-diagram"]["name"] ?></h3>
                                    <div><img src="<?= $properties["terminal-wiring-diagram"]["value"] ?>" alt="<?= $properties["terminal-wiring-diagram"]["name"] ?>" /></div>
                                <? } ?>
                                <? if ($properties["wiring-principle"]["value"] != "") { ?>
                                    <h3><?= $properties["wiring-principle"]["name"] ?></h3>
                                    <div><?= $properties["wiring-principle"]["value"] ?></div>
                                <? } ?>
                                <? if ($properties["rs485-and-rs232-wiring-diagram"]["value"] != "") { ?>
                                    <h3><?= $properties["rs485-and-rs232-wiring-diagram"]["name"] ?></h3>
                                    <div><img src="<?= $properties["rs485-and-rs232-wiring-diagram"]["value"] ?>" alt="<?= $properties["rs485-and-rs232-wiring-diagram"]["name"] ?>" /></div>
                                <? } ?>
                                <? if ($properties["wiring-diagram"]["value"] != "") { ?>
                                    <h3><?= $properties["wiring-diagram"]["name"] ?></h3>
                                    <div><img src="<?= $properties["wiring-diagram"]["value"] ?>" alt="<?= $properties["wiring-diagram"]["name"] ?>" /></div>
                                <? } ?>

                            </div>
                        </div>
                    <? } ?><? if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) { ?>
                        <div id="tabs-4">
                            <h2>����� ��� ������ � <?= $arResult["element"]["name"] ?></h2>
                            <table class="table_style1" >
                                <tbody>
                                    <tr>
                                        <th style="width: 60%;">��������</th>
                                        <th style="width: 10%;">���� ����������</th>
                                        <th style="width: 15%;">����������</th>
                                        <th style="width: 15%;">����</th>
                                    </tr>
                                    <?
                                    foreach ($properties["files"] as $arFile) {
                                        ?>
                                        <tr>
                                            <td class="text_align_left">
                                                <b><?= $arFile["name_rus"] ?></b>
                                            </td>
                                            <td class="">
                                                <? echo date_format(date_create($arFile["date"]), "d/m/Y"); ?>
                                            </td>
                                            <td class="text_align_left">
                                                <?= $arFile["description"] ?>
                                            </td>
                                            <td>
                                                <a class="green_button" target="_blank" href="<?= $arFile["path"] ?>">�������</a>
                                            </td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                    <tr>
                                        <td class="text_align_left">
                                            <b>����������� �� ���������� HaiwellHappy ��� ���������������� ��� (eng)</b>
                                        </td>
                                        <td class="">
                                            20/04/2017
                                        </td>
                                        <td class="text_align_left">
                                            [chm, 4.92MB]
                                        </td>
                                        <td>
                                            <a class="green_button" target="_blank" href="http://rusavtomatika.com/upload_files/catalogs/haiwell/HaiwellHappy_en.rar">�������</a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <?
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
