




function validateSample()
{
	var name=document.getElementById("Name").value;
	var email=document.getElementById("Email").value;
	var phone=document.getElementById("Phone").value;
	var err="";
	
	if(isEmpty(name)==1)
	{
		err+="\n- Name should not be empty.";
	}
	if(isAlphabet(name)==1)
	{
		err+="\n- Name should has Alphabetic Only.";
	}
	
	if(isEmpty(email)==1)
	{
		err+="\n- Email should not be Empty.";
	}
	if(isEmail(email)==1)
	{
		err+="\n- Email should not has Invalid Format.";
	}
	
	if(isEmpty(phone)==1)
	{
		err+="\n- Phone should not be Empty.";
	}
	if(isNumeric(phone)==1)
	{
		err+="\n- Phone should has Numeric Only.";
	}
	if(isSize(phone,10,10)==1)
	{
		err+="\n- Phone should has 10 digits.";
	}
	if(isLimit(phone,0)==1)
	{
		err+="\n- Phone should be greater than zero.";
	}	
	
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateUser()
{
	var filled_area_pin_code=document.getElementById("filled_area_pin_code").value;
	var filled_e_mail=document.getElementById("filled_e_mail").value;
	var filled_contact_no=document.getElementById("filled_contact_no").value;
	var err="";
	
	
	if(isSize(filled_area_pin_code,6,6)==1)
	{
		err+="\n- PinCode size should be in 6 digits.";
	}	
	if(isLimit(filled_area_pin_code,0)==1)
	{
		err+="\n- PinCode should be greater than zero.";
	}	
	if(isEmail(filled_e_mail)==1)
	{
		err+="\n- Email Format should be valid and proper.";
	}	
	if(isSize(filled_contact_no,10,10)==1)
	{
		err+="\n- Contact No size should be in 10 digits.";
	}
	if(isLimit(filled_contact_no,0)==1)
	{
		err+="\n- Contact should be greater than zero.";
	}	
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateSource()
{
	var filled_e_mail=document.getElementById("filled_e_mail").value;
	var filled_contact_no=document.getElementById("filled_contact_no").value;
	var err="";
	
	
	if(isEmail(filled_e_mail)==1)
	{
		err+="\n- Email Format should be valid and proper.";
	}	
	if(isSize(filled_contact_no,10,10)==1)
	{
		err+="\n- Contact No size should be in 10 digits.";
	}
	if(isLimit(filled_contact_no,0)==1)
	{
		err+="\n- Contact should be greater than zero.";
	}	
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateBank()
{
	var filled_account_no=document.getElementById("filled_account_no").value;
	var filled_micr=document.getElementById("filled_micr").value;
	var err="";
	
		
	if(isLimit(filled_account_no,0)==1)
	{
		err+="\n- Account No should be greater than zero.";
	}
	if(isLimit(filled_micr,0)==1)
	{
		err+="\n- MICR Code should be greater than zero.";
	}	
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateServiceMtCharges()
{
	var filled_from=document.getElementById("filled_from").value;
	var filled_to=document.getElementById("filled_to").value;
	var filled_flat=document.getElementById("filled_flat").value;
	var filled_percent=document.getElementById("filled_percent").value;
	var err="";
	
		
	if(isLimit(filled_from,-1)==1)
	{
		err+="\n- Amount From should be greater than or equal to zero.";
	}
	if(isLimit(filled_to,-1)==1)
	{
		err+="\n- Amount Upto should be greater than or equal to zero.";
	}	
	if(isDecimal(filled_flat)==1)
	{
		err+="\n- Charge (Flat) should be numarice, positve, two decimal values like 123456.78 only.";
	}	
	if(isDecimal(filled_percent)==1)
	{
		err+="\n- Charge (Percent) should be numarice, positve, two decimal values like 123456.78 only.";
	}
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateClient()
{
	var filled_pin=document.getElementById("filled_pin").value;
	var filled_e_mail=document.getElementById("filled_e_mail").value;
	var filled_contact_no=document.getElementById("filled_contact_no").value;
	var filled_pan=document.getElementById("filled_pan").value;
	var filled_regamt=document.getElementById("filled_regamt").value;
	var filled_walbal=document.getElementById("filled_walbal").value;
	var err="";
	
	
	if(isSize(filled_pin,6,6)==1)
	{
		err+="\n- PinCode size should be in 6 digits.";
	}	
	if(isLimit(filled_pin,0)==1)
	{
		err+="\n- PinCode should be greater than zero.";
	}	
	if(isEmail(filled_e_mail)==1)
	{
		err+="\n- Email Format should be valid and proper.";
	}	
	if(isSize(filled_contact_no,10,10)==1)
	{
		err+="\n- Contact No size should be in 10 digits.";
	}
	if(isLimit(filled_contact_no,0)==1)
	{
		err+="\n- Contact should be greater than zero.";
	}		
	if(isSize(filled_pan,10,10)==1)
	{
		err+="\n- Pan Card No size should be in 10 digits.";
	}	
	if(isLimit(filled_regamt,-1)==1)
	{
		err+="\n- Registration Amount should be greater than or equal to zero.";
	}		
	if(isLimit(filled_walbal,-1)==1)
	{
		err+="\n- Wallet Balance should be greater than or equal to zero.";
	}		
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
}










function validateAmount()
{	
	var filled_amount=document.getElementById("filled_amount").value;
	var err="";
	
	
	if(isLimit(filled_amount,0)==1)
	{
		err+="\n- Amount should be greater than zero.";
	}
	if(isDecimal(filled_amount)==1)
	{
		err+="\n- Amount should be numarice, positve, two decimal values like 123456.78 only.";
	}
	if(err=="")
	{
		return true;
	}
	else
	{
		alert(err);
		return false;
	}
	
}




