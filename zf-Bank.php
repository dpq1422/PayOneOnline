<?php
function show_banks_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_bank $cond ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}
function show_banks_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_bank $cond ";
	else
	$query="select * from $bankapi_child_base.child_bank $cond LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_bank_name($bank_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$bank_name="";
	$query="select * from $bankapi_child_base.child_bank where bank_id=$bank_id";
	$result=mysql_query($query);
	$bank_name=mysql_fetch_array($result)['bank_name'];
	return $bank_name;
}
function add_bank($bname,$baname,$bbname,$bano,$bifsc,$bcdm,$bcheque,$bcash,$bremark,$bstatus,$logged_user_typename,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$remark="$bremark - bank added by $logged_user_typename ($logged_user_id - $logged_user_name)";
	$query="insert into $bankapi_child_base.child_bank value(NULL, '$bname', '$baname', '$bano', '$bbname', '$bifsc', '$bstatus', '$remark', '$bcash', '$bcdm', '$bcheque')";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}
function generate_request($filled_dt,$filled_bank,$filled_method,$filled_refno,$filled_amount,$filled_remark,$logged_user_id,$logged_user_name)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_wallet.requests values(NULL,'$datetime_date','$datetime_time','$logged_user_id','$filled_dt','$filled_bank','$filled_method','$filled_refno','$filled_amount','$filled_remark','sent by $logged_user_id - $logged_user_name at $datetime_date $datetime_time','','',1)";
	mysql_query($query);
	$last_id=mysql_insert_id();
	$sms="Request No.: $last_id\n\nUser ID.: $logged_user_id\n\nAmount.: $filled_amount";
	require('zf-sms.php');
	zsms("9864940008",$sms);
	//zsms("8146145674",$sms);
}
?>