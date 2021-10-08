<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');

$min_record=75000;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=1 and type=2 order by mmt_id limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$table=$bankapi_child."1_1001_txn";

$qry_av_tid="SELECT * FROM $bankapi_parent_txn.txn_mt where source=1 and type=2 and response is not null and response!='' and (tid='0' or tid ='' or tid is null) and mmt_id>$min_record order by mmt_id desc;";
$res_av_tid=mysql_query($qry_av_tid);
while($rs_av_tid=mysql_fetch_array($res_av_tid))
{
	$mmt_id=$rs_av_tid['mmt_id'];
	$created_on=$rs_av_tid['created_on'];
	$uid=$rs_av_tid['user_id'];
	$response_av_tid=$rs_av_tid['response'];
	$clientid=$rs_av_tid['client_id'];
	$order=$rs_av_tid['order_id'];
	$clienttype=show_client_type_id($clientid);
	$tid="-1";
	$rsi=0;
	$rti=0;
	$txn_status=2;
	/*
	{
		"response_status_id":-1,
		"data":
		{
			"client_ref_id":"",
			"bank":"Allahabad Bank",
			"amount":"1.0",
			"is_name_editable":"0",
			"fee":"2.00",
			"verification_failure_refund":"",
			"aadhar":"",
			"recipient_name":"Mr. Sonu Kumar",
			"is_Ifsc_required":"0",
			"account":"59122074171",
			"tid":"451638796"
		},
		"response_type_id":61,
		"message":"Success!  Account details found..",
		"status":0
	}
	*/
	$result_av_tid= json_decode($response_av_tid, true);
	
	if(isset($result_av_tid['data']['tid']))
	$tid=$result_av_tid['data']['tid'];

	if(isset($result_av_tid['response_status_id']))
	$rsi=$result_av_tid['response_status_id'];

	if(isset($result_av_tid['response_type_id']))
	$rti=$result_av_tid['response_type_id'];

	if($rsi==1 && $rti==-1)
		$txn_status=4;
	
	//update tid for client_child//bankapi_child1_1001_txn
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$tid', updated_on='$datetime_datetime', order_status='$txn_status' where order_id='$order';");
	
	//update response/tid for admin
	mysql_query("update $bankapi_parent_txn.txn_mt set tid='$tid', updated_on='$datetime_datetime', mmt_status='$txn_status' where mmt_id='$mmt_id';");
	
	echo "mid:$mmt_id, cid:$clientid, uid:$uid, order:$order, tid:$tid, status:$txn_status, dt:$created_on<br>";
	echo str_pad('',16384);
	
	flush();
	ob_flush();
	usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
}
?>