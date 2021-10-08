<?php


$url="http://rc.aquams.in/recharge1.1.php";
$userid="10626";
$password="877577";

$ip=$_SERVER["REMOTE_ADDR"];

$bankapi_user_id="";
if(isset($_REQUEST['bankapi_user_id']))
$bankapi_user_id=$_REQUEST['bankapi_user_id'];

$bankapi_user_pass="";
if(isset($_REQUEST['bankapi_user_pass']))
$bankapi_user_pass=$_REQUEST['bankapi_user_pass'];

$bankapi_method="";
if(isset($_REQUEST['bankapi_method']))
$bankapi_method=$_REQUEST['bankapi_method'];


require('zf-Company.php');
$ip2=show_ip_info(1000);

if($ip!="103.50.160.116" && $ip!="$ip2")
{
	echo "UnAuthorised IP";
}
else if($bankapi_user_id!="100001")
{
	echo "UnAuthorised BankApiUserId";
}
else if($bankapi_user_pass!="9729877577")
{
	echo "Invalid BankApiUserPass";
}
else if($bankapi_method!="BLNC" && 
		$bankapi_method!="STTS" && 
		$bankapi_method!="STTSS" && 
		$bankapi_method!="RCPP" && 
		$bankapi_method!="MCD" && 
		$bankapi_method!="FNDR" 
		)
{
	echo "Invalid BankApiMethod";
}
else if($bankapi_method=="BLNC")
{ 	
	 
	$url = $url . "?userid=$userid&password=$password&method=balance";
	       
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	$xml = simplexml_load_string($response);
	$json = json_encode($xml);
	echo $json ;
	
}
else if($bankapi_method=="STTS")
{ 	
	$order_number=$_REQUEST['order_number'];
	 
	$url = $url . "?userid=$userid&password=$password&method=status&order_number=$order_number";
	               
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	$xml = simplexml_load_string($response);
	$json = json_encode($xml);
	echo $json;
}
else if($bankapi_method=="STTSS")
{ 	
	$request_number=$_REQUEST['request_number'];
	 
	$url = $url . "?userid=$userid&password=$password&method=status2&request_number=$request_number";
	               
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	$xml = simplexml_load_string($response);
	$json = json_encode($xml);
	echo $json;
}
else if($bankapi_method=="RCPP")
{ 	
	
	$request_number=$_REQUEST['request_number'];	 
	$mobile_number=$_REQUEST['mobile_number'];
	$amount=$_REQUEST['amount'];
	$operator=urlencode($_REQUEST['operator']);
	$circle=$_REQUEST['circle'];
	 
	$url = $url . "?userid=$userid&password=$password&method=recharge&request_number=$request_number";
	$url = $url . "&mobile_number=$mobile_number&amount=$amount&operator=$operator&circle=$circle";
	         
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	$xml = simplexml_load_string($response);
	$json = json_encode($xml);
	echo $json;
	
}
else if($bankapi_method=="MCD")
{ 	
	
	$mobile_number=$_REQUEST['mobile_number'];
	$url="http://api.rechapi.com/";
    $token="FAkgg74rkmbHmxn9IMBSZJlksJBgT8";
	 
	$url = $url . "mob_details.php?format=json&token=$token";
	$url = $url . "&mobile=$mobile_number";
	         
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
	$response = curl_exec($curl);
	echo $response;
}
else if($bankapi_method=="FNDR")
{ 	
	$type=$_REQUEST['type'];
	$cirid=$_REQUEST['cirid'];
	$opid=$_REQUEST['opid'];
	$url="http://api.rechapi.com/";
    $token="FAkgg74rkmbHmxn9IMBSZJlksJBgT8";
	 
	$url = $url . "rech_plan.php?format=json&token=$token";
	$url = $url . "&type=$type&cirid=$cirid&opid=$opid";
	         
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
	$response = curl_exec($curl);
	echo $response;
}

?>