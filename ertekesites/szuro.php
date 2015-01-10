<?php
include 'fejlec.php';

$datum1=$_COOKIE[dat2];
$datum2=$_COOKIE[dat3];

$sz10=$_COOKIE['sz10'];
$sz11=$_COOKIE['sz11'];
$sz1=$_COOKIE['sz1'];
$sz2=$_COOKIE['sz2'];
$sz3=$_COOKIE['sz3'];
$sz4=$_COOKIE['sz4'];
$sz5=$_COOKIE['sz5'];
$sz6=$_COOKIE['sz6'];
$ren=intval($_COOKIE['r']);

$rendez="id asc";

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
setcookie('r', 1,time() + (60*60*24 * 3650));
$nyilk=$nyildown;
$rs=1;$rd=1;
$rk=2;
$rendez="name asc";
}
if($ren==2)
{
setcookie('r', 2,time() + (60*60*24 * 3650));
$nyilk=$nyilup;
$rs=1;$rd=1;
$rk=1;
$rendez="name desc";
}

if($ren==3)
{
setcookie('r', 3,time() + (60*60*24 * 3650));
$nyils=$nyildown;
$rk=1;$rd=1;
$rs=2;
$rendez="status asc";
}
if($ren==4)
{
setcookie('r', 4,time() + (60*60*24 * 3650));
$nyils=$nyilup;
$rk=1;$rd=1;
$rs=1;
$rendez="status desc";
}

if($ren==5)
{
setcookie('r', 5,time() + (60*60*24 * 3650));
$nyild=$nyildown;
$rs=1;$rk=1;
$rd=2;
$rendez="datum asc";
}
if($ren==6)
{
setcookie('r', 6,time() + (60*60*24 * 3650));
$nyild=$nyilup;
$rs=1;$rk=1;
$rd=1;
$rendez="datum desc";
}

if($_POST[z]==1){
$datum1=$_POST[dat11];
$datum2=$_POST[dat12];
}
if($_POST[sz]==1){
setcookie('sz10', intval($_POST[mobil]),time() + (60*60*24 * 3650));
setcookie('sz11', intval($_POST[megtarto]),time() + (60*60*24 * 3650));
setcookie('sz1', intval($_POST[alap]),time() + (60*60*24 * 3650));
setcookie('sz2', intval($_POST[tobblet]),time() + (60*60*24 * 3650));
setcookie('sz3', intval($_POST[munkadij]),time() + (60*60*24 * 3650));
setcookie('sz4', intval($_POST[eszkoz]),time() + (60*60*24 * 3650));
setcookie('sz5', intval($_POST[eszkalacio]),time() + (60*60*24 * 3650));
setcookie('sz6', $_POST[name],time() + (60*60*24 * 3650));
$sz10=$_POST[mobil];
$sz11=$_POST[megtarto];
$sz1=$_POST[alap];
$sz2=$_POST[tobblet];
$sz3=$_POST[munkadij];
$sz4=$_POST[eszkoz];
$sz5=$_POST[eszkalacio];
$sz6=$_POST[name];
}

$i="
<input type='hidden' name='z' value='1'>
<INPUT type='text' name='dat11' size='12' value='".$datum1."'>
<INPUT type='text' name='dat12' size='12' value='".$datum2."'>";
include 'szur.php';

echo "
 <table border=0><tr><td><form action='adat2.php?p=1' method='post'>
 <input type=\"hidden\" name=\"honnan\" value=\"1\">
 <input type=\"submit\" value=\"Új adat felvitele\">
 </form></td>";
 echo"
 <td><form action=\"csvment2.php\" method=\"post\">
 <INPUT type='hidden' name='dat11' value='".$datum1."'>
<INPUT type='hidden' name='dat12' value='".$datum2."'>
 <input type=\"submit\" value=\"Adatok mentése(CSV)\">
 </form></td></tr></table>";

$csmo="mobil = '10'";
$csme="megtarto = '10'";
$csa="alap = '10'";
$cst="tobblet = '10'";
$csm="munkadij = '1'";
$cse="(eszkoz ='1' or eszkoz2 = '1')";
$cseszk="eszkalacio='0' or eszkalacio='1'";

if($sz11==1)
{$csme="megtarto = '1'";}
if($sz10==1)
{$csmo="mobil = '1'";}
if($sz1==1)
{$csa="alap = '1'";}
if($sz2==1)
{$cst="tobblet = '1'";}
if($sz3==1)
{$csm="munkadij >= '1'";}
if($sz4==1)
{$cse="(eszkoz >='1' or eszkoz2 >= '1')";}
$mitol=$_POST["dat11"];
$meddig=$_POST["dat12"];

if($sz6=="LHO"){
$sql100 = "SELECT * FROM adat WHERE ($csme or $csmo or $csa or $cst or $csm or $cse) and datum >='$datum1' and datum <='$datum2' Order by $rendez";
if($sz5==1){
$sql100 = "SELECT * FROM adat WHERE eszkalacio='1' and datum >='$datum1' and datum <='$datum2' Order by $rendez";
}
}else{
$sql100 = "SELECT * FROM adat WHERE ($csme or $csmo or $csa or $cst or $csm or $cse) and name='$sz6' and  datum >='$datum1' and datum <='$datum2' Order by $rendez";
if($sz5==1){
$sql100 = "SELECT * FROM adat WHERE eszkalacio='1' and name='$sz6' and  datum >='$datum1' and datum <='$datum2' Order by $rendez";
}
}

/*echo"
<form action=\"csvment.php\" method=\"post\">
 <input type=\"submit\" value=\"CSV mentés\">
</form>";*/
$res100 = mysqli_query($con, $sql100);


echo "<table border='1' bordercolor=\"#FFCC00\">
<tr>
		<td><a href='szuro.php?p=1&rk=".$rk."'>Kolléga</a>  ".$nyilk."</td>
		<td>Azonosítók/WF/Előfizető</td>
		<td>Termék</td>
		<td>Mobil új postpaid SIM</td>
		<td>Vezetékes új BB és TV</td>
		<td>Mobil postpaid SIM és fix <br> TV, BB, hang megtartás</td>
		<td>Non-Core szolgáltatás</td>
		<td colspan=2>Tartozék és munkadíj</td>
		<td>Eszköz értékesítés</td>
		<td><a href='szuro.php?p=1&rd=".$rd."'>Dátum</a>  ".$nyild."</td>
		<td>Eventus/MJR</td>
		<td><a href='szuro.php?p=1&rs=".$rs."'>Státusz</a>  ".$nyils."</td>
		<td>Eszkaláció</td>
		<td>Kizárva</td>
<td></td>
</tr>
";
while($sor100 = mysqli_fetch_array($res100)) {
echo"
<tr>
		<td>" . $sor100['name'] . "</td>
		<td>" . $sor100['azonosito'] . "<br>" . $sor['wf'] . "<br>" . $sor['efinev'] . "</td>
		<td>" . $sor100['termek'] . "</td>
		<td>" . $sor100['mobil'] . "</td>
		<td>" . $sor100['alap'] . "</td>
		<td>" . $sor100['megtarto'] . "</td>
		<td>" . $sor100['tobblet'] . "</td>
		<td>" . $sor100['munkadij'] . "</td>
		<td>" . $sor100['eszkoz'] . "</td>
		<td>" . $sor100['eszkoz2'] . "</td>
		<td>" . $sor100['datum'] . "</td>
		<td>" . $sor100['status2'] . "</td>
		<td>" . $sor100['status'] . "</td>
		<td><input type='checkbox'disabled=\"disabled\""; if($sor['eszkalacio']==1){echo " checked='checked'";}echo "disabled=\"disabled\"><br>".$sor['note2']."</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor['kizarva']==1){echo " checked='checked'";}echo "></td>
		<td>
 <form action=\"adat2.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
  <input type=\"hidden\" name=\"honnan\" value=\"3\">
 <input type=\"hidden\" name=\"id\" value=" . $sor100['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td></tr>
";
}

echo"
</table>";


?>