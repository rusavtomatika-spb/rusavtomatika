<? if (isset($_GET["search"])){
    $text = strip_tags(trim($_GET["search"]));
    if (mb_detect_encoding($text) == 'UTF-8') {
        $text = iconv("utf-8", "windows-1251", $text);
    }    
}else{$text = "";}?>
<div class="search_panel_in_header">
    
    <input type="text" class="search_input"  placeholder="поиск по сайту..." <?if ($text):?>value="<?=$text?>"<?endif;?>           >
    <div class="search_button"></div>
    <div class="search_hints"></div>
    
</div>
<script>
    
</script>
<style>
.search_panel_in_header {
	position: relative;
        width: 250px;
}
.search_panel_in_header .search_input {
	background: #f0f0f0;
	color: black;
	border: none;
	width: 210px;
	font-family: Tahoma, Geneva, Verdana, sans-serif;
	font-size: 13px;
	padding: 0 13px;
	box-sizing: border-box;
	outline: none;
	height: 40px;
}
.search_panel_in_header .search_button {
	position: absolute;
	top: 0px;
	right: 0px; 
	cursor: pointer;
	width: 40px;
	height: 40px;
	background: #44bb6e url('/images/lupa.png') center no-repeat;
	transition: 0.2s;
}
.search_panel_in_header .search_button:hover {
	background-color: #34ab5e;
}
.search_panel_in_header .search_hints{
    background: #fff;padding: 10px;display: none;padding:5px 3px;box-shadow: 0 0 4px rgba(0,0,0,0.2);
    box-sizing: border-box;
    width: 207px;
    margin-left: 2px;
}
.search_panel_in_header .word_hint {
	margin: 6px 10px;
	padding: 0;
	font-size: 11px;
	cursor: pointer;
	display: block;
	text-decoration: none;
}
.search_panel_in_header .word_hint:hover {text-decoration: underline;}

.search_panel_in_header .word_hint .highlight {
	background: #dfd;
	font-weight: 400;
        font-size: 11px;
	padding: 1px 0;
}
</style>
