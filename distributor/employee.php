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
				url: "../functions/_ajax-ShowDistOfState.php",
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
									<div class="panel-heading bgheadcolor">
										Add New Employee
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="employee-code.php" method="post" onsubmit="return validateUser()">
											<table>
												<tr>
													<td align="left">Name<br><input required name="UserName" size="30" /></td>
													<td width="75"></td>
													<td align="left">Aadhar Number<br><input required type="number" id="AadharNumber" name="AadharNumber" size="30" /></td>
													<td width="75"></td>	
													<td align="left">Email<br><input required type="email" id="Email" name="Email" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Mobile Number<br><input required type="number" id="MobileNumber" name="MobileNumber" size="30" /></td>
													<td width="75"></td>
													<td align="left">Password<br><input required type="password" id="Password" name="Password" size="30" /></td>
													<td width="75"></td>
													<td align="left">Confirm Password<br><input required type="password" id="ConfirmPassword" name="ConfirmPassword" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" colspan="5">Address<br><input required name="Address" size="131" />
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">State<br>
													<select name='StateName' id='StateName' required onchange="ShowDistOfState()">
														<option value=''>Select State</option>
														<?php 
														$query="SELECT state_id,state_name FROM all_state where state_status=1 order by state_name";
														$result=mysql_query($query);
														$num_rows = mysql_num_rows($result);
														if($num_rows>0)
														{
															while($r = mysql_fetch_assoc($result)) {
														?>
														<option value='<?php echo $r['state_id']; ?>'><?php echo $r['state_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
													</td>
													<td width="75"></td>
													<td align="left" id="LoadDist">Distt.<br>
													<select name='DisttName' required id='DisttName'>
														<option value=''>Select Distt.</option>
													</select>
													</td>
													<td width="75"></td>
													<td align="left">City<br><input required name="City" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Pin Code<br><input required type="number" id="PinCode" name="PinCode" size="30" /></td>
													<td width="75"></td>
													<td align="left">Guardian / Spouse Name<br><input required name="GsName" size="30" /></td>
													<td width="75"></td>
													<td align="left">Guardian / Spouse Mobile Name<br><input required type="number" id="GsMobileNumber" name="GsMobileNumber" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td colspan="5" align="center"><input type="submit" value="Save" /></td>
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
