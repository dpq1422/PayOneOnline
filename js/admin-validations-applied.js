



function validateSample()
{
	var name=document.getElementById("Name").value;
	var email=document.getElementById("Email").value;
	var phone=document.getElementById("Phone").value;
	var err="";
	
	if(isEmpty(name)==1)
	{
		err+="\n- Name should not be empty";
	}
	if(isAlphabet(name)==1)
	{
		err+="\n- Name should has Alphabetic Only";
	}
	
	if(isEmpty(email)==1)
	{
		err+="\n- Email should not be Empty";
	}
	if(isEmail(email)==1)
	{
		err+="\n- Email should not has Invalid Format";
	}
	
	if(isEmpty(phone)==1)
	{
		err+="\n- Phone should not be Empty";
	}
	if(isNumeric(phone)==1)
	{
		err+="\n- Phone should has Numeric Only";
	}
	if(isSize(phone,10,10)==1)
	{
		err+="\n- Phone should has 10 digits";
	}
	if(isLimit(phone,0)==1)
	{
		err+="\n- Phone should be greater than zero";
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
	var AadharNumber=document.getElementById("AadharNumber").value;
	var Email=document.getElementById("Email").value;
	var MobileNumber=document.getElementById("MobileNumber").value;
	var Password=document.getElementById("Password").value;
	var ConfirmPassword=document.getElementById("ConfirmPassword").value;
	var PinCode=document.getElementById("PinCode").value;	
	var GsMobileNumber=document.getElementById("GsMobileNumber").value;
	var err="";
	
	
	if(isSize(AadharNumber,12,12)==1)
	{
		err+="\n- Aadhar Number size should be in 12 digits";
	}	
	if(isLimit(AadharNumber,0)==1)
	{
		err+="\n- Aadhar Number should be greater than zero";
	}	
	if(isEmail(Email)==1)
	{
		err+="\n- Email Format should be valid and proper";
	}	
	if(isSize(MobileNumber,10,10)==1)
	{
		err+="\n- Mobile Number size should be in 10 digits";
	}
	if(isLimit(MobileNumber,0)==1)
	{
		err+="\n- Mobile Number should be greater than zero";
	}		
	if(pass_comb(Password)==false)
	{
		err+="\n- Password have atleast 1 Caps, 1 Small, 1 Num & 1 Special Char";
	}
	if(isSize(Password,6,6)==1)
	{
		err+="\n- Password size should be in 6 digits";
	}	
	if(isLimit(Password,0)==1)
	{
		err+="\n- Password should be greater than zero";
	}	
	if(isSize(ConfirmPassword,6,6)==1)
	{
		err+="\n- Confirm Password size should be in 6 digits";
	}	
	if(isLimit(ConfirmPassword,0)==1)
	{
		err+="\n- Confirm Password should be greater than zero";
	}	
	if(Password!=ConfirmPassword)
	{
		err+="\n- Password and Confirm Password should be same";
	}
	if(isSize(PinCode,6,6)==1)
	{
		err+="\n- PinCode size should be in 6 digits";
	}	
	if(isLimit(PinCode,0)==1)
	{
		err+="\n- PinCode should be greater than zero";
	}	
	if(isSize(GsMobileNumber,10,10)==1)
	{
		err+="\n- Guardian / Spouse Mobile Number size should be in 10 digits";
	}
	if(isLimit(GsMobileNumber,0)==1)
	{
		err+="\n- Guardian / Spouse Mobile Number should be greater than zero";
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










function validateDistributor()
{
	var AadharNumber=document.getElementById("AadharNumber").value;
	var Email=document.getElementById("Email").value;
	var MobileNumber=document.getElementById("MobileNumber").value;
	var Password=document.getElementById("Password").value;
	var ConfirmPassword=document.getElementById("ConfirmPassword").value;
	var PinCode=document.getElementById("PinCode").value;	
	var GsMobileNumber=document.getElementById("GsMobileNumber").value;
	var err="";
	
	
	if(isSize(AadharNumber,12,12)==1)
	{
		err+="\n- Aadhar Number size should be in 12 digits";
	}	
	if(isLimit(AadharNumber,0)==1)
	{
		err+="\n- Aadhar Number should be greater than zero";
	}	
	if(isEmail(Email)==1)
	{
		err+="\n- Email Format should be valid and proper";
	}	
	if(isSize(MobileNumber,10,10)==1)
	{
		err+="\n- Mobile Number size should be in 10 digits";
	}
	if(isLimit(MobileNumber,0)==1)
	{
		err+="\n- Mobile Number should be greater than zero";
	}		
	if(pass_comb(Password)==false)
	{
		err+="\n- Password have atleast 1 Caps, 1 Small, 1 Num & 1 Special Char";
	}
	if(isSize(Password,6,6)==1)
	{
		err+="\n- Password size should be in 6 digits";
	}	
	if(isLimit(Password,0)==1)
	{
		err+="\n- Password should be greater than zero";
	}	
	if(isSize(ConfirmPassword,6,6)==1)
	{
		err+="\n- Confirm Password size should be in 6 digits";
	}	
	if(isLimit(ConfirmPassword,0)==1)
	{
		err+="\n- Confirm Password should be greater than zero";
	}	
	if(Password!=ConfirmPassword)
	{
		err+="\n- Password and Confirm Password should be same";
	}
	if(isSize(PinCode,6,6)==1)
	{
		err+="\n- PinCode size should be in 6 digits";
	}	
	if(isLimit(PinCode,0)==1)
	{
		err+="\n- PinCode should be greater than zero";
	}	
	if(isSize(GsMobileNumber,10,10)==1)
	{
		err+="\n- Alternate Mobile Number size should be in 10 digits";
	}
	if(isLimit(GsMobileNumber,0)==1)
	{
		err+="\n- Alternate Mobile Number should be greater than zero";
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










function validateRetailer()
{
	//var AadharNumber=document.getElementById("AadharNumber").value;
	var Email=document.getElementById("Email").value;
	var MobileNumber=document.getElementById("MobileNumber").value;
	var Password=document.getElementById("Password").value;
	var ConfirmPassword=document.getElementById("ConfirmPassword").value;
	var PinCode=document.getElementById("PinCode").value;	
	//var GsMobileNumber=document.getElementById("GsMobileNumber").value;
	var soamts=document.getElementById("soamts").value;
	var err="";
	
	/*
	if(isSize(AadharNumber,12,12)==1)
	{
		err+="\n- Aadhar Number size should be in 12 digits";
	}	
	if(isLimit(AadharNumber,0)==1)
	{
		err+="\n- Aadhar Number should be greater than zero";
	}		
	*/
	if(isEmail(Email)==1)
	{
		err+="\n- Email Format should be valid and proper";
	}
	if(isSize(MobileNumber,10,10)==1)
	{
		err+="\n- Mobile Number size should be in 10 digits";
	}
	if(isLimit(MobileNumber,0)==1)
	{
		err+="\n- Mobile Number should be greater than zero";
	}		
	if(pass_comb(Password)==false)
	{
		err+="\n- Password have atleast 1 Caps, 1 Small, 1 Num & 1 Special Char";
	}
	if(isSize(Password,6,6)==1)
	{
		err+="\n- Password size should be in 6 digits";
	}	
	if(isLimit(Password,0)==1)
	{
		err+="\n- Password should be greater than zero";
	}	
	if(isSize(ConfirmPassword,6,6)==1)
	{
		err+="\n- Confirm Password size should be in 6 digits";
	}	
	if(isLimit(ConfirmPassword,0)==1)
	{
		err+="\n- Confirm Password should be greater than zero";
	}	
	if(Password!=ConfirmPassword)
	{
		err+="\n- Password and Confirm Password should be same";
	}
	if(isSize(PinCode,1,6)==1)
	{
		err+="\n- PinCode length should be in 1 to 6 digits";
	}/*	
	if(isLimit(PinCode,0)==1)
	{
		err+="\n- PinCode should be greater than zero";
	}	
	if(isSize(GsMobileNumber,1,10)==1)
	{
		err+="\n- Alternate Mobile Number length should be in 1-10 digits";
	}
	if(isLimit(GsMobileNumber,0)==1)
	{
		err+="\n- Alternate Mobile Number should be greater than zero";
	}
	*/
	if(soamts<0 || soamts>2000)
	{
		err+="\n- Software Amount should between 0 and 2000";
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










function validateKyc()
{
	var pan_no=document.getElementById("pan_no").value;
	var err="";
	
	if(isSize(pan_no,10,10)==1)
	{
		err+="\n- PanCard No size should be in 10 digits";
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
		err+="\n- Account No should be greater than zero";
	}
	if(isLimit(filled_micr,0)==1)
	{
		err+="\n- MICR Code should be greater than zero";
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
	var deposit_date=document.getElementById("deposit_date").value;
	var bank_id=document.getElementById("bank_id").value;
	var PaymentMode=document.getElementById("PaymentMode").value;
	var ref_no=document.getElementById("ref_no").value;
	var filled_amount=document.getElementById("filled_amount").value;
	//var remarks=document.getElementById("remarks").value;
	var err="";
	
	if(isEmpty(deposit_date)==1)
	{
		err+="\n- Deposit date should be selected";
	}
	if(isEmpty(bank_id)==1)
	{
		err+="\n- Bank should be selected";
	}
	if(isEmpty(PaymentMode)==1)
	{
		err+="\n- Payment mode should be selected";
	}
	if(isEmpty(ref_no)==1)
	{
		err+="\n- Ref No. should not be empty";
	}
	if(isLimit(filled_amount,0)==1)
	{
		err+="\n- Amount should be greater than zero";
	}
	if(isDecimal(filled_amount)==1)
	{
		err+="\n- Amount should be numarice, positve, two decimal values like 123456.78 only";
	}
	/*
	if(isEmpty(remarks)==1)
	{
		err+="\n- Remarks should not be empty";
	}
	*/
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





function validateAmount2()
{	
	var PaymentMode2=document.getElementById("PaymentMode2").value;
	var filled_amount2=document.getElementById("filled_amount2").value;
	//var remarks2=document.getElementById("remarks2").value;
	var err="";
	
	if(isEmpty(PaymentMode2)==1)
	{
		err+="\n- Payment mode should be selected";
	}
	if(isLimit(filled_amount2,0)==1)
	{
		err+="\n- Amount should be greater than zero";
	}
	if(isDecimal(filled_amount2)==1)
	{
		err+="\n- Amount should be numarice, positve, two decimal values like 123456.78 only";
	}
	/*
	if(isEmpty(remarks2)==1)
	{
		err+="\n- Remarks should not be empty";
	}
	*/
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










function validateAmountr()
{	
	var request_to=document.getElementById("request_to").value;
	var deposit_date=document.getElementById("deposit_date").value;
	var bank_id=document.getElementById("bank_id").value;
	var payment_mode=document.getElementById("payment_mode").value;
	var filled_amount=document.getElementById("filled_amount").value;
	//var remarks=document.getElementById("remarks").value;
	var err="";
	
	
	if(request_to=="")
	{
		err+="\n- Request To not selected";
	}	
	if(deposit_date=="")
	{
		err+="\n- Deposit date not selected";
	}
	if(bank_id=="")
	{
		err+="\n- Bank not selected";
	}
	if(payment_mode=="")
	{
		err+="\n- Payment mode not selected";
	}
	else
	{
		var ref_no=document.getElementById("ref_no").value;		
		if(ref_no=="")
		{
			err+="\n- Ref.No should not be blank";
		}
	}
	if(isLimit(filled_amount,0)==1)
	{
		err+="\n- Amount should be greater than zero";
	}
	if(isDecimal(filled_amount)==1)
	{
		err+="\n- Amount should be numarice, positve, two decimal values like 123456.78 only";
	}
	/*
	if(remarks=="")
	{
		err+="\n- Remarks should not be blank";
	}
	*/
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








function validateAmountr2()
{	
	var request_to=document.getElementById("request_to").value;
	var payment_mode=document.getElementById("payment_mode2").value;
	var filled_amount=document.getElementById("filled_amount2").value;
	//var remarks=document.getElementById("remarks2").value;
	var err="";
	
	
	if(request_to=="")
	{
		err+="\n- Request To not selected";
	}
	if(payment_mode=="")
	{
		err+="\n- Payment mode not selected";
	}
	if(isLimit(filled_amount,0)==1)
	{
		err+="\n- Amount should be greater than zero";
	}
	if(isDecimal(filled_amount)==1)
	{
		err+="\n- Amount should be numarice, positve, two decimal values like 123456.78 only";
	}
	/*
	if(remarks=="")
	{
		err+="\n- Remarks should not be blank";
	}
	*/
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








function pass_comb(pass_val)
{
	var chlength=pass_val.length;
	var small=0;
	var capital=0;
	var number=0;
	var special=0;
	var ch="";
	
	for(chval=0; chval<chlength; chval++)
	{
		ch=pass_val.charAt(chval);
		if(ch>="a" && ch<="z")
		{
			small++;
		}
		else if(ch>="A" && ch<="Z")
		{
			capital++;
		}
		else if(ch>="0" && ch<="9")
		{
			number++;
		}
		else
		{
			special++;
		}
	}
	if((small>=1 || capital>=1) && number>=1 && special>=1)
	{
		return true;
	}
	else
	{
		return false;
	}
}










function chang_pass()
{
	var oldP=document.getElementById("oldP").value;
	var newP=document.getElementById("newP").value;
	var conP=document.getElementById("conP").value;
	var err="";
	
	if(oldP==newP)
	{
		err+="\n- Old Password and New Password should not be equal";
	}
	if(pass_comb(newP)==false)
	{
		err+="\n- New Password have atleast 1 Alphabet, 1 Num & 1 Special Char";
	}
	if(newP!=conP)
	{
		err+="\n- New Password and Confirm Password should be matched";
	}	
	if(isSize(oldP,6,15)==1)
	{
		err+="\n- Old Password size should have 6 to 15 digits";
	}		
	if(isSize(newP,8,8)==1)
	{
		err+="\n- New Password size should have 8 characters";
	}	
	if(isSize(conP,8,8)==1)
	{
		err+="\n- Confirm Password size should have 8 characters";
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