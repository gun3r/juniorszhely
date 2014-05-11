<?php // Create connection

include 'connection.php';

$sql="INSERT INTO user (name, eventus, munkacsoport, password) VALUES
('$_POST[name]','$_POST[eventus]','$_POST[munkacsoport]', '$_POST[eventus]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
$URL="ember.php"; header ("Location: $URL");

mysqli_close($con);
?>
