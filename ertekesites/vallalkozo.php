<?php
 $oa=0;
 $ot=0;
 $om=0;
 $oe=0;
 $oe2=0;
  
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=$csop order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th style='width:280'>Név</th>
<th style='width:80'>Alap szolgáltatás
</th>
<th>Többlet szolgáltatás
</th>
<th>Munkadíj; SZSZSZK munkadíj
</th>
<th>Kis értékű <br> portfóliós eszközök
</th>
<th>Nagy értékű <br> portfóliós eszközök
</th></tr>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
}
}
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM elvaras
WHERE name='LHO' and
ev >='$datum2' and ev <='$datum3'";
$res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
 $lhoa=$sor2['a'];
 $lhot=$sor2['t'];
 $lhom=$sor2['m'];
 $lhoe=$sor2['e']+$sor2['e2'];
 
 
}
echo "
<tr>
<td>Kollégák:</td>
<td style='text-align: right'>".number_format($koa, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($kot, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($kom, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($koe, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($koe2, 0, '.', ' ')."</td>
</tr><tr>
<td>Vasi Full-TÁV KFT.:</td>
<td style='text-align: right'>".number_format($oa, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($ot, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($om, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($oe2, 0, '.', ' ')."</td>
</tr>";
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=9 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];

echo"<td>Mészáros és Társa Elektronikai Kft.:</td>
<td style='text-align: right'>".number_format($sor2['a'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['t'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['m'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['e'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['e2'], 0, '.', ' ')."</td>
</tr>";
 
}
}


$sql = "SELECT name FROM `user` 
WHERE munkacsoport=10 order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 echo"
<td>Kanizsatel Kft.:</td>
<td style='text-align: right'>".number_format($sor2['a'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['t'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['m'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['e'], 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($sor2['e2'], 0, '.', ' ')."</td>
</tr>";
}
}


echo"
<tr>
<td>Nyugat-Magyarország Régió:</td>";
 
 $color='FF3333';
 $nevezo=$lhoa*$deltat;
 $szamlalo=$oa+$koa;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($oa+$koa),0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=$lhot*$deltat;
 $szamlalo=$ot+$kot;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($ot+$kot), 0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=$lhom*$deltat;
 $szamlalo=$om+$kom;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($om+$kom),0, '.', ' ')."</td>";
 
 $color='FF3333';
 $nevezo=$lhoe*$deltat;
 $szamlalo=$oe+$koe+$oe2+$koe2;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "<td colspan='2' style='background-color:".$color."; text-align: center'>".number_format($oe+$koe+$oe2+$koe2, 0, '.', ' ')."</td>
</tr>
<tr>
<td>Régió elvárás:</td>
<td style='text-align: right'>".number_format($lhoa*$deltat, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($lhot*$deltat, 0, '.', ' ')."</td>
<td style='text-align: right'>".number_format($lhom*$deltat, 0, '.', ' ')."</td>
<td colspan='2' style='text-align: center'>".number_format($lhoe*$deltat, 0, '.', ' ')."</td>
</tr>
<tr>
<td>Teljesült:</td>";
 
 $color='FF3333';
 $nevezo=$lhoa*$deltat;
 $szamlalo=$oa+$koa;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($oa+$koa)/($lhoa*$deltat)*100, 2, '.', ' ')." %"."</td>";
 
 $color='FF3333';
 $nevezo=$lhot*$deltat;
 $szamlalo=$ot+$kot;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($ot+$kot)/($lhot*$deltat)*100, 2, '.', ' ')." %"."</td>";
 
 $color='FF3333';
 $nevezo=$lhom*$deltat;
 $szamlalo=$om+$kom;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td style='background-color:".$color."; text-align: right'>".number_format(($om+$kom)/($lhom*$deltat)*100, 2, '.', ' ')." %"."</td>";
 
 $color='FF3333';
 $nevezo=$lhoe*$deltat;
 $szamlalo=$oe+$koe+$oe2+$koe2;
 
 if ($nevezo=='0'){
 $color=grey;
 }else{
 if(($szamlalo/$nevezo)*'100'>='90'){
 $color=yellow;} 
 if($szamlalo >= $nevezo){
 $color='66C266';}
 }
 echo "
<td colspan='2' style='background-color:".$color."; text-align: center'>".number_format(($oe+$koe+$oe2+$koe2)/($lhoe*$deltat)*100, 2, '.', ' ')." %"."</td>
</tr>
</table>";
?>