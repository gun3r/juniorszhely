<?php // Create connection

include 'connection.php';
$datum=date("Y-m-d H:i:s");
$sql="UPDATE adat SET  note='$_POST[note]',datum2='$datum' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
mysqli_close($con);
$honnan=$_POST[honnan];
if($honnan==1){
$URL="adat.php?p=1"; header ("Location: $URL");
}
if($honnan==2){
$URL="pontkalkulator.php?p=4"; header ("Location: $URL");
}
if($honnan==3){
$URL="szuro.php?p=1"; header ("Location: $URL");
}
if($honnan==10){
$URL="backoffice.php?p=10"; header ("Location: $URL");
}
?>