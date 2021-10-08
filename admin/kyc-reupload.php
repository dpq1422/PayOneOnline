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
									include_once '../functions/_state.php';
									include_once '../functions/_distt.php';
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
										$kbiz_name=$r1['business_name'];
										$ksex=$r1['gender'];
										if($ksex==1)
											$ksex="Male";
										else if($ksex==0)
											$ksex="Female";
										else if($ksex==2)
											$ksex="Trans Gender";
										
										$kpan_no=$r1['pancard_no'];
										$kdob=$r1['date_of_birth'];
									}
									?>
									<div class="panel-heading bgheadcolor">
										KYC Re-Upload : (for User ID : <?php echo $kycuid;?>)
									</div>
									<div class="panel-body panel-primary text-center">
										<table>
											<tr>
												<td align="left" width="200">Name</td>
												<td align="left" width="200"><?php echo $kuser_name;?></td>
												<td width="100"></td>	
												<td align="left" width="200">Business Name</td>
												<td align="left"><?php echo $kbiz_name;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Mobile Number</td>
												<td align="left"><?php echo $kuser_contact_no;?></td>
												<td width="75"></td>	
												<td align="left">Gender</td>
												<td align="left"><?php echo $ksex;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Aadhar Number</td>
												<td align="left"><?php echo $kaadhar_no;?></td>
												<td width="75"></td>
												<td align="left">PAN CARD Number</td>
												<td align="left"><?php echo $kpan_no;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Email</td>
												<td align="left"><?php echo $ke_mail;?></td>
												<td width="75"></td>
												<td align="left">Date of Birth</td>
												<td align="left"><?php echo $kdob;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left" valign="top">Address</td>
												<td align="left" colspan="4"><?php echo $kaddress;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">City</td>
												<td align="left"><?php echo $kcity_name;?></td>
												<td width="75"></td>
												<td align="left">Distt.</td>
												<td align="left"><?php echo show_distt($kdistt_id);?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">State.</td>
												<td align="left"><?php echo show_state($kstate_id);?></td>
												<td width="75"></td>
												<td align="left">Pin Code</td>
												<td align="left"><?php echo $karea_pin_code;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
										</table>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Date Time</th>
													<th>Activity</th>
													<th>Remarks</th>
													<th>Action</th>
												</tr>
										<?php 
											$query="SELECT * FROM child_kyc_status where user_id='$kycuid' order by kyc_id desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{			
												$i=0;
												//$userstatus="";
												while($rs = mysql_fetch_assoc($result)) {
												$i++;
												if($i%2!=0)
												$style="style='background-color:white;'";
												else
												$style="style='background-color:#e5e5e5;'";
												
												$kycstatus=$rs['status'];
												if($kycstatus==0)
												$kycstatus="Pending";
												else if($kycstatus==1)
												$kycstatus="Uploaded";
												else if($kycstatus==2)
												$kycstatus="Re-Uploaded";
												else if($kycstatus==3)
												$kycstatus="Verified";
												else if($kycstatus==4)
												$kycstatus="Rejected";
											
												$file="";
												if(isset($rs['doc_1']))
												$file=$rs['doc_1'];
												if(isset($rs['doc_2']))
												$file=$rs['doc_2'];
												if(isset($rs['doc_3']))
												$file=$rs['doc_3'];
												if(isset($rs['doc_4']))
												$file=$rs['doc_4'];
											
												$file="<a href='../kyc/$file.jpg' style='color:#cc5801;' target='_blank'>$file</a>";
										?>
													<tr <?php echo $style;?>>
														<td><?php echo $i;?></td>
														<td><?php echo $rs['uploaded_at'];?></td>
														<td><?php echo $kycstatus;?></td>
														<td><?php echo $rs['remarks'] . $rs['uploaded_by_user_id'];?></td>
														<td><?php echo $file;?></td>
													</tr>
										<?php
												}
											}
											else
											{
										?>
													<tr>No Records Available</tr>
										<?php
											}
										?>
											</tbody>
										</table>
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="kyc-reupload-code.php" method="post" enctype="multipart/form-data" onsubmit="return validateKyc()">
											<table>
												<tr>
													<td align="left" width="200">Business Name</td>
													<td align="left"><input value="<?php echo $kbiz_name;?>" size="35" name="biz_name" /></td>
													<td width="100"></td>	
													<td align="left" width="200">Gender</td>
													<td align="left">
													<input type="hidden" name="kuserid" value="<?php echo $kuser_id;?>" />
														<select name="sex" required>
															<option></option>
															<option value='1' <?php if($ksex==1) echo "selected";?>>Male</option>
															<option value='0' <?php if($ksex==0) echo "selected";?>>Female</option>
															<option value='2' <?php if($ksex==2) echo "selected";?>>Trans Gender</option>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">PAN CARD Number</td>
													<td align="left"><input size="35" required value="<?php echo $kpan_no;?>" id="pan_no" name="pan_no" /></td>
													<td width="75"></td>	
													<td align="left">Date of Birth</td>
													<td align="left"><input type="date" value="<?php echo $kdob;?>" name="dob" size="35" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left"><b>Upload Documents</b></td>
													<td align="left">(JPG, JPEG, PNG, GIF : max size 1 MB)</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">PAN CARD Number</td>
													<td align="left"><input type="file" name="pan" /></td>
													<td width="75"></td>	
													<td align="left">Passport Size Photo</td>
													<td align="left"><input type="file" name="photo" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Address Proof 1</td>
													<td align="left"><input type="file" name="proofo" /></td>
													<td width="75"></td>	
													<td align="left">Address Proof 2</td>
													<td align="left"><input type="file" name="prooft" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="center" colspan="5"><input type="submit" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
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
