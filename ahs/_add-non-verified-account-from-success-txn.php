<?php
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');
//bankatyf_child1_1001_txn
//bankatyf_common
$from=0;
if(isset($_REQUEST['from']))
	$from=$_REQUEST['from'];

$qry1="SELECT * FROM bankatyf_child1_1001_txn.txn_mt_child where type=1 and order_status=2 and order_id>$from and racc!=0 order by order_id limit 0,500;";
$result1=mysql_query($qry1);
while($rs1 = mysql_fetch_array($result1))
{
	$from=$rs1['order_id'];
	$rname=$rs1['rname'];
	$rbname=$rs1['rbname'];
	$racc=$rs1['racc'];
	$rifsc=$rs1['rifsc'];
	$qry2="SELECT receiver_acc_no FROM bankatyf_common.eko_receiver_verified where receiver_acc_no='$racc';";
	$result2=mysql_query($qry2);
	$j=0;
	while($rs2 = mysql_fetch_array($result2))
	{
		$j++;
		break;
	}
	if($j==0)
	{
		$bank=$rbname;
		$ifsc=$rifsc;
		$receiver_acc_no=$racc;
		$receiver_name=$rname;
		$updated_on=$datetime_datetime;
		$source=0;
		mysql_query("insert into bankatyf_common.eko_receiver_verified values(NULL,0,0,'$bank','$ifsc','$receiver_acc_no','$receiver_name',0,'$updated_on','$source');");
		if(mysql_affected_rows()>0)
		{
			echo "i:$from, bank:$bank, ifsc:$ifsc, acc:$receiver_acc_no, name:$receiver_name<br>";
			echo str_pad('',16384);
		}
	}
}
echo "<script>window.location = '?from=$from';</script>";
?>