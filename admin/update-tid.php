<?php
include_once('../_gyan-info-trans.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

/***** PART A = updating TID of Account Verification *****/
echo $statement="<br><br><b>AV >> ****** PROCESS :: updating TID of Account Verification ******</b>";
$str='%"tid":"%';
$qry="SELECT * FROM main_transaction_mt where tid=0 and response like '$str' and response not like '% TID %' limit 0,10";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$oid=$rs['eko_transaction_id'];
	echo "<br/>oid : $oid";
	
	$response=$rs['response'];
	/*
	{
		"response_status_id":-1,
		"data":
		{
			"client_ref_id":"",
			"bank":"Allahabad Bank",
			"amount":"1.0",
			"is_name_editable":"0",
			"fee":"2.00",
			"verification_failure_refund":"",
			"aadhar":"",
			"recipient_name":"Mr. Sonu Kumar",
			"is_Ifsc_required":"0",
			"account":"59122074171",
			"tid":"451638796"
		},
		"response_type_id":61,
		"message":"Success!  Account details found..",
		"status":0
	}
	*/
	$result= json_decode($response, true);
	if(isset($result['data']['tid']))
	{
		$tid=$result['data']['tid'];
		echo ", tid : ".$tid;
		
		$qr="update main_transaction_mt set tid='$tid' where eko_transaction_id='$oid'";
		mysql_query($qr);
	}
flush();
ob_flush();
}

/***** PART B = update commission for account verification *****/
echo $statement="<br><br><b>AV >> ******* PROCESS :: update commission for account verification *******</b>";

$response_val1='%"fee":"1.00"%';
$response_val2='%"fee":"2.00"%';
$response_val3='%Recipient already Registered.Name not available.%';

mysql_query("update main_transaction_mt set eko_transaction_status=2, response_status=-1 where source=1 and type=2 and (response like '$response_val1' or response like '$response_val2' or response like '$response_val3')");

mysql_query("update main_transaction_mt set eko_transaction_status=5 where source=1 and type=2 and refund_cid!=0;");

mysql_query("update main_transaction_mt set eko_transaction_status=2, response_status=-1 where source=1 and type=2 and response not like '$response_val1' and response not like '$response_val2' and response not like '$response_val3' and refund_cid=0 and eko_transaction_id<1993");

mysql_query("update main_transaction_mt set eko_transaction_status=2 WHERE eko_transaction_status = 3 and source=1 and type=2;");

$qry1="select * from main_transaction_mt where eko_transaction_status=2 and source=1 and type=2 order by eko_transaction_id;";
$res1=mysql_query($qry1);
$tid="";

$statement="";
while($rs1=mysql_fetch_array($res1))
{
	$etid=0;
	$etid=$rs1['eko_transaction_id'];
	
	$isexist=0;
	$qry2="select etid from main_transaction_commission where source=1 and service=2 and etid='$etid'";
	$res2=mysql_query($qry2);
	while($rs2=mysql_fetch_array($res2))
	{
		$isexist++;
	}
	if($isexist==0)
	{
		$uid=0;
		$tid="";
		$uid=$rs1['user_id'];
		$tid=$rs1['tid'];
		$service=$rs1['type'];
		$source=$rs1['source'];
		$trans_date_time=$rs1['created_on'];
		$amount=$rs1['amount'];
		$admin_fee=2;
		$response_val=$rs1['response'];
		//Success!  Account details found

		$details="Earnings from Account Verification order no: $etid";
		$payone_amt=$amount-$admin_fee;
		//DELETE FROM main_transaction_commission WHERE source =1 AND service =2
		$q_ins="INSERT INTO main_transaction_commission (etid, tid, service, source, trans_date_time, retailer_id, amount, admin_fee) value('$etid', '$tid', '$service', '$source', '$trans_date_time', '$uid', '$amount', '$admin_fee');";
		mysql_query($q_ins);
		
		//DELETE FROM main_commission_paid WHERE etid in(SELECT etid FROM main_transaction_commission WHERE source =1 AND service =2)
		$q_paid="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$trans_date_time','100000','$details','$payone_amt', 0);";
		mysql_query($q_paid);
		
		if(strpos($response_val,"Success!  Account details found")==false)
		{
			$q_paid="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$trans_date_time','1','$details','2', 0);";
			mysql_query($q_paid);
		}
		
		$admin_bal=wallet_balance(100000);
		$admin_bal2=$payone_amt+$admin_bal;
		$q_admin="insert into child_wallet_remain value (NULL, date('$trans_date_time'), time('$trans_date_time'), '100000', '$uid', '$etid', '19', 'Earning from Account Verification Order No. $etid by user_id $uid Sender Charges:$amount Admin Charges:$admin_fee', '$admin_bal', '$payone_amt', '0', '$admin_bal2');";
		mysql_query($q_admin);
		update_wallet(100000);
		
		$statement="$statement<br><b>Updating Commission for Order No :</b> $etid, <b>AC :</b> $payone_amt";
	}
flush();
ob_flush();
}
echo $statement;
//echo "<meta http-equiv='refresh' content='1'>";
?>