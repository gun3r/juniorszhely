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
	 
	 $besz = "UPDATE `ertekesites`.`elvaras` 
	 SET  aktiv='$_POST[aktiv]',name='$_POST[name]',alap='$_POST[alap]',tobblet='$_POST[tobblet]',munkadij='$_POST[munkadij]',eszkoz='$_POST[eszkoz1]',eszkoz2='$_POST[eszkoz2]',ev='$_POST[ev]'	 WHERE	 `elvaras`.`id` = '$_POST[id]' ";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{



$sql="INSERT INTO elvaras (aktiv, name,alap,tobblet,munkadij,eszkoz,eszkoz2,ev) VALUES
('$_POST[aktiv]','$_POST[name]','$_POST[alap]','$_POST[tobblet]','$_POST[munkadij]','$_POST[eszkoz1]','$_POST[eszkoz2]','$_POST[ev]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
}
  $URL="elvaras.php?p=2"; header ("Location: $URL");

mysqli_close($con);
?>