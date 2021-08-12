<?php
	
	require_once("includes/connection.php"); 
	require_once("includes/functions.php");
 	require_once("includes/front_functions.php");
	$msg="";
	if(isset($_REQUEST['command'])){
		if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
			remove_product($_REQUEST['pid']);
		}
		else if($_REQUEST['command']=='clear'){
			unset($_SESSION['cart']);
		}
		else if($_REQUEST['command']=='update'){
			
			$q=0;
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
		
					$q=intval(trim($_POST["names"][$i]));
		
				if($q>0 && $q<=999){
					
					$_SESSION['cart'][$i]['qty']=$q;
				}
				else{
							$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
				}
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
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
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
	<div id="content" align="center">
    
    
    <form name="form1" action="shoppingCart.php" method="post">
    <input type="hidden" name="pid" />
    <input type="hidden" name="command" />
	<div style="margin:0px auto; width:600px;" >
    <div style="padding-bottom:10px">
    	<h1 align="center" class="shopCart">Your Shopping Cart</h1>
    <input type="button" value="Continue Shopping" onclick="window.location='index.php'" class="searchButton" />
    </div>
    	<div style="color:#F00"><?php echo $msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
    	<?php
			if(isset($_SESSION['cart'])){
			if(is_array($_SESSION['cart'])){
            	echo '<tr class="cartHead"><td>Serial</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF"><td><?php echo $i+1?></td><td><?php echo $pname?></td>
                    <td>BDT,<?php echo get_price($pid)?></td>
                    <td><input type="text" name="names[]" value="<?php echo $q?>" maxlength="3" size="2" /></td>                    
                    <td>BDT,<?php echo get_price($pid)*$q?></td>
                    <td><a href="javascript:del(<?php echo $pid?>)" class="removeCart">Remove</a></td></tr>
            <?php					
				}
				}
			
			?>
				<tr><td class="orderTotalCart"><b>Order Total: BDT,<?php echo get_order_total()?></b></td><td colspan="5" align="right"><input type="button" value="Clear Cart" onclick="clear_cart()" class="searchButton"><input type="button" value="Update Cart" onclick="update_cart()" class="searchButton"><input type="button" value="Place Order" onclick="window.location='checkout.php'" class="searchButton"></td></tr>
			<?php
            }
			else{
				echo "<tr bgColor='#FFFFFF' class=\"noOrder\"><td>There are no items in your shopping cart!</td>";
			}
			
		?>
        </table>
    </div>
</form>
    
    
  </div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>

</body>
</html>
<?php
	// Close connection
	mysql_close($connection);
?>