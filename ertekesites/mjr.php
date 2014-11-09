<?php
$idi=$sp=$_COOKIE['idi'];
include 'cookies.php';
include 'connection.php';
include 'fejlec.php';

echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Hónap</td>
		<td>Munkairáyító</td>
		<td>Név</td>
		<td>Mennyiség[Ft]</td>
		<td>Minőség[%]</td>
		<td>Értékesítés[%]</td>
		<td>Kifizethető[Ft]</td>
		<td>100% értékesítés</br>Kifizethető[Ft]</td>
		<td>Különbség[Ft]</td>
		<td>Maximális értékesítés</br>Kifizethető[Ft]</td>
		<td>Különbség[Ft]</td>
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
	</tr>";
		//adatok lekérdezése
if($idi==0){
$sql = "SELECT * FROM mjr WHERE nev='$nev' Order by honap asc";}
if($idi==1){
$sql = "SELECT * FROM mjr WHERE munkairanyito='$nev' Order by nev asc, honap asc";}
if($nev=='Dancsecs András'){
$sql = "SELECT * FROM mjr WHERE 1 Order by munkairanyito asc, nev asc, honap asc";}
	
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
echo	"
	<tr>
		<td>" . $sor['honap'] . "</td>
		<td>" . $sor['munkairanyito'] . "</td>
		<td>" . $sor['nev'] . "</td>
		<td>" . $sor['mennyiseg'] . "</td>
		<td>" . $sor['minoseg'] . "</td>
		<td>" . $sor['ertekesites'] . "</td>
		<td>" . $sor['kifizetheto'] . "</td>
		<td>" . intval($sor['mennyiseg']*$sor['minoseg']/100) . "</td>
		<td>" . intval((($sor['mennyiseg']*$sor['minoseg']/100)-$sor['kifizetheto'])) . "</td>
		<td>" . intval($sor['mennyiseg']*$sor['minoseg']/10000*($sor['max'])) . "</td>
		<td>" . intval((($sor['mennyiseg']*$sor['minoseg']/10000*$sor['max'])-$sor['kifizetheto'])) . "</td>
	</tr>";}
	
echo "</table>";
?>