<?
$db_work = new DBWORK();
$brands = $db_work->get_brands();
$db_work = new DBWORK();
$series = $db_work->get_series();
$db_work = new DBWORK();
$types = $db_work->get_types();
//echo "<pre>";
//echo print_r($types);
//echo "</pre>";
$db_work_count = new DBWORK();
$all_elements_count = $db_work_count->get_list_catalog_elements();
$total_products = is_array($all_elements_count) ? count($all_elements_count) : 0;
?>
<?
if (!isset($current_admin) || !$current_admin) {
    $current_admin = check_admin_auth();
}
$admin_username = isset($current_admin['username']) ? $current_admin['username'] : '';
?>
<div class="menu_wrapper">
        <div class="menu_wrapper_col1">
          <input class="filterInput input" type="text" placeholder="Фильтр по тексту..." id="search">
<div>
<select name="brands" id="brands">
  <option value="">--Фильтр по бренду--</option>
<?
	foreach ($brands as $key => $brand) {
		echo '<option value="'.$brand['code'].'">'.$brand['code'].'</option>';
	}
	?>
</select>
<select name="types" id="types">
  <option value="">--Фильтр по типу--</option>
<?
	$tipy = array();
	foreach ($types as $key => $type) {
	array_push($tipy, $type['code']);
	}
	$tipy = array_unique($tipy);
	//$tipy = sort($tipy);
	foreach ($tipy as $key => $type) {
		echo '<option value="'.$type.'">'.$type.'</option>';
	}
	?>
</select>
	<?
	//print_r($tipy);
	?>
<select name="series" id="series">
  <option value="">--Фильтр по серии--</option>
<?
	foreach ($series as $key => $serie) {
		echo '<option value="'.$serie['name'].'">'.$serie['name'].'</option>';
	}
	?>
</select>
</div>
</div>
    <?
    if (isset($_COOKIE["template_theme"])) {
        $selected_theme_option = $_COOKIE["template_theme"];
    } else $selected_theme_option = "";
    if (isset($_COOKIE["show_all_fields"])) {
        $selected_show_all_fields = $_COOKIE["show_all_fields"];
    } else $selected_show_all_fields = "";
    ?>
    <div class="menu_wrapper_col2">
        <ul class="menu">
            <li>
                <a href="/admin">Главная</a>
                <span class="separator"></span>
                <a target="_blank" href="/">На сайт</a>
            </li>
            <li>sitemap.xml: <a target="_blank" href="https://www.rusavtomatika.com/sitemap/generate_sitemap_xml.php">На проде</a> | <a target="_blank" href="https://www.rusavto.moisait.net/sitemap/generate_sitemap_xml.php">На MC</a></li>
            <li>
                <select class="choosing_template_theme" name="template_theme" style="width: 100%;">
                    <option value="0" <?if($selected_theme_option == 0) echo 'selected'?>>Тема КРУПНАЯ</option>
                    <option value="1" <?if($selected_theme_option == 1) echo 'selected'?>>Тема МЕЛКАЯ</option>
                </select>
            </li>
        </ul>
        <p class="products__counter-p">Всего товаров: <?= $total_products ?></p>
    </div>
    <div class="admin-menu-wrapper">
        <div class="header__user-info">
            <p><?= htmlspecialchars($current_admin['username']) ?></p>
            <a href="/admin/logout.php" class="action__button logout-btn">
                Выход
                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <g id="logout">
                        <line style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;" x1="15.92" x2="28.92" y1="16" y2="16"/>
                        <path style="fill: #fff; stroke: none;" d="M23.93,25v3h-16V4h16V7h2V3a1,1,0,0,0-1-1h-18a1,1,0,0,0-1,1V29a1,1,0,0,0,1,1h18a1,1,0,0,0,1-1V25Z"/>
                        <line style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;" x1="28.92" x2="24.92" y1="16" y2="20"/>
                        <line style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;" x1="28.92" x2="24.92" y1="16" y2="12"/>
                        <line style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;" x1="24.92" x2="24.92" y1="8.09" y2="6.09"/>
                        <line style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;" x1="24.92" x2="24.92" y1="26" y2="24"/>
                    </g>
                </svg>
            </a>
        </div>
        <div class="action__buttons-wrapper">
            <a href="/admin/add_element.php" class="action__button add-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 15 15" fill="none" aria-hidden="true">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.5 2.5a1 1 0 0 1 1 1V6.5H11.5a1 1 0 1 1 0 2H8.5V11.5a1 1 0 1 1-2 0V8.5H3.5a1 1 0 1 1 0-2H6.5V3.5a1 1 0 0 1 1-1Z"
                        fill="#ffffff"/>
                </svg>
                Добавить
            </a>
            <form action="/admin/sync_product.php" method="post">
                <button type="submit" name="run_sync" value="1" class="action__button sync-btn">
                    <svg fill="#fff" height="20px" width="20px" version="1.1" id="XMLID_123_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve" stroke="#fff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                        <g id="SVGRepo_iconCarrier"> <g id="sync"> <path d="M7.3,23.7L2.6,19l4.7-4.7l1.4,1.4L6.4,18H16c3.3,0,6-2.7,6-6V9h2v3c0,4.4-3.6,8-8,8H6.4l2.3,2.3L7.3,23.7z M2,15H0v-3 c0-4.4,3.6-8,8-8h9.6l-2.3-2.3l1.4-1.4L21.4,5l-4.7,4.7l-1.4-1.4L17.6,6H8c-3.3,0-6,2.7-6,6V15z"/> </g> </g>
                    </svg>
                    Синхрон.
                </button>
            </form>
        </div>
        <div class="action__buttons-wrapper">
            <form action="/admin/software/update.php" method="post">
                <input type="hidden" name="type" value="x">
                <button type="submit" name="run_sync" value="1" class="action__button update-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                        <path d="M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H10.5M13 3L19 9M19 9V11M21 14.5V17.5H18M19.5 20.2361C18.9692 20.7111 18.2684 21 17.5 21C15.8431 21 14.5 19.6569 14.5 18C14.5 16.3431 15.8431 15 17.5 15C18.8062 15 19.9175 15.8348 20.3293 17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    EBX
                </button>
            </form>
            <form action="/admin/software/update.php" method="post">
                <input type="hidden" name="type" value="pro">
                <button type="submit" name="run_sync" value="1" class="action__button update-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                        <path d="M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H10.5M13 3L19 9M19 9V11M21 14.5V17.5H18M19.5 20.2361C18.9692 20.7111 18.2684 21 17.5 21C15.8431 21 14.5 19.6569 14.5 18C14.5 16.3431 15.8431 15 17.5 15C18.8062 15 19.9175 15.8348 20.3293 17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    EBP
                </button>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                console.log($.cookie("template_theme"));
                if ($.cookie("template_theme") != undefined) {

                }
            });
            $('select.choosing_template_theme').on('change', function () {
                console.log(this.value);
                $.cookie("template_theme", this.value);
                location.reload();
            });
            $('#button_hide_fields').on('click', function () {
                $(this).css('opacity', '0.1');
                $.cookie("show_all_fields", '0');
                const url = new URL(document.location);
                const searchParams = url.searchParams;
                searchParams.delete("action");
                window.history.pushState({}, '', url.toString());
                //console.log(url);
                location.reload();
            });
            $('#button_show_fields').on('click', function () {
                $(this).css('opacity', '0.1');
                $.cookie("show_all_fields", '1');
                const url = new URL(document.location);
                const searchParams = url.searchParams;
                searchParams.delete("action"); // удалить параметр "test"
                window.history.pushState({}, '', url.toString());
                //console.log(url);
                location.reload();
            });
        </script>
    </div>
</div>