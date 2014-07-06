<?php // Create connection

include 'connection.php';
$URL="portfolio.php";
if($_POST[mod]==0){
$sql="INSERT INTO portfolio (nev, osszeg) VALUES
('$_POST[nev]','$_POST[osszeg]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
header ("Location: $URL");
}

if($_POST[mod]==1){

$sql2="UPDATE portfolio SET  nev='$_POST[nev]',osszeg='$_POST[osszeg]' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql2))
  {
  die('Error: ' . mysqli_error($con));
  }
 mysqli_close($con); 
 header ("Location: $URL");

}

if($_POST[mod]==2)
{
$sql="DELETE FROM  portfolio WHERE  `id` ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  mysqli_close($con);
 header ("Location: $URL");
}
mysqli_close($con);
?>
