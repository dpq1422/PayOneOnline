<?php
include_once('../_common-admin.php');
include_once('../_session-admin.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_ssamount.php');

$request_id=$_POST['reqid'];
$userid=$_POST['uid'];
$filled_amount=$_SESSION['dr_amount'];
$request_status=$_POST['request_status'];
$filled_remarks=$_POST['filled_remarks'];
$sender_id=$user_id;

$result24=0;
$result24c=0;
$amt_ads=wallet_balance($sender_id);
if($request_status==2)
{
	if($filled_amount<=$amt_ads)
	{
		$bal1=$filled_amount;
		$pre_bal5=wallet_balance($sender_id);
		$bal1=$pre_bal5-$bal1;
		if($bal1==$filled_amount)
		{
			$bal1=$bal*(-1);
		}

		$query4b="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','$sender_id','$userid','$request_id','4','$filled_remarks - amount transferred against wallet request id $request_id',
		'$pre_bal5', '0','$filled_amount','$bal1');";
		$result24c+=mysql_query($query4b);
		include_once '../functions/_update_wallet.php';
		update_wallet($sender_id);
		
		
		$bal2=$filled_amount;
		$pre_bal6=wallet_balance($userid);
		$bal2=$pre_bal6+$bal2;

		$query4b="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','$userid','$sender_id','$request_id','1','$filled_remarks - amount received against wallet request id $request_id',
		'$pre_bal6', '$filled_amount','0','$bal2');";
		$result24c+=mysql_query($query4b);
		include_once '../functions/_update_wallet.php';
		update_wallet($userid);
		
		$filled_remarks=$filled_remarks." transaction accepted by $user_id at $datetime_time";
		
		withdraw_security_amount($userid);
		withdraw_software_amount($userid);
	}
	else
	{
		$request_status=1;
		$filled_remarks=" Please wait for some time.";
	}
}
else
{
	$filled_remarks=$filled_remarks." transaction rejected by $user_id at $datetime_time";
}

$query24c="update child_wallet_requests set request_status=$request_status, remarks=concat(remarks,' <br> $filled_remarks') where request_id='$request_id' and user_id='$userid';";
$result24=mysql_query($query24c);

	include_once('../functions/_my_uname.php');
	include_once('../functions/_my_umobile.php');
	$unum=show_my_umobile($userid);
	$uname=show_my_uname($userid);
	include_once('../functions/_zsms.php');
	$zsms=create_payone_wallet_request_msg_reply($request_id,$uname,$filled_amount,$request_status);
	zsms($unum,$zsms);
	
if($result24c>0)
{
	header("location:wallet-request-receiveds.php");
}
else
{
	if($request_status==3)
	header("location:wallet-request-receiveds.php");
	else
	header("location:wallet-request-received-reply.php?rid=$request_id&uid=$userid&msg=balance-is-less-than-transferring-amount");
}


?>