<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['save'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data		
		$required_fields = array('userName', 'password','cpassword');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('userName' => 30, 'password' => 30,'cpassword'=>30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
		

		$username = trim(mysql_prep($_POST['userName']));
		$password = trim(mysql_prep($_POST['password']));
		$cpassword = trim(mysql_prep($_POST['cpassword']));
		$hashed_password = sha1($password);
		$result="";
		$message="";
		
		
		//checks whether userName and password in the Database or not	
		$sql="select *  from adminlogin where  userName='{$username}' and password='{$hashed_password}'";
		$cp = mysql_query($sql,$connection) or die(mysql_error());
		if (mysql_affected_rows() == 1) {
			$message .= "The user Name is already exists<br/>";
			echo $message;
			$errors=array('User Name');
		}
		

		if (empty($errors)) {
						
			if($password==$cpassword)
			{
				$hashed_password = sha1($password);
			
				$query = "INSERT INTO adminlogin (
								userName, password
							) VALUES (
								'{$username}', '{$hashed_password}'
							)";
							
				$result = mysql_query($query, $connection);
				
			}
			else{
				
				$message .= "Password and confirm Password Combination is not correct.";
				
				$message .="<br />" ;
			}
				if ($result) {
					$message .= "The user was successfully created.";
				} else {
					$message .= "The user could not be created.";
					$message .= "<br />" . mysql_error();
				}
			} else {
				if (count($errors) == 1) {
					$message .= "There was 1 error in the form.";
				} else {
					$message .= "There were " . count($errors) . " errors in the form.";
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
<script type="text/javascript" src="javascript/createUser-form-validation.js"></script>


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
        	<li><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
            <li><a href="addCategory.php">ADD CATEGORY</a></li>
            <li><a href="subCategory.php">ADD SUBCATEGORY</a></li>
            <li><a href="addProducts.php">ADD PRODUCTS</a></li>
        </ul>
    </li>
    <li><a href="order.php">ORDER</a></li>
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
        
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form id="form_960580" class="appnitro" enctype="multipart/form-data" method="post" name="createUser" action="createUser.php" onSubmit="return formValidation();">
		<div class="form_description">
			<h2>Admin login/password</h2>
			<p>create administrator login and password</p>
		</div>						
			<ul>	
	
        <li id="li_1" >
		<label class="description" for="userName">User Name</label>
		<div>
			<input id="element_1" name="userName" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>

         <li id="li_1" >
		<label class="description" for="password">Passowrd</label>
		<div>
			<input id="element_1" name="password" class="element text large" type="password" maxlength="255" value=""/> 
		</div> 
		</li>	
         <li id="li_1" >
		<label class="description" for="cpassword">Confirm Password</label>
		<div>
			<input id="element_1" name="cpassword" class="element text large" type="password" maxlength="255" value=""/> 
		</div> 
		</li>		
		<li class="buttons">
			 <input id="saveForm" class="button_text searchButton" type="submit" name="save" value="SAVE"/>
		</li>
			</ul>
		</form>	
        
        <div id="footer"></div>

	</div>


    
  </div>  <!-- End Of The Content--> 

<!--<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>-->

</body>