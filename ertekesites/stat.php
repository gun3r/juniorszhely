<html lang="hu">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link type="image/x-icon" rel="icon" href="favicon.ico" />
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
<title>Statisztika</title>
</head>
<body>
<?php

$h=6;
$n=1;
$d=mktime(0, 0, 0, $h, $n, 2014);
$hetnap=date("N", $d);
$maxnap=date("t", $d);
$nap=date("Y-m-d", $d);
$utolso=date("Y-m-t", $d);
//vasárnapok
echo $nap.", ";
for($n=1;$n<=$maxnap;$n++){
$d=mktime(0, 0, 0, $h, $n, 2014);
$hetnap=date("N", $d);
if($hetnap==7){
$d=mktime(0, 0, 0, $h, $n, 2014);
$nap=date("Y-m-d", $d);
echo $nap."<br>";
}
if($hetnap==1 and $n!=1){
$d=mktime(0, 0, 0, $h, $n, 2014);
$nap=date("Y-m-d", $d);
echo $nap.", ";

}
}
$d=mktime(0, 0, 0, $h, $n-1, 2014);
$hetnap=date("N", $d);
if($hetnap!=7){
echo $utolso;
}
?>
<BR><BR><BR>
<?php
 $dnap=date("Y-m-01");
 $d2=mktime(0, 0, 0, $dnap);
 $nap2=date("Y-m-01", $d2);
 echo $nap2;
?>
<div class="marquee" style='-webkit-marquee:scroll;   
overflow-x: -webkit-marquee'>Lollipop topping lemon drops jujubes applicake fruitcake tart liquorice sesame snaps.</div>  

</body>