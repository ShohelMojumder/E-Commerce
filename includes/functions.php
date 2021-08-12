
<?php require_once("includes/session.php"); ?>

<?php
	// This file is the place to store all basic functions

	function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}
	
	

/*----------------------Functions For ShoppingCarts--------------------------------------*/


	function get_product_name($pid){
		$result=mysql_query("select productName from productsDescription where productId=$pid") or die("select name from products where productId=$pid"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['productName'];
	}
	function get_price($pid){
		$result=mysql_query("select price from productsDescription where productId=$pid") or die("select price from products where productId=$pid"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['price'];
	}
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	function addtocart($pid,$q){
		
		//put the confirmlogin here
			confirm_logged_in();
		
		$pid=intval($pid);
		
		
		if($pid<1 or $q<1) return;
		
		
		if(isset($_SESSION['cart']))
		{
		
			if(is_array($_SESSION['cart'])){
				//if(product_exists($pid)) return;
				if(product_exists($pid)){
					$max=count($_SESSION['cart']);
					for($i=0;$i<$max;$i++){
						if($pid==$_SESSION['cart'][$i]['productid']){
							$_SESSION['cart'][$i]['qty']=intval($_SESSION['cart'][$i]['qty'])+1;
							break;
						}
					}
			
				}
				
				
				if(product_exists($pid)!=1){
					$max=count($_SESSION['cart']);
					$_SESSION['cart'][$max]['productid']=$pid;
					$_SESSION['cart'][$max]['qty']=$q;
				
				}
				/*
				$max=count($_SESSION['cart']);
				$_SESSION['cart'][$max]['productid']=$pid;
				$_SESSION['cart'][$max]['qty']=$q;
				*/
			}
			
		}
			else{
				$_SESSION['cart']=array();
				$_SESSION['cart'][0]['productid']=$pid;
				$_SESSION['cart'][0]['qty']=$q;
			}
		
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}



	//-----------------------Later For checkout---------------
	
	function get_payableAmount(){
		$payableAmount=0;
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_actual_price($pid);
			$payableAmount=$payableAmount+($price*$q);			
		}
		
		return $payableAmount;
	}


	function get_discountAmount(){
		
		$payable=get_payableAmount();
		$totalAmount=get_order_total();
		
		$discountAmount=($totalAmount-$payable);
		
		return $discountAmount;
	}
	
	
	function get_discountPercent(){
		
		$discountAmount=get_discountAmount();
		$totalAmount=get_order_total();
		$discountPercent=($discountAmount/$totalAmount)*100; // take ceil 
		$discountPercentFloor=ceil($discountPercent);
		return $discountPercentFloor;
		
		
	}
	
	function get_actual_price($pid)
	{
	 $result=mysql_query("select actualPrice from productsDescription where productId=$pid") or die("select actualPrice from products where productId=$pid"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['actualPrice'];
	}
	
	function get_quantity()
	{
		  $max=count($_SESSION['cart']);
		  $q=0;
		  for($i=0;$i<$max;$i++){
		  $q=$q+$_SESSION['cart'][$i]['qty'];
		  }
		  
		  return $q;
			
	}

?>