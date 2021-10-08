<?php
function show_service_type_name($service_type_id)
{
	$query111="SELECT service_type_name from all_service_type where service_type_id='$service_type_id';";
	$result111=mysql_query($query111);
	$service_type_name="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$service_type_name=$r111['service_type_name'];
	}
	return $service_type_name;
}
?>