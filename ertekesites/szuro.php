<?php
include 'fejlec.php';

$datum1=$_COOKIE[dat2];
$datum2=$_COOKIE[dat3];

if($_POST[z]==1){
$datum1=$_POST[dat11];
$datum2=$_POST[dat12];
}

$i="
<input type='hidden' name='z' value='1'>
<INPUT type='text' name='dat11' size='12' value='".$datum1."'>
<INPUT type='text' name='dat12' size='12' value='".$datum2."'>";
include 'szur.php';
//echo "$_POST[name] - ";
$csa="alap = '10'";
$cst="tobblet = '10'";
$csm="munkadij = '1'";
$cse="(eszkoz ='1' or eszkoz2 = '1')";

if($_POST[alap]==1)
{$csa="alap = '1'";}
if($_POST[tobblet]==1)
{$cst="tobblet = '1'";}
if($_POST[munkadij]==1)
{$csm="munkadij >= '1'";}
if($_POST[eszkoz]==1)
{$cse="(eszkoz >='1' or eszkoz2 >= '1')";}
$mitol=$_POST["dat11"];
$meddig=$_POST["dat12"];

if($_POST[name]=="LHO"){
$sql100 = "SELECT * FROM adat WHERE ($csa or $cst or $csm or $cse) and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}else{
$sql100 = "SELECT * FROM adat WHERE ($csa or $cst or $csm or $cse) and name='$_POST[name]' and  datum >='$datum1' and datum <='$datum2' Order by termek asc";
}
/*echo"
<form action=\"csvment.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"$sql100\">
 <input type=\"submit\" value=\"CSV mentés\">
</form>";*/
$res100 = mysqli_query($con, $sql100);
echo "<table border='1' bordercolor=\"#FFCC00\">
<tr>
<td colspan='10' style='text-align: center'>".$_POST[name]."</td>
</tr>
<tr>
<td>Kolléga</td>
<td>Azonosító</td>
<td>Termék</td>
<td>Alap</td>
<td>Többlet</td>
<td>Munkadíj</td>
<td>Eszköz portfóliós</td>
<td>Eszköz nem portfóliós</td>
<td>Dátum </td>
<td>Kizárva</td>
<td></td>
</tr>
";
while($sor100 = mysqli_fetch_array($res100)) {
echo"
<tr>
		<td>" . $sor100['name'] . "</td>
		<td>" . $sor100['azonosito'] . "</td>
		<td>" . $sor100['termek'] . "</td>
		<td>" . $sor100['alap'] . "</td>
		<td>" . $sor100['tobblet'] . "</td>
		<td>" . $sor100['munkadij'] . "</td>
		<td>" . $sor100['eszkoz'] . "</td>
		<td>" . $sor100['eszkoz2'] . "</td>
		<td>" . $sor100['datum'] . "</td>
		<td><input type='checkbox'"; if($sor100['kizarva']==1){echo " checked";}echo "></td>
		<td>
 <form action=\"adat2.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
  <input type=\"hidden\" name=\"honnan\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor100['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td></tr>
";
}

echo"
</table>";


include 'csvment.php';


?>