<?php
echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>Elvárás</title>\n"; 
echo "</head>\n"; 
echo "<body>\n";
include 'cookies.php';
include 'fejlec.php';
if($nev=='Dancsecs András'){
include 'feltolt.html';
}
include 'connection.php';
$mod=1;
$ev=date("2014-m-01");
$idi=$sp=$_COOKIE['idi'];


echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Aktív</td>
		<td>Név</td>
		<td>Mobil</td>
		<td>Otthoni</td>
		<td>Megtartó</td>
		<td>Többlet</td>
		<td colspan=2>Munkadíj,Eszköz portfóliós</td>
		<td>Eszköz nem portfóliós</td>
		<td>Hónap</td>
		<td></td>
	</tr>";

if($idi==0){
$sql = "SELECT * FROM elvaras
		WHERE name='$nev'
		ORDER by ev desc";

}else{
$sql = "SELECT *, elvaras.id as ide FROM elvaras
		INNER JOIN user
		ON elvaras.name=user.name
		ORDER by elvaras.ev desc, user.iranyito asc, user.munkacsoport asc, elvaras.name asc";
		}
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

/*elvaras_be*/
if($idi==0){

echo "
	<tr>
		<td>".$sor['aktiv']."</td>
		<td>".$sor['name']."</td>
		<td>".$sor['mobil']."</td>
		<td>".$sor['alap']."</td>
		<td>".$sor['megtarto']."</td>
		<td>".$sor['tobblet']."</td>
		<td>".$sor['munkadij']."</td>
		<td>".$sor['eszkoz']."</td>
		<td>".$sor['eszkoz2']."</td>
		<td>". $sor['ev'] ."</td>
		<td></td>
	</tr>";

}else{
echo "	
		<form action=\"elvaras_be.php\" method=\"post\">
	<tr>
		<td><select name=\"aktiv\" size=\1”>
	  <option value=\"Aktív\"";if($sor['aktiv']==' '){echo "selected";}echo "> </option>
      <option value=\"Aktív\"";if($sor['aktiv']=='Aktív'){echo "selected";}echo ">Aktív</option>
	  <option value=\"Beteg\"";if($sor['aktiv']=='Beteg'){echo "selected";}echo ">Beteg</option>
	  <option value=\"Kilépő\"";if($sor['aktiv']=='Kilépő'){echo "selected";}echo ">Kilépő</option> </td>
		<td>".$sor['name']."</td>
		<td><input type=\"text\" name=\"mobil\" value=\"".$sor['mobil']."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"alap\" value=\"".$sor['alap']."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"megtarto\" value=\"".$sor['megtarto']."\"size=\"4\"></td>
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
		<input type=\"submit\" value=\"Módosít\"></form></td>
	</tr></form>";
	}
	}
echo"</table>
	</body> 
	</html>";
?>