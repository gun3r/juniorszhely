<?php
$n=intval($_POST[n]);
setcookie('nezet', $n,time() + (60*60*24 * 3650));
$URL="index.php?p=0"; header ("Location: $URL");
?>