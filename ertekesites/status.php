<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include 'fejlec.php';?>
Új státusz felvétele:</br>
<form action="status_mod.php" method="post">
Statusz neve: <input type="text" name="status">
<input type="submit">
</form>
Státusz Lista:</br>
<table border=1>
<tr>
<td>Név</td>
<td></td>
<td></td>

</tr>
<tr>
<?php
include 'connection.php';
$sql = "SELECT * FROM status 
WHERE 1 order by status asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<form action='status_mod.php' enctype='multipart/form-data' method='post'>
<tr>
<td><INPUT type='text' name='status' size='65' value='".$sor['status']."'></td>
<input type='hidden' name='id' value='".$sor['id']."'>
<input type='hidden' name='mod' value='1'>
<td><input id='Submit' name='submit' type='submit' value='Módosít' /></form></td>
<td>

<form action='status_mod.php' enctype='multipart/form-data' method='post'>
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
