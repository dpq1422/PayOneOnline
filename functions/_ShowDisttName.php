<?php
function show_distt_name($distt_id)
{
	$query111="SELECT distt_name from all_state_distt where distt_id='$distt_id';";
	$result111=mysql_query($query111);
	$distt_name="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$distt_name=$r111['distt_name'];
	}
	return $distt_name;
}
?>