<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
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
										Update Request with Bank Txn
									</div>
									<div class="panel-body panel-primary text-center">
										<?php
										$msg="";
										$rid=$_REQUEST['rid'];
										$cid=$_REQUEST['cid'];
										$rdts=$_REQUEST['rdts'];
										if(isset($_POST['update']))
										{
											$rid=$_POST['rid'];
											$cid=$_POST['cid'];
											$bid=$_POST['bid'];
											$rtds=$_POST['rdts'];
											$q1="update child_bank_records set request_id='$rid', user_id='$cid', auth_id='$user_id' where bnk_id='$bid';";
											mysql_query($q1);
											$q2="update child_bank_comm_paid set bnk_id='$bid' where paid_id='$rid';";
											mysql_query($q2);
											echo "<script>window.location.href = 'tally-comm-paids.php?rdts=$rdts';</script>";
										}
										?>
										<form method="post">
											<input type="hidden" value="<?php echo $rdts;?>" name="rdts"/>
											<table>
												<tr align='left'>
													<td colspan="2"><?php echo $msg;?></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left" width="150">Comm. Paid ID</td>
													<td align="left" width="25"></td>
													<td align="left"><input required name="rid" id="rid" readonly value="<?php echo $rid;?>" /></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left">User ID</td>
													<td align="left"></td>
													<td align="left"><input required name="cid" id="cid" readonly value="<?php echo $cid;?>" /></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left">Bank Record No</td>
													<td align="left"></td>
													<td align="left"><input required name="bid" id="bid" /></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left"></td>
													<td align="left"></td>
													<td align="left"><input type="submit" name="update" value="Update Bank Record" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
											</table>
										</form>
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
