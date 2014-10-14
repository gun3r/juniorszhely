<?php

echo" Szűrés:";
echo"<form action=\"szuro.php?p=1\" method=\"post\">
<table>
<tr>
<td><select name=\"name\" size=\”1\”>
	<option value=\"LHO\" selected>-=Régió=-</option>";
	
$sql = "SELECT name FROM user WHERE munkacsoport<=99 and kilepett>='$datum2' Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\""; if($sor[name]==$_POST[name]){echo "selected";} echo ">  " . $sor['name'] . "</option>\n";
}	
		
echo " 	</select></td>
<td><input type='checkbox' name='alap' value='1'";if($_POST[alap]==1){echo "checked";}echo ">Alap</td>
<td><input type='checkbox' name='tobblet' value='1'";if($_POST[tobblet]==1){echo "checked";}echo ">Többlet</td>
".$i."
<td><input type='checkbox' name='munkadij' value='1'";if($_POST[munkadij]==1){echo "checked";}echo ">Munkadíj</td>
<td><input type='checkbox' name='eszkoz' value='1'";if($_POST[eszkoz]==1){echo "checked";}echo ">Eszkoz</td>
<td><input type='submit' value='Szűrés'></td>
<tr>
</table>
</form>";
?>