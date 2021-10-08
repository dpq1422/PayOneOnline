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
										Distributor Details
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
													$sel_user_type=$r1['user_type'];
													$sel_parent_no="";
													$sel_parent_id="";
													include '../functions/_parent_no_id.php';
													$sel_parent=explode("@",show_parent_no_id($_REQUEST['userid']));
													$sel_parent_no=$sel_parent[0];
													$sel_parent_id=$sel_parent[1];
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
												<tr><td>&nbsp;</td></tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Designation / Hierarchy<br>
														<select name='HierarchyName' disabled id='HierarchyName'>
															<?php 
															$query="SELECT hierarchy_id,hierarchy_name FROM child_hierarchy where hierarchy_id='$sel_user_type' and status=1";
															$result=mysql_query($query);
															$num_rows = mysql_num_rows($result);
															if($num_rows>0)
															{
																while($r = mysql_fetch_assoc($result)) {
															?>
															<option value='<?php echo $r['hierarchy_id']; ?>'><?php echo $r['hierarchy_name']; ?></option>
															<?php
																}
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left" id="LoadDist2">Parent Hierarchy<br>
														<select name='ParentHierarchyName' disabled id='ParentHierarchyName'>
															<?php 
															$query2="SELECT hierarchy_id,hierarchy_name FROM child_hierarchy where hierarchy_id='$sel_parent_no' and status=1";
															$result2=mysql_query($query2);
															$num_rows2 = mysql_num_rows($result2);
															if($num_rows>0)
															{
																while($r2 = mysql_fetch_assoc($result2)) {
															?>
															<option value='<?php echo $r2['hierarchy_id']; ?>'><?php echo $r2['hierarchy_name']; ?></option>
															<?php
																}
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left" id="LoadDist3">Parent Name<br>
														<select name='ParentNameByHierarchy' disabled id='ParentNameByHierarchy'>
															<?php 
															$query3="SELECT user_id,user_name FROM child_user where user_id='$sel_parent_id'";
															$result3=mysql_query($query3);
															$num_rows3 = mysql_num_rows($result3);
															if($num_rows3>0)
															{
																while($r3 = mysql_fetch_assoc($result3)) {
															?>
															<option value='<?php echo $r3['user_id']; ?>'><?php echo $r3['user_name']; ?></option>
															<?php
																}
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
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
