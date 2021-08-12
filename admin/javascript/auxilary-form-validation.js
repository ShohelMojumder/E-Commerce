

function formValidation()
{	
	var about = document.auxilary.about;
	var ship = document.auxilary.shipping;
	
	
	if(aboutUs(about))
	{
		if(shipping(ship))
		{
			return true;
		}
				
	}
	return false;
} 

function aboutUs(about)
{

	/*
	
	var letters=/^[A-Za-z0-9 ]{4,300}$/; //this is for the validatatio if we have the blank space in the name also
	if(about.value.match(letters))
	{
		about.style.background = '';
		return true;
	}
	else
	{
		alert('About Us value cannot be empty');
		about.style.background = '#ffff99';
		about.focus();
		return false;
	}
		
	return true;
	*/
		
		if(about.value.trim() == "")
		{
			alert('About Us value cannot be empty');
			about.style.background = '#ffff99';
			about.focus();
			return false;
			
		}
		else
		{
			return true;
		}
		return true;
}


function shipping(ship)
{
	
	/*
		var letters=/^[A-Za-z0-9 ]{4,300}$/; //this is for the validatatio if we have the blank space in the name also
		if(ship.value.match(letters))
		{
			ship.style.background = '';
			return true;
		}
		else
		{
			alert('Shipping value cannot be empty');
			ship.style.background = '#ffff99';
			ship.focus();
			return false;
		}
			
		return true;
		*/
		
		if(about.value.trim() == "")
		{
			alert('About Us value cannot be empty');
			about.style.background = '#ffff99';
			about.focus();
			return false;
			
		}
		else
		{
			return true;
		}
		return true
}


