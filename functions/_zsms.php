<?php
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
function zsms($mobile,$message)
{
	$user="kuldeep60008";
	$pass="990067";
	$sender="OWICPL";
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
?>