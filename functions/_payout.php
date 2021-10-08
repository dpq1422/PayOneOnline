<?php
function payout($user_id)
{
	$query="SELECT date(date_time) dt,sum(cr) cr,sum(dr) dr FROM main_commission_paid where user_id='$user_id' group by date(date_time) order by date(date_time)";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);	
	if($num_rows>0)
	{
		$bal=0;
		$query2="delete FROM main_commission_paid_group where user_id='$user_id';";
		$result2=mysql_query($query2);
		while($rs = mysql_fetch_array($result))
		{
			$dt=$rs['dt'];
			$cr=$rs['cr'];
			$dr=$rs['dr'];
			$bal=$bal+$cr-$dr;
			$query3="insert into main_commission_paid_group(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
			$result3=mysql_query($query3);
		}
	}
}
function payouts($user_id)
{
	$query="SELECT wallet_date dt,sum(amount_cr) cr,sum(amount_dr) dr FROM child_wallet_remain WHERE user_id='$user_id' GROUP BY wallet_date ORDER BY wallet_date";
	$result=mysql_query($query);
	$num_rows = mysql_num_rows($result);	
	if($num_rows>0)
	{
		$bal=0;
		$query2="delete FROM main_commission_paid_group where user_id='$user_id';";
		$result2=mysql_query($query2);
		while($rs = mysql_fetch_array($result))
		{
			$dt=$rs['dt'];
			$cr=$rs['cr'];
			$dr=$rs['dr'];
			$bal=$bal+$cr-$dr;
			$query3="insert into main_commission_paid_group(date_time,user_id,cr,dr,bal) value('$dt','$user_id','$cr','$dr','$bal');";
			$result3=mysql_query($query3);
		}
	}
}
?>