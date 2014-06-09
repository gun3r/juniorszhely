<html lang="hu">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link type="image/x-icon" rel="icon" href="favicon.ico" />
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
<title>Üzenet beállító</title>
</head>
<body>
<?php
include 'fejlec.php';
?>
<form name="input" action="szoveg_be.php" method="post">
Megjelenítendő szöveg: <input type="text" size="300" name="szoveg" ><br>
Szöveg háttér: <select name="colorh">
      <option value="white" selected>Fehér</option>
      <option value="yellow">Sárga</option>
      <option value="orange">Narancs</option>
	  <option value="red">Piros</option>
	 </select>
Szöveg szín: <select name="colorsz">
      <option value="black" selected>Fekete</option>
      <option value="white">Fehér</option>      
	  <option value="yellow">Sárga</option>
      <option value="orange">Narancs</option>
	  <option value="red">Piros</option>
	 </select>
Betű méret(1-7):<input type="text" size="3" name="meret" value=7>
<input type="submit" value="Küldés">
</form>
</html>