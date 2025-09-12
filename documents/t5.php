<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test5</title>
</head>

<body>
<h1>Test5</h1>
<br>
<br>
<?php
	$tmp_bufer = $_SERVER[ 'DOCUMENT_ROOT' ] . '/documents/tmp_soft/';
  function deleteFolder( $folderPath ) {
    global $tmp_bufer;
    global $chap_bufer;
	  
    if ( is_dir( $folderPath ) ) {
      $files = scandir( $folderPath );
      foreach ( $files as $file ) {
        if ( $file != "." && $file != ".." ) {
          if ( is_dir( $folderPath . '/' . $file ) ) {
            if ( $folderPath != $tmp_bufer ) {
              deleteFolder( $folderPath . '/' . $file );
            }
          } else {
            unlink( $folderPath . '/' . $file );
          }
        }
      }
      if ( $folderPath != $tmp_bufer ) {
        rmdir( $folderPath );
      }
    }
  }
// open this directory 
$myDirectory = opendir($tmp_bufer);
// get each entry
while($entryName = readdir($myDirectory)) {
    $dirArray[] = $entryName;
}
// close directory
closedir($myDirectory);
//  count elements in array
$indexCount = count($dirArray);
Print ("$indexCount files<br>\n");
// sort 'em
sort($dirArray);
// print 'em
print("<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks>\n");
print("<TR><TH>Filename</TH><th>Filetype</th><th>Filesize</th></TR>\n");
// loop through the array of files and print them all
for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
        print("<TR><TD><a href=\"$dirArray[$index]\">$dirArray[$index]</a></td>");
        print("<td>");  print(filetype($dirArray[$index])); print("</td>");
        print("<td>");  print(filesize($dirArray[$index])); print("</td>");
        print("</TR>\n");
    }
}
print("</TABLE>\n");
	?>
</body>
</html>