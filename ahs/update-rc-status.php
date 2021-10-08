<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnSource2RcApi.php');

$min_record=0; 
$min_query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=2 and type in(3,4) order by mrc_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mrc_id'];
	$min_record=$min_record-1;
}

$qry="update $bankapi_parent_txn.txn_rc set mrc_status='4' where source=2 and response like '%Operator temporarily unavailable.%' and mrc_status in (1,3)";
mysql_query($qry);
$qry="update $bankapi_parent_txn.txn_rc set mrc_status='4' where source=2 and response like '%Order number do not exist%' and mrc_status in (1,3)";
mysql_query($qry);

$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=2 and type in(3,4) and (result is null or result='0' or result='') order by mrc_id asc";//and mrc_id>$min_record
$result=mysql_query($query);
$i=0;
while($rs = mysql_fetch_array($result))
{	
	$i++;
	$m_id=$rs['mrc_id'];
	$created_on=$rs['created_on'];
	$uid=$rs['user_id'];
	$type=$rs['type'];
	$clientid=$rs['client_id'];
	$clienttype=show_client_type_id($clientid);
	$order_id=$rs['order_id'];
	if($m_id!="")
	{
		$response=check_request_status($m_id);
		if(!(empty($response) || $response==NULL))
		{
			$result1= json_decode($response, true);
			$reponsecode=$result1['reponsecode'];
			$responsemsg=$result1['responsemsg'];
			$transid=0;
			if(isset($result1['transid']))
				$transid=$result1['transid'];
			if(count($transid)==0 || $transid=="N" || $transid=="NA")
				$transid=0;
		
			$rc_stat=1;//initiated
			if($reponsecode==1002)
				$rc_stat=2;//success
			else if($reponsecode==1004)
				$rc_stat=3;//in progress
			else if($reponsecode==1003)
				$rc_stat=4;// failed
			
			//update tid for client_child
			$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
			$qry_a="update $bankapi_child_txn.txn_rc set tid='$transid', rc_status='$rc_stat', updated_on='$datetime_datetime' where rc_id='$order_id';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$transid', mrc_status='$rc_stat', updated_on='$datetime_datetime' where mrc_id='$m_id';";
			mysql_query($qry_b);
			
			echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, type:$type, tid:$transid, status:$rc_stat, dt:$created_on<br>";
			echo str_pad('',16384);
		
			flush();
			ob_flush();
			usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
		}
	}
}

$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=2 and type in(3,4) and (result is not null and result!='0' and result!='') order by mrc_id asc";
$result=mysql_query($query);
$i=0;
while($rs = mysql_fetch_array($result))
{	
	$i++;
	$m_id=$rs['mrc_id'];
	$created_on=$rs['created_on'];
	$uid=$rs['user_id'];
	$type=$rs['type'];
	$clientid=$rs['client_id'];
	$clienttype=show_client_type_id($clientid);
	$order_id=$rs['order_id'];
	$results=$rs['result'];
	if($m_id!="")
	{
		$response=check_order_status($results);
		if(!(empty($response) || $response==NULL))
		{
			$result2= json_decode($response, true);
			$reponsecode=$result2['reponsecode'];
			$responsemsg=$result2['responsemsg'];
			$transid=0;
			if(isset($result2['transid']))
				$transid=$result2['transid'];
			if(count($transid)==0 || $transid=="N" || $transid=="NA")
				$transid=0;
		
			$rc_stat=1;//initiated
			if($reponsecode==1002)
				$rc_stat=2;//success
			else if($reponsecode==1004)
				$rc_stat=3;//in progress
			else if($reponsecode==1003)
				$rc_stat=4;// failed
			
			//update tid for client_child
			$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
			$qry_a="update $bankapi_child_txn.txn_rc set tid='$transid', rc_status='$rc_stat', updated_on='$datetime_datetime' where rc_id='$order_id';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$transid', mrc_status='$rc_stat', updated_on='$datetime_datetime' where mrc_id='$m_id';";
			mysql_query($qry_b);
			
			echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, type:$type, tid:$transid, status:$rc_stat, dt:$created_on<br>";
			echo str_pad('',16384);
		
			flush();
			ob_flush();
			usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
		}
	}
}
?>