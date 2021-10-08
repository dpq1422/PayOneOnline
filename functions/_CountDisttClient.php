<?php
function count_distt_client($distt_id)
{
	$query111="select count(*) as distt_num from parent_client where distt_id='$distt_id';";
	$result111=mysql_query($query111);
	$distt_num="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$distt_num=$r111['distt_num'];
	}
	return $distt_num;
}
?>