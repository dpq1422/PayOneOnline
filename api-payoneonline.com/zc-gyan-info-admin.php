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
}
else
{
	$username = "root";
	$password = "";
}

// Create connection
$conn=@mysql_connect($servername,$username,$password) or mysql_error(); 
mysql_select_db($bankapi_common,$conn) or mysql_error(); 
?>