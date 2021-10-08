<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');

$clientid=1001;
$clientdb="bankatyf_child1_1001";
$qry_insert="insert into bankatyf_child1_1001_txn.extra_charges select txn_id, user_id, sum( charges ) chargess, sum(com_charged) charged, sum(charges)-sum(com_charged) difference, 0
from bankatyf_child1_1001_txn.txn_mt_child where source=1 and type=1 and order_id>68000 and txn_id not in(select txn_id from bankatyf_child1_1001_txn.extra_charges) group by txn_id having chargess > charged; ";
mysql_query($qry_insert);

$qry_read="SELECT * FROM bankatyf_child1_1001_txn.extra_charges where deducted=0 order by txn_id;";
$result_read=mysql_query($qry_read);
while($rs_read=mysql_fetch_array($result_read))
{
	$txn_id=$rs_read['txn_id'];
	$user_id=$rs_read['user_id'];
	$charges=$rs_read['charges'];
	$charged=$rs_read['charged'];
	$diff=$rs_read['difference'];
	if($diff>0)
	{
		$service=101;
		client_user_balance_deduct($clientdb, $user_id, $diff, $service, $txn_id, $txn_id, "Remain Txn Charges Deducted for Txn Id $txn_id, charges:$charges, charged:$charged, diff deducted:$diff");
		mysql_query("update bankatyf_child1_1001_txn.extra_charges set deducted=1 where txn_id='$txn_id';");
		$qry_read2="SELECT * FROM bankatyf_child1_1001_txn.txn_mt_child_margin WHERE txn_id='$txn_id'";
		$result_read2=mysql_query($qry_read2);
		$num_rows = mysql_num_rows($result_read2);
		$x=0;
		$diff2=$diff/$num_rows;
		while($rs_read2=mysql_fetch_array($result_read2))
		{
			
			$order_id=$rs_read2['order_id'];
			mysql_query("delete from bankatyf_child1_1001_txn.com_paid_child where order_id='$order_id' and source=1 and type=1;");
			mysql_query("delete FROM bankatyf_child1_1001_wallet.distribution WHERE user_id BETWEEN 90000 AND 90010 AND order_id='$order_id';");
			mysql_query("update bankatyf_child1_1001_txn.txn_mt_child_margin set lvl_12_chgd=(lvl_12_chgd+$diff2) where order_id='$order_id';");
		}
		echo "txnid:$txn_id, cid:$clientid, uid $user_id, charges:$charges, charged:$charged, difference deducted:$diff<br>";
		echo str_pad('', 16384);
	
		flush();
		ob_flush();
		usleep(1000000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
	}
}
?>