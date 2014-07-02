<?php
header('Content-Type: text/html; charset=utf-8');
include 'connection.php';
  
$sql="SELECT * FROM  `user` WHERE eventus = \"$_POST[sp_code]\" ";
	$h=date("m");
	$n=date("d");
	$d=mktime(0, 0, 0, $h, $n+1, 2014);
$res = mysqli_query($con, $sql);
$row_cnt = intval(mysqli_num_rows($res));
if($row_cnt != 1)
{
	$URL="index.php"; 
    header ("Location: $URL");
	}

while($sor = mysqli_fetch_array($res)) {
$belep = $sor['belep'];
$pass = $sor['password'];
$pass1 = $_POST[password];
$sp = $_POST[sp_code];
mysqli_close($con);

 if ($pass == $pass1 and $belep=='1') {
    
	setcookie("sp_code", $sp, $d);
	
	}
 
}
 $URL="index.php"; 
 header ("Location: $URL"); 


?>