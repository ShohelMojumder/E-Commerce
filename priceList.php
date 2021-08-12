<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/front_functions.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/htmlTable.css"/>
</head>
<body>
<div id="header">
	<table width=100% align="center">
    	<tr> 
        	<td><a href="index.php"><img src="images/image.png" id="logoImg"/></a> </td>
            <td align="center">  
            <form action="productList.php" method="post">
                     <input type="text" placeholder="Search..." required class="search" name="searchVal">
                     <span class="searchArrow">
                     <input type="submit" value="Search" class="searchButton" name="search">
                     </span>
                </form>
            </td>
            <td  align="right"><?php if(!logged_in()){?> <a href="login.php" class="btn">LOGIN/REGISTER</a><?php }else{?>
            <a href="logout.php" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;LOGOUT&nbsp;&nbsp;&nbsp;&nbsp;</a></td><?php }?></td>
        </tr>
     </table>
    
         <div id="button">
            <a href="index.php" class="btn">HOME</a>
            <a href="priceList.php" class="btn">PRICE LIST</a>
            <a href="delivery.php" class="btn">DELIVERY</a>
            <a href="aboutUs.php" class="btn">ABOUTUS</a>
        </div>
        
</div>



	<div id="priceListContent">
   
   		<div class="datagrid">




<table>
<?php
	$priceListOutputShow=priceListShow();
		if (!empty($priceListOutputShow)) {
			echo $priceListOutputShow;
		}

?>
</table>


</div>
  
  </div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>

</body>