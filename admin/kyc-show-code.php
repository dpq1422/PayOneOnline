<?php
include('../_session-admin.php');

$kyc_status=$_POST['a1'];
$kyc_uid=$_POST['a2'];
$kyc_remarks=$_POST['a3']." updated by $user_types ($user_id - $user_name)<br>";
if(isset($_POST['a4']))
{
	$query4a="update child_user set kyc_status='$kyc_status', user_remarks=concat('$kyc_remarks', user_remarks) where user_id='$kyc_uid';";
	$result4=mysql_query($query4a);
}

header("location:kyc-status.php");

?>