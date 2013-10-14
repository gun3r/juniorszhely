<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
    <title>Eszközcsere</title>
    
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body bgcolor="#D8D8D8">
  <?php include_once("analyticstracking.php") ?>
  <h1>Eszközcsere</h1>

  <form action="belep.php" method="post">
  <table border="8">
  <tr>
  <td>
  Eventus kód: </td> <td><input type="text" name="sp_code">
  </td>
  </tr>
  <tr>
  <td>
  Jelszó: </td> <td><input type="password" name="password">
  </td>
  </tr>
  </table>
  <input type="submit" value="Belépés">
  </form>
<!--<h4>Készítették: Molnár Gábor, Vadász Gergő  </br>
	<a href="mailto:molnar.gabor2@telekom.hu; vadasz.gergo@telekom.hu?Subject=Eszközcsere"</a>E-mail a fejlesztőknek</h4>    
 -->
<?php
	include 'lablec.php';
?> 
  </body>
</html>
