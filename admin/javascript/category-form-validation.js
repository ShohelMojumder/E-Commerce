

function formValidation()
{	
	var cname = document.category.categoryName;

	if(categorySelect(cname))
	{
			return true;
	}
	return false;
} 

function categorySelect(cname)
{

	//var letters = /^[0-9a-zA-Z]+$/;
	/*
	var letters=/^[A-Za-z0-9 ]{3,30}$/;
	if(cname.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Category Name must have alphanumeric characters only and between 3 to 30');
		cname.focus();
		return false;
	}
	
	*/
	
		
	if(cname.value.trim() == "")
	{
		alert('Please Enter a category Name');
		cname.focus();
		return false;
		
	}
	else
	{
		return true;
	}
}


