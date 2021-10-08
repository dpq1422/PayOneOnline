<?php
function show_admin_bank($bank_id)
{
	$query111="SELECT * from parent_bank where bank_id='$bank_id';";
	$result111=mysql_query($query111);
	$bank_name="";
	while($r111 = mysql_fetch_array($result111)) 
	{
		$bank_name=$r111['bank_name']." - ".$r111['account_no'];
	}
	return $bank_name;
}
?>