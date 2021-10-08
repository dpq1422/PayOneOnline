<?php
include('../_session-admin.php');

$UserName=$_POST['UserName'];
$AadharNumber=$_POST['AadharNumber'];
$Email=$_POST['Email'];

$MobileNumber=$_POST['MobileNumber'];
$Password=$_POST['Password'];
$ConfirmPassword=$_POST['ConfirmPassword'];

$Address=$_POST['Address'];

$StateName=$_POST['StateName'];
$DisttName=$_POST['DisttName'];
$City=$_POST['City'];

$PinCode=$_POST['PinCode'];
$GsName=$_POST['GsName'];
$GsMobileNumber=$_POST['GsMobileNumber'];

$Department = "";
if(isset($_POST['Department']))
{
	$Department = implode(', ', $_POST['Department']);
}
$RolePermission = "";
if(isset($_POST['RolePermission']))
{
	$RolePermission = implode(', ', $_POST['RolePermission']);
}

$query4a="INSERT INTO child_user(join_date, join_time, user_type, user_name, aadhar_no, e_mail, user_contact_no, pass_word, address, city_name, distt_id, state_id, area_pin_code, guardian_spouse_name, guardian_spouse_contact_no, business_name, pancard_no, departments, roles, user_status, user_remarks) VALUES ('$date_time', '$time_time', 2, '$UserName', '$AadharNumber', '$Email', '$MobileNumber', '$Password', '$Address', '$City', '$DisttName', '$StateName', '$PinCode', '$GsName', '$GsMobileNumber', '', '', '$Department', '$RolePermission', 3, 'created by $user_types ($user_id - $user_name) at $datetime_time');";
$result4=mysql_query($query4a);
$last_id = mysql_insert_id();
mysql_query("insert into child_employee values (NULL, '$last_id','$user_id')");
$update_inc_id=explode(":",$time_time);
$update_inc_id=($update_inc_id[2]-$update_inc_id[2]%10)/10;
$update_inc_id=$last_id+$update_inc_id+1;
$qry_update_inc_id="ALTER TABLE child_user auto_increment = $update_inc_id;";
//mysql_query($qry_update_inc_id);


if($result4==1)
header("location:employees.php");
else
header("location:employee.php?msg=user-registration-fail");

?>