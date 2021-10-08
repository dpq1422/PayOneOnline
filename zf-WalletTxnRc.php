<?php
function txn_recharge($userid, $service, $mobile, $operator_code, $operator, $circle, $amount, $source)
{
	$err="";
	$txn_status=1;
	
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	include_once('zf-WalletsMarginsForTxn.php');
	
	$datetime=$datetime_datetime;
	$balance_retailer=show_txn_user_balance($userid);
	$balance_client=show_txn_client_balance();
	$balance_client_dummy=show_txn_client_dummy_balance();
	$balance_admin=show_txn_admin_balance($source);
	$client_otp_pending_refund=0;
	$admin_otp_pending_refund=0;
	
	if($source==2)
	$operator_id=show_operator_id_by_code($operator_code,$service);
	if($source==4)
	$operator_id=show_operator_id_by_code3($operator_code,$service);
	
	$field="id_12";
	$deduction_retailer=show_user_rc_rate($service,$operator_id,$field);
	$deduction_client=show_client_rc_rate($source,$service,$operator_id);
	$deduction_admin=show_admin_rc_rate($source,$service,$operator_id);
				
	$ded_ret=$amount-($deduction_retailer*$amount/100);
	$remain_ret=$balance_retailer-$ded_ret;
	$ded_client=$amount-($deduction_client*$amount/100);
	$remain_client=$balance_client-$ded_client;
	$ded_admin=$amount-($deduction_admin*$amount/100);
	$remain_admin=$balance_admin-$ded_admin;
	
	if($balance_retailer<$ded_ret)
		$err="Your Balance is low for transation.";
	//if($balance_client-$balance_client_dummy+$client_otp_pending_refund<$ded_client)
		//$txn_status=4;
	if($balance_admin+$admin_otp_pending_refund<$ded_admin)
		$txn_status=4;
	if($err=="")
	{
		$type=0;
		$desc="";
		if($service==102)
		{
			$type=3;
			$desc="Prepaid, $mobile, $operator, $circle, $amount";
		}
		else if($service==103)
		{
			$type=4;
			$desc="DTH, $mobile, $operator, $amount";
		}
		else if($service==106)
		{
			$type=5;
			$desc="Postpaid, $mobile, $operator, $amount";
		}
		$duplicate_txn=check_rc_placed($userid,$datetime,$type,$mobile,$amount);
		if($duplicate_txn!=0)
		$err="repeated";
		else
		{
			//$err="Transaction is in progress.";
			$user_ip=show_ip();
			$order_id=$m_id=$t_id=0;
			////////////////////do with $limit
			$qry2="";			
			$qry2="INSERT INTO $bankapi_child_txn.txn_rc(created_on, user_id, mobile_number, operator, circle, source, type, pre_bal, amount, deducted_amt, post_bal, updated_on, rc_status, mid, tid, ip) value ('$datetime', '$userid', '$mobile', '$operator', '$circle', '$source', '$type', '$balance_retailer', '$amount', '$ded_ret', '$remain_ret', '$datetime', '$txn_status', '$m_id', '$t_id', '$user_ip')";
			$order_id=generate_rc_client_txn($qry2);
			if($order_id%1000==0)
			{
				//include_once('../functions/_zsms.php');
				//zsms("8146145674","Order No $order_id started on dated $datetime_datetime");
			}
			
			$qry3="";			
			$qry3="INSERT INTO $bankapi_parent_txn.txn_rc(client_id, order_id, created_on, user_id, mobile_number, operator, circle, source, type, amount, pre_bal, deducted_amt, post_bal, updated_on, mrc_status, tid, ip) value('$clientdbid', '$order_id', '$datetime', '$userid', '$mobile', '$operator', '$circle', '$source', '$type', '$amount', '$balance_admin', '$ded_admin', '$remain_admin', '$datetime', '$txn_status', '$t_id', '$user_ip')";
			$m_id=generate_rc_admin_txn($qry3);
			
			//update_mid_for_client
			$qry4="";
			$qry4="update $bankapi_child_txn.txn_rc set mid='$m_id' where rc_id='$order_id';";
			mysql_query($qry4);
			
			//deduct_amount_for_retailer
			$qry5="";
			$qry5="INSERT INTO $bankapi_child_wallet.distribution(wallet_date, wallet_time, user_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) value('$datetime_date', '$datetime_time', '$userid', '$service', '$order_id', '$m_id', '6', 'RC Order No. $order_id, $desc', '$balance_retailer', '0', '$ded_ret', '$remain_ret', 'RC Order No. $order_id, $desc generated by user id $userid at $datetime_datetime')";
			mysql_query($qry5);
			include_once('zf-WalletDistributed.php');
			update_user_balance($userid);
			
			//deduct_amount_for_client
			$qry6="";
			//$qry6="INSERT INTO $bankapi_child_wallet.realtime(wallet_date, wallet_time, user_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$userid', '$service', '$order_id', '$m_id', '2', 'RC Order No. $order_id, $desc generated by user id $userid', '$balance_client', '0', '$ded_client', '$remain_client')";
			$qry6="INSERT INTO $bankapi_child_wallet.realtime(wallet_date, wallet_time, user_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$userid', '$service', '$order_id', '$m_id', '2', 'RC Order No. $order_id, $desc generated by user id $userid', '$balance_client', '0', '$ded_client', amount_pre-amount_dr)";
			mysql_query($qry6);
			
			if($source==2)
			{
				//deduct_amount_for_admin
				$qry7="";
				$qry7="INSERT INTO $bankapi_parent_wallet.rt_aquams(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$clientdbid', '$userid', '$order_id', '$m_id', '2', 'RC Order No. $order_id, $desc generated by user id $userid of client id $clientdbid', '$balance_admin', '0', '$ded_admin', '$remain_admin')";
				mysql_query($qry7);
			}
			if($source==4)
			{
				//deduct_amount_for_admin
				$qry7="";
				$qry7="INSERT INTO $bankapi_parent_wallet.rt_rechapi(wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) value('$datetime_date', '$datetime_time', '$clientdbid', '$userid', '$order_id', '$m_id', '2', 'RC Order No. $order_id, $desc generated by user id $userid of client id $clientdbid', '$balance_admin', '0', '$ded_admin', '$remain_admin')";
				mysql_query($qry7);
			}
			if($txn_status==1 && $source==2)
			{	
				include_once('zf-TxnSource2RcApi.php');
				$response=start_recharge($m_id,$mobile,$amount,$operator_code,$circle);
				$result= json_decode($response, true);
				$reponsecode=$result['reponsecode'];
				$responsemsg=$result['responsemsg'];
				$transid=0;
				if(isset($result['transid']))
					$transid=$result['transid'];
				if(count($transid)==0 || $transid=="N" || $transid=="NA")
					$transid=0;
		
				$rc_stat=1;//initiated
				if($reponsecode==1002)
					$rc_stat=2;//success
				else if($reponsecode==1004)
					$rc_stat=3;//in progress
				else if($reponsecode==1003)
					$rc_stat=4;// failed
				if(isset($response))
				{
					//update tid for client_child
					$qry_a="update $bankapi_child_txn.txn_rc set tid='$transid', rc_status='$rc_stat' where rc_id='$order_id';";
					mysql_query($qry_a);
					
					//update response/tid for admin
					$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$transid', result='$transid', mrc_status='$rc_stat' where mrc_id='$m_id';";
					mysql_query($qry_b);
				}
			}
			if($txn_status==1 && $source==4)
			{	
				include_once('zf-TxnSource4RcApi.php');
				$response=start_recharge($m_id,$mobile,$amount,$operator_code,$circle);
				$results= json_decode($response, true);
				$result=$results['data'];
				
				$reponsecode=$result['status'];
				$responsemsg=$result['resText'];
				$tid=0;
				$tid=$result['operatorId'];
				$transid=0;
				if(isset($result['orderId']))
					$transid=$result['orderId'];
				if(count($transid)==0 || $transid=="N" || $transid=="NA")
					$transid=0;
				
				//if($tid==0)
					//$tid=$transid;
		
				$rc_stat=1;//initiated
				if($reponsecode=="SUCCESS")
					$rc_stat=2;//success
				else if($reponsecode=="PENDING")
					$rc_stat=3;//in progress
				else if($reponsecode=="FAILED")
					$rc_stat=4;// failed
				if(isset($response))
				{
					//update tid for client_child
					$qry_a="update $bankapi_child_txn.txn_rc set tid='$tid', rc_status='$rc_stat' where rc_id='$order_id';";
					mysql_query($qry_a);
					
					//update response/tid for admin
					$qry_b="update $bankapi_parent_txn.txn_rc set response='$response', tid='$tid', result='$transid', mrc_status='$rc_stat' where mrc_id='$m_id';";
					mysql_query($qry_b);
				}
			}
			$parents=show_my_parents($userid);
			$parent_01=$parents[0];
			$parent_02=$parents[1];
			$parent_03=$parents[2];
			$parent_04=$parents[3];
			$parent_05=$parents[4];
			$parent_06=$parents[5];
			$parent_07=$parents[6];
			$parent_08=$parents[7];
			$parent_09=$parents[8];
			$parent_10=$parents[9];
			$parent_11=$parents[10];
			$parent_12=$parents[11];
			
			$parent_01_rate=show_user_rc_rate($service,$operator_id,"id_01");
			$parent_02_rate=show_user_rc_rate($service,$operator_id,"id_02");
			$parent_03_rate=show_user_rc_rate($service,$operator_id,"id_03");
			$parent_04_rate=show_user_rc_rate($service,$operator_id,"id_04");
			$parent_05_rate=show_user_rc_rate($service,$operator_id,"id_05");
			$parent_06_rate=show_user_rc_rate($service,$operator_id,"id_06");
			$parent_07_rate=show_user_rc_rate($service,$operator_id,"id_07");
			$parent_08_rate=show_user_rc_rate($service,$operator_id,"id_08");
			$parent_09_rate=show_user_rc_rate($service,$operator_id,"id_09");
			$parent_10_rate=show_user_rc_rate($service,$operator_id,"id_10");
			$parent_11_rate=show_user_rc_rate($service,$operator_id,"id_11");
			$parent_12_rate=show_user_rc_rate($service,$operator_id,"id_12");
			
			if($parent_11==0)
			{
				$parent_10_rate+=$parent_11_rate;
				$parent_11_rate=0;
			}
			if($parent_10==0)
			{
				$parent_09_rate+=$parent_10_rate;
				$parent_10_rate=0;
			}
			if($parent_09==0)
			{
				$parent_08_rate+=$parent_09_rate;
				$parent_09_rate=0;
			}
			if($parent_08==0)
			{
				$parent_07_rate+=$parent_08_rate;
				$parent_08_rate=0;
			}
			if($parent_07==0)
			{
				$parent_06_rate+=$parent_07_rate;
				$parent_07_rate=0;
			}
			if($parent_06==0)
			{
				$parent_05_rate+=$parent_06_rate;
				$parent_06_rate=0;
			}
			if($parent_05==0)
			{
				$parent_04_rate+=$parent_05_rate;
				$parent_05_rate=0;
			}
			if($parent_04==0)
			{
				$parent_03_rate+=$parent_04_rate;
				$parent_04_rate=0;
			}
			if($parent_03==0)
			{
				$parent_02_rate+=$parent_03_rate;
				$parent_03_rate=0;
			}
			$parent_01_rate+=$parent_02_rate;
			$parent_02_rate=0;
				
			//level wise margin for client
			
			$qry11="insert into $bankapi_child_txn.txn_rc_margin value ('$order_id', '$parent_01', '$parent_01_rate', '$parent_02', '$parent_02_rate', '$parent_03', '$parent_03_rate', '$parent_04', '$parent_04_rate', '$parent_05', '$parent_05_rate', '$parent_06', '$parent_06_rate', '$parent_07', '$parent_07_rate', '$parent_08', '$parent_08_rate', '$parent_09', '$parent_09_rate', '$parent_10', '$parent_10_rate', '$parent_11', '$parent_11_rate', '$parent_12', '$parent_12_rate')";
			mysql_query($qry11);
			
			//margin for admin
			
			$qry12="insert into $bankapi_parent_txn.txn_rc_margin(rc_id, created_on, client_id, source_id, type, service_id, amount, admin_rate, client_rate, admin_comm) value ('$m_id', '$datetime_datetime', '$clientdbid', '$source', '$type', '$service', '$amount', '$deduction_admin', '$deduction_client', $deduction_admin-$deduction_client)";
			mysql_query($qry12);
		}
	}
	return $err;
}

function mid_by_order($order)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$mid=0;
	$query="SELECT * FROM $bankapi_child_txn.txn_rc where rc_id='$order';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$mid=$r['mid'];
	}
	return $mid;
}

function result_by_mid($mid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$result_id=0;
	$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_id='$mid';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$result_id=$r['result'];
	}
	return $result_id;
}

function source_by_mid($mid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$source=0;
	$query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_id='$mid';";
	$result=mysql_query($query);
	while($r = mysql_fetch_array($result)) 
	{
		$source=$r['source'];
	}
	return $source;
}

function show_ip()
{
	$ipaddress1 = "";
	if (isset($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
		$ipaddress1 = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
		$ipaddress1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress1 = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress1 = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress1 = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress1 = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress1 = 'UNKNOWN';
		
		
	$ipaddress2 = "";
	if (getenv('HTTP_CLIENT_IP'))//check ip from share internet
		$ipaddress2 = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))//to check ip is pass from proxy
		$ipaddress2 = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress2 = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress2 = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress2 = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress2 = getenv('REMOTE_ADDR');
	else
		$ipaddress2 = 'UNKNOWN';
		
	$final_ip=$ipaddress1."<br>".$ipaddress2;
	$browser=$_SERVER['HTTP_USER_AGENT'];
	
	$main_ip="$final_ip <br><br> $browser";
	return $main_ip;
}

function generate_rc_client_txn($query)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function generate_rc_admin_txn($query)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$generated_id=0;
	mysql_query($query);				
	$generated_id=mysql_insert_id();
	return $generated_id;
}

function refund_amount($oid,$mid,$tid,$refund_source_tid,$source)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	include_once('zf-WalletsMarginsForTxn.php');
	include_once('zf-WalletDistributed.php');
	// start refund to refund_source_tid//refund_admin_tid//refund_client_tid//refund_retailer_tid
	// get user id of order id
	$uid=0;
	$admin_charges=0;
	$client_charges=0;
	$retailer_charges=0;
	$qry3="select * from $bankapi_parent_txn.txn_rc where mrc_id='$mid'";
	$res3=mysql_query($qry3);
	while($rs3=mysql_fetch_array($res3))
	{
		$uid=$rs3['user_id'];
	}
	
	// get order deducted amount of admin wallet with wallet id
	$query_ref="select * from $bankapi_parent_wallet.rt_aquams where user_id='$uid' and client_id='$clientdbid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
	$result_ref=mysql_query($query_ref);
	while($rs_ref = mysql_fetch_assoc($result_ref))
	{
		$admin_charges=$rs_ref['amount_dr'];
	}
	
	// get order deducted amount of client wallet with wallet id
	$query_ref="select * from $bankapi_child_wallet.realtime where user_id='$uid' and client_order_id='$oid' and transaction_type='2' order by wallet_id desc limit 0,1";
	$result_ref=mysql_query($query_ref);
	while($rs_ref = mysql_fetch_assoc($result_ref))
	{
		$client_charges=$rs_ref['amount_dr'];
	}
	
	// get order deducted amount of user wallet with wallet id
	$field="request_id";
	if($mid>58292)
		$field="order_id";
	$query_ref="select * from $bankapi_child_wallet.distribution where user_id='$uid' and user_id2='0' and $field='$oid' and transaction_type='6'";
	$result_ref=mysql_query($query_ref);
	while($rs_ref = mysql_fetch_assoc($result_ref))
	{
		$retailer_charges=$rs_ref['amount_dr'];
	}
	
	$filled_remarks="RC order $oid refunded";
	//get last balance of admin
	$balance_admin=show_txn_admin_balance($source);
	$balance_admin_new=$balance_admin+$admin_charges;
	//refund order to admin
	$query4b="INSERT INTO $bankapi_parent_wallet.rt_aquams (wallet_date, wallet_time, client_id, user_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$clientdbid', '$uid', '$oid', '0', '3', '$filled_remarks', '$balance_admin', '$admin_charges', '0.00', '$balance_admin_new');";
	mysql_query($query4b);
	$refund_admin_tid=mysql_insert_id();
	
	//get last balance of client
	$balance_client=show_txn_client_balance();
	$balance_client_new=$balance_client+$client_charges;
	//refund order to client
	$query4b="INSERT INTO $bankapi_child_wallet.realtime (wallet_date, wallet_time, user_id, request_id, service_id, client_order_id, source_order_id, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal) VALUES ('$datetime_date', '$datetime_time', '$uid', '0', '101', '$oid', '0', '3', '$filled_remarks', '$balance_client', '$client_charges', '0.00', '$balance_client_new');";
	mysql_query($query4b);
	$refund_client_tid=mysql_insert_id();
	
	//get last balance of retailer
	$balance_retailer=show_txn_user_balance($uid);
	$balance_retailer_new=$balance_retailer+$retailer_charges;
	//refund order to retailer
	$query4b="INSERT INTO $bankapi_child_wallet.distribution (wallet_date, wallet_time, user_id, user_id2, request_id, service_id, order_id, tid, transaction_type, transaction_description, amount_pre, amount_cr, amount_dr, amount_bal, remarks) VALUES ('$datetime_date', '$datetime_time', '$uid', '0', '0', '101', '$oid', '$mid', '7', '$filled_remarks', '$balance_retailer', '$retailer_charges', '0.00', '$balance_retailer_new', '$filled_remarks at $datetime_datetime');";
	mysql_query($query4b);
	$refund_retailer_tid=mysql_insert_id();
	update_user_balance($uid);

	// update order status to refunded for admin
	$qry1="update $bankapi_parent_txn.txn_rc set mrc_status='5', refund_source_tid='$refund_source_tid', refund_admin_tid='$refund_admin_tid', refund_client_tid='$refund_client_tid', refund_retailer_tid='$refund_retailer_tid', updated_on='$datetime_datetime' where mrc_id='$mid'";
	mysql_query($qry1);	
	// update order status to refunded for client
	$qry2="update $bankapi_child_txn.txn_rc set rc_status='5', refund_source_tid='$refund_source_tid', refund_admin_tid='$refund_admin_tid', refund_client_tid='$refund_client_tid', refund_retailer_tid='$refund_retailer_tid', updated_on='$datetime_datetime' where rc_id='$oid'";
	mysql_query($qry2);	
}
?>