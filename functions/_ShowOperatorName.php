<?php
function show_operator_name($operator_id)
{
	$query111="SELECT operator_name from all_operator where operator_id='$operator_id';";
	$result111=mysql_query($query111);
	$operator_name="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$operator_name=$r111['operator_name'];
	}
	return $operator_name;
}
?>