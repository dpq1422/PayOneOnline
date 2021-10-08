<?php
include('../_session-admin.php');

$tuid=$_POST['tuid'];
$tuname=$_POST['tuname'];
$tubname=$_POST['tubname'];

$tumob=$_POST['tumob'];
$tusex=$_POST['tusex'];

$tuadhar=$_POST['tuadhar'];
$tupan=$_POST['tupan'];

$tuemail=$_POST['tuemail'];
$tudob=$_POST['tudob'];

$tuadd=$_POST['tuadd'];

$StateName=$_POST['StateName'];
$DisttName=$_POST['DisttName'];

$tucity=$_POST['tucity'];
$tupincode=$_POST['tupincode'];

$tugeo=$_POST['tugeo'];

if(isset($_POST['a3']))
$kyc_remarks=$_POST['a3']." updated by $user_types ($user_id - $user_name)<br>";

if(isset($_POST['UpdateProfile']) && isset($_POST['a3']))
{
	$query4a="update child_user set user_name='$tuname', business_name='$tubname', user_contact_no='$tumob', gender='$tusex', aadhar_no='$tuadhar', pancard_no='$tupan', e_mail='$tuemail', date_of_birth='$tudob', address='$tuadd', state_id='$StateName', distt_id='$DisttName', city_name='$tucity', area_pin_code='$tupincode', geo_location='$tugeo', user_remarks=concat('$kyc_remarks', user_remarks) where user_id='$tuid';";
	$result4=mysql_query($query4a);
}

header("location:kyc-show.php?kycuid=$tuid");

?>