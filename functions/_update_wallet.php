<?php
include_once('../_common-admin.php');
function update_wallet($uid)
{
	$query2="SELECT * FROM child_wallet_remain where user_id='$uid' order by wallet_id desc limit 0,1;";
	$result2=mysql_query($query2);
	$wallet_amount_bal=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$wallet_amount_bal=$rs2['amount_bal'];
	}
	
	$qry_s="update child_user set wallet_balance=$wallet_amount_bal where user_id=$uid;";
	mysql_query($qry_s);
}

?>