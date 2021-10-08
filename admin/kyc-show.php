<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
		<script>
		function ShowDistOfState()
		{
			var StateName = $("#StateName").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "../functions/_ajax-ShowDistOfState2.php",
				data: {'StateName': StateName },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#LoadDist").html(data);
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle error
					//alert(xhr+":"+textStatus+":"+errorThrown);
				}	 
			});
		}
		function fetchGeo()
		{
			var pinCode = $("#pinCode").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "../functions/_ajax-geo.php",
				data: {'pinCode': pinCode },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#geoLoc").val(data);
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle error
					//alert(xhr+":"+textStatus+":"+errorThrown);
				}	 
			});
		}
		</script>
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
										$cur_stat=$r1['kyc_status'];
										$geos=$r1['geo_location'];
										$usr_rem=$r1['user_remarks'];
									}
									?>
									<div class="panel-heading bgheadcolor">
										KYC Upload : (for User ID : <?php echo $kuser_id;?>)
									</div>
									<?php
									if($cur_stat==3)
									{
									?>
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
											<tr>
												<td align="left">Geo by PinCode</td>
												<td align="left"><?php echo $geos;?></td>
												<td width="75"></td>
												<td align="left" colspan='2'><b>User Remarks : </b><?php echo $usr_rem;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
										</table>
									</div>
									<?php
									}
									else
									{
									?>
									<div class="panel-body panel-primary text-center">
										<form action="kyc-show-codes.php" method="post">
										<table>
											<tr>
												<td align="left" width="200">Name</td>
												<td align="left" width="200">
													<input name="tuid" type="hidden" value="<?php echo $kuser_id;?>"/>
													<input name="tuname" required value="<?php echo $kuser_name;?>"/>
												</td>
												<td width="100"></td>	
												<td align="left" width="200">Business Name</td>
												<td align="left"><input name="tubname" value="<?php echo $kbiz_name;?>"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Mobile Number</td>
												<td align="left"><input name="tumob" type="number" required value="<?php echo $kuser_contact_no;?>"/></td>
												<td width="75"></td>	
												<td align="left">Gender</td>
												<td align="left">
													<select name="tusex" required>
														<option <?php if($ksex=="Male") echo "selected";?> value='1'>Male</option>
														<option <?php if($ksex=="Female") echo "selected";?> value='0'>Female</option>
														<option <?php if($ksex=="Trans Gender") echo "selected";?> value='2'>Trans Gender</option>
													</select>
												</td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Aadhar Number</td>
												<td align="left"><input type="number" name="tuadhar" value="<?php echo $kaadhar_no;?>"/></td>
												<td width="75"></td>
												<td align="left">PAN CARD Number</td>
												<td align="left"><input required name="tupan" value="<?php echo $kpan_no;?>"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Email</td>
												<td align="left"><input name="tuemail" value="<?php echo $ke_mail;?>"/></td>
												<td width="75"></td>
												<td align="left">Date of Birth</td>
												<td align="left"><input name="tudob" type="date" value="<?php echo $kdob;?>"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left" valign="top">Address</td>
												<td align="left" colspan="4"><input name="tuadd" size='82' value="<?php echo $kaddress;?>"/></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">State.</td>
												<td align="left">
													<select name='StateName' id='StateName' required onchange="ShowDistOfState()">
														<?php 
														$query="SELECT state_id,state_name FROM all_state where state_status=1 order by state_name";
														$result=mysql_query($query);
														$num_rows = mysql_num_rows($result);
														if($num_rows>0)
														{
															while($r = mysql_fetch_assoc($result)) {
														?>
														<option <?php if($kstate_id==$r['state_id']) echo "selected";?> value='<?php echo $r['state_id']; ?>'><?php echo $r['state_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												<td width="75"></td>
												<td align="left">Distt.</td>
												<td align="left" id="LoadDist">
													<select name='DisttName' required id='DisttName'>
														<?php 
														$query="SELECT distt_id,distt_name FROM all_state_distt where state_id='$kstate_id' order by distt_name";
														$result=mysql_query($query);
														$num_rows = mysql_num_rows($result);
														if($num_rows>0)
														{
															while($r = mysql_fetch_assoc($result)) {
														?>
														<option <?php if($kdistt_id==$r['distt_id']) echo "selected";?> value='<?php echo $r['distt_id']; ?>'><?php echo $r['distt_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
													</td></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">City</td>
												<td align="left"><input required name="tucity" value="<?php echo $kcity_name;?>"/></td>
												<td width="75"></td>
												<td align="left">Pin Code</td>
												<td align="left">
													<input name="tupincode" type="number" required id="pinCode" value="<?php echo $karea_pin_code;?>"/>
													<input type="button" onclick="fetchGeo()" value="Fetch Geo" />
												</td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Geo by PinCode</td>
												<td align="left"><input name="tugeo" type="text" style="border:1px solid #aaaaaa;" value="<?php echo $geos;?>" readonly required id="geoLoc"/></td>
												<td width="75"></td>
												<td align="left" colspan='2'><b>User Remarks : </b><?php echo $usr_rem;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td colspan='4'></td>
												<td align="left"><input type="submit" name="UpdateProfile" value="Update User Profile" /></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
										</table>
										</form>
									</div>
									<?php
									}
									?>
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
										<form action="kyc-show-code.php" method="post">
											<table>
												<tr>
													<td align="left" width="200">Update Document Status</td>
													<td align="left" width="200">
														<select name="a1" required>
															<option value=''>Kyc Status</option>
															<option value='0'>Pending</option>
															<option value='3'>Verified</option>
														</select>
													</td>
													<td width="25"></td>
													<td align="left" colspan="2">
													Remarks &nbsp;&nbsp;
													<input name="a2" type="hidden" value="<?php echo $kuser_id; ?>" />
													<select name="a3" required>
															<option value=''>Remarks</option>
															<option>Incomplete Documents</option>
															<option>Done</option>
													&nbsp;&nbsp;&nbsp;<input type="submit" value="Update KYC Status" name="a4" /></td>
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
