<?php // Create connection

include 'connection.php';

$sql="INSERT INTO members (sp_code, name, password, jog) VALUES
('$_POST[sp_code]','$_POST[name]','$_POST[sp_code]', '$_POST[jog]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
$URL="ember.html"; header ("Location: $URL");

mysqli_close($con);
?>
