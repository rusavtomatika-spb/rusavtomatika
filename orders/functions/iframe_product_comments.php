<?

//if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
//        && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
//        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {die();}?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Orders</title>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<meta name="viewport" content="width=device-width, height=device-height, user-scalable=yes">     
<link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="/orders/template/fancybox3/jquery.fancybox.min.css" />
<link rel="stylesheet" type="text/css" href="/orders/template/orders_template_styles.css?<?=rand();?>" />
<link rel="stylesheet" type="text/css" href="/orders/template/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/orders/template/my_bootstrap.css" />


</head>

<body>
<div class="panel_product_comments">
<div class="panel_product_comments">Комментарии к <?=$arrResult['product']['name']?></div> 
    <?
print_r($_REQUEST);
foreach ($arrResult['comments'] as $comment) {
    ?>
<div class="comment" data-comment-id="<?=$comment['id']?>">
    <div class="comment_name"><?=$comment['name']?><span class="comment_date_creating"><?= $comment['time']?></span></div>
    <div class="comment_text"><?=$comment['text']?></div>            
</div>
        <?
}

?>
</div>
</body></html>


