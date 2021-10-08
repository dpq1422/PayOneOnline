<?php
include('../_session-admin.php');
$ParentHierarchyName=$_POST['ParentHierarchyName'];
$query="SELECT user_id,user_name,user_contact_no FROM child_user where user_id not in (100000,100005) and user_type='$ParentHierarchyName' and user_status!=3 and user_type!=0 order by user_id";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="Parent Name <b style='color:red'>*</b><br><select name='ParentNameByHierarchy' required id='ParentNameByHierarchy'>";
$res=$res."<option value=''>Select Parent Name</option>";
$rows = array();
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option value='".$r['user_id']."'>".$r['user_name']." - ".$r['user_contact_no']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>