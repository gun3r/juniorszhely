<?php
 $oa=0;
 $ot=0;
 $om=0;
 $oe=0;
 $oe2=0;
  
$sql = "SELECT name FROM `user` 
WHERE munkacsoport=$csop order by munkacsoport asc, iranyito desc, name asc
limit 0, 50";
$res = mysqli_query($con, $sql);
echo "
<table border=1>
<tr>
<th width=280>Név</th>
<th width=80>T-Home<br>T-Mobile
</th>
<th>Többlet szolgáltatás
</th>
<th>Munkadíj; SZSZSZK munkadíj
</th>
<th>Eszköz (portfóliós)
</th>
<th>TV; táblagép; egyéb <br> portfóliós eszközök
</th>";
while($sor = mysqli_fetch_array($res)) {
$nev=$sor['name'];
$sql2 =
"SELECT SUM( alap ) as a, SUM( tobblet ) as t, SUM( munkadij ) as m, SUM( eszkoz ) as e, SUM( eszkoz2 ) as e2 
FROM adat
WHERE name  LIKE \"%$nev%\" and
datum >='$datum2' and datum <='$datum3'";
 $res2 = mysqli_query($con, $sql2);
 
 while($sor2 = mysqli_fetch_array($res2)) {
  
 $oa=$oa+$sor2['a'];
 $ot=$ot+$sor2['t'];
 $om=$om+$sor2['m'];
 $oe=$oe+$sor2['e'];
 $oe2=$oe2+$sor2['e2'];
 
}
}

echo "
<tr>
<td>Vasi Full-TÁV KFT.</td>
<td align=right>".number_format($oa, 0, '.', ' ')."</td>
<td align=right>".number_format($ot, 0, '.', ' ')."</td>
<td align=right>".number_format($om, 0, '.', ' ')."</td>
<td align=right>".number_format($oe, 0, '.', ' ')."</td>
<td align=right>".number_format($oe2, 0, '.', ' ')."</td>
</tr>
</table>";
?>