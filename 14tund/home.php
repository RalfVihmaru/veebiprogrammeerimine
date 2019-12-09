<?php
  require("../../../../../config_vp2019.php");
  require("functions_main.php");
  //require("functions_user.php");
  require("functions_news.php");
  $database = "if19_ralf_vi_1";
  
  //SESSIOON
  require("classes/Session.class.php");
  //sessioon, mis katkeb, kui brauser suletakse ja on kättasaadav ainult meie domeenis, meie lehel
  SessionManager::sessionStart("VP", 0, "/~ralfvih/", "greeny.cs.tlu.ee");
  
  //kui pole sisselogitud
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
  
  //tegeleme küpsistega (cookies)
  //Cookie peab olema enne <html> elementi
  //nimi [väärtus, aegumine, path ehk kataloog, domeen(domain), secure ehk kas HTTPS, http only - kindlasti üle veebi]
  setcookie("vpname", $_SESSION["userFirstname"] .$_SESSION["userLastname"], time() + (86400 * 30), "/~ralfvih/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
  
  if(isset($_COOKIE["vpname"])){
	  echo "Küpsisest selgus nimi: " .$_COOKIE["vpname"];
	  } else {
		  echo "Küpsiseid ei leitud!";
	  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
     $newsHTML = latestNews(5);
 
	require("header.php");
	
?>

<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
 <body>
   <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a></p>
  <ul>
    <li><a href="userprofile.php">Kasutajaprofiil</a></li>
	<li><a href="messages.php">Sõnumid</a></li>
	<li><a href="showfilminfo.php">Filmid</a></li>
	<li><a href="picupload.php">Piltide üleslaadimine</a>
	</li><li><a href="publicgallery.php">Avalike piltide galerii</a></li>
	<li><a href="addnews.php">Uudise lisamine</a></li>
	<li><a href="weights.php">Kaal</a></li>
  </ul>
  <hr>
  <?php
   echo $newsHTML;
  ?>
</body>
</html>
  
