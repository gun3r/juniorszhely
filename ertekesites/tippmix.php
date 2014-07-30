<?php
$t=intval($_GET[t]);
include 'connection.php';
include 'fejlec.php';

$sql="SELECT * FROM  `tipp` WHERE name = \"$_COOKIE[sp_code]\" ";

$res = mysqli_query($con, $sql);
$row_cnt = intval(mysqli_num_rows($res));
if($t==1){
$row_cnt=1;
}
if($row_cnt != 1)
{
	include 'szabaly.php';
	echo "<br><br><a href=tippmix.php?p=7&t=1>Tovább a Tippmixre :)</a>";
	}
	else{
	echo "<a href=szabaly.php?p=7>Szabályzat</a>";
	}

	
if($t==1){
$munkacsoport=0;
$i=1;
$sql="SELECT munkacsoport FROM  `user` WHERE eventus = \"$_COOKIE[sp_code]\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$munkacsoport=$sor[munkacsoport];
$csoport=$munkacsoport;
if($munkacsoport==3 or $munkacsoport==4){
$munkacsoport="munkacsoport=3 or munkacsoport=4";
}
if($munkacsoport==1){
$munkacsoport="munkacsoport=1";
}
if($munkacsoport==2){
$munkacsoport="munkacsoport=2";
}
}
echo "
<form action='tippbe.php' method='post'>
<table>
<tr><td>
<table border=1>
<tr><td>Név</td>
<td>Versenyen elért helyezés</td></tr>
";
$sql="SELECT * FROM  `user` WHERE ($munkacsoport) and iranyito=0 order by name asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<tr><td>".$sor['name']."</td><td><INPUT type='text' name='"."a"."$i' size='5' value='0'></td></tr>";
$i++;
}
echo"
</table>
</td>
<td valign=top>
<table border=1>
<tr><td>Telephely többlet</td><td>Helyezés</td></tr>
<tr><td>Minicsomag</td><td><INPUT type='text' name='a19' size='5' value='0'</td></tr>
<tr><td>felvevő opció</td><td><INPUT type='text' name='a20' size='5' value='0'></td></tr>
<tr><td>távszámla</td><td><INPUT type='text' name='a21' size='5' value='0'></td></tr>
<tr><td>VOD</td><td><INPUT type='text' name='a22' size='5' value='0'></td></tr>

</table>
</td>
<td valign=top>
<table border=1>
<tr><td>Telephely</td><td>Darab</td></tr>
<tr><td>Első 3 helyezett</td><td><INPUT type='text' name='a23' size='5' value='0'></td></tr>
<tr><td>Összes</td><td><INPUT type='text' name='a24' size='5' value='0'></td></tr>
</table>
</td></tr>
<tr><td>
<INPUT type='hidden' name='csoport' value='$csoport'>
<INPUT type='submit' value='Tipp elküdése'></td></tr>
<table>
</form>";
}

$sql2="SELECT * FROM  `tipp` WHERE name = \"$_COOKIE[sp_code]\" ";

$res2 = mysqli_query($con, $sql2);
$row_cnt2 = intval(mysqli_num_rows($res2));
if($row_cnt2==1){
while($sor2 = mysqli_fetch_array($res)) {

$munkacsoport=0;
$i=1;
$sql="SELECT munkacsoport FROM  `user` WHERE eventus = \"$_COOKIE[sp_code]\" ";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {
$munkacsoport=$sor[munkacsoport];
$csoport=$munkacsoport;
if($munkacsoport==3 or $munkacsoport==4){
$munkacsoport="munkacsoport=3 or munkacsoport=4";
}
if($munkacsoport==1){
$munkacsoport="munkacsoport=1";
}
if($munkacsoport==2){
$munkacsoport="munkacsoport=2";
}
}
echo "
<table>
<tr><td>
<table border=1>
<tr><td>Név</td>
<td>Tippem</td></tr>
";
$sql="SELECT * FROM  `user` WHERE ($munkacsoport) and iranyito=0 order by name asc";
$res = mysqli_query($con, $sql);
while($sor = mysqli_fetch_array($res)) {

echo "<tr><td>".$sor['name']."</td><td>".$sor2[$i]."</td></tr>";
$i++;
}
$i=19;
echo"
</table>
</td>
<td valign=top>
<table border=1>
<tr><td>Telephely többlet</td><td>Tippem</td></tr>
<tr><td>Minicsomag</td><td>".$sor2[17]."</td></tr>
<tr><td>felvevő opció</td><td>".$sor2['18']."</td></tr>
<tr><td>távszámla</td><td>".$sor2[19]."</td></tr>
<tr><td>VOD</td><td>".$sor2[20]."</td></tr>

</table>
</td>
<td valign=top>
<table border=1>
<tr><td>Telephely</td><td>Tippem</td></tr>
<tr><td>Első 3 helyezett</td><td>".$sor2[21]."</td></tr>
<tr><td>Összes</td><td>".$sor2[22]."</td></tr>
</table>
</td></tr>
<tr><td></td></tr>
<table>";
}
}
?>