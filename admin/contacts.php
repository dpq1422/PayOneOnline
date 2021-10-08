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
									if(isset($_POST['update']))
									{
										$contact=$_POST['contact'];
										$email=$_POST['email'];
										$qry="update child_company set contact_no='$contact',e_mail='$email' where company_id='1'";
										$res=mysql_query($qry);
										if($res)
										{
											echo "<script>document.location.href='contact.php'</script>";
										}
									}
									?>
									<div class="panel-body panel-primary text-center">
										<form method="post">
											<table>
												<tr>
													<td align="left" valign="top">Contact No Description
													<br>
													<textarea rows="5" name="contact" required cols="80"><?php echo $contact_no;?></textarea></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" valign="top">E-mail Description
													<br>
													<textarea rows="5" name="email" required cols="80"><?php echo $e_mail;?></textarea></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">
														<input type="submit" name="update" value="Update" />
													</td>
												</tr>
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
