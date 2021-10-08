<?php
include('../_common-admin.php');
function show_my_uname($uid)
{
	$query2="SELECT user_name FROM child_user where user_id='$uid'";
	$result2=mysql_query($query2);
	$user_namess="";
	while($rs2 = mysql_fetch_array($result2)) {
		$user_namess=$rs2['user_name'];
	}
	return $user_namess;
}

?>