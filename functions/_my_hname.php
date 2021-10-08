<?php
include('../_common-admin.php');
function show_my_hname($hid)
{
	$query2="SELECT hierarchy_name FROM child_hierarchy where hierarchy_id='$hid' and status=1";
	$result2=mysql_query($query2);
	$userdesignation="";
	while($rs2 = mysql_fetch_array($result2)) {
		$userdesignation=$rs2['hierarchy_name'];
	}
	return $userdesignation;
}

?>