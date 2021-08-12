<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>
<?php
	include_once("includes/form_functions.php");

	if(isset($_POST['save'])){
		
		
		$errors = array();
		
		// perform validations on the form data
		$required_fields = array('firstName','lastName','address','city','zip','phoneNumber','email');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('firstName' => 30,'lastName' => 30,'address' => 250, 'city'=>30, 'zip' => 30,'phoneNumber'=>30,'email'=>30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

	
		$firsName=trim(mysql_prep($_POST['firstName']));
		$lastName=trim(mysql_prep($_POST['lastName']));
		$address=trim(mysql_prep($_POST['address']));
		$city=trim(mysql_prep($_POST['city']));
		$zip=trim(mysql_prep($_POST['zip']));
		$phoneNumber=trim(mysql_prep($_POST['phoneNumber']));
		$email=trim(mysql_prep($_POST['email']));
		$payableAmount=0;
		
		if (empty($errors) ){
						
			$query="insert into customers values('','$firsName','$lastName','$address','$city','$zip','$phoneNumber','$email')";		
			$result=mysql_query($query,$connection);
			$customerId=mysql_insert_id();
		
			date_default_timezone_set("Asia/Dhaka");
			$date=date('Y-m-d h:i:s');
			$totalAmount=get_order_total();
			$payableAmount=get_payableAmount();
			$discountAmount=get_discountAmount();
			$discountPercent=get_discountPercent();
			echo "The payable amount is {$payableAmount} ";
			echo "The discountPercent amount is {$discountPercent} ";

		$sql="insert into orders (
				customerId,orderDate,totalAmount,discountPercent,discountAmount,payableAmount
					)values(              																																																									
				{$customerId},'{$date}',{$totalAmount},{$discountPercent},{$discountAmount},{$payableAmount}
				)";
		                        																																									
		$result=mysql_query($sql,$connection) or die(mysql_error());
		
		$orderid=mysql_insert_id();

		
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			mysql_query("insert into orderdetails values ('',$orderid,$pid,$q,$price)",$connection)or die(mysql_error());
		}
		
		if ($result) {
		// Success!
		redirect_to("orderCompleted.php");
		} else {
			// Display error message.
			echo $query;
			echo "<p>Checkout failed some error occur.</p>";
			echo "<p>" . mysql_error() . "</p>";	
	  	}
	 }
  }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/mystyle.css" />
<script type="text/javascript" src="javascript/checkout-form-validation.js"></script>


</head>
<body>
<div id="header">
	<table width=100% align="center">
    	<tr>
        	<td><a href="index.php"><img src="images/image.png" height="35" width="200" align="left"/></a></td>
           
    
            
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
		<!--  <a href="shoppingCart.php"  class="btnProceed" id="proceed">
            	PROCEED TO CHECKOUT
            </a>  -->   
        </div> 
    </div>

<div id="checkOutContent">
  
      
    <form action="checkout.php"  method="post" class="group" name="checkOut"   onSubmit="return formValidation();" >
        <ol>
            <li class="group">
                <span>First Name</span>
                <input type="text" name="firstName" id="firstNameField" />
            </li>
            <li class="group">
                <span>Last Name</span>
                <input type="text" name="lastName" id="lastNameField" />
            </li>
            
                <li class="group">
                <span>Address</span>
                <input type="text" name="address" id="addressField" />
            </li>
            
             <li class="group">
                <span>City</span>
                <input type="text" name="city" id="cityField" />
            </li>
            
             <li class="group">
                <span>Zip Code</span>
                <input type="text" name="zip" id="postalField" />
            </li>
            
            
            <li class="group">
                <span>Phone Number</span>
                <input type="text" name="phoneNumber" id="phoneNumberField" />
            </li>
    
    
            <li class="group">
                <span>Email Address</span>
                <input type="text" name="email" id="emailField" />
            </li>
    
        </ol>
        
       		
            <button type="submit" name="save">Place Order</button>
            <button type="button" id="backButton" ><a href="index.php" id="backAnchor">Back</a></button>
            
    </form>
    
  </div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>

</body>
</html>
<?php
	// Close connection
	mysql_close($connection);
?>