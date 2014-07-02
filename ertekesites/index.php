<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="refresh" CONTENT="60">
  <link type="image/x-icon" rel="icon" href="favicon.ico">
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
<title>Szombathely LHO</title>
</head>
<body>
<?php
//$datum=date("Y-m-01");
include 'connection.php';
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
$d=mktime(0, 0, 0, $h, $n+1, 2014);
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
$deltat = ((strtotime($datum3)-strtotime($datum2))/60/60/24+1)/$maxnap;
include_once("analyticstracking.php");
echo "<table style='border:0px; width:100%'>
<tr><td style='width:390'>";
include 'fejlec.php';
echo"
<FORM name=\"input\" action=\"kuki.php\" method=\"post\">
<INPUT type=\"text\" name=\"dat2\" size='12' value=\"".$datum2."\">
<INPUT type=\"text\" name=\"dat3\" size='12' value=\"".$datum3."\">
<INPUT type=\"submit\" value=\"Elküld\">
</FORM></td>";

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
$csop=1;
include 'tabla.php';
 
echo"</td>

<td style='width:20'>
</td>
<td style='vertical-align:top'>";

//sopron
$csop=2;
include 'tabla.php';

echo "</td>
</tr>

<tr><td style='heigth:10px'></td></tr>
<tr>
<td style='vertical-align:top'>";
//szombathely_se
$csop=3;
include 'tabla.php';
echo "
</td>

<td style='width:20'>
</td>
<td style='vertical-align:top'>";
//szombathely_ma
$csop=4;
include 'tabla.php';
echo "</td>
</tr>
<tr>
<td style='heigth:10px'> </td>
</tr>
<tr><td>";

$csop=5;
include 'vallalkozo.php';

echo "</td></tr>
</table>
</html>";
?>