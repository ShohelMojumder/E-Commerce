<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>	
<?php require_once("includes/admin_functions.php") ?>
<?php confirm_logged_in(); ?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<link rel="stylesheet" type="text/css" href="css/menu.css" />
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
    <li><a href="home.php" >CATALOGUE</a>
       <ul>
        	<li><a href="viewProducts.php">CATEGORY& PRODUCTS</a></li>
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

	<div id="content">

         <br/><br/>
             <div id="displayMessage" class="ordersShow" >
   	 	Welcome to the administrative back end!<br/><br/>

		Please use navigation menu to access administrative departments. 
     </div>
     <br/><br/>
   <div id="homeContent">
   
   <table width="100%"  cellpadding="10">
  <tr>
    <th scope="col">Orders<hr  width="60%"/></th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col"> Products<hr  width="40%"/></th>
  </tr>
  <tr>
    <td>Today:</td>
        <td>
        <span class="ordersShow">
			<?php $total_today_order_val=get_todays_total_orders(); 
				  $todaysOrdersTotalArray = mysql_fetch_array($total_today_order_val);	
				 
				 if($todaysOrdersTotalArray["totalOrders"]!=0){
				   echo $todaysOrdersTotalArray["totalOrders"];
				 }
				 else{
					 echo 0;
				 }
				  
			?> 
        </span>
         order(s) (BDT,&nbsp;<span class="ordersShow">
         </span>
		 	
			<?php
				
				  $total_today_order_val=get_todays_total_orders(); 
				  $todaysOrdersTotalArray = mysql_fetch_array($total_today_order_val);	
				 
				 if($todaysOrdersTotalArray["totalAmount"]!=0){
				   echo $todaysOrdersTotalArray["totalAmount"];
				 }
				 else{
					 echo 0;
				 }
				  
			?>
         
         
         
         </span>)</td>
    <td>&nbsp;</td>
    <td> Product Categories:<span class="ordersShow">
			<?php 
				 $total_category_set=get_total_category();
				 $totalCategories = mysql_fetch_array($total_category_set);		
				 echo $totalCategories["totalCategory"]; 
		    ?>
            </span>
    </td>
  </tr>
  <tr>
    <td>Yesterday:</td>
    <td>
    	<span class="ordersShow">
            <?php
                    
                      $yesterday_orders=get_yesterday_total_orders(); 
                      $yesterdayOrdersTotalArray = mysql_fetch_array($yesterday_orders);	
                     
                     if($yesterdayOrdersTotalArray["totalOrders"]!=0){
                       echo $yesterdayOrdersTotalArray["totalOrders"];
                     }
                     else{
                         echo 0;
                     }
                      
              ?>
         
    
    	 </span>order(s) (BDT,&nbsp;   
        <span class="ordersShow">
                 <?php
   
                     if($yesterdayOrdersTotalArray["totalAmount"]!=0){
                       echo $yesterdayOrdersTotalArray["totalAmount"];
                     }
                     else{
                         echo 0;
                     }
                      
                ?>
        </span>)
    </td>
    <td>&nbsp;</td>
    <td>Product Subcategories: 
    <span class="ordersShow"> 			
		<?php 
                     $total_subcategory_set=get_total_subcategory();
                     $totalSubCategories = mysql_fetch_array($total_subcategory_set);		
                     echo $totalSubCategories["totalSubCategory"]; 
        ?>
     </span>
     </td>
  </tr>
  <tr>
    <td>This month:	</td>
    <td>
    	<span class="ordersShow">	
        	<?php
				
				  $month_total_today_order_val=get_month_total_orders(); 
				  $monthTodaysOrdersTotalArray = mysql_fetch_array($month_total_today_order_val);	
				 
				 if($monthTodaysOrdersTotalArray["totalOrders"]!=0){
				   echo $monthTodaysOrdersTotalArray["totalOrders"];
				 }
				 else{
					 echo 0;
				 }	  
			?>
         
    
    
    	</span>order(s) (BDT,&nbsp;
        <span class="ordersShow">
			<?php

				 
				 if($monthTodaysOrdersTotalArray["totalAmount"]!=0){
				   echo $monthTodaysOrdersTotalArray["totalAmount"];
				 }
				 else{
					 echo 0;
				 }
				  
			?>
        
        </span>)
     </td>
    <td>&nbsp;</td>
    <td>Total number of Products: 
        <span class="ordersShow">
        	
            <?php 
               $total_product_set=get_total_product_items();
               $totalProductArray = mysql_fetch_array($total_product_set);		
               echo $totalProductArray["totalProducts"]; 
        	?>
        
        </span> 
    </td>
  </tr>
  <tr>
    <td>All time:</td>
    <td colspan="3"><span class="ordersShow"><?php $total_order_val=get_total_orders(); 
									  $ordersTotalArray = mysql_fetch_array($total_order_val);	
									  echo $ordersTotalArray["totalOrders"];?> </span>
         order(s) (BDT,&nbsp;<span class="ordersShow"></span><?php echo $ordersTotalArray["totalAmount"];?></span>)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


    </div>
    


  </div>  <!-- End Of The Content--> 

<div id="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

</body>
</html>