<?php
include('../_session-team.php');

$request_to=$_POST['request_to'];
if($request_to==100001)
{
	$deposit_date=$_POST['deposit_date'];
	$bank_id=$_POST['bank_id'];
	$payment_mode=$_POST['payment_mode'];
	$ref_no=$_POST['ref_no'];
	$deposit_amount=$_POST['deposit_amount'];
	$remarks=$_POST['remarks'];
	$request_remarks="sent at $datetime_time";

	$query4="INSERT INTO child_wallet_requests(request_date, request_time, user_id, deposite_date, bank_id, payment_mode, ref_no, deposit_amount, remarks, request_status, request_remarks) VALUES ('$date_time', '$time_time', '$user_id', '$deposit_date', '$bank_id', '$payment_mode', '$ref_no', '$deposit_amount', '$remarks', '1', '$request_remarks');";
	$result4=mysql_query($query4);

	if($result4==1)
	{
		$last_id = mysql_insert_id();
		$query9="SELECT * FROM child_bank where bank_id='$bank_id'";
		$result9=mysql_query($query9);
		$bank_name="";
		while($rs9 = mysql_fetch_assoc($result9)) 
		{
			$bank_name=$rs9['bank_name'];
		}
		include_once('../functions/_zsms.php');
		$zsms=create_payone_wallet_request_msg($last_id,$user_id,$user_name,$deposit_amount,$bank_name,$datetime_time);
		zsms("9864940008",$zsms);
		zsms("9896677625",$zsms);
		header("location:wallet-requests-sent.php");
	}
	else
	header("location:wallet-request-sent.php?msg=wallet-request-sent-fail");
}
else
{
	$request_to=$_POST['request_to'];
	$payment_mode=$_POST['payment_mode2'];
	$deposit_amount=$_POST['deposit_amount2'];
	$remarks=$_POST['remarks2'];
	$request_remarks="sent at $datetime_time";


	$query4="INSERT INTO child_wallet_requests(request_date, request_time, user_id, deposite_date, bank_id, payment_mode, ref_no, deposit_amount, remarks, request_status, request_remarks) VALUES ('$date_time', '$time_time', '$user_id', '$date_time', '$request_to', '$payment_mode', '0', '$deposit_amount', '$remarks', '1', '$request_remarks');";
	$result4=mysql_query($query4);

	if($result4==1)
	{
		$last_id = mysql_insert_id();
		$query9="SELECT * FROM child_user where user_id='$request_to'";
		$result9=mysql_query($query9);
		$user_contact_no="";
		while($rs9 = mysql_fetch_assoc($result9)) 
		{
			$user_contact_no=$rs9['user_contact_no'];
		}
		include_once('../functions/_zsms.php');
		$zsms="Payone User Id $user_id has sent you wallet request of amount $deposit_amount at $datetime_time";
		zsms("$user_contact_no",$zsms);
		header("location:wallet-requests-sent.php");
	}
	else
	header("location:wallet-request-sent.php?msg=wallet-request-sent-fail");
}

?>