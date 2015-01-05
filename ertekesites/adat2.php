<?php
$idi=$sp=$_COOKIE['idi'];
if($idi==0){
$URL="index.php?p=0"; header ("Location: $URL");
}
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
$mod=$_POST[mod];
$honnan=intval($_POST[honnan]);

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
		$wf=$sor['wf'];
		$efinev=$sor['efinev'];
		$status=$sor['status'];
		$eszkalacio=$sor['eszkalacio'];
		$note2=$sor['note2'];
		$status2=$sor['status2'];
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
		$wf="";
		$efinev="";
		$status="";
		$eszkalacio="0";
		$note2="";
		$status2="";
$mod=0;
}
echo "<form action=\"adat_be.php\" method=\"post\">\n"; 
echo "<table border=\"1\" bordercolor=\"orange\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Név</td><td><select name=\"name\" size=\”1\”>
	<option value=\"".$namev."\"selected>".$name."</option>";
	
$sql = "SELECT name,kilepett FROM user WHERE munkacsoport<=99 and munkacsoport='$idm' and kilepett>='$datum' Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\">  " . $sor['name'] . "</option>\n";
}
$sql = "SELECT name,kilepett FROM user WHERE munkacsoport<=99 and hol='$idm' and kilepett>='$datum' Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\">  " . $sor['name'] . "</option>\n";
}
$sql = "SELECT name,kilepett FROM user WHERE munkacsoport<=99 and munkacsoport!='$idm' and kilepett>='$datum' Order by name";

$res = mysqli_query($con, $sql);


while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\">  " . $sor['name'] . "</option>\n";
}	
		
echo " 	</select></td></tr>
		<tr><td>Azonosító</td><td><input type=\"text\" name=\"azonosito\" value=\"".$azonosito."\"></td>
		</tr>
		<tr><td>Wf</td><td><input type=\"text\" name=\"wf\" value=\"".$wf."\"></td>
		</tr>
		<tr><td>Előfizető</td><td><input type=\"text\" name=\"efinev\" value=\"".$efinev."\"></td>
		</tr>
		<tr><td>Termék</td><td><select name=\"termek\" size=\”1\”>
	<option value=\"".$termekv."\" selected>".$termek."</option>";
	
$sql = "SELECT nev FROM termek WHERE 1 Order by nev";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['nev'] . "\">  " . $sor['nev'] . "</option>\n";
}	
		
echo " 	</select></td></tr>
		<tr><td>Munkadíj</td><td><input type=\"text\" name=\"munkadij\" value=\"".$munkadij." \"size=\"6\"></td></tr>
		<tr><td>Kis értékű portfólió</td><td><select name=\"eszkoz1\" size=\"1\">
		<option value=\"".$eszkoz."\" selected>".$eszkoz."</option>";
	
		$sql = "SELECT nev,osszeg,kiemelt FROM portfolio WHERE 1 Order by kiemelt desc, nev asc";

		$res = mysqli_query($con, $sql);

		while($sor = mysqli_fetch_array($res)) {

		echo "  <option value=\"" . $sor['osszeg'] . "\" size=\"12\" >  " . $sor['nev'] . " - " . $sor['osszeg'] . "Ft</option>\n";
		}
		
echo " 	</select></td></tr>
		<tr><td>Nagy értékű portfólió</td><td><input type=\"text\" name=\"eszkoz2\" value=\"".$eszkoz2."\"size=\"15\"> Nettó számítása:<input type='checkbox' name='netto' value='1'></td></tr>
		<tr><td>Dátum</td><td><input type=\"text\" name=\"datum\" value=\"". $datum ."\" size=\"10\"></td></tr>";
		echo "	
		<tr><td>Eventus/MJR</td><td><select name=\"status2\" size=\"1\">
		<option value=\"".$status2."\" selected>".$status2."</option>";
	
		$sql = "SELECT * FROM status2 WHERE 1 Order by status asc";

		$res = mysqli_query($con, $sql);

		while($sor = mysqli_fetch_array($res)) {

		echo "  <option value=\"" . $sor['status'] . "\">".$sor['status']."</option>\n";
		}
		
echo " 	</select></td></tr>";
if($stat==1){
		echo "	
		<tr><td>Státusz</td><td><select name=\"status\" size=\"1\">
		<option value=\"".$status."\" selected>".$status."</option>";
	
		$sql = "SELECT * FROM status WHERE 1 Order by status asc";

		$res = mysqli_query($con, $sql);

		while($sor = mysqli_fetch_array($res)) {

		echo "  <option value=\"" . $sor['status'] . "\">".$sor['status']."</option>\n";
		}
		
echo " 	</select></td></tr>
		<tr><td>Eszkaláció</td><td><input type=\"checkbox\" name=\"eszkalacio\" value=\"1\" "; if($eszkalacio==1){echo " checked";}echo "></td></tr>";}
echo "	<tr><td>Eszkaláció megjegyzés</td><td><input type=\"text\" name=\"note2\" value=\"".$note2."\"size=\"50\"></td></tr>
		<tr><td>Kizárva</td><td><input type=\"checkbox\" name=\"kizarva\" value=\"1\" "; if($kizarva==1){echo " checked";}echo "></td></tr>
		<tr><td></td><td><input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">";
		if($stat!=1){echo "<input type=\"hidden\" name=\"status\" value=\"".$status."\">";}
echo "	<input type=\"hidden\" name=\"honnan\" value=\"".$honnan."\">
		<input type=\"hidden\" name=\"id\" value=\"". $_POST[id]. "\">
		<input type=\"submit\" value=\"Adatok küldése\"></form></td></tr>";
?>