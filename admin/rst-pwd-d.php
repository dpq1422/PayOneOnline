<?php
include('../_session-admin.php');

$ruid=$_REQUEST['ruid'];

$query4a="UPDATE child_user SET pass_word = MD5( 'pay@123' ) , invalid_attempt = '0', past_change_on='2017-11-01 10:15:45' WHERE user_id = '$ruid';";
$result4=mysql_query($query4a);

header("location:distributors.php");

?>