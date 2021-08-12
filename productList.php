<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php"); ?>
<?php	
		
		if(isset($_GET['productId'])){
			
			if($_GET['productId']>0){
				$pid=trim(mysql_prep($_GET['productId']));
				addtocart($pid,1);
				
				if(isset($_GET["categoryName"])){
					$url="productList.php?categoryName={$_GET["categoryName"]}";
					header("location:$url");
					exit();
				}
				if(isset($_GET["subcategoryName"])){
					$url="productList.php?subcategoryName={$_GET["subcategoryName"]}";
					header("location:$url");
					exit();
				}
				if(isset($_GET["searchCategoryName"])){
				$url="productList.php?searchCategoryName={$_GET["searchCategoryName"]}";
				header("location:$url");
				exit();
				}


			}
		}
?>

    <?php require_once("includes/front_header.php"); ?>
	<div id="productContent" align="center">
  
        
        <span class="contentSpan">
        <?php 
		/*------------Shows in the heading content-----------------*/
			
		 if(isset($_GET["categoryName"]))
		 {
			$productType=trim(mysql_prep($_GET["categoryName"]));
			echo $productType;		
		 }
		 
		  if(isset($_GET["subcategoryName"]))
		 {
			 $productType=trim(mysql_prep($_GET["subcategoryName"]));
			 echo $productType;
		 }
		 
		 if(isset($_GET["searchCategoryName"]))
		 {
			 
			 echo "PRODUCTS";
		 }
		 
		  if(isset($_POST["search"]))
		 {
			
			 
			 echo "PRODUCTS";
		 }
			 ?>
         </span>
        <div id="thumbContainer">
       
       <?php
	   
	   /*------------------------------------------------------------------start of category  --------------------------------------------------------------*/

		$categoryName="";
		
	  	if(isset($_GET["categoryName"]) && !isset($_GET["page"])  )
		{
			 
			  global $categoryName;
	
			 $categoryName=trim(mysql_prep($_GET["categoryName"]));
			
			 
			 $products_set=get_products_details_for_category($categoryName);
			 $outputProducts=" ";
				
			 while ($productsDetails = mysql_fetch_array($products_set)) {		
			 	  				  
				  $outputProducts.="<div class=\"thumbs\">"; 	 
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
				  $outputProducts.="<img src=\"admin/productsImages/{$productsDetails["photo"]}\" class=\"thumbsImg\"/>";
				  $outputProducts.="</a><br/>";
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"more\">more info...</a> <br/>";$outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"productList.php?categoryName=" . urlencode($categoryName) . "&productId=" . urlencode($productsDetails["productId"]) ."\" class=\"button cart\">AddToCart</a></p>";
				  $outputProducts.="</div>";
		  
			}
		
			if (!empty($outputProducts)) {
	
				echo $outputProducts;
			}
		}
		
		
		$categoryNameForPages=$categoryName;
	  	if(isset($_GET["page"]) && isset($_GET["categoryName"])  )
		{

			
			if($_GET["page"]!=0)
			{
			global $categoryNameForPages;
			$categoryNameForPages="";

			
			$categoryNameForPages=trim(mysql_prep($_GET["categoryName"]));
			$page=$_GET["page"];			
			$products_set_for_pages=get_products_details_for_category_pages($categoryNameForPages,$page);
			$outputProductsPages=" ";
				
			 while ($productsDetailsForPages = mysql_fetch_array($products_set_for_pages)) {
				 			  
				  //$photo=$productsDetailsForPages["photo"];					  
				  $outputProductsPages.="<div class=\"thumbs\">"; 	 
				  $outputProductsPages.="<a href=\"details.php?productId=" . urlencode($productsDetailsForPages["productId"]) . "\">";
				  $outputProductsPages.="<img src=\"admin/productsImages/{$productsDetailsForPages["photo"]}\" class=\"thumbsImg\"/>";
				  $outputProductsPages.="</a><br/>";
				  $outputProductsPages.="<a href=\"details.php?productId=" . urlencode($productsDetailsForPages["productId"]) . "\" class=\"more\">more info...</a> <br/>";	  
$outputProductsPages.="<p class=\"price\">Price:BDT,{$productsDetailsForPages["price"]}<a href=\"productList.php?categoryName=" . urlencode($categoryNameForPages) . "& productId=" . urlencode($productsDetailsForPages["productId"]) ."\" class=\"button cart\">AddToCart</a></p>";
				  
				  $outputProductsPages.="</div>";
		  
			}
		}
			
			if (!empty($outputProductsPages)) {
	
				echo $outputProductsPages;
			}
		
		}
				

	 /*------------------------------------------------------------------End of category --------------------------------------------------------------*/  
	 
	 
	 
	/*------------------------------------------------------------------start of Subcategory --------------------------------------------------------------*/
	


	
		$subcategoryName="";
		
	  	if(isset($_GET["subcategoryName"]) && !isset($_GET["page"])  )
		{
			  
		
			  global $subcategoryName;
	
			 $subcategoryName=trim(mysql_prep($_GET["subcategoryName"]));
		
			 $products_set=get_products_details_for_subcategory($subcategoryName);
			 $outputProducts=" ";
				
			 while ($productsDetails = mysql_fetch_array($products_set)) {		
			 	  
				  $photo=$productsDetails["photo"];
				  $productId=$productsDetails["productId"];				  
				  $outputProducts.="<div class=\"thumbs\">"; 	 
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
				  $outputProducts.="<img src=\"admin/productsImages/{$photo}\" class=\"thumbsImg\"/>";
				  $outputProducts.="</a><br/>";
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"more\">more info...</a> <br/>";
				  $outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"productList.php?subcategoryName=" . urlencode($subcategoryName) . "& productId=" . urlencode($productsDetails["productId"]) ."\" class=\"button cart\">AddToCart</a></p>";
				  $outputProducts.="</div>";
		  
			}
		
			if (!empty($outputProducts)) {
	
				echo $outputProducts;
			}
		}
		
		
		$subcategoryNameForPages=$subcategoryName;
	  	if(isset($_GET["page"]) && isset($_GET["subcategoryName"])  )
		{
				if($_GET["page"]!=0)
				{
				global $subcategoryNameForPages;
	
				$subcategoryNameForPages="";
				$subcategoryNameForPages=trim(mysql_prep($_GET["subcategoryName"]));
			
				$page=$_GET["page"];			
				$products_set_for_pages=get_products_details_for_pages($subcategoryNameForPages,$page);
				$outputProductsPages=" ";
					
				 while ($productsDetailsForPages = mysql_fetch_array($products_set_for_pages)) {
								  
					  $photo=$productsDetailsForPages["photo"];					  
					  $outputProductsPages.="<div class=\"thumbs\">"; 	 
					  $outputProductsPages.="<a href=\"details.php?productId=" . urlencode($productsDetailsForPages["productId"]) . "\">";
					  $outputProductsPages.="<img src=\"admin/productsImages/{$photo}\" class=\"thumbsImg\"/>";
					  $outputProductsPages.="</a><br/>";
					  $outputProductsPages.="<a href=\"details.php?productId=" . urlencode($productsDetailsForPages["productId"]) . "\" class=\"more\">more info...</a> <br/>";
  					  $outputProductsPages.="<p class=\"price\">Price:BDT,{$productsDetailsForPages["price"]}<a href=\"productList.php?subcategoryName=".urlencode($subcategoryNameForPages)."& productId=" . urlencode($productsDetailsForPages["productId"]) ."\" class=\"button cart\">AddToCart</a></p>";

					  $outputProductsPages.="</div>"; 
			  
				}
			
			}
			
			if (!empty($outputProductsPages)) {
	
				echo $outputProductsPages;
			}
		
		}
				
		 /*------------------------------------------------------------------Endo of Subcategory --------------------------------------------------------------*/
	
	     /*------------------------------------------------------------------start of Search  --------------------------------------------------------------*/

				
		$searchCategoryName="";
		
	  	if(isset($_POST["search"]))
		{
			
			 global $searchCategoryName;
		
			 $searchCategoryName=trim(mysql_prep($_POST["searchVal"]));
		
	
			 $outputProducts=" ";
			 $products_set=get_products_details_for_search($searchCategoryName);
			 while ($productsDetails = mysql_fetch_array($products_set)) {
			  
			  $photo=$productsDetails["photo"];	  
			  $outputProducts.="<div class=\"thumbs\">"; 	 
			  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
			  $outputProducts.="<img src=\"admin/productsImages/{$photo}\" class=\"thumbsImg\"/>";
			  $outputProducts.="</a><br/>";
			  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\"class=\"more\">more info...</a> <br/>";
			  $outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"productList.php?searchCategoryName=" . urlencode($searchCategoryName). "                 & productId=" . urlencode($productsDetails["productId"]) ."\" class=\"button cart\">AddToCart</a></p>"; 
			  
			  $outputProducts.="</div>";
	  
		}
	
			if (!empty($outputProducts)){
	
				echo $outputProducts;
			}
		
		}
		
		  	
			if(isset($_GET["searchCategoryName"]) && !isset($_GET["page"]) )
			{
				
			  global $searchCategoryName;
		
			  
			
			  $searchCategoryName=trim(mysql_prep($_GET["searchCategoryName"]));
			  $outputProducts=" ";
			
			  $products_set=get_products_details_for_search($searchCategoryName);
			  while ($productsDetails = mysql_fetch_array($products_set)) {
				  
				    
				  				  
				  $photo=$productsDetails["photo"];					  
				  $outputProducts.="<div class=\"thumbs\">"; 	 
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
				  $outputProducts.="<img src=\"admin/productsImages/{$photo}\" class=\"thumbsImg\"/>";
				  $outputProducts.="</a><br/>";
				  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\" class=\"more\">more info...</a> <br/>";
				  $outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"productList.php?searchCategoryName=" .urlencode($searchCategoryName). "& productId=" . urlencode($productsDetails["productId"]) ."\" class=\"button cart\">AddToCart</a></p>"; 
				  $outputProducts.="</div>";
		  }
	
				if (!empty($outputProducts)) {
		
					echo $outputProducts;
				}
			}
		

    	if(isset($_GET["page"]) && isset($_GET["searchCategoryName"])  )
		{
	
			 global $searchCategoryName;
			
			 $searchCategoryName=trim(mysql_prep($_GET["searchCategoryName"]));
			 $page=$_GET["page"];
			
			 $outputProducts=" ";
			 $products_set=get_products_details_for_search_pages($searchCategoryName,$page);
			 while ($productsDetails = mysql_fetch_array($products_set)) {
			  
			  $photo=$productsDetails["photo"];
					  
			  $outputProducts.="<div class=\"thumbs\">"; 	 
			  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\">";
			  $outputProducts.="<img src=\"admin/productsImages/{$photo}\" class=\"thumbsImg\"/>";
			  $outputProducts.="</a><br/>";
			  $outputProducts.="<a href=\"details.php?productId=" . urlencode($productsDetails["productId"]) . "\"class=\"more\">more info...</a> <br/>";

			  $outputProducts.="<p class=\"price\">Price:BDT,{$productsDetails["price"]}<a href=\"productList.php?searchCategoryName=" .urlencode($searchCategoryName). " &productId=" . urlencode($productsDetails["productId"]) ."\" class=\"button cart\">AddToCart</a></p>"; 
			  
			  
			  $outputProducts.="</div>";
	  
		}
	
			if (!empty($outputProducts)) {
	
				echo $outputProducts;
			}
	
		}
	
	
     /*------------------------------------------------------------------End of Search --------------------------------------------------------------*/



		?>
  	

</table>


      </div>  <!-- End Of The content Thumbs Container--> 
      
      
				<?php 
				
				 /*----------------------------------------------------------------------Value for the counting Total pages----------------------------------------*/
				 
				 
				  /*------------Value for the counting Total pages for the searches-----------------*/
				  
				   $total_pages=0;
				   $total_pages_for_search=0;
				   if(isset($_POST["search"]))
				   {
					    global $total_pages_for_search;
						global $searchCategoryName;
						$sql = "SELECT * FROM productsdescription 
						WHERE categoryName like '%{$searchCategoryName}%' OR subcategoryName LIKE  '%{$searchCategoryName}%' OR productName LIKE  '%{$searchCategoryName}%'";					
					    $rs_result = mysql_query($sql,$connection);
					    $total_records = mysql_num_rows($rs_result);  //count number of records
						$total_pages_for_search = ceil($total_records / 9); 
				   }
				  	
				/*------------End of counting Total pages for the searches-----------------*/
				
				/*------------Value for the counting Total pages for the searches pages navigation-----------------*/
					
				   	else if(isset($_GET["searchCategoryName"]) )
				   {
					    global $total_pages_for_search;
						global $searchCategoryName;
						$sql = "SELECT * FROM productsdescription 
						WHERE categoryName like '%{$searchCategoryName}%' OR subcategoryName LIKE  '%{$searchCategoryName}%' OR productName LIKE  '%{$searchCategoryName}%'";
					
					    $rs_result = mysql_query($sql,$connection);
					    $total_records = mysql_num_rows($rs_result);  //count number of records
						$total_pages_for_search = ceil($total_records / 9); 
				   }
				   
				   
				  /*------------End of counting Total pages for the searches pages navigation-----------------*/
				  
				  
				/*------------Value for the counting Total pages for the category Menu pages-----------------*/
				
				 else if($categoryName)
				 {
						 	global $total_pages;
							$sql = "SELECT * FROM productsdescription where categoryName='{$categoryName}'"; 
							$rs_result = mysql_query($sql,$connection); //run the query
							$total_records = mysql_num_rows($rs_result);  //count number of records
							$total_pages = ceil($total_records / 9); 
				  }
				  
				  /*------------End of counting Total pages for the category Menu pages-----------------*/
				  
				  
				  /*------------Value for the counting Total pages for the category Menu pages navigation-----------------*/
				   
				     else if($categoryNameForPages)
					 {
							 global $total_pages; 
							$sql = "SELECT * FROM productsdescription where categoryName='{$categoryNameForPages}'"; 
							$rs_result = mysql_query($sql,$connection); //run the query
							$total_records = mysql_num_rows($rs_result);  //count number of records
							$total_pages = ceil($total_records / 9); 
				     }
					 
				/*------------End of counting Total pages for the category Menu pages navigation-----------------*/

				  
				/*------------Value for the counting Total pages for the subcategory Menu pages-----------------*/
				
				 else if($subcategoryName)
				 {
						 	global $total_pages;
							$sql = "SELECT * FROM productsdescription where subcategoryName='{$subcategoryName}'"; 
							$rs_result = mysql_query($sql,$connection); //run the query
							$total_records = mysql_num_rows($rs_result);  //count number of records
							$total_pages = ceil($total_records / 9); 
				  }
				  
				  /*------------End of counting Total pages for the subcategory Menu pages-----------------*/
				  
				  
				  /*------------Value for the counting Total pages for the subcategory Menu pages navigation-----------------*/
				   
				     else if($subcategoryNameForPages)
					 {
							 global $total_pages; 
							$sql = "SELECT * FROM productsdescription where subcategoryName='{$subcategoryNameForPages}'"; 
							$rs_result = mysql_query($sql,$connection); //run the query
							$total_records = mysql_num_rows($rs_result);  //count number of records
							$total_pages = ceil($total_records / 9); 
				     }
					 
				/*------------End of counting Total pages for the subcategory Menu pages navigation-----------------*/
	
				/*----------------------------------------------------------------------End of the counting Total pages----------------------------------------*/
                ?>
                      
           <div id="paging">
            
            	<ul>
  
                    <?php
                       
					   /*---------------------------------Pages indes for the search--------------------------------*/
                        if(isset($_POST["search"]))
                        {
							global $total_pages_for_search;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?searchCategoryName=".urlencode($searchCategoryName)."' class=\"active\">First</a></span></li>" ;
							for ($i=1; $i<=$total_pages_for_search; $i++) { 
							global $searchCategoryName;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($i)."& searchCategoryName=".urlencode($searchCategoryName)."'                            class=\"active\">".$i."</a></span> <li>"; 
						    }
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($total_pages_for_search)."& searchCategoryName=".urlencode(                             $searchCategoryName)."' class=\"active\">last</a></span> <li>";
                        }
						
						
						
						 else if(isset($_GET["searchCategoryName"]))
                        {
							global $total_pages_for_search;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?searchCategoryName=" .urlencode($searchCategoryName)."' class=\"active\">First</a></span></li>" ;
							for ($i=1; $i<=$total_pages_for_search; $i++) { 
							global $searchCategoryName;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($i)."& searchCategoryName=".urlencode($searchCategoryName)."'                            class=\"active\">".$i."	</a></span> <li>"; 
							
						    }
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($total_pages_for_search)."& searchCategoryName=".urlencode(                            $searchCategoryName  )."'class=\"active\">last</a></span> <li>";
                        }
						
						/*------------------------------------ Pages indexes for the category-------------------------------------------------------------*/
                      
						
						else if(isset($_GET["categoryName"])){
				                  
						 echo "<li><span class=\"pagingNumber\"><a href='productList.php?categoryName=" .urlencode($categoryNameForPages) ."' class=\"active\">First</a></span></li>" ;
						
						 for ($i=1; $i<=$total_pages; $i++) { 
							global $categoryNameForPages;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($i)."& categoryName=".urlencode($categoryNameForPages)."' class=\"active\">".$i."</a></span> <li>"; 
						}
						
						echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($total_pages)."& categoryName=".urlencode($categoryNameForPages)."' class=\"active\">last</a></span> <li>";
					  }
						
						/*---------------------------------Pages indes for the navigaton menu for subcategory--------------------------------*/
						else if(isset($_GET["subcategoryName"])){
				                  
						   echo "<li><span class=\"pagingNumber\"><a href='productList.php?subcategoryName=".urlencode($subcategoryNameForPages)."' class=\"active\">First</a></span></li>" ;
						
							for ($i=1; $i<=$total_pages; $i++) { 
							global $subcategoryNameForPages;
							echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($i)."& subcategoryName=".urlencode($subcategoryNameForPages)."' class=\"active\">".$i."</a></span> <li>"; 
							}
						
						
						 echo "<li><span class=\"pagingNumber\"><a href='productList.php?page=".urlencode($total_pages)."& subcategoryName=".urlencode($subcategoryNameForPages)."' class=\"active\">last</a></span> <li>";
					  }
                     ?>

                
                </ul>
            
            </div>
      
  </div>  <!-- End Of The Content--> 
  
<?php require_once("includes/front_footer.php"); ?>