<?php

$oid="";
if(isset($_REQUEST['oid']))
$oid=$_REQUEST['oid'];

if($oid!="")
{
	include_once('../_gyan-info-retail.php');
	
	$second_time="0";
	$domain_name=$_SERVER['HTTP_HOST'];
	if($domain_name!="localhost")
	$second_time="19800";//19800
	$query_time="select date(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as date_time,
	time(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as time_time,
	sysdate() + interval $second_time second as datetime_time;";
	$result_time=mysql_query($query_time);
	$date_time="";
	$time_time="";
	$datetime_time="";
	while($row_time=mysql_fetch_array($result_time))
	{
		$date_time=$row_time['date_time'];
		$time_time=$row_time['time_time'];
		$datetime_time=$row_time['datetime_time'];
	}
	
	$qry_queue="select * from main_transaction_mt where eko_transaction_id='$oid'";
	$res_queue=mysql_query($qry_queue);
	while($rs_queue=mysql_fetch_array($res_queue))
	{
		$bankapi_user_id="100001";
		$bankapi_user_pass="9729877577";
		$bankapi_method="FUND_TRANSFER_INITIATE";
		$sender_number=$rs_queue['sender_number'];
		$receiver_id=$rs_queue['receiver_id'];
		$amount=$rs_queue['amount'];
		$order_number=$rs_queue['eko_transaction_id'];
		$transfer_method=$rs_queue['channel'];
		if($transfer_method=="")
			$transfer_method="IMPS";
		
		//echo str_replace('+00:00', 'Z', gmdate('c', strtotime('2013-05-07 18:56:57')))
		$timestamp=str_replace('+00:00', 'Z', gmdate('c', strtotime($date_time." ".$time_time)));
		
		/* API CALL 1 */
		
		include_once('../_gyan-info-retail.php');
		$url = "$call_url" . "?";
		$url = $url . "bankapi_user_id=" . $bankapi_user_id;
		$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
		$url = $url . "&bankapi_method=" . $bankapi_method;
		$url = $url . "&sender_number=" . $sender_number;
		$url = $url . "&receiver_id=" . $receiver_id;
		$url = $url . "&amount=" . $amount;
		$url = $url . "&order_number=" . $order_number;
		$url = $url . "&timestamp=" . $timestamp;
		$url = $url . "&transfer_method=" . $transfer_method;	
		
		$response=NULL;
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
			//echo $response;
			$result="";
			$qry2="update main_transaction_mt set response='$response',eko_transaction_status=1 where eko_transaction_id='$order_number'";
			mysql_query($qry2);
			//do
			//{
			//}
			//while(!isset($response));
			if(empty($response) || $response==NULL)
			{
				$result= json_decode($response, true);
				$message= $result['message'];
				$message=str_replace("Last_used_OkeyKey: 235","",$message);
				$msg=$msg."<br>".$message;
				$response_type_id= $result['response_type_id'];
				$response_status_id= $result['response_status_id'];
				$status= $result['status'];
				$qry2="update main_transaction_mt set response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message' where eko_transaction_id='$order_number'";
				mysql_query($qry2);
			}
		}
	}
}
header("location:admin-mt-queued.php");

?>