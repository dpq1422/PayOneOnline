<?php
include('../_session-admin.php');

$hierarchyid=$_REQUEST['hierarchyid'];

$query4a="delete from child_hierarchy where hierarchy_id='$hierarchyid';";
$result4=mysql_query($query4a);


if($result4==1)
header("location:hierarchys.php");
else
header("location:hierarchys.php?msg=hierarchy-delete-fail");

?>