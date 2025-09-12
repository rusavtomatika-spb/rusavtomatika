<img src="../images/111.jpg" width="100%" height="100%" alt=""/>
<?
$image_size = getimagesize('../images/111.jpg');

$window_width = $image_size[0];

$window_height = $image_size[1];
echo $window_width.'/'.$window_height;
?>
