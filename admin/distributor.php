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
				}	 
			});
		}
		</script>
		<script>
		function ShowParentHierarchy()
		{
			var HierarchyName = $("#HierarchyName").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "../functions/_ajax-ShowParentHierarchy.php",
				data: {'HierarchyName': HierarchyName },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#LoadDist2").html(data);
				}	 
			});			
			$("#ParentHierarchyName").val(0);
			ShowParentByHierarchy();
		}
		</script>
		<script>
		function ShowParentByHierarchy()
		{
			var ParentHierarchyName = $("#ParentHierarchyName").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "../functions/_ajax-ShowParentByHierarchy.php",
				data: {'ParentHierarchyName': ParentHierarchyName },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#LoadDist3").html(data);
				}	 
			});
		}
		</script>
		<script>
		function ShowSecurityFee()
		{
			var soamts = $("#soamts").val();
			soamts=parseInt(soamts);
			data="";
			for(i=soamts;i<=10000;)
			{
				data=data+"<option>"+i+"</option>";
				i=i+1000;
			}
			$("#seamts").html(data);
		}
		</script>
	</head>
	<body onload="ShowSecurityFee()"><!--oncontextmenu="return false"-->
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
										Add Team
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="distributor-code.php" method="post" onsubmit="return validateDistributor()">
											<table>
												<tr>
													<td align="left">Name <b style='color:red'>*</b><br><input required name="UserName" size="30" /></td>
													<td width="75"></td>
													<td align="left">Aadhar Number <b style='color:red'>*</b><br><input required type="number" id="AadharNumber" name="AadharNumber" size="30" /></td>
													<td width="75"></td>	
													<td align="left">Email <b style='color:red'>*</b><br><input required type="email" id="Email" name="Email" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Mobile Number <b style='color:red'>*</b><br><input required type="number" id="MobileNumber" name="MobileNumber" size="30" /></td>
													<td width="75"></td>
													<td align="left">Password <b style='color:red'>*</b><br><input required type="password" id="Password" name="Password" size="30" /></td>
													<td width="75"></td>
													<td align="left">Confirm Password <b style='color:red'>*</b><br><input required type="password" id="ConfirmPassword" name="ConfirmPassword" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" colspan="5">Address <b style='color:red'>*</b><br><input required name="Address" size="131" />
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">State <b style='color:red'>*</b><br>
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
													<td align="left" id="LoadDist">Distt. <b style='color:red'>*</b><br>
													<select name='DisttName' required id='DisttName'>
														<option value=''>Select Distt.</option>
													</select>
													</td>
													<td width="75"></td>
													<td align="left">City <b style='color:red'>*</b><br><input required name="City" size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Pin Code <b style='color:red'>*</b><br><input required type="number" id="PinCode" name="PinCode" size="30" /><input required type="hidden" id="GsMobileNumber" name="GsMobileNumber" value="1000000000" size="30" />
													</td>
													<td width="75"></td>
													<!--
													<td align="left">Guardian / Spouse Name<br><input required name="GsName" size="30" /></td>
													<td width="75"></td>
													-->
													<td align="left">Software Amount<br>
														<select name='soamt' id='soamts' onchange="ShowSecurityFee()" >
															<?php
															for($mark=0;$mark<=10000;)
															{
																echo "<option>$mark</option>";
																$mark+=1000;
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Security Amount<br>
														<select name='seamt' id='seamts' >
															<?php
															for($mark=0;$mark<=10000;)
															{
																echo "<option>$mark</option>";
																$mark+=1000;
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Designation / Hierarchy <b style='color:red'>*</b><br>
														<select name='HierarchyName' required id='HierarchyName' onchange="ShowParentHierarchy()">
															<option value=''>Select Designation / Hierarchy</option>
															<?php 
															$query="SELECT hierarchy_id,hierarchy_name FROM child_hierarchy where hierarchy_id not in(0,1,11) and status=1 order by hierarchy_id";
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
													<td align="left" id="LoadDist2">Parent Hierarchy <b style='color:red'>*</b><br>
														<select name='ParentHierarchyName' required id='ParentHierarchyName'>
															<option value=''>Select Parent Heirarchy</option>
														</select>
													</td>
													<td width="75"></td>
													<td align="left" id="LoadDist3">Parent Name <b style='color:red'>*</b><br>
														<select name='ParentNameByHierarchy' required id='ParentNameByHierarchy'>
															<option value=''>Select Parent Name</option>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td colspan="5" align="center"><input type="submit" /></td>
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
