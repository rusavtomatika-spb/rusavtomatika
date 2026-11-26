<?

/*ini_set('error_reporting', E_ALL);

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);*/

global $current_component;

global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;

global $db;

$DESCRIPTION = 'Codesys';

$KEYWORDS = '';

$TITLE = 'Codesys';

$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";

include $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";



require_once $_SERVER['DOCUMENT_ROOT'] . '/sc/lib_new.php';



$num = "codesys";

$sql = "SELECT * FROM products_all WHERE `model` = '$num' ";

$res = mysql_query($sql) or die(mysql_error());

$r = mysql_fetch_object($res);





?>

<article>

    <h1>Codesys</h1>





    <?

    $imgRemoteDir="/images/" . mb_strtolower($r->brand) . "/" . mb_strtolower($r->type) ."/" . $r->model . "/";

    $new_path_picture = get_new_path_picture($imgRemoteDir);

    ?>



    <div class="detail_image__wrapper">

        <?

        $counter=0;

        foreach ($new_path_picture as $image_url):?>

            <a class="detail_image__image-main_link" id="detail_image__image-main_link_<?=$counter++?>" style="display: none;" data-fancybox="gallery" href="<?echo $imgRemoteDir . "/lg/" . $image_url?>">

                <div class="detail_image__image-main" style="background-image:url(<?echo $imgRemoteDir . "/md/" . $image_url?>);"></div>

            </a>

        <?endforeach;?>



        <div class="detail_image__images-mini__wrapper">

            <div class="detail_image__images-mini__inner">



                <?

                $counter=0;

                foreach ($new_path_picture as $image_url):?>

                    <div data-rel="detail_image__image-main_link_<?=$counter++?>" class="detail_image__images-mini" style="background-image:url(<?echo $imgRemoteDir . "/sm/" . $image_url?>);"></div>

                <?endforeach;?>



            </div>

        </div>





    </div>

    <div class="color_text_block">

        <p>

            <strong>��������� ����������</strong> ��������� ���������������� ������������, ����������� �������������� ������������������.

            �� <strong>��������� ����������</strong> �������� ��������� ������������ ������ Windows XP, Windows 7, Windows 10, Linux, Ubuntu.

        </p>

        <p>

            <strong>������������ ����������</strong> �������� � ������� ������������ ��������. �������� �� ���������� NEMA 4/IP65 � ����� ������� ������������� �����.

            ��� ������� ��������� ����� � <strong>��������� �����������</strong> ������� �������������� ����� ���������� PCI / PCIe.

            � ������� ������� <strong>��������� ����������</strong> ������ ���������� �� 7� �� 32�

        </p>

    </div>







</article>



<?



include $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";

?>



