<?php
include('_common.php');
include('_session.php');

$filled_name=$_POST['filled_name'];
$filled_address=$_POST['filled_address'];
$filled_dist=$_POST['filled_dist'];
$filled_city=$_POST['filled_city'];
$filled_state=$_POST['filled_state'];
$filled_contact_no=$_POST['filled_contact_no'];
$filled_e_mail=$_POST['filled_e_mail'];
$filled_website=$_POST['filled_website'];
$filled_source_status=$_POST['filled_source_status'];

$query6="insert into all_recharge_source(source_name,address,city_name,distt_id,state_id,contact_no,e_mail,web_site,source_status,source_remarks) value 
('$filled_name','$filled_address','$filled_city','$filled_dist','$filled_state','$filled_contact_no','$filled_e_mail','$filled_website',
'$filled_source_status','created by $user_types ($user_id - $user_name) at $datetime_time');";
$result6=mysql_query($query6);

if($result6>0)
header("location:recharge-sources.php");
else 
header("location:recharge-source.php?msg=fail");


?>