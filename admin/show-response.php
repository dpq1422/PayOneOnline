<?php
include_once('../_session-admin.php');

$oid="";
if(isset($_POST['check']))
$oid=$_POST['check'];

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
		echo $response;
	}
}
?>
<form method='post'>
<input type='number' name='check' placeholder='order id' />
<input type='submit' value='check' />
</form>