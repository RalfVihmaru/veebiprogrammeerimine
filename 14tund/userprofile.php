<?php
  require("../../../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_ralf_vi_1";
  
      //SESSIOON
  require("classes/Session.class.php");
  //sessioon, mis katkeb, kui brauser suletakse ja on kättasaadav ainult meie domeenis, meie lehel
  SessionManager::sessionStart("VP", 0, "/~ralfvih/", "greeny.cs.tlu.ee");
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userID"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $myDescription = null;
  
  if(isset($_POST["submitProfile"])){
	$notice = storeUserProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
	if(!empty($_POST["description"])){
	  $myDescription = $_POST["description"];
	}
	$_SESSION["bgColor"] = $_POST["bgcolor"];
	$_SESSION["txtColor"] = $_POST["txtcolor"];
  } else {
	$myProfileDesc = showMyDesc();
	if(!empty($myProfileDesc)){
	  $myDescription = $myProfileDesc;
    }
  }
  
  //parooli muutus
  $passwordError = null;
  $oldpasswordError = null;
  $confirmpasswordError = null;
  $passwordNotice = null;
  if(isset($_POST["submitPassword"])){
	  if (!isset($_POST["oldpassword"]) or strlen($_POST["oldpassword"]) < 8){
		  $oldpasswordError = "Palun sisesta parool, vähemalt 8 märki!";
	  }
	  //parool ja selle kaks korda sisestamine
	  if (!isset($_POST["password"]) or empty($_POST["password"])){
		$passwordError = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["password"]) < 8){
			  $passwordError = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["password"]) ." märki).";
		  }
	  }
	  
	  if (!isset($_POST["confirmpassword"]) or empty($_POST["confirmpassword"])){
		$confirmpasswordError = "Palun sisestage salasõna kaks korda!";  
	  } else {
		  if($_POST["confirmpassword"] != $_POST["password"]){
			  $confirmpasswordError = "Sisestatud salasõnad ei olnud ühesugused!";
		  }
	  }
	  //kui vigu pole, salvestan uue parooli
	  if(empty($oldpasswordError) and empty($passwordError) and empty($confirmpasswordError)){
		  $passwordNotice = updatePassword($_POST["oldpassword"], $_POST["password"]);
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
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description" placeholder="Lisa siia oma tutvustus ..."><?php echo $myDescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"]; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"]; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
	</form>
	
	<br>
	<h2> parooli vahetamine</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label> Vana Salasõna :</label><br>
	  <input name="oldpassword" type="password"><span><?php echo $oldpasswordError; ?></span><br>
	  <label> Uus Salasõna (min 8 tähemärki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake uut salasõna:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	 
	  
	  <input name="submitPassword" type="submit" value="Salvesta uus parool"><span><?php echo $passwordNotice; ?></span>
	  </form>
  
</body>
</html>