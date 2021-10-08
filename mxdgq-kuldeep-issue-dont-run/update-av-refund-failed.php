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
echo "<h4 style='color:#ff9800;'>Checking AV-1 failed to refund update</h4>";

$min_record=0;
$min_query="SELECT * FROM $bankapi_parent_txn.txn_mt where mmt_status in(1,3) and source=1 and type=2 order by mmt_id desc limit 0,1";
$min_result=mysql_query($min_query);
while($min_rs=mysql_fetch_array($min_result))
{
	$min_record=$min_rs['mmt_id'];
	$min_record=$min_record-1;
}

$qry_av_refund="SELECT * FROM $bankapi_parent_txn.txn_mt where source=1 and type=2 and mmt_status='4' and mmt_id>68000 order by mmt_id desc;";
$res_av_refund=mysql_query($qry_av_refund);
while($rs_av_refund=mysql_fetch_array($res_av_refund))
{
	$service=101;
	$operator=1001;
	$mmt_id=$rs_av_refund['mmt_id'];
	$clientid=$rs_av_refund['client_id'];
	$order=$rs_av_refund['order_id'];
	$source=$rs_av_refund['source'];
	$type=$rs_av_refund['type'];
	$tid=$rs_av_refund['tid'];
	$method=$rs_av_refund['method'];
	$datetimes=$rs_av_refund['created_on'];
	$txn_status=$rs_av_refund['mmt_status'];
	$uids=$rs_av_refund['user_id'];
	$clienttype=show_client_type_id($clientid);
	$clientdb="$bankapi_child".$clienttype."_".$clientid;
	$clientdb_name="$bankapi_child".$clienttype."_".$clientid."_txn";
	
	$ref1=admin_mt1_refund($clientid, $uids, $order, $mmt_id);
	$ref2=client_realtime_refund($uids,$service,$order,$mmt_id,$clientdb);
	if($clienttype==1 || $clienttype==2)
	$ref3=client_user_refund($uids,$service,$order,$mmt_id,$clientdb);
	mysql_query("update $bankapi_parent_txn.txn_mt set mmt_status='5', updated_on='$datetime_datetime' where mmt_id='$mmt_id';");
	mysql_query("update $clientdb_name.txn_mt_child set order_status='5', updated_on='$datetime_datetime' where order_id='$order';");
	
	if($ref1==1 || $ref2==1 || $ref3==1)
	echo "mid:$mmt_id, cid:$clientid, uid:$uids, order:$order, tid:$tid, status:$txn_status, dt:$datetimes<br>";
	echo str_pad('',16384);
	
	flush();
	ob_flush();
	usleep(200000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
}
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<br><br><h4 class='blinking'>Please wait while re-updating...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(2000000);
echo "<script>window.close();openInNewTab('update-rc-status.php');</script>";
?>
<!--<meta http-equiv='refresh' content='10'>-->
</body>
</html>