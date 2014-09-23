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
$csa="";
$cst="";
$csm="";
$cse="";

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
$sql100 = "SELECT * FROM adat WHERE $csa and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}else{
$sql100 = "SELECT * FROM adat WHERE name='$_POST[name]' and $csa and datum >='$datum1' and datum <='$datum2' Order by id";
}

$res100 = mysqli_query($con, $sql100);
echo "<table border='1' bordercolor=\"#FFCC00\">
<tr>
<td colspan='10' style='text-align: center'>".$_POST[name]."</td>
</tr>
<tr>
<td>Kolléga</td>
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
		<td>" . $sor100['name'] . "</td>
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
if($_POST[name]=="LHO"){
$sql100 = "SELECT * FROM adat WHERE $cst and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}else{
$sql100 = "SELECT * FROM adat WHERE name='$_POST[name]' and $cst and datum >='$datum1' and datum <='$datum2' Order by id";
}
$res100 = mysqli_query($con, $sql100);
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
		<td>
 <form action=\"adat.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor100['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>
";
}
if($_POST[name]=="LHO"){
$sql100 = "SELECT * FROM adat WHERE $csm and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}else{
$sql100 = "SELECT * FROM adat WHERE name='$_POST[name]' and $csm and datum >='$datum1' and datum <='$datum2' Order by id";
}
$res100 = mysqli_query($con, $sql100);
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
		<td>
 <form action=\"adat.php?p=1\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor100['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>
";
}
if($_POST[name]=="LHO"){
$sql100 = "SELECT * FROM adat WHERE $cse and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}else{
$sql100 = "SELECT * FROM adat WHERE name='$_POST[name]' and $cse and datum >='$datum1' and datum <='$datum2' Order by id";
}
$res100 = mysqli_query($con, $sql100);
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