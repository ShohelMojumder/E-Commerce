
<?php require_once("includes/connection.php"); ?>

<select class="element select large"  name="subcategoryName"> 

	<?php
	
	   if(isset($_GET['cat']))
   	   {
			$c = $_GET['cat'];
			$subcategory = '';
			
			$r = mysql_query("SELECT `subcategoryId`, `subcategoryName` FROM subcategory WHERE categoryId='$c'");
        
        while($row = mysql_fetch_assoc($r))
        {
			echo "<option>{$row['subcategoryName']}</option>";
        }
        

   		}
	?>
</select>