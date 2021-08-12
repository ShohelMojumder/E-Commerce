
function formValidation()
{
	var cname = document.subcategory.categoryId;
	var sname = document.subcategory.subcategoryName;

	if(categorySelect(cname))
	{
		if(subcategorySelect(sname))
		{
			return true;
		}
	}
	return false;
} 

function categorySelect(cname)
{
	/*

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

	*/

	if(cname.value.trim() == "")
	{
		alert('Please select a category Name');
		cname.focus();
		return false;
		
	}
	else
	{
		return true;
	}
}

function subcategorySelect(sname)
{
	//var letters = /^[0-9a-zA-Z ]+$/;
	/*
	var letters=/^[A-Za-z0-9 ]{3,30}$/;
	if(sname.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Subcategory name must have alphanumeric characters only and between 3 to 30');
		sname.focus();
		return false;
	}
	*/
	
	if(sname.value.trim() == "")
	{
		alert('Please Enter a subcategory Name');
		sname.focus();
		return false;
		
	}
	else
	{
		return true;
	}
}

