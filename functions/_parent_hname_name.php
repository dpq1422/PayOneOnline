<?php
include('../_common-admin.php');
function show_parent_hname_name($user_id)
{
	$query1="SELECT * FROM child_user where user_id='$user_id'";
	$result1=mysql_query($query1);
	$sel_parent_no="";
	$sel_parent_id="";
	$sel_parent_hname="";
	$sel_parent_name="";
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
	$query2="SELECT * FROM child_hierarchy where hierarchy_id='$sel_parent_no' and status=1";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$sel_parent_hname=$r2['hierarchy_name'];
	}
	$query3="SELECT * FROM child_user where user_id='$sel_parent_id'";
	$result3=mysql_query($query3);
	while($r3 = mysql_fetch_array($result3)) 
	{
		$sel_parent_name=$r3['user_name'];
	}
	return $sel_parent_name.'<br>('.$sel_parent_hname.')';
}
function show_parent_hname_name2($user_id)
{
	$query1="SELECT * FROM child_user where user_id='$user_id'";
	$result1=mysql_query($query1);
	$sel_parent_no="";
	$sel_parent_id="";
	$sel_parent_hname="";
	$sel_parent_name="";
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
	$query2="SELECT * FROM child_hierarchy where hierarchy_id='$sel_parent_no' and status=1";
	$result2=mysql_query($query2);
	while($r2 = mysql_fetch_array($result2)) 
	{
		$sel_parent_hname=$r2['hierarchy_name'];
	}
	$query3="SELECT * FROM child_user where user_id='$sel_parent_id'";
	$result3=mysql_query($query3);
	while($r3 = mysql_fetch_array($result3)) 
	{
		$sel_parent_name=$r3['user_name'];
	}
	return $sel_parent_name.'</td><td>'.$sel_parent_hname;
}
?>