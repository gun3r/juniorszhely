<?php
echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>Korrekció</title>\n"; 
echo "</head>\n"; 
echo "<body>\n";

$datum4=$_COOKIE[dat4];
$datum5=$_COOKIE[dat5];
$csop=$_COOKIE[csop];

$h=date("m")+1;
$n=01;
$d1=mktime(0, 0, 0, $h, $n, 2014);

if (isset($_COOKIE["dat4"]))
{
if($_POST[s]==1){
$datum4=$_POST[dat4];
$datum5=$_POST[dat5];
$csop=$_POST[csop];
}
setcookie("dat4", $datum4, $d1);
setcookie("dat5", $datum5, $d1);
setcookie("csop", $csop, $d1);
} else {
$h=date("m")-1;
$n=01;
$d=mktime(0, 0, 0, $h, $n, 2014);
$datum4=date("Y-m-01", $d);
$datum5=date("Y-m-t", $d);
setcookie("dat4", $datum4, $d1);
setcookie("dat5", $datum5, $d1);
setcookie("csop", $csop, $d1);
}
include 'cookies.php';
include 'connection.php';
include 'fejlec.php';
if($nev=='Ács György'){
include 'feltoltp.php';
}
echo"Korrekció dátum:
<form action='pontkalkulator.php?p=4' enctype='multipart/form-data' method='post'>
<INPUT type='text' name='dat4' size='12' value='". $datum4. "'>
<INPUT type='text' name='dat5' size='12' value='".$datum5."'><br>
<input type='radio' name='csop' value='0'"; if($csop==0){echo 'checked';}echo ">Összes
<input type='radio' name='csop' value='1'"; if($csop==1){echo 'checked';}echo ">Ábel István
<input type='radio' name='csop' value='2'"; if($csop==2){echo 'checked';}echo ">Lévainé Járosy Éva
<input type='radio' name='csop' value='3'"; if($csop==3){echo 'checked';}echo ">Molnár József
<input type='radio' name='csop' value='4'"; if($csop==4){echo 'checked';}echo ">Mester Zoltán
<input type='radio' name='csop' value='5'"; if($csop==5){echo 'checked';}echo ">Fehér László
<input type='radio' name='csop' value='6'"; if($csop==6){echo 'checked';}echo ">Lidi László
<input type='hidden' name='s' value='1'>
<input id='Submit' name='submit' type='submit' size='3'value='OK' />
</form>";

if($csop==1)
{$csoport="(munkacsoport='1')";}
if($csop==2)
{$csoport="(munkacsoport='2')";}
if($csop==3)
{$csoport="(munkacsoport='3')";}
if($csop==4)
{$csoport="(munkacsoport='4')";}
if($csop==5)
{$csoport="(munkacsoport='5')";}
if($csop==6)
{$csoport="(munkacsoport='6')";}
if($csop==0)
{$csoport="munkacsoport='1' or munkacsoport='2' or munkacsoport='3' or munkacsoport='4' or munkacsoport='5' or munkacsoport='6' or munkacsoport='7' or munkacsoport='8'";}

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
		<td>Pontkalkulator</td>
		<td>Név</td>
		<td>Megjegyzés</td>
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
	</tr>";
		$sql = "SELECT * FROM adat WHERE ($csoport) and termek!='Törölve' and datum >='$datum4' and datum <='$datum5' Order by id asc";
		
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
$nevok=0;
$a=$sor['azonosito'];
$t=$sor['termek'];
$gomb="
<form name='input' action='note_be.php' method='post'>
<input type='text' size='100' name='note' value='" . $sor['note'] . "'>
<input type='hidden' name='id' value=" . $sor['id'] . ">
<input type='submit' value='Küldés'>
</form>";

 $sql2="SELECT * 
FROM  `pontkalkulator` 
WHERE 
	a =  '$a' AND e =  '$t'
 OR c =  '$a' AND e =  '$t'
 OR h = '$a' AND e =  '$t'
 OR y =  '$a' AND e =  '$t'";
$res2 = mysqli_query($con, $sql2);

$row_cnt = intval(mysqli_num_rows($res2));
if($row_cnt!=0){


while($sor2 = mysqli_fetch_array($res2)) {
$nevek=$sor2['l'];
if($nevek=="Pájer Csaba"){
$nevek="Pajer Csaba";
}
if (strpos($sor['name'],$nevek) !== false) {
    $nevok=1;
}

}
if($nevok==1){
//echo "<td>Rendben</td>";
}
else{
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
 <form action=\"adat.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
echo "<td>Rögzítve</td>";   
echo "<td>Nem -". $nevek ."</td>";
echo "<td>".$gomb."</td>";
}

}
else{
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
 <form action=\"adat.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
echo "<td>Nincs rögzítve</td>";
echo "<td></td>";
echo "<td>".$gomb."</td>";
}
echo"</tr>";
}
	
echo "</table> 
	</body> 
	</html>";
?>