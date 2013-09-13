<html>
<body bgcolor="#D8D8D8">
<?php
include 'kuki.php';
include 'connection.php';
$jog = intval($_COOKIE["sp_codej"]);
$sp_code = strval($_COOKIE["sp_code"]);
if($jog==2){

$sql = "SELECT * FROM  `data` WHERE  `closed` =  '0'";
$sql2 = "SELECT * FROM  `data` WHERE  `closed` =  '1'";

$res = mysqli_query($con, $sql);
$res2 = mysqli_query($con, $sql2);

echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz</th>
<th>Régi eszköz típusa</th>
<th>Új eszköz</th>
<th>Új eszköz típusa</th>
<th>Név</th>
<th>Dátum</th>
</tr>";
while($sor = mysqli_fetch_array($res)) {

 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['sp_code'] . "</td>";
 echo "<td>" . $sor['date'] . "</td>";
 echo "<td>
 <form action=\"mod.php\" method=\"post\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"OK\">
 </form> </td>";
 echo "</tr>"; 

}
echo "</table>";
echo "</br></br>";
echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz</th>
<th>Régi eszköz típusa</th>
<th>Új eszköz</th>
<th>Új eszköz típusa</th>
<th>Név</th>
<th>Dátum</th>
</tr>";

while($sor = mysqli_fetch_array($res2)) {

 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['sp_code'] . "</td>";
 echo "<td>" . $sor['date'] . "</td>";
 echo "</tr>"; 

}
echo "</table>";
}
else{

$sql = "SELECT * FROM  `data`,'eszkoz_nev' WHERE  `sp_code` =  '$sp_code' AND 'data.eszkoz1' = 'eszkoz_nev.id'";

$res = mysqli_query($con, $sql);

echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz</th>
<th>Régi eszköz típusa</th>
<th>Új eszköz</th>
<th>Új eszköz típusa</th>
<th>Név</th>
<th>Dátum</th>
</tr>";
while($sor = mysqli_fetch_array($res)) {

 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['sp_code'] . "</td>";
 echo "<td>" . $sor['date'] . "</td>";
 echo "</tr>"; 

}

echo "</table>";
}
mysqli_close($con);
?>

</body>
</html>
