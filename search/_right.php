<?
if (empty($_COOKIE['a'])) {
    setcookie("a", "r", time() + 60 * 60 * 24 * 365, "/", $_SERVER['SERVER_NAME'], 0);
//header('Location: /_right.php');
};
if ($_COOKIE['a'] == 'r') {
    echo '<h1>Permission is granted, my Lord!</h1>';
    ?>
    <div class="menu-bar">
        <ul>
            <li><a href="/search/">�����</a></li>
            <li><a href="/search/index_index.php">����������</a></li>
            <li><a href="/search/index_weight_map.php">����� �����</a></li>
            <li><a href="/search/statistics.php">���������� ��������</a></li>
        </ul>
    </div>        
    <?
} else {
    echo '<h1>Permission is granted, my Lord!</h1>';
    ?>
    <div class="menu-bar">
        <ul>
            <li><a href="/search/">�����</a></li>
            <li><a href="/search/index_index.php">����������</a></li>
            <li><a href="/search/index_weight_map.php">����� �����</a></li>
        </ul>
    </div>        
    <?
};
?>
