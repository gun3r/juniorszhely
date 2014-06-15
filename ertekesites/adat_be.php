<?php // Create connection

include 'connection.php';
$nev=$_POST[name];
$mod=$_POST[mod];
$termek=$_POST[termek];
$datum=date("Y-m-d");
if($termek!='Törölve'){
$sql = "SELECT alap, tobblet FROM termek WHERE nev LIKE \"%$termek%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

$alap=$sor['alap'];
$tobblet=$sor['tobblet'];
}
}
$sql = "SELECT munkacsoport FROM user WHERE name LIKE \"%$nev%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$munkacsop=$sor['munkacsoport'];
}
$m=intval($munkacsop);

if($mod==1){
	 
	 $besz = "UPDATE `ertekesites`.`adat` 
	 SET  name='$_POST[name]',munkacsoport='$m',azonosito='$_POST[azonosito]',termek='$_POST[termek]',alap='$alap',tobblet='$tobblet',munkadij='$_POST[munkadij]',eszkoz='$_POST[eszkoz1]',eszkoz2='$_POST[eszkoz2]',datum='$_POST[datum]',datum2='$datum'	 WHERE	 `adat`.`id` = '$_POST[id]'";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{



$sql="INSERT INTO adat (name,munkacsoport,azonosito,termek,alap,tobblet,munkadij,eszkoz,eszkoz2,datum,datum2) VALUES
('$_POST[name]','$m','$_POST[azonosito]','$_POST[termek]',$alap,$tobblet,'$_POST[munkadij]','$_POST[eszkoz1]','$_POST[eszkoz2]','$_POST[datum]','$_POST[datum]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
}
  $URL="adat.php"; header ("Location: $URL");

mysqli_close($con);
?>