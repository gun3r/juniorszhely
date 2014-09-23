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
<th style='width:280'>Név</th>
<th style='width:80'>Telekom
</th>
<th>Többlet szolgáltatás
</th>
<th>Munkadíj; SZSZSZK munkadíj
</th>
<th>Kis értékű <br> portfóliós eszközök
</th>
<th>Nagy értékű <br> portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
echo "<tr>";
 echo "<td>" . $sor['name'] ."</td>";
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
termek !='Törölve' and
datum >='$datum2' and datum <='$datum3'";


 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  

  $sql3 = 
	"SELECT SUM( alap ) as alap, SUM( tobblet ) as tobblet, SUM( munkadij ) as munkadij, SUM( eszkoz ) as eszkoz, SUM( eszkoz2 ) as eszkoz2, SUM(IF(aktiv = 'Aktív',1,0)) as aktiv
	FROM  `elvaras` 
	WHERE name LIKE  \"%$nev%\"
	AND ev >='$datum2' and ev <='$datum3'";
	$res3 = mysqli_query($con, $sql3);
  $row_cnt = intval(mysqli_num_rows($res3));
if($row_cnt==0){
echo " 
 <td style='text-align: right'>".intval($sor2['a'])."</td>
 <td style='text-align: right'>".intval($sor2['t'])."</td>
 <td style='text-align: right'>".intval($sor2['m'])."</td>
 <td style='text-align: right'>".intval($sor2['e'])."</td>
 <td style='text-align: right'>".intval($sor2['e2'])."</td>";
}

 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
 while($sor3 = mysqli_fetch_array($res3)) {
 $osszes=$osszes+$sor3['aktiv'];
 
 
 $ea=$ea+$sor3['alap'];
 $et=$et+$sor3['tobblet'];
 $em=$em+$sor3['munkadij'];
 $ee=$ee+$sor3['eszkoz'];
 $ee2=$ee2+$sor3['eszkoz2'];
 
 $color='FF3333';
 $nevezo=floatval($sor3['alap'])*$deltat;
 $szamlalo=floatval($sor2['a']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "<td style='background-color:".$color."; text-align: right'>" .number_format(intval($sor2['a']), 0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=floatval($sor3['tobblet'])*$deltat;
 $szamlalo=floatval($sor2['t']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "<td style='background-color:".$color."; text-align: right'>" .number_format(intval($sor2['t']), 0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=floatval($sor3['munkadij'])*$deltat;
 $szamlalo=floatval($sor2['m']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "<td style='background-color:".$color."; text-align: right'> " .number_format(intval($sor2['m']), 0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=floatval($sor3['eszkoz'])*$deltat;
 $szamlalo=floatval($sor2['e']);
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "<td style='background-color:".$color."; text-align: right'>" .number_format(intval($sor2['e']), 0, '.', ' ')."</td>";
 $color=grey;
 echo "<td style='background-color:".$color."; text-align: right'>" .number_format(intval($sor2['e2']), 0, '.', ' ')."</td></tr>";
}

}
}
$osszes=$osszes/$i;
echo "
<tr>
<td>Összesen:</td>
<td style='text-align: right'>".number_format($oa, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($ot, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($om, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe2, 0, '.', ' ')."</td>
</tr>

<tr>
<td>1 főre jutó teljesítés:</td>
<td style='text-align: right'>".number_format($oa/$osszes, 1, '.', ' ')."</td>
<td style='text-align: right'>".number_format($ot/$osszes, 1, '.', ' ')."</td>
<td style='text-align: right'>".number_format($om/$osszes, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe/$osszes, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe2/$osszes, 0, '.', ' ')."</td>
</tr>

<tr>
<td>1 főre jutó elvárás:</td>
<td style='text-align: right'>".number_format($ea/$osszes*$deltat, 1, '.', ' ')."</td>
<td style='text-align: right'>".number_format($et/$osszes*$deltat, 1, '.', ' ')."</td>
<td style='text-align: right'>".number_format($em/$osszes*$deltat, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($ee/$osszes*$deltat, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($ee2/$osszes*$deltat, 0, '.', ' ')."</td>
</tr>

<tr>
<td>Teljesült?</td>";
if(($oa/$osszes)>=($ea/$osszes*$deltat)){echo"<td style='background-color:66C266'>Igen</td>";}else{echo"<td style='background-color:FF3333'>Nem</td>";};
if(($ot/$osszes)>=($et/$osszes*$deltat)){echo"<td style='background-color:66C266'>Igen</td>";}else{echo"<td style='background-color:FF3333'>Nem</td>";};
if(($om/$osszes)>=($em/$osszes*$deltat)){echo"<td style='background-color:66C266'>Igen</td>";}else{echo"<td style='background-color:FF3333'>Nem</td>";};
if(($oe/$osszes)>=($ee/$osszes*$deltat)){echo"<td style='background-color:66C266'>Igen</td>";}else{echo"<td style='background-color:FF3333'>Nem</td>";};
if(($oe2/$osszes)>=($ee2/$osszes*$deltat)){echo"<td style='background-color:66C266'>Igen</td>";}else{echo"<td style='background-color:FF3333'>Nem</td>";}
echo "
</tr>
</table>";
 $koa=$koa+$oa;
 $kot=$kot+$ot;
 $kom=$kom+$om;
 $koe=$koe+$oe;
 $koe2=$koe2+$oe2;
?>