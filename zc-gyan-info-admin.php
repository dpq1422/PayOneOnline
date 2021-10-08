<?php
$servername = "localhost";
$bankapi_common = "";
$username = "";
$password = "";

$bankapi_common="bankapi_common";
$bankapi_parent_base="bankapi_parent_base";
$bankapi_parent_report="bankapi_parent_report";
$bankapi_parent_txn="bankapi_parent_txn";
$bankapi_parent_wallet="bankapi_parent_wallet";
$bankapi_child="bankapi_child";

//$call_mt1_url_demo="http://localhost/bankapi/mentor-india.co.in/api-payoneonline.com/call_demo_API.php";
$call_mt1_url_demo="http://mentor-india.co.in/api-payoneonline.com/call_demo_API.php";
$call_mt2_url_demo="http://mentor-india.co.in/api-payoneonline.com/call_live_API3.php";
$call_mt1_url_live="http://mentor-india.co.in/api-payoneonline.com/call_live_API.php";
$call_mt2_url_live="http://mentor-india.co.in/api-payoneonline.com/call_live_API3.php";
$call_rc1_url_live="http://mentor-india.co.in/api-payoneonline.com/rc_ap_live.php";
$call_rc2_url_live="http://mentor-india.co.in/api-payoneonline.com/rc_ra_live.php";
//$call_rc1_url_demo="http://localhost/bankapi/mentor-india.co.in/api-payoneonline.com/rc_ap_demo.php";
$call_rc1_url_demo="http://mentor-india.co.in/api-payoneonline.com/rc_ap_demo.php";
$call_rc2_url_demo="http://mentor-india.co.in/api-payoneonline.com/rc_ap_demo.php";
$call_mt1_url=$call_mt1_url_demo;
$call_mt2_url=$call_mt2_url_demo;
$call_rc1_url=$call_rc1_url_demo;
$call_rc2_url=$call_rc2_url_demo;

$wallet_security=90001;//in by every dr from user//no dr
$wallet_software=90002;//in by every dr from user//admin/(team+tds)
$wallet_transact=90003;//in by every com_charged dr from user//gst/admin/(team+tds)
$wallet_bankfees=90004;//in by every request from user//dr by entry matched and cr in admin wallet
$wallet_suspense=90005;//in by manual for suspense entry
$wallet_admininc=90006;//in after txn success/in after software fee//dr by exp and cr in admin wallet
$wallet_teamcomm=90007;//in after txn success/in after software fee//dr by comm paid and cr in admin wallet
$wallet_gsttopay=90008;//in after txn success//dr by gst paid and cr in admin wallet
$wallet_tdstopay=90009;//in after txn success/in after software fee//dr by tds paid and cr in admin wallet
$wallet_leanamnt=90010;//in by admin for user/in after full dr from user//cr in admin wallet

$domain_name=$_SERVER['HTTP_HOST'];
if($domain_name!="localhost")
{
	$bankapi_common="bankatyf_common";
	$bankapi_parent_base="bankatyf_parent_base";
	$bankapi_parent_report="bankatyf_parent_report";
	$bankapi_parent_txn="bankatyf_parent_txn";
	$bankapi_parent_wallet="bankatyf_parent_wallet";
	$bankapi_child="bankatyf_child";
	$username = "bankatyf_master";
	$password = "mse!@#123";//master
	$call_mt1_url=$call_mt1_url_live;
	$call_mt2_url=$call_mt2_url_live;
	$call_rc1_url=$call_rc1_url_live;
	$call_rc2_url=$call_rc2_url_live;
}
else
{
	$bankapi_common = "bankapi_common";
	$username = "root";
	$password = "";
	$call_mt1_url=$call_mt1_url_live;//////////////////////////////////////////////
	$call_mt2_url=$call_mt2_url_demo;
	$call_rc1_url=$call_rc1_url_demo;
	$call_rc2_url=$call_rc2_url_demo;
}

// Create connection
$conn=@mysql_connect($servername,$username,$password) or mysql_error(); 
mysql_select_db($bankapi_common,$conn) or mysql_error(); 
?>