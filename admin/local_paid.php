<?php
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);


header( 'Content-type: text/html; charset=utf-8' );
include_once('../_gyan-info-trans.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

/***** PART A = update comm paid details *****/
echo $statement="<br><br><b>*** PROCESS :: update comm paid details ***</b>";

$qry1="SELECT user_id,etid,count(*) num FROM main_commission_paid group by user_id,etid having count(*)>1 order by count(*) desc limit 0,10;";
$res1=mysql_query($qry1);
while($rs1=mysql_fetch_assoc($res1))
{
	$etid=0;
	$etid=$rs1['etid'];
	$user_id=$rs1['user_id'];
	$num=$rs1['num'];
	
	if($num>1)
	{
		$pid=0;
		echo "<br><br>$num Repeated Comm to Paid for order id: $etid";
		$qry2="SELECT min(paid_id) pid FROM main_commission_paid WHERE user_id =$user_id AND etid=$etid;";
		$res2=mysql_query($qry2);
		while($rs2=mysql_fetch_assoc($res2))
		{
			echo " ".$pid=$rs2['pid'];
			$qry3="delete FROM main_commission_paid WHERE user_id=$user_id AND etid=$etid and paid_id!=$pid;";
			$res3=mysql_query($qry3);
		}
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