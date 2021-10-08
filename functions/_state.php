<?php
include('../_common-admin.php');
function show_state($state_id)
{
	//$limit_start=$_POST['limit_start'];
	//include('_paging-limit.php');	
	//$limit_start=$limit_start*$limit_end;
	
	$query="SELECT state_name FROM all_state where state_id='$state_id'";
	$result=mysql_query($query);
	$state_name = "";
	while($r = mysql_fetch_array($result)) {
		$state_name = $r['state_name'];
	}
	echo $state_name;
}
function show_state_display($state_id)
{
	//$limit_start=$_POST['limit_start'];
	//include('_paging-limit.php');	
	//$limit_start=$limit_start*$limit_end;
	
	$query="SELECT state_name FROM all_state where state_id='$state_id'";
	$result=mysql_query($query);
	$state_name = "";
	while($r = mysql_fetch_array($result)) {
		$state_name = $r['state_name'];
	}
	return $state_name;
}
?>