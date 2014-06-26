<?php
if (isset($_COOKIE["sp_code"]))
{}  
else
{
$URL="index.php"; 
header ("Location: $URL");
exit();
}  
?>
