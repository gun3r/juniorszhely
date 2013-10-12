<?php
	 include 'kuki.php';
	 include 'connection.php';
	 $sp_code = $_COOKIE["sp_code"];
	 $mod=$_POST[mod];

     if($mod==1){
	 
	 $besz = "UPDATE `eszkoz`.`data` 
	 SET  `alert` = '0', `a_szam`='$_POST[a_szam]', `serial1`='$_POST[serial1]', `eszkoz1`='$_POST[nev1]',`serial2`='$_POST[serial2]',`eszkoz2`='$_POST[nev2]',`date` = CURDATE() WHERE	 `data`.`id` = '$_POST[id]' ";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{
	 $besz = "INSERT INTO data(a_szam, serial1,eszkoz1, serial2,eszkoz2, sp_code, date)
	 	  VALUES('$_POST[a_szam]','$_POST[serial1]','$_POST[nev1]','$_POST[serial2]','$_POST[nev2]', '$sp_code',CURDATE() )";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	
	mysqli_close($con);
	
	$URL="lista.php"; 
    header ("Location: $URL");
?>