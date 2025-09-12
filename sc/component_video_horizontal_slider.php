<?

function get_video_list($db_table, $order_by = "id", $filter = "")
{
    global $mysqli_db;
    if (!isset($db_table))
        return false;
    if (is_array($filter) and count($filter) > 0) {
        $filter_str = " WHERE ";
        $x = 0;
        foreach ($filter as $key => $value) {
            if ($x++ == 0) {
                $filter_str .= "`$key`='$value' ";
            } else {
                $filter_str .= " and `$key`='$value' ";
            }
        }
    }
    if ($order_by != "")
        $ORDER_BY_STR = " ORDER BY `$order_by` DESC, `id` DESC limit 12";
    $query = "SELECT * FROM `$db_table`" . $filter_str . $ORDER_BY_STR . "";
    $result = mysqli_query($mysqli_db,$query) or die("Invalid query: $query" . mysqli_error($mysqli_db));
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        for ($row = 0; $row < $rows; $row++) {
            $current_row = mysqli_fetch_assoc($result);
            $out[] = $current_row;

        }
    } else {
        $out = '';
    };
    $out_reversed = array_reverse($out);
    $counter = 0;
    $arr_temp1 = array();
    $arr_temp2 = array();
    foreach ($out_reversed as $item) {
        $item['id']." ";
        $arr_temp1[] = $item;
        if ($counter++ == 2) {
            $arr_temp1 = array_reverse($arr_temp1);
            $arr_temp2 = array_merge($arr_temp2, $arr_temp1);
            $counter = 0;
            $arr_temp1 = array();
        }
    }
    return $arr_temp2;
}

$video_list = get_video_list("videos", "onmainpage_position", Array("show" => "1", "onmainpage" => "1", ));


?>

<div class="horizontal_slider_default">
    <div id="carouselhAuto2">
        <?
        $COUNTER = 0;
        foreach ($video_list as $key => $value) {
            $COUNTER++;

            $url = "/video/" . $value["code"] . "/";
            ?>
            <div class="horizontal_slider_default__item COUNTER<?= $COUNTER ?>">
                <div class="horizontal_slider_default__item_wrapinn">
                    <a href="<?= $url ?>" class="horizontal_slider_default__item__item_link">
                        <div class="horizontal_slider_default__item__item_name_wrap">
                            <div class="horizontal_slider_default__item__item_name" title="<? echo $value["name"]; ?>">

                                <? if (isset($value["date"]) and $value["date"] != ""): ?>
                                    <span><?
                                        echo date("d.m.Y", strtotime($value["date"]));
                                        ?></span> |
                                <? endif; ?>

                                <?
                                if (strlen($value["name"]) > 95) {
                                    echo substr(strip_tags($value["name"]), 0, 92) . "...";
                                } else {
                                    echo strip_tags($value["name"]);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="horizontal_slider_default__item__item_picture_preview_wrap">
                                 <img src="<?= $value["picture_preview"]; ?>" alt="<?=$value["name"]?>" loading="lazy">
                        </div>
                    </a>
                </div>
            </div>
            <?
        }
        ?>
    </div>
</div>
<style>
    .horizontal_slider_default {
        background: #fff;
        padding: 0 0px;
        position: relative;
    }

    .horizontal_slider_default a {
        text-decoration: none;
    }

    .horizontal_slider_default__item {
        padding: 5px;
        width: 350px;
    }

    .horizontal_slider_default__item_wrapinn {
        padding: 0px 10px 10px 10px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
        background: #fff;
        transition: 0.1s

    }

    .horizontal_slider_default__item_wrapinn:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
        padding: 1px 11px 11px 11px;
        margin: -1px;
    }


    .horizontal_slider_default__item__item_picture_preview_wrap {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        min-height: 187px;
    }

    .horizontal_slider_default__item__item_name {
        padding: 5px 0px 2px;
        color: #333;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.4;
        text-decoration: none;
        height: 40px;
        text-overflow: ellipsis;
        overflow: hidden;
        display: block;
        overflow: hidden;
        vertical-align: top;
        width: 100%;
        text-align: left;
        font-family: "Roboto", sans-serif;
    }

    .horizontal_slider_default__item__item_picture_preview {
        background: center top/100% auto;
        width: 100%;
        height: 210px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.2) inset;
    }
</style>
<style type="text/css">

    /*�������������� �������� CSS*/
    .jscarousal-horizontal {
        width: 100%; /* ������ � ������ ������� ��� ������� */
        box-sizing: border-box;
        background: #34ab5e;
        height: 300px;
        margin: 0;
        padding-top: 22px;
        position: relative;
    }

    .jscarousal-contents-horizontal {
        width: 100%; /* ������ � ������ ������� ��� ������ */
        height: 250px;
        float: left;
        position: relative;
        overflow: hidden;
    }

    .jscarousal-horizontal-back, .jscarousal-horizontal-forward {
        position: absolute;
        z-index: 10;
        width: 30px;
        height: 50px;
        margin-top: -25px;
        background-color: #fff;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        top: 50%;
        cursor: pointer;
        opacity: 0.9;
        transition: 0.1s;
    }

    .jscarousal-horizontal-back {
        background-image: url('/cms/components/vertical_slider/templates/default/img/arr-left-green.png');
        background-repeat: no-repeat;
        left: 7px;
    }

    .jscarousal-horizontal-forward {
        background-image: url('/cms/components/vertical_slider/templates/default/img/arr-right-green.png');
        right: 7px;
    }

    .jscarousal-horizontal-back:hover, .jscarousal-horizontal-forward:hover {
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
        transform: scale(1.05);
        opacity: 1;
    }


    .jscarousal-contents-horizontal > div {
        position: absolute;
        width: 100%;
    }

    .jscarousal-contents-horizontal > div > div {
        float: left;
        margin-left: 8px;
        margin-right: 8px;
    }

    /*�������������� �������� CSS*/


    /*�����*/
    .hidden {
        display: none;
    }

    .visible {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thumbnail-active {
        filter: alpha(opacity=100);
        opacity: 1.0;
        cursor: pointer;
    }

    .thumbnail-inactive {
        filter: alpha(opacity=95);
        opacity: 0.95;
        cursor: pointer;
    }

    .thumbnail-text {
        color: #E0E0E0;
        font-weight: bold;
        text-align: left;
        display: block;
        padding: 2px 2px 2px 0px;
        line-height: 16px;
        font-size: 12px;
    }

    .thumbnail-text a {
        color: #E0E0E0;
        text-decoration: none;
        font-size: 12px;
    }

    .thumbnail-text a:hover {
        color: #fff;
    }
    #video-block{
        opacity: 0;
    }
</style>


<script src="/cms/components/vertical_slider/templates/default/jsCarousel-2.0.0.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
//������������
        $('#carouselhAuto2').jsCarousel({
            onthumbnailclick: function (src) { /* alert(src);*/
            }, //������� ��� ������� �� ��������
            autoscroll: true, //���/���� �������������
            itemstodisplay: 3, //������� ������� ����������
            scrollspeed: 500, //����� ������� ���������
            delay: 3500, //����� ��������� �������
            orientation: 'h', //�������������� h ��� ������������ v ��������
            circular: true
        });
        $('#video-block').css('opacity', '1');
    });
</script>
