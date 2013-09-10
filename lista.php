<?php
include 'connection.php';

$sql = "SELECT * FROM data";


$res = mysqli_query($con, $sql);

echo "<table border='1'>
<tr>
<th>A szám</th>
<th>Régi eszköz</th>
<th>Új eszköz</th>
<th>Név</th>
<th>Dátum</th>
</tr>";
while($sor = mysqli_fetch_array($res)) {

if($sor['closed']==0){
 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 echo "<td>" . $sor['sp_code'] . "</td>";
 echo "<td>" . $sor['date'] . "</td>";
 echo "<td> Lezár </td>";
 echo "</tr>"; 
}
}
echo "</table>";
  
mysqli_close($con);
?>
