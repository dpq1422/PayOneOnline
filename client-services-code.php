<?php
include('_common.php');
include('_session.php');

$filled_id=$_POST['filled_id'];
$filled_services=implode(",", $_POST['filled_services']);

$query24="update parent_client set service_types='$filled_services', client_remarks='updated by $user_types ($user_id - $user_name) at $datetime_time' where client_id='$filled_id';";
$result24=mysql_query($query24);

if($result24>0)
header("location:clients.php");
else
header("location:client-services.php?id=$client_id&msg=fail");


?>