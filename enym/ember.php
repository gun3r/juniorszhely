<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php include 'fejlec.php';?>
Új ember felvétele:</br>
<form action="insert.php" method="post">
Evetus kód: <input type="text" name="eventus">
Név: <input type="text" name="name">
Munkacsoport: <select name="munkacsoport" size=”1”>
      <option value="1" selected>Székesfehérvár1</option>
      <option value="2">Székesfehérvár2</option>
      <option value="3">Tatabánya1</option>
	  <option value="4">Tatabánya2</option>
	  <option value="5">Győr1</option>
	  <option value="6">Győr2</option>
	  <option value="7">Modul Informatika kft.</option>
	  <option value="8">KOMTEL kft.</option>
	  <option value="100"> </option>
	 </select>
<input type="submit">
</form></br></br>
Kollégák:</br>
<table border=1>
<tr>
<td>Név</td>
<td>Eventus</td>
<td>Munkacsoport</td>
<td>Munkairányító</td>
<td>Adat kezelő</td>
<td></td>
<td></td>
<td></td>

</tr>
<tr>
<?php
include 'connection.php';
$sql = "SELECT * FROM `user` 
WHERE 1 order by munkacsoport asc, iranyito desc, name asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<form action='insert.php' enctype='multipart/form-data' method='post'>
<tr>
<td><INPUT type='text' name='name'value='".$sor['name']."'></td>
<td><INPUT type='text' name='eventus' size='10' value='".$sor['eventus']."'></td>
<td><select name='munkacsoport' size=”1”>
      <option value='1'";if($sor['munkacsoport']==1){echo "selected";}echo ">Székesfehérvár1</option>
      <option value='2'";if($sor['munkacsoport']==2){echo "selected";}echo ">Székesfehérvár2</option>
      <option value='3'";if($sor['munkacsoport']==3){echo "selected";}echo ">Tatabánya1</option>
	  <option value='4'";if($sor['munkacsoport']==4){echo "selected";}echo ">Tatabánya2</option>
	  <option value='5'";if($sor['munkacsoport']==5){echo "selected";}echo ">Győr1</option>
	  <option value='6'";if($sor['munkacsoport']==6){echo "selected";}echo ">Győr2</option>
	  <option value='7'";if($sor['munkacsoport']==7){echo "selected";}echo ">Modul Informatika kft.</option>
	  <option value='8'";if($sor['munkacsoport']==8){echo "selected";}echo ">KOMTEL kft.</option>
	  <option value='100'";if($sor['munkacsoport']==100){echo "selected";}echo "> </option>
	 </select></td>
<td><input type='checkbox' name='iranyito' value='1'"; if($sor['iranyito']==1){echo " checked";}echo "></td>
<td><input type='checkbox' name='belep' value='1'"; if($sor['belep']==1){echo " checked";}echo "></td>
<input type='hidden' name='id' value='".$sor['id']."'>
<input type='hidden' name='mod' value='1'>
<td><input id='Submit' name='submit' type='submit' value='Módosít' /></form></td>
<td>

<form action='insert.php' enctype='multipart/form-data' method='post'>
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
