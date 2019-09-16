<?php
  $userName = "Ralf Vihmaru";
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $fullTimeNow = date("d.m.Y H:i:s");  
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  $partofDay2 = "vaba aeg";
  $partofDay3 = "mingi muu tund";
  $partofDay4 = "valge ";
  if($hourNow < 8) {
	$partOfDay = "varane hommik";
	}
  if($hourNow >=8) { 
    $partofDay2 = "kooli aeg";
    }
  if($hourNow == 8 or 9 or 10 or 11){ 
    $partofDay3 = "veebiprogemine";
	}
  if($hourNow <= 7 ) {
    $partofDay4 = "pime";
	}
	
	//info semestri kulgemise kohta
	
	$semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	$today = new DateTime("now");
	$fromsemesterStart = $semesterStart ->diff($today);
	//var_dump($fromsemesterStart);
	$semesterInfoHTML = "<p>Siin peaks olema info semestri kulgemise kohta! </p>";
	$elapsedValue = $fromsemesterStart->format("%r%a");
	$durationValue = $semesterDuration->format("%r%a");
	//echo $testValue;
	//<meter min="0" max="155" value="60">Väärtus</meter>
	if($elapsedValue > 0) {
		$semesterInfoHTML = "<p>Semester on täies hoos: ";
		$semesterInfoHTML .= '<meter min="(0)" max="' .$durationValue.'" ';
		$semesterInfoHTML .= 'value="' .$elapsedValue .'">';
		$semesterInfoHTML .= round($elapsedValue / $durationValue * 100, 1) ."%";
		$semesterInfoHTML .= "</meter>";
		$semesterInfoHTML .="</p>";
		}	
	
	//foto lisamine lehele
	$allPhotos = [];
	$dirContent = array_slice(scandir($photoDir), 2);
	//var_dump ($dirContent);
	foreach ($dirContent as $file) {
		$fileInfo = getImagesize($photoDir. $file);
		//var_dump($fileInfo);
	    if(in_array($fileInfo["mime"], $picFileTypes) == true){
			array_push($allPhotos, $file);
	    }
	}
	
	
	
	//var_dump ($allPhotos);
	$picCount = count($allPhotos);
	$picNum = mt_rand(0,($picCount - 1));
	//echo $allPhotos[$picNum];
	$photoFile = $photoDir .$allPhotos[$picNum];
	$randomImgHTML = '<img src="' .$photoFile .'" alt="TLÜ Terra õppehoone">';
	//lisame lehe päise
	require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML
  ?>
  <hr>
  <p>Lehe avamise hetkel oli aeg:
  <?php
   echo $fullTimeNow;
   ?>
 </p>
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
    echo "<p>Lehe avamisel on õues " .$partofDay4 . 
	".</p>";
   ?>
  <hr>
  <?php
   echo $randomImgHTML;
  ?>
</body>
</html>