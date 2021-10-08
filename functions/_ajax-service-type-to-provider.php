<?php
include('../_common.php');
$result="";
$result.= "<select id='spro' name='filled_provider_name' required>";
$result.= "	<option></option>";
$stype=$_REQUEST['stype'];
if(isset($stype))
{
	$query19="select * from all_operator where service_type_id='$stype' and operator_status=1 order by operator_name;";
	$result19=mysql_query($query19);
	while($row19=mysql_fetch_array($result19))
	{
		$result.= "<option value='".$row19['operator_id']."'>";
		$result.= $row19['operator_name'];
		$result.= "</option>";
	}
}
$result.= "</select>";
echo $result;
?>