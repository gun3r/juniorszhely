<?php
if (isset($_COOKIE["sp_code"]))
{}  
else
{
$URL="index.html"; 
header ("Location: $URL");
exit();
}  
?>