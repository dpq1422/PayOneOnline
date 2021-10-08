<?php
include_once('../_session-admin.php');

$oid="";
$stts="";
$a="";
$b="";
$c="";
$d="";

if(isset($_REQUEST['oid']))
$oid=$_REQUEST['oid'];

if(isset($_REQUEST['stts']))
$stts=$_REQUEST['stts'];

if(isset($_REQUEST['a']))
$a=$_REQUEST['a'];

if(isset($_REQUEST['b']))
$b=$_REQUEST['b'];

if(isset($_REQUEST['c']))
$c=$_REQUEST['c'];

if(isset($_REQUEST['d']))
$d=$_REQUEST['d'];

$append_url="";
if($a!="")
	$append_url="a=$a";
if($b!="")
	$append_url="b=$b";
if($c!="")
	$append_url="c=$c";
if($d!="")
	$append_url="d=$d";

if($oid!="" && $stts!="")
{
	$qry="update main_transaction_mt set eko_transaction_status=$stts where eko_transaction_id='$oid';";
	mysql_query($qry);
}
header("location:transactions-orders.php?$append_url");
?>