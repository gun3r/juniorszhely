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
$d1=mktime(0, 0, 0, $h, $n+1, 2015);

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
$d=mktime(0, 0, 0, $h, $n-3, 2015);
if($idi==0){
$datum1=date("Y-m-01", $d);
}else{
$datum1=date("Y-m-d", $d);
}
$d=mktime(0, 0, 0, $h, $n, 2015);
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
		$mobil=$sor['mobil'];
		$alap=$sor['alap'];
		$megtarto=$sor['magtarto'];
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
		$mobil=$sor['mobil'];
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

$ren=intval($_COOKIE['r2']);

$rendez="id desc";

$rk=1;
$rs=1;
$rd=1;

$nyilup="↓";
$nyildown="↑";

if($_GET['rk']==1){$ren=1;}
if($_GET['rk']==2){$ren=2;}
if($_GET['rs']==1){$ren=3;}
if($_GET['rs']==2){$ren=4;}
if($_GET['rd']==1){$ren=5;}
if($_GET['rd']==2){$ren=6;}


if($ren==1)
{
setcookie('r2', 1,time() + (60*60*24 * 3650));
$nyilk=$nyildown;
$rs=1;$rd=1;
$rk=2;
$rendez="name asc";
}
if($ren==2)
{
setcookie('r2', 2,time() + (60*60*24 * 3650));
$nyilk=$nyilup;
$rs=1;$rd=1;
$rk=1;
$rendez="name desc";
}

if($ren==3)
{
setcookie('r2', 3,time() + (60*60*24 * 3650));
$nyils=$nyildown;
$rk=1;$rd=1;
$rs=2;
$rendez="status asc";
}
if($ren==4)
{
setcookie('r2', 4,time() + (60*60*24 * 3650));
$nyils=$nyilup;
$rk=1;$rd=1;
$rs=1;
$rendez="status desc";
}

if($ren==5)
{
setcookie('r2', 5,time() + (60*60*24 * 3650));
$nyild=$nyildown;
$rs=1;$rk=1;
$rd=2;
$rendez="datum asc";
}
if($ren==6)
{
setcookie('r2', 6,time() + (60*60*24 * 3650));
$nyild=$nyilup;
$rs=1;$rk=1;
$rd=1;
$rendez="datum desc";
}

echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td><a href='adat.php?p=1&rk=".$rk."'>Kolléga</a>  ".$nyilk."</td>
		<td>Azonosítók/WF/Előfizető</td>
		<td>Termék</td>
		<td>Mobil új postpaid SIM</td>
		<td>Vezetékes új BB és TV</td>
		<td>Mobil postpaid SIM és fix <br> TV, BB, hang megtartás</td>
		<td>Non-Core szolgáltatás</td>
		<td colspan=2>Tartozék és munkadíj</td>
		<td>Eszköz értékesítés</td>
		<td><a href='adat.php?p=1&rd=".$rd."'>Dátum</a>  ".$nyild."</td>
		<td>Eventus/MJR</td>";
		if($idi!=0){echo"
		<td><a href='adat.php?p=1&rs=".$rs."'>Státusz</a>  ".$nyils."</td>
		<td>Eszkaláció</td>
		<td>Kizárva</td>
		<td></td>";};
echo"	
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
		";
		if($idi!=0){echo"
		<td></td>
		<td></td>
		<td></td>
		<td></td>";}
echo"	</tr>";
		$mitol=$datum1;
		$meddig=$datum2;
		//adatok lekérdezése
		if($idi==0){
$sql = "SELECT * FROM adat
		WHERE name='$nev' and datum >='$mitol' and datum <='$meddig' Order by $rendez";

}else{
		$sql = "SELECT * FROM adat WHERE datum >='$mitol' and datum <='$meddig' Order by $rendez";
		}
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['mobil'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['megtarto'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>" . $sor['status2'] . "</td>";
		if($idi!=0){
echo"	<td>" . $sor['status'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "disabled=\"disabled\"><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>";
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
