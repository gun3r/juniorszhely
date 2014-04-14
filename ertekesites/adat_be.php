<?php // Create connection

include 'connection.php';
$nev=$_POST[name];
$mod=$_POST[mod];

$sql = "SELECT munkacsoport FROM user WHERE name LIKE \"%$nev%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$munkacsop=$sor['munkacsoport'];
}
$m=intval($munkacsop);

if($mod==1){
	 
	 $besz = "UPDATE `ertekesites`.`adat` 
	 SET  name='$_POST[name]',munkacsoport='$m',azonosito='$_POST[azonosito]',termek='$_POST[termek]',alap='$_POST[alap]',tobblet='$_POST[tobblet]',munkadij='$_POST[munkadij]',eszkoz='$_POST[eszkoz1]',eszkoz2='$_POST[eszkoz2]',datum='$_POST[datum]'	 WHERE	 `adat`.`id` = '$_POST[id]' ";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{



$sql="INSERT INTO adat (name,munkacsoport,azonosito,termek,alap,tobblet,munkadij,eszkoz,eszkoz2,datum) VALUES
('$_POST[name]','$m','$_POST[azonosito]','$_POST[termek]','$_POST[alap]','$_POST[tobblet]','$_POST[munkadij]','$_POST[eszkoz1]','$_POST[eszkoz2]','$_POST[datum]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
}
  $URL="adat.php"; header ("Location: $URL");

mysqli_close($con);
?>