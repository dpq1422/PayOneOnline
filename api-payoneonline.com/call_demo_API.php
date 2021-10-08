<?php

$url="https://staging.eko.co.in:25004/ekoapi/v1/";
$port="25004";
$init_id="9910028267";
$dev_key="becbbce45f79c6f5109f848acd540567";

$bankapi_user_id="";
if(isset($_GET['bankapi_user_id']))
$bankapi_user_id=$_GET['bankapi_user_id'];

$bankapi_user_pass="";
if(isset($_GET['bankapi_user_pass']))
$bankapi_user_pass=$_GET['bankapi_user_pass'];

$bankapi_method="";
if(isset($_GET['bankapi_method']))
$bankapi_method=$_GET['bankapi_method'];

if($bankapi_user_id!="100001")
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
