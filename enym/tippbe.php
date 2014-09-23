<?php
include 'connection.php';
$URL="tippmix.php?p=7";

if($_POST[csoport]==3 or $_POST[csoport]==4){
$sql="INSERT INTO `tipp`(`name`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `19`, `20`, `21`, `22`, `23`, `24`) VALUES ('$_COOKIE[sp_code]',$_POST[a1],$_POST[a2],$_POST[a3],$_POST[a4],$_POST[a5],$_POST[a6],$_POST[a7],$_POST[a8],$_POST[a9],$_POST[a10],$_POST[a11],$_POST[a12],$_POST[a13],$_POST[a14],$_POST[a15],$_POST[a16],$_POST[a19],$_POST[a20],$_POST[a21],$_POST[a22],$_POST[a23],$_POST[a24])";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
}else{
$sql="INSERT INTO `tipp`(`name`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `19`, `20`, `21`, `22`, `23`, `24`) VALUES ('$_COOKIE[sp_code]',$_POST[a1],$_POST[a2],$_POST[a3],$_POST[a4],$_POST[a5],$_POST[a6],$_POST[a7],$_POST[a8],$_POST[a9],$_POST[a10],$_POST[a19],$_POST[a20],$_POST[a21],$_POST[a22],$_POST[a23],$_POST[a24])";

if (!mysqli_query($con,$sql))
	{
	die('Error: ' . mysqli_error($con));
	}
}  
  mysqli_close($con);
  header ("Location: $URL");
?>