<?php
$p=intval($_GET[p]);
if (isset($_COOKIE["sp_code"]))
{
include 'connection.php';
$sp=$_COOKIE['sp_code'];
$sql10 = "SELECT * from `user` 
WHERE eventus='$sp'";
$res10 = mysqli_query($con, $sql10);
while($sor10 = mysqli_fetch_array($res10)) {
$nev=$sor10['name'];
$adat=$sor10['belep'];
}
if($p==0){$colorf='magenta';}else{$colorf='black';}
echo "<h4><a href=index.php?p=0 style='color:".$colorf."'>Összesítő</a>";
if($adat=='1'){
echo "   ";
if($p==1){$colorf='magenta';}else{$colorf='black';}
echo "<a href=adat.php?p=1 style='color:".$colorf."'>Adatok</a>";
echo "   ";
if($p==2){$colorf='magenta';}else{$colorf='black';}
echo "<a href=elvaras.php?p=2 style='color:".$colorf."'>Elvárás</a>";
echo "   ";
if($p==3){$colorf='magenta';}else{$colorf='black';}
echo "<a href=szoveg.php?p=3 style='color:".$colorf."'>Üzenet</a>";
echo "   ";
if($p==4){$colorf='magenta';}else{$colorf='black';}
echo "<a href=pontkalkulator.php?p=4 style='color:".$colorf."'>Korrekció</a>";
echo "   ";
if($p==5){$colorf='magenta';}else{$colorf='black';}
echo "<a href=jelszocsere.php?p=5 style='color:".$colorf."'>Jelszócsere</a>";
if($nev=='Ács György'){
echo "   ";
if($p==6){$colorf='magenta';}else{$colorf='black';}
echo "<a href=ember.php?p=6 style='color:".$colorf."'>Kollégák</a>";
}
}
echo "<br>";

echo "Beléptél mint: ".$nev."  ";

echo "</h4>";
}  
else
{
echo"  <form action='belep.php' method='post'>
  <table  style='border:0px'>
  <tr>
  <td>
  Eventus: </td> <td><input type='text' name='sp_code'>
  </td>
  <td>
  Jelszó: </td> <td><input type='password' name='password'>
  </td>
  <td>
  <input type='submit' value='Belépés'>
  </td>
  </tr>
  </table>
  </form>";
}
  
?>