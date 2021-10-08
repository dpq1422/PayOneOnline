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
										$bnk=$_REQUEST['bnk'];
										$rdts=$_REQUEST['rdts'];
										if(isset($_POST['update']))
										{
											$rid=$_POST['rrid'];
											$cid=$_POST['uuid'];
											$bid=$_POST['bbid'];
											$rtds=$_POST['rdts'];
											$q1="update child_bank_records set request_id='$rid', user_id='$cid', auth_id='$user_id' where bnk_id='$bid';";
											mysql_query($q1);
											$q2="update child_bank_requests set bnk_id='$bid' where request_id='$rid';";
											mysql_query($q2);
											echo "<script>window.location.href = 'tally-bank-transactions.php?t2=$rdts';</script>";
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
													<td align="left" width="150">Bank Record No</td>
													<td align="left" width="25"></td>
													<td align="left"><input required readonly name="bbid" id="bbid" value="<?php echo $bnk;?>" /></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left">Request ID</td>
													<td align="left"></td>
													<td align="left"><input required name="rrid" id="rrid" /></td>
												</tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left">User ID</td>
													<td align="left"></td>
													<td align="left"><input required name="uuid" id="uuid" /></td>
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
