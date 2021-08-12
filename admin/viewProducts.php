<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_functions.php") ?>
<?php confirm_logged_in(); ?>


<?php	

	if(isset($_GET["categoryId"]))
	{
		
		if (intval($_GET['categoryId']) == 0) {
			redirect_to('viewProducts.php');
		}
		
		$categoryId = trim(mysql_prep($_GET['categoryId']));					
		$categoryNameRaw=get_category_name($categoryId);
		$categoryNameArray = mysql_fetch_array($categoryNameRaw);
		$categoryName=$categoryNameArray['categoryName'];	
			

		
		$query = "DELETE FROM category WHERE categoryId = {$categoryId} ";
		$result = mysql_query ($query,$connection);
		if (mysql_affected_rows() == 1) {
			// Successfully deleted	
			$query = "DELETE FROM subcategory WHERE categoryId = {$categoryId} ";
			$result = mysql_query ($query,$connection);

			
			if (mysql_affected_rows() >= 1) {
				
					$query = "DELETE FROM productsdescription WHERE categoryName = '{$categoryName}' ";
					$result = mysql_query ($query,$connection);
					
					if (mysql_affected_rows() >= 1) {
						redirect_to("viewProducts.php");
						//echo "<p>subcategory deletion success.{$categoryName}.</p>";
						
					}
			
			}
			
			else {
				// Deletion failed
				//echo "<p>subcategory deletion failed.{$categoryName}.</p>";
				//echo "<p>" . mysql_error() . "</p>";
				//echo "<a href=\"viewProducts.php\">Return to viewProducts</a>";
			}
		
		} else {
			// Deletion failed
			//echo "<p>second level subcategory deletion failed.{$categoryName}.</p>";
			//echo "<p>" . mysql_error() . "</p>";
			
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

<script language="javascript">
	function del(url,id){
		if(confirm('Do you really mean to delete this item')){
			window.location=url+id;
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
    <li id="current"><a href="viewProducts.php" class="selected">CATALOGUE</a>
        <ul id="submenu">
        	<li><a href="viewProducts.php">CATEGORY&PRODUCTS</a></li>
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
    
    <li ><a href="logout.php" id="log" >LOGOUT</a> </li>
   </ul>
   </div>
        
</div></div>



	<div id="navMain">
    <br/><br/>
    <h3 align="center">Categories and Subcategory</h3>


	<?php
		$output=viewProductsCatSubcatShows();
		if (!empty($output)) {
			echo $output;
		}
    ?>

    </div>

	<div id="content">
	<br/><br/><br/><br/><br/>

    <table cellspacing="0" align="center" cellpadding="3" id="viewProducts">

    <caption>PRODUCT NAME</caption>
    <tr id="head">
    <th>PRODUCT NAME &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>PRICE,BDT &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>DISCOUNT,% &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>ACTUAL PRICE,BDT &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>QUANTITY &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>FRONT DISPLAY &nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>EDIT</th>
    </tr>

    
    <?php
		$output=viewProductsCategoryProductShows();
		if (!empty($output)) {
			echo $output;
		}
	?>
    

	<?php
		$output=viewProductsSubcategoryProductShows();
		if (!empty($output)) {
			echo $output;
		}
	?>
    

    </table>
    
  </div>  <!-- End Of The Content--> 

<div id="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

</body>
</html>