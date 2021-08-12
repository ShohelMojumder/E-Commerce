<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/form_functions.php"); ?>
<?php require_once("includes/admin_functions.php") ?>
<?php confirm_logged_in(); ?>


		
<?php
 	 //Move this code to the edit products
	// make sure the subject id sent is an integer
		$message="";
		
			
			if(isset($_GET["id"])&& $_POST['commandDel']=='deleteProduct')
			{
				$productId = trim(mysql_prep($_GET['id']));
				
				$products_image_details=get_products_details_for_productId($productId);
				$products_image_delete = mysql_fetch_array($products_image_details);
				
				$file ="productsImages/".$products_image_delete["photo"];
				echo $file;
				if (!unlink($file)){
				// Successfully deleted
					$message .="<p>Image remove  failed.</p>";
				}
				else
				{
					$message .="<p>Image successfully removed.</p>";
					
				}
				
	
				// LIMIT 1 isn't necessary but is a good fail safe
				$query = "DELETE FROM productsdescription WHERE productId = {$productId} LIMIT 1";
				$result = mysql_query ($query,$connection);
				if (mysql_affected_rows() == 1) {
					
					//$message .="<p>product successfully deleted.</p>";				
					redirect_to("viewProducts.php");
				
				} else {
					// Deletion failed
					$message .="<p>product deletion failed.</p>";
					$message .="<p>" . mysql_error() . "</p>";
					
				}
			} 
		

?>
<?php
		if (isset($_POST['update'])) {
			
			$errors = array();
			$message="";			
			global $productId;
			
							
			// perform validations on the form data
			$required_fields = array('categoryId', 'subcategoryName', 'productName','price','discount','quantity','frontDisplay','desc');
			$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
			
			$fields_with_lengths = array('categoryId' => 80,'subcategoryName' => 80,'productName' => 80,'price' => 80,'discount' => 80,'quantity' => 80,'desc' => 400);
			$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
			
			
			//This is only for the error of the category select Default values
			foreach($required_fields as $fieldname) {
				if ($_POST[$fieldname] =='Default') { 
					$errors[] = $fieldname; 
				}
			}
			
			
			$id=trim(mysql_prep($_GET['id']));
			$categoryId = trim(mysql_prep($_POST['categoryId']));
			$subcategoryName =trim( mysql_prep($_POST['subcategoryName']));
			$productName = trim(mysql_prep($_POST['productName']));
			$price = trim(mysql_prep($_POST['price']));
			$discount = trim(mysql_prep($_POST['discount']));
			$quantity = trim(mysql_prep($_POST['quantity']));
			$frontDisplay = trim(mysql_prep($_POST['frontDisplay']));
			$description = trim(mysql_prep($_POST['desc']));
			
			$sql="select categoryName  from category where categoryId={$categoryId}";
			$cp = mysql_query($sql,$connection) or die(mysql_error());
			$rowCat=mysql_fetch_array($cp);
			$categoryName=$rowCat["categoryName"];
			$actualPrice=ceil(($price-($price*($discount/100))));
				

					
			//if (empty($errors)) {

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
					if($check !== false) {
						$message .="File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						$message .="File is not an image.";
						$errors=array('photo');
						$uploadOk = 0;
					}
				
				  // Check if file already exists
					if (file_exists($target_file)) {
						$message .= "Sorry, file already exists.";
						$errors=array('photo');
						$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["photo"]["size"] > 700000) {
						$message .= "Sorry, your file is too large.";
						$errors=array('photo');
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						$message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$errors=array('photo');
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$message .= "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						if ( move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
							$message .= "<br/>The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
						} else {
							$message .= "Sorry, there was an error uploading your file.";
						}
					}				
									
					
					 }
					
				}
					 	
					/*-------------------------------Correct Front Display For Duplicate before Update-------------------------------*/
					
					if($frontDisplay!=NULL) 
					{

						$query = "SELECT * FROM productsdescription ";
		
						   $products_displays = mysql_query($query,  $connection) or die( mysql_error());
						   while ($productsFront = mysql_fetch_array($products_displays)) {  
							   if($productsFront['frontDisplay']==$frontDisplay){   
								   $query = "update productsdescription set frontDisplay=NULL where productId={$productsFront['productId']}"; 
								   $resultFront = mysql_query($query, $connection) or die($query.mysql_error());
							   }
						   }		
					}
					
					/*--------------------------update query to display--------------------------------------------------------------*/		
				   
				   if (empty($errors)) {
				   
				    $query = "update productsdescription set 
							categoryName = '{$categoryName}', 
							subcategoryName = '{$subcategoryName}', 
							productName = '{$productName}',
							price = {$price}, 
							discount = {$discount},
							actualPrice = {$actualPrice},
							quantity = {$quantity},";

							if($uploadOk == 1)
							{$query .="photo='{$target_file}',";}
												
				    $query .= "frontDisplay = {$frontDisplay},
							description = '{$description}'
							WHERE productId = {$id}";
					
						$result = mysql_query($query, $connection) or die($query.mysql_error());
						if ($result) {
							// Success!
							$message .= "<br/>The Product was successfully saved";
						} else {
							// Display error message.
							$message .= "<p>Product save failed.</p>";
							$message .= "<p>" . mysql_error() . "</p>";
						}
		 		  	}// end: if (empty($errors))
		   
		} // end: if (isset($_POST['update']))
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
<script language="javascript">
	function delete_product(){
		if(confirm('Do you really mean to delete this item')){
			document.addProducts.commandDel.value='deleteProduct';
			document.addProducts.submit();
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
            <li><a href="createUser.php">ADD USER</a></li>
            <li><a href="changePassword.php">Admin login/password</a></li>
            <li><a href="auxilary.php">AUXILARY INFORMATION</a></li>
        </ul>
    </li>
    
    <li><a href="logout.php">LOGOUT</a> </li>
   </ul>
   </div>
        
</div></div>

            <?php 
			
		 if(isset($_GET["productId"]))
		 {
			global $id;
			$id=$_GET["productId"];
			$products_details=get_products_details_for_productId($_GET["productId"]);
			$products_fields = mysql_fetch_array($products_details);
			$categoryName=$products_fields["categoryName"];
			$subcategoryName=$products_fields["subcategoryName"];
			$productName=$products_fields["productName"];
			$price=$products_fields["price"];
			$discount=$products_fields["discount"];
			$actualPrice=$products_fields["actualPrice"];
			$quantity=$products_fields["quantity"];
			$frontDisplay=$products_fields["frontDisplay"];
			$photo=$products_fields["photo"];
			$description=$products_fields["description"];
			
			 $sql="select  categoryId  from category where categoryName='{$categoryName}'";
			 $cp = mysql_query($sql,$connection) or die(mysql_error());
			 $rowCat=mysql_fetch_array($cp);
			 $categoryId=$rowCat["categoryId"];
			
		 }
			
			
			
        ?>

	<div id="content">
    
    <div id="top">&nbsp;</div>
    
	<div id="form_container">
	
		<h1><a>Product Details</a></h1>
        <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		<form name="addProducts" class="appnitro" enctype="multipart/form-data" method="post" onSubmit="return formValidation();" action="editProducts.php?id=<?php echo $id; ?>">
        
			<div class="form_description">
                    <h2>Product Details</h2>
                    <p>Enter The Details Of the Product</p>
			</div>						
			<ul >
			
		<li>
		<label class="description" for="categoryId">Category Name </label>
		<div>
		<select class="element select large" name="categoryId" onChange="load(this.value)"> 
			<option value="<?php  if(isset($categoryId)){echo htmlentities($categoryId);} ?>" selected="selected"><?php  if(isset($categoryName)){echo htmlentities($categoryName);}?></option>
        
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
		<label class="description" for="subcategoryName">Subcategory Name </label>
		<div id="sub">
		<select class="element select large"  name="subcategoryName"> 
<option value="<?php if(isset($subcategoryName)){echo htmlentities($subcategoryName);}  ?>"selected="selected"><?php if(isset($subcategoryName)){echo htmlentities($subcategoryName);} ?></option>

		</select> 
		</div> 
		</li>		
        <li>
		<label class="description" for="productName">Product Name </label>
		<div>
			<input  name="productName" class="element text large" type="text" maxlength="255" value="<?php if(isset($productName)){echo htmlentities($productName);} ?>"/> 
		</div> 
		</li>		
        <li>
		<label class="description" for="price">Price </label>
		<div>
			<input  name="price" class="element text large" type="text" maxlength="255" value="<?php if(isset($price)){echo htmlentities($price);}?>"/> 
		</div> 
		</li>		
        <li>
		<label class="description" for="discount">Discount </label>
		<div>
			<input  name="discount" class="element text large" type="text" maxlength="255" value="<?php if(isset($discount)){echo htmlentities($discount);}?>"/> 
		</div> 
		</li>		

        <li>
		<label class="description" for="quantity">Quantity </label>
		<div>
			<input  name="quantity" class="element text large" type="text" maxlength="255" value="<?php if(isset($quantity)){echo htmlentities($quantity);} ?>"/> 
		</div> 
		</li>	

        <li>
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
			<option value="<?php if(isset($frontDisplay)){echo htmlentities($frontDisplay);}?>" selected="selected">

			<?php if (!isset($frontDisplay)) echo "No front position selected"; ?>
			<?php if (isset($frontDisplay)) { if($frontDisplay==1) echo "First";}?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==2) echo "Second";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==3) echo "Third";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==4) echo "Fourth";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==5) echo "Fifth";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==6) echo "Sixth";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==7) echo "Seventh";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==8) echo "Eight";} ?>
            <?php if (isset($frontDisplay)) {if($frontDisplay==9) echo "Ninth";} ?>

            </option>
            	
                <option value="NULL" >Not Front</option>
                <option value="1" >First</option>
                <option value="2" >Second</option>
                <option value="3" >Third</option>
                <option value="4" >Fourth</option>
                <option value="5" >Fifth</option>
                <option value="6" >Sixth</option>
                <option value="7" >Seventh</option>
                <option value="8" >Eighth</option>
                <option value="9" >Ninth</option>

		</select>
		</div> 
		</li>	
        <li>
		<label class="description" for="desc">Description Of The Product </label>
		<div>
			<textarea  name="desc" value="" class="element textarea large"><?php if(isset($description)){echo htmlentities($description);}?></textarea> 
		</div> 
		</li>
		<li class="buttons">
			    <input type="hidden" name="commandDel" />
				<input id="saveForm" class="button_text searchButton" type="submit" name="update" value="SAVE"/>
                <input  class="button_text searchButton" type="button" name="delete" value="DELETE" onclick="delete_product()"/>
		</li>
			</ul> 
		</form>	
        <div id="footer"></div>

	</div>
	

    
  </div>  <!-- End Of The Content--> 

</body>
</html>
<?php mysql_close($connection); ?>