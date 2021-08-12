<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>

<?php require_once("includes/front_header.php"); ?>
	<div id="content" align="center">
    
      <span class="contentShipAbout">
        	ABOUT US
       </span>
         <br/><br/>
    
      <?php
	  //Shows the aboutUs content here
		$about=get_about();
		echo "<p class=\"aboutShip\">";
		echo $about;
		echo "</p>";
		?>

		

  </div>  <!-- End Of The Content--> 

<?php require_once("includes/front_footer.php"); ?>