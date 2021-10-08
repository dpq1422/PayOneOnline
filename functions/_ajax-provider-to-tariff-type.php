<?php
include('../_common.php');
echo $result="";
$result.= "<select id='tartp' name='filled_tariff_type' required>";
$result.= "	<option></option>";
$spro=$_REQUEST['spro'];
$stname=$_REQUEST['stname'];
if(isset($spro))
{
	$query19="select * from all_prepaid_tariff_type where operator_id='$spro' and state_id='$stname' order by tariff_type_name;";	
	$result19=mysql_query($query19);
	while($row19=mysql_fetch_array($result19))
	{
		$result.= "<option value='".$row19['tariff_type_id']."'>";
		$result.= $row19['tariff_type_name'];
		$result.= "</option>";
	}
}
$result.= "</select>";
echo $result;
?>