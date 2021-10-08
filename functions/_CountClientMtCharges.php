<?php
function count_client_mt_charges($client_id,$charges_in_id,$service_type_id,$operator_id,$slab_from,$slab_to)
{
	$query111="SELECT surcharges_fix,surcharges_percent from parent_charges_out_mt where client_id='$client_id' and charges_in_id='$charges_in_id' and service_type_id='$service_type_id' and operator_id='$operator_id' and slab_from='$slab_from' and slab_to='$slab_to';";
	$result111=mysql_query($query111);
	$res_count=0;
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$res_count++;
	}
	return $res_count;
}
?>