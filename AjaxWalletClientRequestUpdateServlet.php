<?php

$req="";
$status="";
$remarks="";
$client="";
$amt="";

if(isset($_POST['req']))
$req=$_POST['req'];

if(isset($_POST['status']))
$status=$_POST['status'];

if(isset($_POST['remarks']))
$remarks=$_POST['remarks'];

if(isset($_POST['client']))
$client=$_POST['client'];

if(isset($_POST['amt']))
$amt=$_POST['amt'];

if($req!="" && $status!="" && $remarks!="" && $client!="" && $amt!="")
{
	if($status==2)
	{
		include_once('zc-session-admin.php');
		include_once('zf-Client.php');
		include_once('zf-WalletDistributed.php');
		$client_type_id=show_client_type_id($client);
		$remarks="$remarks - against request id $req";
		transfer_to_client($client_type_id, $client, $req, $amt, $remarks, $remarks);
	}
	else
	{
		include_once('zc-session-admin.php');
		include_once('zf-Client.php');
		include_once('zf-WalletDistributed.php');
		$client_type_id=show_client_type_id($client);
		$remarks="$remarks - against request id $req";
		//transfer_to_client_rejected($client_type_id, $client, $req, 0, $remarks, $remarks);
	}
	echo update_client_request($req,$status,$remarks);
}
function update_client_request($req, $status, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$req=mysql_real_escape_string($req);
	$status=mysql_real_escape_string($status);
	$remarks=mysql_real_escape_string($remarks);
	$i=0;
	$user='admin';
	$query_chk="update $bankapi_parent_wallet.requests set request_status=$status, admin_remarks='$remarks', admin_updates=concat('updated by $user at ','$datetime_datetime') where request_id='$req'";
	mysql_query($query_chk);
	$i=mysql_affected_rows();
	$i=json_encode($query_chk);
	return $i;
}
?>