<?php
include_once('../_common-admin.php');
include_once('../_session-admin.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_ssamount.php');

$userid=$_POST['uid'];
$filled_amount=$_POST['filled_amount'];
$filled_remarks=$_POST['filled_remarks'];
$sender_id=100001;


$bal1=$filled_amount;
$pre_bal3=wallet_balance($sender_id);
$bal1=$pre_bal3-$bal1;
if($bal1>=0)// && $bal1!=$filled_amount
{	
	$second_time="0";
	$domain_name=$_SERVER['HTTP_HOST'];
	if($domain_name!="localhost")
	$second_time="19800";//19800
	$query_time="select date(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as date_time,
	time(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as time_time,
	sysdate() + interval $second_time second as datetime_time;";
	$result_time=mysql_query($query_time);
	$date_time="";
	$time_time="";
	$datetime_time="";
	while($row_time=mysql_fetch_array($result_time))
	{
		$date_time=$row_time['date_time'];
		$time_time=$row_time['time_time'];
		$datetime_time=$row_time['datetime_time'];
	}
	
	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$sender_id','$userid','0','2','$filled_remarks - amount transferred by admin $sender_id to $userid by $user_types ($user_id - $user_name) at $datetime_time',
	'$pre_bal3', '0','$filled_amount','$bal1');";
	$result24=mysql_query($query4b);
	update_wallet($sender_id);

	$bal2=$filled_amount;
	$pre_bal4=wallet_balance($userid);
	$bal2=$pre_bal4+$bal2;

	$query4b="insert into child_wallet_remain value 
	(NULL,'$date_time','$time_time','$userid','$sender_id','0','1','$filled_remarks - amount received from admin $sender_id to $userid',
	'$pre_bal4', '$filled_amount','0','$bal2');";
	$result24+=mysql_query($query4b);
	update_wallet($userid);
	
	withdraw_security_amount($userid);
	withdraw_software_amount($userid);
	
	include_once('../functions/_my_umobile.php');
	$unum=show_my_umobile($userid);
	include_once('../functions/_zsms.php');
	zsms($unum,"Dear User, Amount $filled_amount transferred by $user_id to your wallet at $datetime_time. Team Payone");
}

if($result24>0)
header("location:wallet-log-admin.php");
else
header("location:wallet-add.php?search=$userid&msg=balance-is-less-than-transferring-amount");


?>