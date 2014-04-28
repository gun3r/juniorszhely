<?php
include 'connection.php';
$mod=$_POST[mod];
$ev=date("Y-m-01");


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

$sql = "SELECT name FROM `user` WHERE 1 order by iranyito asc , munkacsoport asc, name asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

$aktiv="Igen";
$alap=0;
$tobblet=0;
$munkadij=0;
$eszkoz=0;
$eszkoz2=0;
$mod=0;
$id="";
$name=$sor['name'];
 
 $sql2 = "SELECT * FROM `elvaras` WHERE elvaras.name=\"$name\" ";
 $res2 = mysqli_query($con, $sql2);
 while($sor2 = mysqli_fetch_array($res2)) {
		$id=$sor2['id'];
		$aktiv=$sor2['aktiv'];
		$alap=$sor2['alap'];
		$tobblet=$sor2['tobblet'];
		$munkadij=$sor2['munkadij'];
		$eszkoz=$sor2['eszkoz'];
		$eszkoz2=$sor2['eszkoz2'];
		
 $mod=1;
 }

echo "	
		<form action=\"elvaras_be.php\" method=\"post\">
	<tr>
		<td><select name=\"aktiv\" size=\1”>
      <option value=\"".$aktiv."\" selected>".$aktiv."</option>
	  <option value=\"Nem\">Nem</option>
	  <option value=\"Igen\">Igen</option> </td>
		<td>".$name."</td>
		<td><input type=\"text\" name=\"alap\" value=\"".$alap."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"tobblet\" value=\"".$tobblet."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"munkadij\" value=\"".$munkadij." \"size=\"6\"></td>
		<td><input type=\"text\" name=\"eszkoz1\" value=\"".$eszkoz."\"></td>
		<td><input type=\"text\" name=\"eszkoz2\" value=\"".$eszkoz2."\"></td>
		<td>". $ev ."</td>
		<td>
		<input type=\"hidden\" name=\"name\" value=\"". $name ."\">
		<input type=\"hidden\" name=\"ev\" value=\"".$ev. "\">
		<input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">
		<input type=\"hidden\" name=\"id\" value=\"". $id. "\">
		<input type=\"submit\"></form></td>
	</tr></form>";
	}
echo"</table>
	</body> 
	</html>";
?>