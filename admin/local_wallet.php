<?php
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);


header( 'Content-type: text/html; charset=utf-8' );
include_once('../_gyan-info-trans.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

/***** PART A = update admin user wallet *****/
echo $statement="<br><br><b>*** PROCESS :: update admin user wallet ***</b>";

$qry1="SELECT request_id, count(*) num FROM child_wallet_remain WHERE user_id =100000 AND request_id!=0 GROUP BY request_id order by count(*) desc limit 0,10;";
$res1=mysql_query($qry1);
while($rs1=mysql_fetch_assoc($res1))
{
	$etid=0;
	$etid=$rs1['request_id'];
	$num=$rs1['num'];
	
	if($num>1)
	{
		$wall_id=0;
		echo "<br><br>$num Repeated Comm to Admin for order id: $etid";
		$qry2="SELECT min(wallet_id) wall_id FROM child_wallet_remain WHERE user_id =100000 AND request_id=$etid;";
		$res2=mysql_query($qry2);
		while($rs2=mysql_fetch_assoc($res2))
		{
			$qry3="delete FROM child_wallet_remain WHERE user_id=100000 AND request_id=$etid and wallet_id!=$wall_id;";
			$res3=mysql_query($qry3);		
		}	
		update_wallet(100000);	
	}
	else
	{
		continue;
	}
	flush();
	ob_flush();
}

echo "<meta http-equiv='refresh' content='1'>";
?>