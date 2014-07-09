<?php
include 'fejlec.php';
include 'connection.php';
$sp=$_COOKIE['sp_code'];

if($_POST[mod]==1){

$pw1=$_POST[pw1];
$pw2=$_POST[pw2];

$sql = "SELECT password as pw FROM user WHERE eventus='$sp'";
$res = mysqli_query($con, $sql);

while($sor = mysqli_fetch_array($res)) {
$pw=$sor[pw];
if($pw!=$pw1){
Echo "Aktuális jelszó nem egyezik!<br>";
break;
}
if($pw2==''){
Echo "Nem adtál meg új jelszót!";
break;
}
$sql2 = "UPDATE user SET password= '$pw2' WHERE eventus='$sp'";
if (!mysqli_query($con,$sql2))
  {
    die('Error: ' . mysqli_error($con));
    }
echo "Jelszó módosult!";
 mysqli_close($con); 
}
}
if (isset($_COOKIE["sp_code"]))
{
echo"<table border=1>
<form action='jelszocsere.php?p=5' enctype='multipart/form-data' method='post'>
<tr>
<td>
Aktuális jelszó:</td><td><INPUT type='password' name='pw1' size='20'>
</td></tr>
<tr><td>
Új jelszó:</td><td><INPUT type='password' name='pw2' size='20'>
</td></tr>
<tr><td colspan='2'>
<input type='hidden' name='mod' value='1'>
<input id='Submit' name='submit' type='submit' size='5'value='CSERE'>
</td></tr>
</form>
</table>";
}
?>