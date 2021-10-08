<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
	</head>
	<body><!--oncontextmenu="return false"-->
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include '../_logged-user-info.php'; ?>
					<?php include '_nav-menu.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Withdraw Amount from Wallet
									</div>
									<?php
									$search="";
									$sids="";
									$snams="";
									$smobs="";
									$sadds="";
									$scitys="";
									$sdists="";
									$sstates="";
									
									if(isset($_GET['search']))
									$search=$_GET['search'];
									
									if($search!="")
									{
										$query4a="select * from child_user where user_id='$search' or user_name like '%$search%' or user_contact_no like '%$search%';";
										$result4a=mysql_query($query4a);
										include '../functions/_distt.php';
										include '../functions/_state.php';
										while($rs=mysql_fetch_assoc($result4a))
										{
											$sids=$rs['user_id'];
											$snams=$rs['user_name'];
											$smobs=$rs['user_contact_no'];
											$sadds=$rs['address'];
											$scitys=$rs['wallet_balance'];
											$sdists=show_distt_display($rs['distt_id']);
											$sstates=show_state_display($rs['state_id']);
										}
									}
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<?php
											if(isset($_REQUEST['msg']))
											{
											?>
											<tr>
												<td colspan="5" align="left"><b style="color:red;font-weight:normal;">User Wallet Balance is less than withdraw amount.</b></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<?php
											}
											?>
											<form method="get">
											<tr>
												<td align="left">Search by Name / User ID / Mobile<br><input required size="30" value="<?php echo $search;?>" name="search" /></td>
												<td width="75"></td>
												<td valign="bottom" colspan="3" align="left"><input type="submit" value="Search" /></td>
											</tr>
											</form>
											<tr><td>&nbsp;</td></tr>
											<?php
											if($search!="")
											{
											?>
											<tr>
												<td align="left">User ID<br><?php echo $sids;?></td>
												<td width="75"></td>
												<td align="left">Name<br><?php echo $snams;?></td>
												<td width="75"></td>
												<td align="left">Mobile Number<br><?php echo $smobs;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Wallet balance<br><?php echo $scitys;?></td>
												<td width="75"></td>
												<td align="left">Distt.<br><?php echo $sdists;?></td>
												<td width="75"></td>
												<td align="left">State<br><?php echo $sstates;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<form action="wallet-withdraw-code.php" method="post">
											<tr>
												<td align="left">Amount to Withdraw<br><input type="hidden" name="uid" value="<?php echo $sids;?>" />
												<input required id="filled_amount" size="30" name="filled_amount" /></td>
												<td width="75"></td>
												<td align="left">Remarks<br><input required size="30" name="filled_remarks" /></td>
												<td width="75"></td>
												<td valign="bottom" colspan="3" align="center"><input type="submit" /></td>
											</tr>
											</form>
											<?php
											}
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
