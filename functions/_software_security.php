<?php

	include_once '../functions/_user_reg.php';
	include_once '../functions/_user_sec.php';
	include_once '../functions/_user_regc.php';
	include_once '../functions/_user_secc.php';
	$reg=software_amount($userid);
	$sec=security_amount($userid);
	$regc=rreceived_amount($userid);
	$secc=sreceived_amount($userid);
	$rem=$reg+$sec-$regc-$secc;
	
	if($rem>0)
	{									
		$reg_ded=0;
		$sec_ded=0;
		$remain=$filled_amount;
		if($regc<$reg)
		{
			if($remain>=$reg)
			{
				$reg_ded=$reg;
				$remain=$remain-$reg_ded;
			}
			else if($remain>0)
			{
				$reg_ded=$remain;
				$remain=$remain-$reg_ded;
			}
			
			// deduct by user and received by admin
			$cur_bal=wallet_balance($userid);
			//echo "<br>".
			//die();
			if($cur_bal>=$reg_ded)
			{
				$new_bal=$cur_bal-$reg_ded;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$userid','0','2','Software Amount deducted by Admin',
				'0','$reg_ded','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($userid);
				
				$new_bal=wallet_balance(100001)+$reg_ded;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$userid','0','3','Software Amount received from $userid',
				'$reg_ded','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($userid);
				
				$r_paid=$regc+$reg_ded;
				$q1="update child_user set regc_amount=$r_paid where user_id=$userid;";
				mysql_query($q1);
			}
		}
		
		if($secc<$sec)
		{
			if($remain>=$sec)
			{
				$sec_ded=$sec;
				$remain=$remain-$sec_ded;
			}
			else if($remain>0)
			{
				$sec_ded=$remain;
				$remain=$remain-$sec_ded;
			}
			
			// deduct by user and received by admin
			$cur_bal=wallet_balance($userid);
			if($cur_bal>=$sec_ded)
			{
				$new_bal=$cur_bal-$sec_ded;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$userid','0','2','Security Amount deducted by Admin',
				'0','$sec_ded','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($userid);
				
				$new_bal=wallet_balance(100001)+$sec_ded;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$userid','0','3','Security Amount received from $userid',
				'$sec_ded','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($userid);
				
				$s_paid=$secc+$sec_ded;
				$q1="update child_user set secc_amount=$s_paid where user_id=$userid;";
				mysql_query($q1);
			}
		}
		$reg=software_amount($userid);
		$sec=security_amount($userid);
		$regc=rreceived_amount($userid);
		$secc=sreceived_amount($userid);
		//created commission will be paid to hierarchy if we received full amount of software and security
		if($regc==$reg && $secc==$sec)
		{	
			$query_com="SELECT * FROM child_user where user_type=11 order by user_status asc,user_id desc";
			$result_com=mysql_query($query_com);
			$a_id_com=0;
			$sd_id_com=0;
			$d_id_com=0;
			$u_name_com="";
			while($rs_com = mysql_fetch_array($result_com)) {
				$a_id_com=$rs_com['hierarchy_1_id'];
				$sd_id_com=$rs_com['hierarchy_2_id'];
				$d_id_com=$rs_com['hierarchy_3_id'];
				$u_name_com=$rs_com['user_name'];
			}
			$comments="created commission for $userid - $u_name_com";
			if($sd_id_com!=0 && $d_id_com==0)
			{
				$a_id_coms=$reg*.10;
				$sd_id_coms=$reg*.90;
				
				$new_bal=wallet_balance($a_id_com)+$a_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$a_id_com','0','3','$comments','$a_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($a_id_com);
				
				$new_bal=wallet_balance($sd_id_com)+$sd_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$sd_id_com','0','3','$comments','$sd_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($sd_id_com);		
			}
			else if($sd_id_com==0 && $d_id_com!=0)
			{
				$a_id_coms=$reg*.20;
				$d_id_coms=$reg*.80;
				
				$new_bal=wallet_balance($a_id_com)+$a_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$a_id_com','0','3','$comments','$a_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($a_id_com);
				
				$new_bal=wallet_balance($d_id_com)+$d_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$d_id_com','0','3','$comments','$d_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($d_id_com);
			}
			else if($sd_id_com!=0 && $d_id_com!=0)
			{
				$a_id_coms=$reg*.10;
				$sd_id_coms=$reg*.10;
				$d_id_coms=$reg*.80;
				
				$new_bal=wallet_balance($a_id_com)+$a_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$a_id_com','0','3','$comments','$a_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($a_id_com);
				
				$new_bal=wallet_balance($sd_id_com)+$sd_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$sd_id_com','0','3','$comments','$sd_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($sd_id_com);
				
				$new_bal=wallet_balance($d_id_com)+$d_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$d_id_com','0','3','$comments','$d_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($d_id_com);
			}
			else if($sd_id_com==0 && $d_id_com==0)
			{
				$a_id_coms=$reg;
				
				$new_bal=wallet_balance($a_id_com)+$a_id_coms;
				$query4b="insert into child_wallet_remain value 
				(NULL,'$date_time','$time_time','$a_id_com','0','3','$comments','$a_id_coms','0','$new_bal');";
				$result24=mysql_query($query4b);
				include_once '../functions/_update_wallet.php';
				update_wallet($a_id_com);
			}
		}		
	}
	
	///////////////////////////////////////////////////////
?>