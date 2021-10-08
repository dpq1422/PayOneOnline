<?php

include_once('../_gyan-info-trans.php');
include_once('../_common-team.php');
include_once('../functions/_my_uname.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

$qry="update main_transaction_rc set rc_status='4' where result='Operator temporarily unavailable.' and rc_status in (1,3)";
mysql_query($qry);


$query="SELECT * FROM main_transaction_rc where rc_status in(1,3) and source=2 and type in(3,4) order by rc_id asc";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);	
$i=0;
echo $statement="<br><br><b>RC >> *** PROCESS :: Display Orders has not TxnNo and update them ***</b>";
if($num_rows>0)
{
	while($rs = mysql_fetch_array($result))
	{
/***** PART 1 = display stucked order *****/		
		$i++;
		$oid=$rs['rc_id'];
		$uid=$rs['user_id'];
		
		/*
		// check responsecode is 1001 to 1005
		$generic_response=$rs['response'];
		$generic_result= json_decode($generic_response, true);
		$generic_reponsecode=$generic_result['reponsecode'];
		if($generic_reponsecode<1000)
			continue;
		*/
		
		$unm=show_my_uname($rs['user_id']);
		$transaction_description=$rs['transaction_description'];
		$rstype=$rs['type'];
		if($rstype==3)
			$rstype="Recharge";
		else if($rstype==4)
			$rstype="DTH";
		$amount=$rs['amount'];
		//$result_tid=$rs['result'];
		$ret_comm=$rs['ret_comm'];
		$ret_comm=($amount*$ret_comm)/100;
		$deducted_amt=$rs['deducted_amt'];
echo $statement="<br><br><b>Order No. :</b> $oid, <b>User Id :</b> $uid, <b>User Name :</b> $unm, <br><b>Txn Type :</b>$rstype, <b>Amount :</b> $amount, <b>Ret Comm :</b> $ret_comm, <b>Deducted Amount :</b> $deducted_amt";		
		if($oid!="")
		{
/***** PART 2 = update TID for stucked order *****/		
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="STTSS";
			$request_number=$oid;									
									
			$call_url_rcaq="http://mentor-india.co.in/api-payoneonline.com/rc_ap_live.php";
			$url = "$call_url_rcaq" . "?";
			$url = $url . "bankapi_user_id=" . $bankapi_user_id;
			$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
			$url = $url . "&bankapi_method=" . $bankapi_method;
			$url = $url . "&request_number=" . $request_number;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);

			/* API RESULT 2 */

			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  $msg="<br>cURL Error : " . $err;
			}
			else
			{
				if(!(empty($response) || $response==NULL))
				{
					echo "<br><br>".$response;//die();
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
					else
						$rc_stat=6;//issue in order check and refund
					$qry1="update main_transaction_rc set response='$response', tid='$transid', updated_on='$datetime_time', rc_status='$rc_stat' where rc_id='$oid';";
					mysql_query($qry1);
					if($transid!=0)
					{
						$filled_remarks=",<br>TxnNo.: $transid";
						$qry2="update child_wallet_remain set transaction_description=concat(transaction_description,'$filled_remarks') where user_id=$uid and user_id2=0 and request_id=$oid;";
						mysql_query($qry2);
						echo $statement="<br><br><b>Updated TxnNo for Order No. :</b> $oid, <b>TxnNo :</b> $transid";
					}
flush();
ob_flush();		
				}
			}
		}
		//sleep(1);
	}
}

/***** PART 3 = update transaction status *****/		
echo $statement="<br><br><b>RC >> **** PROCESS :: Update Transaction Status ****</b>";
$qry1="SELECT * FROM main_transaction_rc where rc_status in(1,3,6) and source=2 and type in(3,4) order by rc_id asc;";
$res1=mysql_query($qry1);
$tid="";
while($rs1=mysql_fetch_array($res1))
{
	$uid=$rs1['user_id'];
	$unm=show_my_uname($rs1['user_id']);
	$oid=$rs1['rc_id'];
	$tid=$rs1['result'];
		
	/*
	// check responsecode is 1001 to 1005
	$generic_response=$rs1['response'];
	$generic_result= json_decode($generic_response, true);
	$generic_reponsecode=$generic_result['reponsecode'];
	if($generic_reponsecode<1000)
		continue;
	*/
	
	/* API CALL */
				 
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="STTS";
	$order_number=$tid;									
							
	$call_url_rcaq="http://mentor-india.co.in/api-payoneonline.com/rc_ap_live.php";
	$url = "$call_url_rcaq" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
			
	$dts=$rs1['created_on'];
	$amount=$rs1['amount'];
	$ret_comm=$rs1['ret_comm'];
	$ret_comm=($amount*$ret_comm)/100;
	$deducted_amt=$rs1['deducted_amt'];
				   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "<br>cURL Error : " . $err;
	}
	else
	{
		//echo "<br>".$response;//die();
		$result= json_decode($response, true);
		$reponsecode=$result['reponsecode'];
		$responsemsg=$result['responsemsg'];
		$transid=0;
		if(isset($result['transid']))
		$transid=$result['transid'];
		if(count($transid)==0 || $transid=="N" || $transid=="NA" || $transid=="N/A" || $transid==":")
			$transid=0;
	
		$rc_stat=1;//initiated
		if($reponsecode==1002)
			$rc_stat=2;//success
		else if($reponsecode==1004)
			$rc_stat=3;//in progress
		else if($reponsecode==1003)
			$rc_stat=4;// failed
		else
			$rc_stat=6;//issue in order check and refund
		$qry2="update main_transaction_rc set response='$response', tid='$transid', updated_on='$datetime_time', rc_status='$rc_stat' where rc_id='$oid';";
		mysql_query($qry2);	
		
echo $statement="<br><br><b>Order No :</b> $oid, <b>User Id :</b> $uid, <b>User Name :</b> $unm, <b>Date :</b> $dts, <br><b>Amount :</b> $amount, <b>Ret Comm :</b> $ret_comm, <b>Deducted Amount :</b> $deducted_amt, <br><b>TxnNo :</b> $tid, <b>Updated Status :</b> $responsemsg";

flush();
ob_flush();	
	}
	//sleep(1);
}

/***** PART 4 = Refund amount for failed transaction *****/
$qry_failed="SELECT * FROM main_transaction_rc where rc_status=4 and source=2 and type in(3,4) order by rc_id asc";
$result_failed=mysql_query($qry_failed);
$num_rows_failed = mysql_num_rows($result_failed);	
$i=0;
echo $statement="<br><br><b>RC >> ***** PROCESS :: Refund amount for failed transaction *****</b>";
if($num_rows_failed>0)
{
	while($rs_failed = mysql_fetch_array($result_failed))
	{
/***** PART 1 = display stucked order *****/		
		$i++;
		$oid=0;
		$uid=0;
		$trans_amt=0;
		$deducted_amt=0;
		// get user id and amount deducted of user and admin order id
		$oid=$rs_failed['rc_id'];
		$uid=$rs_failed['user_id'];
		$trans_amt=$rs_failed['amount'];
		$deducted_amt=$rs_failed['deducted_amt'];
		$deducted_amt=number_format((float)$deducted_amt, 2, '.', '');
		$admin_amount=$rs_failed['ret_comm']+$rs_failed['dist_comm']+$rs_failed['sd_comm']+$rs_failed['admin_comm'];
		$admin_amount=$trans_amt-(($trans_amt*$admin_amount)/100);
		$admin_amount=number_format((float)$admin_amount, 2, '.', '');		
		
		// get order deducted amount of user wallet with wallet id
		$qry4="select * from child_wallet_remain where user_id='$uid' and user_id2='0' and request_id='$oid' and transaction_type='6' and amount_dr='$deducted_amt' order by wallet_id desc;";
		$res4=mysql_query($qry4);
		$amt=0;
		while($rs4=mysql_fetch_array($res4))
		{
			$amt=$rs4['amount_dr'];
		}
		
		// get last updated balance of user
		update_wallet($uid);
		$wb=wallet_balance($uid);
		$new_bal=$wb+$amt;
		
		//refund order amount to user wallet
		$filled_remarks="RC order $oid refunded at $datetime_time";
		$query4b="insert into child_wallet_remain value (NULL, '$date_time', '$time_time', '$uid', '0', '$oid', '7', '$filled_remarks', '$wb', '$amt', '0', '$new_bal');";
		mysql_query($query4b);
		$refund_cid=mysql_insert_id();
		update_wallet($uid);
		
		$qry_refund_txn="update main_transaction_rc set updated_on='$datetime_time', tid='$refund_cid', rc_status='5' where rc_id='$oid';";
		mysql_query($qry_refund_txn);
		
		// get last updated balance of payone realtime wallet
		$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0, 1";
		$resss=mysql_query($qrss);
		$pre_bal15=0;
		while($rsss = mysql_fetch_array($resss))
		{
			echo "<br> 1 ".$pre_bal15=$rsss['amount_bal'];
		}
		echo "<br> 2 ".$bal2=$pre_bal15+$admin_amount;
		
		// refund order amount to payone realtime wallet
		$filled_remarks2="RC order $oid refunded at $datetime_time";
		echo " 2 ".$query4b="insert into child_wallet_realtime value (NULL, '$date_time', '$time_time', '$uid', '$oid', '0', '3', '$filled_remarks2', '$pre_bal15', '$admin_amount', '0', '$bal2');";
		$result24c=mysql_query($query4b);
		
		// get last updated balance of mentor realtime wallet
		$qrss2="select * from parent_wallet_realtime_aquams order by wallet_id desc limit 0, 1";
		$resss2=mysql_query($qrss2);
		$pre_bal21=0;
		$pre_bal25=0;
		while($rsss2 = mysql_fetch_array($resss2))
		{
			$pre_bal21=$rsss2['amount_bal'];
			$pre_bal25=$rsss2['real_bal'];
		}
		$bal3=$pre_bal21+$admin_amount;
		$bal3_live=$pre_bal25+$admin_amount;
		
		// refund order amount to mentor realtime wallet
		$filled_remarks3="RC order $oid refunded at $datetime_time";
		$query4b="insert into parent_wallet_realtime_aquams value (NULL, '$date_time', '$time_time', 1001, '$uid', '$oid', '0', '3', '$filled_remarks3', '$pre_bal21', '$admin_amount', '0', '$bal3', '$pre_bal25', '$admin_amount', '0', '$bal3_live');";
		$result24c+=mysql_query($query4b);
flush();
ob_flush();
	}
}






//echo "<meta http-equiv='refresh' content='5'>";
?>