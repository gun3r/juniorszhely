<?php // Create connection

include 'connection.php';
$sp=$_COOKIE['sp_code'];
$sql10 = 	"SELECT name from `user` 
			WHERE eventus='$sp'";
$res10 = mysqli_query($con, $sql10);
while($sor10 = mysqli_fetch_array($res10)) {
$kezelo=$sor10['name'];
}

$nev=$_POST[name];
$mod=$_POST[mod];
$termek=$_POST[termek];
$munkadij=$_POST[munkadij];
$eszkoz1=$_POST[eszkoz1];
$eszkoz2=$_POST[eszkoz2];
$netto=$_POST[netto];
$datum=date("Y-m-d H:i:s");
$status2=$_POST[status2];
if($netto==1){
$eszkoz2=$eszkoz2/1.27;
}
if($termek!='Törölve'){
$sql = "SELECT mobil, alap, tobblet,megtarto FROM termek WHERE nev LIKE \"%$termek%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

$mobil=$sor['mobil'];
$alap=$sor['alap'];
$tobblet=$sor['tobblet'];
$megtarto=$sor['megtarto'];

if($alap!=$tobblet){
$munkadij=0;
$eszkoz1=0;
$eszkoz2=0;
}

if($termek=='munkadij' or $termek=='szsz_munkadij'){
$eszkoz1=0;
$eszkoz2=0;
$status2="Eventusban van";
}
if($termek=='eszkoz' or $termek=='szsz_eszkoz'){
$munkadij=0;
$eszkoz2=0;
$status2="Eventusban van";
}
if($termek=='t-home eszköz'){
$eszkoz1=0;
$munkadij=0;
}
}
}
if($termek==''){
$alap=0;
$tobblet=0;
$mobil=0;
$megtarto=0;
}

if($termek=='VOCA ALAP szolgáltatás' or $termek=='VOIP'){
if($_POST[datum]>='2015-01-01'){
$alap=0;
$megtarto=1;
}
}

if($termek=='Vonali termék'){
if($_POST[datum]>='2015-01-01'){
$alap=0;
$megtarto=0;
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
	 SET  name='$_POST[name]',munkacsoport='$m',azonosito='$_POST[azonosito]',termek='$_POST[termek]',mobil='$mobil', alap='$alap',megtarto='$megtarto',tobblet='$tobblet',munkadij='$munkadij',eszkoz='$eszkoz1',eszkoz2='$eszkoz2',datum='$_POST[datum]',datum2='$datum',kizarva='$_POST[kizarva]',wf='$_POST[wf]',efinev='$_POST[efinev]',status='$_POST[status]',eszkalacio='$_POST[eszkalacio]',note2='$_POST[note2]',kezelo='$kezelo',status2='$status2' WHERE	 `adat`.`id` = '$_POST[id]'";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{



$sql="INSERT INTO adat (name,munkacsoport,azonosito,termek,mobil,alap,megtarto,tobblet,munkadij,eszkoz,eszkoz2,datum,datum2,wf,efinev,status,eszkalacio, note2,kezelo,status2) VALUES
('$_POST[name]','$m','$_POST[azonosito]','$_POST[termek]',$mobil,$alap,$megtarto,$tobblet,'$munkadij','$eszkoz1','$eszkoz2','$_POST[datum]','$datum','$_POST[wf]','$_POST[efinev]','$_POST[status]','$_POST[eszkalacio]','$_POST[note2]','$kezelo','$status2')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
}
mysqli_close($con);
$honnan=$_POST[honnan];
if($honnan==1){
$URL="adat.php?p=1"; header ("Location: $URL");
}
if($honnan==2){
$URL="pontkalkulator.php?p=4"; header ("Location: $URL");
}
if($honnan==3){
$URL="szuro.php?p=1"; header ("Location: $URL");
}
if($honnan==10){
$URL="backoffice.php?p=10"; header ("Location: $URL");
}
?>