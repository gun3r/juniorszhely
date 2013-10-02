<?php
include 'kuki.php';
include 'connection.php';
include_once("analyticstracking.php");

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
echo "	  A szám: </td><td> <input type=\"text\" name=\"a_szam\" />\n"; 
echo "	</td>\n";
echo "	</td>";
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "	<td>\n"; 
echo "	  Régi eszköz gyári szám: </td><td> <input type=\"text\" name=\"serial1\" />\n"; 
echo "	</td>\n"; 
echo "  <td> <select name=\"nev1\" size=\”1\”>\n";
echo "  <option value=\" \" selected>Válasz a listából</option>\n";

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
echo "	  Új eszköz gyári szám:  </td><td><input type=\"text\" name=\"serial2\">\n"; 
echo "	</td>\n";
echo "  <td> <select name=\"nev2\" size=\”1\”>\n";
echo "  <option value=\" \" selected>Válasz a listából</option>\n";

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
echo "	  <input type=\"submit\" value=\"Adatok elküldése\" name=\"submit\" />	  \n"; 
echo "	</td>\n"; 
echo "	</tr>\n"; 
echo "	  \n"; 
echo "</form>\n"; 
echo "\n"; 

echo "<br/>";

//echo "<img src=\"http://szupersz.dyndns.tv/images/adsl_pirelli_v1.jpg\" />";
echo "</body>\n"; 
echo "</html>\n";

?>
