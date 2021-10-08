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
										Change Password
									</div>
									<?php
									
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<form method="post" onsubmit="return chang_pass()">
											<?php
											$msg="";
											if(isset($_POST['submit']))
											{
												$opas=$_POST['opass'];
												$npas=$_POST['npass'];
												$opas=md5($opas);
												$npas=md5($npas);
												$query23="update child_user set pass_word='$npas', past_change_on='$datetime_time' where user_id='$user_id' and pass_word='$opas';";
												mysql_query($query23);
												$result23=mysql_affected_rows();

												if($result23>0)
												$msg="<b style='color:green;'>Password updated</b>";
												else
												$msg="<b style='color:red;'>Old password not matched</b>";
											}
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
												<td align="left">User ID :: <input value="<?php echo $user_id;?>"  readonly name="uid"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Old Password
												<br><input type="password" value="" required id="oldP" name="opass"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr><td>&nbsp;</td></tr>
												<td align="left">New Password
												<br><input type="password" value="" required id="newP" name="npass"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr><td>&nbsp;</td></tr>
												<td align="left">Confirm Password
												<br><input type="password" value="" required id="conP" name="cpass"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td valign="bottom" colspan="2" align="center"><input type="submit" value="Update" name="submit" /></td>
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
