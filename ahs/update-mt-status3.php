<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnSource3DmtApi.php');

$min_record=0; 
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=3 and type=1 order by mmt_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$responded_result='"StatusCode":"-1"';

$responded_query="update $bankapi_parent_txn.txn_mt set mmt_status='-1' where mmt_status in(1,2,3) and response like '%$responded_result%' and mmt_id>75000;";//58292
mysql_query($responded_query);

$responded_result='[{"StatusCode":"-1","Description":"Duplicate Unique No Suspected. Please check and try again."}]';
$responded_query="update $bankapi_parent_txn.txn_mt set mmt_status='-4' where source=3 and type=2 and response like '%$responded_result%' and mmt_id>75000;";//58292
mysql_query($responded_query);


$qry_mt_status="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=3 and type=1 and mmt_id>75000 order by mmt_id desc;";
$res_mt_status=mysql_query($qry_mt_status);
while($rs_mt_status=mysql_fetch_array($res_mt_status))
{
	$mmt_id=$rs_mt_status['mmt_id'];
	$created_on=$rs_mt_status['created_on'];
	$uid=$rs_mt_status['user_id'];
	$txn_status=$txnst=$rs_mt_status['mmt_status'];
	$clientid=$rs_mt_status['client_id'];
	$order=$rs_mt_status['order_id'];
	$source=$rs_mt_status['source'];
	$type=$rs_mt_status['type'];
	$method=$rs_mt_status['method'];
	$uids=$rs_mt_status['user_id'];
	$clienttype=show_client_type_id($clientid);
	
	$resulted_data=fund_transfer_order_status2($mmt_id);//$StatusCode,$Status,$Description,$ASTransCode,$ReferenceNumber,$response
	$resulted_response=$resulted_bankrefno=$resulted_tid=$resulted_message=$resulted_status=$resulted_status_desc="";
	$resulted_response=$resulted_data[5];
	$resulted_bankrefno=$resulted_data[4];
	$resulted_tid=$resulted_data[3];
	$resulted_message=$resulted_data[2];
	$resulted_status=$resulted_data[1];
	$resulted_status_desc=$resulted_data[0];
	if($resulted_status=="SUCCESS")
		$txn_status=2;//success
	else if($resulted_status=="FAILED" || $resulted_status=="REFUND")
		$txn_status=-4;// failed
	else if($resulted_status=="PENDING")
		$txn_status=3;//Response Awaited
	
	//update tid for client_child//bankapi_child1_1001_txn
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$resulted_tid', updated_on='$datetime_datetime', bank_ref_no='$resulted_bankrefno', order_status='$txn_status' where order_id='$order';");
	
	//update response/tid for admin
	mysql_query("update $bankapi_parent_txn.txn_mt set response='$resulted_response', bank_ref_no='$resulted_bankrefno', updated_on='$datetime_datetime', tid='$resulted_tid', response_message='$resulted_message', mmt_status='$txn_status' where mmt_id='$mmt_id';");
	
	echo "mid:$mmt_id, cid:$clientid, uid:$uid, order:$order, method:$method, tid:$resulted_tid, status:$txn_status, dt:$created_on<br>";
	echo str_pad('',16384);
	
	flush();
	ob_flush();
	usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
		
	if($txnst==2 && $txn_status!=2 &&  ($clienttype==1 || $clienttype==2))
	{
		$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
		mysql_query("delete from $bankapi_child_txn.com_generated where order_id='$order' and user_id='$uids' and source='$source' and type='$type' and method='$method';");
		mysql_query("delete from $bankapi_child_txn.com_paid_child where order_id='$order' and user_id='$uids' and source='$source' and type='$type' and method='$method';");
		mysql_query("delete from $bankapi_parent_txn.com_paid_child where client_id='$clientid' and order_id='$mmt_id' and user_id='$uids' and source='$source' and type='$type' and method='$method';");
	}
}
?>