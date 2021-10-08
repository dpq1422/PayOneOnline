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
										Contact Details
									</div>
									<?php
									$query4a="select * from child_company where company_id='1';";
									$result4a=mysql_query($query4a);
									while($rs=mysql_fetch_assoc($result4a))
									{
										$contact_no=$rs['contact_no'];
										$e_mail=$rs['e_mail'];
									}
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<tr>
												<td align="left" valign="top" width="175"><b>Contact No Description</b></td>
												<td width="75"></td>
												<td align="left"><textarea style="border:none;" readonly rows="4" cols="100"><?php echo $contact_no;?></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left" valign="top"><b>E-mail Description</b></td>
												<td width="75"></td>
												<td align="left"><textarea style="border:none;" readonly rows="4" cols="100"><?php echo $e_mail;?></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">
													<input type="button" value="Edit / Update" onclick="document.location.href='contacts.php'" />
												</td>
											</tr>
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
