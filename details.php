<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>

<?php
		if(isset($_GET['productId']) && isset($_GET['command'])){
			
			if($_GET['productId']>0){
				$pid=$_GET['productId'];
				addtocart($pid,1);
				
				if(isset($_GET["productId"])){
					$url="details.php?productId={$_GET["productId"]}";
					header("location:$url");
					exit();
				}

			}
		}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();		
	}
	
	
	function swipe() {
   		var largeImage = document.getElementById('largeImage');
		var win = "width="+900+",height="+680+",menubar=no,location=no,resizable=yes,scrollbars=yes";
    	anchorImage.setAttribute("href", "#");
   		var url=largeImage.getAttribute('src');
		window.open(url,'Image',win);
	}
</script>

<link href="css/zoomIt-gallery.css" rel="stylesheet" type="text/css">

<script src="javascript/jquery-v1.7.2.js"></script>
<script src="javascript/jquery-ui-1.8.12.custom.min.js"></script>

<script src="javascript/zoomit.jquery.js"></script>
<script src="javascript/gallery.js"></script>
</head>
<body>

<form name="form1">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div id="header">
	<table width=100% align="center">
    	<tr>
        	<td><a href="index.php"><img src="images/image.png" height="35" width="200" align="left"/></a> </td>
            <td align="center">
              
            <form action="productList.php" method="post">
                     <input type="text" placeholder="Search..." required class="search" name="searchVal">
                     <span class="searchArrow">
                     <input type="submit" value="Search" class="searchButton" name="search">
                     </span>
                </form>
                
            </td>
            <td  align="right"><?php if(!logged_in()){?> <a href="login.php" class="btn">LOGIN/REGISTER</a><?php }else{?>
            <a href="logout.php" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;LOGOUT&nbsp;&nbsp;&nbsp;&nbsp;</a></td><?php }?></td>
        </tr>
     </table>
    
         <div id="button">
            <a href="index.php" class="btn">HOME</a>
            <a href="priceList.php" class="btn">PRICE LIST</a>
            <a href="delivery.php" class="btn">DELIVERY</a>
            <a href="aboutUs.php" class="btn">ABOUTUS</a>
        </div>
        
</div>


    

	<div id="navMain">
		<div id="nav">
        	<div align="center" id="navHead">
            	<a href="index.php">Products Category</a>
             </div>
         <?php
		 //This is the function for the navigation menu
			$output=navigationMenu();
			if (!empty($output)) {
				echo $output;
			}
			?>
        </div>
   <?php if(isset($_SESSION['cart'])){$payableAmount=get_payableAmount();}?>
        <?php	
			if(isset($_SESSION['cart'])){
				$q=get_quantity();
			}
		?>
    	<div id="navBelow">
        	<div align="center" id="navBelowHead">
            	<a href="shoppingCart.php">My Shopping Cart</a>
            </div>
            <p align="center">
            <br/>
             <?php if(isset($q)) echo $q; else{ echo 0;}?> Items:
             <br/>	
             BDT, <?php if(isset($payableAmount)) echo $payableAmount; else{ echo 0;}?>
            </p>
        	<a href="shoppingCart.php"  class="btnProceed" id="proceed">
            	PROCEED TO CHECKOUT
            </a>    
        </div> 
    </div>
    


    
    	
	<div id="content" align="center">
    
        <?php

			
			if(isset($_GET["productId"]))
		 	{
				$productId=$_GET["productId"];		
				
				$products_info = get_products_details_for_productId($productId);
				while ($products = mysql_fetch_array($products_info)) {	
					
					$categoryName=$products["categoryName"];
					$subcategoryName=$products["subcategoryName"];
					$productName=$products["productName"];
					$price=$products["price"];
					
					$discount=$products["discount"];
					$actualPrice=$products["actualPrice"];
					$description=$products["description"];
					$photo=$products["photo"];
				
		   }
		
	?>
      
         <span class="contentSpan">
        	<?php echo $subcategoryName; ?>
         </span>
        <div id="thumbContainer">
        <div class="thumbsDetails">
                        
       	 
                    <a href="admin/productsImages/<?php echo $photo; ?>" id="anchorImage"class="zoomIt visible" onClick="swipe();"><img src="admin/productsImages/<?php echo $photo; ?>" id="largeImage" class="imgClass"/></a>
                        <p>
                        <span id="photoCartDetails">
                           <?php echo $productName ?><br/>
                           Price:BDT,<?php echo $price ?><br/>
                            
                        </span>
                        <br/>
                        <a href='details.php?productId=<?php echo $productId ?> &command=add'  class="button" id="detailsCart">AddToCart</a>
                        </p> 
        </div>	<!-- End Of The Thumbs Details-->
        
      
        	<h3> The <?php if(isset($productName)){echo htmlentities($productName);}?> Details </h3>
             <p class="detailsData"><br/>
        	Category : <?php if(isset($categoryName)){echo htmlentities($categoryName);}?><br/>
            ProductName :  <?php if(isset($productName)){echo htmlentities($productName);} ?><br/>
            Price  :  BDT, <?php if(isset($price)){echo htmlentities($price);}?><br/>
            Discount  : <?php if(isset($discount)){echo htmlentities($discount);} ?>%<br/>
            Actual Price:BDT ,<?php if(isset($actualPrice)){echo htmlentities($actualPrice);} ?>
            </p>
            <h3 id="descHead">Description</h3>
            <p id="description"><?php if(isset($description)){echo htmlentities($description);}?></p>
           <?php } ?> 
           
      </div>  <!-- End Of The content Container--> 

    
    
  </div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>

</body>
</html>
<?php
	// Close connection
	mysql_close($connection);
?>