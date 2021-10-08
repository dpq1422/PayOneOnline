<?php

if($bankapi_method!="SHOW_SENDER" && 
		$bankapi_method!="SAVE_SENDER" && 
		$bankapi_method!="SENDER_OTP_RESEND" && 
		$bankapi_method!="SENDER_OTP_VERIFY" && 
		$bankapi_method!="SHOW_BANK" && 
		$bankapi_method!="SHOW_RECEIVERS" && 
		$bankapi_method!="SAVE_RECEIVER" && 
		$bankapi_method!="VERIFY_RECEIVER" && 
		$bankapi_method!="DELETE_RECEIVER" && 
		$bankapi_method!="FUND_TRANSFER_INITIATE" &&
		$bankapi_method!="FUND_TRANSFER_STATUS" &&
		$bankapi_method!="FUND_REFUND_OTP_RESEND" &&
		$bankapi_method!="FUND_REFUND" &&
		$bankapi_method!="CHECK_ORDER_STATUS" &&
		$bankapi_method!="SHOW_BALANCE")
{
	echo "Invalid BankApiMethod";
}
else if($bankapi_method=="SHOW_SENDER")
{ 	
	$url=$url."CheckRemitter";
	$sender_number=$_REQUEST['sender_number'];

	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&remitterNo=$sender_number");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="SAVE_SENDER")
{ 	
	$url=$url."RemitterRegistration";
	$remitterNo=$_REQUEST['sender_number'];
	$remitterName=$_REQUEST['sender_name'];

	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&remitterNo=$remitterNo&remitterName=$remitterName");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="SENDER_OTP_VERIFY")
{ 	
	
	$url=$url."VerifyRemitterOTP";
	$otpCode=$_REQUEST['sender_code'];
	$otp=$_REQUEST['sender_otp'];

	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&otpCode=$otpCode&otp=$otp");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="SHOW_RECEIVERS")
{ 	
	
	$url=$url."GetBeneficiaryList";
	$remitterNo=$_REQUEST['sender_number'];

	$curl = curl_init($url);//error
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&remitterNo=$remitterNo");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="DELETE_RECEIVER")
{ 	
	
	$url=$url."DeleteBeneficiary";
	$remitterNo=$_REQUEST['sender_number'];
	$beneficiaryID=$_REQUEST['receiver_id'];

	$curl = curl_init($url);//error
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&remitterNo=$remitterNo&beneficiaryID=$beneficiaryID");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="SAVE_RECEIVER")
{ 	
	
	$url=$url."AddBeneficiary";
	$remitterNo=$_REQUEST['sender_number'];
	$beneficiaryName=$_REQUEST['receiver_name'];
	$accountNumber=$_REQUEST['receiver_bank_accno'];
	$ifscCode=$_REQUEST['receiver_bank_ifsccode'];
	$bankCode=$_REQUEST['receiver_bank_bankcode'];

	$curl = curl_init($url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&beneficiaryName=$beneficiaryName&bankCode=$bankCode&ifscCode=$ifscCode&accountNumber=$accountNumber&remitterNo=$remitterNo");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="VERIFY_RECEIVER")
{ 	
	
	$url=$url."VerifyAccount";
	$remitterNo=$_REQUEST['sender_number'];
	$remitterName=$_REQUEST['sender_name'];
	$account=$_REQUEST['receiver_bank_accno'];
	$bankCode=$_REQUEST['receiver_bank_bankcode'];
	$ifsc=$_REQUEST['receiver_bank_ifsccode'];
	$pan=$_REQUEST['pan'];
	$aadhaar=$_REQUEST['aadhar'];
	$uniqueNo=$_REQUEST['order_number'];
	$password="";

	$curl = curl_init($url);
	$param="key=$key&remitterNo=$remitterNo&remitterName=$remitterName&account=$account&bankCode=$bankCode&ifsc=$ifsc&pan=$pan&aadhaar=$aadhaar&uniqueNo=$uniqueNo&password=$password";
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response." <br><br>".$url."?".$param;
	}
}
else if($bankapi_method=="FUND_TRANSFER_INITIATE")
{ 	
	
	$url=$url."TransferMoney";
	$remitterNo=$_REQUEST['sender_number'];
	$remitterName=$_REQUEST['sender_name'];
	$beneficiaryID=$_REQUEST['receiver_id'];
	$account=$_REQUEST['account'];
	$ifsc=$_REQUEST['ifsc'];
	$channel=$_REQUEST['transfer_method'];
	$amount=$_REQUEST['amount'];
	$pan=$_REQUEST['pan'];
	$aadhaar=$_REQUEST['aadhar'];
	$uniqueNo=$_REQUEST['order_number'];
	$password="";

	$curl = curl_init($url);
	$param="key=$key&remitterNo=$remitterNo&remitterName=$remitterName&account=$account&beneficiaryID=$beneficiaryID&amount=$amount&channel=$channel&ifsc=$ifsc&pan=$pan&aadhaar=$aadhaar&uniqueNo=$uniqueNo&password=$password";
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response." <br><br>".$url."?".$param;
	}
}
else if($bankapi_method=="FUND_TRANSFER_STATUS")/////////////////////////////////////////////////////
{ 	
	
	$url=$url."StatusCheckByASTransCode ";
	$ASTransCode=$_REQUEST['tid'];
				   
	$curl = curl_init($url);//error
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&ASTransCode=$ASTransCode");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="CHECK_ORDER_STATUS")/////////////////////////////////////////////////////
{ 	
	
	$url=$url."StatusCheckByClientReferenceNo";
	$clientRefNo=$_REQUEST['order_number'];
		
	$curl = curl_init($url);//error
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key&clientRefNo=$clientRefNo");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
else if($bankapi_method=="SHOW_BALANCE")/////////////////////////////////////////////////////
{
	
	$url=$url."GetBalance";
	
	$curl = curl_init($url);//error
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, "key=$key");
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);//error
	
	curl_close($curl);
	
	if ($err) {
	  	echo "cURL Error : " . $err;
	}
	else
	{
		echo $response;
	}
}
?>