<?php
function show_state_name($state_id)
{
	$query111="SELECT state_name from all_state where state_id='$state_id';";
	$result111=mysql_query($query111);
	$state_name="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$state_name=$r111['state_name'];
	}
	return $state_name;
}
?>