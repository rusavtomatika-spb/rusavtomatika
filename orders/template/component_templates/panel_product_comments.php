<div class="panel_product_comments_title">����������� � <?= $arrResult['product']['name'] ?></div> 
<div class="panel_product_comments" data-product-id="<?= $arrResult['product']['id'] ?>">
    
    <div class="panel_product_comments_inner">
        <div class="panel_product_comments_messages">
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
                            <? if ($comment['modified'] != ''){?> <span class="comment_date_modified">(��������������� <?= $comment['modified'] ?>)</span> <?}?>
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
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_edit">�������������</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_delete">�������</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_save">���������</span>
                                <span data-comment-id="<?= $comment['id'] ?>" class="comment_button_cancel">������</span>
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
            <form id="form_send_message" method="post" class="ajax_form_send_message">
                <input type="hidden" name="action" value="send_message" />
                <input type="hidden" name="product_id" value="<?= $arrResult['product']['id'] ?>" />
                <input type="hidden" name="current_user_login_md5" value="<?= $arrResult['current_user_login_md5'] ?>" />

                <table>
                    <tr>
                        <td>
                            <textarea rows="3" cols="70" name="message" placeholder="���� ���������..."></textarea>                      

                        </td>            
                        <td><input class="form_send_message_submit_button" type="submit" value=">" /></td>
                    </tr>        
                </table>    
            </form>
        </div>        
    </div>

</div>


