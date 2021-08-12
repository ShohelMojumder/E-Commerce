<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>
<body>


<div id="header">
	<table width=100% align="center">
    	<tr> 
        	<td><a href="index.php"><img src="images/image.png" id="logoImg"/></a> </td>
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