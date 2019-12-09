<?php
  require("../../../../../config_vp2019.php");
  require("functions_main.php");
  //require("functions_user.php");
  //require("functions_message.php");
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
  $weightHTML = null;
  
  if(isset($_POST["submitWeight"])){
	  if(isset($_POST["weight"]) and !empty($_POST["weight"])){
	$notice = storeMessage(test_input($_POST["weight"]));	  
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
  <p><a href="?logout=1">Logi välja!</a>  
  <p>Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kaal</label><br>
	<input type="number" name="weight" value="75"  min="2" step=".1">
	  <br>
	  <input name="submitWeight" type="submit" value="Salvesta kaal"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised kaalud</h2>
	<?php
	echo $weightHTML;
	?>
  
</body>
</html>