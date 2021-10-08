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
									<form action="bank-detail-code.php" method="post" onsubmit="return validateBank()">
										<div class="panel-heading bgheadcolor">
											Add New Bank Details
										</div>
										<div class="panel-body panel-primary text-center">
												<table>
													<tr>
														<td align="left" width="300">Bank Name<br><input required name="bname" required /></td>
														<td width="75"></td>
														<td align="left" width="300">Account Name<br><input required name="aname" required /></td>
														<td width="75"></td>
														<td align="left" width="300">Account No.<br><input required type="number" id="filled_account_no" name="ano" required /></td>
													</tr>
													<tr><td>&nbsp;</td></tr>
													<tr>
														<td align="left" width="300">Branch Name<br><input required name="brname" required /></td>
														<td width="75"></td>
														<td align="left" width="300">IFSC Code<br><input required name="ifsc" required /></td>
														<td width="75"></td>
														<td align="left" width="300">MICR Code<br><input required type="number" id="filled_micr" name="micr" required /></td>
													</tr>
												</table>
										</div>
										<div class="panel-body panel-primary text-center">
											<input type="submit" value="Send" />
										</div>
									</form>
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
