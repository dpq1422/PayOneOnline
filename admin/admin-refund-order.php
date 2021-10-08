<?php
include_once('../_session-admin.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_update_wallet.php');

$oid="";
if(isset($_REQUEST['oid']))
$oid=$_REQUEST['oid'];

if($oid!="")
{
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="CHECK_ORDER_STATUS";
	$order_number=$oid;
							
							
	$url = "$call_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
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
			//echo $response;						
			$qry="update main_transaction_mt set response='$response' where eko_transaction_id='$oid';";
			mysql_query($qry);
		}
	}	
	
	$val_start='"txstatus_desc":"';
	$val_end='","fee":"';
	$pos_start=strpos($response, $val_start);
	$pos_end=strpos($response, $val_end);
	
	$startIndex = min($pos_start+17, $pos_end);
	$length = abs($pos_start+17 - $pos_end);
	$between = substr($response, $startIndex, $length);

	$response_result="$between";//$response;
	
	if($response_result=='{"response_status')
		$response_result="Failed";	
		
	// get user id and transfer amount without charges of order id
	$qry3="select * from main_transaction_mt where eko_transaction_id=$oid";
	$res3=mysql_query($qry3);
	$uid=0;
	$trans_amt=0;
	$ord_stat=0;
	while($rs3=mysql_fetch_array($res3))
	{
		$uid=$rs3['user_id'];
		$trans_amt=$rs3['amount'];
		$ord_stat=$rs3['eko_transaction_status'];
	}
	$deducted2=$trans_amt+6;
	$deducted3=$trans_amt+5.90;
	
	$qry123="SELECT * FROM child_wallet_remain where transaction_type=7 and request_id='$oid'";
	$res123=mysql_query($qry123);
	$record=0;
	while($rs123=mysql_fetch_array($res123))
	{
		$record++;
		$qry_updt="update main_transaction_mt set eko_transaction_status=5 where eko_transaction_id=$oid";
		mysql_query($qry_updt);
	}
	if($record!=0)
	{
		header('location:admin-process-refund.php');
	}
	
	//echo $response_result;
	if($response_result=="Failed" && ($ord_stat==0 || $ord_stat==6 || $ord_stat==3))
	{
		// get order deducted amount of user wallet with wallet id
		$qry4="select * from child_wallet_remain where user_id='$uid' and user_id2='0' and request_id='$oid' and transaction_type='6';";
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
		$filled_remarks="Money Transfer order $oid refunded by $user_types ($user_id - $user_name) at $datetime_time";
		$query4b="insert into child_wallet_remain value (NULL, '$date_time', '$time_time', '$uid', '0', '$oid', '7', '$filled_remarks', '$wb', '$amt', '0', '$new_bal');";
		mysql_query($query4b);
		$refund_cid=mysql_insert_id();
		update_wallet($uid);
		
		// get last updated balance of payone realtime wallet
		$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0, 1";
		$resss=mysql_query($qrss);
		$pre_bal15=0;
		while($rsss = mysql_fetch_assoc($resss))
		{
			$pre_bal15=$rsss['amount_bal'];
		}
		$bal2=$pre_bal15+$deducted2;
		
		// refund order amount to payone realtime wallet
		$filled_remarks2="Money Transfer order $oid refunded";
		$query4b="insert into child_wallet_realtime value (NULL, '$date_time', '$time_time', '$uid', '$oid', '0', '3', '$filled_remarks2', '$pre_bal15', '$deducted2', '0', '$bal2');";
		$result24c=mysql_query($query4b);
		$refund_aid=mysql_insert_id();
		
		// get last updated balance of mentor realtime wallet
		$qrss2="select * from parent_wallet_realtime order by wallet_id desc limit 0, 1";
		$resss2=mysql_query($qrss2);
		$pre_bal21=0;
		$pre_bal25=0;
		while($rsss2 = mysql_fetch_assoc($resss2))
		{
			$pre_bal21=$rsss2['amount_bal'];
			$pre_bal25=$rsss2['real_bal'];
		}
		$bal3=$pre_bal21+$deducted3;
		$bal3_live=$pre_bal25+$deducted3;
		
		// refund order amount to mentor realtime wallet
		$filled_remarks3="Money Transfer order $oid refunded";
		$query4b="insert into parent_wallet_realtime value (NULL, '$date_time', '$time_time', 1001, '$uid', '$oid', '0', '3', '$filled_remarks3', '$pre_bal21', '$deducted3', '0', '$bal3', '$pre_bal25', '$deducted3', '0', '$bal3_live');";
		$result24c+=mysql_query($query4b);
		$refund_mid=mysql_insert_id();
		
		// order status updated not initiated to refunded
		$qry2="update main_transaction_mt set eko_transaction_status=5, tid=0, refund_cid=$refund_cid, refund_aid=$refund_aid, refund_mid=$refund_mid, updated_on='$datetime_time' where eko_transaction_id=$oid";
		mysql_query($qry2);	
	}
}
header('location:admin-process-refund.php');
?>