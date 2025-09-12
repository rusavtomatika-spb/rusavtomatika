<?php
$core_url = "/weintek-easybuilder-instrukciya-na-russkom/";
foreach ($arrResult["menu_items"] as $menu_item) {
    if (!$edit_mode and $menu_item["active"] != "1") continue;


    ?>
    <div class="menu_root_item <? echo ($arrResult["route"][0] == $menu_item["code"]) ? "active" : ""; ?>">
        <?
        if ($menu_item["code"] != "") {
            ?>
            <a
                    data-id="<?= $menu_item["id"] ?>"
                    data-position="<?= $menu_item["position"] ?>"
                    data-type="<?= $menu_item["type"] ?>"
                    data-active="<?= $menu_item["active"] ?>"
                    data-parent_id="<?= $menu_item["parent_id"] ?>"
                    href="<?= $core_url . $menu_item["code"] ?>/"><?= $menu_item["name"] ?></a>
            <?
        } else {
            ?>
            <a data-id="<?= $menu_item["id"] ?>" href="<?= $core_url ?>"><?= $menu_item["name"] ?></a>
            <?
        }


        if (isset($menu_item["sub_items"]) and is_array($menu_item["sub_items"])) {
            ?>
            <div class="menu_subitems"><?
            foreach ($menu_item["sub_items"] as $menu_sub_item) {
                if ($menu_sub_item["type"] == 'link') {

                    if ($menu_sub_item["code"] == "") {
                        $href = $core_url . $menu_item["code"] . '/';
                    } else {
                        $href = $core_url . $menu_item["code"] . '/' . $menu_sub_item["code"] . "/";
                    }


                    ?>
                    <a data-id="<?= $menu_sub_item["id"] ?>"
                       data-position="<?= $menu_sub_item["position"] ?>"
                       data-active="<?= $menu_sub_item["active"] ?>"
                       data-type="<?= $menu_sub_item["type"] ?>"
                       data-parent_id="<?= $menu_sub_item["parent_id"] ?>"
                       class="anchor link"
                       href="<?= $href ?>"><?= $menu_sub_item["name"] ?></a>
                    <?
                } else {
                    ?>
                    <a
                            data-id="<?= $menu_sub_item["id"] ?>"
                            data-position="<?= $menu_sub_item["position"] ?>"
                            data-active="<?= $menu_sub_item["active"] ?>"
                            data-type="<?= $menu_sub_item["type"] ?>"
                            data-parent_id="<?= $menu_sub_item["parent_id"] ?>"
                            class="anchor" href="#<?= $menu_sub_item["code"] ?>"><?= $menu_sub_item["name"] ?></a>
                    <?

                }
            }
            ?></div><?
        }
        ?>
    </div>
    <?php
}
