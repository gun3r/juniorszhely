<?php // Create connection

include 'connection.php';

$sql="UPDATE adat SET  note='BO-nak továbbítva ".date("Y-m-d")."',bo='1' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
mysqli_close($con);
  $URL="pontkalkulator.php?p=4"; header ("Location: $URL");
?>