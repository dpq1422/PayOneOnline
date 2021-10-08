<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
		<script>
		var submitbtn=0;
		function sbmtbtn()
		{
			submitbtn++;
			if(submitbtn==1)
			document.getElementById("frmSendRetailerRequest").submit();
			
			document.getElementById("btnSubmitButton").setAttribute("disabled","disabled");
			document.getElementById("btnSubmitButton2").setAttribute("disabled","disabled");
		}
		function checkformfill()
		{
			var result=validateAmount();
			if(result)
				sbmtbtn();
		}
		function checkformfill2()
		{
			var result=validateAmount2();
			if(result)
				sbmtbtn();
		}
		function ShowPaymentMode()
		{
			var bank_id=document.getElementById("bank_id").value;
			var PaymentMode=document.getElementById("PaymentMode").value;
			var res="<input id='ref_no' name='ref_no' required type='hidden' />";
			
			
			if(PaymentMode==0)
				res="<input id='ref_no' name='ref_no' required type='hidden' />";
			if(PaymentMode==1)
				res="DD No. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==2)
				res="Cheque No. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==3)
				res="Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==4)
				res="Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==6 && bank_id==1)
				res="<b style='color:red;'>Rs. 25/- CDM deposit charges will be charged.</b><br>Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==6 && bank_id==2)
				res="<b style='color:red;'>Submit CDM Location with Ref.No. for fast approval.</b><br>CDM Location ref.No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==5 && bank_id==1)
				res="<b style='color:red;' id='SbiChg'>Rs. 118/- Cash deposit charges will be charged.</b><br>Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==5 && bank_id==2)
				res="<b style='color:red;'>Submit Branch Name with Ref.No. for fast approval.</b><br>Branch Name. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			document.getElementById("ResPaymentMode").innerHTML=res;
			SbiChg();
		}
		function SbiChg()
		{
			var bank_id=document.getElementById("bank_id").value;
			var PaymentMode=document.getElementById("PaymentMode").value;
			amt=document.getElementById("filled_amount").value;
			sbi1=118;
			sbi2=0;
			sbi=0;
			if(PaymentMode==5 && bank_id==1)
			{
				sbi2=(amt*.89);
				sbi2=sbi2/1000;
				sbi2=sbi2+59;

				if(sbi1>sbi2)
					sbi=sbi1;
				else
					sbi=sbi2;
			}
			sbi=sbi.toPrecision(4);
			if(sbi!=0)
				document.getElementById("SbiChg").innerHTML="Rs "+sbi+"/- Cash deposit charges will be charged.";
		}
		function requestto()
		{
			document.getElementById("reqto").innerHTML="";
			var request_to=document.getElementById("request_to").value;
			var res="";
			document.getElementById("reqto1").style.display="none";
			document.getElementById("reqto2").style.display="none";
			
			if(request_to==0)
				res="0";
			else if(request_to==100001)
				document.getElementById("reqto1").style.display="block";
			else
				document.getElementById("reqto2").style.display="block";
			
			if(res!="")
			{
				document.getElementById("reqto").innerHTML="Please select Request To";
			}
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
						<marquee style='color:red;font-weight:bold;'>Dear Partner, ICICI Bank Account is closed now. Use only SBI Account for depost / transfer money for fast processing of LIMIT.<br><br></marquee>
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Send Admin Wallet Request
									</div>
									<form action="wallet-request-sent-code.php" method="post" id="frmSendRetailerRequest">
										<div class="panel-body panel-primary text-center">
											<table>
<?php						
		$my_sd=0;
		$my_d=0;
		$qry_my_team="select * from child_user where user_id=$user_id;";
		$res_my_team=mysql_query($qry_my_team);
		while($rs_my_team=mysql_fetch_array($res_my_team))
		{
			$my_sd=$rs_my_team['hierarchy_2_id'];
			$my_d=$rs_my_team['hierarchy_3_id'];
		}	
?>
												<tr>
													<td align="left" width="200">Request To<br><select required name="request_to" id="request_to" onchange="requestto()">
															<option value=''>Select Request To</option>
															<option value='100001'>Company</option>
															<option value='100004'>D-100004</option>
															<option value='100149'>D-100149</option>
<?php
if($my_sd!=0 && $user_id!=$my_sd)
	echo "<option value='$my_sd'>D-$my_sd</option>";
if($my_d!=0 && $user_id!=$my_sd)
	echo "<option value='$my_d'>D-$my_d</option>";
?>
														</select>
													</td>
													<td width="75"></td>
													<td width="200"></td>
													<td width="75"></td>
													<td width="200"></td>
													<td width="75"></td>
													<td width="200"></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr id="reqto1" style="display:none;">
													<td align="left">Date of Deposit<br><input id="deposit_date" name="deposit_date" required type="date" /><br><br>
													Company Account<br><select id="bank_id" name="bank_id" required onchange="ShowPaymentMode()">
															<option></option>
													<?php
													$query_bnk="SELECT * FROM child_bank where account_status=1";
													$result_bnk=mysql_query($query_bnk);	
													while($rs_bnk = mysql_fetch_assoc($result_bnk)) 
													{
													?>
															<option value="<?php echo $rs_bnk['bank_id'];?>"><?php echo $rs_bnk['bank_name']." - ".$rs_bnk['account_no'];?></option>
													<?php
													}
													?>
														</select><br><br>Payment Mode<br><select required name="payment_mode" id="PaymentMode" onchange="ShowPaymentMode()">
															<option></option>
															<option value='5'>Cash Deposit</option>
															<option value='3'>NEFT / RTGS</option>
															<option value='4'>IMPS</option>
															<option value='6'>CDM - Cash Deposit Machine</option>
															<option value='2'>Cheque</option>
															<option value='1'>Demand Draft</option>
														</select><br><br>
														<p id="ResPaymentMode"><input id='ref_no' name='ref_no' required type='hidden' /></p>
														Amount<br><input required id="filled_amount" name="deposit_amount" onkeyup="SbiChg()" type="text" /><br><br>
														Remarks<br><input name="remarks" id="remarks" /><br><br>

														<input type="button" onclick="checkformfill()" id="btnSubmitButton" value="Send" />
													</td>
												</tr>
												<tr id="reqto2" style="display:none;">
													<td align="left" width="200">Request Type<br>
														<select required name="payment_mode2" id="PaymentMode2" class="chosen">
															<option value=''>Select Request Type</option>
															<option value='7'>Cash Value</option>
														</select><br><br>
														Amount<br><input required id="filled_amount2" name="deposit_amount2" type="text" /><br><br>
														Remarks<br><input name="remarks2" id="remarks2" /><br><br>
														<input type="button" onclick="checkformfill2()" id="btnSubmitButton2" value="Send" />
													</td>
													<td width="75" width="75" style="width:75px;"></td>
												</tr>
												<tr><td colspan="7"><p id="reqto" align="left" style="color:red;"></p></td></tr>
											</table>
										</div>
									</form>
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
