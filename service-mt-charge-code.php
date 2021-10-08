<?php
include('_common.php');
include('_session.php');

$filled_source_name=$_POST['filled_source_name'];
$filled_service_name=$_POST['filled_service_name'];
$filled_provider_name=$_POST['filled_provider_name'];
$filled_ctype=$_POST['filled_ctype'];
$filled_from=$_POST['filled_from'];
$filled_to=$_POST['filled_to'];
$filled_flat=$_POST['filled_flat'];
$filled_percent=$_POST['filled_percent'];
$filled_charge_status=$_POST['filled_charge_status'];

$query18="insert into parent_charges_in_mt(source_id,service_type_id,operator_id,charges_type,slab_from,slab_to, surcharges_fix,surcharges_percent,charges_status,charges_remarks) value 
('$filled_source_name','$filled_service_name','$filled_provider_name','$filled_ctype',
'$filled_from','$filled_to','$filled_flat','$filled_percent','$filled_charge_status',
'created by $user_types ($user_id - $user_name) at $datetime_time');";
$result18=mysql_query($query18);

if($result18>0)
header("location:service-mt-charges.php");
else
header("location:service-mt-charge.php?msg=fail");


?>