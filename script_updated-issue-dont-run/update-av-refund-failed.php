<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');

$min_record=75000;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(4) and source=1 and type=2 order by mmt_id limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$table=$bankapi_child."1_1001_txn";

$qry_av_refund="SELECT * FROM $bankapi_parent_txn.txn_mt where source=1 and type=2 and mmt_status='4' and mmt_id>$min_record order by mmt_id desc;";
$res_av_refund=mysql_query($qry_av_refund);
while($rs_av_refund=mysql_fetch_array($res_av_refund))
{
	$service=101;
	$operator=1001;
	$mmt_id=$rs_av_refund['mmt_id'];
	$clientid=$rs_av_refund['client_id'];
	$order=$rs_av_refund['order_id'];
	$source=$rs_av_refund['source'];
	$type=$rs_av_refund['type'];
	$tid=$rs_av_refund['tid'];
	$method=$rs_av_refund['method'];
	$datetimes=$rs_av_refund['created_on'];
	$txn_status=$rs_av_refund['mmt_status'];
	$uids=$rs_av_refund['user_id'];
	$clienttype=show_client_type_id($clientid);
	$clientdb="$bankapi_child".$clienttype."_".$clientid;
	$clientdb_name="$bankapi_child".$clienttype."_".$clientid."_txn";
	
	$ref1=admin_mt1_refund($clientid, $uids, $order, $mmt_id);
	$ref2=client_realtime_refund($uids,$service,$order,$mmt_id,$clientdb);
	if($clienttype==1 || $clienttype==2)
	$ref3=client_user_refund($uids,$service,$order,$mmt_id,$clientdb);
	mysql_query("update $bankapi_parent_txn.txn_mt set mmt_status='5', updated_on='$datetime_datetime' where mmt_id='$mmt_id';");
	mysql_query("update $clientdb_name.txn_mt_child set order_status='5', updated_on='$datetime_datetime' where order_id='$order';");
	
	if($ref1==1 || $ref2==1 || $ref3==1)
	echo "mid:$mmt_id, cid:$clientid, uid:$uids, order:$order, tid:$tid, status:$txn_status, dt:$datetimes<br>";
	echo str_pad('',16384);
	
	flush();
	ob_flush();
	usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
}
?>