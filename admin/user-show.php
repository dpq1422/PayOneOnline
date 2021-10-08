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
										User Details
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="" method="post">
											<?php
												$query1="SELECT * FROM child_user where user_id='".$_REQUEST['userid']."'";
												$result1=mysql_query($query1);
												$num_rows1 = mysql_num_rows($result1);
												if($num_rows1>0)
												{
													while($r1 = mysql_fetch_assoc($result1)) {
											?>
											<table>
												<tr><th>USER ID :: <?php echo $r1['user_id'];?></th><th width="75"></th><th>Joining Date :: <?php echo $r1['join_date'];?></th><th width="75"></th><th>Joining Time :: <?php echo $r1['join_time'];?></th></tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Name<br><input name="UserName" readonly value="<?php echo $r1['user_name'];?>" size="30" /></td>
													<td width="75"></td>
													<td align="left">Aadhar Number<br><input name="AadharNumber" readonly value="<?php echo $r1['aadhar_no'];?>" size="30" /></td>
													<td width="75"></td>	
													<td align="left">Email<br><input name="Email" readonly value="<?php echo $r1['e_mail'];?>" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Mobile Number<br><input name="MobileNumber" readonly value="<?php echo $r1['user_contact_no'];?>" size="30" /></td>
													<td width="75"></td>
													<td align="left"></td>
													<td width="75"></td>
													<td align="left"></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" colspan="5">Address<br><input readonly name="Address" value="<?php echo $r1['user_name'];?>" size="131" />
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">State<br>
													<select name='StateName' id='StateName' disabled>
														<?php 
														$query="SELECT state_id,state_name FROM all_state where state_status=1 order by state_name";
														$result=mysql_query($query);
														$num_rows = mysql_num_rows($result);
														if($num_rows>0)
														{
															while($r = mysql_fetch_assoc($result)) {
														?>
														<option <?php if($r1['state_id']==$r['state_id']) echo 'selected'?> value='<?php echo $r['state_id']; ?>'><?php echo $r['state_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
													</td>
													<td width="75"></td>
													<td align="left" id="LoadDist">Distt.<br>
													<select name='DisttName' id='DisttName' disabled>
														<?php 
														$query="SELECT distt_id,distt_name FROM all_state_distt order by distt_name";
														$result=mysql_query($query);
														$num_rows = mysql_num_rows($result);
														if($num_rows>0)
														{
															while($r = mysql_fetch_assoc($result)) {
														?>
														<option <?php if($r1['distt_id']==$r['distt_id']) echo 'selected'?> value='<?php echo $r['distt_id']; ?>'><?php echo $r['distt_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
													</td>
													<td width="75"></td>
													<td align="left">City<br><input name="City" readonly value="<?php echo $r1['city_name'];?>" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Pin Code<br><input name="PinCode" readonly value="<?php echo $r1['area_pin_code'];?>" size="30" /></td>
													<td width="75"></td>
													<td align="left">Guardian / Spouse Name<br><input name="GsName" readonly value="<?php echo $r1['guardian_spouse_name'];?>" size="30" /></td>
													<td width="75"></td>
													<td align="left">Guardian / Spouse Mobile Name<br><input name="GsMobileNumber" readonly value="<?php echo $r1['guardian_spouse_contact_no'];?>" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr><!--
												<tr>
													<td align="left" colspan="5"><b>Department</b><br>
														<table>
															<tr>
																<td width="300"><input type="checkbox" value="1" name="Department[]" />Application Officer (Admin)</td>
																<td width="300"><input type="checkbox" value="2" name="Department[]" />CRM Officer (Team)</td>
																<td width="300"><input type="checkbox" value="3" name="Department[]" />Support Officer (Ticket)</td>
																<td width="300"><input type="checkbox" value="4" name="Department[]" />Account Officer (Wallet)</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" colspan="5"><b>Roles and Permissions</b><br>
														<table>
															<tr>
																<td width="300"><input type="checkbox" value="1" name="RolePermission[]" />Create User</td>
																<td width="300"><input type="checkbox" value="2" name="RolePermission[]" />Create Team</td>
																<td width="300"><input type="checkbox" value="3" name="RolePermission[]" />Manage Tickets</td>
																<td width="300"><input type="checkbox" value="4" name="RolePermission[]" />List Wallet</td>
															</tr>
															<tr>
																<td width="300"><input type="checkbox" value="5" name="RolePermission[]" />List User</td>
																<td width="300"><input type="checkbox" value="6" name="RolePermission[]" />List Team</td>
																<td width="300"><input type="checkbox" value="7" name="RolePermission[]" />List Order</td>
																<td width="300"><input type="checkbox" value="8" name="RolePermission[]" />Update Wallet</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>-->
											</table>
											<?php
													}
												}
											?>
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
