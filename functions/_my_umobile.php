<?php
include_once('../_common-admin.php');
function show_my_umobile($uid)
{
	$query2="SELECT user_contact_no FROM child_user where user_id='$uid'";
	$result2=mysql_query($query2);
	$user_namess="";
	while($rs2 = mysql_fetch_array($result2)) {
		$user_namess=$rs2['user_contact_no'];
	}
	return $user_namess;
}

?>