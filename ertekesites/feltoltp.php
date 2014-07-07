Pontkalkulátor feltöltés: <form action="feltoltpp.php" enctype="multipart/form-data" method="post">
<input id="file" name="file" type="file" />
<input id="Submit" name="submit" type="submit" value="Feltölt" />
</form>
<form action="pontkalkulator.php?p=4" enctype="multipart/form-data" method="post">
<INPUT type="text" name="dat4" size='12' value="<?php echo $datum4;?>">
<INPUT type="text" name="dat5" size='12' value="<?php echo $datum5;?>"><br>
<input type="radio" name="csop" value="0"<?php if($csop==0){echo "checked";}?>>Összes
<input type="radio" name="csop" value="1"<?php if($csop==1){echo "checked";}?>>Biczó Éva
<input type="radio" name="csop" value="2"<?php if($csop==2){echo "checked";}?>>Edőcs János
<input type="radio" name="csop" value="3"<?php if($csop==3){echo "checked";}?>>Háromi Gábor
<input type="radio" name="csop" value="4"<?php if($csop==4){echo "checked";}?>>Grund Lajos
<input type="radio" name="csop" value="5"<?php if($csop==5){echo "checked";}?>>Savanyó Ernő
<input type="radio" name="csop" value="6"<?php if($csop==6){echo "checked";}?>>Márfy Attila
<input type="hidden" name="s" value="1">
<input id="Submit" name="submit" type="submit" size="3"value="OK" />
</form>