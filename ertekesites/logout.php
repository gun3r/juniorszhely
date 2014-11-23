<?php
  setcookie ("sp_code", "", time() - 3600);
  $URL="index.php"; header ("Location: $URL");

  ?>