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
      <option value="1" selected>Tapolca</option>
      <option value="2">Sopron</option>
      <option value="3">Szombathely_SE</option>
	  <option value="4">Szombathely_MA</option>
	  <option value="6">Kaposvár</option>
	  <option value="7">Zalaegerszeg_MI</option>
	  <option value="8">Zalaegerszeg_MF</option>
	  <option value="5">Vasi Full-TÁV KFT.</option>
	  <option value="9">Mészáros és Társa Elektronikai Kft.</option>
	  <option value="10">Kanizsatel Kft.</option>
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
<td>Verseny</td>
<td>Belépés dátuma</td>
<td>Kilépés dátuma</td>
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
      <option value='1'";if($sor['munkacsoport']==1){echo "selected";}echo ">Tapolca</option>
      <option value='2'";if($sor['munkacsoport']==2){echo "selected";}echo ">Sopron</option>
      <option value='3'";if($sor['munkacsoport']==3){echo "selected";}echo ">Szombathely_SE</option>
	  <option value='4'";if($sor['munkacsoport']==4){echo "selected";}echo ">Szombathely_MA</option>
	  <option value='5'";if($sor['munkacsoport']==5){echo "selected";}echo ">Vasi Full-TÁV KFT.</option>
	  <option value='6'";if($sor['munkacsoport']==6){echo "selected";}echo ">Kaposvár</option>
	  <option value='7'";if($sor['munkacsoport']==7){echo "selected";}echo ">Zalaegerszeg_MI</option>
	  <option value='8'";if($sor['munkacsoport']==8){echo "selected";}echo ">Zalaegerszeg_MF</option>
	  <option value='9'";if($sor['munkacsoport']==9){echo "selected";}echo ">Mészáros és Társa Elektronikai Kft.</option>
	  <option value='10'";if($sor['munkacsoport']==10){echo "selected";}echo ">Kanizsatel Kft.</option>
	  <option value='100'";if($sor['munkacsoport']==100){echo "selected";}echo "> </option>
	 </select></td>
<td><input type='checkbox' name='iranyito' value='1'"; if($sor['iranyito']==1){echo " checked";}echo "></td>
<td><input type='checkbox' name='belep' value='1'"; if($sor['belep']==1){echo " checked";}echo "></td>
<td><input type='checkbox' name='tippmix' value='1'"; if($sor['tippmix']==1){echo " checked";}echo "></td>
<td><INPUT type='text' name='belepett' value='".$sor['belepett']."'></td>
<td><input type='text' name='kilepett' value='";if($sor['kilepett']!='2020-12-30' and $sor['kilepett']!='0000-00-00'){echo $sor['kilepett'];} echo"'></td>
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
