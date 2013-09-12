<?php
	 include 'kuki.php';
	 include 'connection.php';
	 $sp_code = $_COOKIE["sp_code"];	 	 
	 $besz = "INSERT INTO data(a_szam, serial1, serial2, sp_code, date)
	 	  VALUES('$_POST[a_szam]','$_POST[serial1]','$_POST[serial2]', '$sp_code',CURDATE() )";
		  
	if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 echo "Sikeres csere.";
	 
	
	mysqli_close($con);
	
	$URL="lista.php"; 
    header ("Location: $URL");
?>