<?php
header('Content-Type: text/html; charset=utf-8');
include 'connection.php';
$datum1=date("Y-m-d");	 		
$sql="SELECT * FROM  `user` WHERE eventus = \"$_POST[sp_code]\" and kilepett>='$datum1' ";
	$h=date("m");
	$n=date("d");
	$d=mktime(0, 0, 0, $h, $n+1, 2015);
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
$munkacsoport=$sor['munkacsoport'];
$iranyito=$sor['belep'];
$tippmix=$sor['tippmix'];
$nev=$sor['name'];
mysqli_close($con);

 if ($pass == $pass1) {
    
	setcookie("sp_code", $sp, $d);
	setcookie("idm", $munkacsoport, $d);
	setcookie("idi", $iranyito, $d);

	if($sp!=''){
	$myfile = fopen("belep.txt", "a");
	fwrite($myfile, $nev.";".$sp.";".$datum1."\r\n");
	fclose($myfile);
	}
	
	}
 
}
 $URL="index.php"; 
 header ("Location: $URL"); 


?>