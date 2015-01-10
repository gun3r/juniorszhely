<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="refresh" CONTENT="60">
  <link type="image/x-icon" rel="icon" href="favicon.ico">
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
<title>Nyugat-Magyarország Régió</title>
</head>
<body>
<?php
//$datum=date("Y-m-01");
include 'connection.php';
 $nezet=$_COOKIE["nezet"];
 $datum2=date("Y-m-01");
 $datum3=date("Y-m-d");
 $koa=0;
 $kot=0;
 $kom=0;
 $koe=0;
 $koe2=0;
 
if (isset($_COOKIE["dat2"]))
{
$datum2=$_COOKIE["dat2"];
$datum3=$_COOKIE["dat3"];
} else {
$h=date("m");
$n=date("d");
$d=mktime(0, 0, 0, $h, $n+1, 2015);
setcookie("dat2", $datum2, $d);
setcookie("dat3", $datum3, $d);
}
$datum=$datum2;


$sql5 = "SELECT maxnap as max FROM `honap` WHERE honap >='$datum2' and honap <='$datum3'";
$res5 = mysqli_query($con, $sql5);
$i=0;
while($sor5 = mysqli_fetch_array($res5)) {
$maxnap=$maxnap+$sor5['max'];

$i++;
}
$deltat = (intval((strtotime($datum3)-strtotime($datum2))/60/60/24+1))/$maxnap;
//echo $deltat;
include_once("analyticstracking.php");
echo "<table style='border:0px; width:100%'>
<tr><td style='width:390'>";
include 'fejlec.php';
echo"
<FORM name=\"input\" action=\"kuki.php\" method=\"post\">
<INPUT type=\"text\" name=\"dat2\" size='12' value=\"".$datum2."\">
<INPUT type=\"text\" name=\"dat3\" size='12' value=\"".$datum3."\">
<INPUT type=\"submit\" value=\"Elküld\">
</FORM>";

if($datum2>=2014-10-01 and $nezet==0){
echo"Nézet:
<FORM name=\"input\" action=\"nezetbeallit.php\" method=\"post\">
<select name='n' size=”1”>
	  <option value='1'";if($nezet==1){echo "selected";}echo ">Háromi Gábor</option>
	  <option value='2'";if($nezet==2){echo "selected";}echo ">Grund Lajos</option>
	  <option value='4'";if($nezet==4){echo "selected";}echo ">Márfy Attila</option>
	  <option value='6'";if($nezet==6){echo "selected";}echo ">Feil Ferenc</option>
	  <option value='7'";if($nezet==7){echo "selected";}echo ">Mihálka István</option>
	  <option value='8'";if($nezet==8){echo "selected";}echo ">Molnár Ferenc</option>
	 </select>
<INPUT type=\"submit\" value=\"Beállít\">
</FORM>";
}
echo "</td>";
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
$meret=intval($sor4['meret'])*6;
 }
echo "
<td style='background-color:".$bgcolor.";color:".$color.";font-size:".$meret."px;'>
<marquee>".$szoveg."</marquee>
</td>
</tr>
</table>";
?>
<table style='width:100%'>
<tr>
<td style='vertical-align:top'>
<?php
//tapolca
$csop=$nezet;
if($nezet==0){
$csop=1;
}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}
echo"</td>

</tr><tr>
<td style='vertical-align:top'>";

//sopron
$csop=2;
if($nezet==2){
$csop=1;
}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}

echo "</td>
</tr>


<tr>
<td style='vertical-align:top'>";
//szombathely_se
if($datum2>='2014-10-01')
{$csop=4;
if($nezet==4){
$csop=1;
}}else{$csop=3;}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}
echo "
</td>

</tr><tr>
<td style='vertical-align:top'>";
//szombathely_ma
if($datum2>='2014-10-01')
{$csop=8;
if($nezet==8){
$csop=1;
}}else{$csop=4;}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}
echo "</td>
</tr>";
if($datum3>='2014-10-01'){
echo"

<tr>
<td style='vertical-align:top'>";
//kaposvár
if($datum2>='2014-10-01')
{$csop=7;
if($nezet==7){
$csop=1;
}}else{$csop=6;}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}
echo "
</td>

</tr><tr>
<td style='vertical-align:top'>";
//Zalaegerszeg_MF
if($datum2>='2014-10-01')
{$csop=6;
if($nezet==6){
$csop=1;
}}else{$csop=7;}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}
echo "</td>
</tr>
<tr>
<td style='vertical-align:top'>";
//Zalaegerszeg_MI
if($datum2>='2014-10-01')
{}
else{$csop=8;
if($nezet==8){
$csop=1;}
if ($datum2<'2015-01-01'){
include 'tabla.php';
}else{
include 'tabla2.php';
}}

echo "
</td>

</tr><tr>
<td style='vertical-align:top'>";
//
$csop=7;
//include 'tabla.php';
echo "</td>
</tr>
";
}
echo"
<tr><td>";

$csop=5;
if ($datum2<'2015-01-01'){
include 'vallalkozo.php';
}else{
include 'vallalkozo2.php';
}

echo "</td></tr>
</table>";
if($datum2>=2014-10-01 and $nezet!=0){
echo "<br><br><br><br>Nézet:
<FORM name=\"input\" action=\"nezetbeallit.php\" method=\"post\">
<select name='n' size=”1”>
	  <option value='1'";if($nezet==1){echo "selected";}echo ">Háromi Gábor</option>
	  <option value='2'";if($nezet==2){echo "selected";}echo ">Grund Lajos</option>
	  <option value='4'";if($nezet==4){echo "selected";}echo ">Márfy Attila</option>
	  <option value='6'";if($nezet==6){echo "selected";}echo ">Feil Ferenc</option>
	  <option value='7'";if($nezet==7){echo "selected";}echo ">Mihálka István</option>
	  <option value='8'";if($nezet==8){echo "selected";}echo ">Molnár Ferenc</option>
	 </select>
<INPUT type=\"submit\" value=\"Beállít\">
</FORM>";
}
echo"
</html>";
mysqli_close($con);
?>