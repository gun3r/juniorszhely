<?php
// Create connection
$conn = mysql_connect('localhost', 'root', 'laciferi') or die(mysql_error());
$db=mysql_select_db('ertekesites', $conn) or die(mysql_error());

//header to give the order to the browser
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=exported-data.csv');

$sz1=$_COOKIE['sz1'];
$sz2=$_COOKIE['sz2'];
$sz3=$_COOKIE['sz3'];
$sz4=$_COOKIE['sz4'];
$sz5=$_COOKIE['sz5'];
$sz6=$_COOKIE['sz6'];
$sz10=$_COOKIE['sz10'];
$sz11=$_COOKIE['sz11'];

$csme="megtarto = '10'";
$csmo="mobil = '10'";
$csa="alap = '10'";
$cst="tobblet = '10'";
$csm="munkadij = '1'";
$cse="(eszkoz ='1' or eszkoz2 = '1')";
$cseszk="eszkalacio='0' or eszkalacio='1'";


if($sz11==1)
{$csme="megtarto = '1'";}
if($sz10==1)
{$csmo="mobil = '1'";}
if($sz1==1)
{$csa="alap = '1'";}
if($sz2==1)
{$cst="tobblet = '1'";}
if($sz3==1)
{$csm="munkadij >= '1'";}
if($sz4==1)
{$cse="(eszkoz >='1' or eszkoz2 >= '1')";}
$mitol=$_POST["dat11"];
$meddig=$_POST["dat12"];

if($sz6=="LHO"){
$sql100 = "SELECT id,name,azonosito,wf,efinev,	termek,mobil,alap,megtarto,tobblet,munkadij,eszkoz,eszkoz2,datum,status,eszkalacio,note2 as 'eszkalacio megjegyzes',kizarva,note	
 FROM adat WHERE ($csme or $csmo or $csa or $cst or $csm or $cse) and datum >='$mitol' and datum <='$meddig' Order by id";
if($sz5==1){
$sql100 = "SELECT id,name,azonosito,wf,efinev,	termek,mobil,alap,megtarto,tobblet,munkadij,eszkoz,eszkoz2,datum,status,eszkalacio,note2 as 'eszkalacio megjegyzes',kizarva,note	
 FROM adat WHERE eszkalacio='1' and datum >='$mitol' and datum <='$meddig' Order by id";
}
}else{
$sql100 = "SELECT id,name,azonosito,wf,efinev,	termek,mobil,alap,megtarto,tobblet,munkadij,eszkoz,eszkoz2,datum,status,eszkalacio,note2 as 'eszkalacio megjegyzes',kizarva,note	
 FROM adat WHERE ($csme or $csmo or $csa or $cst or $csm or $cse) and name='$sz6' and  datum >='$mitol' and datum <='$meddig' Order by id";
if($sz5==1){
$sql100 = "SELECT id,name,azonosito,wf,efinev,	termek,mobil,alap,megtarto,tobblet,munkadij,eszkoz,eszkoz2,datum,status,eszkalacio,note2 as 'eszkalacio megjegyzes',kizarva,note	
 FROM adat WHERE eszkalacio='1' and name='$sz6' and  datum >='$mitol' and datum <='$meddig' Order by id";
}
}

//select table to export the data
$select_table=mysql_query("$sql100");
$rows = mysql_fetch_assoc($select_table);

if ($rows)
{
getcsv(array_keys($rows));
}
while($rows)
{
getcsv($rows);
$rows = mysql_fetch_assoc($select_table);
}

// get total number of fields present in the database
function getcsv($no_of_field_names)
{
$separate = '';


// do the action for all field names as field name
foreach ($no_of_field_names as $field_name)
{
if (preg_match('/\\r|\\n|,|"/', $field_name))
{
$field_name = '' . str_replace('', $field_name) . '';
}
echo $separate . $field_name;

//sepearte with the comma
$separate = ';';
}

//make new row and line
echo "\r\n";
}
?>