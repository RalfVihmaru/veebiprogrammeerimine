<?php
  require("../../../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_ralf_vi_1";
  
  $userName = "Sisselogimata kasutaja";
  
  $notice = "";
  $email = "";
  $emailError = "";
  $passwordError = "";
	  
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $weekdayNow = date("N");
  $dateNow = date("d");
  $monthNow = date("m");
  $yearNow = date("Y");
  $timeNow = date("H:i:s");
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
	$fromSemesterStart = $semesterStart->diff($today);
	//var_dump($fromSemesterStart);
	//echo "Päevi: " .$fromSemesterStart->days;
	$semesterInfoHTML = "<p>Siin peaks olema info semestri kulgemise kohta!</p>";
	$elapsedValue = $fromSemesterStart->format("%r%a");
	$durationValue = $semesterDuration->format("%r%a");
	//echo $testValue;
	//<meter min="0" max="155" value="33">Väärtus</meter>
	if($elapsedValue >= 0 and $elapsedValue <= $durationValue){
		$semesterInfoHTML = "<p>Semester on täies hoos: ";
		$semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
		$semesterInfoHTML .= 'value="' .$elapsedValue .'">';
		$semesterInfoHTML .= round($elapsedValue / $durationValue * 100, 1) ."%";
		$semesterInfoHTML .="</meter>";
		$semesterInfoHTML .="</p>";
	}
	if($elapsedValue < 0){
		$semesterInfoHTML = "<p>Semester pole veel alanud.</p>";
	}
	if($elapsedValue > $durationValue){
		$semesterInfoHTML = "<p>Semester on läbi!</p>";
	}
	
	//foto lisamine lehele
	$allPhotos = [];
	$dirContent = array_slice(scandir($photoDir), 2);
	//var_dump($dirContent);
	foreach ($dirContent as $file){
		//echo $file;
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo);
		if(in_array($fileInfo["mime"], $picFileTypes) == true){
			array_push($allPhotos, $file);
		}
	}
	
	//var_dump($allPhotos);
	$picCount = count($allPhotos);
	$picNum = mt_rand(0, ($picCount - 1));
	//echo $allPhotos[$picNum];
	$photoFile = $photoDir .$allPhotos[$picNum];
	$randomImgHTML = '<img src="' .$photoFile .'" alt="TLÜ Terra õppehoone">';
	
	//lisame lehe päise
	
	/*setlocale(LC_TIME, "et_EE");
	echo strftime("Eesti keeles: %A,");*/
	  
	  if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}
	  
		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}
	  
		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}
	  }
	
	
	require("header.php");
?>


<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML;
  ?>
  
  <hr>
  <p>Lehe avamise hetkel oli aeg: 
  <?php
    //echo $fullTimeNow;
	echo $weekdayNamesET[$weekdayNow - 1] .", " .$dateNow .". " .$monthNamesET[$monthNow - 1] ." " .$yearNow ." kell " .$timeNow;
  ?>
  .</p>
  <?php
    echo "<p>Lehe avamise hetkel oli " .$partOfDay .".</p>";
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
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
	<h2>Loo kasutaja</h2>
	<p>Loo endale meie lehe <a href="newuser.php">kasutajakonto</a></p>
  <hr>
  <?php
    echo $randomImgHTML;
  ?>
</body>
</html>





