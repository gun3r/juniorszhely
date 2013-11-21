<html>
<body bgcolor="#D8D8D8">
<?php
include 'kuki.php';
include 'connection.php';
include 'fejlec.php';
include_once("analyticstracking.php");
$jog = intval($_COOKIE["sp_codej"]);
$sp_code = strval($_COOKIE["sp_code"]);

if($jog==2){

$sql = "Select members.name as name, members.email,data.* from  members inner join data on (data.sp_code=members.sp_code) WHERE  `closed` =  '0'";

$sql2 = "Select members.name as name, data.* from  members inner join data on (data.sp_code=members.sp_code) WHERE `closed` =  '1' ORDER BY `date` DESC LIMIT 10";
$szin1="\"#000000\"";
$szin2="\"#FF0000\"";
$num1="2";
$num2="3";
$res = mysqli_query($con, $sql);
$res2 = mysqli_query($con, $sql2);

echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz típusa</th>
<th>Régi eszköz</th>
<th>Új eszköz típusa</th>
<th>Új eszköz</th>
<th>Név</th>
<th>Dátum</th>
<th> </th>
<th> </th>
</tr>";
while($sor = mysqli_fetch_array($res)) {
 $num=$num1;
 $email=$sor['email'];
 $emailsend="";
 $br="%0D%0A";//mailto sortörés!!
  if($sor['alert']==1){
 $szin= $szin2;
 $num=$num2;
 
 $emailsend=
 "<td>
 <form action=\"MAILTO:". $email ."?Subject=Eszközcsere Hibás adatok!!&Body=Hibás eszköz adatokat adtál meg az alábbi esetben:".$br.$br."
 A szám: " . $sor['a_szam'] .$br. "
 Régi eszköz: " . $sor['eszkoz1'] .$br. "
 Régi eszköz: " . $sor['serial1'] . $br."
 Új eszköz típusa: " . $sor['eszkoz2'] .$br. "
 Új eszköz: " . $sor['serial2'] . $br."
 \" method=\"post\" enctype=\"text/plain\">
 <input type=\"submit\" value=\"Email küldés\">
</form></td>
<td>
 <form action=\"eszkozcsere.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
 }
 
 echo "<tr  height=\"12px\">";
 echo "<td><font color=" . $szin . ">" . $sor['a_szam'] . "</td>";
 
 echo "<td><font color=" . $szin . ">" . $sor['eszkoz1'] . "</td>";
 echo "<td><font color=" . $szin . ">" . $sor['serial1'] . "</td>";
 
 
 echo "<td><font color=" . $szin . ">" . $sor['eszkoz2'] . "</td>";
 
 echo "<td><font color=" . $szin . ">" . $sor['serial2'] . "</td>";
 echo "<td><font color=" . $szin . ">" . $sor['name'] . "</td>";
 echo "<td><font color=" . $szin . ">" . $sor['date'] . "</td></font>";
 
 echo "<td>
 <form action=\"mod.php\" method=\"post\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"data\" value=\"1\">
 <input type=\"submit\" value=\"OK\">
 </form></td>";
 echo "<td>
 <form action=\"mod.php\" method=\"post\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"hidden\" name=\"data\" value=\"" . $num .".\">
 <input type=\"submit\" value=\"NEM\">
 </form></td>" . $emailsend ;
 echo "</tr>"; 
 $szin=$szin1;
}
echo "</table>";
echo "</br></br>";
echo "Jóváhagyott cserék (utolsó 10 darab):</br>
	<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz típusa</th>
<th>Régi eszköz</th>
<th>Új eszköz típusa</th>
<th>Új eszköz</th>
<th>Név</th>
<th>Dátum</th>
<th>Lezárva</th>
</tr>";

while($sor = mysqli_fetch_array($res2)) {

 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
  
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 
 echo "<td>" . $sor['name'] . "</td>";
 
 echo "<td>" . $sor['date'] . "</td>";
 echo "<td>" . $sor['date2'] . "</td>";
 echo "</tr>"; 

}
echo "</table>";
}
else{

$sql = "SELECT * FROM  `data` WHERE  `sp_code` =  '$sp_code'  ORDER BY `alert` DESC, `date` DESC";

$res = mysqli_query($con, $sql);

echo "<table border='8'>
<tr>
<th>A szám</th>
<th>Régi eszköz típusa</th>
<th>Régi eszköz</th>
<th>Új eszköz típusa</th>
<th>Új eszköz</th>
<th>Dátum</th>
</tr>";
while($sor = mysqli_fetch_array($res)) {

 echo "<tr>";
 echo "<td>" . $sor['a_szam'] . "</td>";
 
 echo "<td>" . $sor['eszkoz1'] . "</td>";
 echo "<td>" . $sor['serial1'] . "</td>";
  
 echo "<td>" . $sor['eszkoz2'] . "</td>";
 echo "<td>" . $sor['serial2'] . "</td>";
 echo "<td>" . $sor['date'] . "</td>";
 
//hiba esetén mod gomb és adatok küldése 
 if($sor['alert']==1){

 echo "<td>
 <form action=\"eszkozcsere.php\" method=\"post\">
 <input type=\"hidden\" name=\"mod\" value=\"1\">
 <input type=\"hidden\" name=\"id\" value=" . $sor['id'] . ">
 <input type=\"submit\" value=\"Módosít\">
 </form></td>";
 }
 echo "</tr>"; 

}

echo "</table>";
}
mysqli_close($con);
include 'lablec.php';
?>

</body>
</html>
