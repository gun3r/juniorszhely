<?php // Create connection
include 'connection.php';
$br="%0D%0A";//mailto sortörés

$sp=$_COOKIE['sp_code'];

$sql10 = "SELECT name from `user` 
WHERE eventus='$sp'";
$res10 = mysqli_query($con, $sql10);
while($sor10 = mysqli_fetch_array($res10)) {
$nev=$sor10['name'];}

$sql11 = "SELECT note from `adat` 
WHERE WHERE id='$azonosito'";
$res11 = mysqli_query($con, $sql11);
while($sor11 = mysqli_fetch_array($res11)) {
$note=$sor11['note'];}

$sql="UPDATE adat SET  note='BO-nak továbbítva ".date("Y-m-d H:i:s").". ". $note."',bo='1' WHERE  id ='$_POST[id]'";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

$sql1 ="SELECT * from adat WHERE id='$azonosito'";
$res1 = mysqli_query($con, $sql1);
while($sor1 = mysqli_fetch_array($res1)) {
$kinek="";

$m=$sor1['munkacsoport'];

if($m==1 or $m==2){
$kinek=";%20biczo.eva@telekom.hu";
}
if($m==3 or $m==4){
$kinek=";%20edocs.janos@telekom.hu";
}
if($m==5) {
$kinek=";%20edocs.janos@telekom.hu;%20biczo.eva@telekom.hu";
}
if($m>=6 and $m<=20) {
$kinek=";%20pinczes.eva@telekom.hu;%20csuka.jennifer.inez@telekom.hu";
}
$email_address = utf8_decode("MAILTO:munkairanyitok.backoffice.eszkalacio@telekom.hu?cc=dancsecs.andras@telekom.hu" . $kinek . "&Subject=" . $sor1['wf'] . "&Body=
 Tisztelt munkairányítók!".$br."
 ".$br."
 Kérem a segítségeteket az alábbi igény rendezésében: kérelem azonosító: " . $sor1['wf'] . "  " . $sor1['status'] . ".".$br."
 ".$br."
 Köszönettel,".$br."
 ".$nev."".$br."");
header("location: $HTTP_REFERER");
header("Refresh: 0; url=$email_address");
}
?>