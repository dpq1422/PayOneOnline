<?php
function count_state_client($state_id)
{
	$query111="select count(*) as state_num from parent_client where state_id='$state_id';";
	$result111=mysql_query($query111);
	$state_num="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$state_num=$r111['state_num'];
	}
	return $state_num;
}
?>