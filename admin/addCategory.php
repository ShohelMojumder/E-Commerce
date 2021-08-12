<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if (isset($_POST['save'])) {
	include_once("includes/form_functions.php");
	$errors = array();
	$message="";

	// perform validations on the form data
	$required_fields = array('categoryName');
	$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
	
	$fields_with_lengths = array('categoryName' => 80);
	$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));


	$categoryName = strtoupper(trim(mysql_prep($_POST['categoryName'])));
	
	$sql="select *  from category where categoryName='{$categoryName}'";
	$cp = mysql_query($sql,$connection) or die(mysql_error());
	if (mysql_affected_rows() == 1) {
	$message = "The Category is already exists<br/>";
	$errors=array('categoryName');
	}
	  


	if (empty($errors)) {
	$query = "INSERT INTO category (
				categoryName
			) VALUES (
				'{$categoryName}'
			)";
	$result = mysql_query($query, $connection);
		if ($result) {
			// Success!
			$message = "The Category was successfully saved";
		} else {
			// Display error message.
			$message="Category save failed.";
			echo "<p>" . mysql_error() . "</p>";
		}
	}
	else {
		if (count($errors) == 1) {
			$message .= "There was 1 error in the form.";
		} else {
			$message .= "There were " . count($errors) . " errors in the form.";
		}
	}
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
<script type="text/javascript" src="javascript/category-form-validation.js"></script> 
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
    <li id="current"><a href="home.php" class="selected">CATALOGUE</a>
        <ul id="submenu">
        	<li><a href="viewProducts.php">CATEGORY&PRODUCTS</a></li>
            <li><a href="addCategory.php">ADD CATEGORY</a></li>
            <li><a href="subCategory.php">ADD SUBCATEGORY</a></li>
            <li><a href="addProducts.php">ADD PRODUCTS</a></li>
        </ul>
    </li><li><a href="order.php">ORDER</a>

    </li><li><a href="createUser.php">CONFIGURATION</a>
        <ul>
            <li><a href="creatUser.php">ADD USER</a></li>
            <li><a href="changePassword.php">Admin login/password</a></li>
            <li><a href="auxilary.php">AUXILARY INFORMATION</a></li>

        </ul>
    </li>
    
    <li ><a href="logout.php" id="log" >LOGOUT</a> </li>
   </ul>
   </div>
        
</div></div>

	<div id="content">
    
        <div id="top">&nbsp;</div>
		<div id="form_container">
	
		<h1><a>Category</a></h1>
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form  class="appnitro" enctype="multipart/form-data" method="post" action="addCategory.php" name="category"  onSubmit="return formValidation();">
		<div class="form_description">
			<h2>Category</h2>
			<p>Enter The Category</p>
		</div>						
			<ul>	
	
        <li >
		<label class="description" for="categoryName">Category Name</label>
		<div>
			<input  name="categoryName" class="element text large" type="text" maxlength="255" value=""/> 
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
</html>
<?php mysql_close($connection); ?>

