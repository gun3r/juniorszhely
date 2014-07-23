<?php
include 'connection.php';
include 'szabaly.php';
$munkacsoport=0;
$i=1;
$sql="SELECT munkacsoport FROM  `user` WHERE eventus = \"$_COOKIE[sp_code]\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
if($munkacsoport=3 or $munkacsoport=4){
$munkacsoport="munkacsoport=3 or munkacsoport=4";
}
if($munkacsoport=1){
$munkacsoport="munkacsoport=1";
}
if($munkacsoport=2){
$munkacsoport="munkacsoport=2";
}
}
echo "
<form action='tippbe.php' enctype='multipart/form-data' method='post'>
<table>
<tr><td>
<table border=1>
<tr><td>Név</td>
<td>Helyezés</td></tr>
";
$sql="SELECT * FROM  `user` WHERE ($munkacsoport) and iranyito=0 order by name asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<tr><td>".$sor['name']."</td><td><INPUT type='text' name='"."a"."$i' size='5' value=''></td></tr>";
$i++;
}
echo"
</table>
</td>
<td valign=top>
<table border=1>
<tr><td>Név</td>
<td>Darab szám</td></tr>
<tr><td>Első 3 helyezett</td><td><INPUT type='text' name='a19' size='5' value='0'></td></tr>
<tr><td>Telephely</td><td><INPUT type='text' name='a20' size='5' value='0'></td></tr>
<tr><td>Minicsomag</td><td><INPUT type='text' name='a21' size='5' value='0'</td></tr>
<tr><td>felvevő opció</td><td><INPUT type='text' name='a22' size='5' value='0'></td></tr>
<tr><td>távszámla</td><td><INPUT type='text' name='a23' size='5' value='0'></td></tr>
<tr><td>VOD</td><td><INPUT type='text' name='a24' size='5' value='0'></td></tr>

</table>
</td></tr>
<tr><td><input id='Submit' name='submit' type='submit' value='Tipp elküdése'></td></tr>
<table>
</form>";
?>