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
include_once('../zf-Operator.php');
echo "<h4 style='color:#ff9800;'>Checking RC-2 TIDs update</h4>";

$min_record=0;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status in(1,3) and source=2 and type in(3,4) order by mrc_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mrc_id'];
	$min_record=$min_record-1;
}

$qry_mt_com="SELECT * FROM $bankapi_parent_txn.txn_rc where source=2 and type in(3,4) and mrc_status='2' and mrc_id>=10001156 order by mrc_id;";
$res_mt_com=mysql_query($qry_mt_com);
while($rs_mt_com=mysql_fetch_array($res_mt_com))
{
	$service=0;
	$operator=0;
	$mmt_id=$rs_mt_com['mrc_id'];
	$clientid=$rs_mt_com['client_id'];
	$txn_amt=$rs_mt_com['amount'];///
	$order=$rs_mt_com['order_id'];///
	$source=$rs_mt_com['source'];///
	$type=$rs_mt_com['type'];///
	$tid=$rs_mt_com['tid'];///
	$method=0;///
	$datetimes=$rs_mt_com['created_on'];///
	$uids=$rs_mt_com['user_id'];///
	$operator=$rs_mt_com['operator'];///
	$operator=show_operator_id($operator,$source);
	if($type==3)
		$service=102;
	else if($type==4)
		$service=103;
	$clienttype=show_client_type_id($clientid);
	$bankapi_child_txn="$bankapi_child".$clienttype."_".$clientid."_txn";
	$clientdb="$bankapi_child".$clienttype."_".$clientid;
	
	$mmt_paid=0;
	$mmt_paid=check_mrc_paid($mmt_id, $source, $type);
	$order_paid=0;
	if($clienttype==1 || $clienttype==2)
	$order_paid=check_rc_paid($bankapi_child_txn, $order, $source, $type);
	if($order_paid==0 || $mmt_paid==0)
	{
		$admin_rate=0;
		$lvl_1_id=$lvl_2_id=$lvl_3_id=$lvl_4_id=$lvl_5_id=$lvl_6_id=0;
		$lvl_7_id=$lvl_8_id=$lvl_9_id=$lvl_10_id=$lvl_11_id=$lvl_12_id=0;///
		$lvl_1_rate=$lvl_2_rate=$lvl_3_rate=$lvl_4_rate=$lvl_5_rate=$lvl_6_rate=0;
		$lvl_7_rate=$lvl_8_rate=$lvl_9_rate=$lvl_10_rate=$lvl_11_rate=$lvl_12_rate=0;
		$lvl_1_com=$lvl_2_com=$lvl_3_com=$lvl_4_com=$lvl_5_com=$lvl_6_com=0;
		$lvl_7_com=$lvl_8_com=$lvl_9_com=$lvl_10_com=$lvl_11_com=$lvl_12_com=0;///
		$lvl_1_tds=$lvl_2_tds=$lvl_3_tds=$lvl_4_tds=$lvl_5_tds=$lvl_6_tds=0;
		$lvl_7_tds=$lvl_8_tds=$lvl_9_tds=$lvl_10_tds=$lvl_11_tds=$lvl_12_tds=0;///
		$lvl_1_earn=$lvl_2_earn=$lvl_3_earn=$lvl_4_earn=$lvl_5_earn=$lvl_6_earn=0;
		$lvl_7_earn=$lvl_8_earn=$lvl_9_earn=$lvl_10_earn=$lvl_11_earn=$lvl_12_earn=0;///
		$charged=$txn_amt;///
		$retailer_gst=0;///
		$retailer_com=0;///
		$admin_fee=0;///
		$admin_gst=0;///
		$total_gst=0;
		$client_rate=0;
	
		$admin_qry="SELECT * FROM $bankapi_parent_base.charges_in_source WHERE source_id='$source' and service_id='$service' and operator_id='$operator';";
		$admin_r=mysql_query($admin_qry);
		while($admin_res=mysql_fetch_array($admin_r))
		{
			$admin_rate=$admin_res['surcharges_percent'];
		}
		$client_qry="SELECT * FROM $bankapi_parent_base.charges_out_service WHERE mt_source_id='$source' and service_id='$service' and operator_id='$operator' and client_id='$clientid';";
		$client_r=mysql_query($client_qry);
		while($client_res=mysql_fetch_array($client_r))
		{
			$client_rate=$client_res['surcharges_percent'];
		}
		$clientdb2=$clientdb."_txn";
		
		if($clienttype==1 || $clienttype==2)
		{
			$client_qry="SELECT * FROM $clientdb2.txn_rc_margin WHERE rc_id='$order';";
			$client_r=mysql_query($client_qry);
			while($client_res=mysql_fetch_array($client_r))
			{
				mysql_query("update $clientdb2.txn_rc_margin set lvl_2_chg=0;");
				$lvl_1_id=$client_res['lvl_1_id'];
				$lvl_2_id=$client_res['lvl_2_id'];
				$lvl_3_id=$client_res['lvl_3_id'];
				$lvl_4_id=$client_res['lvl_4_id'];
				$lvl_5_id=$client_res['lvl_5_id'];
				$lvl_6_id=$client_res['lvl_6_id'];
				$lvl_7_id=$client_res['lvl_7_id'];
				$lvl_8_id=$client_res['lvl_8_id'];
				$lvl_9_id=$client_res['lvl_9_id'];
				$lvl_10_id=$client_res['lvl_10_id'];
				$lvl_11_id=$client_res['lvl_11_id'];
				$lvl_12_id=$client_res['lvl_12_id'];
				$lvl_1_rate=$client_res['lvl_1_chg'];
				$lvl_2_rate=$client_res['lvl_2_chg'];
				$lvl_3_rate=$client_res['lvl_3_chg'];
				$lvl_4_rate=$client_res['lvl_4_chg'];
				$lvl_5_rate=$client_res['lvl_5_chg'];
				$lvl_6_rate=$client_res['lvl_6_chg'];
				$lvl_7_rate=$client_res['lvl_7_chg'];
				$lvl_8_rate=$client_res['lvl_8_chg'];
				$lvl_9_rate=$client_res['lvl_9_chg'];
				$lvl_10_rate=$client_res['lvl_10_chg'];
				$lvl_11_rate=$client_res['lvl_11_chg'];
				$lvl_12_rate=$client_res['lvl_12_chg'];
				$lvl_2_rate=0;
			}
		}
		
		if($order_paid==0 && ($clienttype==1 || $clienttype==2))
		{
			$lvl_1_com=number_format((float)(($lvl_1_rate*$txn_amt)/100), 2, '.', '');
			$lvl_1_tds=0;
			$lvl_1_earn=$lvl_1_com;
			$lvl_2_com=0;
			$lvl_3_com=number_format((float)(($lvl_3_rate*$txn_amt)/100), 2, '.', '');
			$lvl_4_com=number_format((float)(($lvl_4_rate*$txn_amt)/100), 2, '.', '');
			$lvl_5_com=number_format((float)(($lvl_5_rate*$txn_amt)/100), 2, '.', '');
			$lvl_6_com=number_format((float)(($lvl_6_rate*$txn_amt)/100), 2, '.', '');
			$lvl_7_com=number_format((float)(($lvl_7_rate*$txn_amt)/100), 2, '.', '');
			$lvl_8_com=number_format((float)(($lvl_8_rate*$txn_amt)/100), 2, '.', '');
			$lvl_9_com=number_format((float)(($lvl_9_rate*$txn_amt)/100), 2, '.', '');
			$lvl_10_com=number_format((float)(($lvl_10_rate*$txn_amt)/100), 2, '.', '');
			$lvl_11_com=number_format((float)(($lvl_11_rate*$txn_amt)/100), 2, '.', '');
			$lvl_12_com=$lvl_12_rate;
			$lvl_2_tds=0;
			$lvl_2_earn=0;
			$lvl_3_tds=number_format((float)($lvl_3_com*.05), 2, '.', '');
			$lvl_3_earn=number_format((float)($lvl_3_com-$lvl_3_tds), 2, '.', '');
			$lvl_4_tds=number_format((float)($lvl_4_com*.05), 2, '.', '');
			$lvl_4_earn=number_format((float)($lvl_4_com-$lvl_4_tds), 2, '.', '');
			$lvl_5_tds=number_format((float)($lvl_5_com*.05), 2, '.', '');
			$lvl_5_earn=number_format((float)($lvl_5_com-$lvl_5_tds), 2, '.', '');
			$lvl_6_tds=number_format((float)($lvl_6_com*.05), 2, '.', '');
			$lvl_6_earn=number_format((float)($lvl_6_com-$lvl_6_tds), 2, '.', '');
			$lvl_7_tds=number_format((float)($lvl_7_com*.05), 2, '.', '');
			$lvl_7_earn=number_format((float)($lvl_7_com-$lvl_7_tds), 2, '.', '');
			$lvl_8_tds=number_format((float)($lvl_8_com*.05), 2, '.', '');
			$lvl_8_earn=number_format((float)($lvl_8_com-$lvl_8_tds), 2, '.', '');
			$lvl_9_tds=number_format((float)($lvl_9_com*.05), 2, '.', '');
			$lvl_9_earn=number_format((float)($lvl_9_com-$lvl_9_tds), 2, '.', '');
			$lvl_10_tds=number_format((float)($lvl_10_com*.05), 2, '.', '');
			$lvl_10_earn=number_format((float)($lvl_10_com-$lvl_10_tds), 2, '.', '');
			$lvl_11_tds=number_format((float)($lvl_11_com*.05), 2, '.', '');
			$lvl_11_earn=number_format((float)($lvl_11_com-$lvl_11_tds), 2, '.', '');
			$lvl_12_tds=0;
			$lvl_12_earn=0;
	
			$clientdb="$bankapi_child".$clienttype."_".$clientid;
			$client_com_gen_qry="INSERT INTO $bankapi_child_txn.com_generated(order_id, tid, source, type, method, date_time, user_id, amount, charged, retailer_gst, retailer_com, admin_gst, admin_fee, lvl_1_id, lvl_1_com, lvl_1_tds, lvl_1_earn, lvl_2_id, lvl_2_com, lvl_2_tds, lvl_2_earn, lvl_3_id, lvl_3_com, lvl_3_tds, lvl_3_earn, lvl_4_id, lvl_4_com, lvl_4_tds, lvl_4_earn, lvl_5_id, lvl_5_com, lvl_5_tds, lvl_5_earn, lvl_6_id, lvl_6_com, lvl_6_tds, lvl_6_earn, lvl_7_id, lvl_7_com, lvl_7_tds, lvl_7_earn, lvl_8_id, lvl_8_com, lvl_8_tds, lvl_8_earn, lvl_9_id, lvl_9_com, lvl_9_tds, lvl_9_earn, lvl_10_id, lvl_10_com, lvl_10_tds, lvl_10_earn, lvl_11_id, lvl_11_com, lvl_11_tds, lvl_11_earn, lvl_12_id, lvl_12_com, lvl_12_tds, lvl_12_earn) value ('$order', '$tid', '$source', '$type', '$method', '$datetimes', '$uids', '$txn_amt', '$charged', '$retailer_gst', '$retailer_com', '$admin_gst', '$admin_fee', '$lvl_1_id', '$lvl_1_com', '$lvl_1_tds', '$lvl_1_earn', '$lvl_2_id', '$lvl_2_com', '$lvl_2_tds', '$lvl_2_earn', '$lvl_3_id', '$lvl_3_com', '$lvl_3_tds', '$lvl_3_earn', '$lvl_4_id', '$lvl_4_com', '$lvl_4_tds', '$lvl_4_earn', '$lvl_5_id', '$lvl_5_com', '$lvl_5_tds', '$lvl_5_earn', '$lvl_6_id', '$lvl_6_com', '$lvl_6_tds', '$lvl_6_earn', '$lvl_7_id', '$lvl_7_com', '$lvl_7_tds', '$lvl_7_earn', '$lvl_8_id', '$lvl_8_com', '$lvl_8_tds', '$lvl_8_earn', '$lvl_9_id', '$lvl_9_com', '$lvl_9_tds', '$lvl_9_earn', '$lvl_10_id', '$lvl_10_com', '$lvl_10_tds', '$lvl_10_earn', '$lvl_11_id', '$lvl_11_com', '$lvl_11_tds', '$lvl_11_earn', '$lvl_12_id', '$lvl_12_com', '$lvl_12_tds', '$lvl_12_earn')";
			mysql_query($client_com_gen_qry);
			$admin_earn=$lvl_1_earn;
			$team_earn=$lvl_2_earn+$lvl_3_earn+$lvl_4_earn+$lvl_5_earn+$lvl_6_earn+$lvl_7_earn+$lvl_8_earn+$lvl_9_earn+$lvl_10_earn+$lvl_11_earn;
			$total_tds=$lvl_2_tds+$lvl_3_tds+$lvl_4_tds+$lvl_5_tds+$lvl_6_tds+$lvl_7_tds+$lvl_8_tds+$lvl_9_tds+$lvl_10_tds+$lvl_11_tds;
			$total_amt=$admin_earn+$team_earn+$total_tds;
			
			$lvl_1_earn=$admin_earn+$total_gst+$total_tds;
			
			if($lvl_1_id!=0 && $lvl_1_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_1_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_1_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_2_id!=0 && $lvl_2_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_2_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_2_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_3_id!=0 && $lvl_3_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_3_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_3_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_4_id!=0 && $lvl_4_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_4_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_4_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_5_id!=0 && $lvl_5_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_5_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_5_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_6_id!=0 && $lvl_6_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_6_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_6_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_7_id!=0 && $lvl_7_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_7_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_7_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_8_id!=0 && $lvl_8_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_8_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_8_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_9_id!=0 && $lvl_9_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_9_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_9_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_10_id!=0 && $lvl_10_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_10_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_10_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			if($lvl_11_id!=0 && $lvl_11_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_11_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_11_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			/*
			if($lvl_12_id!=0 && $lvl_12_com!=0)
			{
				$details="Earnings from order no: $order of user id: $uids at $datetimes";
				$client_com_paid_qry="INSERT INTO $bankapi_child_txn.com_paid_child(order_id, user_id, source, type, method, date_time, details, cr, dr) value ('$order', '$lvl_12_id', '$source', '$type', '$method', '$datetimes', '$details', '$lvl_12_earn', '0');";
				mysql_query($client_com_paid_qry);
			}
			*/
			
			if($total_amt!=0)
			client_user_balance_cr($clientdb, $wallet_transact, $total_amt, $service, $order, $mmt_id, "Txn Charges Received for order $order");
			if($total_amt!=0)
			client_user_balance_dr($clientdb, $wallet_transact, $admin_earn, $service, $order, $mmt_id, "Admin Comm for order $order");
			if($total_amt!=0)
			client_user_balance_dr($clientdb, $wallet_transact, $team_earn, $service, $order, $mmt_id, "Team Comm for order $order");
			if($total_amt!=0)
			client_user_balance_dr($clientdb, $wallet_transact, $total_tds, $service, $order, $mmt_id, "TDS for order $order");
			if($total_amt!=0)
			client_user_balance_cr($clientdb, $wallet_admininc, $admin_earn, $service, $order, $mmt_id, "Admin Comm for order $order");
			if($total_amt!=0)
			client_user_balance_cr($clientdb, $wallet_teamcomm, $team_earn, $service, $order, $mmt_id, "Team Comm for order $order");
			if($total_amt!=0)
			client_user_balance_cr($clientdb, $wallet_tdstopay, $total_tds, $service, $order, $mmt_id, "TDS for order $order");
		}
		if($mmt_paid==0)
		{
			$admin_rate=($admin_rate*$txn_amt)/100;
			$client_rate=($client_rate*$txn_amt)/100;
			$admin_earning=$admin_rate-$client_rate;
			$details="Earning from order $mmt_id, client $clientid, user $uids, source $source, service $service, operator $operator on date $datetimes";
			$admin_com_gen_qry="INSERT INTO $bankapi_parent_txn.com_paid_child(order_id, client_id, user_id, source, type, method, date_time, details, cr, dr) value ('$mmt_id', '$clientid', '$uids', '$source', '$type', '$method', '$datetimes', '$details', '$admin_earning', '0')";
			mysql_query($admin_com_gen_qry);
		}
		echo "mid:$mmt_id, cid:$clientid, uid:$uids, order:$order, tid:$tid, dt:$datetimes<br>";
		echo str_pad('',16384);
	
		flush();
		ob_flush();
		usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
	}
}
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<br><br><h4 class='blinking'>Please wait while re-updating records...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(1000000);
echo "<script>window.close();openInNewTab('update-mt-tid.php');</script>";
*/
?>
<meta http-equiv='refresh' content='3'>
</body>
</html>