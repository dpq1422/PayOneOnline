<?php

include_once('../_gyan-info-trans.php');
include_once('../_common-team.php');
include_once('../functions/_my_uname.php');
include_once('../functions/_update_wallet.php');
include_once('../functions/_wallet_balance.php');

/***** PART F = update commission for success transaction *****/
echo $statement="<br><br><b>MT >> ********* PROCESS :: Update Commission for Updated Transaction Status for Successful Orders *********</b>";
$qry1="select * from main_transaction_mt where eko_transaction_status=2 and tid!='' and source=1 and type=1 order by eko_transaction_id desc;";
$res1=mysql_query($qry1);
$tid="";

$fee=0;
$fee2=0;
$fee3=0;
while($rs1=mysql_fetch_assoc($res1))
{
	/* API CALL */
	$etid=$rs1['eko_transaction_id'];
	
	$isexist=0;
	$qry19="select etid from main_transaction_commission where source=1 and service=1 and etid='$etid'";
	$res19=mysql_query($qry19);
	while($rs19=mysql_fetch_assoc($res19))
	{
		$isexist++;
	}
	if($isexist==0)
	{
		$tid=$rs1['tid'];
		$fee=$rs1['fee'];
		$fee2=9-$fee;
		$fee3=$fee3+$fee;
		
		$qry3="update parent_wallet_realtime set real_dr=(real_dr-$fee2), real_bal=(real_bal+$fee3) where source_order_id='".$tid."' and transaction_type=2";
		mysql_query($qry3);
		
		$uid=0;
		$etid=0;
		$etid=$rs1['eko_transaction_id'];
		$tid=$rs1['tid'];
		$service=$rs1['type'];
		$source=$rs1['source'];
		$method=$rs1['channel'];
		$trans_date_time=$rs1['created_on'];
		$user_id=$rs1['user_id'];
		$amount=$rs1['amount'];
		$client_charges=$rs1['com_charged'];
		$retailer_gst=$rs1['gst_charged'];
		$retailer_com=$rs1['com_earned'];
		$admin_gst=$rs1['service_tax'];
		$admin_fee=$rs1['fee'];
		
		$uid=$user_id;
		$q_ins="INSERT INTO main_transaction_commission (etid, tid, service, source, method, trans_date_time, retailer_id, amount, client_charges, retailer_gst, retailer_com, admin_gst, admin_fee) value('$etid', '$tid', '$service', '$source', '$method', '$trans_date_time', '$user_id', '$amount', '$client_charges', '$retailer_gst', '$retailer_com', '$admin_gst', '$admin_fee');";
		mysql_query($q_ins);
		
		$retailer_id=0;
		$dist_id=0;
		$sd_id=0;
		$admin_id=0;
		$sadmin_id=0;
		
		$retailer_charges=0;
		$dist_charges=0;
		$sd_charges=0;
		$admin_charges=0;
		$sadmin_charges=0;
		
		if($service==1)
		{
			if($etid>1223)
			{
				$retailer_id=$rs1['retailer_id'];
				$dist_id=$rs1['dist_id'];
				$sd_id=$rs1['sd_id'];
				$admin_id=$rs1['admin_id'];
				$sadmin_id=$rs1['sadmin_id'];
				
				$retailer_charges=$rs1['retailer_charges'];
				$dist_charges=$rs1['dist_charges'];
				$sd_charges=$rs1['sd_charges'];
				$admin_charges=$rs1['admin_charges'];
				$sadmin_charges=$rs1['sadmin_charges'];
			}
			else if($etid>51 && $etid<=1223)
			{
				$qry6="SELECT * FROM child_user where user_id=$uid;";
				$res6=mysql_query($qry6);
				while($rs6=mysql_fetch_assoc($res6))
				{
					$admin_id=$rs6['hierarchy_1_id'];
					$sd_id=$rs6['hierarchy_2_id'];
					$dist_id=$rs6['hierarchy_3_id'];
				}
		
				$admin_charges=user_channel_service_rate($admin_id,$source,$method,$amount);
				if($sd_id!=0)
				$sd_charges=user_channel_service_rate($sd_id,$source,$method,$amount);
				if($dist_id!=0)
				$dist_charges=user_channel_service_rate($dist_id,$source,$method,$amount);
				$retailer_charges=user_channel_service_rate($uid,$source,$method,$amount);
			}
			else
			{
				$admin_charges=9;
				if($sd_id!=0)
				$sd_charges=12.5;
				if($dist_id!=0)
				$dist_charges=13.5;
				$qry_abc="select * from child_user where user_id=$uid;";
				$res_abc=mysql_query($qry_abc);
				while($rs_abc=mysql_fetch_assoc($res_abc))
				{
					$retailer_charges=$rs_abc['guardian_spouse_contact_no'];
				}
			}
		}
		$admin_margin=0;
		$sd_margin=0;
		$dist_margin=0;
		
		if($sd_id==0 && $dist_id==0)
		{
			$admin_margin=$retailer_charges-$admin_charges;
			$sd_margin=0;
			$dist_margin=0;
		}
		else if($sd_id==0 && $dist_id!=0)
		{
			$admin_margin=$dist_charges-$admin_charges;
			$sd_margin=0;
			$dist_margin=$retailer_charges-$dist_charges;
		}
		else if($sd_id!=0 && $dist_id==0)
		{
			$admin_margin=$sd_charges-$admin_charges;
			$sd_margin=$retailer_charges-$sd_charges;
			$dist_margin=0;
		}
		else if($sd_id!=0 && $dist_id!=0)
		{
			$admin_margin=$sd_charges-$admin_charges;
			$sd_margin=$dist_charges-$sd_charges;
			$dist_margin=$retailer_charges-$dist_charges;
		}

		$qry7="update main_transaction_commission set retailer_margin=retailer_com, dist_id=$dist_id, sd_id=$sd_id, admin_id=$admin_id, retailer_charges=$retailer_charges, dist_charges=$dist_charges, sd_charges=$sd_charges, admin_charges=$admin_charges, dist_margin='$dist_margin', sd_margin='$sd_margin', admin_margin='$admin_margin' where etid='$etid' and source=$source;";
		mysql_query($qry7);
		
		
		$qry9="update main_transaction_commission set retailer_commission=retailer_margin, retailer_tds=(retailer_margin*.05), retailer_earning=(retailer_margin*.95), dist_commission=(dist_margin*.80), dist_tds=(dist_margin*.80*.05), dist_earning=(dist_margin*.80*.95), sd_commission=(sd_margin*.80), sd_tds=(sd_margin*.80*.05), sd_earning=(sd_margin*.80*.95), admin_commission=((admin_margin+(dist_margin*.20)+(sd_margin*.20))+((retailer_margin*.05)+(dist_margin*.80*.05)+(sd_margin*.80*.05))+retailer_gst), admin_tds=((retailer_margin*.05)+(dist_margin*.80*.05)+(sd_margin*.80*.05)), admin_earning=(admin_margin+(dist_margin*.20)+(sd_margin*.20)) where etid='$etid' and source=$source;";
		mysql_query($qry9);
		////(((retailer_margin*.05)+(dist_margin*.80*.05)+(sd_margin*.80*.05))+retailer_gst)
		$qry10="SELECT etid, client_charges, admin_charges, trans_date_time, (admin_charges-admin_fee) mentor, admin_id, admin_commission, sd_id, sd_earning, dist_id, dist_earning, retailer_id, retailer_earning FROM main_transaction_commission where etid='$etid' and source=$source;";
		$res10=mysql_query($qry10);
		
		while($rs10=mysql_fetch_assoc($res10))
		{	
			$etid=$rs10['etid'];		
			$dt=$rs10['trans_date_time'];				
			$details="Earnings from MT order no: $etid";
			
			$mentor=1;
			$mentor_amt=$rs10['mentor'];
			
			$payone=$rs10['admin_id'];
			$payone_amt=$rs10['admin_commission'];
			
			$sd_id=$rs10['sd_id'];
			$amt1=$rs10['sd_earning'];
			
			$dist_id=$rs10['dist_id'];
			$amt2=$rs10['dist_earning'];
			
			$retailer_id=$rs10['retailer_id'];
			$amt3=$rs10['retailer_earning'];		
			
			$client_charges=$rs10['client_charges'];
			$admin_charges=$rs10['admin_charges'];
			$admin_user_wallet=$client_charges-$admin_charges;
			$admin_bal=wallet_balance(100000);
			$admin_bal2=$admin_bal+$admin_user_wallet;
			$query4b="insert into child_wallet_remain value 
			(NULL, '$date_time', '$time_time', '100000', '$retailer_id', '$etid', '14', '$details by user_id $retailer_id Sender Charges:$client_charges Admin Charges:$admin_charges', '$admin_bal', '$admin_user_wallet', '0', '$admin_bal2');";
			$result4b=mysql_query($query4b);
			update_wallet(100000);		
			
			if($mentor_amt!=0)
			{
				$qry11="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$dt','$mentor','$details','$mentor_amt', 0);";
				mysql_query($qry11);
			}
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
			if($amt3!=0)
			{
				$qry15="INSERT INTO main_commission_paid(etid, date_time, user_id, details, cr, bal) VALUES ('$etid','$dt','$retailer_id','$details','$amt3', 0);";
				mysql_query($qry15);
			}
		echo $statement="<br><br><b>Commission for Order No :</b> $etid, <b>TxnNo :</b> $tid, <b>AC :</b> $payone_amt, <b>SDC :</b> $amt1, <b>DC :</b> $amt2, <b>RC :</b> $amt3";
		}
	}
	//sleep(1);	
flush();
ob_flush();		
}

//echo "<meta http-equiv='refresh' content='5'>";
?>