<?php
	include_once('_common-admin.php');
	if(!isset($_SESSION))
	{
		session_start();
	}	
	if(!isset($_SESSION['user_id']) || 
	!isset($_SESSION['user_type']) || 
	!isset($_SESSION['user_type_name']) || 
	!isset($_SESSION['user_name']) || 
	!isset($_SESSION['contact_no']) || 
	!isset($_SESSION['log_id']) || 
	!isset($_SESSION['wallet_balance']))
	{
		$user_id="";
		$user_type="";
		$user_types=$user_type_name="";
		$user_name="";
		$contact_no="";
		$wallet_balance="";
		$log_id="";
		header('location:../index.php');
	}
	else
	{
		$user_id=$_SESSION['user_id'];
		$user_type=$_SESSION['user_type'];
		
		if($user_type==0)
		$user_type_from=$user_type++;
		else
		$user_type_from=$user_type;
		
		$user_type_to=$user_type_from++;
		
		$user_types=$user_type_name=$_SESSION['user_type_name'];
		$user_name=$_SESSION['user_name'];
		$contact_no=$_SESSION['contact_no'];
		include_once 'functions/_wallet_balance.php';
		if($user_type=0)
		$_SESSION['wallet_balance']=wallet_balance(100001);
		else
		$_SESSION['wallet_balance']=wallet_balance($user_id);
		$wallet_balance=$_SESSION['wallet_balance'];
		$log_id=$_SESSION['log_id'];
		
		$selected_services_com='';
		$query_com="select service_types from parent_client where client_id=1001;";
		$result_com=mysql_query($query_com);
		while($row_com=mysql_fetch_array($result_com))
		{
			$selected_services_com=$row_com['service_types'];
		}
		$ssc=explode(",",$selected_services_com);
	}
?>