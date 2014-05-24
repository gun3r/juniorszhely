<?php
include 'connection.php';
include 'fejlec.php';
include 'feltoltp.html';
$mod=$_POST[mod];

if($mod==1){

$sql = "SELECT * FROM  `adat` WHERE  `id` =  '$_POST[id]'";
$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

		$name=$sor['name'];
		$azonosito=$sor['azonosito'];
		$termek=$sor['termek'];
		$alap=$sor['alap'];
		$tobblet=$sor['tobblet'];
		$munkadij=$sor['munkadij'];
		$eszkoz=$sor['eszkoz'];
		$eszkoz2=$sor['eszkoz2'];
		$datum=$sor['datum'];
		$namev=$name;
		$termekv=$termek;
}
}else{
		$name="Válasz!";
		$azonosito="";
		$termek="Válasz!";
		$alap="";
		$tobblet="";
		$munkadij="";
		$eszkoz="";
		$eszkoz2="";
		$datum=date("Y-m-d");
		$namev="";
		$termekv="";
$mod=0;
}

 
echo "<html lang=\"hu\">\n"; 
echo "<head>\n"; 
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\"utf-8\">\n"; 
echo "<title>MT Értékesítés</title>\n"; 
echo "</head>\n"; 
echo "<body bgcolor=\"#D8D8D8\">\n"; 

echo "<form action=\"adat_be.php\" method=\"post\">\n"; 
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
	<td><select name=\"name\" size=\”1\”>
	<option value=\"".$namev."\" selected>".$name."</option>";
	
$sql = "SELECT name FROM user WHERE 1 Order by name";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['name'] . "\">  " . $sor['name'] . "</option>\n";
}	
		
echo " 	</select></td>
			
		<td><input type=\"text\" name=\"azonosito\" value=\"".$azonosito."\"size=\"10\"></td>
		
		<td><select name=\"termek\" size=\”1\”>
	<option value=\"".$termekv."\" selected>".$termek."</option>";
	
$sql = "SELECT nev FROM termek WHERE 1 Order by nev";

$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {

echo "  <option value=\"" . $sor['nev'] . "\">  " . $sor['nev'] . "</option>\n";
}	
		
echo " 	</select></td>
		
		<td><input type=\"text\" name=\"alap\" value=\"".$alap."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"tobblet\" value=\"".$tobblet."\"size=\"3\"></td>
		<td><input type=\"text\" name=\"munkadij\" value=\"".$munkadij." \"size=\"6\"></td>
		<td><input type=\"text\" name=\"eszkoz1\" value=\"".$eszkoz."\"></td>
		<td><input type=\"text\" name=\"eszkoz2\" value=\"".$eszkoz2."\"></td>
		<td><input type=\"text\" name=\"datum\" value=\"". $datum ."\" size=\"10\"></td>
		<td>
		<input type=\"hidden\" name=\"mod\" value=\"". $mod ."\">
		<input type=\"hidden\" name=\"id\" value=\"". $_POST[id]. "\">
		<input type=\"submit\"></form></td>
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
		$sql = "SELECT * FROM adat WHERE 1 Order by id desc , datum2 desc";
		
		$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
$a=$sor['azonosito'];
$t=$sor['termek'];
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
echo "<td>Rögzítve</td>";
}else{echo "<td>Nincs rögzítve</td>";}
while($sor2 = mysqli_fetch_array($res2)) {

if (strpos($sor['name'],$sor2['l']) !== false) {
    echo "<td>Rendben</td>";
}else{echo "<td>Nem -". $sor2['l'] ."</td>";}

}
echo"</tr>";
}
	
echo "</table> 
	</body> 
	</html>";
?>
