<?php
function show_admin_bank_client($client_id,$bank_id)
{
	$bank_name="";
	if($client_id==1001)
	{
		$query111="SELECT * from child_bank where bank_id='$bank_id';";
		$result111=mysql_query($query111);
		while($r111 = mysql_fetch_array($result111)) 
		{
			$bank_name=$r111['bank_name']." - ".$r111['account_no'];
		}
	}
	return $bank_name;
}
?>