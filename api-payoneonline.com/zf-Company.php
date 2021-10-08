<?php
function show_ip_info($company_id)
{
	require('zc-gyan-info-admin.php');
	$ip="0.0.0.0";
	$query="select * from $bankapi_parent_base.all_mp_ip where id='$company_id'";
	$result=mysql_query($query);
	while($rs=mysql_fetch_array($result))
	{
		$ip=$rs['ip'];
	}
	return $ip;
}
?>