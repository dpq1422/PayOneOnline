<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
		<script>
		function ShowPaymentMode()
		{
			var PaymentMode=document.getElementById("PaymentMode").value;
			var res="";
			if(PaymentMode==0)
				res="";
			if(PaymentMode==1)
				res="DD No.<br><input name='ref_no' required type='text' />";
			if(PaymentMode==2)
				res="Cheque No.<br><input name='ref_no' required type='text' />";
			if(PaymentMode==3)
				res="Ref No.<br><input name='ref_no' required type='text' />";
			if(PaymentMode==4 || PaymentMode==6)
				res="Ref No.<br><input name='ref_no' required type='text' />";
			if(PaymentMode==5)
				res="Branch Code.<br><input name='ref_no' required type='text' />";
			document.getElementById("ResPaymentMode").innerHTML=res;
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
										Send Admin Wallet Request
									</div>
									<form action="wallet-request-sent-code.php" method="post" onsubmit="return validateAmount()">
										<div class="panel-body panel-primary text-center">
											<table>
												<tr>
													<td align="left" width="200">Date of Deposit<br><input name="deposit_date" required type="date" /></td>
													<td width="75"></td>
													<td align="left" width="200">Company Account<br><select name="bank_id" required>
															<option></option>
													<?php
													$query_bnk="SELECT * FROM parent_bank where account_status=1";
													$result_bnk=mysql_query($query_bnk);	
													while($rs_bnk = mysql_fetch_assoc($result_bnk)) 
													{
													?>
															<option value="<?php echo $rs_bnk['bank_id'];?>"><?php echo $rs_bnk['bank_name']." - ".$rs_bnk['account_no'];?></option>
													<?php
													}
													?>
														</select></td>
													<td width="75"></td>
													<td align="left" width="200">Payment Mode<br><select required name="payment_mode" id="PaymentMode" onchange="ShowPaymentMode()">
															<option></option>
															<option value='5'>Cash Deposit</option>
															<option value='3'>NEFT / RTGS</option>
															<option value='4'>IMPS</option>
															<option value='6'>CDM - Cash Deposit Machine</option>
															<option value='2'>Cheque</option>
															<option value='1'>Demand Draft</option>
														</select></td>
													<td width="75"></td>
													<td align="left" width="200" id="ResPaymentMode"></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left" width="200">Amount<br><input required id="filled_amount" name="deposit_amount" type="text" /></td>
													<td width="75"></td>
													<td align="left" colspan="5">Remarks<br><input required size="100" name="remarks" type="remarks" /></td>
												</tr>
											</table>
										</div>
										<div class="panel-body panel-primary text-center">
											<input type="submit" value="Send" />
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
