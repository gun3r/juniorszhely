<?php
include 'connection.php';

$sql = "SELECT * FROM data";


$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) 
{
 echo $sor['a_szam']." ".$sor['serial1']." ".$sor['serial2']." ".$sor['sp_code']." ".$sor['date'];
}  
mysqli_close($con);
?>
