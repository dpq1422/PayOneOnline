<?php
include('_common.php');
include('_session.php');

$filled_user_type=$_POST['filled_user_type'];
$filled_name=$_POST['filled_name'];
$filled_address=$_POST['filled_address'];
$filled_dist=$_POST['filled_dist'];
$filled_city=$_POST['filled_city'];
$filled_state=$_POST['filled_state'];
$filled_area_pin_code=$_POST['filled_area_pin_code'];
$filled_e_mail=$_POST['filled_e_mail'];
$filled_contact_no=$_POST['filled_contact_no'];
$filled_pass_word=$_POST['filled_pass_word'];
$filled_user_status=$_POST['filled_user_status'];

$query4a="insert into parent_user value 
(NULL,'$date_time','$time_time','$filled_user_type','$filled_name','$filled_address','$filled_city',
'$filled_dist','$filled_state','$filled_area_pin_code','$filled_e_mail','$filled_contact_no','$filled_pass_word',
'$filled_user_status','created by $user_types ($user_id - $user_name) at $datetime_time');";
$result4=mysql_query($query4a);

if($result4==0)
header("location:user.php?msg=user-registration-fail");
else
header("location:users.php");


?>