
function formValidation()
{
	var uname = document.changePassword.userName;
	var passid = document.changePassword.currentPassword;
	var npassid = document.changePassword.npassword;
	var cpassid = document.changePassword.confirmPassword;
	

			if(allLetter(uname))
			{
				if(current_passid_validation(passid,4,30))
				{ 
					if(passid_validation(npassid,4,30))
					{ 
							if(confirm_passid_validation(cpassid,4,30))
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
	//var letters = /^[A-Za-z]+$/;
	var letters=/^[A-Za-z0-9]{4,30}$/;
	if(uname.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Please insert correct Username');
		uname.focus();
		return false;
	}
}


function current_passid_validation(passid,mx,my)
{

	var passid_len = passid.value.length;
	if (passid_len == 0 ||passid_len >= my || passid_len < mx)
	{
		alert("Password should not be empty and Should be correct "+mx+" to "+my);
		passid.focus();
		return false;
	}
	return true;
}


function passid_validation(npassid,mx,my)
{

	var passid_len = npassid.value.length;
	if (passid_len == 0 ||passid_len >= my || passid_len < mx)
	{
		alert("Password should not be empty / length be between "+mx+" to "+my);
		npassid.focus();
		return false;
	}
	return true;
}


function confirm_passid_validation(cpassid,mx,my)
{
	var val1=document.changePassword.npassword.value;
	var val2=document.changePassword.confirmPassword.value;
	var cpassid_len = cpassid.value.length;
	if (cpassid_len == 0 ||cpassid_len >= my || cpassid_len < mx || val1 != val2)
	{

			alert("Password should  be same and length be between"+mx+" to "+my);
			cpassid.focus();
			return false;
	}	
	return true;
}


