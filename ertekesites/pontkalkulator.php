<?php
include 'connection.php';
include 'fejlec.php';
include 'feltoltp.html';

$csop=$_POST[csop];

if($csop==1)
{$csoport="munkacsoport='Grund Lajos' or munkacsoport='Háromi Gábor' or munkacsoport='1' or munkacsoport='2'";}
if($csop==2)
{$csoport="munkacsoport='Savanyó Ernõ' or munkacsoport='Márfy Attila' or munkacsoport='3' or munkacsoport='4'";}
if($csop==0)
{$csoport="munkacsoport='Grund Lajos' or munkacsoport='Háromi Gábor' or munkacsoport='Savanyó Ernõ' or munkacsoport='Márfy Attila' or munkacsoport='1' or munkacsoport='2' or munkacsoport='3' or munkacsoport='4'";}

echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>MT Értékesítés</title>\n"; 
echo "</head>\n"; 
echo "<body bgcolor=\"#D8D8D8\">\n"; 


echo "<table border=\"1\" bordercolor=\"#FFCC00\" style=\"background-color:#FFFFFF\">
	<tr>
		<td>Név</td>
		<td>Azonosító</td>
		<td>Termék</td>
		<td>T-home</td>
		<td>Többlet</td>
		<td>Munkadíj</td>
		<td>Eszköz portfóliós</td>
		<td>Eszköz nem portfóliós</td>
		<td>Dátum </td>
		<td></td>
		<td>Pontkalkulator</td>
		<td>Név</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>";
		$sql = "SELECT * FROM adat WHERE $csoport and termek!='Törölve' Order by id asc , datum2 desc";
		
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
$nevok=0;
$a=$sor['azonosito'];
$t=$sor['termek'];

 $sql2="SELECT * 
FROM  `pontkalkulator` 
WHERE 
	a =  '$a' AND e =  '$t'
 OR c =  '$a' AND e =  '$t'
 OR h = '$a' AND e =  '$t'
 OR y =  '$a' AND e =  '$t'";
$res2 = mysqli_query($con, $sql2);

$row_cnt = intval(mysqli_num_rows($res2));
if($row_cnt!=0){


while($sor2 = mysqli_fetch_array($res2)) {
$nevek=$sor2['l'];
if($nevek=="Pájer Csaba"){
$nevek="Pajer Csaba";
}
if (strpos($sor['name'],$nevek) !== false) {
    $nevok=1;
}

}
if($nevok==1){
//echo "<td>Rendben</td>";
}
else{
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>
 <form action=\"adat.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
echo "<td>Rögzítve</td>";   
echo "<td>Nem -". $nevek ."</td>";
}

}
else{
echo	"
		<tr>
		<td>" . $sor['name'] . "</td>
		<td>" . $sor['azonosito'] . "</td>
		<td>" . $sor['termek'] . "</td>
		<td>" . $sor['alap'] . "</td>
		<td>" . $sor['tobblet'] . "</td>
		<td>" . $sor['munkadij'] . "</td>
		<td>" . $sor['eszkoz'] . "</td>
		<td>" . $sor['eszkoz2'] . "</td>
		<td>" . $sor['datum'] . "</td>
		<td>
 <form action=\"adat.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
echo "<td>Nincs rögzítve</td>";
}
echo"</tr>";
}
	
echo "</table> 
	</body> 
	</html>";
?>