
function formValidation()
{
	var uname = document.createUser.userName;
	var passid = document.createUser.password;
	var cpassid = document.createUser.cpassword;
	

			if(allLetter(uname))
			{
				if(passid_validation(passid,4,30))
				{ 
						if(confirm_passid_validation(cpassid,4,30))
						{
							return true;
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
		alert('Username must have alphabet characters only');
		uname.focus();
		return false;
	}
}


function passid_validation(passid,mx,my)
{

	var passid_len = passid.value.length;
	if (passid_len == 0 ||passid_len >= my || passid_len < mx)
	{
		alert("Password should not be empty / length be between "+mx+" to "+my);
		passid.focus();
		return false;
	}
	return true;
}


function confirm_passid_validation(cpassid,mx,my)
{
	
	var val1=document.createUser.password.value;
	var val2=document.createUser.cpassword.value;
	var cpassid_len = cpassid.value.length;
	if (cpassid_len == 0 ||cpassid_len >= my || cpassid_len < mx || val1 != val2)
	{

			alert("Password and confirm passowrd should  be same and between "+mx+" to "+my);
			cpassid.focus();
			return false;
	}	
	return true;
}


