<?php // Create connection

include 'connection.php';

$sql="UPDATE adat SET  kizarva='0', datum='$_GET[datum]' WHERE  id ='$_GET[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
mysqli_close($con);
  $URL="pontkalkulator.php?p=4"; header ("Location: $URL");

  ?>