<?php
include 'kuki.php';
include 'connection.php';
include_once("analyticstracking.php");
?>
<html lang="hu"> 
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8"> 
<title>MT Eszközcsere</title>
</head>
<body bgcolor="#D8D8D8">
<?php>
include 'fejlec.php';
?>
<h1>Keresés</h1>

<form action="keres.php" method="post">
Keresés: <input type="text" name="keres">
itt: <select name="mit" size=”1”>
      <option value="1" selected>A szám</option>
      <option value="2">Eszközszám</option>
     </select>
<input type="hidden" name="search" value="1">
<input type="submit">
</form>
<?php
$keres=$_POST[keres];
$mit=intval($_POST[mit]);
$search=intval($_POST[search]);
if($search==1){

if($mit==1){
$sql="SELECT * FROM  `data` WHERE `a_szam` = \"$keres\" ";
}else{
$sql="SELECT * FROM  `data` WHERE `serial1` = \"$keres\" or `serial2`= \"$keres\" ";
}

$res = mysqli_query($con, $sql);
$row_cnt = intval(mysqli_num_rows($res));
if($row_cnt == 0)
{
	echo "Nincs találat!";
	}else{

echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz típusa</th>
<th>Régi eszköz</th>
<th>Új eszköz típusa</th>
<th>Új eszköz</th>
<th>Név</th>
<th>Dátum</th>
</tr>";
while($sor = mysqli_fetch_array($res)) {
 
 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
  
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 
 echo "<td>" . $sor['sp_code'] . "</td>";
 
 echo "<td>" . $sor['date'] . "</td>";
 echo "</tr>"; 

}
echo "</table>";
}
}
include 'lablec.php';
?>
</body>
</html>