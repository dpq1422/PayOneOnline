<html>
<head>
<title>Updating PayOne</title>
<link rel="shortcut icon" type="image/x-icon" href="../img/mentor.ico" />
<meta name="gwt:property" content="panel="/>
<script language="javascript" type="text/javascript">
    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    document.getElementById("progressBar").value = 5 - timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>
<style>
*{font-family: "Courier New", Courier, monospace;}
</style>
</head>
<body>
<table cellspacing="5" cellpadding="5">
<tr>
<td colspan="3" align="center">
<b style='color:#226bfa;'>This is an automated process, please dont refresh the page.</b>
</td>
</tr>
<tr>
<td>
<?php

@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);


header( 'Content-type: text/html; charset=utf-8' );
include_once('../_gyan-info-trans.php');
include_once('../_common-team.php');
include_once('../functions/_my_uname.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');
include_once('../functions/_user-channel-service-rate.php');

//$qry="delete FROM main_transaction_commission where etid in (SELECT eko_transaction_id FROM main_transaction_mt where eko_transaction_status!=2 and source=1) and source=1";
//mysql_query($qry);
//$qry="delete FROM main_commission_paid where etid not in(select etid FROM main_transaction_commission where source=1) and source=1 and dr=0";
//mysql_query($qry);

/***** PART A = update transaction if charges are greater than com_charged *****/
$qry="SELECT * FROM main_transaction_mt where charges>com_charged;";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$diff=$rs['charges']-$rs['com_charged'];
	$oid=$rs['eko_transaction_id'];
	$uid=$rs['user_id'];
	$qryo="update main_transaction_mt set com_charged=charges, deducted=amount+charges, bal_after=bal_before-amount-charges, updated_on='$datetime_time' where eko_transaction_id='$oid';";
	mysql_query($qryo);
	$qrys="select * from child_wallet_remain where user_id='$uid' order by wallet_id desc limit 0,1";
	$ress=mysql_query($qrys);
	$bals=0;
	$wid=0;
	while($rss=mysql_fetch_array($ress))
	{
		$bals=$rss['amount_bal'];
		$wid=$rss['wallet_id'];
	}
	$bals=$bals-$diff;
	$qryo="update child_wallet_remain set amount_bal='$bals' where wallet_id='$wid' and user_id='$uid';";
	mysql_query($qryo);
	update_wallet($uid);
	$qryu="update child_user set wallet_balance=(wallet_balance-$diff) where user_id='$uid';";
	mysql_query($qryu);
}

$query="SELECT * FROM main_transaction_mt where (response is NULL or response='' or tid='') and eko_transaction_status in(1,3,4) and source=1 and type=1 order by eko_transaction_id asc";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);	
$i=0;
echo $statement="<b>MT >> * PROCESS :: Display Orders has not TxnNo and update them *</b>";
if($num_rows>0)
{
	$a=$b=$c=$d=0;
	while($rs = mysql_fetch_array($result))
	{
/***** PART B = display stucked order *****/		
		$i++;
		$ttype=$rs['source'];
		$ttype22=$rs['source'];
		$transaction_description=$rs['transaction_description'];
		if($ttype==1 && $ttype22==1)
		$ttype="Money Transfer";
		
		$tids=$rs['tid'];
		
		$oid=$rs['eko_transaction_id'];
		$uid=$rs['user_id'];
		$unm=show_my_uname($rs['user_id']);
		$sender_number=$rs['sender_number'];
		$receiver_number=$rs['receiver_number'];
		$amount=$rs['amount'];
		$com_charged=$rs['com_charged'];
		$deducted=$rs['deducted'];
echo $statement="<br><br><b>Order No. :</b> $oid, <b>User Id :</b> $uid, <b>User Name :</b> $unm, <br><b>Sender Number :</b>$sender_number, <b>Receiver Number :</b> $receiver_number, <b>Amount :</b> $amount, <b>Charges :</b> $com_charged, <b>Deducted Amount :</b> $deducted";		
		if($oid!="")
		{
/***** PART C = update TID for stucked order *****/		
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="CHECK_ORDER_STATUS";
			$order_number=$oid;									
									
			$url = "$call_url" . "?";
			$url = $url . "bankapi_user_id=" . $bankapi_user_id;
			$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
			$url = $url . "&bankapi_method=" . $bankapi_method;
			$url = $url . "&order_number=" . $order_number;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);

			/* API RESULT 2 */

			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  $msg="<br>cURL Error : " . $err;
			}
			else
			{
				if(!(empty($response) || $response==NULL))
				{
					//echo $response;
					$result= json_decode($response, true);
					$message= $result['message'];
					$message=str_replace("Last_used_OkeyKey: 235","",$message);
					$response_type_id= $result['response_type_id'];
					$response_status_id= $result['response_status_id'];
					$status=$result['status'];
					$tid=0;
					$service_tax=0;
					$fee=0;
					$bank_ref_num=0;
					$channel=0;
					$channel_desc='';
					
					$txstatus_desc=0;
					if(($response_type_id==325 && $response_status_id==0 && $status==0) || ($response_type_id==70 && $response_status_id==0 && $status==0))
					{
						$tid=$result['data']['tid'];
						$service_tax=$result['data']['service_tax'];
						$fee=$result['data']['fee'];
						$bank_ref_num=$result['data']['bank_ref_num'];
						$channel=$result['data']['channel'];
						if($channel==1)
						$channel_desc="NEFT";
						else if($channel==2)
						$channel_desc="IMPS";
						
					}
					
					$pre_bal=0;
					$ams=0;
					$post_bal=0;
					$qryy="select * from child_wallet_remain where user_id=$uid and user_id2=0 and request_id=$oid;";
					$ress=mysql_query($qryy);
					while($rss=mysql_fetch_array($ress))
					{
						$ams=0;
						$pre_bal=$rss['amount_pre'];
						$ams=$rss['amount_dr'];
						$post_bal=$rss['amount_bal'];
					}
					
					$qry="update main_transaction_mt set response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message', tid='$tid', service_tax='$service_tax', fee='$fee', bank_ref_no='$bank_ref_num', channel='$channel', channel_desc='$channel_desc', bal_before='$pre_bal', bal_after='$post_bal', updated_on='$datetime_time' where eko_transaction_id='$oid';";
					mysql_query($qry);
					if($tid!="")
					{
						$filled_remarks=",<br>TxnNo.: $tid";
						$qry3="update child_wallet_remain set transaction_description=concat(transaction_description,'$filled_remarks') where user_id=$uid and user_id2=0 and request_id=$oid;";
						mysql_query($qry3);
						echo $statement="<br><br><b>Updated TxnNo for Order No. :</b> $oid, <b>TxnNo :</b> $tid";
					}
flush();
ob_flush();		
				}
			}
		}
		//sleep(1);
	}
}

/***** PART D = updating TID of Money Transfer *****/
echo $statement="<br><br><b>MT >> ** PROCESS :: updating TID of Money Transfer **</b>";
$str='%"tid":"%';
$qry="SELECT * FROM main_transaction_mt where tid=0 and response like '$str' and response not like '% TID %' limit 0,10";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$oid=$rs['eko_transaction_id'];
	echo "<br><br>oid : $oid";
	
	$val_start='"tid":"';
	$val_end='"},"response_type_id"';
	$response=$rs['response'];
	$pos_start=strpos($response, $val_start);
	$pos_end=strpos($response, $val_end);
	
	$startIndex = min($pos_start+7, $pos_end);
	$length = abs($pos_start+7 - $pos_end);
	$tid = substr($response, $pos_start+7, $length);
	$tid=  sprintf("%.0f",$tid);
	echo ", tid : ".$tid;
	
	$qr="update main_transaction_mt set tid='$tid' where eko_transaction_id='$oid'";
	mysql_query($qr);
}


include_once('update-rc.php');
include_once('update-tid.php');


/***** PART E = update transaction status *****/		
echo $statement="<br><br><b>MT >> ******** PROCESS :: Update Transaction Status ********</b>";
$qry1="select * from main_transaction_mt where eko_transaction_status in(1,3,4) and source=1 and type=1 and refund_cid=0 order by eko_transaction_id desc;";// and channel=2
$res1=mysql_query($qry1);
$tid="";
while($rs1=mysql_fetch_array($res1))
{
		$uid=$rs1['user_id'];
		$unm=show_my_uname($rs1['user_id']);
	/* API CALL */
				 
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="FUND_TRANSFER_STATUS";
	$rbname=$rs1['rbname'];
	$tid=$rs1['tid'];
	$oid=$rs1['eko_transaction_id'];
	$dts=$rs1['created_on'];
	$chdesc=$rs1['channel_desc'];
	$amtpr=$rs1['amount'];
	$com_charged=$rs1['com_charged'];

	$url = "$call_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&tid=" . $tid;
				   
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($curl);
	
	/* API RESULT */
	
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "<br>cURL Error : " . $err;
	}
	else
	{
		//echo $response;
		$result= json_decode($response, true);
		$message= $result['message'];
		$response_type_id= $result['response_type_id'];
		$response_status_id= $result['response_status_id'];
		$status= $result['status'];
		$txstatus_desc="";
		
		if(isset($result['data']))
		{
			$service_tax=$result['data']['service_tax'];//////////
			$tx_status=$result['data']['tx_status'];//////////
			$fee=$result['data']['fee'];//////////
			$bank_ref_num=$result['data']['bank_ref_num'];//////////
			$txstatus_desc=$result['data']['txstatus_desc'];//////////
		}
		$txsts=$txstatus_desc;
		if($txstatus_desc=="Initiated")
		{
			$txstatus_desc=1;
			$txsts="<b style='color:blue;'>Initiated</b>";
		}
		else if($txstatus_desc=="Success" && $tx_status==0)
		{
			$txstatus_desc=2;
			$txsts="<b style='color:green;'>Success</b>";
		}
		else if($txstatus_desc=="In Progress" || $txstatus_desc=="Response Awaited")
		{
			$txstatus_desc=3;
			$txsts="<b style='color:blue;'>Response Awaited</b>";
		}
		else if($txstatus_desc=="Refund Pending" && $tx_status==3)
		{
			$txstatus_desc=4;
			$txsts="<b style='color:red;'>Refund Pending</b>";
		}
		else if($txstatus_desc=="Refunded" && $tx_status==4)
		{
			$txstatus_desc=5;
			$txsts="<b style='color:green;'>Refunded</b>";
		}
		else
		{
			$txstatus_desc=3;
			$txsts="<b style='color:red;'>Scheduled / Holded / Queued</b>";
		}
		
		
		$qry2="update main_transaction_mt set service_tax='$service_tax', fee='$fee', bank_ref_no='$bank_ref_num', eko_transaction_status='$txstatus_desc', updated_on='$datetime_time' where tid='".$tid."'";
		mysql_query($qry2);
		
echo $statement="<br><br><b>Order No :</b> $oid ($chdesc), <b>User Id :</b> $uid, <b>User Name :</b> $unm, <b>Date :</b> $dts, <b>Amount :</b> $amtpr, <b>Charges :</b> $com_charged, <br><b>TxnNo :</b> $tid, <b>Updated Status :</b> $txsts, <b>Bank :</b> $rbname";

flush();
ob_flush();	
	}
	//sleep(1);
}

include_once('update-txn-mt-com.php');
include_once('update-txn-rc-com.php');

mysql_query("update main_transaction_mt set tid='0' where type=2 and tid='' and (response like '%share%' or response like '%invalid%' or response like '%available%' or response like '%failed%')");

//echo "<meta http-equiv='refresh' content='5'>";
?>
</td>
<td width="25"></td>
<td valign="top">
<img src="../img/payone.gif" height="300" alt="Payone is updating transaction status and commissions" title="Payone is updating transaction status and commissions" /><br><br>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<p style="font-weight:bold;color:#226bfa;"> <br>Next process will be executed in <span id="countdowntimer">5</span> Seconds </p>
<progress style="width:100%;" value="0" max="5" id="progressBar"></progress>
</td>
</tr>
</table>
</body>
</html>