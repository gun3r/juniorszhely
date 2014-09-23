<?php // Create connection

include 'connection.php';
if($_POST[meret]>='7'){
$meret=7;
}
$sql12="INSERT INTO `uzenet`(`szoveg`, `colorh`, `colorsz`, `meret`) VALUES ('$_POST[szoveg]','$_POST[colorh]','$_POST[colorsz]', '$meret')";

if (!mysqli_query($con,$sql12))
  {
  die('Error: ' . mysqli_error($con));
  }
$URL="index.php"; header ("Location: $URL");
mysqli_close($con);
?>