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
										Retailer Details
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="retailer-edit-code.php" method="post" enctype="multipart/form-data">
											<?php
												$query1="SELECT * FROM child_user where user_id='".$_REQUEST['uid']."'";
												$result1=mysql_query($query1);
												$num_rows1 = mysql_num_rows($result1);
												if($num_rows1>0)
												{
													while($r1 = mysql_fetch_assoc($result1)) 
													{
											?>
											<table>
												<tr>
													<td align='left' width='200'>USER ID</td>
													<td align='left' width='200'><?php echo $r1['user_id'];?></td>
													<td align='left' width='300'>
														<input type='hidden' name="uid" value="<?php echo $r1['user_id'];?>"/><?php echo $r1['user_id'];?>
													</td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Name</td>
													<td align='left'><?php echo $r1['user_name'];?></td>
													<td align='left'><input type='text' name="uname" value="<?php echo $r1['user_name'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Mobile Number</td>
													<td align='left'><?php echo $r1['user_contact_no'];?></td>
													<td align='left'><input type='number' name="uno" value="<?php echo $r1['user_contact_no'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Aadhar Number</td>
													<td align='left'><?php echo $r1['aadhar_no'];?></td>
													<td align='left'><input type='number' name="uadhar" value="<?php echo $r1['aadhar_no'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Email</td>
													<td align='left'><?php echo $r1['e_mail'];?></td>
													<td align='left'><input type='email' name="uemail" value="<?php echo $r1['e_mail'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Security Amount</td>
													<td align='left'><?php echo $r1['sec_amount'];?></td>
													<td align='left'>
														<select name='uamt'>
															<?php
															for($mark=$r1['sec_amount'];$mark<=10000;)
															{
																if($r1['sec_amount']==$mark)
																echo "<option selected>$mark</option>";
																else
																echo "<option>$mark</option>";
																$mark+=1000;
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Gender</td>
													<td align='left'>
														<?php 
														if($r1['gender']==1) echo "Male";
														else if($r1['gender']==0) echo "Female";
														else if($r1['gender']==2) echo "Trans Gender"; 
														?>
													</td>
													<td align='left'>
														<select name="usex">
															<option value='1' <?php if($r1['gender']==1) echo "selected"; ?>>Male</option>
															<option value='0' <?php if($r1['gender']==0) echo "selected"; ?>>Female</option>
															<option value='2' <?php if($r1['gender']==2) echo "selected"; ?>>Trans Gender</option>
														</select>
													</td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Date of Birth</td>
													<td align='left'><?php echo $r1['date_of_birth'];?></td>
													<td align='left'><input type='date' name="udob" value="<?php echo $r1['date_of_birth'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Pan Card No</td>
													<td align='left'><?php echo $r1['pancard_no'];?></td>
													<td align='left'><input type='text' name="upan" value="<?php echo $r1['pancard_no'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Bank Name</td>
													<td align='left'><?php echo $r1['bank'];?></td>
													<td align='left'><input type='text' name="ubank" value="<?php echo $r1['bank'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Bank Account No</td>
													<td align='left'><?php echo $r1['account'];?></td>
													<td align='left'><input type='text' name="uacc" value="<?php echo $r1['account'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>IFSC Code</td>
													<td align='left'><?php echo $r1['ifsc'];?></td>
													<td align='left'><input type='text' name="uifsc" value="<?php echo $r1['ifsc'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Name</td>
													<td align='left'><?php echo $r1['business_name'];?></td>
													<td align='left'><input type='text' name="ubname" value="<?php echo $r1['business_name'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Address</td>
													<td align='left'><?php echo $r1['business_address'];?></td>
													<td align='left'><input type='text' name="ubadd" value="<?php echo $r1['business_address'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>GST No</td>
													<td align='left'><?php echo $r1['gst'];?></td>
													<td align='left'><input type='text' name="ugst" value="<?php echo $r1['gst'];?>"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Logo</td>
													<td align='left'><img height="60" src="<?php echo $r1['business_logo'];?>"/></td>
													<td align='left'><input type='file' name="ulogo" /></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td></td>
													<td></td>
													<td align='left'><input type="submit" name="submit" value="Request Update" /></td>
												</tr>
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
