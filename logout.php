<?php
	include('_common.php');
	include('_session.php');
	$query_log="update parent_user_log set logout_date='$date_time', logout_time='$time_time' where user_id='$user_id' and log_id='$log_id';";
	$result_log=mysql_query($query_log);
	unset($_SESSION['super_user_id']);
	unset($_SESSION['super_user_type']);
	unset($_SESSION['super_user_name']);
	unset($_SESSION['log_id']);
	session_unset();
	session_destroy();
	session_write_close();	
	$user_id="";
	$user_type="";
	$user_name="";
	$log_id="";
	header('location:login.php');
?>