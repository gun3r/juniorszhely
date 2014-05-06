<html>
<?php include 'fejlec.php';?>
<table>
<tr>
<th valign=top>
<?php
include 'connection.php';
$datum=date("Y-m-01");
$datum2=date("Y-m-01");
$datum3=date("Y-m-t");
//tapolca
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=1 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th width=280>Név</th>
<th width=80>T-HOME; T-MOBIL
</th>
<th>SZSZSZK kártya; VOD bérlet; minicsomag; felvétel opció
</th>
<th>Munkadíj; SZSZSZK munkadíj bruttó 8.000 Ft felett
</th>
<th>Eszközértékesítés (portfóliós)
</th>
<th>TV; táblagép és egyéb portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
echo "<tr>";
 echo "<td>" . $sor['name'] ."</td>";
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
datum >='$datum2' and datum <='$datum3'";


 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
  $sql3 = 
	"SELECT *
	FROM  `elvaras` 
	WHERE name LIKE  \"%$nev%\"
	AND ev = '$datum'";
	$res3 = mysqli_query($con, $sql3);
 
 while($sor3 = mysqli_fetch_array($res3)) {
 
 $color=red;
 $nevezo=floatval($sor3['alap']);
 $szamlalo=floatval($sor2['a']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['a']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['tobblet']);
 $szamlalo=floatval($sor2['t']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['t']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['munkadij']);
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['eszkoz']);
 $szamlalo=floatval($sor2['e']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['e']) ."</td>";
 echo "<td bgcolor=grey>" . intval($sor2['e2']) ."</td></tr>";

}
}
}

echo "</tr>
</table>
</td>

<th width=20>
</th>
<th valign=top>";

//sopron
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=2 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th width=280>Név</th>
<th width=80>T-HOME; T-MOBIL
</th>
<th>SZSZSZK kártya; VOD bérlet; minicsomag; felvétel opció
</th>
<th>Munkadíj; SZSZSZK munkadíj bruttó 8.000 Ft felett
</th>
<th>Eszközértékesítés (portfóliós)
</th>
<th>TV; táblagép és egyéb portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
echo "<tr>";
 echo "<td>" . $sor['name'] ."</td>";
 $sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name LIKE \"%$nev%\"
and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {  
  $sql3 = 
	"SELECT *
	FROM  `elvaras` 
	WHERE name LIKE  \"%$nev%\"
	AND ev = '$datum'";
	$res3 = mysqli_query($con, $sql3);
 
 while($sor3 = mysqli_fetch_array($res3)) {
 
 $color=red;
 $nevezo=floatval($sor3['alap']);
 $szamlalo=floatval($sor2['a']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['a']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['tobblet']);
 $szamlalo=floatval($sor2['t']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['t']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['munkadij']);
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['eszkoz']);
 $szamlalo=floatval($sor2['e']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['e']) ."</td>";
 echo "<td bgcolor=grey>" . intval($sor2['e2']) ."</td></tr>";

}
}
}
echo "</tr>
</table>
</th>
</tr>

<tr>
<th valign=top>";
//szombathely_se
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=3 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th width=280>Név</th>
<th width=80>T-HOME; T-MOBIL
</th>
<th>SZSZSZK kártya; VOD bérlet; minicsomag; felvétel opció
</th>
<th>Munkadíj; SZSZSZK munkadíj bruttó 8.000 Ft felett
</th>
<th>Eszközértékesítés (portfóliós)
</th>
<th>TV; táblagép és egyéb portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
echo "<tr>";
 echo "<td>" . $sor['name'] ."</td>";
 $sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name LIKE \"%$nev%\"and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {  
  $sql3 = 
	"SELECT *
	FROM  `elvaras` 
	WHERE name LIKE  \"%$nev%\"
	AND ev = '$datum'";
	$res3 = mysqli_query($con, $sql3);
 
 while($sor3 = mysqli_fetch_array($res3)) {
 
 $color=red;
 $nevezo=floatval($sor3['alap']);
 $szamlalo=floatval($sor2['a']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['a']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['tobblet']);
 $szamlalo=floatval($sor2['t']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['t']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['munkadij']);
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['eszkoz']);
 $szamlalo=floatval($sor2['e']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['e']) ."</td>";
 echo "<td bgcolor=grey>" . intval($sor2['e2']) ."</td></tr>";

}}
}
echo "</tr>
</table>
</td>

<th width=20>
</th>
<th valign=top>";
//szombathely_ma
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=4 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th width=280>Név</th>
<th width=80>T-HOME; T-MOBIL
</th>
<th>SZSZSZK kártya; VOD bérlet; minicsomag; felvétel opció
</th>
<th>Munkadíj; SZSZSZK munkadíj bruttó 8.000 Ft felett
</th>
<th>Eszközértékesítés (portfóliós)
</th>
<th>TV; táblagép és egyéb portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
echo "<tr>";
 echo "<td>" . $sor['name'] ."</td>";
 $sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name LIKE \"%$nev%\"and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {  
  $sql3 = 
	"SELECT *
	FROM  `elvaras` 
	WHERE name LIKE  \"%$nev%\"
	AND ev = '$datum'";
	$res3 = mysqli_query($con, $sql3);
 
 while($sor3 = mysqli_fetch_array($res3)) {
 
 $color=red;
 $nevezo=floatval($sor3['alap']);
 $szamlalo=floatval($sor2['a']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['a']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['tobblet']);
 $szamlalo=floatval($sor2['t']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['t']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['munkadij']);
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['eszkoz']);
 $szamlalo=floatval($sor2['e']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color.">" . intval($sor2['e']) ."</td>";
 echo "<td bgcolor=grey>" . intval($sor2['e2']) ."</td></tr>";

}
}
}
echo "</tr>
</table>
</th>";

?>
</table>
</html>
