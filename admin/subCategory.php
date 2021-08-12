<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>

<?php 

if(isset($_POST["save"]))
{
		include_once("includes/form_functions.php");
	
		$errors = array();
		$message="";
		
		// perform validations on the form data
		$required_fields = array('categoryId', 'subcategoryName');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
		$fields_with_lengths = array('categoryId' => 80,'subcategoryName' => 80);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
		
		
		//This is only for the error of the category select Default values
		foreach($required_fields as $fieldname) {
			if ($_POST[$fieldname] =='Default') { 
				$errors[] = $fieldname; 
			}
		}
		

		$categoryId = trim(mysql_prep($_POST['categoryId']));
		$subcategoryName = strtoupper(trim(mysql_prep($_POST['subcategoryName'])));
		
		//Do later subcategory under category 
		$sql="select *  from subcategory where subcategoryName='{$subcategoryName}'  && categoryId='{$categoryId}'";
		$cp = mysql_query($sql,$connection) or die(mysql_error());
		if (mysql_affected_rows() == 1) {
			$message = "The Subategory is already exists<br/>";
			$errors=array('subcategoryName');
		}
		
		
	
			// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {	
			
			$query = "INSERT INTO subcategory (
					categoryId,subcategoryName
				) VALUES (
					'{$categoryId}','{$subcategoryName}'
				)";
			$result = mysql_query($query, $connection);
			if ($result) {
				// Success!
				$message .= "The subcategory was successfully saved";
			} else {
				// Display error message.
				$message .= "subcategory creation failed";
				$message .= "<p>" . mysql_error() . "</p>";
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
<script type="text/javascript" src="javascript/subcategory-form-validation.js"></script>
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
        	<li ><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
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
		<form  class="appnitro" enctype="multipart/form-data" method="post" name="subcategory" action="subCategory.php"  onSubmit="return formValidation();" >
		<div class="form_description">
			<h2>Subcategory</h2>
			<p>Enter The Subcategory</p>
		</div>						
		<ul>	            
        <li>
		<label class="description" for="categoryId">Category Name </label>
		<div>
		<select class="element select large"  name="categoryId" > 
            <option value="Default" selected="selected">--- Please select a category ---</option>
            
                 <?php
				  $sql="select * from category";
				  $pq = mysql_query($sql,$connection) or die(mysql_error());
				  while ($row=mysql_fetch_array($pq))
				  {
						echo "<option value=\" {$row["categoryId"]}\"> {$row["categoryName"]} </option>";
				  }
                ?>

		</select>
		</div> 
		</li>
	
        <li >
		<label class="description" for="subcategoryName">Subcategory Name</label>
		<div>
			<input  name="subcategoryName" class="element text large" type="text" maxlength="255"  value=""/> 
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

</body>
</html>
<?php mysql_close($connection); ?>