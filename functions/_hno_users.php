<?php
include('../_common-admin.php');
function show_hno_users($hno)
{
	$query1="SELECT count(*) as users FROM child_user where user_type='$hno'";
	$result1=mysql_query($query1);
	$hno_users="";
	while($r1 = mysql_fetch_array($result1)) 
	{
		$hno_users=$r1['users'];
	}
	return $hno_users;
}

?>