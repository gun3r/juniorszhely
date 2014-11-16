<?php
$idi=$sp=$_COOKIE['idi'];

echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>Adatok</title>\n"; 
echo "</head>\n"; 
echo "<body>\n";
include 'cookies.php';
include 'connection.php';
include 'fejlec.php';
$formaction="adat.php?p=1";
$datum1=$_COOKIE[dat11];
$datum2=$_COOKIE[dat12];
$idm=$_COOKIE[idm];

$h=date("m");
$n=date("d");;
$d1=mktime(0, 0, 0, $h, $n+1, 2014);

if (isset($_COOKIE["dat11"]))
{
if($_POST[s]==1){
$datum1=$_POST[dat11];
$datum2=$_POST[dat12];
}
setcookie("dat11", $datum1, $d1);
setcookie("dat12", $datum2, $d1);
} else {
$h=date("m");
$n=date("d");
$d=mktime(0, 0, 0, $h, $n-3, 2014);
$datum1=date("Y-m-d", $d);
$d=mktime(0, 0, 0, $h, $n, 2014);
$datum2=date("Y-m-d", $d);
setcookie("dat11", $datum1, $d1);
setcookie("dat12", $datum2, $d1);
}
echo"
<form action='".$formaction."' enctype='multipart/form-data' method='post'>
<INPUT type='text' name='dat11' size='12' value='". $datum1. "'>
<INPUT type='text' name='dat12' size='12' value='".$datum2."'>
<input type='hidden' name='s' value='1'>
<input id='Submit' name='submit' type='submit' size='3'value='OK' />
</form>";
if($idi!=0){
include 'szur.php';
echo "
 <table border=0><tr><td><form action='adat2.php?p=1' method='post'>
 <input type=\"hidden\" name=\"honnan\" value=\"1\">
 <input type=\"submit\" value=\"Új adat felvitele\">
 </form></td>";
 echo"
<td><form action=\"csvment.php\" method=\"post\">
 <input type=\"submit\" value=\"Adatok mentése(CSV)\">
</form></td></tr></table>";
 
} 
$mod=$_POST[mod];


if($mod==1){
$sql = "SELECT * FROM  `adat` WHERE  `id` =  '$_POST[id]'";
$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

		$name=$sor['name'];
		$azonosito=$sor['azonosito'];
		$termek=$sor['termek'];
		$alap=$sor['alap'];
		$tobblet=$sor['tobblet'];
		$munkadij=$sor['munkadij'];
		$eszkoz=$sor['eszkoz'];
		$eszkoz2=$sor['eszkoz2'];
		$datum=$sor['datum'];
		$kizarva=$sor['kizarva'];
		$namev=$name;
		$termekv=$termek;
		$status=$sor['status'];
		$eszkalacio=$sor['eszkalacio'];
}
}else{
		$name="Válasz!";
		$azonosito="";
		$termek="Válasz!";
		$alap="";
		$tobblet="";
		$munkadij="";
		$eszkoz="";
		$eszkoz2="";
		$datum=date("Y-m-d");
		$kizarva="0";
		$namev="";
		$termekv="";
		$status="";
		$eszkalacio="0";
$mod=0;
}
echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Név</td>
		<td>Azonosítók/WF/Előfizető</td>
		<td>Termék</td>
		<td>Alap</td>
		<td>Többlet</td>
		<td>Munkadíj</td>
		<td>Kis értékű portfólió</td>
		<td>Nagy értékű portfólió</td>
		<td>Dátum</td>
		<td>Státusz</td>
		<td>Eszkaláció</td>
		<td>Kizárva</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>";
		$mitol=$datum1;
		$meddig=$datum2;
		//adatok lekérdezése
		if($idi==0){
$sql = "SELECT * FROM adat
		WHERE name='$nev' and datum >='$mitol' and datum <='$meddig' Order by id desc";

}else{
		$sql = "SELECT * FROM adat WHERE datum >='$mitol' and datum <='$meddig' Order by id desc";
		}
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>" . $sor['status'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "disabled=\"disabled\"><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>";
		if($idi!=0){
echo "
 <form action=\"adat2.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"1\">
 <input type=\"submit\" value=\"Módosít\">
 </form>";}
 echo"</td>
		</tr>";}
	
echo "</table>";
if($idi!=0){
echo"<br>
<form action=\"csvment.php\" method=\"post\">
 <input type=\"submit\" value=\"Adatok mentése(CSV)\">
</form>";
} 
echo "	</body> 
	</html>";
?>
