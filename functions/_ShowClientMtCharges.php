<?php
function show_client_mt_charges($client_id,$charges_in_id,$service_type_id,$operator_id,$slab_from,$slab_to)
{
	$query222="SELECT surcharges_fix,surcharges_percent from parent_charges_out_mt where client_id='$client_id' and charges_in_id='$charges_in_id' and service_type_id='$service_type_id' and operator_id='$operator_id' and slab_from='$slab_from' and slab_to='$slab_to';";
	$result222=mysql_query($query222);
	$surcharges_fix="0";
	$surcharges_percent="0";
	while($r222 = mysql_fetch_assoc($result222)) 
	{
		$surcharges_fix=$r222['surcharges_fix'];
		$surcharges_percent=$r222['surcharges_percent'];
	}
	return $surcharges_fix."@#@".$surcharges_percent;
}
?>