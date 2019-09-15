<?php
  $userName = "Ralf Vihmaru";
  $fullTimeNow = date("d.m.Y H:i:s");  
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  $partofDay2 = "vaba aeg";
  $partofDay3 = "mingi muu tund";
  $partofDay4 = "valge ";
  if($hourNow < 8) {
	$partOfDay = "varane hommik";
	}
	{
  if($hourNow > 9) 
    $partofDay2 = "kooli aeg";
    }
	{
  if($hourNow == 8 and 9 and 10 and 11) 
    $partofDay3 = "veebiprogemine";
	}
	{
  if($hourNow <= 6 ) 
    $partofDay4 = "pime";
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
    echo "<hl>  ".$userName. "  koolitöö leht </hl>";
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
  <?php
    echo "<p>Lehe avamise ajal on tudengil " .$partofDay2 . 
	".</p>";
   ?>
   <?php
    echo "<p>Lehe avamise ajal on tudengil " .$partofDay3 . 
	".</p>";
   ?>
   <?php
    echo "<p>Lehe avamisel on " .$partofDay4 . 
	".</p>";
   ?>
  <hr>
</body>
</html>