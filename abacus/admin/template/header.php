<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админка - Русавтоматика</title>
    <link rel="stylesheet" href="/abacus/admin/template/css/bulma.min.css">
    <link rel="stylesheet" href="/abacus/admin/template/css/template_admin_styles.css?<?= Date("dmYhis"); ?>">

    <script src="/abacus/admin/template/js/jquery-3.2.1.min.js"></script>
    <script src="/abacus/admin/template/js/jquery.cookie.js"></script>



    <script src="/abacus/admin/template/js/vue.global.js"></script>
    <script type="text/javascript" src="/js/axios.min.js"></script>
    <link rel="icon" type="image/gif" href="/abacus/admin/template/favicon.svg" />
</head>
<body>
<div class="container">
    <div class="column">
        <?
        use abacus\admin\components\menu\Menu;
        $menu = new Menu(
            [
                ["link" => "/abacus/admin/", "anchor" => "Главная"],
                ["link" => "/abacus/admin/products/", "anchor" => "Продукты"],
            ]
        );
        $menu->show();
        ?>


