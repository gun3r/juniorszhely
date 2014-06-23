<?php


$datum2=$_POST["dat2"];
$datum3=$_POST["dat3"];

$deltat = strtotime($datum3)-strtotime($datum2);
echo $deltat/60/60/24+1;
$h=date("m");
$n=date("d");
$d=mktime(0, 0, 0, $h, $n+1, 2014);
setcookie("dat2", $datum2, $d);
setcookie("dat3", $datum3, $d);

$URL="index.php"; 
header ("Location: $URL");
exit();  

?>