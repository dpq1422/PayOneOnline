<?php
function show_distributed_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_distributed_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_wallet.distribution $cond order by wallet_id desc ";
	else
	$query="select * from $bankapi_child_wallet.distribution $cond order by wallet_id desc LIMIT $start_from, $num_rec_per_page ";
	$result=mysql_query($query);
	return $result;
}
function show_distributed_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.distribution where user_id=100001 order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_user_balance($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_child_wallet.distribution where user_id='$user' order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function show_dummy_balance()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$query="select * from $bankapi_parent_base.parent_client where client_id='$clientdbid';";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['dummy_balance'];
	}
	return $bal;
}
function update_user_balance($user)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bal=show_user_balance($user);
	$query="update $bankapi_child_base.child_userinfo_walletkyc set wallet_balance='$bal' where user_id='$user'";
	mysql_query($query);
}
function show_rt()
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_wallet.realtime order by wallet_id desc limit 0,1 ";
	$result=mysql_query($query);
	$bal=0;
	while($row=mysql_fetch_array($result))
	{
		$bal=$row['amount_bal'];
	}
	return $bal;
}
function transfer_admin_to_user($user, $amount, $remarks, $remarks_admin, $request=0, $bnk=0, $pm=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance('100001');
	if($pre>=$amount)
	{
		$post=$pre-$amount;
		$type=2;
		if($request==0)
			$type=2;
		else
			$type=3;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '100001', '$user', '$request', 0, 0, 0, '$type', '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance('100001');
		
		$pre2=show_user_balance($user);
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '100001', '$request', 0, 0, 0, 1, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance($user);
		
		if($request!=0 && $bnk!=0 && $pm!=0)
		{
			if($bnk==1 && $pm==6)
			{
				$charges=25;
				$pre3=show_user_balance($user);
				$post3=$pre3-$charges;
				$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '100001', 0, 0, 0, 0, 12, 'SBI CDM deposit charges against request id $request', '$pre3', '0', '$charges', '$post3', 'SBI CDM deposit charges against request id $request')";
				mysql_query($query);
				update_user_balance($user);
				
				$pre4=show_user_balance('100001');
				$post4=$pre4+$charges;
				
				$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '100001', '$user', 0, 0, 0, 0, 13, 'SBI CDM deposit charges against request id $request', '$pre4', '$charges', '0', '$post4', 'SBI CDM deposit charges against request id $request')";
				mysql_query($query2);
				update_user_balance('100001');
			}
			if($bnk==1 && $pm==5)
			{
				$charges=0;
				$sbi1=118;
				$sbi2=0;
				$sbi2=($amount*.89);
				$sbi2=$sbi2/1000;
				$sbi2=$sbi2+59;

					if($sbi1>$sbi2)
						$charges=$sbi1;
					else
						$charges=$sbi2;
					
				//remove this line later
				$charges=59;
				$pre3=show_user_balance($user);
				$post3=$pre3-$charges;
				
				$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '100001', 0, 0, 0, 0, 12, 'SBI Cash deposit charges against request id $request', '$pre3', '0', '$charges', '$post3', 'SBI Cash deposit charges against request id $request')";
				mysql_query($query);
				update_user_balance($user);
				
				$pre4=show_user_balance('100001');
				$post4=$pre4+$charges;
				
				$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '100001', '$user', 0, 0, 0, 0, 13, 'SBI Cash deposit charges against request id $request', '$pre4', '$charges', '0', '$post4', 'SBI Cash deposit charges against request id $request')";
				mysql_query($query2);
				update_user_balance('100001');
			}
		}
	}
	//withdraw_security_amount($user);
	//withdraw_software_amount($user);
	//withdraw_lean_amount($user);
}


function transfer_admin_to_user_rejected($user, $amount, $remarks, $remarks_admin, $request=0, $bnk=0, $pm=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$type=2;
	if($request==0)
		$type=2;
	else
		$type=3;
	
	$pre=show_user_balance($user);
	$post=$pre-$amount;
	$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '100001', 0, 0, 0, 0, 12, 'Wrong wallet request rejection charges against request id $request $remarks', '$pre', '0', '$amount', '$post', 'Wrong wallet request rejection charges against request id $request $remarks_admin')";
	mysql_query($query);
	update_user_balance($user);
	
	$pre2=show_user_balance('100001');
	$post2=$pre2+$amount;
	
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '100001', '$user', 0, 0, 0, 0, 13, 'Wrong wallet request rejection charges against request id $request', '$pre2', '$amount', '0', '$post2', 'Wrong wallet request rejection charges against request id $request')";
	mysql_query($query2);
	update_user_balance('100001');
}

function transfer_user_to_admin($user, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance($user);
	if($pre>=$amount)
	{
		$post=$pre-$amount;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user', '100001', 0, 0, 0, 0, 5, '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance($user);
		
		$pre2=show_user_balance('100001');
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '100001', '$user', 0, 0, 0, 0, 5, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance('100001');
	}
}


function transfer_user_to_user($user_from, $user_to, $amount, $remarks, $remarks_admin)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$pre=show_user_balance($user_from);
	if($pre>=$amount)
	{
		$post=$pre-$amount;
		//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
		$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_from', '$user_to', 0, 0, 0, 0, 4, '$remarks', '$pre', '0', '$amount', '$post', '$remarks_admin')";
		mysql_query($query);
		update_user_balance($user_from);
		
		$pre2=show_user_balance($user_to);
		$post2=$pre2+$amount;
		$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 1, '$remarks', '$pre2', '$amount', '0', '$post2', '$remarks_admin')";
		mysql_query($query2);
		update_user_balance($user_to);
	}
	//withdraw_security_amount($user_to);
	//withdraw_software_amount($user_to);
	//withdraw_lean_amount($user_to);
}

function transfer_user_to_user_paid($user_from, $user_to, $amount, $remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$remarks2=$remarks." PAID TO $user_to ";
	$pre=show_user_balance($user_from);
	$post=$pre-$amount;
	//transaction_type//1=received//2=manual transfer//3=request transfer//4=team transfer//5=manual withdraw
	$query="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_from', '$user_to', 0, 0, 0, 0, 9, '$remarks2', '$pre', '0', '$amount', '$post', '$remarks2')";
	mysql_query($query);
	update_user_balance($user_from);
	
	$remarks3=$remarks." PAID CLEARANCE FOR $user_to ";
	$user_to=100001;
	$pre2=show_user_balance($user_to);
	$post2=$pre2+$amount;
	$query2="INSERT INTO $bankapi_child_wallet.distribution(`wallet_date`, `wallet_time`, `user_id`, `user_id2`, `request_id`, `service_id`, `order_id`, `tid`, `transaction_type`, `transaction_description`, `amount_pre`, `amount_cr`, `amount_dr`, `amount_bal`, `remarks`) VALUES ('$datetime_date', '$datetime_time', '$user_to', '$user_from', 0, 0, 0, 0, 21, '$remarks3', '$pre2', '$amount', '0', '$post2', '$remarks3')";
	mysql_query($query2);
	update_user_balance($user_to);
}
?>