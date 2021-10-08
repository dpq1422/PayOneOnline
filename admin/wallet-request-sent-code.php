<?php
include('../_session-admin.php');
include('../_common-admin.php');

$deposit_date=$_POST['deposit_date'];
$bank_id=$_POST['bank_id'];
$payment_mode=$_POST['payment_mode'];
$ref_no=$_POST['ref_no'];
$deposit_amount=$_POST['deposit_amount'];
$remarks=$_POST['remarks'];
$request_remarks="sent at $datetime_time";


$query4="INSERT INTO parent_wallet_requests(request_date, request_time, client_id, user_id, deposite_date, bank_id, payment_mode, ref_no, deposit_amount, remarks, request_status, request_remarks) VALUES ('$date_time', '$time_time', '1001', '$user_id', '$deposit_date', '$bank_id', '$payment_mode', '$ref_no', '$deposit_amount', '$remarks', '1', '$request_remarks');";
$result4=mysql_query($query4);

if($result4==1)
{
	include_once('../functions/_zsms.php');
	$zsms=create_mentor_wallet_request_msg($user_id,$deposit_amount,$datetime_time);	
	zsms("9864860008",$zsms);
	zsms("8146145674",$zsms);	
	header("location:wallet-request-sents.php");
}
else
header("location:wallet-request-sent.php?msg=admin-wallet-request-fail");

?>