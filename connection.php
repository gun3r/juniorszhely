<?php
// Create connection
$con=mysqli_connect("localhost","junior","laciferi","eszkoz");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$utf8_beallitas = mysqli_query($con, "SET NAMES 'utf8'") or die ("Nem sikerült a utf8 beállítás!");
 ?>
