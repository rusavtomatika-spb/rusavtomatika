<div class="main_menu">
    <a target="_blank" href="/" class="logo"><img src="/abacus/admin/template/favicon.svg"></a>
    <?php
    if (!empty($arResult)) {
        if (is_array($arResult["items"])) {
            foreach ($arResult["items"] as $item) {
                $haystack = str_replace("/abacus/admin", "", $_SERVER['REQUEST_URI']);
                $needle = str_replace("/abacus/admin", "", $item["link"]);
                ?><span>
                <a class="<?
                if ($needle != "/") {
                    $pos = strpos($haystack, $needle);
                    if ($pos !== false) {
                        echo "active";
                    }
                } else {
                    if ($haystack == $needle) {
                        echo "active";
                    }
                }
                ?>" href="<?= $item["link"] ?>"><?= $item["anchor"] ?></a>
                </span>

                <?

            }
        }
    }

    ?>
</div>
<style>
    .main_menu {
        display: flex;
        justify-content: flex-start;
        gap: 0;
        align-items: center;
        padding: 0rem 0;
        border: 2px solid #00d1b2;
        margin: 0 0 0.5rem;
    }

    .main_menu .logo img {
        width: 32px;
        display: block;
    }
    .main_menu a {
        color: #00d1b2;
        display: inline-block;
        padding: 0.2rem 0.5rem;
        font-size: 1rem;
        text-transform: uppercase;
    }
    .main_menu a.logo {
        padding: 0;

    }

    .main_menu a.active {
        background: #00d1b2;
        color: #ffffff;
    }
    .main_menu a:hover {
        transition: 0.2s;
        opacity: 0.8;
    }


</style>


