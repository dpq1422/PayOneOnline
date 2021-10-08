<?php
include('../_common-admin.php');
function show_parent_no_id($user_id)
{
	$query1="SELECT * FROM child_user where user_id='$user_id'";
	$result1=mysql_query($query1);
	$sel_parent_no="";
	$sel_parent_id="";
	while($r1 = mysql_fetch_array($result1)) 
	{
		$sel_user_type=$r1['user_type'];
		for($cd=10;$cd>=1;$cd--)
		{
			$field_no="hierarchy_".$cd."_no";
			$field_id="hierarchy_".$cd."_id";
			if($r1[''."$field_no".'']!=0)
			{
				$sel_parent_no=$r1[''."$field_no".''];
				$sel_parent_id=$r1[''."$field_id".''];
				break;
			}
		}
	}
	return $sel_parent_no.'@'.$sel_parent_id;
}

?>