<?php
include('../_common-team.php');
include('../_session-team.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_ssamount.php');

$userid=$_POST['uid'];
$filled_amount=$_POST['filled_amount'];
$filled_remarks=$_POST['filled_remarks'];
$sender_id=$user_id;


$bal1=$filled_amount;
$pre_bal1=wallet_balance($sender_id);
$bal1=$pre_bal1-$bal1;
$result24=0;
if($bal1>=0)// && $bal1!=$filled_amount
{	
	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$sender_id','$userid','0','4','$filled_remarks - amount transferred by distributor $sender_id to $userid',
	'$pre_bal1', '0','$filled_amount','$bal1');";
	$result24=mysql_query($query4b);
	include_once '../functions/_update_wallet.php';
	update_wallet($sender_id);


	$bal2=$filled_amount;
	$pre_bal2=wallet_balance($userid);
	$bal2=$pre_bal2+$bal2;

	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$userid','$sender_id','0','1','$filled_remarks - amount received from distributor $sender_id to $userid',
	'$pre_bal2', '$filled_amount','0','$bal2');";
	$result24+=mysql_query($query4b);
	include_once '../functions/_update_wallet.php';
	update_wallet($userid);
	
	withdraw_security_amount($userid);
	withdraw_software_amount($userid);
	
	include_once('../functions/_my_umobile.php');
	$unum=show_my_umobile($userid);
	include_once('../functions/_zsms.php');
	zsms($unum,"Dear User, Amount $filled_amount transferred by $user_id to your wallet at $datetime_time. Team Payone");
}

if($result24>0)
header("location:wallet-log.php");
else
header("location:wallet-add.php?search=$userid&msg=balance-is-less-than-transferring-amount");


?>