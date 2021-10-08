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
	$id_type="mobile_number";
	$sender_number=$_REQUEST['sender_number'];
	 
	$url = $url . "customers/";
	$url = $url . $id_type . ":" . $sender_number . "?initiator_id=" . $init_id ;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache",
	    "developer_key: ".$dev_key
	    ),
	));
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SAVE_SENDER")
{ 	
	$id_type="mobile_number";
	$sender_number=$_REQUEST['sender_number'];
	$sender_name=$_POST['sender_name'];
	
	$url = $url . "customers/";
	$url = $url . $id_type . ":" . $sender_number;
	
	$bodyParam = "customer_id_type=" . $id_type . "&id=" . $sender_number . "&initiator_id=" . $init_id . "&name=" . $sender_name;
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SENDER_OTP_RESEND")
{ 	
	$id_type="mobile_number";
	$sender_number=$_REQUEST['sender_number'];
	$sender_name=$_POST['sender_name'];
	
	$url = $url . "customers/";
	$url = $url . $id_type . ":" . $sender_number;
	
	$bodyParam = "customer_id_type=" . $id_type . "&id=" . $sender_number . "&initiator_id=" . $init_id . "&name=" . $sender_name;
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SENDER_OTP_VERIFY")
{ 	
	$id_type="mobile_number";
	$sender_number=$_REQUEST['sender_number'];
	$sender_name=$_REQUEST['sender_name'];
	$sender_otp=$_REQUEST['sender_otp'];
	
	$url = $url . "customers/verification/otp:";
	$url = $url . $sender_otp;
	$bodyParam = "customer_id_type=" . $id_type . "&id=" . $sender_number . "&initiator_id=" . $init_id . "&name=" . $sender_name;
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
	));
	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SHOW_BANK")
{ 	
	$bank_code=$_REQUEST['bank_code'];
	$url = $url . "banks?";
	$url = $url . "bank_code=" .$bank_code. "&initiator_id=" . $init_id;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"developer_key: ".$dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SHOW_RECEIVERS")
{ 	
	$id_type="mobile_number";
	$sender_number=$_REQUEST['sender_number'];
	
	$url = $url . "customers/";
	$url = $url . $id_type . ":" . $sender_number . "/recipients?initiator_id=" . $init_id; 

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"developer_key: ".$dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SAVE_RECEIVER")
{ 	
	$sender_number=$_REQUEST['sender_number'];
	$receiver_number=$_REQUEST['receiver_number'];
	$receiver_name=$_POST['receiver_name'];
	$receiver_bank_bankid=$_REQUEST['receiver_bank_bankid'];
	$receiver_bank_ifscstatus=$_REQUEST['receiver_bank_ifscstatus'];
	$receiver_bank_bankcode=$_REQUEST['receiver_bank_bankcode'];
	$receiver_bank_ifsccode=$_REQUEST['receiver_bank_ifsccode'];
	$receiver_bank_accno=$_REQUEST['receiver_bank_accno'];
	$customer_id_type="mobile_number";
	$recipient_type="3";
	
	/*
	if($receiver_bank_bankid==6)
	$receiver_bank_ifscstatus=4;
	if($receiver_bank_ifscstatus==3)
	{
		$recipient_id_type="acc_bankcode";//acc_bankcode//acc_ifsc
		$id=$receiver_bank_accno."_".$receiver_bank_bankcode;
	}
	else
	{
		$recipient_id_type="acc_ifsc";//acc_bankcode//acc_ifsc
		$id=$receiver_bank_accno."_".$receiver_bank_ifsccode;
	}
	*/
	if($receiver_bank_ifscstatus==1 || $receiver_bank_ifscstatus==3)
	{
		$recipient_id_type="acc_bankcode";//acc_bankcode//acc_ifsc
		$id=$receiver_bank_accno."_".$receiver_bank_bankcode;
	}
	else
	{
		$recipient_id_type="acc_ifsc";//acc_bankcode//acc_ifsc
		$id=$receiver_bank_accno."_".$receiver_bank_ifsccode;
	}

	$url = $url . "customers/";
	$url = $url . $customer_id_type . ":" . $sender_number . "/recipients/" . $recipient_id_type . ":" . $id;
	

	$bodyParam = "customer_id_type=" . $customer_id_type . "&customer_id= " . $sender_number . "&recipient_type=" . $recipient_type;
	$bodyParam = $bodyParam . "&recipient_id_type=" . $recipient_id_type ."&id=" . $id . "&recipient_name=" . $receiver_name;
	$bodyParam = $bodyParam . "&recipient_mobile=" . $receiver_number . "&bank_id=" . $receiver_bank_bankid . "&initiator_id=" . $init_id;
	
	/*
	ID	Description (321)
	1	Bank short code (e.g. SBIN) works for both IMPS and NEFT (47)
	2	Bank short code works for IMPS only (1)
	3	System can generate logical IFSC for both IMPS and NEFT (12)
	4	IFSC is required (199)
	-1  NO bank details available (62)
	*/					
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));

	$response = curl_exec($curl);;
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="VERIFY_RECEIVER")
{
	$bankapi_ifsc=$_REQUEST['bankapi_ifsc'];
	$bankapi_acc=$_REQUEST['bankapi_acc'];
	$receiver_bank_bankid=$_REQUEST['receiver_bank_bankid'];
	$customer_id=$_POST['sender_number'];
	
	
	$url = $url . "banks/ifsc:";
	$url = $url . $bankapi_ifsc . "/accounts/" . $bankapi_acc;
	//die();
	$bodyParam = "customer_id=" . $customer_id . "&bank_id=" . $receiver_bank_bankid . "&initiator_id=" . $init_id;
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="DELETE_RECEIVER")/////////////////////////////////////////////////////
{
	$customer_id_type="mobile_number";
	$recipient_id_type="mobile_number";
	$cust_id=$_REQUEST['sender_number'];
	$recipient_id=$_REQUEST['receiver_id'];
	
	$url = $url . "customers/";
	$url = $url . $customer_id_type . ":" . $cust_id . "/recipients/" . $recipient_id_type . ":" . $recipient_id;
	$bodyParam = "initiator_id=" . $init_id;
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
	CURLOPT_PORT => "$port",
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 1,
	CURLOPT_TIMEOUT => 15,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "DELETE",
	CURLOPT_POSTFIELDS => $bodyParam,
	CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"content-type: application/x-www-form-urlencoded",
		"developer_key:" . $dev_key
	),
	));

	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="FUND_TRANSFER_INITIATE")/////////////////////////////////////////////////////
{
	$sender_number=$_REQUEST['sender_number'];
	$receiver_id=$_REQUEST['receiver_id'];
	$amount=$_REQUEST['amount'];
	$currency="INR";
	$order_number=$_REQUEST['order_number'];
	$timestamp=$_REQUEST['timestamp'];
	$transfer_method=$_REQUEST['transfer_method'];
	if($transfer_method=="IMPS")
	$transfer_method=2;
	else if($transfer_method=="NEFT")
	$transfer_method=1;
	$hold_timeout="100";
	$state="1";
	//$auth_type="static pin";
	//$auth="13579";
	 
	$url = $url ."transactions";
	
	$bodyParam = "recipient_id=" . $receiver_id . "&amount=" . $amount . "&timestamp=:" . $timestamp . "&currency=" . $currency;
	$bodyParam = $bodyParam . "&customer_id=" . $sender_number . "&initiator_id=" . $init_id . "&client_ref_id=" . $order_number;
	$bodyParam = $bodyParam . "&hold_timeout=" . $hold_timeout . "&state=" . $state ."&channel=" . $transfer_method;
	//$bodyParam = $bodyParam . "&" . $auth_type . "=" . $auth; 
	
	if($transfer_method==2)
	{
		$bodyParam = $bodyParam . "&is_imps_scheduled=1";
	}
	               
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="FUND_TRANSFER_STATUS")/////////////////////////////////////////////////////
{ 	
	$tid=$_REQUEST['tid'];
	 
	$url = $url ."transactions/";
	$url = $url . $tid . "?initiator_id=" . $init_id;
				   
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"developer_key: ".$dev_key
		),
	));
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="FUND_REFUND_OTP_RESEND")/////////////////////////////////////////////////////
{ 	
	$tid=$_REQUEST['tid'];
	$url = $url . "transactions/";
	$url = $url . $tid . "/refund/otp";

	$bodyParam = "initiator_id=" . $init_id;
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="FUND_REFUND")/////////////////////////////////////////////////////
{ 	
	$order_number=$_REQUEST['order_number'];
	$tid=$_REQUEST['tid'];
	$otp=$_REQUEST['otp'];
	
	$url = $url . "transactions/";
	$url = $url . $tid . "/refund";
	
	$bodyParam="otp=" . $otp . "&initiator_id=" . $init_id . "&tid=" . $tid . "&cleint_ref_id=" . $order_number . "&state=1";					
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $bodyParam,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="CHECK_ORDER_STATUS")/////////////////////////////////////////////////////
{ 	
	$order_number=$_REQUEST['order_number'];
	
	$url = $url . "transactions/client_ref_id:";
	$url = $url . $order_number . "?initiator_id=mobile_number:$init_id";
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
		CURLOPT_PORT => "$port",
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 1,
		CURLOPT_TIMEOUT => 15,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"developer_key:" . $dev_key
		),
		));
	
	$response = curl_exec($curl); // Contains the response from server
	
	$err = curl_error($curl);
	
	curl_close($curl);
	
	if ($err) {
		$err=str_replace("eko","",$err);
		//$err=str_replace("_","",$err);
	  	echo "cURL Error : " . $err;
	}
	else
	{
		$response=str_replace("eko","",$response);
		//$response=str_replace("_","",$response);
		echo $response;
	}
}
else if($bankapi_method=="SHOW_BALANCE")/////////////////////////////////////////////////////
{
	echo "This API service is Under Development";
}

?>