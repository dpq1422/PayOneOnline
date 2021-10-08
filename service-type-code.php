<?php
include('_common.php');
include('_session.php');

$filled_name=$_POST['filled_name'];
$filled_status=$_POST['filled_status'];

$query11="insert into all_service_type(service_type_name,service_type_status,service_remarks) value 
('$filled_name','$filled_status','created by $user_types ($user_id - $user_name) at $datetime_time');";
$result11=mysql_query($query11);


if($result11>0)
header("location:service-types.php");
else
header("location:service-type.php?msg=fail");


?>