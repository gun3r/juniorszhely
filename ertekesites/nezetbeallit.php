<?php

$n=intval($_GET[n]);

if($n==1){
setcookie('nezet', $n,time() + (86400 * 365));
//echo $n;
}
if($n==2){
setcookie('nezet', $n,time() + (86400 * 365));
//echo $n;
}

$URL="index.php?p=0"; header ("Location: $URL");
?>