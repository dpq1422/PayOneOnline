<?php
include('../_session-admin.php');

$HierarchyName=$_POST['HierarchyName'];
$TeamShare=$_POST['TeamShare'];

$query4a="INSERT INTO child_hierarchy(hierarchy_name,share_in_per) VALUES ('$HierarchyName','$TeamShare');";
$result4=mysql_query($query4a);


if($result4==1)
header("location:hierarchys.php");
else
header("location:hierarchy.php?msg=add-hierarchy-fail");

?>