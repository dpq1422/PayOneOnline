<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<meta http-equiv='refresh' content='30'>
	</head>
	<body><!--oncontextmenu="return false"-->
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include_once '../_logged-user-info.php'; ?>
					<?php include_once '_nav-menu.php'; ?>
					<?php
					if($online_url=="payoneonline.com" && $user_id==100010)
					{
						echo "<script>location.href='wallet-request-receiveds.php';</script>";
					}
					else if($online_url=="payoneonline.com" && $user_id==100006)
					{
						echo "<script>location.href='tickets.php';</script>";
					}
					else if($user_id==100001)
					{
						include_once '_update_all_wallets.php';
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">Today&lsquo;s Admin Wallet and Transaction Status</p>
							</div>
						</div>
					</div>
					<?php
						include('../functions/_payout.php');
						payout(100001);
						payout(1);
						payout(100000);
						payouts(100005);
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Opening Balance
									</div>
									<?php	
$val_01=0;$val_02=0;$val_03=0;$val_04=0;$val_05=0;$val_06=0;$val_07=0;$val_08=0;$val_09=0;$val_10=0;$val_11=0;$val_12=0;
$val_13=0;$val_14=0;$val_15=0;$val_16=0;$val_17=0;$val_18=0;$val_19=0;$val_20=0;$val_21=0;$val_22=0;$val_23=0;$val_24=0;

									$query="SELECT * FROM child_wallet_remain where user_id=100001 and wallet_date<'$date_time' order by wallet_id desc limit 0,1";
									$result=mysql_query($query);
									$opening_balance=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$opening_balance=$rs['amount_bal'];
										}
									}
									if($opening_balance=="")
									$opening_balance=0;
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $opening_balance;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Wallet Update
									</div>
									<?php
									$query="SELECT sum(amount_cr) as amt FROM child_wallet_remain where user_id=100001 and transaction_type in(1,5,21,13) and wallet_date='$date_time'";
									$result=mysql_query($query);
									$wallet_update=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$wallet_update=$rs['amt'];
										}
									}
									if($wallet_update=="")
									$wallet_update=0;
									
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $wallet_update;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Wallet Transfers
									</div>
									<?php
									$query="SELECT sum(amount_dr) as amt FROM child_wallet_remain where user_id=100001 and transaction_type in(2,3,4) and wallet_date='$date_time'";
									$result=mysql_query($query);
									$wallet_transfer=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$wallet_transfer=$rs['amt'];
										}
									}
									if($wallet_transfer=="")
									$wallet_transfer=0;
									
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $wallet_transfer;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Current Balance
									</div>
									<?php
									$closing_balance=$opening_balance+$wallet_update-$wallet_transfer;
									$closing_balance=number_format((float)$closing_balance, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $closing_balance;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">Real Time Admin Wallet and Transaction Status</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-2">
									<?php
									$query="SELECT sum(retailer_tds+dist_tds+sd_tds) as amt FROM main_transaction_commission;";
									$result=mysql_query($query);
									$tds=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$tds=$rs['amt'];
										}
									}
									if($tds=="")
									$tds=0;
									$tds=number_format((float)$tds, 2, '.', '');
									$query="SELECT sum(retailer_gst) as amt FROM main_transaction_commission;";
									$result=mysql_query($query);
									$gst=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$gst=$rs['amt'];
										}
									}
									if($gst=="")
									$gst=0;
									$gst=number_format((float)$gst, 2, '.', '');
									?>
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Real Time Wallet
									</div>
									<?php
									$query="SELECT * FROM child_wallet_realtime order by wallet_id desc limit 0,1";
									$result=mysql_query($query);
									$realtime_wallet=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$realtime_wallet=$rs['amount_bal'];
										}
									}
									if($realtime_wallet=="")
									$realtime_wallet=0;
									$realtime_wallet-=1500000;
									$realtime_wallet=number_format((float)$realtime_wallet, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures">15L,<?php echo $realtime_wallet;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Admin Wallet
									</div>
									<?php
									$query="SELECT * FROM child_wallet_remain where user_id=100001 order by wallet_id desc limit 0,1";
									$result=mysql_query($query);
									$admin_wallet=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_wallet=$rs['amount_bal'];
										}
									}
									if($admin_wallet=="")
									$admin_wallet=0;
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $admin_wallet;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Team Wallet
									</div>
									<?php
									$query="SELECT count(*) as num,sum(wallet_balance) as amt FROM child_user where user_type in(2,3)";
									$result=mysql_query($query);
									$distributor_wallet=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$distributor_wallet=$rs['amt'];
										}
									}
									if($distributor_wallet=="")
									$distributor_wallet=0;
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $distributor_wallet;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Retailer Wallet
									</div>
									<?php
									$query="SELECT count(*) as num,sum(wallet_balance) as amt FROM child_user where user_type=11";
									$result=mysql_query($query);
									$retailer_wallet=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$retailer_wallet=$rs['amt'];
										}
									}
									if($retailer_wallet=="")
									$retailer_wallet=0;
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $retailer_wallet;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Distribution
									</div>
									<?php
									$query="SELECT sum(cr-dr) as amt FROM main_commission_paid where user_id!=1;";
									$result=mysql_query($query);
									$admin_comm=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_comm=$rs['amt'];
										}
									}
									if($admin_comm=="")
									$admin_comm=0;								
								
									$query="SELECT sum(amount_cr-amount_dr) amt FROM `child_wallet_remain` WHERE `user_id`=100005 AND `transaction_type` in (16,17,18);";
									$result=mysql_query($query);
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_comm+=$rs['amt'];
										}
									}
									$dist_total=$admin_comm;
									/*
									$aaa=$admin_comm-$wallet_bals;
									$aaa=" (".$aaa.")";
									*/
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:green;"><?php echo $admin_comm;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Track Difference
									</div>
									<?php
									$total=$admin_wallet+$distributor_wallet+$retailer_wallet+$admin_comm;
									$track_difference = $realtime_wallet - $total;
									$track_difference+=1500000;
									$track_difference=number_format((float)$track_difference, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:red;"><?php echo $track_difference;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">Distribution Status (Un-Paid)</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Admin Balance
									</div>
									<?php
									$query="SELECT sum(admin_earning) amt FROM main_transaction_commission;";
									$result=mysql_query($query);
									$admin_comm=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_comm=$rs['amt'];
										}
									}
									
									
									$query="SELECT sum(amount_cr-amount_dr) amt FROM `child_wallet_remain` WHERE `user_id` in (100000,100005) AND `transaction_type` in (16,18,19);";
									$result=mysql_query($query);
									$admin_comms=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_comms=$rs['amt'];
										}
									}
									
									$query="SELECT sum(dr) as amt FROM main_commission_paid where user_id=100001;";
									$result=mysql_query($query);
									$admin_commsdr=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$admin_commsdr=$rs['amt'];
										}
									}
									
									
									if($admin_comms=="")
									$admin_comms=0;
									$admin_comms=number_format((float)$admin_comms, 2, '.', '');
									$admin_conn_total=$admin_comm+$admin_comms-$admin_commsdr+$gst+$tds;
									$admin_conn_total=number_format((float)$admin_conn_total, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $admin_conn_total;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Team Comm.
									</div>
									<?php
									$query="SELECT sum(cr-dr) as amt FROM main_commission_paid where user_id in(select user_id from child_user where user_type in(2,3));";
									$result=mysql_query($query);
									$team_comm=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$team_comm=$rs['amt'];
										}
									}
									if($team_comm=="")
									$team_comm=0;
									$team_comm=number_format((float)$team_comm, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $team_comm;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Retailer Comm.
									</div>
									<?php
									$query="SELECT sum(cr-dr) as amt FROM main_commission_paid where user_id in(select user_id from child_user where user_type=11)";
									$result=mysql_query($query);
									$retailer_comm=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$retailer_comm=$rs['amt'];
										}
									}
									if($retailer_comm=="")
									$retailer_comm=0;
									$retailer_comm=number_format((float)$retailer_comm, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $retailer_comm;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										TDS
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo 0;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										GST
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo 0;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Security Amount
									</div>
									<?php
									$query="SELECT sum( amount_cr ) amt FROM `child_wallet_remain` WHERE `user_id` =100005 AND `transaction_type` =17;";
									$result=mysql_query($query);
									$sec_comm=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$sec_comm=$rs['amt'];
										}
									}
									
									
									if($sec_comm=="")
									$sec_comm=0;
									$admin_comms=number_format((float)$sec_comm, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $sec_comm;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">GRAND TOTAL</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										TOTAL
									</div>
									<?php
									$total=$admin_conn_total+$team_comm+$retailer_comm+$sec_comm;
									$total=number_format((float)$total, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:green;"><?php echo $total;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Difference (Distribution - Total)
									</div>
									<?php
									$grand_total_diff=$dist_total-$total;
									$grand_total_diff=number_format((float)$grand_total_diff, 2, '.', '');
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:red;"><?php echo $grand_total_diff;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">Distribution Status (Paid)</p>
							</div>
						</div>
					</div>
					<?php
					$comm_1=$comm_2=$comm_3=$comm_4=$comm_5=$comm_6=$comm_total=0;
					$comm_1=$admin_commsdr;
					
					$query="SELECT sum(dr) amt FROM main_commission_paid where user_id in(select user_id from child_user where user_type=2)";
					$result=mysql_query($query);
					$num_rows = mysql_num_rows($result);
					if($num_rows>0)
					{
						while($rs = mysql_fetch_assoc($result)) {
							$comm_2=$rs['amt'];
						}
					}
					if($comm_2=="")
					$comm_2=0;
				
					$query="SELECT sum(dr) amt FROM main_commission_paid where user_id in(select user_id from child_user where user_type=3)";
					$result=mysql_query($query);
					$num_rows = mysql_num_rows($result);
					if($num_rows>0)
					{
						while($rs = mysql_fetch_assoc($result)) {
							$comm_3=$rs['amt'];
						}
					}
					if($comm_3=="")
					$comm_3=0;
				
					$query="SELECT sum(dr) amt FROM main_commission_paid where user_id in(select user_id from child_user where user_type=11)";
					$result=mysql_query($query);
					$num_rows = mysql_num_rows($result);
					if($num_rows>0)
					{
						while($rs = mysql_fetch_assoc($result)) {
							$comm_4=$rs['amt'];
						}
					}
					if($comm_4=="")
					$comm_4=0;
					
					$comm_total=$comm_1+$comm_2+$comm_3+$comm_4+$comm_5+$comm_6;
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Admin Exp
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $comm_1;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										SD Comm
									</div>
									<?php
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $comm_2;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Dist Comm
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $comm_3;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Retailer Comm
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $comm_4;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										TDS + GST
									</div>
									<?php
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo ($comm_5+$comm_6);?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Total
									</div>
									<?php
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $comm_total;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">GST+TDS</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<?php
$rdate=$date_time;
$qry1="SELECT * FROM all_avon_sonar_report_com WHERE report_date='$rdate';";
$res1=mysql_query($qry1);
$num_rows1 = mysql_num_rows($res1);
if($num_rows1==0)
{
	$qry2="INSERT INTO all_avon_sonar_report_com(report_date, updated_on) VALUES ('$rdate', '$datetime_time');";
	mysql_query($qry2);
}

//unit_mt, amount_mt
$qry_check="SELECT count(*) unit_mt, sum(amount) amount_mt FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_01=$rs_check['unit_mt'];
	$val_02=$rs_check['amount_mt'];
}
if($val_01=="")
	$val_01=0;
if($val_02=="")
	$val_02=0;
$qry_update="update all_avon_sonar_report_com set unit_mt='$val_01', amount_mt='$val_02' where report_date='$rdate';";
mysql_query($qry_update);

//unit_av, amount_av
$qry_check="SELECT count(*) unit_av, sum(amount) amount_av FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=2;";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_03=$rs_check['unit_av'];
	$val_04=$rs_check['amount_av'];
}
if($val_03=="")
	$val_03=0;
if($val_04=="")
	$val_04=0;
$qry_update="update all_avon_sonar_report_com set unit_av='$val_03', amount_av='$val_04' where report_date='$rdate';";
mysql_query($qry_update);

//fee_admin, gst_admin, fee_taken, gst_taken, fee_retailer, gst_retailer
$qry_check="SELECT sum(admin_fee) fee_admin, sum(admin_gst) gst_admin, sum(client_charges) fee_taken, sum(client_charges-retailer_charges)*18/118 gst_taken, sum(retailer_charges) fee_retailer, sum(retailer_charges-admin_fee)*18/118 gst_retailer FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_05=$rs_check['fee_admin'];
	$val_06=$rs_check['gst_admin'];
	$val_07=$rs_check['fee_taken'];
	$val_08=$rs_check['gst_taken'];
	$val_09=$rs_check['fee_retailer'];
	$val_10=$rs_check['gst_retailer'];
}
if($val_05=="")
	$val_05=0;
if($val_06=="")
	$val_06=0;
if($val_07=="")
	$val_07=0;
if($val_08=="")
	$val_08=0;
if($val_09=="")
	$val_09=0;
if($val_10=="")
	$val_10=0;
$qry_update="update all_avon_sonar_report_com set fee_admin='$val_05', gst_admin='$val_06', fee_taken='$val_07', gst_taken='$val_08', fee_retailer='$val_09', gst_retailer='$val_10' where report_date='$rdate';";
mysql_query($qry_update);

//com_r, tds_r, earn_r, com_d, tds_d, earn_d, com_s, tds_s, earn_s
$qry_check="SELECT sum(retailer_commission) com_r, sum(retailer_tds) tds_r, sum(retailer_earning) earn_r, sum(dist_commission) com_d, sum(dist_tds) tds_d, sum(dist_earning) earn_d, sum(sd_commission) com_s, sum(sd_tds) tds_s, sum(sd_earning) earn_s FROM main_transaction_commission WHERE date(trans_date_time) = '$rdate' and service=1;";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_11=$rs_check['com_r'];
	$val_12=$rs_check['tds_r'];
	$val_13=$rs_check['earn_r'];
	$val_14=$rs_check['com_d'];
	$val_15=$rs_check['tds_d'];
	$val_16=$rs_check['earn_d'];
	$val_17=$rs_check['com_s'];
	$val_18=$rs_check['tds_s'];
	$val_19=$rs_check['earn_s'];
}
if($val_11=="")
	$val_11=0;
if($val_12=="")
	$val_12=0;
if($val_13=="")
	$val_13=0;
if($val_14=="")
	$val_14=0;
if($val_15=="")
	$val_15=0;
if($val_16=="")
	$val_16=0;
if($val_17=="")
	$val_17=0;
if($val_18=="")
	$val_18=0;
if($val_19=="")
	$val_19=0;
$qry_update="update all_avon_sonar_report_com set com_r='$val_11', tds_r='$val_12', earn_r='$val_13', com_d='$val_14', tds_d='$val_15', earn_d='$val_16', com_s='$val_17', tds_s='$val_18', earn_s='$val_19' where report_date='$rdate';";
mysql_query($qry_update);

//avfee
$qry_check="SELECT sum(amount_cr) avfee FROM child_wallet_remain where user_id=100000 and transaction_type=19 and wallet_date='$rdate';";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_20=$rs_check['avfee'];
}
if($val_20=="")
	$val_20=0;
$qry_update="update all_avon_sonar_report_com set avfee='$val_20' where report_date='$rdate';";
mysql_query($qry_update);

//swfee
$qry_check="SELECT sum(amount_cr-amount_dr) swfee FROM child_wallet_remain where user_id=100005 and transaction_type in(16,18) and wallet_date='$rdate';";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_21=$rs_check['swfee'];
}
if($val_21=="")
	$val_21=0;
$qry_update="update all_avon_sonar_report_com set swfee='$val_21' where report_date='$rdate';";
mysql_query($qry_update);

//scfee
$qry_check="SELECT sum(amount_cr) scfee FROM child_wallet_remain where user_id=100005 and transaction_type=17 and wallet_date='$rdate';";
$res_check=mysql_query($qry_check);
while($rs_check=mysql_fetch_array($res_check))
{
	$val_22=$rs_check['scfee'];
}
if($val_22=="")
	$val_22=0;
$qry_update="update all_avon_sonar_report_com set scfee='$val_22' where report_date='$rdate';";
mysql_query($qry_update);

$val_qgst=0;
$qgst="SELECT sum( dr ) dr
FROM `main_commission_paid`
WHERE details LIKE '%pooling%'
OR details LIKE '%tds%' 
OR details LIKE '%income tax%'";
$resqgst=mysql_query($qgst);
while($rsqgst=mysql_fetch_array($resqgst))
{
	$val_qgst=$rsqgst['dr'];
}

							
							$query="SELECT sum(gst_admin) a,sum(gst_retailer) b,sum(gst_taken) c from all_avon_sonar_report_com";
							$result=mysql_query($query);
							$ga=0;
							$gb=0;
							$gc=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$ga=$rs['a'];
									$gb=$rs['b'];
									$gc=$rs['c'];
								}
							}
							if($ga=="")
							$ga=0;
							if($gb=="")
							$ga=0;
							if($gc=="")
							$ga=0;
							$gb=$ga+$gb;
							?>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Paid by Admin
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $ga;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Adm. to Ret. + Ret. to Cust.
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $gb;?>+<?php echo $gc;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Already Filed
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $val_qgst;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										To be paid by Admin
									</div>
									<?php
									$gd=$gb+$gc-$ga-$val_qgst;
									?>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $gd;?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
