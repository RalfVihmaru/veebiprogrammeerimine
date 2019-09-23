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