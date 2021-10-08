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
										<form method="post">
											<?php
												include_once('../_common-admin.php');
												if(isset($_POST['submit1']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uname']) && $_POST['uname']!="")
													{
														$user_name=$_POST['uname'];
														$qry="update child_user set user_name='$user_name' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit2']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uno']) && $_POST['uno']!="")
													{
														$user_contact_no=$_POST['uno'];
														$qry="update child_user set user_contact_no='$user_contact_no' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit3']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uadhar']) && $_POST['uadhar']!="")
													{
														$aadhar_no=$_POST['uadhar'];
														$qry="update child_user set aadhar_no='$aadhar_no' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit4']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uemail']) && $_POST['uemail']!="")
													{
														$e_mail=$_POST['uemail'];
														$qry="update child_user set e_mail='$e_mail' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit5']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uamt']) && $_POST['uamt']!="")
													{
														$sec_amount=$_POST['uamt'];
														$qry="update child_user set sec_amount='$sec_amount' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit6']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['usex']) && $_POST['usex']!="")
													{
														$gender=$_POST['usex'];
														$qry="update child_user set gender='$gender' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit7']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['udob']) && $_POST['udob']!="")
													{
														$date_of_birth=$_POST['udob'];
														$qry="update child_user set date_of_birth='$date_of_birth' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit8']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['upan']) && $_POST['upan']!="")
													{
														$pancard_no=$_POST['upan'];
														$qry="update child_user set pancard_no='$pancard_no' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit9']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['ubank']) && $_POST['ubank']!="")
													{
														$bank=$_POST['ubank'];
														$qry="update child_user set bank='$bank' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit10']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uacc']) && $_POST['uacc']!="")
													{
														$account=$_POST['uacc'];
														$qry="update child_user set account='$account' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit11']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['uifsc']) && $_POST['uifsc']!="")
													{
														$ifsc=$_POST['uifsc'];
														$qry="update child_user set ifsc='$ifsc' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit12']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['ubname']) && $_POST['ubname']!="")
													{
														$business_name=$_POST['ubname'];
														$qry="update child_user set business_name='$business_name' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit13']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['ubadd']) && $_POST['ubadd']!="")
													{
														$business_address=$_POST['ubadd'];
														$qry="update child_user set business_address='$business_address' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit14']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['ugst']) && $_POST['ugst']!="")
													{
														$gst=$_POST['ugst'];
														$qry="update child_user set gst='$gst' where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												if(isset($_POST['submit15']))
												{
													$uid=$_POST['uid'];
													if(isset($_POST['ulogo']) && $_POST['ulogo']!="")
													{
														$business_logo=$_POST['ulogo'];
														$qry="update child_user set business_logo='$business_logo', logo_verified=1 where user_id='$uid'";
														mysql_query($qry);
														$request_id=$_POST['request_id'];
														$qry="update child_user_update_request set logo_verified=1, update_status=1, updated_on='$datetime_time' where request_id='$request_id'";
														mysql_query($qry);
													}
												}
												
												$uid=$_REQUEST['uid'];
												$rid=$_REQUEST['rid'];
												$query1="SELECT * FROM child_user where user_id='$uid'";
												$result1=mysql_query($query1);
												$num_rows1 = mysql_num_rows($result1);
												if($num_rows1>0)
												{
													while($r1 = mysql_fetch_assoc($result1)) 
													{
														$query2="select * from child_user_update_request where user_id='$uid' and request_id='$rid';";
														$result2=mysql_query($query2);
														while($r2 = mysql_fetch_assoc($result2)) 
														{
											?>
											<table>
												<tr>
													<td align='left' width='200'>USER ID</td>
													<td align='left' width='200'><?php echo $r1['user_id'];?></td>
													<td align='left' width='300'>
														<input type='hidden' name="uid" value="<?php echo $r1['user_id'];?>"/><?php echo $r2['user_id'];?>
														<input type='hidden' name="request_id" value="<?php echo $r2['request_id'];?>"/>
													</td>
													<td></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Name</td>
													<td align='left'><?php echo $r1['user_name'];?></td>
													<td align='left'><input type='text' name="uname" value="<?php echo $r2['user_name'];?>"/></td>
													<td><input type="submit" name="submit1" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Mobile Number</td>
													<td align='left'><?php echo $r1['user_contact_no'];?></td>
													<td align='left'><input type='number' name="uno" value="<?php echo $r2['user_contact_no'];?>"/></td>
													<td><input type="submit" name="submit2" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Aadhar Number</td>
													<td align='left'><?php echo $r1['aadhar_no'];?></td>
													<td align='left'><input type='number' name="uadhar" value="<?php echo $r2['aadhar_no'];?>"/></td>
													<td><input type="submit" name="submit3" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Email</td>
													<td align='left'><?php echo $r1['e_mail'];?></td>
													<td align='left'><input type='email' name="uemail" value="<?php echo $r2['e_mail'];?>"/></td>
													<td><input type="submit" name="submit4" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Security Amount</td>
													<td align='left'><?php echo $r1['sec_amount'];?></td>
													<td align='left'>
														<select name='uamt'>
															<?php
															for($mark=$r2['sec_amount'];$mark<=10000;)
															{
																if($r2['sec_amount']==$mark)
																echo "<option selected>$mark</option>";
																else
																echo "<option>$mark</option>";
																$mark+=1000;
															}
															?>
														</select>
													</td>
													<td><input type="submit" name="submit5" value="Update This Value"/></td>
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
															<option value='1' <?php if($r2['gender']==1) echo "selected"; ?>>Male</option>
															<option value='0' <?php if($r2['gender']==0) echo "selected"; ?>>Female</option>
															<option value='2' <?php if($r2['gender']==2) echo "selected"; ?>>Trans Gender</option>
														</select>
													</td>
													<td><input type="submit" name="submit6" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Date of Birth</td>
													<td align='left'><?php echo $r1['date_of_birth'];?></td>
													<td align='left'><input type='date' name="udob" value="<?php echo $r2['date_of_birth'];?>"/></td>
													<td><input type="submit" name="submit7" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Pan Card No</td>
													<td align='left'><?php echo $r1['pancard_no'];?></td>
													<td align='left'><input type='text' name="upan" value="<?php echo $r2['pancard_no'];?>"/></td>
													<td><input type="submit" name="submit8" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Bank Name</td>
													<td align='left'><?php echo $r1['bank'];?></td>
													<td align='left'><input type='text' name="ubank" value="<?php echo $r2['bank'];?>"/></td>
													<td><input type="submit" name="submit9" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Bank Account No</td>
													<td align='left'><?php echo $r1['account'];?></td>
													<td align='left'><input type='text' name="uacc" value="<?php echo $r2['account'];?>"/></td>
													<td><input type="submit" name="submit10" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>IFSC Code</td>
													<td align='left'><?php echo $r1['ifsc'];?></td>
													<td align='left'><input type='text' name="uifsc" value="<?php echo $r2['ifsc'];?>"/></td>
													<td><input type="submit" name="submit11" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Name</td>
													<td align='left'><?php echo $r1['business_name'];?></td>
													<td align='left'><input type='text' name="ubname" value="<?php echo $r2['business_name'];?>"/></td>
													<td><input type="submit" name="submit12" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Address</td>
													<td align='left'><?php echo $r1['business_address'];?></td>
													<td align='left'><input type='text' name="ubadd" value="<?php echo $r2['business_address'];?>"/></td>
													<td><input type="submit" name="submit13" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>GST No</td>
													<td align='left'><?php echo $r1['gst'];?></td>
													<td align='left'><input type='text' name="ugst" value="<?php echo $r2['gst'];?>"/></td>
													<td><input type="submit" name="submit14" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr>
													<td align='left'>Business Logo</td>
													<td align='left'><img height="60" src="<?php echo $r1['business_logo'];?>"/></td>
													<td align='left'><img height="60" src="<?php echo $r2['business_logo'];?>"/><input type="hidden" value="<?php echo $r2['business_logo'];?>" name="ulogo"/></td>
													<td><input type="submit" name="submit15" value="Update This Value"/></td>
												</tr>
												<tr><td align='left'>&nbsp;</td></tr>
												<tr><td align='left'>&nbsp;</td></tr>
											</table>
											<?php
														}
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
