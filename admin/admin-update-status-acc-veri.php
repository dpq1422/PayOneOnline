<?php
include_once('../_session-admin.php');

$oid="";
$stts="";

if(isset($_REQUEST['oid']))
$oid=$_REQUEST['oid'];

if(isset($_REQUEST['stts']))
$stts=$_REQUEST['stts'];

if($oid!="" && $stts!="")
{
	$qry="update main_transaction_mt set eko_transaction_status=$stts where eko_transaction_id='$oid';";
	mysql_query($qry);
}
header("location:admin-pending-refund.php");
?>