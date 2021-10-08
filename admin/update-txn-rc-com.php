<?php

include_once('../_gyan-info-trans.php');
include_once('../_common-team.php');
include_once('../functions/_my_uname.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

/***** PART F = update commission for success transaction *****/
echo $statement="<br><br><b>RC >> ********* PROCESS :: Update Commission for Updated Transaction Status for Successful Orders *********</b>";
$qry1="select * from main_transaction_rc where rc_status=2 and tid!='' and source=2 and type in(3,4) order by rc_id desc;";
$res1=mysql_query($qry1);
$tid="";

$fee=0;
$fee2=0;
$fee3=0;
while($rs1=mysql_fetch_array($res1))
{
	/* API CALL */
	$etid=$rs1['rc_id'];
	$service=$rs1['type'];
	$source=$rs1['source'];
	
	$isexist=0;
	$qry19="select etid from main_transaction_commission where source='$source' and service='$service' and etid='$etid'";
	$res19=mysql_query($qry19);
	while($rs19=mysql_fetch_array($res19))
	{
		$isexist++;
	}
	if($isexist==0)
	{		
		$uid=0;
		$etid=0;
		$etid=$rs1['rc_id'];
		$tid=$rs1['tid'];
		$method=$service;
		$trans_date_time=$rs1['created_on'];
		$user_id=$rs1['user_id'];
		$amount=$rs1['amount'];
		$client_charges=$amount;
		$retailer_gst=0;
		$retailer_com=0;
		$admin_gst=0;
		$admin_fee=0;
		
		$uid=$user_id;
		$q_ins="INSERT INTO main_transaction_commission (etid, tid, service, source, method, trans_date_time, retailer_id, amount, client_charges, retailer_gst, retailer_com, admin_gst, admin_fee) value('$etid', '$tid', '$service', '$source', '$method', '$trans_date_time', '$user_id', '$amount', '$client_charges', '$retailer_gst', '$retailer_com', '$admin_gst', '$admin_fee');";
		mysql_query($q_ins);
		
		$retailer_id=0;
		$dist_id=0;
		$sd_id=0;
		$admin_id=0;
		
		$retailer_charges=0;
		$dist_charges=0;
		$sd_charges=0;
		$admin_charges=0;
		
		$retailer_id=$rs1['ret_id'];
		$dist_id=$rs1['dist_id'];
		$sd_id=$rs1['sd_id'];
		$admin_id=$rs1['admin_id'];
		
		$retailer_charges=$rs1['ret_comm'];
		$dist_charges=$rs1['dist_comm'];
		$sd_charges=$rs1['sd_comm'];
		$admin_charges=$rs1['admin_comm'];
		
		$admin_margin=0;
		$sd_margin=0;
		$dist_margin=0;
		$retailer_margin=0;
		
		$admin_margin=($admin_charges*$amount)/100;
		$sd_margin=($sd_charges*$amount)/100;
		$dist_margin=($dist_charges*$amount)/100;
		$retailer_margin=($retailer_charges*$amount)/100;

		$qry7="update main_transaction_commission set retailer_margin='$retailer_margin', dist_id=$dist_id, sd_id=$sd_id, admin_id=$admin_id, retailer_charges=$retailer_charges, dist_charges=$dist_charges, sd_charges=$sd_charges, admin_charges=$admin_charges, dist_margin='$dist_margin', sd_margin='$sd_margin', admin_margin='$admin_margin' where etid='$etid' and source=$source and service=$service;";
		mysql_query($qry7);
		
		
		$qry9="update main_transaction_commission set retailer_commission=retailer_margin, dist_commission=dist_margin, dist_tds=(dist_margin*.05), dist_earning=(dist_commission-dist_tds), sd_commission=sd_margin, sd_tds=(sd_margin*.05), sd_earning=(sd_commission-sd_tds), admin_commission=(admin_margin+dist_tds+sd_tds), admin_tds=(dist_tds+sd_tds), admin_earning=admin_margin where etid='$etid' and source=$source and service=$service;";
		mysql_query($qry9);
		
		
		$qry10="SELECT etid, amount,client_charges, admin_charges, trans_date_time, (admin_charges-admin_fee) mentor, admin_id, admin_earning, admin_commission, sd_id, sd_earning, dist_id, dist_earning, retailer_id, retailer_earning FROM main_transaction_commission where etid='$etid' and source=$source and service=$service;";
		$res10=mysql_query($qry10);
		
		while($rs10=mysql_fetch_array($res10))
		{	
			$etid=$rs10['etid'];		
			$dt=$rs10['trans_date_time'];				
			$details="Earnings from RC order no: $etid";
			$main_amount=$rs10['amount'];
			
			$payone=$rs10['admin_id'];
			$admin_earning=$rs10['admin_earning'];
			$payone_amt=$rs10['admin_commission'];
			
			$sd_id=$rs10['sd_id'];
			$amt1=$rs10['sd_earning'];
			
			$dist_id=$rs10['dist_id'];
			$amt2=$rs10['dist_earning'];		
			
			$admin_bal=wallet_balance(100000);
			$cr_amt=$payone_amt+$amt1+$amt2;
			$admin_bal2=$admin_bal+$cr_amt;
			$query4b="insert into child_wallet_remain value 
			(NULL, '$date_time', '$time_time', '100000', '$retailer_id', '$etid', '14', '$details by user_id $retailer_id Recharge Amount:$main_amount', '$admin_bal', '$cr_amt', '0', '$admin_bal2');";
			$result4b=mysql_query($query4b);
			update_wallet(100000);
			
			if($payone_amt!=0)
			{
				$qry12="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$dt','$payone','$details','$payone_amt', 0);";
				mysql_query($qry12);
			}
			if($amt1!=0)
			{
				$qry13="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$dt','$sd_id','$details','$amt1', 0);";
				mysql_query($qry13);
			}
			if($amt2!=0)
			{
				$qry14="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$dt','$dist_id','$details','$amt2', 0);";
				mysql_query($qry14);
			}
		echo $statement="<br><br><b>Commission for Order No :</b> $etid, <b>TxnNo :</b> $tid, <b>AC :</b> $payone_amt, <b>SDC :</b> $amt1, <b>DC :</b> $amt2";
		}
		
	}
	//sleep(1);	
flush();
ob_flush();		
}

echo "<meta http-equiv='refresh' content='5'>";
?>