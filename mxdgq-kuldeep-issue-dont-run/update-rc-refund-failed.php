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
include_once('../zc-gyan-info-admin.php');
include_once('../zc-commons-admin.php');
include_once('../zf-Client.php');
include_once('../zf-TxnExists.php');
echo "<h4 style='color:#ff9800;'>Checking RC-2 failed to refund update</h4>";

$qry_failed="SELECT * FROM $bankapi_parent_txn.txn_rc where mrc_status=4 and source=2 and type in(3,4) order by mrc_id asc";
$result_failed=mysql_query($qry_failed);
$i=0;
while($rs_failed = mysql_fetch_array($result_failed))
{
	$i++;
	$m_id=$rs_failed['mrc_id'];
	$clientid=$rs_failed['client_id'];
	$uid=$rs_failed['user_id'];
	$order_id=$rs_failed['order_id'];
	$type=$rs_failed['type'];
	$service=0;
	if($type==3)
		$service=102;
	else if($type==4)
		$service=103;
	$rc_stat=5;
	$created_on=$rs_failed['created_on'];
	$source=$rs_failed['source'];
	$clienttype=show_client_type_id($clientid);
	if($m_id!="")
	{
		refund_rc_amount($order_id,$m_id,$source,$uid,$clientid,$clienttype,$service);
		echo "mid:$m_id, cid:$clientid, uid:$uid, order:$order_id, type:$type, status:$rc_stat, dt:$created_on<br>";
		echo str_pad('',16384);

		flush();
		ob_flush();
		usleep(500000);//sleep for 5 seconds usleep(5000000)instead of sleep(5);
	}
}
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<br><br><h4 class='blinking'>Please wait while re-updating...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(2000000);
echo "<script>window.close();openInNewTab('update-rc-com.php');</script>";
?>
<!--<meta http-equiv='refresh' content='10'>-->
</body>
</html>