<?php
include('../_common-admin.php');
function show_my_collection_team($user_idss,$dts)
{
	$query1="SELECT user_id uidsc FROM child_user where user_type=11 and (hierarchy_1_id='$user_idss' or hierarchy_2_id='$user_idss' or hierarchy_3_id='$user_idss')";
	$result1=mysql_query($query1);
	$my_collection=0;
	while($r1 = mysql_fetch_array($result1)) 
	{
		$uidsc=$r1['uidsc'];
		$query2="SELECT sum(amount) collection FROM main_transaction_commission where retailer_id=$uidsc and date(trans_date_time)='$dts'";
		$query2="SELECT sum(amount) collection FROM main_transaction_mt where user_id=$uidsc and eko_transaction_status=2 and date(created_on)='$dts'";
		$result2=mysql_query($query2);
		while($r2 = mysql_fetch_array($result2)) 
		{
			$my_collection+=$r2['collection'];
		}
	}
	return $my_collection;
}

function show_my_collection_retailer($user_idss,$dts)
{
	$my_collection=0;
	$query2="SELECT sum(amount) collection FROM main_transaction_commission where retailer_id=$user_idss and date(trans_date_time)='$dts'";
	$query2="SELECT sum(amount) collection FROM main_transaction_mt where user_id=$user_idss and eko_transaction_status=2 and date(created_on)='$dts'";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$my_collection+=$r2['collection'];
	}
	return $my_collection;
}

function show_my_earning($user_idss,$dts)
{
	$my_earning=0;
	$query2="SELECT sum(cr) earning FROM main_commission_paid where user_id=$user_idss and date(date_time)='$dts'";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$my_earning=$r2['earning'];
	}
	return $my_earning;
}
function show_my_collection_team2($user_idss,$dt1,$dt2)
{
	$query1="SELECT user_id uidsc FROM child_user where user_type=11 and (hierarchy_1_id='$user_idss' or hierarchy_2_id='$user_idss' or hierarchy_3_id='$user_idss')";
	$result1=mysql_query($query1);
	$my_collection=0;
	while($r1 = mysql_fetch_array($result1)) 
	{
		$uidsc=$r1['uidsc'];
		$query2="SELECT sum(amount) collection FROM main_transaction_mt where user_id=$uidsc and eko_transaction_status=2 and (date(created_on) between '$dt1' and '$dt2')";
		$result2=mysql_query($query2);
		while($r2 = mysql_fetch_array($result2)) 
		{
			$my_collection+=$r2['collection'];
		}
	}
	return $my_collection;
}

function show_my_collection_retailer2($user_idss,$dt1,$dt2)
{
	$my_collection=0;
	$query2="SELECT sum(amount) collection FROM main_transaction_mt where user_id=$user_idss and eko_transaction_status=2 and (date(created_on) between '$dt1' and '$dt2')";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$my_collection+=$r2['collection'];
	}
	return $my_collection;
}

function show_my_earning2($user_idss,$dt1,$dt2)
{
	$my_earning=0;
	$query2="SELECT sum(cr) earning FROM main_commission_paid where user_id=$user_idss and (date(date_time) between '$dt1' and '$dt2')";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$my_earning=$r2['earning'];
	}
	return $my_earning;
}

function show_my_receivings2($user_idss,$dt1,$dt2)
{
	$my_earning=0;
	$query2="SELECT sum(dr) earning FROM main_commission_paid where user_id=$user_idss and (date(date_time) between '$dt1' and '$dt2')";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$my_earning=$r2['earning'];
	}
	return $my_earning;
}

?>