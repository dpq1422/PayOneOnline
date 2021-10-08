<?php
include_once('../_session-admin.php');

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
}
header('location:admin-process-refund.php');
?>