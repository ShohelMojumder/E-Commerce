<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_functions.php") ?>
<?php confirm_logged_in(); ?>
<?php
	if (isset($_POST['save'])) {
	
	 require_once("includes/form_functions.php");	
	
	$errors = array();
	$message="";
	
			
	// perform validations on the form data
	$required_fields = array('categoryId', 'subcategoryName', 'productName','price','discount','quantity','desc');
	$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
	
	$fields_with_lengths = array('categoryId' => 80,'subcategoryName' => 80,'productName' => 80,'price' => 80,'discount' => 80,'quantity' => 80,'desc' => 400);
	$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
	
	
	//This is only for the error of the category select Default values
	foreach($required_fields as $fieldname) {
		if ($_POST[$fieldname] =='Default') { 
			$errors[] = $fieldname; 
		}
	}

	

	$categoryId = trim(mysql_prep($_POST['categoryId']));
	$subcategoryName = trim(mysql_prep($_POST['subcategoryName']));
	$productName = trim(mysql_prep($_POST['productName']));
	$price = trim(mysql_prep($_POST['price']));
	$discount =trim( mysql_prep($_POST['discount']));
	$quantity =trim( mysql_prep($_POST['quantity']));
	$frontDisplay = trim(mysql_prep($_POST['frontDisplay']));
	$description = trim(mysql_prep($_POST['desc']));
	
	
	

   $sql="select categoryName  from category where categoryId={$categoryId}";
   $cp = mysql_query($sql,$connection) or die(mysql_error());
	
   $rowCat=mysql_fetch_array($cp);
   $categoryName=$rowCat["categoryName"];	
   $actualPrice=($price-($price*($discount/100)));
	
	
				

	$uploadErrors=0;	
	//checks whether Products in the Database or not	
	$sql="select *  from productsdescription where  categoryName='{$categoryName}' and subcategoryName='{$subcategoryName}' and productName='{$productName}'";
	$cp = mysql_query($sql,$connection) or die(mysql_error());
	if (mysql_affected_rows() == 1) {
		$message .= "The Product is already exists<br/>";
		$errors=array('product Name');
		$uploadErrors=11; //using flag so that we cannot upload the images
	}
		
		
		/*-----------Uploaded Image Files-----------------*/		
	if (isset($_FILES['photo'])) {
	$tmp_file  = $_FILES['photo']['tmp_name'];
	$upload_dir = "productsImages"; 
										
	/*-----------Uploaded Image Files Flag For the to Update the image field-----------------*/	  
	$uploadOk = 0;
										
	/*-----------Uploaded Image Files Wtih Validation Files-----------------*/	
		
	if(!empty($_FILES['photo']['tmp_name'])) //|| !is_uploaded_file($_FILES['photo']['tmp_name']))
	{
			global $uploadOk;
			$uploadOk = 1;
			
			// Handle no image here...
			$target_file = basename($_FILES['photo']['name']);			
		
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		
			$check = getimagesize($_FILES["photo"]["tmp_name"]);
			if($check != false) {
				$message .= "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$message .=  "File is not an image.";
				$errors=array('photo');
				$uploadOk = 0;
			}
		
			// Check if file already exists
			if (file_exists($target_file)) {
				$message .=  "Sorry, file already exists.";
				$errors=array('photo');
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["photo"]["size"] > 700000) {
				$message .=  "Sorry, your file is too large.";
				$errors=array('photo');
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$message .=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$errors=array('photo');
				$uploadOk = 0;
			}
		
			//checking the flags
			if ($uploadErrors == 11) {
				$uploadOk = 0;
			}
			
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$message .=  "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if ( move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
					$message .=  "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
				} else {
					$message .= "Sorry, there was an error uploading your file.";
				}
			}																		
		 }										 
	}
	
	
	if(isset($_FILES['photo']['error'])) {
		if($_FILES['photo']['error'] == 4) {
				$message .=  "empty image insert a image.";
				$errors=array('photo');
				$uploadOk = 0;
		}
	}
	
	
	
		/*-------------------------------Correct Front Display For Duplicate before insert-------------------------------*/
			
		if (empty($errors)) {	
		
			if($frontDisplay!=NULL) 
			{
		
			  $query = "SELECT * FROM productsdescription ";
			  $availablePosition="The available position are";
		
			   $products_displays = mysql_query($query,  $connection) or die( mysql_error());
				   while ($productsFront = mysql_fetch_array($products_displays)) {
					   
					   if($productsFront['frontDisplay']==$frontDisplay){
						   
						   $query = "update productsdescription set frontDisplay=NULL where productId={$productsFront['productId']}"; 
						   $resultFront = mysql_query($query, $connection) or die($query.mysql_error());							 
					   }
					   
					   if($productsFront['frontDisplay']!=NULL){					
							$availablePosition .= "  " .$productsFront['frontDisplay'];			   
					   }
					   
				   }
			
			 }
		}
	
	
	// Database submission only proceeds if there were no errors.
	if (empty($errors)) {	

			$query = "INSERT INTO productsdescription (
						categoryName, subcategoryName,productName,price,discount,actualPrice,quantity,photo,frontDisplay,description
					) VALUES (
						'{$categoryName}', '{$subcategoryName}', '{$productName}', {$price}, {$discount}, {$actualPrice},{$quantity}, '{$target_file }',
						 {$frontDisplay},'{$description}'
					)";
			$result = mysql_query($query, $connection);
			if ($result) {
				// Success!
				$message .= "<br/>The Product was successfully saved";
			} else {
				// Display error message.
				$message .= "<p>Product save failed.</p>";
				$message .= "<p>" . mysql_error() . "</p>";
			}
	}
	else {
		if (count($errors) == 1) {
			$message .= "<br/>There was 1 error in the form.";
		} else {
			$message .= "There were " . count($errors) . " errors in the form.";
		}
	}
	
}//end of saved
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
<script type="text/javascript" src="javascript/products-form-validation.js"></script>

<script>
function load(str) {
	var xmlhttp;
	if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest();
	else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
			document.getElementById("sub").innerHTML=xmlhttp.responseText;
	  	}
	xmlhttp.open("GET","get_sub.php?cat="+str,true);
	xmlhttp.send();
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
		<form name="addProducts" class="appnitro" enctype="multipart/form-data" method="post" onSubmit="return formValidation();" action="addProducts.php">
   
			<div class="form_description">
                    <h2>Product Details</h2>
                    <p>Enter The Details Of the Product</p>
			</div>						
			<ul >
			
		<li >
		<label class="description" for="categoryName">Category Name </label>
		<div>
		<select class="element select large" name="categoryId" onChange="load(this.value)"> 
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
		<label class="description" for="subcategoryName">Subcategory Name </label>
		<div id="sub">
		<select class="element select large"  name="subcategoryName"> 
			<option value="Default" selected="selected">--- Please select a subcategory ---</option>

		</select> 
		</div> 
		</li>		
        <li>
		<label class="description" for="productName">Product Name </label>
		<div>
			<input  name="productName" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
        <li >
		<label class="description" for="price">Price </label>
		<div>
			<input  name="price" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
        <li>
		<label class="description" for="discount">Discount </label>
		<div>
			<input  name="discount" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		

        <li >
		<label class="description" for="quantity">Quantity </label>
		<div>
			<input name="quantity" class="element text large" type="text" maxlength="255" value=""/> 
		</div> 
		</li>	
        <li >
		<label class="description" for="photo">Upload Photo </label>
		<div>
			<input  name="photo" class="element file" type="file"/> 
		</div>  
		</li>		

          <li >
           				
           <?php 
		   		$availablePosition=get_available_position(); 
		  		if($availablePosition != NULL){ echo $availablePosition . "  Position are not available but permit to overwite";}  
		   ?>
		<label class="description" for="frontDisplay">Positon Of Front Display </label>
		<div>
		<select class="element select large"  name="frontDisplay"> 
			<option value="NULL" selected="selected">--- select want to display front ---</option>
                <option value="1" >First</option>
                <option value="2" >Second</option>
                <option value="3" >Third</option>
                <option value="4" >Fourth</option>
                <option value="5" >Fivth</option>
                <option value="6" >Sixth</option>
                <option value="7" >Seventh</option>
                <option value="8" >Eight</option>
                <option value="9" >Nine</option>

		</select>
		</div> 
		</li>	
        <li >
		<label class="description" for="desc">Description Of The Product </label>
		<div>
			<textarea name="desc" class="element textarea large"></textarea> 
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
