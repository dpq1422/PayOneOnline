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
										My Profile
									</div>
									<?php
									
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<?php
											$query23="select * from child_user where user_id='$user_id';";
											$result23=mysql_query($query23);
											while($rs23=mysql_fetch_assoc($result23))
											{
												include '../functions/_state.php';
												include '../functions/_distt.php';
											?>
											<tr>
												<td width="250" align="left">User ID
													<br><?php echo $user_id;?></td>
												<td width="75"></td>
												<td width="250" align="left">Name
													<br><?php echo $user_name;?></td>
												<td width="75"></td>
												<td width="250" align="left">Designation / Hierarchy
													<br><?php echo $user_type_name;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<?php 
											/*
											?>
											<tr>
												<td align="left">Parent Hierarchy
													<br><?php echo $user_id;?></td>
												<td width="75"></td>
												<td align="left">Parent Name
													<br><?php echo $user_id;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<?php
											*/
											?>
											<tr>
												<td align="left">Aadhar Number
													<br><?php echo $rs23['aadhar_no'];?></td>
												<td width="75"></td>
												<td align="left">Email
													<br><?php echo $rs23['e_mail'];?></td>
												<td width="75"></td>
												<td align="left">Mobile
													<br><?php echo $rs23['user_contact_no'];?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Address
													<br><?php echo $rs23['address'];?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">City
													<br><?php echo $rs23['city_name'];?></td>
												<td width="75"></td>
												<td align="left">Distt
													<br><?php echo show_distt($rs23['distt_id']);?></td>
												<td width="75"></td>
												<td align="left">State
													<br><?php echo show_state($rs23['state_id']);?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Pin Code
													<br><?php echo $rs23['area_pin_code'];?></td>
												<td width="75"></td>
												<td align="left">Guardian / Spouse Name
													<br><?php echo $rs23['guardian_spouse_name'];?></td>
												<td width="75"></td>
												<td align="left">Guardian / Spouse Mobile Name
													<br><?php echo $rs23['guardian_spouse_contact_no'];?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr><td>&nbsp;</td></tr>
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
