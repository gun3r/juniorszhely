<?php
 $oa=0;
 $ot=0;
 $om=0;
 $oe=0;
 $oe2=0;
 
 $ea=0;
 $et=0;
 $em=0;
 $ee=0;
 $ee2=0;
 
 $osszes=0;
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=$csop order by munkacsoport asc, iranyito desc, name asc
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
<th>Eszköz (portfóliós)
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
	AND ev = '$datum'
	LIMIT 0 , 1";
	$res3 = mysqli_query($con, $sql3);
  $row_cnt = intval(mysqli_num_rows($res3));
if($row_cnt==0){
echo " 
 <td>".intval($sor2['a'])."</td>
 <td>".intval($sor2['t'])."</td>
 <td>".intval($sor2['m'])."</td>
 <td>".intval($sor2['e'])."</td>
 <td>".intval($sor2['e2'])."</td>";
}

 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
 while($sor3 = mysqli_fetch_array($res3)) {
 if($sor3[aktiv]=='Aktív'){
 $osszes=$osszes+1;
 }
 
 $ea=$ea+$sor3['alap'];
 $et=$et+$sor3['tobblet'];
 $em=$em+$sor3['munkadij'];
 $ee=$ee+$sor3['eszkoz'];
 $ee2=$ee2+$sor3['eszkoz2'];
 
 $color=red;
 $nevezo=floatval($sor3['alap'])*$deltat;
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
 $nevezo=floatval($sor3['tobblet'])*$deltat;
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
 $nevezo=floatval($sor3['munkadij'])*$deltat;
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color=green;}
 }
 echo "<td bgcolor=".$color."> " . intval($sor2['m']) ."</td>";
 
 $color=red;
 $nevezo=floatval($sor3['eszkoz'])*$deltat;
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

echo "
<tr>
<td>Összesen:</td>
<td>".number_format($oa, 0, '.', ' ')."</td>
<td>".number_format($ot, 0, '.', ' ')."</td>
<td>".number_format($om, 0, '.', ' ')."</td>
<td>".number_format($oe, 0, '.', ' ')."</td>
<td>".number_format($oe2, 0, '.', ' ')."</td>
</tr>

<tr>
<td>1 főre jutó teljesítés:</td>
<td>".number_format($oa/$osszes, 1, '.', ' ')."</td>
<td>".number_format($ot/$osszes, 1, '.', ' ')."</td>
<td>".number_format($om/$osszes, 0, '.', ' ')."</td>
<td>".number_format($oe/$osszes, 0, '.', ' ')."</td>
<td>".number_format($oe2/$osszes, 0, '.', ' ')."</td>
</tr>

<tr>
<td>1 főre jutó elvárás:</td>
<td>".number_format($ea/$osszes*$deltat, 1, '.', ' ')."</td>
<td>".number_format($et/$osszes*$deltat, 1, '.', ' ')."</td>
<td>".number_format($em/$osszes*$deltat, 0, '.', ' ')."</td>
<td>".number_format($ee/$osszes*$deltat, 0, '.', ' ')."</td>
<td>".number_format($ee2/$osszes*$deltat, 0, '.', ' ')."</td>
</tr>

<tr>
<td>Teljesült?</td>";
if(($oa/$osszes)>=($ea/$osszes*$deltat)){echo"<td bgcolor=green>Igen</td>";}else{echo"<td bgcolor=red>Nem</td>";}echo "</td>";
if(($ot/$osszes)>=($et/$osszes*$deltat)){echo"<td bgcolor=green>Igen</td>";}else{echo"<td bgcolor=red>Nem</td>";}echo "</td>";
if(($om/$osszes)>=($em/$osszes*$deltat)){echo"<td bgcolor=green>Igen</td>";}else{echo"<td bgcolor=red>Nem</td>";}echo "</td>";
if(($oe/$osszes)>=($ee/$osszes*$deltat)){echo"<td bgcolor=green>Igen</td>";}else{echo"<td bgcolor=red>Nem</td>";}echo "</td>";
if(($oe2/$osszes)>=($ee2/$osszes*$deltat)){echo"<td bgcolor=green>Igen</td>";}else{echo"<td bgcolor=red>Nem</td>";}echo "</td>
</tr>


</tr>
</table>";
?>