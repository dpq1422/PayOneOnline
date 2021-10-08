<?php
function create_forgot_msg($pass_word)
{
	$message="Your credentials to use the PAYONE Portal\n\nPassword : $pass_word\n\nDo not share with anyone.\n\nTeam PAYONE.";
	return $message;
}
function create_mentor_wallet_request_msg($user_id,$amt,$datetime_time)
{
	$message="Wallet request received of Rs. $amt from PAYONE $user_id at $datetime_time";
	return $message;
}
function create_mentor_wallet_request_msg_reply($request_status,$amt,$datetime_time)
{
	if($request_status==2)
	$request_status="completed successfully";
	else if($request_status==3)
	$request_status="rejected";
	
	if($request_status==1)
	$message="";
	else
	$message="Wallet request updated of Rs. $amt for PAYONE is $request_status at $datetime_time";
	return $message;
}
function create_registration_msg($id,$type,$name)
{
	if($type==2)
	$type="Super Distributor";
	else if($type==3)
	$type="Distributor";
	else if($type==11)
	$type="Retailer";
	$message="Hi $name !\n\nThank you for creating a PAYONE account as $type. Your userid is $id.\n\nHappy Transferring !!!\n\nTeam PAYONE";
	return $message;
}
function create_payone_wallet_request_msg($request_id,$user_id,$user_name,$amt,$bank,$datetime_time)
{
	$message="Wallet Request Id:$request_id\n\nat $datetime_time\n\nby $user_id ($user_name)\n\nRs. $amt in $bank";
	return $message;
}
function create_payone_wallet_request_msg_reply($request_id,$user_name,$amt,$status)
{
	if($status==2)
	$status="successfully processed.";
	else if($status==3)
	$status="rejected.";
	
	if($status==1)
	$message="";
	else
	$message="Dear $user_name,\n\nYour Request Id $request_id for Rs. $amt had been $status.\n\n Happy Transferring!!!";
	return $message;
}

function zsms2($mobile,$message)
{
}

function zsms($mobile,$message)
{
	$online_url=$_SERVER['HTTP_HOST'];
	if($online_url=="payoneonline.com")
	{/*
	    $api_key = '55B27EE010F9BB';
		$contacts = $mobile;
		$from = 'DEMO';
		$sms_text = urlencode($message);

		//Submit to server

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, "http://bulksms.smsbin.com/app/smsapi/index.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=14&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
		$response = curl_exec($ch);
		curl_close($ch);*/
	    
		$user="kuldeep60008";
		$pass="990067";
		$sender="PAYONE";
		$phone=$mobile;
		$text=$message;
		$priority="ndnd";
		$stype="normal";
		$url="http://bhashsms.com/api/sendmsg.php";
		
		$data = array(
		'user' => $user, 
		'pass' => $pass, 
		'sender' => $sender, 
		'phone' => $phone, 
		'text' => $text, 
		'priority' => $priority, 
		'stype' => $stype);
		
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		ob_start();
		$buffer = curl_exec($handle);
		ob_end_clean();
		curl_close($handle);
		
	}
}



function zsms_new($mobile,$message)
{
	$online_url=$_SERVER['HTTP_HOST'];
	if($online_url=="payoneonline.com")
	{
	    $api_key = '55B27EE010F9BB';
		$contacts = $mobile;
		$from = 'PAYONE';
		$sms_text = urlencode($message);

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, "http://bulksms.smsbin.com/app/smsapi/index.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=45&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
		$response = curl_exec($ch);
		curl_close($ch);
		
	}
}
?>