<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['save'])) { // Form has been submitted.
		$errors = array();
		
		/*
		// perform validations on the form data
		$required_fields = array('userName', 'npassword','currentPassword');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('userName' => 30, 'npassword' => 30, 'currentPassword' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
		
		*/
		$username = trim(mysql_prep($_POST['userName']));
		$password = trim(mysql_prep($_POST['npassword']));
		$currentPassword = trim(mysql_prep($_POST['currentPassword']));
		$confirmPassword = trim(mysql_prep($_POST['confirmPassword']));
		$hashed_password = sha1($password);
		$current_hashed_password = sha1($currentPassword);
		
		
		$adminId=0;

		if ( empty($errors) ) {
			
			if($password==$confirmPassword){
			
			$query = "SELECT adminId
						FROM adminlogin 
						WHERE userName = '{$username}' && password='{$current_hashed_password}'";
			$adminRow = mysql_query($query, $connection);
			confirm_query($adminRow);
			
			$adminId = mysql_fetch_array($adminRow);
		}

			if (mysql_affected_rows() == 1) {
			$query = "UPDATE  adminlogin SET 
							username = '{$username}',
							password='{$hashed_password}'
							WHERE adminId = {$adminId['adminId']}";
	

			$result = mysql_query($query, $connection);
			}
			
		
			
			else{
				
					$message = "The password update failed.";
					$message .= "<br />". mysql_error();
				
			}
			if (mysql_affected_rows() == 1) {
					// Success
					$message = "The password was successfully updated.";
				} else {
					// Failed
					$message = "The password update failed.";
					$message .= "<br />". mysql_error();
				}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	} else { // Form has not been submitted.
		$username = "";
		$password = "";
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
<script type="text/javascript" src="javascript/changePassword-form-validation.js"></script>


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
    <li id="current"><a href="home.php">CATALOGUE</a>
        <ul id="submenu">
        	<li ><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
            <li><a href="addCategory.php">ADD CATEGORY</a></li>
            <li><a href="subCategory.php">ADD SUBCATEGORY</a></li>
            <li><a href="addProducts.php">ADD PRODUCTS</a></li>
        </ul>
    </li><li><a href="order.php">ORDER</a>

    </li>
    <li id="current"><a href="createUser.php" class="selected">CONFIGURATION</a>
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
    
    	 <div id="top">&nbsp;</div>
	<div id="form_container">
	
		<h1><a>Product Details</a></h1>
		<form id="form_960580" class="appnitro" enctype="multipart/form-data" method="post" action="#" name="changePassword" onSubmit="return formValidation();">
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<div class="form_description">
			<h2>Admin login/password</h2>
			<p>Change administrator login and password</p>
		</div>						
			<ul>	
	
        <li>
		<label class="description" for="userName">User Name</label>
		<div>
			<input  name="userName" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
         <li>
		<label class="description" for="currentPassword">Current Password</label>
		<div>
			<input  name="currentPassword" class="element text large" type="password" maxlength="255" value=""/> 
		</div> 
		</li>	
         <li >
		<label class="description" for="npassword">New Passowrd</label>
		<div>
			<input  name="npassword" class="element text large" type="password" maxlength="255" value=""/> 
		</div> 
		</li>	
         <li>
		<label class="description" for="confirmPassword">Confirm New Password</label>
		<div>
			<input name="confirmPassword" class="element text large" type="password" maxlength="255" value=""/> 
		</div> 
		</li>		
		<li class="buttons">
			 <input type="hidden" name="form_id" value="960580" />
			 <input id="saveForm" class="button_text searchButton" type="submit" name="save" value="SAVE"/>
		</li>
			</ul>
		</form>	
        
         <div id="footer"></div>

	</div>
	""

    
  </div>  <!-- End Of The Content--> 

<!--<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>-->

</body>