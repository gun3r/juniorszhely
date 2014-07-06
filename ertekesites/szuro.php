<?php
include 'fejlec.php';
include 'szur.php';
//echo "$_POST[name] - ";
$mit=$_POST[mit];

if($mit==0)
{$csoport="1";}
if($mit==1)
{$csoport="alap = '1'";}
if($mit==2)
{$csoport="tobblet = '1'";}
if($mit==3)
{$csoport="munkadij >= '1'";}
if($mit==4)
{$csoport="(eszkoz >='1' or eszkoz2 >= '1')";}
$mitol=$_COOKIE["dat2"];
$meddig=$_COOKIE["dat3"];
$sql100 = "SELECT * FROM adat WHERE name='$_POST[name]' and $csoport and datum >='$mitol' and datum <='$meddig' Order by id";

$res100 = mysqli_query($con, $sql100);
echo "<table border='1' bordercolor=\"#FFCC00\">
<tr>
<td colspan='9' style='text-align: center'>".$_POST[name]."</td>
</tr>
<tr>
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
";
while($sor100 = mysqli_fetch_array($res100)) {
echo"
<tr>
		<td>" . $sor100['azonosito'] . "</td>
		<td>" . $sor100['termek'] . "</td>
		<td>" . $sor100['alap'] . "</td>
		<td>" . $sor100['tobblet'] . "</td>
		<td>" . $sor100['munkadij'] . "</td>
		<td>" . $sor100['eszkoz'] . "</td>
		<td>" . $sor100['eszkoz2'] . "</td>
		<td>" . $sor100['datum'] . "</td>
		<td>
 <form action=\"adat.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor100['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>
";
}
echo"
</tr>
</table>";
?>