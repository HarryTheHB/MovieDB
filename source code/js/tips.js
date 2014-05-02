function checkEmail(email){
	var emailRegExp = new RegExp("[a-z0-9!#%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&`*+/=?^_`{|}~-]+)*@(?:[1-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
	if(!emailRegExp.test(email)||email.indexOf('.')==-1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function test(obj)
{
	if(obj=="mail")
	{
		var email=$.trim($("input[name='mail1']").val());
		if(email=="")
		{
			$(".email_tip").text("email can not be null！");
		}
		else
		{
			if(!checkEmail(email))
			{
				$(".email_tip").text("email format wrong！");
			}
			else
			{
				$(".email_tip").text("email format right！");
			}
		}
	}
	$(".email_tip").show();
}