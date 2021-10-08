<?php
include('../_session-admin.php');
$HierarchyName=$_POST['HierarchyName'];
$usertp=$_POST['usertp'];
$query="SELECT hierarchy_id,hierarchy_name FROM child_hierarchy where hierarchy_id!=0 and hierarchy_id<'$HierarchyName' and hierarchy_id>=$usertp and status=1 order by hierarchy_id";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="Parent Hierarchy <b style='color:red'>*</b><br><select name='ParentHierarchyName' id='ParentHierarchyName' required onchange='ShowParentByHierarchy()'>";
$res=$res."<option value=''>Select Parent Heirarchy</option>";
$rows = array();
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option value='".$r['hierarchy_id']."'>".$r['hierarchy_name']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>