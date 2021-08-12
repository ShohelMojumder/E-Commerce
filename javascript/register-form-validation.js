
function formValidation()
{	

	var uname = document.userRegistraion.userName;
	var uemail = document.userRegistraion.email;
	var passid = document.userRegistraion.password;
	var cpassid = document.userRegistraion.cpassword;
	

			if(allLetter(uname))
			{
				if(ValidateEmail(uemail))
				{ 
					if(passid_validation(passid,5,30))
					{ 
							if(confirm_passid_validation(cpassid,5,30))
							{
								return true;
							}
					}
				}
			}

	return false;
} 





function allLetter(uname)
{ 
	var letters = /^[A-Za-z]+$/;
	
	//var letters=/^[A-Za-z0-9 ]{4,30}$/; 
	if(uname.value.match(letters))
	{
		uname.style.background = '';
		return true;
	}
	else
	{
		alert('Username must have alphabet characters only and donot contain space');
		uname.style.background = '#ccccff';
		uname.focus();
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
		alert("You have entered an invalid email address!");
		
		uemail.style.background = '#ccccff';
		return false;
	}
} 


function passid_validation(passid,mx,my)
{

	var passid_len = passid.value.length;
	if (passid_len == 0 ||passid_len >= my || passid_len < mx)
	{
		alert("Password should not be empty / length be between "+mx+" to "+my);
		passid.style.background = '#ccccff';
		passid.focus();
		return false;
	}
	passid.style.background = '';
	return true;
}


function confirm_passid_validation(cpassid,mx,my)
{
	
	var val1=document.userRegistraion.password.value;
	var val2=document.userRegistraion.cpassword.value;
	var cpassid_len = cpassid.value.length;
	if (cpassid_len == 0 ||cpassid_len >= my || cpassid_len < mx || val1 != val2)
	{

			alert("Password and confirm password should  be same and length be between "+mx+" to "+my);
			cpassid.style.background = '#ccccff';
			cpassid.focus();
			return false;
	}
	cpassid.style.background = '';	
	return true;
}


