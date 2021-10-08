<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');

$min_record=76000;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=1 and type=1 order by mmt_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$qry_mt_tid="SELECT * FROM $bankapi_parent_txn.txn_mt where source=1 and type=1 and response is not null and response!='' and (tid='0' or tid='' or tid is null) and mmt_id>$min_record order by mmt_id desc;";//58292
$res_mt_tid=mysql_query($qry_mt_tid);
while($rs_mt_tid=mysql_fetch_array($res_mt_tid))
{
	$mmt_id=$rs_mt_tid['mmt_id'];
	$created_on=$rs_mt_tid['created_on'];
	$uid=$rs_mt_tid['user_id'];
	$txn_status=$txnst=$rs_mt_tid['mmt_status'];
	$response_mt_tid=$rs_mt_tid['response'];
	$clientid=$rs_mt_tid['client_id'];
	$order=$rs_mt_tid['order_id'];
	$clienttype=show_client_type_id($clientid);
	$tid="-1";
	$rsi=0;
	$rti=0;
	$bankrefno="";
	$tx_status="";
	$txstatus_desc="";
	/*
	{
		"response_status_id":0,
		"data":
		{
			"tx_status":"0","amount":"1050.00",
			"txstatus_desc":"Success",
			"fee":"6.3",
			"channel":"2",
			"branch":"",
			"tid":"16141136",
			"tx_desc":"IMPS Remittance",
			"allow_retry":"0",
			"service_tax":"0.82",
			"currency":"INR",
			"customer_id":"8288033280",
			"bank_ref_num":"876871232",
			"recipient_id":10016378,
			"timestamp":"2018-02-06T19:47:12.549+05:30"
		},
		"response_type_id":70,
		"message":"Success! Transaction status enq successful.",
		"status":0
	}
	*/
	$result_mt_tid= json_decode($response_mt_tid, true);
	
	if(isset($result_mt_tid['data']['tid']))
	$tid=$result_mt_tid['data']['tid'];

	if(isset($result_mt_tid['response_status_id']))
	$rsi=$result_mt_tid['response_status_id'];

	if(isset($result_mt_tid['response_type_id']))
	$rti=$result_mt_tid['response_type_id'];

	if(isset($result_mt_tid['data']['bank_ref_num']))
	$bankrefno=$result_mt_tid['data']['bank_ref_num'];

	if(isset($result_mt_tid['data']['tx_status']))
	$tx_status=$result_mt_tid['data']['tx_status'];

	if(isset($result_mt_tid['data']['txstatus_desc']))
	$txstatus_desc=$result_mt_tid['data']['txstatus_desc'];

	if($rsi==0 && ($rti==70 || $rti==325))
	{
		if($tx_status==0)
			$txn_status=2;//success
		else if($tx_status==1)
			$txn_status=-4;//failed and refund by our otp
		else if($tx_status==2 && $txstatus_desc=="Response Awaited")
			$txn_status=3;//Response Awaited
		else if($tx_status==2 && $txstatus_desc=="Initiated")
			$txn_status=1;//Initiated
		else if($tx_status==3)
			$txn_status=4;//Refund Pending
		else if($tx_status==4)
			$txn_status=5;//Refunded
		else if($tx_status==5)
			$txn_status=3;//Hold
		else if($tx_status==8)
			$txn_status=3;//Scheduled
	}
	
	if($txnst>0)
	{
		//update tid for client_child//bankapi_child1_1001_txn
		$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
		mysql_query("update $bankapi_child_txn.txn_mt_child set tid='$tid', updated_on='$datetime_datetime', bank_ref_no='$bankrefno', order_status='$txn_status' where order_id='$order';");
		
		//update response/tid for admin
		mysql_query("update $bankapi_parent_txn.txn_mt set tid='$tid', updated_on='$datetime_datetime', bank_ref_no='$bankrefno', mmt_status='$txn_status' where mmt_id='$mmt_id';");
		
		echo "mid:$mmt_id, cid:$clientid, uid:$uid, order:$order, tid:$tid, status:$txn_status, dt:$created_on<br>";
		echo str_pad('',16384);
	}
	
	flush();
	ob_flush();
	usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
}
?>