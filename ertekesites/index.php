<!DOCTYPE html>
<html lang="hu">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="refresh" CONTENT="60">
  <link type="image/x-icon" rel="icon" href="favicon.ico" />
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
<title>Eredmények</title>
</head>
<body>
<?php
include_once("analyticstracking.php");
include 'fejlec.php';

//$datum=date("Y-m-01");

$datum2=date("Y-m-01");
$datum3=date("Y-m-t");

if (isset($_COOKIE["dat2"]))
{
$datum2=$_COOKIE["dat2"];
$datum3=$_COOKIE["dat3"];
} else {
setcookie("dat2", $datum2, time()+360000);
setcookie("dat3", $datum3, time()+360000);
}

$datum=$datum2;
$maxnap=date(t);
$deltat = ((strtotime($datum3)-strtotime($datum2))/60/60/24+1)/$maxnap;
//echo $deltat;
echo"
<FORM name=\"input\" action=\"kuki.php\" method=\"post\">
<INPUT type=\"text\" name=\"dat2\" value=\"".$datum2."\">
<INPUT type=\"text\" name=\"dat3\" value=\"".$datum3."\">
<INPUT type=\"submit\" value=\"Elküld\">
</FORM>
";

?>
<table>
<tr>
<td valign=top>
<?php
include 'connection.php';
//tapolca
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
 while($sor3 = mysqli_fetch_array($res3)) {
 if($sor3[aktiv]=='Aktív'){
 $osszes=$osszes+1;
 }
 
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
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


</tr>
</table>
</td>

<th width=20>
</th>
<td valign=top>";

//sopron

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
 while($sor3 = mysqli_fetch_array($res3)) {
 if($sor3[aktiv]=='Aktív'){
 $osszes=$osszes+1;
 }
 
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
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
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
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

</tr>
</table>
</td>
</tr>

<tr>
<td valign=top>";
//szombathely_se
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
 while($sor3 = mysqli_fetch_array($res3)) {
 
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
 if($sor3[aktiv]=='Aktív'){
 $osszes=$osszes+1;
 }
 
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
 $ea=$ea+$sor3['alap'];
 $et=$et+$sor3['tobblet'];
 $em=$em+$sor3['munkadij'];
 $ee=$ee+$sor3['eszkoz'];
 $ee2=$ee2+$sor3['eszkoz2'];
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
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
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

}}
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
</tr>
</table>
</td>

<th width=20>
</th>
<td valign=top>";
//szombathely_ma
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
 while($sor3 = mysqli_fetch_array($res3)) {
 if($sor3[aktiv]=='Aktív'){
 $osszes=$osszes+1;
 }
 
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
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
 echo "<td bgcolor=".$color.">" . intval($sor2['m']) ."</td>";
 
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
</tr>
</table>
</td>
</table>";
$bgcolor="white";
$color="black";
$szoveg="";
$meret=32;

$sql4 = 
	"SELECT * 
	FROM  `uzenet`
	order by id desc
	LIMIT 0 , 1";
	$res4 = mysqli_query($con, $sql4);
 
 while($sor4 = mysqli_fetch_array($res4)) {
 $bgcolor=$sor4['colorh'];
$color=$sor4['colorsz'];
$szoveg=$sor4['szoveg'];
$meret=$sor4['meret'];
 }
echo "
<table width=100%>
<tr>
<td bgcolor=".$bgcolor.">
<marquee scrollamount=8><font color=".$color." size=".$meret.">".$szoveg."</font><marquee>
</td>
</tr>
</table>

</html>
";
?>