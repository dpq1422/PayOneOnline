<?php
include_once('../_session-admin.php');

$oid="";
if(isset($_REQUEST['oid']))
$oid=$_REQUEST['oid'];

if($oid!="")
{
	$qry="update main_transaction_mt set eko_transaction_status=1 where eko_transaction_id='$oid';";
	mysql_query($qry);
}
header('location:admin-in-progress.php');
?>