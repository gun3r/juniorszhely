<?php
include 'connection.php';
$mod=1;
$ev=date("2015-m-01");


echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>MT Értékesítés Elvárás</title>\n"; 
echo "</head>\n"; 
echo "<body bgcolor=\"#D8D8D8\">\n";

echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Aktív</td>
		<td>Név</td>
		<td>Alap</td>
		<td>Többlet</td>
		<td>Munkadíj</td>
		<td>Eszköz portfóliós</td>
		<td>Eszköz nem portfóliós</td>
		<td>Hónap</td>
		<td></td>
	</tr>";

$sql = "SELECT *, elvaras.id as ide FROM elvaras
		INNER JOIN user
		ON elvaras.name=user.name
		ORDER by elvaras.ev desc, user.iranyito asc, user.munkacsoport asc, elvaras.name asc";
		
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {


echo "	
		<form action=\"elvaras_be.php\" method=\"post\">
	<tr>
		<td><select name=\"aktiv\" size=\1”>
      <option value=\"".$sor['aktiv']."\" selected>".$sor['aktiv']."</option>
	  <option value=\"Aktív\">Aktív</option>
	  <option value=\"Beteg\">Beteg</option>
	  <option value=\"Kilépő\">Kilépő</option> </td>
		<td>".$sor['name']."</td>
		<td><input type=\"text\" name=\"alap\" value=\"".$sor['alap']."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"tobblet\" value=\"".$sor['tobblet']."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"munkadij\" value=\"".$sor['munkadij']." \"size=\"6\"></td>
		<td><input type=\"text\" name=\"eszkoz1\" value=\"".$sor['eszkoz']."\"></td>
		<td><input type=\"text\" name=\"eszkoz2\" value=\"".$sor['eszkoz2']."\"></td>
		<td>". $sor['ev'] ."</td>
		<td>
		<input type=\"hidden\" name=\"name\" value=\"".$sor['name']."\">
		<input type=\"hidden\" name=\"ev\" value=\"". $sor['ev'] ."\">
		<input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">
		<input type=\"hidden\" name=\"id\" value=\"".  $sor['ide']. "\">
		<input type=\"submit\"></form></td>
	</tr></form>";
	}
echo"</table>
	</body> 
	</html>";
?>