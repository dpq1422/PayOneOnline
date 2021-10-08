<?php 

	include("db-conn.php");
	$qry="select * from txn_data where txn_status in(1,200);";
	$result=mysql_query($qry);
		while($rs=mysql_fetch_array($result))
		{
			$txnid=0;
			$txnid=$rs['txn_id'];
			$order_status=200;
			$user_id="demouser";
			$user_pass="demo1234";
			$access_method="STATUS";
			$url = "http://hostkrit.com/recharge_demo_api.php?";
			$url = $url . "user_id=" . $user_id;
			$url = $url . "&user_pass=" . $user_pass;
			$url = $url . "&access_method=" . $access_method;
			$url = $url . "&order_number=" . $txnid;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			
			$err = curl_error($curl);
			
			curl_close($curl);
			
			if ($err) {
				$response="cURL Error : " . $err;
			}
			else
			{
				//echo $response;
				
				$json_result= json_decode($response, true);
				$json_message=$json_result['message'];
				if($json_message=="SUCCESS")
				$order_status=100;
				else if($json_message=="PENDING")
				$order_status=200;
				else if($json_message=="FAILED")
				$order_status=300;
				else
				$order_status=200;
			}
			$qry1="update txn_data set other_remarks='$response', txn_status='$order_status' where txn_id='$txnid';";
			mysql_query($qry1);
			echo "<br><br>$txnid,$order_status";
			echo str_pad('',1024); flush(); ob_flush(); usleep(500000);
		}
		echo "<br><br> Please wait";
?>
<meta http-equiv='refresh' content='5'>