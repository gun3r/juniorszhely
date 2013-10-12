<?php
include 'kuki.php';
include 'connection.php';
include_once("analyticstracking.php");

$mod=$_POST[mod];

if($mod==1){

$sql = "SELECT * FROM  `data` WHERE  `id` =  '$_POST[id]'";
$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

$a_szam=$sor['a_szam'];
$eszkoz1=$sor['eszkoz1'];
$serial1=$sor['serial1'];
$eszkoz2=$sor['eszkoz2'];
$serial2=$sor['serial2'];
$e1=$eszkoz1;
$e2=$eszkoz2;
}
}else{
$e1="";
$e2="";
$eszkoz1="Válasz a listából";
$eszkoz2="Válasz a listából";
$a_szam="";
$serial1="";
$serial2="";
$mod=0;
}
echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n"; 
echo "<title>MT Eszközcsere</title>\n"; 
echo "</head>\n"; 
echo "<body bgcolor=\"#D8D8D8\">\n"; 
include 'fejlec.php';
echo "<h1>Eszközcsere</h1>\n"; 
echo "\n"; 
echo "<p></p>\n"; 
echo "<form action=\"eszkoz_be.php\" method=\"post\">\n"; 
echo "	<table border=8>\n"; 
echo "	<tr>\n"; 
echo "	<td>\n"; 
echo "	  A szám: </td><td> <input type=\"text\" name=\"a_szam\" value=\"" . $a_szam . "\"/>\n"; 
echo "	</td>\n";
echo "	</td>";
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "	<td>\n"; 
echo "	  Régi eszköz gyári szám: </td><td> <input type=\"text\" name=\"serial1\" value=\"" . $serial1 . "\"/>\n"; 
echo "	</td>\n"; 
echo "  <td> <select name=\"nev1\" size=\”1\”>\n";
echo "  <option value=\"" . $e1 ."\" selected>" . $eszkoz1 ."</option>\n";

$sql = "select nev from eszkoz_nev order by nev asc";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['nev'] . "\">  " . $sor['nev'] . "</option>\n";
}
echo "  </select>";
echo "	</td>\n"; 
echo "	</tr>\n";
echo "	<tr>\n";
echo "	<td>\n"; 
echo "	  Új eszköz gyári szám:  </td><td><input type=\"text\" name=\"serial2\" value=\"" . $serial2 . "\">\n"; 
echo "	</td>\n";
echo "  <td> <select name=\"nev2\" size=\”1\”>\n";
echo "  <option value=\"" . $e2 ."\" selected>" . $eszkoz2 ."</option>\n";

$sql2 = "select nev from eszkoz_nev order by nev asc";

$res2 = mysqli_query($con, $sql2);

while($sor = mysqli_fetch_array($res2)) {

echo "  <option value=\"" . $sor['nev'] . "\">  " . $sor['nev'] . "</option>\n";
}
echo "  </select>";
echo "  </td>";
echo "	</tr>\n"; 
echo "	</table>\n"; 
echo "	<tr>\n"; 
echo "	<td> \n"; 
echo "  <input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">";
echo "  <input type=\"hidden\" name=\"id\" value=\"". $_POST[id]. "\">";
echo "	<input type=\"submit\" value=\"Adatok elküldése\" name=\"submit\" />	  \n"; 
echo "	</td>\n"; 
echo "	</tr>\n"; 
echo "	  \n"; 
echo "</form>\n"; 
echo "\n"; 


//echo "<img src=\"http://szupersz.dyndns.tv/images/adsl_pirelli_v1.jpg\" />";
include 'lablec.php';
echo "</body>\n"; 
echo "</html>\n";
?>
