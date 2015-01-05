<?php
  setcookie ("sp_code", "", time() - 3600);
  setcookie ("dat11", "", time() - 3600);
  setcookie ("dat12", "", time() - 3600);
  setcookie ("idi", "", time() - 3600);
  setcookie ("idm", "", time() - 3600);
  $URL="index.php"; header ("Location: $URL");

  ?>