<?
if (!defined('PROLOG_INCLUDED')) exit;
$cms_template_url = "/core/templates/rusavtomatika_responsive/";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv=Content-Type content=text/html; charset=windows-1251>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <? ob_start(); ?>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>bootstrap-grid.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $cms_template_url ?>template_styles.css?<?= rand() ?>"/>
    <script type="text/javascript" src="<?= $cms_template_url ?>scripts.js"></script>
</head>

<body style="opacity: 0;transition: opacity 0.2s" class="responsive_template">
<div class="panel-white">
    <div class="sticky_header_wrapper">
        <div class="sticky_header">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_panel_flex">
                                <div class="logo_wrapper">
                                    <a class="logo" href="/"><img src="<?= $cms_template_url ?>images/ra_logo.webp"></a>
                                </div>
                                <div class="panel_search">
                                    <input type="text" class="search_input" placeholder="����� �� �����..."
                                           style="cursor: auto;">
                                    <div class="search_button"></div>
                                </div>
                                <div class="panel_catalog_menu_button">
                                    <div class="button_open_menu">
                                        ������� ������������ <span class="arrow-down"></span>
                                    </div>
                                </div>
                                <div class="panel_header_buttons">
                                    <div class="button compare">
                                        <span>10</span>
                                    </div>
                                    <div class="button favorites">
                                        <span>20</span>
                                    </div>
                                    <div class="button cart">
                                        <span>3</span>
                                    </div>
                                    <div class="button contacts">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="mainmenu">
                    <ul>
                        <li class="level1"><a href="/about.php"> � �������� </a></li>
                        <li class="separator">|</li>
                        <li class="level1">
                            <a href="/news/"> ������� <span class="arrow-down"></span></a>
                            <ul style="width:268px;margin-left:-9px;">
                                <li class="level2"><a href="/new-products/"><span
                                                class="store-new-badge"></span>�������
                                        ���������</a></li>
                                <li class="level2"><a href="/video/"><span class="youtube"></span>
                                        ����������
                                        rusavtomatika.com</a></li>
                            </ul>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/articles/">������</a></li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/advanced_search.php"
                                              title="������ ������������ �� ����������">������</a>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/comparison.php">���������</a></li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/payment-shipping.php">������ � ��������</a>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1">
                            <a href="/download.php"> ������� <span class="arrow-down"></span></a>
                            <ul style="width:253px;margin-left:-50px;">
                                <li class="level2"><a href="/download.php">���������� � ��������</a>
                                </li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/documents/">���������</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_projects/">���� �������
                                        Weintek</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a
                                            href="/weintek_projects/?find_projects=Macro%20Sample">����
                                        ������� Weintek</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_libraries/">���������� ���
                                        EasyBuilder</a></li>
                                <li class="separator"></li>
                                <li class="level2"><a href="/weintek_drivers/">�������� ���
                                        (����.&nbsp;�&nbsp;Weintek)</a></li>
                            </ul>
                        </li>
                        <li class="separator">|</li>
                        <li class="level1"><a href="/contacts.php"> �������� </a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="main_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img style="margin: -30px -15px 0px; width: 1350px;" src="<?= $cms_template_url ?>images/main_page_content/slider.webp">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12"><img style="margin: 0 auto 0px; width: 1320px;display: block" src="<?= $cms_template_url ?>images/main_page_content/slider2.webp">
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>