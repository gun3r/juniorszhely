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
$cseszk="eszkalacio='0' or eszkalacio='1'";

if($_POST[alap]==1)
{$csa="alap = '1'";}
if($_POST[tobblet]==1)
{$cst="tobblet = '1'";}
if($_POST[munkadij]==1)
{$csm="munkadij >= '1'";}
if($_POST[eszkoz]==1)
{$cse="(eszkoz >='1' or eszkoz2 >= '1')";}
if($_POST[eszkalacio]==1)
{$cseszk="eszkalacio='1'";}
$mitol=$_POST["dat11"];
$meddig=$_POST["dat12"];

if($_POST[name]=="LHO"){
$sql100 = "SELECT * FROM adat WHERE ($csa or $cst or $csm or $cse) and datum >='$datum1' and datum <='$datum2' Order by termek asc";
if($_POST[eszkalacio]==1){
$sql100 = "SELECT * FROM adat WHERE eszkalacio='1' and datum >='$datum1' and datum <='$datum2' Order by termek asc";
}
}else{
$sql100 = "SELECT * FROM adat WHERE ($csa or $cst or $csm or $cse) and name='$_POST[name]' and  datum >='$datum1' and datum <='$datum2' Order by termek asc";
if($_POST[eszkalacio]==1){
$sql100 = "SELECT * FROM adat WHERE eszkalacio='1' and name='$_POST[name]' and  datum >='$datum1' and datum <='$datum2' Order by termek asc";
}
}

/*echo"
<form action=\"csvment.php\" method=\"post\">
 <input type=\"submit\" value=\"CSV mentés\">
</form>";*/
$res100 = mysqli_query($con, $sql100);
echo "<table border='1' bordercolor=\"#FFCC00\">
<tr>
<td colspan='13' style='text-align: center'>".$_POST[name]."</td>
</tr>
<tr>
<td>Kolléga</td>
<td>Azonosító/WF/Előfizető</td>
<td>Termék</td>
<td>Alap</td>
<td>Többlet</td>
<td>Munkadíj</td>
<td>Kis értékű portfólió</td>
<td>Nagy értékű portfólió</td>
<td>Dátum </td>
<td>Státusz</td>
<td>Eszkaláció</td>
<td>Kizárva</td>
<td></td>
</tr>
";
while($sor100 = mysqli_fetch_array($res100)) {
echo"
<tr>
		<td>" . $sor100['name'] . "</td>
		<td>" . $sor100['azonosito'] . "<br>" . $sor100['wf'] . "<br>" . $sor100['efinev'] . "</td>
		<td>" . $sor100['termek'] . "</td>
		<td>" . $sor100['alap'] . "</td>
		<td>" . $sor100['tobblet'] . "</td>
		<td>" . $sor100['munkadij'] . "</td>
		<td>" . $sor100['eszkoz'] . "</td>
		<td>" . $sor100['eszkoz2'] . "</td>
		<td>" . $sor100['datum'] . "</td>
		<td>" . $sor100['status'] . "</td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor100['eszkalacio']==1){echo " checked='checked'";}echo "></td>
		<td><input type='checkbox' disabled=\"disabled\""; if($sor100['kizarva']==1){echo " checked='checked'";}echo "></td>
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


?>