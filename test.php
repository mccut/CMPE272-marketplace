<?php

print "</br>";
print "<h3>Customers of ECWeb</h3>";
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, "http://www.shuzhongchen.com/show_user.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$data = curl_exec($ch);
curl_close($ch);
echo $data;

print "</br>";
print "<h3>Customers of Singleyefish Comics</h3>";
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, "http://www.open7smile.us/all_user.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$data = curl_exec($ch);
curl_close($ch);
echo $data;

?>