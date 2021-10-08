<?php
function show_client_services($client_id)
{
	$query111="SELECT service_types from parent_client where client_id='$client_id';";
	$result111=mysql_query($query111);
	$service_types="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$service_types=$r111['service_types'];
	}
	return $service_types;
}
?>