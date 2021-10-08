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
									<?php
									$kycuid="kyc";
									if(isset($_REQUEST['kycuid']) && !empty($_REQUEST['kycuid']))
									$kycuid=$_REQUEST['kycuid'];
									if($kycuid=="kyc")
									echo "<script>document.location.href='kyc-status.php';</script>";
									
									$query1="SELECT * FROM child_user where user_id='$kycuid'";
									$result1=mysql_query($query1);									
									$num_rows1 = mysql_num_rows($result1);
									if($num_rows1==0)
									echo "<script>document.location.href='kyc-status.php';</script>";
									while($r1 = mysql_fetch_assoc($result1)) 
									{
										$kuser_id=$r1['user_id'];
										$kuser_name=$r1['user_name'];
										$kaadhar_no=$r1['aadhar_no'];
										$ke_mail=$r1['e_mail'];
										$kaddress=$r1['address'];
										$kuser_contact_no=$r1['user_contact_no'];
										$kcity_name=$r1['city_name'];
										$kdistt_id=$r1['distt_id'];
										$kstate_id=$r1['state_id'];
										$karea_pin_code=$r1['area_pin_code'];
									}
									?>
									<div class="panel-heading bgheadcolor">
										KYC Upload : (for User ID : <?php echo $kycuid;?>)
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="kyc-upload-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateKyc()">
											<table>
												<tr>
													<td align="left" width="200">User ID</td>
													<td align="left" width="200"><?php echo $kuser_id;?></td>
													<td width="100"></td>	
													<td align="left" width="200">Business Name</td>
													<td align="left"><input size="35" required name="biz_name" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Name</td>
													<td align="left"><?php echo $kuser_name;?></td>
													<td width="75"></td>	
													<td align="left">Gender</td>
													<td align="left"><input type="hidden" name="kuserid" value="<?php echo $kuser_id;?>" />
														<select name="sex" required>
															<option></option>
															<option value='1'>Male</option>
															<option value='0'>Female</option>
															<option value='2'>Trans Gender</option>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Aadhar Number</td>
													<td align="left"><?php echo $kaadhar_no;?></td>
													<td width="75"></td>
													<td align="left">PAN CARD Number</td>
													<td align="left"><input required id="pan_no" size="35" name="pan_no" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Email</td>
													<td align="left"><?php echo $ke_mail;?></td>
													<td width="75"></td>
													<td align="left">Date of Birth</td>
													<td align="left"><input required type="date" name="dob" size="35" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" valign="top">Address</td>
													<td align="left"><?php echo $kaddress;?></td>
													<td width="75"></td>	
													<td valign="top" align="left">
													Uploaded by<br>
													Uploader Name<br>
													Uploded On</b>
													</td>	
													<td valign="top" align="left">
													<b><?php echo $user_id;?></b><br>
													<b><?php echo $user_name;?></b><br>
													<b><?php echo $datetime_time;?></b>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Mobile Number</td>
													<td align="left"><?php echo $kuser_contact_no;?></td>
													<td width="75"></td>
													<td align="left"><b>Upload Documents</b></td>
													<td align="left">(JPG, JPEG, PNG, GIF : max size 1 MB)</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">City</td>
													<td align="left"><?php echo $kcity_name;?></td>
													<td width="75"></td>
													<td align="left">PAN Card</td>
													<td align="left"><input type="file" name="pan" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Distt.</td>
													<td align="left"><?php echo $kdistt_id;?></td>
													<td width="75"></td>
													<td align="left">Passport Size Photo</td>
													<td align="left"><input type="file" name="photo" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">State.</td>
													<td align="left"><?php echo $kstate_id;?></td>
													<td width="75"></td>
													<td align="left">Address Proof 1</td>
													<td align="left"><input type="file" name="proofo" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Pin Code</td>
													<td align="left"><?php echo $karea_pin_code;?></td>
													<td width="75"></td>
													<td align="left">Address Proof 2</td>
													<td align="left"><input type="file" name="prooft" /></td>
												</tr>
												<!--
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="center"><img src="../img/document.png"/><br>PAN CArd</td>
													<td align="center"><img src="../img/document.png"/><br>Passport Size Photo</td>
													<td width="75"></td>
													<td align="center"><img src="../img/document.png"/><br>Address Proof 1</td>
													<td align="center"><img src="../img/document.png"/><br>Address Proof 2												
													</td>
												</tr>
												-->
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left"></td>
													<td align="left"></td>
													<td width="75"></td>
													<td align="left"></td>
													<td align="left"><input type="submit" /></td>
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
