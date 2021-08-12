
<?php require_once("includes/session.php"); ?>
<?php 

	if(isset($_SESSION['cart'])){
		unset($_SESSION['cart']);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smart Shop</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div id="header">
	<table width=100% align="center">
    	<tr> 
        	<td><a href="index.php"><img src="images/image.png" id="logoImg"/></a> </td>
            <td align="center">  
                 
                 <form action="#">
                     <input type="text" placeholder="Search..." required class="search">
                     <span class="searchArrow">
                     <input type="button" value="Search" class="searchButton">
                     </span>
                </form>
            </td>
            <td  align="right"><a href="login.php" class="btn"> LOGIN/REGISTER</a></td>
        </tr>
     </table>
    
        <div id="button">
            <a href="index.php" class="btn">HOME</a>
            <a href="priceList.php" class="btn">PRICE LIST</a>
            <a href="delivery.php" class="btn">DELIVERY</a>
            <a href="aboutUs.php" class="btn">ABOUTUS</a>
        </div>
        
</div>

	<div id="navMain">
		<div id="nav">
        	<div align="center" id="navHead">
            	
             </div>

        </div>
    	<div id="navBelow">
            
        </div> 
    </div>	
	<div id="content" align="center">
    
    <p id="orderComplete">  
    <br/><br/><br/>
    Thanks  for your order! We will contact you as soon as possible.<br/><br/>	<br/>		
    How about shopping for some more products in our <a href="index.php">SMART SHOP</a>
    </p>


  </div>  <!-- End Of The Content--> 

<div id="footer" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SmartShop&copy;2015</div>

</body>