<?php
//16-software amount
//17-security amount
//18-created commission
function withdraw_software_amount($userid)
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
	
	$qry_utp="select user_type from child_user where user_id='$userid';";
	$res_utp=mysql_query($qry_utp);
	$utp=0;
	while($rs_utp=mysql_fetch_array($res_utp))
	{
		$utp=$rs_utp['user_type'];
	}
	
	$cur_bal=user_wallet_balance($userid);
	$reg=software_amount($userid);
	$regc=software_amount_received($userid);
	$rem=$reg-$regc;
	
	if($rem>0 && $cur_bal>0)
	{	
		if($cur_bal>=$rem)
		{
			$amount_deduct=$rem;
			$new_bal=$cur_bal-$amount_deduct;
		}
		else
		{
			$amount_deduct=$cur_bal;
			$new_bal=$cur_bal-$amount_deduct;
		}		
		$query4b="insert into child_wallet_remain value 
		(NULL, '$date_time', '$time_time', '$userid', '100005', '0', '16', 'Software Amount deducted by Admin', '$cur_bal', '0', '$amount_deduct', '$new_bal');";
		$result24=mysql_query($query4b);
		update_wallet($userid);
		
		$admin_bal=wallet_balance(100005);
		$admin_bal2=$admin_bal+$amount_deduct;
		$query4b="insert into child_wallet_remain value 
		(NULL, '$date_time', '$time_time', '100005', '$userid', '0', '16', 'Software Amount received from $userid', '$admin_bal', '$amount_deduct', '0', '$admin_bal2');";
		$result24=mysql_query($query4b);
		update_wallet(100005);
		
		$q1="update child_user set regc_amount=(regc_amount+$amount_deduct) where user_id=$userid;";
		mysql_query($q1);
		
		$reg=software_amount($userid);
		$regc=software_amount_received($userid);
		//created commission will be paid to hierarchy if we received full amount of software and security
		if($regc==$reg)
		{	
			$admin_id=100005;
			$admin_com=0;
			
			$super_dist_id=0;
			$super_dist_com=0;
			
			$dist_id=0;
			$dist_com=0;
			
			$for_username="";
			
			$query_com="SELECT * FROM child_user where user_id='$userid';";
			$result_com=mysql_query($query_com);
			while($rs_com = mysql_fetch_array($result_com)) {
				//$admin_id=$rs_com['hierarchy_1_id'];
				$super_dist_id=$rs_com['hierarchy_2_id'];
				$dist_id=$rs_com['hierarchy_3_id'];
				$for_username=$rs_com['user_name'];
			}
			$comments="created commission for $userid - $for_username";
			
			if($utp==11)
			{			
				if($super_dist_id!=0 && $dist_id==0)
				{
					$admin_com=$reg*.10;
					$super_dist_com=$reg*.90;
					
					$pre_bal=wallet_balance($admin_id);
					$new_bal=$pre_bal-$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$admin_id', '$super_dist_id', '0', '18', '$comments', '$pre_bal', '0', '$super_dist_com', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($admin_id);
					
					$pre_bal=wallet_balance($super_dist_id);
					$new_bal=$pre_bal+$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$super_dist_id', '$admin_id', '0', '18', '$comments', '$pre_bal', '$super_dist_com', '0', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($super_dist_id);		
				}
				else if($super_dist_id==0 && $dist_id!=0)
				{
					$admin_com=$reg*.20;
					$dist_com=$reg*.80;
					
					$pre_bal=wallet_balance($admin_id);
					$new_bal=$pre_bal-$dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$admin_id', '$dist_id', '0', '18', '$comments', '$pre_bal', '0', '$dist_com', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($admin_id);
					
					$pre_bal=wallet_balance($dist_id);
					$new_bal=$pre_bal+$dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$dist_id', '$admin_id', '0', '18', '$comments', '$pre_bal', '$dist_com', '0', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($dist_id);	
				}
				else if($super_dist_id!=0 && $dist_id!=0)
				{
					$admin_com=$reg*.10;
					$super_dist_com=$reg*.10;
					$dist_com=$reg*.80;
					
					$pre_bal=wallet_balance($admin_id);
					$new_bal=$pre_bal-$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$admin_id', '$super_dist_id', '0', '18', '$comments', '$pre_bal', '0', '$super_dist_com', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($admin_id);
					
					$pre_bal=wallet_balance($super_dist_id);
					$new_bal=$pre_bal+$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$super_dist_id', '$admin_id', '0', '18', '$comments', '$pre_bal', '$super_dist_com', '0', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($super_dist_id);	
					
					$pre_bal=wallet_balance($admin_id);
					$new_bal=$pre_bal-$dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$admin_id', '$dist_id', '0', '18', '$comments', '$pre_bal', '0', '$dist_com', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($admin_id);
					
					$pre_bal=wallet_balance($dist_id);
					$new_bal=$pre_bal+$dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$dist_id', '$admin_id', '0', '18', '$comments', '$pre_bal', '$dist_com', '0', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($dist_id);
				}
			}
			else if($utp==3)
			{			
				if($super_dist_id!=0)
				{
					$admin_com=$reg*.50;
					$super_dist_com=$reg*.50;
					
					$pre_bal=wallet_balance($admin_id);
					$new_bal=$pre_bal-$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$admin_id', '$super_dist_id', '0', '18', '$comments', '$pre_bal', '0', '$super_dist_com', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($admin_id);
					
					$pre_bal=wallet_balance($super_dist_id);
					$new_bal=$pre_bal+$super_dist_com;
					$query4b="insert into child_wallet_remain value 
					(NULL, '$date_time', '$time_time', '$super_dist_id', '$admin_id', '0', '18', '$comments', '$pre_bal', '$super_dist_com', '0', '$new_bal');";
					$result24=mysql_query($query4b);
					update_wallet($super_dist_id);		
				}
			}
		}		
	}
}

function withdraw_security_amount($userid)
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
	
	$cur_bal=user_wallet_balance($userid);
	$reg=security_amount($userid);
	$regc=security_amount_received($userid);
	$rem=$reg-$regc;
	
	if($rem>0 && $cur_bal>0)
	{	
		if($cur_bal>=$rem)
		{
			$amount_deduct=$rem;
			$new_bal=$cur_bal-$amount_deduct;
		}
		else
		{
			$amount_deduct=$cur_bal;
			$new_bal=$cur_bal-$amount_deduct;
		}		
		$query4b="insert into child_wallet_remain value 
		(NULL, '$date_time', '$time_time', '$userid', '100005', '0', '17', 'Security Amount deducted by Admin', '$cur_bal', '0', '$amount_deduct', '$new_bal');";
		$result24=mysql_query($query4b);
		update_wallet($userid);
		
		$admin_bal=wallet_balance(100005);
		$admin_bal2=$admin_bal+$amount_deduct;
		$query4b="insert into child_wallet_remain value 
		(NULL, '$date_time', '$time_time', '100005', '$userid', '0', '17', 'Security Amount received from $userid', '$admin_bal', '$amount_deduct', '0', '$admin_bal2');";
		$result24=mysql_query($query4b);
		update_wallet(100005);
		
		$q1="update child_user set secc_amount=(secc_amount+$amount_deduct) where user_id=$userid;";
		mysql_query($q1);
		
		$reg=security_amount($userid);
		$regc=security_amount_received($userid);
	}
}

function software_amount($uid)
{
	$query2="SELECT * FROM child_user where user_id='$uid';";
	$result2=mysql_query($query2);
	$software_amount=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$software_amount=$rs2['reg_amount'];
	}
	return $software_amount;
}

function security_amount($uid)
{
	$query2="SELECT * FROM child_user where user_id='$uid';";
	$result2=mysql_query($query2);
	$security_amount=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$security_amount=$rs2['sec_amount'];
	}
	return $security_amount;
}

function software_amount_received($uid)
{
	$query2="SELECT * FROM child_user where user_id='$uid';";
	$result2=mysql_query($query2);
	$regc_amount=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$regc_amount=$rs2['regc_amount'];
	}
	return $regc_amount;
}

function security_amount_received($uid)
{
	$query2="SELECT * FROM child_user where user_id='$uid';";
	$result2=mysql_query($query2);
	$secc_amount=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$secc_amount=$rs2['secc_amount'];
	}
	return $secc_amount;
}
?>