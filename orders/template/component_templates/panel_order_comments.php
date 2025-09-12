<div class="panel_product_comments_title">Комментарии к заявке №<?= $arrResult['order']['id'] ?> (<?= $arrResult['order']['brand'] ?>)</div>
<div class="panel_product_comments" data-order-id="<?= $arrResult['order']['id'] ?>">
    
    <div class="panel_product_comments_inner">
        <div class="panel_order_comments_messages">
            <!--messages-->
            <?
            if (isset($arrResult['comments']) and count($arrResult['comments']) > 0) {
                foreach ($arrResult['comments'] as $comment) {
                    if ($arrResult['current_user_login_md5'] == $comment['login_md5']) {
                        $me = 'me';
                    } else {
                        $me = '';
                    }
                    ?>
                    <div class="comment <?=$me?>" data-comment-id="<?= $comment['id'] ?>">
                        <div class="comment_name"><?= $comment['name'] ?>
                            <span class="comment_date_creating">
                            <?= $comment['time'] ?>
                            <? if ($comment['modified'] != ''){?> <span class="comment_date_modified">(отредактировано <?= $comment['modified'] ?>)</span> <?}?>
                            </span>

                        </div>
                        <div class="comment_text"><?
                                $comment['text'] = strip_tags($comment['text']);
                                $comment['text'] = trim($comment['text']);
                                echo $comment['text'];
                             ?></div> 
                        <?if ($me != ''){
                                ?>
                            <span class="comment_buttons">
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_edit">Редактировать</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_delete">Удалить</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_save">Сохранить</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_cancel">Отмена</span>
                            </span>
                                <?
                            }?>
                    </div>
                    <?
                }
            }
            ?>
            <!--messages-->
        </div>
        <div id="panel_form_send_message">
            <form id="order_form_send_message" method="post" class="ajax_form_send_message">
                <input type="hidden" name="action" value="send_message"/>
                <input type="hidden" name="order_id" value="<?= $arrResult['order']['id'] ?>"/>
                <input type="hidden" name="current_user_login_md5" value="<?= $arrResult['current_user_login_md5'] ?>"/>

                <table>
                    <tr>
                        <td>
                            <textarea rows="3" cols="70" name="message" placeholder="Ваше сообщение..."></textarea>

                        </td>
                        <td><input class="order_form_send_message_submit_button" type="submit" value=">"/></td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

</div>
<div id="panel_product_comments_footer"></div>


