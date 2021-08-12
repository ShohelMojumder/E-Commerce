
function formValidation()
{

	var uname = document.adminLogin.userName;
	var passid = document.adminLogin.password;


			if(allLetter(uname))
			{
					if(passid_validation(passid,4,30))
					{ 
	
							return true;
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




