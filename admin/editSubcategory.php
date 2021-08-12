<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_functions.php") ?>
<?php include_once("includes/form_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	
	 $categoryName="";
	 $subcategoryName="";
	 $message="";
	 
	 if (isset($_GET['id'])&& $_POST['commandDel']=='deleteSubcategory') {	 
	 
			$id=$_GET['id'];
			$subcategoryFull=get_subcategory_details_for_subcategoryId($id);
			$subcategory_full_fields = mysql_fetch_array($subcategoryFull);
			$subcategoryName=$subcategory_full_fields["subcategoryName"];
			$categoryId=$subcategory_full_fields["categoryId"];
			
			
			//get the category name to delete
		  
		  $categoryNameSubArray=get_category_name($categoryId);
		  $categoryName = mysql_fetch_array($categoryNameSubArray);
		  $categoryName=$categoryName['categoryName'];
			
			$query = "DELETE FROM subcategory WHERE subcategoryId = {$id} ";
			$result = mysql_query($query, $connection) or die($query.mysql_error());
			
			if (mysql_affected_rows() >= 1) {
							
					$query = "DELETE FROM productsdescription WHERE subcategoryName = '{$subcategoryName}' && categoryName='{$categoryName}'";
					$result = mysql_query ($query,$connection) or die($query.mysql_error());
									
					if (mysql_affected_rows() >= 1) {
						//$message .="Successfully Deleted<br/>";
						redirect_to("viewProducts.php");
					}			
			}
			
			else {
			// Deletion failed
			$message .="subcategory deletion failed";
			$message .= "<p>" . mysql_error() . "</p>";
			}
						
	}

?>

<?php
		
		if (isset($_POST['update']) && isset($_GET['id'])) {
			
			$id=$_GET['id'];
			$errors = array();
			
				
		// perform validations on the form data
		$required_fields = array('categoryName', 'subcategoryName');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
		$fields_with_lengths = array('categoryName' => 80,'subcategoryName' => 80);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
		
		
		//This is only for the error of the category select Default values
		foreach($required_fields as $fieldname) {
			if ($_POST[$fieldname] =='Default') { 
				$errors[] = $fieldname; 
			}
		}
		
		$id=trim(mysql_prep($_GET['id']));
		$categoryIdUpdate = strtoupper(trim(mysql_prep($_POST['categoryName'])));
		$subcategoryNameUpdate =strtoupper(trim( mysql_prep($_POST['subcategoryName'])));
		
		
		$sql="select *  from subcategory where subcategoryName='{$subcategoryNameUpdate}'  && categoryId='{$categoryIdUpdate}'";
		$cp = mysql_query($sql,$connection) or die(mysql_error());
		if (mysql_affected_rows() == 1) {
			$message .= "The Subategory is already exists<br/>";
			$errors=array('subcategoryName');
		}
		
		
			
			if (empty($errors)) {
				// Perform Update					
			/*--------------------------update query to display--------------------------------------------------------------*/				
			   $query = "update subcategory set 
				categoryId = '{$categoryIdUpdate}', 
				subcategoryName = '{$subcategoryNameUpdate}'
				WHERE subcategoryId = {$id}";		

			  
		
			  $result = mysql_query($query, $connection) or die($query.mysql_error());
			  $categoryNameArrayUpdate=get_category_name($categoryIdUpdate);
			  $categoryNameUpdate = mysql_fetch_array($categoryNameArrayUpdate);
			  $categoryNameFinalUpdate=$categoryNameUpdate['categoryName'];

			  
			  
				if(mysql_affected_rows() == 1){ 
				 

					$query = "update productsdescription set 
					categoryName = '{$categoryNameFinalUpdate}', 
					subcategoryName = '{$subcategoryNameUpdate}'
					WHERE subcategoryName = '{$_SESSION['subcategoryName']}' && categoryName='{$_SESSION['categoryName']}'";
				   //WHERE subcategoryName = '{$subcategoryName}' && categoryName='{$categoryName}'";
					
			
					$result = mysql_query($query, $connection) or die($query.mysql_error());
					
					if ($result) {
						// Success!
						$message .= "The subcategory was successfully saved";
					} else {
						// Display error message.
						echo "<p>subcategory creation failed.</p>";
						echo "<p>" . mysql_error() . "</p>";
					}										
			  }
			  
		    }
			else {
			if (count($errors) == 1) {
				$message .= "There was 1 error in the form.";
			} else {
				$message .= "There were " . count($errors) . " errors in the form.";
			}
		}
			 
			 
			 
		} // end: if (isset($_POST['update']))

		
?>


<?php
 if(isset($_GET["subcategoryId"]))
 {
			
			global $categoryId;
			global $id;
			$id=$_GET["subcategoryId"];
			
			$subcategory_details=get_subcategory_details_for_subcategoryId($_GET["subcategoryId"]);
			$subcategory_fields = mysql_fetch_array($subcategory_details);
			$subcategoryName=$subcategory_fields["subcategoryName"];
			 $_SESSION['subcategoryName'] = $subcategoryName;	
			$categoryId=$subcategory_fields["categoryId"];
						
			 $sql="select  categoryName  from category where categoryId='{$categoryId}'";
			 $cp = mysql_query($sql,$connection) or die(mysql_error());
			 $rowCat=mysql_fetch_array($cp);
			 $categoryName=$rowCat["categoryName"];	
			 $_SESSION['categoryName'] = $categoryName;		
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
<script type="text/javascript" src="javascript/edit-subcategory-form-validation.js"></script>
<script language="javascript">
	function delete_category(){
		if(confirm('Do you really mean to delete this item')){
			document.subcategory.commandDel.value='deleteSubcategory';
			document.subcategory.submit();
		}
	}
</script>


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
    	<div id="top">&nbsp;</div>
	<div id="form_container">
	
		<h1><a>Product Details</a></h1>
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
	<form id="" class="appnitro" enctype="multipart/form-data" method="post" name="subcategory" action="editSubcategory.php?id=<?php echo $id; ?>"  onSubmit="return formValidation();" >
		<div class="form_description">
			<h2>Subcategory</h2>
			<p>Enter The Subcategory</p>
		</div>						
			<ul>	
            
         <li>
		<label class="description" for="categoryName">Category Name </label>
		<div>
		<select class="element select large"  name="categoryName" > 
            <option value="<?php echo $categoryId; ?>" selected="selected"><?php if(isset($categoryName)){echo htmlentities($categoryName);} ?></option>
            
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
	
        <li>
		<label class="description" for="subcategoryName">Subcategory Name</label>
		<div>
			<input  name="subcategoryName" class="element text large" type="text" maxlength="255" value="<?php if(isset($subcategoryName)){echo htmlentities($subcategoryName);} ?>"/> 
		</div> 
		</li>
	
		<li class="buttons">
        	 <input type="hidden" name="commandDel" />
			 <input id="saveForm" class="button_text searchButton" type="submit" name="update" value="SAVE"/>
             <input id="saveForm" class="button_text searchButton" type="button" name="delete" value="DELETE" onclick="delete_category()"/>
		</li>
        
			</ul>
		</form>	
        <div id="footer"></div>

	</div>
	

    
  </div>  <!-- End Of The Content--> 
</body>
</html>
<?php mysql_close($connection); ?>