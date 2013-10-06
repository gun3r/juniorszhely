<?php
$sp_code = strval($_COOKIE["sp_code"]);
//név kiírás
//echo "<form method=\"post\" action=\"eszkozcsere.php\"><input type=\"submit\" value=\"Eszközcsere\" name=\"submit\"/></form>";
//echo "<form method=\"post\" action=\"lista.php\"><input type=\"submit\" value=\"Lista\" name=\"submit\"/></form>";
echo "<h4><a href=/eszkozcsere.php>Eszközcsere</a>";
echo "  ";
echo "<a href=/lista.php>Lista</a>";
echo "  ";
echo "<a href=/kilep.php>Kilépés</a>  <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belépett felhasználó:</a> " . $sp_code . "</h4>";


?>