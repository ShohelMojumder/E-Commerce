function formValidation()
{
	
	var fname = document.checkOut.firstName;
	var lname = document.checkOut.lastName;
	
	
	
	var uadd = document.checkOut.address;
	var ucity = document.checkOut.city;
	
	var uzip = document.checkOut.zip;
	
	var phone=document.checkOut.phoneNumber;
	var uemail = document.checkOut.email;

	
	 if(allLetter(fname))
	 {
			if(allLetter(lname))
			{
				if(alphanumeric(uadd))
				{ 
					if(allLetter(ucity))
					{
						if(allnumeric(uzip))
						{
							if(allnumeric(phone))
							{
								if(ValidateEmail(uemail))
								{

										return true;
									
								}
							} 
						}
					} 
				}
			}
	 }
	
	return false;

} 



function allLetter(uname)
{ 
	//var letters = /^[A-Za-z]+$/;
	var letters=/^[A-Za-z0-9 ]{4,40}$/; //this is for the validatatio if we have the blank space in the name also
	
	
	if(uname.value.match(letters))
	{
		uname.style.background = '';
		return true;
	}
	else
	{
		alert(uname.name+' must have Alphanumeric characters only and between 4 to 40 characters');
		uname.style.background = '#ffff99';
		uname.focus();
		return false;
	}
}

function alphanumeric(uadd) 
{ 
		
	if(uadd.value.trim() == "")
	{
		alert('Please Enter the address');
		uadd.focus();
		return false;
		
	}
	else
	{
		return true;
	}
}


function countryselect(ucountry)
{
	if(ucountry.value == "Default")
	{
		alert('Select your country from the list');
		ucountry.style.background = '#ffff99';
		ucountry.focus();
		return false;
	}
	else
	{
		ucountry.style.background = '';
		return true;
	}
}

function allnumeric(uzip)
{ 
	var numbers = /^[0-9]+$/;
	if(uzip.value.match(numbers))
	{
		uzip.style.background = '';
		return true;
	}
	else
	{
		alert(uzip.name+' must have numeric characters only');
		uzip.style.background = '#ffff99';
		uzip.focus();
		return false;
	}
}




function ValidateEmail(uemail)
{
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(uemail.value.match(mailformat))
	{
		uemail.style.background = '';
		return true;
	}
	else
	{
		uemail.style.background = '#ffff99';
		alert("You have entered an invalid email address!");
		return false;
	}
} 

