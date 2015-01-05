<?php


$datum2=$_POST["dat2"];
$datum3=$_POST["dat3"];

$dt=$_POST['dat2'];
//$dt="02/28/2007";
$arr=split("-",$dt); // splitting the array
$yy=$arr[0]; // first element of the array is month
$mm=$arr[1]; // second element is date
$dd=$arr[2]; // third element is year
If(!checkdate($mm,$dd,$yy)){

$URL="index.php"; 
header ("Location: $URL");

exit();  
}else {
echo "Entry date is correct";
}

$dt=$_POST['dat3'];
//$dt="02/28/2007";
$arr=split("-",$dt); // splitting the array
$yy=$arr[0]; // first element of the array is month
$mm=$arr[1]; // second element is date
$dd=$arr[2]; // third element is year
If(!checkdate($mm,$dd,$yy)){

$URL="index.php"; 
header ("Location: $URL");

exit();  
}else {
echo "Entry date is correct";
}

$deltat = strtotime($datum3)-strtotime($datum2);
echo $deltat/60/60/24+1;
$h=date("m");
$n=date("d");
$d=mktime(0, 0, 0, $h, $n+1, 2015);
setcookie("dat2", $datum2, $d);
setcookie("dat3", $datum3, $d);

$URL="index.php"; 
header ("Location: $URL");
exit();  

?>