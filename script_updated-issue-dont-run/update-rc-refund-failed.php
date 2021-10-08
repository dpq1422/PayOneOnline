<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');

$min_record=100001150;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(4) and source=2 and type in(3,4) order by mrc_id limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mrc_id'];
	$min_record=$min_record-1;
}

$qry_failed="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status=4 and source=2 and type in(3,4) and mrc_status>$min_record order by mrc_id asc";
$result_failed=mysql_query($qry_failed);
$i=0;
while($rs_failed = mysql_fetch_array($result_failed))
{
	$i++;
	$m_id=$rs_failed['mrc_id'];
	$clientid=$rs_failed['client_id'];
	$uid=$rs_failed['user_id'];
	$order_id=$rs_failed['order_id'];
	$type=$rs_failed['type'];
	$service=0;
	if($type==3)
		$service=102;
	else if($type==4)
		$service=103;
	$rc_stat=5;
	$created_on=$rs_failed['created_on'];
	$source=$rs_failed['source'];
	$clienttype=show_client_type_id($clientid);
	if($m_id!="")
	{
		refund_rc_amount($order_id,$m_id,$source,$uid,$clientid,$clienttype,$service);
		echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, type:$type, status:$rc_stat, dt:$created_on<br>";
		echo str_pad('',16384);

		flush();
		ob_flush();
		usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
	}
}
?>