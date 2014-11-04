<?php

$n=intval($_GET[n]);

if($n==1){
setcookie('nezet', $n,time() + (60*60*24 * 3650));
//echo $n;
}
if($n==2){
setcookie('nezet', $n,time() + (86400 * 3650));
//echo $n;
}

$URL="index.php?p=0"; header ("Location: $URL");
?>