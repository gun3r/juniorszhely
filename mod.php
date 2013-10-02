<?php
// Create connection
include 'connection.php';
include 'kuki.php';
  
  $data=$_POST[data];
  
  if ($data==1){
 //OKÉ 
  $sql="UPDATE `eszkoz`.`data` SET `closed` = '1', `date2` = CURDATE() WHERE `data`.`id` = '$_POST[id]' ";
  
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  }
  if ($data==2){
  //valami nem jó
  $sql="UPDATE `eszkoz`.`data` SET `alert` = '1' WHERE `data`.`id` = '$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  }
  else{
	//megjavult
  $sql="UPDATE `eszkoz`.`data` SET `alert` = '0' WHERE `data`.`id` = '$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  }
$URL="lista.php"; 

header ("Location: $URL"); 
  
mysqli_close($con);
?>