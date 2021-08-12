<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php"); ?>

<?php
		if(isset($_GET['productId']) && isset($_GET['command'])){
			
			if($_GET['productId']>0){
				$pid=$_GET['productId'];
				addtocart($pid,1);
				header("location:index.php");
				exit();
			}
		}
?>
   
<?php require_once("includes/front_header.php"); ?>
	<div id="content" align="center">
        
         <span class="contentSpan">
        	Featured Product
         </span>
        <div id="thumbContainer">
      
         <?php
				$outputFrontShow=front_products_show();
				if (!empty($outputFrontShow)) {
					echo $outputFrontShow;
				}
		 ?>
        
      </div>  <!-- End Of The content Container-->     
  </div>  <!-- End Of The Content--> 
<?php require_once("includes/front_footer.php"); ?>