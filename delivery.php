<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>

<?php require_once("includes/front_header.php"); ?>	
	<div id="content">
    	
         <div align="center">
         <span class="contentShipAbout">
        	SHIPPING AND DELIVERY
         </span>
         </div>
         <br/><br/>
    <?php
	//Shows the delivery content here
		$delivery=get_delivery();
		
		echo "<p class=\"aboutShip\">";
		echo $delivery;
		echo "</p>";	
	
	?>

  </div>  <!-- End Of The Content--> 
<?php require_once("includes/front_footer.php"); ?>