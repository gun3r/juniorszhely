<?php
// Create connection
$conn = mysql_connect('localhost', 'root', 'laciferi') or die(mysql_error());
$db=mysql_select_db('ertekesites', $conn) or die(mysql_error());

//header to give the order to the browser
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=exported-data.csv');

$mitol=$_COOKIE[dat11];
$meddig=$_COOKIE[dat12];


$sql100 = "SELECT id,name,azonosito,wf,efinev,	termek,alap,tobblet,munkadij,eszkoz,eszkoz2,datum,status,eszkalacio,kizarva,note	
 FROM adat WHERE datum >='$mitol' and datum <='$meddig' ORDER BY datum asc";


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