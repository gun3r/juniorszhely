<?php
	 include 'connection.php';
	 	 	 
	 $besz = "INSERT INTO data(a_szam, serial1, serial2, date)
	 	  VALUES('$_POST[a_szam]','$_POST[serial1]','$_POST[serial2]',CURDATE() )";
		  
	if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 echo "Sikeres csere.";
	 
	
	mysqli_close($con);
?>

<br />
<a href="eszkozcsere.html">Vissza az előző oldalra.</a>