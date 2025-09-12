<?@header("Content-Type: text/html; charset=utf-8");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <link rel="icon" type="image/gif" href="/images/favicon-a.gif"/>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta http-equiv="Content-Language" content="ru"/>
    <title>Speechkit - Административная панель</title>
    <meta name="viewport" content="width=1110"/>
    <link rel="stylesheet" type="text/css" href="/admin/speechkit/styles.css"/>
    <script src="/admin/speechkit/jquery-3.2.1.min.js"></script>
    <script src="/admin/speechkit/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/template/reformator.css"/>
</head>
<body>
<div class="wrapper_all">
    <div id="responce">

    </div>
    <form name="form_text_to_speech" >
        <div>
            <input type="submit" value="send"> <span class="clear_text_button">clear text</span>
            <textarea placeholder="Text..." name="textarea_text_to_speech" id="textarea_text_to_speech" cols="100" rows="20"></textarea>
            <div id="symbol_counter"></div>
            <textarea name="token" id="token" cols="100" rows="5"></textarea>
            <input type="submit" value="send">
        </div>
    </form>
    <p>
        windows+r<br>
        cmd<br>
        В cmd набрать это:<br>yc iam create-token</p>

    <div id="loading_informer">

    </div>
    <?php
?>
</div>

</body>

</html>