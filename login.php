<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>


<?php
	
	if (logged_in()) {
		redirect_to("index.php");
	}

	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['login'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('userName', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('userName' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['userName']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		
		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT userId, userName ";
			$query .= "FROM customerlogin ";
			$query .= "WHERE userName = '{$username}' ";
			$query .= "AND password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_id'] = $found_user['userId'];
				$_SESSION['username'] = $found_user['userName'];
				
				redirect_to("index.php");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
		$username = "";
		$password = "";
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" href="css/registerLogin.css" media="screen" type="text/css" />
<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
<script type="text/javascript" src="javascript/login-form-validation.js"></script>


</head>
<body>
<div id="header">
	<table width=100% align="center">
    	<tr> 
        	<td><a href="index.php"><img src="images/image.png" id="logoImg"/></a> </td>
            <td  align="right"><?php if(!logged_in()){?> <a href="login.php" class="btn">LOGIN/REGISTER</a><?php }else{?>
            <a href="logout.php" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;LOG OUT&nbsp;&nbsp;&nbsp;&nbsp;</a></td><?php }?></td>
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

<div id="content">      
<div id="login">
<div id="triangle"></div>
  <h1>Log in</h1>
  <form action="#" method="post" name="loginForm" onsubmit="return formValidation();" >
     <input type="text" placeholder="User Name" name="userName" />
     <input type="password" placeholder="Password" name="password" />
     <input type="submit" name="login" value="Log in" />
     <p align="right" ><a href="register.php" class="registerLogon">&lt;&lt;Register Here &gt;&gt;</a></p>
   </form>
</div>
</div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>
</body>
</html>
<?php
	// Close connection
	mysql_close($connection);
?>