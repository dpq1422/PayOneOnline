<?php
include('../_common-admin.php');
function show_distt($distt_id)
{
	//$limit_start=$_POST['limit_start'];
	//include('_paging-limit.php');	
	//$limit_start=$limit_start*$limit_end;
	
	$query="SELECT distt_name FROM all_state_distt where distt_id='$distt_id'";
	$result=mysql_query($query);	
	$distt_name = "";
	while($r = mysql_fetch_array($result)) {
		$distt_name = $r['distt_name'];
	}
	echo $distt_name;
}
function show_distt_display($distt_id)
{
	//$limit_start=$_POST['limit_start'];
	//include('_paging-limit.php');	
	//$limit_start=$limit_start*$limit_end;
	
	$query="SELECT distt_name FROM all_state_distt where distt_id='$distt_id'";
	$result=mysql_query($query);	
	$distt_name = "";
	while($r = mysql_fetch_assoc($result)) {
		$distt_name = $r['distt_name'];
	}
	return $distt_name;
}

?>