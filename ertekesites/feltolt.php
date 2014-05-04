<?php
if(isset($_POST['submit'])) { //ha megnyomtuk a feltöltés gombot
$target= ""; //célmappa
$file_name = $_FILES['file']['name']; //a célfájlt nevezze el a $_FILES superglobal változóban lévo fájlnévre (a fájl eredeti nevére)
$tmp_dir = $_FILES['file']['tmp_name']; //az ideiglenes mappa helyét a $tmp_dir változóban tároljuk
 
if(!preg_match('/(csv)$/i', $file_name)) //ha a fájlnak ($file_name-nek) a kiterjesztése nem gif, jpg/jpeg, png, akkor...
{
echo "Rossz fajltipus!"; //... "dobjon el" egy hibát
}
else
{
move_uploaded_file($tmp_dir, $target . "a.csv" ); //az ideiglenes mappából átteszi a fájlt a végleges mappába (a $target . $file_name összeilleszti a két stringet, így uploads/fajlnev-et kapunk)
$feltoltve = true; //a feltoltve változó true értéket kap
}
}

$URL="simplecsvimport.php"; 
header ("Location: $URL");
exit();

?>