<?php
	
	/*--------------------------------------------------Navigation Functions common for All the Pages----------------------------------------------------------------------*/
	
		
	function navigationMenu()
	{
			/*------------------------------------------------------------------Navigation Menu --------------------------------------------------------------*/

         $outputmenu="<ul id=\"navList\">"; 
         $categoryName_sel="";  
		    	
	  	 if(isset($_GET["categoryName"]))
		 {
			$categoryName_sel=$_GET["categoryName"];		
		 }
		 
		 $category = get_all_category();
		 while ($category_set = mysql_fetch_array($category)) {	
			
			  $outputmenu.="<li";
			  if ($category_set["categoryName"] == $categoryName_sel) { $outputmenu .= " class=\"selected\""; }
			  
			  $outputmenu.="><a href=\"productList.php?categoryName=" . urlencode($category_set["categoryName"]) . "\">{$category_set["categoryName"]}</a>";
			  $outputmenu.="<ul>";
			  $subcategory_set=get_subcategory_for_category($categoryName_sel);
		 
		 	 while ($subcategory = mysql_fetch_array($subcategory_set)) {
			  
			if ($category_set["categoryName"] == $categoryName_sel) { 
               	 $outputmenu.="<li><a href=\"productList.php?subcategoryName=" . urlencode($subcategory["subcategoryName"]) . "\">{$subcategory["subcategoryName"]}</a></li>";
		    }
		  }
                 $outputmenu.="</ul>";
				 $outputmenu.="</li>";
		 }
            $outputmenu.="</ul>";
			
			if (!empty($outputmenu)) {
				return $outputmenu;
			}
			

	/*------------------------------------------------------------------End Of Navigation Menu --------------------------------------------------------------*/
	}
	
	
	
	
	
	/*--------------------------------------------------Navigation Menu functions common for all pages----------------------------------------------------------------------*/	
		function get_all_category() {
			global $connection;
			$query = "SELECT *
					FROM category";
			$category_set = mysql_query($query, $connection);
			confirm_query($category_set);
			return $category_set;
	   }
	
		
		
		
		function get_categoryId($categoryName_sel) {
			
			global $connection;
			$categoryId="";
			$sql = "SELECT categoryId
					FROM category
					WHERE categoryName='{$categoryName_sel}'";
			
			$category = mysql_query($sql, $connection);
			confirm_query($category);
			
			while ($rowCat=mysql_fetch_array($category)){
             $categoryId=$rowCat["categoryId"];
			}

			return $categoryId;
		
		}
		
		
		function get_subcategory_for_category($categoryName_sel) {
			global $connection;
			
			$categoryId=get_categoryId($categoryName_sel);
			
			$query = "SELECT * 
					FROM subcategory
					WHERE categoryId = '{$categoryId}'";
			$query .= "ORDER BY subcategoryId ASC";
			$subcategory_set = mysql_query($query, $connection);
			confirm_query($subcategory_set);
			return $subcategory_set;
	   }
	   
	   					
		
	
	/*--------------------------------------------------Index pages /front pages Functions only----------------------------------------------------------------------*/		
	function get_products_details_for_front() {

			global $connection;			
			$query = "select * from productsdescription
					WHERE frontdisplay != 'NULL'
					order BY frontdisplay asc";
			$products_set = mysql_query($query, $connection) or die($query.mysql_error());
			confirm_query($products_set);
			return $products_set;
		}
		
		function front_products_show()
		{
		
			 $products_set=get_products_details_for_front();
			 $outputProducts=" ";
				
			 while ($productsDetails = mysql_fetch_array($products_set)) {		
			 	  
				  //$photo=$productsDetails["photo"];					  
				  $outputProducts.="<div class=\"thumbs\">"; 	 
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
				  $outputProducts.="<img src=\"admin/productsImages/{$productsDetails["photo"]}\" class=\"thumbsImg\"/>";
				  $outputProducts.="</a><br/>";
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"more\">more info...</a> <br/>";
				  $outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"index.php?productId=" .urlencode($productsDetails["productId"])." & command=add\"class=\"button cart\">AddToCart</a></p>";
				  $outputProducts.="</div>";
		  
			}
		
			if (!empty($outputProducts)) {
	
				return $outputProducts;
			}
			
		}
	
/*----------------------------------------------------------------------ProductList Pages functions only----------------------------------------------------------------------*/	
	   
/*-------------------------------------------------------------------------start of category  --------------------------------------------------------------*/

		function get_products_details_for_category($categoryName) {
			
			global $connection;
			
			$query = "SELECT * 
					FROM productsdescription 
					WHERE categoryName = '{$categoryName}'";
			$query .="LIMIT 0, 9";

			$products_set = mysql_query($query, $connection);
			confirm_query($products_set);
			return $products_set;
		}
	
		function get_products_details_for_category_pages($categoryName,$page) {
						
				global $connection;			
				$num_rec_per_page=9;
				$pages=$page;
				$start_from = ($pages-1) * $num_rec_per_page; 
				$query = "SELECT * 
						FROM productsdescription 
						WHERE categoryName = '{$categoryName}'";
				$query .="LIMIT $start_from, $num_rec_per_page";
	
				$products_set_for_pages = mysql_query($query, $connection);
				confirm_query($products_set_for_pages );
				return $products_set_for_pages ;
			}
			


	 /*------------------------------------------------------------------End of category --------------------------------------------------------------*/  
	 
	 	/*------------------------------------------------------------------start of Subcategory --------------------------------------------------------------*/
	
		function get_products_details_for_subcategory($subcategoryName) {
			
			global $connection;
			
			$query = "SELECT * 
					FROM productsdescription 
					WHERE subcategoryName = '{$subcategoryName}'";
			$query .="LIMIT 0, 9";
			
			$products_set = mysql_query($query, $connection);
			confirm_query($products_set);
			return $products_set;
	   }
	
		function get_products_details_for_pages($subcategoryName,$page) {
			
			
			global $connection;
			
			$num_rec_per_page=9;
			$pages=$page;
			
			$start_from = ($pages-1) * $num_rec_per_page; 
			$query = "SELECT * 
					FROM productsdescription 
					WHERE subcategoryName = '{$subcategoryName}'";
			$query .="LIMIT $start_from, $num_rec_per_page";

			
			$products_set_for_pages = mysql_query($query, $connection);
			confirm_query($products_set_for_pages );
			return $products_set_for_pages ;
			
	   }
	   
		
		  /*------------------------------------------------------------------start of Search  --------------------------------------------------------------*/
		
		function get_products_details_for_search($searchCategoryName) {
				
				global $connection;
				
				$query = "SELECT * 
						FROM productsdescription 
						WHERE categoryName like '%{$searchCategoryName}%' OR subcategoryName LIKE  '%{$searchCategoryName}%' OR productName LIKE  '%{$searchCategoryName}%'";
				$query .="LIMIT 0, 9";
				$products_set = mysql_query($query, $connection) or die($query.mysql_error());
				confirm_query($products_set);
				return $products_set;
			}

		
			function get_products_details_for_search_pages($searchCategoryName,$page) {
				
				global $connection;
				$num_rec_per_page=9;
				$pages=$page;
				$start_from = ($pages-1) * $num_rec_per_page; 
				$query = "SELECT * 
						FROM productsdescription 
						WHERE categoryName like '%{$searchCategoryName}%' OR subcategoryName LIKE  '%{$searchCategoryName}%' OR productName LIKE  '%{$searchCategoryName}%'";
				$query .="LIMIT $start_from, $num_rec_per_page";
				$products_set_for_pages = mysql_query($query, $connection);
				confirm_query($products_set_for_pages );
				return $products_set_for_pages ;
			}
			
			 /*------------------------------------------------------------------About Us pages Functions  --------------------------------------------------------------*/

		    function get_about() {
				
				global $connection;
				$query = "SELECT *
						FROM auxilary";
				//$query .= "ORDER BY categoryId ASC";
				$about = mysql_query($query, $connection);
				confirm_query($about);
				$aboutus = mysql_fetch_array($about);
				return $aboutus['aboutUsContent'];
	        }
			
			 /*------------------------------------------------------------------Delivery pages Functions  --------------------------------------------------------------*/	   
	   	    function get_delivery() {
				
				global $connection;
				$query = "SELECT *
						FROM auxilary";
				//$query .= "ORDER BY categoryId ASC";
				$delivery = mysql_query($query, $connection) or die($query.mysql_error());
				confirm_query($delivery);
				$delivery = mysql_fetch_array($delivery);
				return $delivery['deliveryContent'];
	  		}
			
			
			
			
			/*------------------------------------------------------------------PricelIst pages Functions  --------------------------------------------------------------*/	 
			
			function get_all_category_for_price() {
				global $connection;
				$query = "SELECT categoryName,categoryId
						FROM category";
				$category_set = mysql_query($query, $connection);
				confirm_query($category_set);
				return $category_set;
			}
			
				function get_subcategory_for_category_for_price($categoryId) {
					global $connection;
					$query = "SELECT * 
							FROM subcategory
							WHERE categoryId = '{$categoryId}'";
					$query .= "ORDER BY subcategoryId ASC";
					$subcategory_set = mysql_query($query, $connection);
					confirm_query($subcategory_set);
					return $subcategory_set;
				}
			
			
				function get_products_details_for_subcategory_for_price($subcategoryName) {
					global $connection;
					$query = "SELECT * 
							FROM productsdescription 
							WHERE subcategoryName = '{$subcategoryName}'";
					$query .= "ORDER BY productId ASC";
					$products_set = mysql_query($query, $connection);
					confirm_query($products_set);
					return $products_set;
				}
	   
	
	function priceListShow()
	{
		$output="";
		
		$category_set = get_all_category_for_price();
	    while ($category = mysql_fetch_array($category_set))
	    {	
			
			$output.="<thead>";
			$output.="<tr>";
			$output.="<th colspan=\"2\"><a href=\"productList.php?categoryName=" . urlencode($category["categoryName"]) . "\" class=\"priceListCat\">{$category["categoryName"]}</a></th>";
			$output.="</tr>";
			$output.="</thead>";
			
			$subcategory_set = get_subcategory_for_category_for_price($category["categoryId"]);
			while ($subcategory = mysql_fetch_array($subcategory_set))
		    {
			
				$output.="<thead>";
				$output.="<tr>";
				$output.="<th colspan=\"2\"><a href=\"productList.php ?subcategoryName=" . urlencode($subcategory["subcategoryName"]) . "\" class=\"priceList\">{$subcategory["subcategoryName"]}</a></th>"; 
				$output.="</tr>";
				$output.="</thead>";

				$subcategoryName= $subcategory["subcategoryName"];
		 		$products_set=get_products_details_for_subcategory_for_price($subcategoryName);
				$alterColor=0;
		 
				while ($products = mysql_fetch_array($products_set)) 
			    {
					//global $alterColor;
					$output.="<tbody>";
					
					if($alterColor%2==0){
       				$output.="<tr>";
					}
					else{
					$output.="<tr class=\"alt\">";
					}
            		$output.="<td><a href=\"details.php?productId=" . urlencode($products["productId"]) . "\" class=\"ProductpriceList\">{$products["productName"]}</a></td>";
            		$output.="<td>BDT, {$products["actualPrice"]}</td>";
     				$output.="</tr>";
				    $output.="</tbody>";
					
					$alterColor++;
					
				}
			}
		}

		
			if (!empty($output)) {
	
				return $output;
			}
					
					
	}
	
	
	/*------------------------------------------------------------------Details  pages Functions  --------------------------------------------------------------*/	
		
		function get_products_details_for_productId($productId){
			global $connection;
			$query = "SELECT * 
					FROM productsdescription 
					WHERE productId = '{$productId}'";

			$products_info = mysql_query($query, $connection);
			confirm_query($products_info);
			return $products_info;
		}
			
	
	?>
