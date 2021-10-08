<?php

$j=0;

include('../_gyan-info-login.php');
$qry2="select * from eko_bank where response='';";
$res2=mysql_query($qry2);
while($row=mysql_fetch_array($res2))
{	
	$result="";
	$message="";
	$response_type_id="";//466
	$response_status_id="";//0
	$status="";//0
	$data="";
	$isverificationavailable="";
	$name="";
	$ifsc_status="";
	$available_channels="";
	
	/* API CALL */
				 
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="SHOW_BANK";
	$bank_code=$row['bank_code'];

	$url = "$call_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&bank_code=" . $bank_code;

				   
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
		//echo $response;
		/*	
			{
				"response_status_id":0,
				"data":
				{
					"isverificationavailable":"1",
					"code":"UTIB",
					"ifsc_status":1,
					"name":"AXIS BANK",
					"available_channels":0
				},
				"response_type_id":466,
				"message":"Success! Bank Found for given Bank Code",
				"status":0
			}
		*/
		$result= json_decode($response, true);
		$message= $result['message'];
		$response_type_id= $result['response_type_id'];//466
		$response_status_id= $result['response_status_id'];//0
		$status= $result['status'];//0
		if($response_type_id==466 && $response_status_id==0 && $satus==0)
		{
			$data = $result['data'];
			$name=$data['name'];
			$isverificationavailable=$data['isverificationavailable'];
			$ifsc_status=$data['ifsc_status'];
			$available_channels=$data['available_channels'];
			
			$qry="UPDATE eko_bank SET response='$response', response_type_id='$response_type_id', response_status_id='$response_status_id', response_status='$status', response_message='$message', bank_name='$name', ifsc_status='$ifsc_status', available_channels='$available_channels', verification_available='$isverificationavailable', response_updated_on=sysdate() WHERE bank_code='$bank_code';";
			$j+=mysql_query($qry);
		}
		else
		{
			$qry="UPDATE eko_bank SET response='$response', response_type_id='$response_type_id', response_status_id='$response_status_id', response_status='$status', response_message='$message', response_updated_on=sysdate() WHERE bank_code='$bank_code';";
			$j+=mysql_query($qry);
		}
	}
}
echo "<br><br>$j banks updated";


?>