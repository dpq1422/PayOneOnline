<?php
include_once('../_common-admin.php');
include_once('../_session-admin.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_ssamount.php');

$request_id=0;
$userid=0;
$filled_amount=0;
$request_status=0;
$filled_remarks=0;
$bid=0;
$pid=0;

if(isset($_POST['reqid']))
$request_id=$_POST['reqid'];

if(isset($_POST['uid']))
$userid=$_POST['uid'];

if(isset($_SESSION['dr_amount']))
$filled_amount=$_SESSION['dr_amount'];

if(isset($_POST['request_status']))
$request_status=$_POST['request_status'];

if(isset($_POST['filled_remarks']))
$filled_remarks=$_POST['filled_remarks'];

if(isset($_POST['bid']))
$bid=$_POST['bid'];

if(isset($_POST['pid']))
$pid=$_POST['pid'];

$sender_id=100001;

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
		(NULL,'$date_time','$time_time','$sender_id','$userid','$request_id','3','$filled_remarks - amount transferred against wallet request id $request_id',
		'$pre_bal5', '0','$filled_amount','$bal1');";
		$result24c+=mysql_query($query4b);
		include_once '../functions/_update_wallet.php';
		update_wallet($sender_id);
		
		
		$bal2=$filled_amount;
		$pre_bal6=wallet_balance($userid);
		$bal2=$pre_bal6+$bal2;

		$query4b="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','$userid','$sender_id','$request_id','1','$filled_remarks - amount received  against wallet request id $request_id',
		'$pre_bal6', '$filled_amount','0','$bal2');";
		$result24c+=mysql_query($query4b);
		include_once '../functions/_update_wallet.php';
		update_wallet($userid);
		
		if($bid==1 && $pid==6)
		{
			$charges=25;
			$pre_bal5=wallet_balance($userid);
			$bal1=$pre_bal5-$charges;

			$query4b="insert into child_wallet_remain value 
			(NULL,'$date_time','$time_time','$userid','$sender_id','0','12','SBI CDM deposit charges against request id $request_id', '$pre_bal5', '0', '$charges', '$bal1');";
			$result24c+=mysql_query($query4b);
			include_once '../functions/_update_wallet.php';
			update_wallet($userid);
			
			$pre_bal6=wallet_balance($sender_id);
			$bal2=$pre_bal6+$charges;

			$query4b="insert into child_wallet_remain value 
			(NULL,'$date_time','$time_time','$sender_id','$userid','0','13','SBI CDM deposit charges against request id $request_id', '$pre_bal6', '$charges', '0', '$bal2');";
			$result24c+=mysql_query($query4b);
			include_once '../functions/_update_wallet.php';
			update_wallet($sender_id);
		}
		if($bid==1 && $pid==5)
		{
			$charges=0;
			$sbi1=118;
			$sbi2=0;
			$sbi2=($filled_amount*.89);
			$sbi2=$sbi2/1000;
			$sbi2=$sbi2+59;

				if($sbi1>$sbi2)
					$charges=$sbi1;
				else
					$charges=$sbi2;
			$pre_bal5=wallet_balance($userid);
			$bal1=$pre_bal5-$charges;
			
			$query4b="insert into child_wallet_remain value 
			(NULL,'$date_time','$time_time','$userid','$sender_id','0','12','SBI Cash deposit charges against request id $request_id', '$pre_bal5', '0', '$charges', '$bal1');";
			$result24c+=mysql_query($query4b);
			include_once '../functions/_update_wallet.php';
			update_wallet($userid);
			
			$pre_bal6=wallet_balance($sender_id);
			$bal2=$pre_bal6+$charges;

			$query4b="insert into child_wallet_remain value 
			(NULL,'$date_time','$time_time','$sender_id','$userid','0','13','SBI Cash deposit charges against request id $request_id', '$pre_bal6', '$charges', '0', '$bal2');";
			$result24c+=mysql_query($query4b);
			include_once '../functions/_update_wallet.php';
			update_wallet($sender_id);
		}
		
		$filled_remarks=$filled_remarks." transaction accepted by admin $sender_id to $userid by $user_types ($user_id - $user_name) at $datetime_time";
		
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
	$filled_remarks=$filled_remarks." transaction rejected by admin $sender_id to $userid by $user_types ($user_id - $user_name) at $datetime_time";
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