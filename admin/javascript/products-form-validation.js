

function formValidation()
{
	var cname = document.addProducts.categoryId;
	var sname = document.addProducts.subcategoryName;
	var pname = document.addProducts.productName;
	var price = document.addProducts.price;
	var discount = document.addProducts.discount;
	var actualPrice = document.addProducts.actualPrice;
	
	
	var quantity = document.addProducts.quantity;
	
	
	
	var photoName = document.addProducts.photoName;
	var sphoto = document.addProducts.smallPhoto;
	var lphoto = document.addProducts.largePhoto;
	
	

	var desc = document.addProducts.desc;
	
	

	if(categorySelect(cname))
	{
		//if(subcategorySelect(sname))
		//{
			
			if(productName(pname))
			{
				
				if(priceCheck(price))
				{
					
					if(discountCheck(discount))
					{
						
						if(actualPriceCheck(actualPrice))
						{
							
						 	if(quantityCheck(quantity))
							 {	
							 	
							
								if(photoNameCheck(photoName))
								{
									/*
									if(smallPhoto(sphoto))
									{
										
										if(largePhoto(lphoto))
										{*/
											if(description(desc))
											{
												return true;
											}
													
									   //}
								   //}
							 	} 
						 	}
						}
					 } 
				}
			}
		//}
	}
	return false;

} 

function categorySelect(cname)
{

	if(cname.value == "Default")
	{
		alert('Select a category from the list');
		cname.focus();
		return false;
	}
	else
	{
		return true;
	}
	
	
	
}

/*
function subcategorySelect(sname)
{
	
	/*
	if(sname.value == "Default")
	{
		alert('Select a subcategory from the list');
		sname.focus();
		return false;
	}
	else
	{
		return true;
	}
	

	
	var sname_len = sname.value.length;
	if (sname_len== 0)
	{
		alert("PSelect a category from the list");
		cname.focus();
		return false;
	}
	return true;
	
}
*/

function productName(pname)
{ 
	/*
	var letters = /^[0-9a-zA-Z]+$/;
	if(pname.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Products name must have alphanumeric characters only');
		pname.focus();
		return false;
	}
	*/
	
	if(pname.value.trim() == "")
	{
		alert('Products name must have alphanumeric characters only');
		pname.focus();
		return false;
		
	}
	else
	{
		return true;
	}
	
	
}

function priceCheck(price)
{ 
	var numbers = /^[0-9]+$/;
	if(price.value.match(numbers))
	{
		return true;
	}
	else
	{
		alert('price must have numeric characters only');
		price.focus();
		return false;
	}
}


function discountCheck(discount)
{
	var numbers = /^[0-9]+$/;
	if(discount.value.match(numbers))
	{
		return true;
	}
	else
	{
			alert('Discount must have numeric only');
			discount.focus();
			return false;
	}
}

function actualPriceCheck(actualPrice)
{
	
	var numbers = /^[0-9]+$/;
	if(actualPrice.value.match(numbers))
	{
		return true;
	}
	else
	{
		alert('Actual Price must have numeric characters only');
		actualPrice.focus();
		return false;
	}
	

} 



function quantityCheck(quantity)
{
	var numbers = /^[0-9]+$/;
	if(quantity.value.match(numbers))
	{
		return true;
	}
	else
	{
			alert('quantity must have numeric only');
			quantity.focus();
			return false;
	}
}

function photoNameCheck(photoName)
{ 
	var letters = /^[0-9a-zA-Z]+$/;
	if(photoName.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Photo name must have alphanumeric characters only');
		photoName.focus();
		return false;
	}
}



/*photo Validation check

function smalPhoto(sphoto)
{
	
	var sphoto_len = sphoto.value.length;
	if (sphoto_len== 0)
	{
		alert("Please Enter a Photo Name");
		sphoto.focus();
		return false;
	}
	return true;
}


function largePhoto(lphoto)
{
	var lphoto_len = sphoto.value.length;
	if (lphoto_len== 0)
	{
		alert("Please Enter a Photo Name");
		lphoto.focus();
		return false;
	}
	return true;
}

*/
function description(desc)
{
	
	var letters = /^[0-9a-zA-Z]+$/;
	if(desc.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Description must have alphanumeric characters only');
		desc.focus();
		return false;
	}
	
}