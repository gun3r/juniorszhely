<?php
echo" Szűrés:";
echo"<form action=\"szuro.php?p=1\" method=\"post\">
<table>
<tr>
<td><select name=\"name\" size=\”1\”>
	<option value=\"".$namev."\" selected>".$name."</option>";
	
$sql = "SELECT name FROM user WHERE munkacsoport<=99 Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\""; if($sor[name]==$_POST[name]){echo "selected";} echo ">  " . $sor['name'] . "</option>\n";
}	
		
echo " 	</select></td>
<td><input type='radio' name='mit' value='1'>Alap</td>
<td><input type='radio' name='mit' value='2'>Többlet</td>
<td><input type='radio' name='mit' value='3'>Munkadíj</td>
<td><input type='radio' name='mit' value='4'>Eszkoz</td>
<td><input type='submit' value='Szűrés'></td>
<tr>
</table>
</form>";
?>