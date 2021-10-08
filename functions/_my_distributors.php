<?php
include('../_common-admin.php');
function show_my_distributors($user_id)
{
	$query1="SELECT count(*) as users FROM child_user where user_type not in(1,0,11) and (hierarchy_2_id='$user_id' or hierarchy_3_id='$user_id' or hierarchy_4_id='$user_id' or hierarchy_5_id='$user_id' or hierarchy_6_id='$user_id' or hierarchy_7_id='$user_id' or hierarchy_8_id='$user_id' or hierarchy_9_id='$user_id' or hierarchy_10_id='$user_id') and user_status in(1,2)";
	$result1=mysql_query($query1);
	$my_distributors="";
	while($r1 = mysql_fetch_array($result1)) 
	{
		$my_distributors=$r1['users'];
	}
	return $my_distributors;
}

?>