<?php // Create connection

include 'connection.php';
$nev=$_POST[name];
$mod=$_POST[mod];
$termek=$_POST[termek];
$munkadij=$_POST[munkadij];
$eszkoz1=$_POST[eszkoz1];
$eszkoz2=$_POST[eszkoz2];
$netto=$_POST[netto];
$datum=date("Y-m-d");
if($netto==1){
$eszkoz2=$eszkoz2/1.27;
}
if($termek!='Törölve'){
$sql = "SELECT alap, tobblet FROM termek WHERE nev LIKE \"%$termek%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

$alap=$sor['alap'];
$tobblet=$sor['tobblet'];

if($alap!=$tobblet){
$munkadij=0;
$eszkoz1=0;
$eszkoz2=0;
}
if($termek=='munkadij' or $termek=='szsz_munkadij'){
$eszkoz1=0;
$eszkoz2=0;
}
if($termek=='eszkoz' or $termek=='szsz_eszkoz'){
$munkadij=0;
$eszkoz2=0;
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
}
$sql = "SELECT munkacsoport FROM user WHERE name LIKE \"%$nev%\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$munkacsop=$sor['munkacsoport'];
}
$m=intval($munkacsop);

if($mod==1){
	 
	 $besz = "UPDATE `ertekesites`.`adat` 
	 SET  name='$_POST[name]',munkacsoport='$m',azonosito='$_POST[azonosito]',termek='$_POST[termek]',alap='$alap',tobblet='$tobblet',munkadij='$munkadij',eszkoz='$eszkoz1',eszkoz2='$eszkoz2',datum='$_POST[datum]',datum2='$datum',kizarva='$_POST[kizarva]',wf='$_POST[wf]',efinev='$_POST[efinev]',status='$_POST[status]',eszkalacio='$_POST[eszkalacio]',note2='$_POST[note2]'	 WHERE	 `adat`.`id` = '$_POST[id]'";
		  
	 if (!mysqli_query($con,$besz))
	   {
	       die('Hiba: '.mysqli_error($con));
	   }
	 }
	 else{



$sql="INSERT INTO adat (name,munkacsoport,azonosito,termek,alap,tobblet,munkadij,eszkoz,eszkoz2,datum,datum2,wf,efinev,status,eszkalacio, note2) VALUES
('$_POST[name]','$m','$_POST[azonosito]','$_POST[termek]',$alap,$tobblet,'$munkadij','$eszkoz1','$eszkoz2','$_POST[datum]','$_POST[datum]','$_POST[wf]','$_POST[efinev]','$_POST[status]','$_POST[eszkalacio]','$_POST[note2]')";

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

?>