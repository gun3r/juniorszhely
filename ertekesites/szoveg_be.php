<?php // Create connection

include 'connection.php';

$sql="INSERT INTO uzenet (szoveg, colorh, colorsz, meret) VALUES
('$_POST[szoveg]','$_POST[colorh]','$_POST[colorsz]', '$_POST[meret]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
$URL="index.php"; header ("Location: $URL");

mysqli_close($con);
?>