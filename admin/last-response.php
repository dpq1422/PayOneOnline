<?php
include_once('../_gyan-info-admin.php');
	
$qry1="SELECT * FROM main_transaction_mt WHERE last_response is NULL order by eko_transaction_id limit 0,25;";
$res=mysql_query($qry1);
while($rs=mysql_fetch_array($res))
{
	$id="";
	$response="";
	$id=$rs['eko_transaction_id'];
	if($id!="")
	{
		$bankapi_user_id="100001";
		$bankapi_user_pass="9729877577";
		$bankapi_method="CHECK_ORDER_STATUS";
		$order_number=$id;
								
		$url = "$call_url" . "?";
		$url = $url . "bankapi_user_id=" . $bankapi_user_id;
		$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
		$url = $url . "&bankapi_method=" . $bankapi_method;
		$url = $url . "&order_number=" . $order_number;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
	
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  $msg="<br>cURL Error : " . $err;
		}
		else
		{
			if($response==NULL || empty($response))
			$response = "0";
			if($response=='{"response_status_id":1,"invalid_params":{"tid":"Please provide a valid TID to know the status of the transaction."},"response_type_id":-1,"message":"failed!inquired.tx.not.found","status":69}' || $response=='{"response_status_id":1,"invalid_params":{"tid":"please provide the valid TId."},"response_type_id":-1,"message":"failed!dialler.tx.inquired.not.found","status":69}')
			$response = "1";
			if($response=="cURL Error : Operation timed out after 15001 milliseconds with 0 out of 0 bytes received")
			$response = "2";
			$update_qry="update main_transaction_mt set last_response='$response' where eko_transaction_id='$id'";
			mysql_query($update_qry);
			$response = str_replace(","," , ",$response);
			echo "<b>Order :: $id</b> $response<br><br>";
		}
	}
	flush();
	ob_flush();
}
mysql_query("UPDATE main_transaction_mt SET last_response = NULL WHERE last_response=2 or last_response LIKE '%curl%' or last_response LIKE '%invalid%'");
$link="last-response.php";
echo "<meta http-equiv='refresh' content='1'>";
?>