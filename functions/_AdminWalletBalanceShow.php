<?php
include('_common.php');
function admin_reals()
{
	$query_ar="SELECT * FROM parent_wallet_realtime order by wallet_id desc limit 0,1;";
	$result_ar=mysql_query($query_ar);
	$amt_ar=0;
	while($r_ar = mysql_fetch_assoc($result_ar)) 
	{
		$amt_ar=$r_ar['amount_bal'];
	}
	return $amt_ar;
}
function admin_reals_live()
{
	$query_ar="SELECT * FROM parent_wallet_realtime order by wallet_id desc limit 0,1;";
	$result_ar=mysql_query($query_ar);
	$amt_ar=0;
	while($r_ar = mysql_fetch_assoc($result_ar)) 
	{
		$amt_ar=$r_ar['real_bal'];
	}
	return $amt_ar;
}
function admin_reals2()
{
	$query_ar="SELECT * FROM parent_wallet_realtime_aquams order by wallet_id desc limit 0,1;";
	$result_ar=mysql_query($query_ar);
	$amt_ar=0;
	while($r_ar = mysql_fetch_assoc($result_ar)) 
	{
		$amt_ar=$r_ar['amount_bal'];
	}
	return $amt_ar;
}
function admin_reals_live2()
{
	$query_ar="SELECT * FROM parent_wallet_realtime_aquams order by wallet_id desc limit 0,1;";
	$result_ar=mysql_query($query_ar);
	$amt_ar=0;
	while($r_ar = mysql_fetch_assoc($result_ar)) 
	{
		$amt_ar=$r_ar['real_bal'];
	}
	return $amt_ar;
}
function admin_distributions()
{
	$query_ad="SELECT * FROM parent_wallet_remain order by wallet_id desc limit 0,1;";
	$result_ad=mysql_query($query_ad);
	$amt_ad=0;
	while($r_ad = mysql_fetch_assoc($result_ad)) 
	{
		$amt_ad=$r_ad['amount_bal'];
	}
	return $amt_ad;
}
?>