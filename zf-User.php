<?php
function show_users_count($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(1,-1) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_users_data($cond, $start_from=0, $num_rec_per_page=0)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$start_from=mysql_real_escape_string($start_from);
	$num_rec_per_page=mysql_real_escape_string($num_rec_per_page);
	if($start_from==0 && $num_rec_per_page==0)
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(1,-1) order by user_id ";
	else
	$query="select * from $bankapi_child_base.child_user $cond and user_type in(1,-1) order by user_id  LIMIT $start_from, $num_rec_per_page";
	$result=mysql_query($query);
	return $result;
}
function show_users_counts($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type between 2 and 12 and user_status=1 ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_users_datas($cond)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user $cond and user_type between 2 and 12 and user_status=1 order by user_id ";
	$result=mysql_query($query);
	return $result;
}

function show_user_name($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id ";
	$result=mysql_query($query);
	$user_name=mysql_fetch_array($result)['user_name'];
	return $user_name;
}

function show_user_profile($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_name="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id ";
	$result=mysql_query($query);
	return $result;
}

function show_user_type($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$user_type="";
	$query="select * from $bankapi_child_base.child_user where user_id=$user_id ";
	$result=mysql_query($query);
	$user_type=mysql_fetch_array($result)['user_type'];
	return $user_type;
}

function show_team_joined($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_type in(2,3,4,5,6,7,8,9,10,11) and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id or id_05=$user_id or id_06=$user_id or id_07=$user_id or id_08=$user_id or id_09=$user_id or id_10=$user_id or id_11=$user_id or id_12=$user_id) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function show_retailer_joined($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_userinfo_level where user_type=12 and (id_01=$user_id or id_02=$user_id or id_03=$user_id or id_04=$user_id or id_05=$user_id or id_06=$user_id or id_07=$user_id or id_08=$user_id or id_09=$user_id or id_10=$user_id or id_11=$user_id or id_12=$user_id) ";
	$result=mysql_query($query);
	$total_records=mysql_num_rows($result);
	return $total_records;
}

function update_type($user_id)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="select * from $bankapi_child_base.child_user ";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$uid=$utp=0;
		$uid=$res['user_id'];
		$utp=$res['user_type'];
		mysql_query("update $bankapi_child_base.child_userinfo_walletkyc set user_type='$utp' where user_id='$uid'");
	}
}

function update_password($user_id,$opass,$npass,$cpass)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_user set pass_word=md5('$npass'), past_change_on='$datetime_datetime', pint_change_on='$datetime_datetime' where user_id='$user_id' and pass_word=md5('$opass');";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}

function update_txn_pin($user_id,$opass,$npass,$cpass)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_user set txn_pin='$npass', past_change_on=pint_change_on where user_id='$user_id' and txn_pin='$opass';";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}

function create_user($utype, $uname, $uemail, $umob, $upass, $uadd, $ucity, $udist, $ustate, $upincode, $udep, $ugender, $ustatus, $uremark, $joinedby)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="insert into $bankapi_child_base.child_user (join_date, join_time, user_type, user_name, e_mail, user_contact_no, pass_word, address, city_name, distt_id, state_id, area_pin_code, user_department_info, gender, user_status, user_remarks, joined_by) value ('$datetime_date', '$datetime_time', '$utype', '$uname', '$uemail', '$umob', md5('$upass'), '$uadd', '$ucity', '$udist', '$ustate', '$upincode', '$udep', '$ugender', '$ustatus', '$uremark', '$joinedby') ;";
	mysql_query($query);
	$last_id = mysql_insert_id();
	return $last_id;
}

function show_kyc($userid)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	
	$return_result="";
	$geo="";
	$doctype="1";
	$docid="";
	$areapincode="";
	$tpin="";
	$docaadhar="";
	
	$query="select * from $bankapi_child_base.child_user where user_id='$userid';";
	$result=mysql_query($query);
	while($res=mysql_fetch_array($result))
	{
		$tpin=$res['txn_pin'];
		$areapincode=$res['area_pin_code'];
	}
	
	$query2="select * from $bankapi_child_base.child_userinfo_walletkyc where user_id='$userid';";
	$result2=mysql_query($query2);
	while($res2=mysql_fetch_array($result2))
	{
		$geo=$res2['geo_location'];
		$docid=$res2['pancard_no'];
		$docaadhar=$res2['aadhar_no'];
	}
	
	$return_result=array($tpin,$doctype,$docid,$areapincode,$geo,$docaadhar);
	return $return_result;
}

function update_user_lean($uid,$amount,$remarks)
{
	require('zc-gyan-info-admin.php');
	require('zc-commons-admin.php');
	$query="update $bankapi_child_base.child_userinfo_walletkyc set lean_amount=(lean_amount+$amount), lean_remarks='$remarks' where user_id='$uid';";
	mysql_query($query);
	$result=mysql_affected_rows();
	return $result;
}
?>