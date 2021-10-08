<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnSource4RcApi.php');

$min_record=0; 
$min_query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=4 and type in(3,4,5,6,7,8,9,10,11) order by mrc_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mrc_id'];
	$min_record=$min_record-1;
}

//$qry="update $bankapi_parent_txn.txn_rc set mrc_status='4' where source=2 and response like '%Operator temporarily unavailable.%' and mrc_status in (1,3)";
//mysql_query($qry);
//$qry="update $bankapi_parent_txn.txn_rc set mrc_status='4' where source=2 and response like '%Order number do not exist%' and mrc_status in (1,3)";
//mysql_query($qry);

$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=4 and type in(3,4,5,6,7,8,9,10,11) order by mrc_id asc";//and mrc_id>$min_record
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
	$mrc_status=$rs['mrc_status'];
	if($m_id!="")
	{
		$response=$rs['response'];
		/*
		{"data":{"orderId":65542268,"status":"FAILED","mobile":"7087981467","amount":20,"operatorId":0,"error_code":"149","service":"Airtel","bal":"3287.5262","creditUsed":0,"resText":"Invalid operator selected"}}
		{"data":{"orderId":65542272,"status":"SUCCESS","mobile":"1088831357","amount":100,"operatorId":"TP1804241169584682","error_code":200,"service":"TATA SKY DTH","bal":"3190.7262","creditUsed":"96.8000","resText":"Recharge Success"}}
		{"data":{"orderId":65542279,"status":"PENDING","mobile":"8146145590","amount":10,"operatorId":0,"error_code":"201","service":"Airtel","bal":"3181.0662","creditUsed":"9.6600","resText":"Recharge Pending"}}
		
		*/
		if(!(empty($response) || $response==NULL))
		{
			$result1= json_decode($response, true);
			$transid=0;
			$tid=0;
			if(isset($result1['data']['orderId']))
				$transid=$result1['data']['orderId'];
			if(count($transid)==0 || $transid=="N" || $transid=="NA")
				$transid=0;
			if(isset($result1['data']['operatorId']))
				$tid=$result1['data']['operatorId'];
					
			//if($tid==0)
				//$tid=$transid;
			$status="PENDING";
			if(isset($result1['data']['status']))
			$status=$result1['data']['status'];
		
			if($status=="SUCCESS")
				$mrc_status=2;//success
			else if($status=="PENDING")
				$mrc_status=3;//in progress
			else if($status=="FAILED")
				$mrc_status=4;// failed
			
			//update tid for client_child
			$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
			$qry_a="update $bankapi_child_txn.txn_rc set tid='$tid', rc_status='$mrc_status', updated_on='$datetime_datetime' where rc_id='$order_id';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$tid', mrc_status='$mrc_status', result='$transid', updated_on='$datetime_datetime' where mrc_id='$m_id';";
			mysql_query($qry_b);
			
			echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, transid:$transid, type:$type, tid:$tid, status:$mrc_status, dt:$created_on<br>";
			echo str_pad('',16384);
		
			flush();
			ob_flush();
			usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
		}
	}
}

$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=4 and type in(3,4,5,6,7,8,9,10,11) order by mrc_id asc";
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
	$mrc_status=$rs['mrc_status'];
	if($m_id!="")
	{
		$response=check_order_status4($results);
		/*
		{"data":{"orderId":65542268,"status":"FAILED","mobile":"7087981467","amount":20,"operatorId":0,"error_code":"149","service":"Airtel","bal":"3287.5262","creditUsed":0,"resText":"Invalid operator selected"}}
		{"data":{"orderId":65542272,"status":"SUCCESS","mobile":"1088831357","amount":100,"operatorId":"TP1804241169584682","error_code":200,"service":"TATA SKY DTH","bal":"3190.7262","creditUsed":"96.8000","resText":"Recharge Success"}}
		{"data":{"orderId":65542279,"status":"PENDING","mobile":"8146145590","amount":10,"operatorId":0,"error_code":"201","service":"Airtel","bal":"3181.0662","creditUsed":"9.6600","resText":"Recharge Pending"}}
		{"data":[{"orderId":"65542279","status":"SUCCESS","mobile":"8146145590","amount":"10.00","error_code":"200","TransId":"888502962","service":"Airtel","reqTime":"2018-04-24 02:40:09","bal":"3171.0912","resText":"Recharge Success"}]}
		
		*/
		if(!(empty($response) || $response==NULL))
		{
			$result2= json_decode($response, true);
			$transid=0;
			$tid=0;
			if(isset($result2['data'][0]['TransId']))
				$tid=$result2['data'][0]['TransId'];
			
			$status=$mrc_status;
			if(isset($result2['data'][0]['status']))
			$status=$result2['data'][0]['status'];
		
			if($status=="SUCCESS")
				$mrc_status=2;//success
			else if($status=="PENDING")
				$mrc_status=3;//in progress
			else if($status=="FAILED")
				$mrc_status=4;// failed
			
			//update tid for client_child
			$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
			$qry_a="update $bankapi_child_txn.txn_rc set tid='$tid', rc_status='$mrc_status', updated_on='$datetime_datetime' where rc_id='$order_id';";
			mysql_query($qry_a);
			
			//update response/tid for admin
			$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$tid', mrc_status='$mrc_status', updated_on='$datetime_datetime' where mrc_id='$m_id';";
			mysql_query($qry_b);
			
			echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, transid:$results, type:$type, tid:$tid, status:$mrc_status, dt:$created_on<br>";
			echo str_pad('',16384);
		
			flush();
			ob_flush();
			usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
		}
	}
}

?>