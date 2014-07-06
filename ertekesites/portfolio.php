<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php include 'fejlec.php';?>
Új portfóliós termék felvétele:</br>
<form action="portfolio_mod.php" method="post">
Termék neve: <input type="text" name="nev">
Összeg: <input type="text" name="osszeg">
<input type="submit">
</form></br></br>
Portfóliós Lista:</br>
<table border=1>
<tr>
<td>Név</td>
<td>Összeg</td>
<td></td>
<td></td>

</tr>
<tr>
<?php
include 'connection.php';
$sql = "SELECT * FROM portfolio 
WHERE 1 order by nev asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<form action='portfolio_mod.php' enctype='multipart/form-data' method='post'>
<tr>
<td><INPUT type='text' name='nev' size='80' value='".$sor['nev']."'></td>
<td><INPUT type='text' name='osszeg' size='10' value='".$sor['osszeg']."'></td>
<input type='hidden' name='id' value='".$sor['id']."'>
<input type='hidden' name='mod' value='1'>
<td><input id='Submit' name='submit' type='submit' value='Módosít' /></form></td>
<td>

<form action='portfolio_mod.php' enctype='multipart/form-data' method='post'>
<input type='hidden' name='id' value='".$sor['id']."'>
<input type='hidden' name='mod' value='2'></td>
<td>
<input id='Submit' name='submit' allign='center' type='submit' value='Töröl' />
</form>
</td>
</tr>
</form>";
}
mysqli_close();
?>
</tr>
</table>
</body>
</html>
