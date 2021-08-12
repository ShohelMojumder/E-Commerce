<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php

	if (logged_in()) {
		redirect_to("home.php");
	}
	

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
			$query = "SELECT adminId, userName ";
			$query .= "FROM adminlogin ";
			$query .= "WHERE userName = '{$username}' ";
			$query .= "AND password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_id'] = $found_user['adminId'];
				$_SESSION['userName'] = $found_user['userName'];
				
				redirect_to("home.php");
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/view.css">
<script type="text/javascript" src="javascript/view.js"></script>
<script type="text/javascript" src="javascript/login-form-validation.js"></script>
</head>
<body>
<div id="header">
	<table width=100%>
    	<tr> 
        	<td><a href="#"><img src="images/image.png" id="logoImg"/></a> </td>
        </tr>
     </table>       
</div></div>

	<div id="content">
    <a href="../index.php" id="adminAnchor">Return to the frontEnd ......</a>
    	<div id="top"></div>
         
	<div id="form_container">
	
		<h1><a>Product Details</a></h1>
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form  class="appnitro" enctype="multipart/form-data" method="post" action="index.php" name="adminLogin" onSubmit="return formValidation();">
		<div class="form_description">
			<h2>Admin login/password</h2>
			<p>Insert UserName and Password to Login</p>
		</div>						
			<ul>		
        <li>
		<label class="description" for="userName">User Name</label>
		<div>
			<input  name="userName" class="element text large" type="text" maxlength="255" value="<?php echo htmlentities($username); ?>" /> 
		</div> 
		</li>
         <li>
		<label class="description" for="password">Your Password</label>
		<div>
			<input  name="password" class="element text large" type="password" maxlength="255" value="<?php echo htmlentities($password); ?>"/> 
		</div> 
		</li>	
	
		<li class="buttons">
			
			 <input id="saveForm" class="button_text searchButton" type="submit" name="login" value="LOGIN"/>
		</li>
			</ul>
		</form>	
        
         <div id="footer"></div>

	</div>
	

   
  </div>  <!-- End Of The Content--> 


</body>
</html>
<?php mysql_close($connection); ?>
