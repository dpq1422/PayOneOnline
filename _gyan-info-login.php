<?php
$servername = "localhost";
$database = "";
$username = "";
$password = "";
$call_url_demo="http://mentor-india.co.in/api-payoneonline.com/call_demo_API.php";
$call_url_live="http://mentor-india.co.in/api-payoneonline.com/call_live_API.php";
$call_url=$call_url_live;

$domain_name=$_SERVER['HTTP_HOST'];
if($domain_name!="localhost")
{
	$database = "bankatyf_live_prod";
	$username = "bankatyf_mlogin";
	$password = "data!@#123center";
}
else
{
	$database = "bankatyf_local";
	$username = "root";
	$password = "";
}

// Create connection
$conn=@mysql_connect($servername,$username,$password) or mysql_error(); 
mysql_select_db($database,$conn) or mysql_error(); 
?>