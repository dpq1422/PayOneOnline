<?php
//include('../_common-admin.php');
function wallet_balance($uid)
{
	$query2="SELECT * FROM child_wallet_remain where user_id='$uid' order by wallet_id desc limit 0,1;";
	$result2=mysql_query($query2);
	$wallet_amount_bal=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$wallet_amount_bal=$rs2['amount_bal'];
	}
	
	return $wallet_amount_bal;
}

function admin_wallet_balance()
{
	$query2="SELECT * FROM child_wallet_realtime order by wallet_id desc limit 0,1;";
	$result2=mysql_query($query2);
	$wallet_amount_bal=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$wallet_amount_bal=$rs2['amount_bal'];
	}
	return $wallet_amount_bal;
}

function admin_wallet_balance2()
{
	$query2="SELECT * FROM child_wallet_realtime order by wallet_id desc limit 0,1;";
	$result2=mysql_query($query2);
	$wallet_amount_bal=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$wallet_amount_bal=$rs2['amount_bal'];
	}
	return $wallet_amount_bal;
}

function user_wallet_balance($uid)
{
	$query2="SELECT * FROM child_user where user_id='$uid';";
	$result2=mysql_query($query2);
	$wallet_amount_bal=0;
	while($rs2 = mysql_fetch_array($result2)) {
		$wallet_amount_bal=$rs2['wallet_balance'];
	}
	
	return $wallet_amount_bal;
}

?>