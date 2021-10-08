<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<?php include_once '../admin/_update_all_wallets.php'; ?>
		<meta http-equiv='refresh' content='30'>
	</head>
	<body><!--oncontextmenu="return false"-->
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include '../_logged-user-info.php'; ?>
					<?php include '_nav-menu.php'; ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<p class="reversal-effect">Today&lsquo;s Wallet and Transfer Status</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Opening Balance
									</div>
									<?php
									
					if($isemp_id!=0)
					{
						echo "<script>location.href='retailers.php';</script>";
					}
									$query="SELECT * FROM child_wallet_remain where user_id=$user_id and wallet_date<'$date_time' order by wallet_id desc limit 0,1";
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
									$query="SELECT sum(amount_cr) as amt FROM child_wallet_remain where user_id=$user_id and transaction_type in(1) and wallet_date='$date_time'";
									$result=mysql_query($query);
									$wallet_update=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$wallet_update=$rs['amt'];
										}
									}
									$query="SELECT sum(amount_dr) as amt FROM child_wallet_remain where user_id=$user_id and transaction_type in(5) and wallet_date='$date_time'";
									$result=mysql_query($query);
									$wallet_update2=0;
									$num_rows = mysql_num_rows($result);
									if($num_rows>0)
									{
										while($rs = mysql_fetch_assoc($result)) {
											$wallet_update2=$rs['amt'];
										}
									}
									if($wallet_update2=="")
									$wallet_update2=0;
									
									$wallet_update=$wallet_update-$wallet_update2;
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
									$query="SELECT sum(amount_dr) as amt FROM child_wallet_remain where user_id=$user_id and transaction_type=4 and wallet_date='$date_time'";
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
								<p class="reversal-effect">Quick Stats</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<?php
							include('../functions/_payout.php');
							payout($user_id);
							$field_id="";
							$filed_sum="";
							$field_hrarchy="";
							if($user_type==2)
							{
								$field_id="sd_id";
								$feld_sum="super_dist";
								$field_hrarchy="hierarchy_2_id";
							}
							else
							{
								$field_id="dist_id";
								$feld_sum="distributor";
								$field_hrarchy="hierarchy_3_id";
							}
							
							$query="SELECT count(*) as num,sum(wallet_balance) as amt FROM child_user where hierarchy_2_id=$user_id and user_type=3";
							$result=mysql_query($query);
							$total_distributor=0;
							$distributor_balance=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$total_distributor=$rs['num'];
									$distributor_balance=$rs['amt'];
								}
							}
							if($total_distributor=="")
							$total_distributor=0;
							if($distributor_balance=="")
							$distributor_balance=0;
							
							$query="SELECT count(*) as num,sum(wallet_balance) as amt FROM child_user where $field_hrarchy=$user_id and user_type=11";
							$result=mysql_query($query);
							$total_retailer=0;
							$retailer_balance=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$total_retailer=$rs['num'];
									$retailer_balance=$rs['amt'];
								}
							}
							if($total_retailer=="")
							$total_retailer=0;
							if($retailer_balance=="")
							$retailer_balance=0;
							
							$query="SELECT sum(cr-dr) as amt FROM main_commission_paid_group where user_id=$user_id";
							$result=mysql_query($query);
							$unpaid_commission=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$unpaid_commission=$rs['amt'];
								}
							}
							if($unpaid_commission=="")
							$unpaid_commission=0;							
							
							$query="SELECT sum(dr) as amt FROM main_commission_paid_group where user_id=$user_id";
							$result=mysql_query($query);
							$paid_commission=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$paid_commission=$rs['amt'];
								}
							}
							if($paid_commission=="")
							$paid_commission=0;
							
							if($user_type==2)
							{
							?>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Total Distributors
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $total_distributor;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Distributor&lsquo;s Wallet
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $distributor_balance;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Total Retailers
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $total_retailer;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Retailer&lsquo;s Wallet
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $retailer_balance;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Unpaid Commission
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:red;"><?php echo $unpaid_commission;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Paid Commission
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:green;"><?php echo $paid_commission;?></div>
									</div>
								</div>
							</div>
							<?php
							}
							else
							{
							?>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Total Retailers
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $total_retailer;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Retailer&lsquo;s Wallet
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $retailer_balance;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Unpaid Commission
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:red;"><?php echo $unpaid_commission;?></div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Paid Commission
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures" style="color:green;"><?php echo $paid_commission;?></div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						</div>
					</div>
					<?php
					/*
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Quick Stats
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody><tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th scope="col">Date Time</th><th scope="col">Description</th><th scope="col">Amount</th>
												</tr><tr style="background-color:White;">
													<td>10-Mar-2015</td><td>Total Transaction</td><td>200</td>
												</tr><tr style="background-color:White;">
													<td>10-Mar-2015</td><td>Total Comimssion</td><td>300</td>
												</tr><tr style="background-color:White;">
													<td>10-Mar-2015</td><td>Paid Commission</td><td>400</td>
												</tr><tr style="background-color:White;">
													<td>10-Mar-2015</td><td>Unpaid Commission</td><td>400</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					*/
					?>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
