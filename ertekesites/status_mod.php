<?php // Create connection

include 'connection.php';
$URL="status.php";
if($_POST[mod]==0){
$sql="INSERT INTO status (status) VALUES
('$_POST[status]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
header ("Location: $URL");
}

if($_POST[mod]==1){

$sql2="UPDATE status SET  status='$_POST[status]' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql2))
  {
  die('Error: ' . mysqli_error($con));
  }
 mysqli_close($con); 
 header ("Location: $URL");

}

if($_POST[mod]==2)
{
$sql="DELETE FROM  status WHERE  `id` ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  mysqli_close($con);
  header ("Location: $URL");
}
mysqli_close($con);
?>
