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
										Pay Commission Now
									</div>
									<?php
									
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<form action="commission-pay-code.php" method="post">
											<?php
											$msg="";
											$uid=$_REQUEST['uid'];
											if($msg!="")
											{
											?>
											<tr>
												<td colspan="5" align="left"><?php echo $msg;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<?php
											}
											?>
											<tr>
												<td align="left" width='300'>User ID</td>
												<td align='left'><input value="<?php echo $uid;?>" readonly name="uid"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Commission Generated</td>
												<td align='left'><input value="<?php echo $_REQUEST['cr'];?>"  readonly /></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Commission Paid</td>
												<td align='left'><input value="<?php echo $_REQUEST['dr'];?>"  readonly /></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Commission Remain</td>
												<td align='left'><input value="<?php echo $_REQUEST['bal'];?>"  readonly /></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<th align="left">Description</th>
												<td align='left'><input type="text" size='70' value="" required id="desc" name="desc"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<th align="left">Commission Paid via Bank Transfer</th>
												<td align='left'><input type="number" value="" required id="comm" name="comm"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td>&nbsp;</td>
												<td align="left"><input type="submit" value="Pay Now" name="submit" /></td>
											</tr>
											</form>
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
