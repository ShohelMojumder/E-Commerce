<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include_once("includes/form_functions.php");?>
<?php include_once("includes/admin_functions.php");?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['save'])) {

	   $query = "select * from auxilary";
	   $auxilary_details = mysql_query($query,$connection) or die( mysql_error());
		  
	   $auxilary_fields = mysql_fetch_array($auxilary_details);
		
		if ($auxilary_fields['auxId'] == 1) {				
			$errors = array();
	
		// perform validations on the form data
		$required_fields = array('about', 'shipping');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
		// clean up the form data before putting it in the database
		$aboutUsContent =  trim(mysql_prep($_POST['about']));
		$deliveryContent = trim(mysql_prep($_POST['shipping']));
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = 	"UPDATE auxilary SET 
							aboutUsContent = '{$aboutUsContent}',
							deliveryContent = '{$deliveryContent}'
						WHERE auxId = 1";
			$result = mysql_query($query,$connection)or die( $query.mysql_error());
			// test to see if the update occurred
			if (mysql_affected_rows() == 1) {
				// Success!
				$message = "The page was successfully updated.";
			} else {
				$message = "The page could not be updated.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
			}
		
		
		else{
			
		$errors = array();
	
		// perform validations on the form data
		$required_fields = array('about', 'shipping');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
		
		// clean up the form data before putting it in the database
		$aboutUsContent =  trim(mysql_prep($_POST['about']));
		$deliveryContent = trim(mysql_prep($_POST['shipping']));

	
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = "INSERT INTO auxilary (
						auxId,aboutUsContent, deliveryContent
					) VALUES (
						1, '{$aboutUsContent}','{$deliveryContent}'
					)";
			if ($result = mysql_query($query, $connection)) {
				// as is, $message will still be discarded on the redirect
				$message = "The content was successfully saved.";
				// get the last id inserted over the current db connection

			} else {
				$message = "The content was not successfully saved.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		// END FORM PROCESSING
		
		}
}
?>


<?php
	if (!isset($_POST['save'])) {
		$auxilary_details=get_auxilary_details(1);
		$auxilary_fields = mysql_fetch_array($auxilary_details);
		$aboutUsContent=$auxilary_fields["aboutUsContent"];
		$deliveryContent=$auxilary_fields["deliveryContent"];
	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/view.css">
<script type="text/javascript" src="javascript/view.js"></script>
<script type="text/javascript" src="javascript/auxilary-form-validation.js"></script>

</head>
<body>
<div id="header">
	<table width=100%>
    	<tr> 
        	<td><a href="home.php"><img src="images/image.png" id="logoImg"/></a> </td>
        </tr>
     </table>
    
<div id="button">
<div class="css_menu_two_line">
<ul class="two_line_menu">
    <li><a href="home.php">CATALOGUE</a>
        <ul>
        	<li ><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
            <li><a href="addCategory.php">ADD CATEGORY</a></li>
            <li><a href="subCategory.php">ADD SUBCATEGORY</a></li>
            <li><a href="addProducts.php">ADD PRODUCTS</a></li>
        </ul>
    </li><li><a href="order.php">ORDER</a>

    </li><li id="current"><a href="createUser.php" class="selected">CONFIGURATION</a>
       <ul id="submenu">
            <li><a href="createUser.php">ADD USER</a></li>
            <li><a href="changePassword.php">Admin login/password</a></li>
            <li><a href="auxilary.php">AUXILARY INFORMATION</a></li>
        </ul>
    </li>
    
    <li><a href="logout.php">LOGOUT</a> </li>
   </ul>
   </div>
        
</div></div>

	<div id="content">
    
    <div id="top"></div>
    
	<div id="form_container">
	
		<h1><a>Product Details</a></h1>
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form  class="appnitro" enctype="multipart/form-data" method="post" action="auxilary.php" name="auxilary"  onSubmit="return formValidation();">
		<div class="form_description">
			<h2>AUXILARY INFORMATION</h2>
			<p>Enter The Auxilary Information</p>
		</div>						
			<ul>

        <li>
		<label class="description"  for="about">ABOUT US</label>
		<div>
			<textarea name="about" class="element textarea large" cols="80" rows="20"><?php echo htmlentities($aboutUsContent); ?></textarea> 
		</div> 
		</li> 
         <li>
		<label class="description"   for="shipping" >SHIPPING & DELIVERY</label>
		<div>
			<textarea  name="shipping" class="element textarea large" cols="80" rows="20"><?php echo htmlentities($deliveryContent); ?></textarea> 
		</div> 
		</li>

			
		<li class="buttons">					    
			<input id="saveForm" class="button_text searchButton" type="submit" name="save" value="SAVE"/>
		</li>
			</ul>
		</form>
        
        <div id="footer"></div>	

	</div>
	""

    
  </div>  <!-- End Of The Content--> 

</body>