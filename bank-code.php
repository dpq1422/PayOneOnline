<?php
include('_common.php');
include('_session.php');

$filled_bank_name=$_POST['filled_bank_name'];
$filled_account_name=$_POST['filled_account_name'];
$filled_account_no=$_POST['filled_account_no'];
$filled_branch_name=$_POST['filled_branch_name'];
$filled_address=$_POST['filled_address'];
$filled_dist=$_POST['filled_dist'];
$filled_city=$_POST['filled_city'];
$filled_state=$_POST['filled_state'];
$filled_ifsc=$_POST['filled_ifsc'];
$filled_micr=$_POST['filled_micr'];
$filled_account_status=$_POST['filled_account_status'];

$query6="insert into parent_bank(bank_name, account_name, account_no, branch_name, branch_address, city_name, distt_id, state_id, ifsc_code, micr_code, account_status, account_remarks) value 
('$filled_bank_name', '$filled_account_name', '$filled_account_no', '$filled_branch_name', '$filled_address', '$filled_city', '$filled_dist', '$filled_state', '$filled_ifsc', '$filled_micr', '$filled_account_status', 'created by $user_types ($user_id - $user_name) at $datetime_time');";
$result6=mysql_query($query6);

if($result6>0)
header("location:banks.php");
else 
header("location:bank.php?msg=fail");


?>