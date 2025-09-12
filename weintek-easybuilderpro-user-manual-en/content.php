<article class="article_weintek_easybuilderpro_user_manual_en">

    <div class="columns is-multiline weintek-easybuilderpro-user-manual-en" style="padding-left: 0;padding-right: 0; ">

        <? if ($text_before): ?>

            <div class="column is-10">

                <? if (isset($change_title_and_h1_on_page) and $change_title_and_h1_on_page): ?>

                    <? echo '<h1>EasyBuilder Pro руководство пользователя (' . $update_version . ', на английском языке) - онлайн или скачать</h1>'; ?>

                    <div class="title" style="margin-top: -7px;"><?= $h1 ?></div>

                <? else: ?>

                    <div class="title">Руководство пользователя EasyBuilder Pro <?= $update_version ?> на английском

                        языке

                    </div>

                    <? echo '<h1>' . $h1 . "</h1>"; ?>

                <? endif; ?>

            </div>

            <div class="column is-2">

                <?

                $update_date_file_path = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/update_date.txt";

                if ($update_date = getRemoteContentByURL($update_date_file_path)) {

                    echo '<div style="margin:2px 0 15px;background-color: #cce9cc;padding:8px 0;font-size:13px;line-height:1.2;font-weight:bold;text-align:center;">Дата обновления: ' . date('d.m.Y',$update_date) . '</div>';

                }

                ?>

            </div>

            <div class="column is-12">

                <p><?= $text_before ?></p>

            </div>

        <? else: ?>

            <div class="column is-10">

                <div class="title">Руководство пользователя EasyBuilder Pro <?= $update_version ?> на английском языке

                </div>

                <? echo '<h1>' . $h1 . "</h1>"; ?>

            </div>

            <div class="column is-2">

                <?

                $update_date_file_path = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/update_date.txt";

                if ($update_date = getRemoteContentByURL($update_date_file_path)) {

                    echo '<div style="margin:2px 0 15px;background-color: #cce9cc;padding:8px 0;font-size:13px;line-height:1.2;font-weight:bold;text-align:center;">Дата обновления: ' . $update_date . '</div>';

                }

                ?>

            </div>

        <? endif; ?>

    </div>

    <div class="columns is-multiline">

        <div class="column is-3 column_block_specifications">

            <div class="block_floating">

                <?

                //                    include "menu.php"

                $path_to_menu = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/menu.php";

                $menu = getRemoteContentByURL($path_to_menu);

                if ($menu) {

                    echo $menu;

                }

                ?>

            </div>



        </div>

        <div class="column is-9 column_block_equipment">

            <div class="weintek-easybuilderpro-user-manual-en__page">

                <?

                // $path_to_images = "/weintek-easybuilderpro-user-manual-en/";

                //$path_to_page1 = $_SERVER['DOCUMENT_ROOT'] . "/weintek-easybuilderpro-user-manual-en/pages/" . $current_url . ".pdf";

                //$path_to_page2 = "/weintek-easybuilderpro-user-manual-en/pages/" . $current_url . ".pdf";

                $PATH = "https://www.rusavtomatika.com/upload_files/manuals/weintek/UserManual_separate_chapter/" . $current_url . ".pdf";



                echo '<object id="pdf_object" ><embed type="application/pdf" src="' . $PATH . '" width="100%"  /></object>';

                /* if (file_exists($path_to_page1)) {

                  echo '<object id="pdf_object" ><embed type="application/pdf" src="' . $path_to_page2 . '" width="920"  /></object>';

                  //include $path_to_page;

                  } else {

                  header('HTTP/1.1 404 Not Found');

                  global $TITLE;

                  $TITLE = "Страница не найдена, ошибка 404";

                  echo "<h1>Извините, страница не найдена.</h1> Ошибка 404.";

                  } */

                ?>

            </div>



        </div>

    </div>

</article>