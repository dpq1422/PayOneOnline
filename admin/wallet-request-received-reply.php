<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script>
		var submitbtn=0;
		function sbmtbtn()
		{
			submitbtn++;
			if(submitbtn==1)
				document.getElementById("frmReqss").submit();
			document.getElementById("req_btn").setAttribute("disabled","disabled");
		}
		function valid_req()
		{
			var reqst=document.getElementById("reqst").value;
			var reqrm=document.getElementById("reqrm").value;
			var err="";
			if(reqst=="")
				err+="\n - Request Status is required";
			if(reqrm=="")
				err+="\n - Admin Remarks is required";
			if(err=="")
				sbmtbtn();
			else
				alert(err);
		}
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
				url: "../functions/_ajax-ShowParentHierarchy2.php",
				data: {'HierarchyName': HierarchyName },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#LoadDist2").html(data);
				}	 
			});
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
				url: "../functions/_ajax-ShowParentByHierarchy2.php",
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
										Wallet Request Reply
									</div>
									<div class="panel-body panel-primary text-center">
									<?php
									if(isset($_REQUEST['msg']))
									{
									?>
									<p style="color:red;text-align:left;">Your Wallet Balance is less than requested transferring amount.<br><br></p>
									<?php
									}
									?>
										<form id="frmReqss" method="post" action="wallet-request-received-reply-code.php">
										<?php
										
										include('../_common-admin.php');
										include('../functions/_ShowAdminBankClient.php');
										include('../functions/_my_uname.php');
										$uid=$_REQUEST['uid'];
										$request_id=$_REQUEST['rid'];
										$u_name=show_my_uname($uid);
										
										$query_r="SELECT * from child_wallet_requests where request_id='$request_id' and user_id='$uid';";
										$result_r=mysql_query($query_r);
										$deposite_date="";
										$company_account="";
										$payment_mode="";
										$ref_no="";
										$deposit_amount="";
										$remarks="";
										$userid="";
										$req_st="";
										$bid=0;
										$pid=0;
										$_SESSION['dr_amount']=0;
										while($rs_r = mysql_fetch_assoc($result_r)) 
										{
											$deposite_date=$rs_r['deposite_date'];
											$company_account=show_admin_bank_client(1001,$rs_r['bank_id']);
											$payment_mode=$rs_r['payment_mode'];
											if($payment_mode==1)
											$payment_mode="Demand Draft";
											else if($payment_mode==2)
											$payment_mode="Cheque";
											else if($payment_mode==3)
											$payment_mode="NEFT / RTGS";
											else if($payment_mode==4)
											$payment_mode="IMPS";
											else if($payment_mode==5)
											$payment_mode="Cash Deposit";
											else if($payment_mode==6)
											$payment_mode="CDM - Cash Deposit Machine";
											
											$ref_no=$rs_r['ref_no'];
											$deposit_amount=$rs_r['deposit_amount'];
											$remarks=$rs_r['remarks'];
											$userid=$rs_r['user_id'];
											$req_st=$rs_r['request_status'];
											$_SESSION['dr_amount']=$deposit_amount;
											$bid=$rs_r['bank_id'];
											$pid=$rs_r['payment_mode'];
										}
										
										?>
											<table>
												<tr>
													<td align="left">Request ID<br><input readonly name="reqid" value="<?php echo $request_id; ?>" size="30" /></td>
													<td width="75"></td>
													<td align="left">User Name<br>
													<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
													<input type="hidden" name="bid" value="<?php echo $bid; ?>" />
													<input type="hidden" name="pid" value="<?php echo $pid; ?>" />
													<input value="<?php echo $u_name; ?>" readonly size="30" /></td>
													<td width="75"></td>	
													<td align="left">Deposite Date<br><?php echo $deposite_date; ?></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Company Account<br><input readonly value="<?php echo $company_account; ?>"  size="30" /></td>
													<td width="75"></td>
													<td align="left">Payment Mode<br><input readonly value="<?php echo $payment_mode; ?>"  size="30" /></td>
													<td width="75"></td>
													<td align="left">Ref No<br><input readonly value="<?php echo $ref_no; ?>"  size="30" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Deposit Amount<br><input required name="deposit_amount" readonly value="<?php echo $deposit_amount; ?>"  size="30" />
													<td width="75"></td>
													<td align="left" colspan="3">Remarks<br><?php echo $remarks; ?></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
								<?php								
								if($req_st==1)
								{
								?>
								<tr>
									<td align="left">Request Status
										<br>
										<select name="request_status" id='reqst' required>
											<option></option>
											<option value="2">Transferred</option>
											<option value="3">Request Rejected</option>
										</select>
									</td>
									<td width="75"></td>
									<td align="left" colspan="3">Remarks<br><input id='reqrm' name="filled_remarks" size="71" /></td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td colspan="5" align="center"><input id="req_btn" onclick='valid_req()' type="submit" /></td>
								</tr>
								<?php
								}
								else
								{
									$req_sts="";
									if($req_st==2)
									$req_sts="Transferred";
									else if($req_st==3)
									$req_sts="Rejected";
								?>
								<tr>
									<td align="left">Request Status<br><?php echo $req_sts; ?></td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<?php
								}
								
								?>
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
