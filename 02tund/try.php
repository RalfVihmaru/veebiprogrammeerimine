<?php
  $userName = "Ralf Vihmaru";
  $fullTimeNow = date("d.m.Y H:i:s");  
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  if($hourNow < 8) {
	$partOfDay = "varane hommik";
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
   echo $userName;
  ?>
  meisterdamas</title>
  </head>
<body>
  <?php
    echo "<hl>" .$userName . " koolitöö leht</hl>";
  ?>
  
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Lehe avamise hetkel oli aeg:
  <?php
   echo $fullTimeNow;
   ?>
.</p>
  <?php 
    echo "<p>Lehe avamise hetkel oli " .$partOfDay .
	".</p>";
  ?>  
</body>
</html>