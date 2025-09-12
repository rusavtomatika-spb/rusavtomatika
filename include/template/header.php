<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=windows-1251" />

            <meta http-equiv="Content-Language" content="ru" />

                <title><? echo get_kw("title"); ?></title>

                <meta name="description" content="<? echo get_kw("descr"); ?>" />

                    <meta name="keywords" content="<? echo get_kw("kw"); ?>" />

                        <meta name="viewport" content="width=1110" />

        <link rel="stylesheet" type="text/css" href="/css/ra.css?310120201008" />

                        <link rel="stylesheet" type="text/css" href="/css/menu4.css?310120201008" />

                        <link rel="stylesheet" type="text/css" href="/css/tabs.css?310120201008" />

                        <link rel="stylesheet" type="text/css" href="/css/button.css?310120201008" />

                        <link rel="stylesheet" type="text/css" href="/css/tango/skin.css?310120201008" />

                        <link href="/lightbox/css/lightbox.css?310120201008" rel="stylesheet" />



                        <link rel="stylesheet" href="/css/jquery-ui-smoothness.css?310120201008">

                            <link rel="stylesheet" href="/css/jquery-ui-base.css?310120201008" />

                            <?php if ($name == 'main' OR $name == 'mainnew') { ?> <link rel="stylesheet" href="/css/main.css?310120201008" /><?php }; ?>

                            <script src="/js/jquery-1.10.2.js?310120201008"></script>

                            <?/*?><script src="/js/jquery-ui.js?310120201008"></script><?*/?>



                            <script type="text/javascript" src="/js/jquery.cookie.js?310120201008"></script>

                            <script type="text/javascript" src="/js/jquery.jcarousel.js?310120201008"></script>

                            <script src="/lightbox/js/lightbox.js?310120201008"></script>

                            <script type="text/javascript" src="/js/ra_scripts.js?310120201008"></script>

                            <script type="text/javascript" src="/js/s.js?310120201008"></script>

                            <script type="text/javascript" src="/js/jquery.maskedinput.js?310120201008"></script>

                            <script type="text/javascript" src="/js/sha512.js?310120201008"></script>













                            <script src="/js/search.js?310120201008"></script>

                            <?

                            if ($_SERVER['HTTP_HOST'] == "www.rusavto.moisait.net") {

                                echo '

                    <script type="text/javascript" src="/sc/mistakes-4.1/mistakes.js"></script>

                    <link href="/sc/mistakes-4.1/mistakes.css" rel="stylesheet" type="text/css" />

';

                            }

                            ?>



                            

<link rel="stylesheet" type="text/css" href="/css/styles_of_george_martin.css" />

<link rel="stylesheet" type="text/css" href="/css/styles_of_victor_pelevin.css" />

        <?

        global $extra_styles;

        if (isset($extra_styles) and $extra_styles != ''){

            echo $extra_styles;

        }

        ?>





        <?

        global $extra_openGraph;

        if (isset($extra_openGraph) and $extra_openGraph != ''){

            foreach ($extra_openGraph as $paramName => $paramValue) {

                switch ($paramName) {

                    case "openGraph_image":

                        echo "<meta property='og:image' content='" . $paramValue . "'/>" ;

                        echo '

                        ';

                        echo "<link rel='image_src' href='" . $paramValue . "'>";

                        echo '

                        ';

                        break;

                    case "openGraph_title":

                        echo "<meta property='og:title' content='" . $paramValue . "'/>" ;

                        echo '

                        ';

                        break;

                    case "openGraph_siteName":

                        echo "<meta property='og:site_name' content='" . $paramValue . "'/>";

                        echo '

                        ';

                        break;

                }

            }

        }

        ?>



</head>