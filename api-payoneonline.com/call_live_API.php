<?php

$url="https://api.eko.co.in:25002/ekoicici/v1/";
$port="25002";
$init_id="9896677625";
$dev_key="2478bf4c57de2e6306d123c0450692f2";

$ip=$_SERVER["REMOTE_ADDR"];

$bankapi_user_id="";
if(isset($_GET['bankapi_user_id']))
$bankapi_user_id=$_GET['bankapi_user_id'];

$bankapi_user_pass="";
if(isset($_GET['bankapi_user_pass']))
$bankapi_user_pass=$_GET['bankapi_user_pass'];

$bankapi_method="";
if(isset($_GET['bankapi_method']))
$bankapi_method=$_GET['bankapi_method'];

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
else
{
	include_once('common_api.php');
}

?>
