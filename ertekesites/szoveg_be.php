<?php // Create connection

include 'connection.php';
if($_POST[meret]>==){
$meret=7;
}else{
$meret=$_POST[meret];
}
$sql="INSERT INTO uzenet (szoveg, colorh, colorsz, meret) VALUES
('$_POST[szoveg]','$_POST[colorh]','$_POST[colorsz]', '$meret')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
$URL="index.php"; header ("Location: $URL");

mysqli_close($con);
?>