<?php
include('../_session-admin.php');
$StateName=$_POST['StateName'];
$query="SELECT distt_id,distt_name FROM all_state_distt where state_id='$StateName' order by distt_name";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
$res="Distt. <b style='color:red'>*</b><br><select name='DisttName' required id='DisttName'>";
$res=$res."<option value=''>Select Distt.</option>";
$rows = array();
if($num_rows>0)
{
	while($r = mysql_fetch_array($result)) {
		$res=$res."<option value='".$r['distt_id']."'>".$r['distt_name']."</option>";
	}
}
$res=$res."</select>";
echo json_encode($res);
?>