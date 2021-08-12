<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/admin_functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	
	if(isset($_GET["orderId"]))
	{		
		$orderId = trim(mysql_prep($_GET['orderId']));
		$query = "DELETE FROM orders WHERE orderId = {$orderId}";
		$result = mysql_query($query, $connection);
		$query = "DELETE FROM orderdetails WHERE orderId = {$orderId}";
		$result = mysql_query($query, $connection);
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
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="javascript/view.js"></script>
<script type="text/javascript" src="javascript/jquery-1.10.2.js"></script>
<script type="text/javascript" src="javascript/jquery-ui-1.11.js"></script>

     <script type="text/javascript">
         $(function () {
             $("#orderText").datepicker({
                 dateFormat: 'yy-mm-dd'
             });
         });

</script>
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
    <li><a href="home.php">CATALOGUE</a>
        <ul id="submenu">
      	<li ><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
            <li><a href="addCategory.php">ADD CATEGORY</a></li>
            <li><a href="subCategory.php">ADD SUBCATEGORY</a></li>
            <li><a href="addProducts.php">ADD PRODUCTS</a></li>
        </ul>
    </li><li id="current"><a href="order.php"  class="selected">ORDER</a>

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

	<div id="content">
	<br/>
    <table cellspacing="0" id="products">
    <caption><b>List of Orders</b></caption>
    <tr><td colspan="5" align="left"><b>(Last Two days orders)New Orders.........</b></td><td colspan="6" align="right">
 
    <form name="searchByDate" action="order.php" method="post"> 
    <b>Search Order By Date</b><input type="text" id="orderText" name="searchDate" size="37"/>
    <input type="submit" name="searchButton" class="orderSearchButton" value="search"/>
    </form>
    </td></tr>
    <?php
		$output=ordersShows();
		if (!empty($output)) {
	?>
    
    <tr bgcolor="#99ccff" id="head">
    <th>Order Id</th>
    <th>Customer Name</th>
    <th>Email </th>
    <th>Address</th>
    <th>Phone Number </th>
    <th>Ordered Products</th>
    <th>Ordered Total</th>
    <th>Discount Amount</th>
    <th>Payable Amount</th>
    <th>Ordered Time</th>
    <th>Delete</th>
    </tr>
	<?php } else{echo "<tr bgColor='#FFFFFF'><td colspan=\"6\" align=\"center\"><br/>There are no orders Available!</td></tr>";} ?>
	<?php
		$output=ordersShows();
		if (!empty($output)) {
			echo $output;
		}
	?>
    </table>
    
  </div>  <!-- End Of The Content--> 


</body>
</html>