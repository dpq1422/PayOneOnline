<?php
function show_client_name($client_id)
{
	$query111="SELECT client_name from parent_client where client_id='$client_id';";
	$result111=mysql_query($query111);
	$client_name="";
	while($r111 = mysql_fetch_assoc($result111)) 
	{
		$client_name=$r111['client_name'];
	}
	return $client_name;
}
?>