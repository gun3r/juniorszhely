<?php
// Create connection
include 'connection.php';
  
  $data=$_POST[data];
  
  if ($data==1){
  
  $sql="UPDATE `eszkoz`.`data` SET `closed` = '1' WHERE `data`.`id` = '$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  }else{
  $sql="UPDATE `eszkoz`.`data` SET `alert` = '1' WHERE `data`.`id` = '$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  }
$URL="lista.php"; 

header ("Location: $URL"); 
  
mysqli_close($con);
?>