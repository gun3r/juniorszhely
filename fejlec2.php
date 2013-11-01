<html>

<?php
header('Content-Type: text/html; charset=utf-8');
include 'connection.php';
$sp_code = strval($_COOKIE["sp_code"]);
$sql = "SELECT * FROM  `members` ";
//$con=mysqli_connect("localhost","junior","junior","eszkoz");
//mysqli_query("SET CHARACTER SET 'utf8'");

$res = mysqli_query($con, $sql);
//mysqli_set_charset('utf8', $res);


while($sor = mysqli_fetch_array($res)) {
if($sp_code == $sor['sp_code']){
 
 echo "<br>" . $sor['name'] . "</br>";
 
 }

}




//név kiírás
//echo "<form method=\"post\" action=\"eszkozcsere.php\"><input type=\"submit\" value=\"Eszközcsere\" name=\"submit\"/></form>";
//echo "<form method=\"post\" action=\"lista.php\"><input type=\"submit\" value=\"Lista\" name=\"submit\"/></form>";
echo "<h4><a href=/eszkozcsere.php>Eszközcsere</a>";
echo "  ";
echo "<a href=/lista.php>Lista</a>";
echo "  ";
echo "<a href=/kilep.php>Kilépés</a>  <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belépett felhasználó:</a> " . $sp_code . "</h4>";


?>
</html>