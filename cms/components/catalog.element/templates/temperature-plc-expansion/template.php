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
        <h1>������������� ������ ���������� ���: Haiwell <?= $arResult["element"]["name"] ?>, �� ������</h1>
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


                <? if (isset($properties["aiao-points"]["value"]) and $properties["aiao-points"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_aiao-points">
                        <span class="field_title tick "><?= $properties["aiao-points"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["aiao-points"]["value"] ?></span></div><? endif; ?>
                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_com-port">
                        <span class="field_title tick"><?= $properties["com-port"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["com-port"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? /* if (isset($properties["remote-io-module"]["value"]) and $properties["remote-io-module"]["value"] != ""): ?>
                  <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                  <span class="field_title tick"><?= $properties["remote-io-module"]["name"] ?>: </span>
                  <span class="field_value"><?= $properties["remote-io-module"]["value"] ?></span>
                  </div>
                  <? endif; */ ?>
                <? if (isset($properties["conversion"]["value"]) and $properties["conversion"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_conversion">
                        <span class="field_title tick"><?= $properties["conversion"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["conversion"]["value"] ?></span>
                    </div>
                <? endif; ?>
                <? if (isset($properties["tipy-podderzhivaemyh-cifrovyh-datchikov"]["value"]) and $properties["tipy-podderzhivaemyh-cifrovyh-datchikov"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_remote-io-module">
                        <span class="field_title tick"><?= $properties["tipy-podderzhivaemyh-cifrovyh-datchikov"]["name"] ?>: </span>
                        <span class="field_value"><?= $properties["tipy-podderzhivaemyh-cifrovyh-datchikov"]["value"] ?></span>
                    </div>
                <? elseif (isset($properties["input-type"]["value"]) and $properties["input-type"]["value"] != ""): ?>
                    <div class="catalog_element_default_property catalog_element_default_series">
                        <span class="field_title tick"><?= $properties["input-type"]["name"] ?>: </span>
                        <?
                        if ($properties["ai"]["value"] == 4 and $properties["input-type"]["value"] == "��������") {
                            $properties["input-type"]["value"] = "���������";
                        }
                        ?>
                        <?
                        if ($properties["ai"]["value"] == 4 and $properties["input-type"]["value"] == "������������������") {
                            $properties["input-type"]["value"] = "������������������";
                        }
                        ?>
                        <span class="field_value"><?= $properties["ai"]["value"] . " " . $properties["input-type"]["value"] ?></span></div>
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
                <div id="tabs">
                    <ul>
                        <li class="urlup" data="functions"><a href="#tabs-1">��������</a></li>
                        <?
                        if (isset($properties["dimension"]["value"]) and $properties["dimension"]["value"] != "") {
                            ?>
                            <li class="urlup" data="dimension"><a href="#tabs-2">��������</a></li>
                        <? } ?>
                        <li class="urlup" data="presentation"><a href="#tabs-3">�����</a></li>
                        <li class="urlup" data="tabs-table_registrs"><a href="#tabs-table_registrs">������� ���������</a></li>

                        <?
                        if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) {
                            ?>
                            <li class="urlup" data="software"><a href="#tabs-4">�������</a></li>
                        <? } ?>
                    </ul>
                    <div id="tabs-1">
                        <h2>�������������� <?= $arResult["element"]["name"] ?></h2>
                        <table class="table_style2">
                            <colgroup><col style="width:33%;"/><col/></colgroup>
                            <tbody>
                                <tr>
                                    <th>��������������</th><th>��������</th>
                                </tr>

                                <? if ((isset($properties["ai"]["value"]) and $properties["ai"]["value"] != "") or ( isset($properties["input-type"]["value"]) and $properties["input-type"]["value"] != "")):
                                    ?>
                                    <tr>
                                        <td>����� (AI)</td><td><?= "<b>" . $properties["ai"]["value"] . "</b> " . $properties["input-type"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <? if (isset($properties["ao"]["value"]) and $properties["ao"]["value"] != ""): ?>
                                    <tr>
                                        <td>������ (AO)</td><td><?= $properties["ao"]["value"] . "&nbsp;" . $properties["do-type"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <? if (isset($properties["conversion"]["value"]) and $properties["conversion"]["value"] != ""): ?>
                                    <tr>
                                        <td><?= $properties["conversion"]["name"] ?></td><td><?= $properties["conversion"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <? if (isset($properties["com-port"]["value"]) and $properties["com-port"]["value"] != ""): ?>
                                    <tr>
                                        <td><?= $properties["com-port"]["name"] ?></td><td><?= $properties["com-port"]["value"] ?></td>
                                    </tr>
                                <? endif; ?>
                                <?
                                if (isset($properties["pulse-input"]["value"]) and $properties["pulse-input"]["value"] != ""):
                                    $properties["pulse-input"]["value"] = str_replace("Channels", "�����", $properties["pulse-input"]["value"]);
                                    $properties["pulse-input"]["value"] = str_replace("phase", "������", $properties["pulse-input"]["value"]);
                                    $properties["pulse-input"]["value"] = str_replace("points", "�����", $properties["pulse-input"]["value"]);
                                    ?>
                                    <tr><td><?= $properties["pulse-input"]["name"] ?></td><td><?= $properties["pulse-input"]["value"] ?></td></tr>
                                <? endif; ?>
                                <?
                                if (isset($properties["pulse-output"]["value"]) and $properties["pulse-output"]["value"] != ""):
                                    $properties["pulse-output"]["value"] = str_replace("Channels", "�����", $properties["pulse-output"]["value"]);
                                    $properties["pulse-output"]["value"] = str_replace("phase", "������", $properties["pulse-output"]["value"]);
                                    $properties["pulse-output"]["value"] = str_replace("points", "�����", $properties["pulse-output"]["value"]);
                                    ?>
                                    <tr><td><?= $properties["pulse-output"]["name"] ?></td><td><?= $properties["pulse-output"]["value"] ?></td></tr>
                                <? endif; ?>
                            </tbody>
                        </table>
                        <? if ($properties["product-specification"]["value"] != "") { ?>
                            <?= $properties["product-specification"]["value"] ?>
                        <? } ?>


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
                    <div id="tabs-2">
                        <div class="catalog_element_default_diagrams">
                            <h2>��������</h2>
                            <p><b><?= $properties["dimension"]["value"] ?></b></p>
                            <?
                            $dimension_img_url = "";
                            switch ($properties["dimension"]["value"]) {
                                case "30*95*82 ��":
                                    $dimension_img_url = "/images/haiwell/dimensions/30_95_82.png";
                                    break;
                                case "70*95*82 ��":
                                    $dimension_img_url = "/images/haiwell/dimensions/70_95_82.png";
                                    break;
                                case "93*95*82 ��":
                                    $dimension_img_url = "/images/haiwell/dimensions/93_95_82.png";
                                    break;
                                case "131*95*82 ��":
                                    $dimension_img_url = "/images/haiwell/dimensions/131_95_82.png";
                                    break;
                                case "177*95*82 ��":
                                    $dimension_img_url = "/images/haiwell/dimensions/177_95_82.png";
                                    break;
                                default:
                                    break;
                            }
                            if ($dimension_img_url != "") {
                                ?><p><img src="<?= $dimension_img_url ?>" alt="�������� <?= $arResult["element"]["name"] ?>" /></p><?
                            }
                            ?>

                        </div>
                    </div>
                    <div id="tabs-3">
                        <h2>����� <?= $arResult["element"]["name"] ?></h2>
                        <div class="catalog_element_default_diagrams">
                            <? if ($properties["terminal-wiring-diagram"]["value"] != "") { ?>
                                <h3><?= $properties["terminal-wiring-diagram"]["name"] ?></h3>
                                <div><img src="<?= $properties["terminal-wiring-diagram"]["value"] ?>" alt="<?= $properties["terminal-wiring-diagram"]["name"] ?>" /></div>
                            <? } ?>

                            <? if ($properties["product-wiring-diagram"]["value"] != "") { ?>
                                <h3><?= $properties["product-wiring-diagram"]["name"] ?></h3>
                                <div><img src="<?= $properties["product-wiring-diagram"]["value"] ?>" alt="<?= $properties["product-wiring-diagram"]["name"] ?>" /></div>
                            <? } ?>
                        </div>
                    </div>
                    <div id="tabs-table_registrs">
                        <div class="catalog_element_default_specifications">
                            <? if ($properties["technical-specification"]["value"] != "") { ?>
                                <h2>������� ���������</h2>
                                <div><?= $properties["technical-specification"]["value"] ?></div>
                                <?
                            } else {
                                include $_SERVER['DOCUMENT_ROOT'] . '/include/haiwell/temperature-plc-expansion-cr.php';
                            }
                            ?>
                        </div>
                    </div>
                    <? if (isset($properties["files"]) and is_array($properties["files"]) and count($properties["files"]) > 0) { ?>
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
