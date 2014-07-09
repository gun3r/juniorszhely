<?php
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
include 'szur.php';
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
		$namev=$name;
		$termekv=$termek;
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
		$namev="";
		$termekv="";
$mod=0;
}
echo "<form action=\"adat_be.php\" method=\"post\">\n"; 
echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Név</td>
		<td>Azonosító</td>
		<td>Termék</td>
		<td>T-home</td>
		<td>Többlet</td>
		<td>Munkadíj</td>
		<td>Eszköz portfóliós</td>
		<td>Eszköz nem portfóliós</td>
		<td>Dátum </td>
		<td></td>
	</tr>
	<tr>
	<td><select name=\"name\" size=\”1\”>
	<option value=\"".$namev."\" selected>".$name."</option>";
	
$sql = "SELECT name FROM user WHERE munkacsoport<=99 Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\">  " . $sor['name'] . "</option>\n";
}	
		
echo " 	</select></td>
			
		<td><input type=\"text\" name=\"azonosito\" value=\"".$azonosito."\"size=\"10\"></td>
		
		<td><select name=\"termek\" size=\”1\”>
	<option value=\"".$termekv."\" selected>".$termek."</option>";
	
$sql = "SELECT nev FROM termek WHERE 1 Order by nev";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['nev'] . "\">  " . $sor['nev'] . "</option>\n";
}	
		
echo " 	</select></td>
		
		<td><input type=\"text\" name=\"alap\" value=\"".$alap."\"size=\"3\"></td>
        <td><input type=\"text\" name=\"tobblet\" value=\"".$tobblet."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"munkadij\" value=\"".$munkadij." \"size=\"6\"></td>
		";if($nev=='Edőcs János'){echo"
		<td><input type=\"text\" name=\"eszkoz1\" value=\"".$eszkoz." \"size=\"6\"></td>";
		}else{
		echo"
		<td><select name=\"eszkoz1\" size=\"1\">
		<option value=\"".$eszkoz."\" selected>".$eszkoz."</option>";
	
		$sql = "SELECT nev,osszeg,kiemelt FROM portfolio WHERE 1 Order by kiemelt desc, nev asc";

		$res = mysqli_query($con, $sql);

		while($sor = mysqli_fetch_array($res)) {

		echo "  <option value=\"" . $sor['osszeg'] . "\" size=\"12\" >  " . $sor['nev'] . " - " . $sor['osszeg'] . "Ft</option>\n";
		}
		
echo " 	</select></td>";}
echo "	<td><input type=\"text\" name=\"eszkoz2\" value=\"".$eszkoz2."\"size=\"15\"></td>
		<td><input type=\"text\" name=\"datum\" value=\"". $datum ."\" size=\"10\"></td>
		<td>
		<input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">
		<input type=\"hidden\" name=\"id\" value=\"". $_POST[id]. "\">
		<input type=\"submit\" value=\"OK\"></form></td>
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
	</tr>";
		$mitol=$datum1;
		$meddig=$datum2;
		$sql = "SELECT * FROM adat WHERE datum >='$mitol' and datum <='$meddig' Order by id desc";
		
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>
 <form action=\"adat.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>
		</tr>";}
	
echo "</table> 
	</body> 
	</html>";
?>
