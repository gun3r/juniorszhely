<?php
$idi=$sp=$_COOKIE['idi'];
if($idi==0){
$URL="index.php?p=0"; header ("Location: $URL");
}

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
if($nev=='Dancsecs András'){
include 'feltoltp.php';
echo "<a href=korrekcio.txt>Korrekcio letöltés</a>(jobb gomb mentés másként:)<br><br>";
}
echo"Korrekció dátum:
<form action='pontkalkulator.php?p=4' enctype='multipart/form-data' method='post'>
<INPUT type='text' name='dat4' size='12' value='". $datum4. "'>
<INPUT type='text' name='dat5' size='12' value='".$datum5."'><br><br>
<select name='csop' size=”1”>
      <option value='0'";if($csop==0){echo "selected";}echo ">Összes</option>
      <option value='1'";if($csop==1){echo "selected";}echo ">Biczó Éva</option>
      <option value='2'";if($csop==2){echo "selected";}echo ">Edőcs János</option>
	  <option value='11'";if($csop==11){echo "selected";}echo ">Berta Ottilia</option>
	  <option value='12'";if($csop==12){echo "selected";}echo ">Pinczés Éva</option>
	  <option value='13'";if($csop==13){echo "selected";}echo ">Csuka Jennifer Inez</option>
	  <option value='3'";if($csop==3){echo "selected";}echo ">Háromi Gábor</option>
	  <option value='4'";if($csop==4){echo "selected";}echo ">Grund Lajos</option>
	  <option value='5'";if($csop==5){echo "selected";}echo ">Márfy Attila</option>
	  <option value='7'";if($csop==7){echo "selected";}echo ">Feil Ferenc</option>
	  <option value='8'";if($csop==8){echo "selected";}echo ">Mihálka István</option>
	  <option value='9'";if($csop==9){echo "selected";}echo ">Molnár Ferenc</option>
	 </select>
<input type='hidden' name='s' value='1'>
<input id='Submit' name='submit' type='submit' size='3'value='OK' />
</form>";

if($csop==1)
{$csoport="(munkacsoport='Grund Lajos' or munkacsoport='Háromi Gábor' or munkacsoport='1' or munkacsoport='2' or munkacsoport='Vasi Full-táv KFT.' or munkacsoport='5') and (alap='1' or tobblet='1')";}
if($csop==2)
{$csoport="(munkacsoport='Savanyó Ernõ' or munkacsoport='Márfy Attila' or munkacsoport='3' or munkacsoport='4' or munkacsoport='Vasi Full-táv KFT.' or munkacsoport='5') and (alap='1' or tobblet='1')";}
if($csop==11 or $csop==13)
{$csoport="(munkacsoport='6' or munkacsoport='7' or munkacsoport='8' or munkacsoport='9' or munkacsoport='10') and (alap='1' or tobblet='1')";}
if($csop==12)
{$csoport="(munkacsoport='6' or munkacsoport='7' or munkacsoport='8' or munkacsoport='9' or munkacsoport='10') and (alap='1' or tobblet='1')";}
if($csop==3)
{$csoport="(munkacsoport='Háromi Gábor' or munkacsoport='1') and alap='0' and tobblet='0' ";}
if($csop==4)
{$csoport="(munkacsoport='Grund Lajos' or munkacsoport='2') and alap='0' and tobblet='0' ";}
if($csop==5)
{$csoport="(munkacsoport='Savanyó Ernõ' or munkacsoport='3') and alap='0' and tobblet='0' ";}
if($csop==6)
{$csoport="(munkacsoport='Márfy Attila' or munkacsoport='4') and alap='0' and tobblet='0' ";}
if($csop==7)
{$csoport="(munkacsoport='6') and alap='0' and tobblet='0' ";}
if($csop==8)
{$csoport="(munkacsoport='7') and alap='0' and tobblet='0' ";}
if($csop==9)
{$csoport="(munkacsoport='8') and alap='0' and tobblet='0' ";}

if($csop==0)
{$csoport="munkacsoport='Grund Lajos' or munkacsoport='Háromi Gábor' or munkacsoport='Savanyó Ernõ' or munkacsoport='Márfy Attila' or munkacsoport='1' or munkacsoport='6' or munkacsoport='7' or munkacsoport='8'  or munkacsoport='2' or munkacsoport='3' or munkacsoport='4' or munkacsoport='Vasi Full-Táv Kft.' or munkacsoport='5'";}

echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Név</td>
		<td>Azonosító/WF/Előfizető</td>
		<td>Termék</td>
		<td>Alap</td>
		<td>Többlet</td>
		<td>Munkadíj</td>
		<td>Eszköz portfóliós</td>
		<td>Eszköz nem portfóliós</td>
		<td>Dátum </td>
		<td>Státusz</td>
		<td>Eszkaláció</td>
		<td>Kizárva</td>
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
		<td></td>
		<td></td>
		<td></td>
	</tr>";
		$sql = "SELECT * FROM adat WHERE ($csoport) and termek!='Törölve' and datum >='$datum4' and datum <='$datum5' Order by id asc";
		
		$res = mysqli_query($con, $sql);

$myfile = fopen("korrekcio.txt", "w") or die("Unable to open file!");

fwrite($myfile, "name;azonosito;wf;efinev;termek;alap;tobblet;munkadij;eszkoz;eszkoz2;datum;status;eszkalacio;eszkalacio megjegszes;kizarva;korrekcio megjegyzes\r\n");



while($sor = mysqli_fetch_array($res)) {
$nevok=0;
$a=$sor['azonosito'];
$t=$sor['termek'];
$k=$sor['kizarva'];
$i=$sor['id'];
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
$datumkiz=$sor2['b'];
if($nevek=="Pájer Csaba"){
$nevek="Pajer Csaba";
}
if($nevek=="Horváth Ottó"){
$nevek="Horváth Ottó András";
}
if (strpos($sor['name'],$nevek) !== false) {
    $nevok=1;
	
}

}
if($nevok==1){
if($k==1){
$URL="kizaraski.php?id=$i&datum=$datumkiz";
echo "<a href="."$URL".">Kizárt és szerepel a statisztikába</a>\n";

	}
}
else{
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
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>
 <form action=\"adat2.php?p=4\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"2\">
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
		<td>" . $sor['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>" . $sor['status'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>
 <form action=\"adat2.php?p=4\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"2\">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
echo "<td>Nincs rögzítve</td>";
echo "<td></td>";
echo "<td>".$gomb."</td>";
fwrite($myfile, $sor['name'].";".$sor['azonosito'] . ";" . $sor['wf'] . ";" . $sor['efinev'] . ";" . $sor['termek'] . ";" . $sor['alap'] . ";" . $sor['tobblet'] . ";" . $sor['munkadij'] . ";" . $sor['eszkoz'] . ";" . $sor['eszkoz2'] . ";" . $sor['datum'] . ";" . $sor['status'] . ";".$sor['eszkalacio'].";".$sor['note2'].";".$sor['kizarva'].";".$sor['note']."\r\n");
}
echo"</tr>";
}
fclose($myfile);	
echo "</table> 
	</body> 
	</html>";
?>