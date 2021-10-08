<?php
include('_common.php');
include('_session.php');

$filled_service_type=$_POST['filled_service_type'];
$filled_service_name=$_POST['filled_service_name'];

$query14="insert into all_operator(service_type_id,operator_name,operator_status,
operator_remarks) value 
('$filled_service_type','$filled_service_name',1,'created by $user_types ($user_id - $user_name) at $datetime_time');";
$result14=mysql_query($query14);

if($result14>0)
header("location:service-operators.php");
else
header("location:service-operator.php?msg=fail");


?>