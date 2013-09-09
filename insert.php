<?php
// Create connection
$con=mysqli_connect("localhost","root","laciferi","eszkoz");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql="INSERT INTO members (id, sp_code, name, jog)
VALUES
('$_POST[id]','$_POST[sp_code]','$_POST[name]', '$_POST[jog]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";
  
mysqli_close($con);
?>