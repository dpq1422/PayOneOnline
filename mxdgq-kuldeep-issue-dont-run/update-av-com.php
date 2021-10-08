<html>
<head>
<title>Updating records</title>
<style> 
*{font-family: "Courier New", Courier, monospace;text-align:right!important;} h4{font-size:18px;}
.blinking{
    animation:blinkingText 1s infinite;
}
@keyframes blinkingText{
    0%{     color: #4CAF50;    }
    10%{     color: #4CAF50;    }
    49%{    color: #4CAF50; }
    50%{    color: #4CAF50; }
    75%{    color:transparent;  }
    100%{   color: #4CAF50;    }
}
</style>
<script>
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
function waitSeconds(iMilliSeconds) {
    var counter= 0
        , start = new Date().getTime()
        , end = 0;
    while (counter < iMilliSeconds) {
        end = new Date().getTime();
        counter = end - start;
    }
}
</script>
</head>
<body>
<?php
//header("Content-type: text/html; charset=utf-8");

include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');
echo "<h4 style='color:#4CAF50;'>Checking AV-1 TIDs to update</h4>";

$min_record=0;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=1 and type=2 order by mmt_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$qry_av_com="SELECT * FROM $bankapi_parent_txn.txn_mt where source=1 and type=2 and mmt_status='2' and mmt_id>74500 order by mmt_id asc;";
$res_av_com=mysql_query($qry_av_com);
while($rs_av_com=mysql_fetch_array($res_av_com))
{
	$service=101;
	$operator=1002;
	$mmt_id=$rs_av_com['mmt_id'];
	$clientid=$rs_av_com['client_id'];
	$order=$rs_av_com['order_id'];
	$datetimes=$rs_av_com['created_on'];
	$txn_status=$txnst=$rs_av_com['mmt_status'];
	$source=$rs_av_com['source'];
	$type=$rs_av_com['type'];
	$tid=$rs_av_com['tid'];
	$method=$rs_av_com['method'];
	$uids=$rs_av_com['user_id'];
	$clienttype=show_client_type_id($clientid);
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	
	$mmt_paid=0;
	$mmt_paid=check_mmt_paid($mmt_id, $source, $type);
	$order_paid=0;
	$order_paid=check_order_paid($bankapi_child_txn, $order, $source, $type);
	
	$admin_rate=0;
	$client_rate=0;
	$retailer_rate=5;
	if($order_paid==0 || $mmt_paid==0)
	{
		$admin_qry="SELECT * FROM $bankapi_parent_base.charges_in_source WHERE source_id='$source' and service_id='$service' and operator_id='$operator';";
		$admin_r=mysql_query($admin_qry);
		while($admin_res=mysql_fetch_array($admin_r))
		{
			$admin_rate=$admin_res['surcharges_fix'];
		}
		$client_qry="SELECT * FROM $bankapi_parent_base.charges_out_service WHERE client_id='$clientid' and service_id='$service' and operator_id='$operator';";
		$client_r=mysql_query($client_qry);
		while($client_res=mysql_fetch_array($client_r))
		{
			$client_rate=$client_res['surcharges_fix'];
		}
	
		if($order_paid==0 && ($clienttype==1 || $clienttype==2))
		{
			$client_earning=$retailer_rate-$client_rate;
			$clientdb="$bankapi_child".$clienttype."_".$clientid;
			$client_com_gen_qry="INSERT INTO $bankapi_child_txn.com_generated(order_id, tid, source, type, method, date_time, user_id, amount, charged, retailer_gst, retailer_com, admin_gst, admin_fee, lvl_1_id, lvl_1_com, lvl_1_tds, lvl_1_earn) value ('$order', '$tid', '$source', '$type', '$method', '$datetimes', '$uids', '$retailer_rate', '0', '0', '0', '0', '$client_rate', '100001', '$client_earning', '0', '$client_earning')";
			mysql_query($client_com_gen_qry);
			
			$details="Earnings from order no: $order of user id: $uids at $datetimes";
			$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '100001', '$source', '$type', '$method', '$datetimes', '$details', '$client_earning', '0');";
			if($client_earning!=0)
			mysql_query($client_com_paid_qry);
			
			client_user_balance_cr($clientdb, $wallet_transact, $client_earning, $service, $order, $mmt_id, $details);
			client_user_balance_dr($clientdb, $wallet_transact, $client_earning, $service, $order, $mmt_id, $details);
			client_user_balance_cr($clientdb, $wallet_admininc, $client_earning, $service, $order, $mmt_id, $details);
		}
		if($mmt_paid==0)
		{	
			$admin_earning=$client_rate-$admin_rate;
			$details="Earning from order $mmt_id, client $clientid, user $uids, source $source, service $service, operator $operator on date $datetimes";
			$admin_com_gen_qry="INSERT INTO $bankapi_parent_txn.com_paid_child(order_id, client_id, user_id, source, type, method, date_time, details, cr, dr) value ('$mmt_id', '$clientid', '$uids', '$source', '$type', '$method', '$datetimes', '$details', '$admin_earning', '0')";
			//if($admin_earning!=0)
			mysql_query($admin_com_gen_qry);
			if($tid==-1)
			{
				$admin_earning=$client_rate;
				$details="Earning from order $mmt_id, client $clientid, user $uids, source $source, service $service, operator $operator on date $datetimes";
				$admin_com_gen_qry="INSERT INTO $bankapi_parent_txn.com_paid_child(order_id, client_id, user_id, source, type, method, date_time, details, cr, dr) value ('$mmt_id', '$clientid', '$uids', '$source', '$type', '$method', '$datetimes', '$details', '$admin_earning', '0')";
				//if($admin_earning!=0)
				mysql_query($admin_com_gen_qry);
			}
		}
		
		echo "mid:$mmt_id, cid:$clientid, uid:$uids, order:$order, tid:$tid, status:$txn_status, dt:$datetimes<br>";
		echo str_pad('',16384);
		
		flush();
		ob_flush();
		usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
	}
}
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<br><br><h4 class='blinking'>Please wait while re-updating...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(2000000);
echo "<script>window.close();openInNewTab('update-av-refund-failed.php');</script>";
?>
<!--<meta http-equiv='refresh' content='10'>-->
</body>
</html>