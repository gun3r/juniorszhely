<?php
$idi=$sp=$_COOKIE['idi'];
if($idi==0){
$URL="index.php?p=0"; header ("Location: $URL");
}
if($_POST['mod']==1){
$azonosito=$_POST['id'];
include "email.php";
}
echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>Back Office</title>\n"; 
echo "</head>\n"; 
echo "<body>\n";

if (isset($_COOKIE["rp"])){
$ren=intval($_COOKIE['rp']);
}
$rendez="id asc";
$szamlalo=0;

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
setcookie('rp', 1,time() + (60*60*24 * 3650));
$nyilk=$nyildown;
$rs=1;$rd=1;
$rk=2;
$rendez="name asc";
}
if($ren==2)
{
setcookie('rp', 2,time() + (60*60*24 * 3650));
$nyilk=$nyilup;
$rs=1;$rd=1;
$rk=1;
$rendez="name desc";
}

if($ren==3)
{
setcookie('rp', 3,time() + (60*60*24 * 3650));
$nyils=$nyildown;
$rk=1;$rd=1;
$rs=2;
$rendez="status asc";
}
if($ren==4)
{
setcookie('rp', 4,time() + (60*60*24 * 3650));
$nyils=$nyilup;
$rk=1;$rd=1;
$rs=1;
$rendez="status desc";
}

if($ren==5)
{
setcookie('rp', 5,time() + (60*60*24 * 3650));
$nyild=$nyildown;
$rs=1;$rk=1;
$rd=2;
$rendez="datum asc";
}
if($ren==6)
{
setcookie('rp', 6,time() + (60*60*24 * 3650));
$nyild=$nyilup;
$rs=1;$rk=1;
$rd=1;
$rendez="datum desc";
}


$datum4=$_COOKIE[dat4];
$datum5=$_COOKIE[dat5];
$csop=$_COOKIE[csop];
$bo=$_COOKIE[bo];

$h=date("m")+1;
$n=01;
$d1=mktime(0, 0, 0, $h, $n, 2015);

if (isset($_COOKIE["dat4"]))
{
if($_POST[s]==1){
$datum4=$_POST[dat4];
$datum5=$_POST[dat5];
$csop=$_POST[csop];
$bo=$_POST[bo];
}
setcookie("dat4", $datum4, $d1);
setcookie("dat5", $datum5, $d1);
setcookie("csop", $csop, $d1);
setcookie("bo", $bo, $d1);
} else {
$h=date("m")-1;
$n=01;
$d=mktime(0, 0, 0, $h, $n, 2015);
$datum4=date("Y-m-01", $d);
$datum5=date("Y-m-t", $d);
setcookie("dat4", $datum4, $d1);
setcookie("dat5", $datum5, $d1);
setcookie("csop", $csop, $d1);
setcookie("bo", $bo, $d1);
}
include 'cookies.php';
include 'connection.php';
include 'fejlec.php';
if($nev=='Dancsecs András'){
echo "<a href=korrekcio.txt>Korrekcio letöltés</a>(jobb gomb mentés másként:)<br><br>";
}
echo"Korrekció dátum:
<form action='backoffice.php?p=10' enctype='multipart/form-data' method='post'>
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
	  <option value='6'";if($csop==6){echo "selected";}echo ">Márfy Attila</option>
	  <option value='7'";if($csop==7){echo "selected";}echo ">Feil Ferenc</option>
	  <option value='8'";if($csop==8){echo "selected";}echo ">Mihálka István</option>
	  <option value='9'";if($csop==9){echo "selected";}echo ">Molnár Ferenc</option>
	  <option value='20'";if($csop==20){echo "selected";}echo ">Összes:alap-többlet</option>
      <option value='21'";if($csop==21){echo "selected";}echo ">Összes:alap</option>
	  <option value='22'";if($csop==22){echo "selected";}echo ">Partner:alap</option>
      <option value='23'";if($csop==23){echo "selected";}echo ">Kollegák:alap</option>
	 </select>
<input type='hidden' name='s' value='1'>
<input id='Submit' name='submit' type='submit' size='3'value='OK' /></br>
BO-nak elküdve látható:<input type=\"checkbox\" name=\"bo\" value=\"1\" "; if($bo==1){echo " checked";}echo ">
</form>";

if($csop==1)
{$csoport="(munkacsoport='Grund Lajos' or munkacsoport='Háromi Gábor' or munkacsoport='1' or munkacsoport='2' or munkacsoport='Vasi Full-táv KFT.' or munkacsoport='5') and (alap='1' or tobblet='1' or mobil='1')";}
if($csop==2)
{$csoport="(munkacsoport='Savanyó Ernõ' or munkacsoport='Márfy Attila' or munkacsoport='3' or munkacsoport='4' or munkacsoport='Vasi Full-táv KFT.' or munkacsoport='5') and (alap='1' or tobblet='1' or mobil='1')";}
if($csop==11 or $csop==13)
{$csoport="(munkacsoport='6' or munkacsoport='7' or munkacsoport='8' or munkacsoport='9' or munkacsoport='10') and (alap='1' or tobblet='1' or mobil='1')";}
if($csop==12)
{$csoport="(munkacsoport='6' or munkacsoport='7' or munkacsoport='8' or munkacsoport='9' or munkacsoport='10') and (alap='1' or tobblet='1' or mobil='1')";}
if($csop==3)
{$csoport="(munkacsoport='Háromi Gábor' or munkacsoport='1') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==4)
{$csoport="(munkacsoport='Grund Lajos' or munkacsoport='2') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==5)
{$csoport="(munkacsoport='Savanyó Ernõ' or munkacsoport='3') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==6)
{$csoport="(munkacsoport='Márfy Attila' or munkacsoport='4') and alap='0' and tobblet='0' and mobil='0' and megtarto='0'";}
if($csop==7)
{$csoport="(munkacsoport='6') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==8)
{$csoport="(munkacsoport='7') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==9)
{$csoport="(munkacsoport='8') and alap='0' and tobblet='0'  and mobil='0' and megtarto='0'";}
if($csop==20)
{$csoport="alap='1' or tobblet='1' ";}
if($csop==21)
{$csoport="alap='1' and tobblet='0' ";}
if($csop==22)
{$csoport="(munkacsoport='9' or munkacsoport='10' or munkacsoport='5') and alap='1' and tobblet='0' ";}
if($csop==23)
{$csoport="(munkacsoport='6' or munkacsoport='7' or munkacsoport='8' or munkacsoport='1' or munkacsoport='2' or munkacsoport='4') and alap='1' and tobblet='0' ";}


if($bo==1){
$boel=" bo>=0 and ";
}else{
$boel=" bo=0 and ";
}

if($csop==0)
{$csoport="(munkacsoport='1' or munkacsoport='6' or munkacsoport='7' or munkacsoport='8'  or munkacsoport='2' or munkacsoport='3' or munkacsoport='4' or munkacsoport='Vasi Full-Táv Kft.' or munkacsoport='5' or munkacsoport='9' or munkacsoport='10') and (megtarto='0')";}

echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td><a href='backoffice.php?p=10&rk=".$rk."'>Kolléga</a>  ".$nyilk."</td>
		<td>Azonosító/WF/Előfizető</td>
		<td>Termék</td>
		<td><a href='backoffice.php?p=10&rd=".$rd."'>Dátum</a>  ".$nyild."</td>
		<td><a href='backoffice.php?p=10&rs=".$rs."'>Státusz</a>  ".$nyils."</td>
		<td>Eventus/MJR</td>
		<td>Eszkaláció</td>
		<td>Kizárva</td>
		<td></td>";
if($stat==1){echo "<td>Back Office</td>";}
echo"	
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
		<td></td>";
if($stat==1){echo "<td></td>";}
echo"	</tr>";
		$sql = "SELECT * FROM adat WHERE ($csoport) and termek!='Törölve' and ".$boel." datum >='$datum4' and datum <='$datum5' and status2!='MJR-ben van' Order by $rendez";
		
		$res = mysqli_query($con, $sql);

$myfile = fopen("korrekcio.txt", "w");

fwrite($myfile, "name;azonosito;wf;efinev;termek;alap;tobblet;munkadij;eszkoz;eszkoz2;datum;status;eszkalacio;eszkalacio megjegszes;kizarva;korrekcio megjegyzes\r\n");



while($sor = mysqli_fetch_array($res)) {
$kinek="";
$nevok=0;
$m=$sor['munkacsoport'];
if($m==1 or $m==2){
$kinek=";%20biczo.eva@telekom.hu";
}
if($m==3 or $m==4){
$kinek=";%20edocs.janos@telekom.hu";
}
if($m==5) {
$kinek=";%20edocs.janos@telekom.hu;%20biczo.eva@telekom.hu";
}
if($m>=6 and $m<=20) {
$kinek=";%20pinczes.eva@telekom.hu;%20csuka.jennifer.inez@telekom.hu";
}

$a=$sor['azonosito'];
$t=$sor['termek'];
$k=$sor['kizarva'];
$i=$sor['id'];
$allapot=$sor['status'];
$br="%0D%0A";//mailto sortörés
$gomb="
<form name='input' action='note_be.php' method='post'>
<input type='text' size='100' name='note' value='" . $sor['note'] . "'>
<input type='hidden' name='id' value=" . $sor['id'] . ">
<input type=\"hidden\" name=\"honnan\" value=\"10\">
<input type='submit' value='Küldés'><br>Utolsó módosítás:".$sor['datum2']." ".$sor['kezelo']."</form>";

 $sql2="SELECT * 
		FROM  `pontkalkulator` 
		WHERE   a =  '$a' AND e =  '$t'
		OR 		c =  '$a' AND e =  '$t'
		OR 		h = '$a' AND e =  '$t'
		OR 		y =  '$a' AND e =  '$t'";
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
if($allapot!='Teljesített (Completed)'){
$sql5="UPDATE adat SET  status='Teljesített (Completed)', kezelo='Automata' WHERE  id ='$i'";

if (!mysqli_query($con,$sql5))
  {
  die('Error: ' . mysqli_error($con));
  }
  }
if($status2!='MJR-ben van'){
$sql5="UPDATE adat SET  status2='MJR-ben van', kezelo='Automata' WHERE  id ='$i'";

if (!mysqli_query($con,$sql5))
  {
  die('Error: ' . mysqli_error($con));
  }
  }

  if($k==1){

$sql5="UPDATE adat SET  kizarva='0', datum='$datumkiz' WHERE  id ='$i'";

if (!mysqli_query($con,$sql5))
  {
  die('Error: ' . mysqli_error($con));
  }
	}
}
else{

echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>" . $sor['status'] . "</td>
		<td>" . $sor['status2'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>
 <form action=\"adat2.php?p=4\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"10\">
 <input type=\"submit\" value=\"Módosít\"></form>";
 if($stat==1){
echo "</td><td>
<form action=\"backoffice.php?p=10\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type='submit' value='BO-nak küldés'>
 </form>";

 /*
 <form action=\"bo.php\" method=\"post\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"10\">
 <input type=\"submit\" value=\"BO-nak email küldve\"></form>*/
 echo "</td>";
 }
echo "<td>".$gomb."</td>";
fwrite($myfile, $sor['name'].";".$sor['azonosito'] . ";" . $sor['wf'] . ";" . $sor['efinev'] . ";" . $sor['termek'] . ";" . $sor['alap'] . ";" . $sor['tobblet'] . ";" . $sor['munkadij'] . ";" . $sor['eszkoz'] . ";" . $sor['eszkoz2'] . ";" . $sor['datum'] . ";" . $sor['status'] . ";".$sor['eszkalacio'].";".$sor['note2'].";".$sor['kizarva'].";".$sor['note']."\r\n");
$szamlalo=$szamlalo+1;
}

}
else{
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>" . $sor['status'] . "</td>
		<td>" . $sor['status2'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>
 <form action=\"adat2.php?p=10\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"10\">
 <input type=\"submit\" value=\"Módosít\">
 </form>";
 if($stat==1){
echo "</td><td>
 <form action=\"backoffice.php?p=10\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type='submit' value='BO-nak küldés'>
 </form>";
 
 
/* <form action=\"bo.php\" method=\"post\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"honnan\" value=\"2\">
 <input type=\"submit\" value=\"BO-nak email küldve\"></form>*/
 echo "</td>";
 }
echo "<td>".$gomb."</td>";
fwrite($myfile, $sor['name'].";".$sor['azonosito'] . ";" . $sor['wf'] . ";" . $sor['efinev'] . ";" . $sor['termek'] . ";" . $sor['alap'] . ";" . $sor['tobblet'] . ";" . $sor['munkadij'] . ";" . $sor['eszkoz'] . ";" . $sor['eszkoz2'] . ";" . $sor['datum'] . ";" . $sor['status'] . ";".$sor['eszkalacio'].";".$sor['note2'].";".$sor['kizarva'].";".$sor['note']."\r\n");
$szamlalo=$szamlalo+1;
}
echo"</tr>";
}
fclose($myfile);
echo $szamlalo." adat szerepel a listában!";
echo "</table> 
	</body> 
	</html>";
?>