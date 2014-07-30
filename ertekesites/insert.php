<?php // Create connection

include 'connection.php';
$URL="ember.php?p=6";
if($_POST[mod]==0){
$sql="INSERT INTO user (name, eventus, munkacsoport, password) VALUES
('$_POST[name]','$_POST[eventus]','$_POST[munkacsoport]', '$_POST[eventus]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
header ("Location: $URL");
}

if($_POST[mod]==1){

$sql2="UPDATE user SET  name='$_POST[name]',eventus='$_POST[eventus]',munkacsoport='$_POST[munkacsoport]',iranyito='$_POST[iranyito]',belep='$_POST[belep]',tippmix='$_POST[tippmix]' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql2))
  {
  die('Error: ' . mysqli_error($con));
  }
 mysqli_close($con); 
 header ("Location: $URL");

}

if($_POST[mod]==2)
{
$sql="DELETE FROM  `ertekesites`.`user` WHERE  `user`.`id` ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  mysqli_close($con);
 header ("Location: $URL");
}
mysqli_close($con);
?>
