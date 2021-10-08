<?php
include('../_session-admin.php');

$userid=$_REQUEST['userid'];

$query4a="update child_user set invalid_attempt=0,user_status=1 where user_id='$userid';";
$result4=mysql_query($query4a);


if($result4==1)
header("location:distributors.php");
else
header("location:distributors.php?msg=distributor-active-fail");

?>