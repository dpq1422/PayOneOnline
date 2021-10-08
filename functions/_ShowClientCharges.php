<?php
function show_client_charges($client_id,$charges_in_id,$service_type_id,$operator_id)
{
	$query111="SELECT commission,surcharges from parent_charges_out where client_id='$client_id' and charges_in_id='$charges_in_id' and service_type_id='$service_type_id' and operator_id='$operator_id';";
	$result111=mysql_query($query111);
	$commission="0";
	$surcharges="0";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$commission=$r111['commission'];
		$surcharges=$r111['surcharges'];
	}
	return $commission."@#@".$surcharges;
}
?>