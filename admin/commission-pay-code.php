<?php
include('../_session-admin.php');
if(isset($_POST['submit']))
{
	$desc=$_POST['desc'];
	$comm=$_POST['comm'];
	$etid=time();
	$uid=$_POST['uid'];
	$bala=$comm;
	
	$qrya="select * from main_commission_paid where user_id=$uid order by paid_id desc limit 0,1";
	$resa=mysql_query($qrya);
	while($rsa=mysql_fetch_assoc($resa))
	{
		$bala=$rsa['bal']-$bala;
	}
	
	
	$userid=$_POST['uid'];
	$filled_amount=$_POST['comm'];
	$filled_remarks=$_POST['desc'];
	$sender_id=100000;
	$receiver_id=100001;


	$bal1=$filled_amount;
	$pre_bal7=wallet_balance($sender_id);
	$bal1=$pre_bal7-$bal1;
	if($bal1>=0)// && $bal1!=$filled_amount
	{
		$query23="insert into main_commission_paid value(NULL,$etid,'$datetime_time','$uid','$desc',0,'$comm','$bala');";
		mysql_query($query23);
	
		$query4b="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','$sender_id','$receiver_id','0','20','$filled_remarks - distribution paid by admin from $sender_id for $receiver_id',
		'$pre_bal7', '0','$filled_amount','$bal1');";
		mysql_query($query4b);	
		include_once '../functions/_update_wallet.php';
		update_wallet($sender_id);


		$bal2=$filled_amount;
		$pre_bal8=wallet_balance($receiver_id);
		$bal2=$pre_bal8+$bal2;

		$query4b="insert into child_wallet_remain value 
		(NULL,'$date_time','$time_time','$receiver_id','$sender_id','0','21','$filled_remarks - distribution amount received by admin for $receiver_id from $sender_id by $user_types ($user_id - $user_name) at $datetime_time',
		'$pre_bal8', '$filled_amount','0','$bal2');";
		mysql_query($query4b);
		include_once '../functions/_update_wallet.php';
		update_wallet($receiver_id);
	}	
}
header("location:commission-unpaid-team.php");
?>