<?php
	
setcookie ("sp_code", "", time() - 3600);
setcookie ("sp_codej", "", time() - 3600);

$URL="index.html"; 
header ("Location: $URL");

?>