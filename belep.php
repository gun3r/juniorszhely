<?php
include 'connection.php';
  
$sql="SELECT * FROM  `members` WHERE sp_code = \"$_POST[sp_code]\" ";

$res = mysqli_query($con, $sql);
$row_cnt = intval(mysqli_num_rows($res));
if($row_cnt != 1)
{
	$URL="index.html"; 
    header ("Location: $URL");
	}

while($sor = mysqli_fetch_array($res)) {

$pass = $sor['password'];
$pass1 = $_POST[password];
$jog1 = intval($sor['jog']);
$sp = $_POST[sp_code];

 if ($pass == $pass1) {
 
	setcookie("sp_code", $sp, time()+3600);
	if ($jog1 == 2){
	$URL="lista.php"; 
    header ("Location: $URL");
	}else{

 $URL="eszkozcsere.html"; 
 header ("Location: $URL");
   }
	}else{
	$URL="index.html"; 
    header ("Location: $URL");
	}
 
}
  
mysqli_close($con);

?>