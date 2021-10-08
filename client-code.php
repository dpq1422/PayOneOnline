<?php
include('_common.php');
include('_session.php');

$filled_name=$_POST['filled_name'];
$filled_address=$_POST['filled_address'];
$filled_dist=$_POST['filled_dist'];
$filled_city=$_POST['filled_city'];
$filled_state=$_POST['filled_state'];
$filled_pin=$_POST['filled_pin'];
$filled_pan=$_POST['filled_pan'];
$filled_contact_no=$_POST['filled_contact_no'];
$filled_e_mail=$_POST['filled_e_mail'];
$filled_dob=$_POST['filled_dob'];
$filled_regamt=$_POST['filled_regamt'];
$filled_walbal=$_POST['filled_walbal'];
$filled_status=1;
$filled_services=implode(",", $_POST['filled_services']);

$query24="insert into parent_client(join_date,join_time,client_name,address_location,city_name,distt_id,state_id,
area_pin_code,client_contact_no,e_mail,pan_no,dob,
reg_amount,wallet_balance,service_types,client_status,client_remarks) value 
('$date_time','$time_time','$filled_name','$filled_address','$filled_city','$filled_dist','$filled_state',
'$filled_pin','$filled_contact_no','$filled_e_mail','$filled_pan','$filled_dob',
'$filled_regamt','$filled_walbal','$filled_services', '$filled_status','created by $user_types ($user_id - $user_name) at $datetime_time');";
$result24=mysql_query($query24);

if($result24>0)
{
	$last_id = mysql_insert_id();
	$query4b="INSERT INTO child_wallet_realtime VALUES (NULL, '$date_time', '$time_time', '$last_id', '0', '0', '0', 'Account Opened by $user_types $user_id $user_name', '0', '0', '0', '0');";
	$result4=mysql_query($query4b);
	$query4b="INSERT INTO child_wallet_remain VALUES (NULL, '$date_time', '$time_time', '$last_id', '0', '0', '0', 'Account Opened by $user_types $user_id $user_name', '0', '0', '0', '0');";
	$result4=mysql_query($query4b);
	header("location:clients.php");
}
else
header("location:client.php?msg=fail");


?>