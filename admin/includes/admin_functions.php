<?php require_once("functions.php"); ?>
<?php require_once("connection.php"); ?>
<?php
/*------------------------------------------------------------Auxilary Page Functions-----------------------------------------------------*/

function get_auxilary_details($auxid){
	global $connection;
	
	$query = "SELECT * FROM auxilary WHERE auxid = '{$auxid}'";
	$auxilary_details = mysql_query($query,  $connection) or die( $query.mysql_error());
	confirm_query($auxilary_details);
	return $auxilary_details;
}

/*------------------------------------------------------------editSubcategory pages Functions-----------------------------------------------------*/

function get_subcategory_details_for_subcategoryId($subcategoryId){

	global $connection;
	$query = "SELECT * 
			FROM subcategory 
			WHERE subcategoryId = '{$subcategoryId}'";

	$subcategory_details = mysql_query($query,  $connection) or die( mysql_error());
	confirm_query($subcategory_details);
	return $subcategory_details;
}

/*------------------------------------------ViewProducts also contain the same function------------------------------------------------------*/

function get_category_name($categoryId) 
{
	global $connection;
	$query = "SELECT categoryName FROM category where categoryId={$categoryId}";
	//$query .= "ORDER BY categoryId ASC";
	$category_name = mysql_query($query, $connection);
	confirm_query($category_name);
	return $category_name;
}


/*------------------------------------------------------------editProducts pages Functions-----------------------------------------------------*/


 function get_products_details_for_productId($productId){
			
	 global $connection;		
	$query = "SELECT * 
			 FROM productsdescription 
			 WHERE productId = '{$productId}'";

	$products_details = mysql_query($query,  $connection) or die( mysql_error());
	confirm_query($products_details);
	return $products_details;
}


/*-------------------------------Available Front Display position for Edit Pages and Addproducts-------------------------------*/
		
	function get_available_position(){
		
		global $connection;
		$query = "SELECT * FROM productsdescription ";
		$availablePosition=" ";

	   $products_displays = mysql_query($query,  $connection) or die($query.mysql_error());
	   while ($productsFront = mysql_fetch_array($products_displays)) {
		   if($productsFront['frontDisplay']!=NULL){
				$availablePosition .= $productsFront['frontDisplay'] .",  " ;
		   }
		   
		}
		return $availablePosition;
	}

/*------------------------------------------------------------order pages Functions-----------------------------------------------------*/
	function get_dateWise_customersId($searchDates){			
			global $connection;
			$query = "SELECT customerId from orders where DATE(orderDate)='{$searchDates}'";
			$customers_all_id = mysql_query($query, $connection);			
			confirm_query($customers_all_id);
			return $customers_all_id;
	   }
	
	
	function get_two_dates_customersId(){
			
			global $connection;
			$customers_one_infos = array();
			$customers="";
			
			date_default_timezone_set("Asia/Dhaka");
			$date=date('Y-m-d');
			$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));
			$query = "SELECT customerId from orders where DATE(orderDate) >='{$yesterday}'";

			$customers_all_id = mysql_query($query, $connection);			
			confirm_query($customers_all_id);
			return $customers_all_id;
	   }
	

	   
	   	function get_customersInfo($customers_id_info){
			
			global $connection;
			$query = "SELECT * FROM customers where customerId={$customers_id_info}";
			$customers_info = mysql_query($query, $connection);
			confirm_query($customers_info);
			return $customers_info;	
	    }
	   
	
	
	function get_all_orders($customerId){
		
		global $connection;
		$query = "SELECT * FROM orders where  customerId=$customerId";
		//$query .="LIMIT 0, 5";
		
		$orders = mysql_query($query, $connection);
		confirm_query($orders);
		
		return $orders;
	
	}
	
	
	function get_all_orderDetails($orderPass){
			global $connection;
			$query = "SELECT * FROM orderdetails where orderId=$orderPass";
			//$query .="LIMIT 0, 5";
			
			$order_details = mysql_query($query, $connection);
			confirm_query($order_details);
			return $order_details;
		
	}
		
		/*----------------this is only for products name------------*/
			function get_products_name($productId){
			global $connection;
			$query = "SELECT productName
					FROM productsdescription where productId={$productId}";
			
			$productName = mysql_query($query, $connection);
			confirm_query($productName);
			return $productName;
		
	}
	
	/*------------------------Shows all the orders in the orders show pages----------------------------------------------------*/
	
	function ordersShows()
	{
	   $order_details_set="";
	   $orders_details="";
	   $output="";
	   $alterColor=1;
	  
		if(isset($_POST['searchDate']))
		{
			$searchThisDate=trim($_POST['searchDate']);
			$customers_all_id=get_dateWise_customersId($searchThisDate);
		}
		else{
	   		$customers_all_id = get_two_dates_customersId();
		}
		while ($customers_id_info = mysql_fetch_array($customers_all_id))
		{
			$customers = get_customersInfo($customers_id_info['customerId']);
							
			while ($customers_info = mysql_fetch_array($customers))
			{
					$orders_set = get_all_orders($customers_info["customerId"]);	
					while ($orders = mysql_fetch_array($orders_set))
					{
			
						if($alterColor % 2==0){
							$output .="<tr class=\"secondtd\" >"; 
							$alterColor++;
						}
						else{
							$output .="<tr class=\"firsttd\" >";
							$alterColor++; 
						}
						$output.="<td>{$orders["orderId"]}</td>";
						$output.="<td>{$customers_info["firstName"]}&nbsp;{$customers_info["lastName"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
						$output.="<td>{$customers_info["email"]}</td>";
						$output.="<td>{$customers_info["address"]}<br/>{$customers_info["city"]}{$customers_info["postalCode"]}</td>";
						$output.="<td>{$customers_info["phoneNumber"]}&nbsp;&nbsp;</td>";
					
						$orderPass=$orders["orderId"];
						$order_details_set = get_all_orderDetails($orderPass);
						$output.="<td>";	
				
						 while ($orders_details = mysql_fetch_array($order_details_set))
						 {	
								$productRow=get_products_name($orders_details["ProductId"]);
								$productRowName=mysql_fetch_array($productRow);
								$output.="{$productRowName["productName"]} &nbsp;&nbsp;  x &nbsp;&nbsp; {$orders_details["quantity"]}<br/>";	
						 }
				   
						$output.="</td>";
						$output.="<td>{$orders["totalAmount"]}</td>";
						$output.="<td>{$orders["discountPercent"]}% ={$orders["discountAmount"]}</td>";
						$output.="<td>{$orders["payableAmount"]}</td>";
						$output.="<td>{$orders["orderDate"]}</td>";
						$output .="<th><a href=\"javascript:del('order.php?orderId=',{$orders["orderId"]})\">delete</a></th>";	
						$output.="</tr>";
				 }
			}
		}
		
		if (!empty($output)) {
	
				return $output;
		}
	}



/*------------------------------------------ViewProducts pages function------------------------------------------------------*/
	
		function get_all_category() {
			
			global $connection;
			$query = "SELECT categoryName,categoryId
					FROM category";
			//$query .= "ORDER BY categoryId ASC";
			$category_set = mysql_query($query, $connection);
			confirm_query($category_set);
			return $category_set;
	   }
	
		function get_subcategory_for_category($categoryId) {
			
			global $connection;
			$query = "SELECT * 
					FROM subcategory
					WHERE categoryId = '{$categoryId}'";
			$query .= "ORDER BY subcategoryId ASC";
			$subcategory_set = mysql_query($query, $connection);
			confirm_query($subcategory_set);
			return $subcategory_set;
	    }
	
	
		function get_products_details_for_subcategory($subcategoryName,$categoryName) {
			
			global $connection;
			$query = "SELECT * 
					FROM productsdescription 
					WHERE subcategoryName = '{$subcategoryName}' && categoryName='{$categoryName}'";
			$query .= "ORDER BY productId ASC";
			$products_set = mysql_query($query, $connection);
			confirm_query($products_set);
			return $products_set;
	    }
	
		function get_products_details_for_category($categoryName) {
			
			global $connection;
			$query = "SELECT * 
					FROM productsdescription 
					WHERE categoryName = '{$categoryName}'";
			//$query .= "ORDER BY subcategoryId ASC";
			$subcategory_set = mysql_query($query, $connection);
			confirm_query($subcategory_set);
			return $subcategory_set;
	   }
	
		function get_total_category_items($categoryName) {
			
			global $connection;
			$query = "SELECT count(*) as itemTotal 
					FROM productsdescription 
					WHERE categoryName = '{$categoryName}'";
			//$query .= "ORDER BY subcategoryId ASC";
			$total_category_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($total_category_set);		
			$items = mysql_fetch_array($total_category_set);		
			$itemTotal=$items["itemTotal"];
			return $itemTotal;
	   }
	
		function get_total_subcategory_items($subCategoryName) {
			
			global $connection;
			$query = "SELECT count(*) as subItemTotal 
					FROM productsdescription 
					WHERE subcategoryName = '{$subCategoryName}'";
			//$query .= "ORDER BY subcategoryId ASC";
			$total_subcategory_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($total_subcategory_set);
			
			$subItems = mysql_fetch_array($total_subcategory_set);
			
			$subItemTotal=$subItems["subItemTotal"];
			return $subItemTotal;
	   }
	
/*----------------------------------------------------------------Display the category and subcategory menu--------------------------------------------------------------*/
	function viewProductsCatSubcatShows()
	{
	
		$output ="<table width=\"100%\" align=\"center\" cellspacing=\"7\" hspace=\"10\">";
		$category_set = get_all_category();
		
	
		while ($category = mysql_fetch_array($category_set)) {
		
			$output .= "<tr>";
			$output .="<th>";
			$output .="<a href=\"viewProducts.php?categoryName=" . urlencode($category["categoryName"]) . 
						"\">{$category["categoryName"]}</a>";
			$output .="</th>";
			$items=get_total_category_items($category["categoryName"]);	
			$output .="<th>({$items})</th>";
	
		   $output .="<th><a href=\"javascript:del('viewProducts.php?categoryId=',{$category["categoryId"]})\">delete</a></th>";			
						
			$output .= "</tr>";
			$subcategory_set = get_subcategory_for_category($category["categoryId"]);
			while ($subcategory = mysql_fetch_array($subcategory_set)) {
			
				$subItem=get_total_subcategory_items($subcategory['subcategoryName']);
				$output .= "<tr>";
				$output .= "<td>";
	
$output .=   "<a href=\"viewProducts.php?subcategoryName=" . urlencode($subcategory["subcategoryName"]) . "&categoryName=" . urlencode($category["categoryName"]) . "\" class=\"subcategory\">{$subcategory["subcategoryName"]}</a>";													  
				$output .= "</td>";
				
				
				
				$output .="<td>({$subItem})</td>";
				$output .="<td><a href=\"editSubcategory.php?subcategoryId="  . urlencode($subcategory["subcategoryId"]) . "\"  class=\"button\">EDIT</a></td>";
				$output .= "</tr>";
		
			}
		}
	
	$output .= "</table>";
	
	if (!empty($output)) {

		return $output;
	}
		
	}
/*---------------------------------------------------------------Display the categorywise products-----------------------------------------------------------*/
	function viewProductsSubcategoryProductShows()
	{
		//Displays for the SubCategory
		if(isset($_GET["subcategoryName"]) && isset($_GET["categoryName"]))
		{
			$subcategoryName=$_GET["subcategoryName"];
			$categoryName=$_GET["categoryName"];
			$products_set=get_products_details_for_subcategory($subcategoryName,$categoryName);
			$outputProducts ="";
			$alterColor=0;
			while ($productsDetails = mysql_fetch_array($products_set)) {
			
			if($alterColor%2==0){
			$outputProducts .="<tr class=\"secondtd\" >"; 
			}
			else{
				$outputProducts .="<tr class=\"firsttd\" >"; 
			}
			
			$outputProducts .="<td>{$productsDetails["productName"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td>{$productsDetails["price"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td>{$productsDetails["discount"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td>{$productsDetails["actualPrice"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td>{$productsDetails["quantity"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td>{$productsDetails["frontDisplay"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$outputProducts .="<td><a href=\"editProducts.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"button\">EDIT</a></td>";
			$outputProducts .="</tr>";
			$alterColor++;
			}
			
			
			/*if it is null then it will not display errors */
			if (!empty($outputProducts)) {

				return $outputProducts;
			}			
		}
	}

/*---------------------------------------------------------------Display the subCategorywise products-----------------------------------------------------------*/
	function viewProductsCategoryProductShows()
	{
		    if(isset($_GET["categoryName"]) && !isset($_GET["subcategoryName"]))
			{
				$categoryName=$_GET["categoryName"];
				$products_set=get_products_details_for_category($categoryName);
				$outputProducts ="";
				$alterColor=0;
				while ($productsDetails = mysql_fetch_array($products_set)) {
				
					if($alterColor%2==0){
					$outputProducts .="<tr class=\"secondtd\" >"; 
					}
					else{
						$outputProducts .="<tr class=\"firsttd\" >"; 
					}
					
					$outputProducts .="<td>{$productsDetails["productName"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td>{$productsDetails["price"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td>{$productsDetails["discount"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td>{$productsDetails["actualPrice"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td>{$productsDetails["quantity"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td>{$productsDetails["frontDisplay"]}&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$outputProducts .="<td><a href=\"editProducts.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"button\">EDIT</a></td>";
					$outputProducts .="</tr>";
					$alterColor++;
				}
	
			/*if it is null then it will not display errors */
				if (!empty($outputProducts)) {

					echo $outputProducts;
		        }			
		   }
	}




/*---------------------------------------------------------------orders pages functions-----------------------------------------------------------*/
   
	   function get_todays_total_orders() {
			
			global $connection;
			
			date_default_timezone_set("Asia/Dhaka");
			//$date=date('Y-m-d h:i:s');
			$date=date('Y-m-d');
			
			$query = "select count(*) as totalOrders,sum(payableAmount) as totalAmount from orders where DATE(orderDate)='{$date}'";
			
		
					
			$current_total_orders = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($current_total_orders);
			
			return $current_total_orders; 		
	   }
	   
	     function get_yesterday_total_orders() {
			
			global $connection;
			
			date_default_timezone_set("Asia/Dhaka");
		
			$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));
			
			
			$query = "select count(*) as totalOrders,sum(payableAmount) as totalAmount from orders where DATE(orderDate)='{$yesterday}'";
							
			$yesterday_total_orders = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($yesterday_total_orders);
			
			return $yesterday_total_orders; 	
	    }
	   
	   
	        function get_month_total_orders() {
			
				global $connection;
				
				$currentMonth=date("n");

				$query = "select count(*) as totalOrders,sum(payableAmount) as totalAmount from orders where MONTH(orderDate)=$currentMonth";
						
				$month_total_orders = mysql_query($query, $connection) or die($query.mysql_error());
				confirm_query($month_total_orders);
				return $month_total_orders;
	        }
	   
	       function get_total_orders() {
			
				global $connection;
				
				$query = "select count(*) as totalOrders,sum(payableAmount)as totalAmount from orders";
						
				$total_order_val = mysql_query($query, $connection) or die($query.mysql_error());
				confirm_query($total_order_val);
				

				return $total_order_val;
	      }
		  
		  
		   //--------------also used in viewproducts pages-----------------------------
		   
		   function get_total_category() {
			
			global $connection;
			$query = "SELECT count(*) as totalCategory 
					FROM category"; 
	
			//$query .= "ORDER BY subcategoryId ASC";
			$total_category_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($total_category_set);		

			return $total_category_set;
	   }
	
		function get_total_subcategory() {
			
			global $connection;
			$query = "SELECT count(*) as totalSubCategory
					FROM subcategory";

			//$query .= "ORDER BY subcategoryId ASC";
			$total_subcategory_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($total_subcategory_set);
			return $total_subcategory_set;
			

	   }
	   
	   	function get_total_product_items() {
			
			global $connection;
			$query = "SELECT count(*) as totalProducts FROM productsdescription";
			$total_products_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($total_products_set);
			
			return $total_products_set;
	   }


?>







