<?php
$TITLE="contact";
$style="contact";
require_once "header.php";

    echo "<br>";
    echo "<br>";
    
    $fh = fopen('contacts.txt','r');
    print('<div class="container">');
    while ($line = fgets($fh)) {
    	if($line!="\n") print "<h4>$line</h4>";
    	else print "</br>";
    }
    print("</div>");
    fclose($fh);
    
require_once "footer.php"; 
?>
