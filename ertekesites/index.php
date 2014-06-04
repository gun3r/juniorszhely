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

//$datum=date("Y-m-01");

$datum2=date("Y-m-01");
$datum3=date("Y-m-d");

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

include 'connection.php';
include_once("analyticstracking.php");
echo "<table border=0 width=100%>
<tr><td width=360>";
include 'fejlec.php';
echo"
<FORM name=\"input\" action=\"kuki.php\" method=\"post\">
<INPUT type=\"text\" name=\"dat2\" value=\"".$datum2."\">
<INPUT type=\"text\" name=\"dat3\" value=\"".$datum3."\">
<INPUT type=\"submit\" value=\"Elküld\">
</FORM>";
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
$meret=$sor4['meret'];
 }
echo "
<td bgcolor=".$bgcolor.">
<marquee scrollamount=8><font color=".$color." size=".$meret.">".$szoveg."</font><marquee>
</td>
</tr>
</table>";
?>

<table>
<tr>
<td valign=top>
<?php
//tapolca
$csop=1;
include 'tabla.php';
 
echo"</td>

<th width=20>
</th>
<td valign=top>";

//sopron
$csop=2;
include 'tabla.php';

echo "</td>
</tr>

<tr><td height=10 ></td></tr>
<tr>
<td valign=top>";
//szombathely_se
$csop=3;
include 'tabla.php';
echo "
</td>

<th width=20>
</th>
<td valign=top>";
//szombathely_ma
$csop=4;
include 'tabla.php';
echo "</td>
</table>
</html>";
?>