<?php

function show_weintek_series($series, $title, $link = '', $text = '', $single_page = false) {
    
    //database_connect();
    global $mysqli_db;
    mysqli_query($mysqli_db,"SET NAMES 'cp1251'");
    $sqlQuery = "SELECT * FROM products_all WHERE `series` = '$series' and `discontinued` != '1' order by `sort` ";
    $queryResult = mysqli_query($mysqli_db,$sqlQuery) or die("ошибка запроса " . $sqlQuery . " <br>Error: " . mysqli_error($mysqli_db));
    $num_rows = mysqli_num_rows($queryResult);
    if ($num_rows > 0) {
        ?>
        <div class="weintek_series_panel">
            <?
            if ($single_page) {
                if ($link) {
                    ?><a href="<?= $link ?>"><h2><?= $title ?></h2></a><?
                } elseif ($title) {
                    ?>
                    <h1><?= trim($title) ?></h1>
                    <?
                };
                if ($text) {
                    ?>
                    <div class="series_descr">
                        <?= $text ?>
                    </div>
                    <?
                }
            } else {
                if ($link) {
                    ?><a href="<?= $link ?>"><h2 id="section_<?=$series?>"><?= $title ?></h2></a><?
                } elseif ($title) {
                    ?>
                    <h2 id="section_<?=$series?>">
                        <?= $title ?>
                    </h2>
                    <?
                };
                if ($text) {
                    ?>
                    <div class="series_descr">
                        <?= $text ?>
                    </div>
                    <?
                }
            }
            ?>

            <div class="">
                <div class="weintek_series_panel">

            <table class='weintek_list_items' style="box-sizing: border-box;display: inline-block;">
                <?
                $counter = 0;
                ?><tr class="item-collector"><?
                    while ($currentRow = mysqli_fetch_array($queryResult)) {
                        
                        ?><td><?
                            //echo $currentRow["model"];
                            echo show_panel1($currentRow["model"]);
                            ?></td><?
                        $counter++;
                        if ($counter > 1) {
                            echo '</tr><tr class="item-collector">';
                            $counter = 0;
                        }
                    }
                    ?>
                <tr></table>
                </div>
            </div>
        </div>
        <?
    }
}
?>


