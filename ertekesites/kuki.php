<?php


$datum2=$_POST["dat2"];
$datum3=$_POST["dat3"];

$deltat = strtotime($datum3)-strtotime($datum2);
echo $deltat/60/60/24+1;

setcookie("dat2", $datum2, time()+360000);
setcookie("dat3", $datum3, time()+360000);

$URL="index.php"; 
header ("Location: $URL");
exit();  

?>