<?php
include('../_common-admin.php');
include('../_session-admin.php');
include_once '../functions/_wallet_balance.php';

$userid=$_POST['uid'];
$filled_amount=$_POST['filled_amount'];
$filled_remarks=$_POST['filled_remarks'];
$sender_id=100001;


$bal1=$filled_amount;
$pre_bal7=wallet_balance($userid);
$bal1=$pre_bal7-$bal1;
if($bal1>=0)// && $bal1!=$filled_amount
{
	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$userid','$sender_id','0','5','$filled_remarks - amount deducted by admin $sender_id from $userid',
	'$pre_bal7', '0','$filled_amount','$bal1');";
	$result24=mysql_query($query4b);	
	include_once '../functions/_update_wallet.php';
	update_wallet($userid);


	$bal2=$filled_amount;
	$pre_bal8=wallet_balance($sender_id);
	$bal2=$pre_bal8+$bal2;

	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$sender_id','$userid','0','5','$filled_remarks - amount deducted by admin $sender_id from $userid by $user_types ($user_id - $user_name) at $datetime_time',
	'$pre_bal8', '$filled_amount','0','$bal2');";
	$result24+=mysql_query($query4b);
	include_once '../functions/_update_wallet.php';
	update_wallet($sender_id);
	
}

if($result24>0)
header("location:wallet-log-admin.php");
else
header("location:wallet-withdraw.php?search=$userid&msg=fail-can-not-make-debit-account-negative");


?>