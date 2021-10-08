<?php
function show_collection($dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(charged) chgd from $bankapi_child_txn.com_generated where date(date_time) between '$dt1' and '$dt2' and source in(1,3) group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function show_my_team_collection($user_id,$dt1,$dt2)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select user_id, count(*) nums, sum(amount) amt, sum(charged) chgd from $bankapi_child_txn.com_generated where date(date_time) between '$dt1' and '$dt2' and source in(1,3) and (lvl_1_id='$user_id' or lvl_2_id='$user_id' or lvl_3_id='$user_id' or lvl_4_id='$user_id' or lvl_5_id='$user_id' or lvl_6_id='$user_id' or lvl_7_id='$user_id' or lvl_8_id='$user_id' or lvl_9_id='$user_id' or lvl_10_id='$user_id' or lvl_11_id='$user_id') group by user_id order by amt desc;";
	$result=mysql_query($query);
	return $result;
}
function calculate_payout($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT date(date_time) dt,sum(cr) cr,sum(dr) dr FROM $bankapi_child_txn.com_paid_child where user_id='$user_id' group by date(date_time) order by date(date_time)";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$bal=0;
	$query2="delete FROM $bankapi_child_txn.com_paid_parent where user_id='$user_id';";
	$result2=mysql_query($query2);
	while($rs = mysql_fetch_assoc($result))
	{
		$dt=$rs['dt'];
		$cr=$rs['cr'];
		$dr=$rs['dr'];
		$bal=$bal+$cr-$dr;
		$query3="insert into $bankapi_child_txn.com_paid_parent(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
		$result3=mysql_query($query3);
	}
}
function show_paid_comm($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_unpaid_comm($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child WHERE user_id = '$user_id'";
	$result=mysql_query($query);
	$bal=0;
	while($rs = mysql_fetch_assoc($result))
	{
		if(isset($rs['bal']))
		$bal=$rs['bal'];
	}
	return $bal;
}
function show_payout_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_payout_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_parent $cond order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_payout_detail_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond order by paid_id desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_payout_detail_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond order by paid_id desc";
	else
	$query="SELECT * FROM $bankapi_child_txn.com_paid_child $cond order by paid_id desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function show_order_details($order_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$retailer_id=0;
	$source=0;
	$type=0;
	$arr=array();
	$query="SELECT * FROM $bankapi_child_txn.txn_mt_child where order_id='$order_id';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$retailer_id=$res['user_id'];
		$source=$res['source'];
		$type=$res['type'];
	}
	$arr=array($retailer_id,$source,$type);
	return $arr;
}
function show_order_details2($order_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$retailer_id=0;
	$source=0;
	$type=0;
	$arr=array();
	$query="SELECT * FROM $bankapi_child_txn.txn_rc where rc_id='$order_id';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$retailer_id=$res['user_id'];
		$source=$res['source'];
		$type=$res['type'];
	}
	$arr=array($retailer_id,$source,$type);
	return $arr;
}
function show_team_commission_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc;";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_team_commission_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc";
	else
	$query="SELECT user_id,sum(cr) cr,sum(dr) dr,sum(cr-dr) bal FROM $bankapi_child_txn.com_paid_child $cond group by user_id having (sum(cr)!=0 or sum(dr)!=0) order by bal desc LIMIT $start_from, $num_rec_per_page;";
	$result=mysql_query($query);
	return $result;
}
function pay_now($from,$user,$amount,$remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$etid=time();
	$query="insert into $bankapi_child_txn.com_paid_child value(NULL,$etid,'$user',0,0,0,'$datetime_datetime','$remarks',0,'$amount');";
	mysql_query($query);
	transfer_user_to_user_paid($from, $user, $amount, $remarks);
}
?>