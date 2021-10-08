<?php
include('../_session-admin.php');

$HierarchyId=$_POST['HierarchyId'];
$HierarchyName=$_POST['HierarchyName'];
$TeamShare=$_POST['TeamShare'];

if($HierarchyId>1 && $HierarchyId<6)
{
	$query4a="update child_hierarchy set hierarchy_name='$HierarchyName', share_in_per='$TeamShare' where hierarchy_id='$HierarchyId' and status=1;";
	$result4=mysql_query($query4a);


	if($result4==1)
	header("location:hierarchys.php");
	else
	header("location:hierarchy-modify.php?msg=modify-hierarchy-fail");
}
else
{
	header("location:hierarchys.php");
}

?>