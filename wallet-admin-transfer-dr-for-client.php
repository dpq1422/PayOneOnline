<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="bgcolor">
    	<div class="main-container">
        	<div class="header">
				<?php include('_menu.php');?>
            </div>
            <div class="clr">
            </div>
			<?php include('_news-top.php');?>
            <div class="clr">
            </div>
			<div class="data-container">
            	<div class="data-left">
                	<?php include('_aid-left.php');?>
                </div>
            	<div class="data-mid">
                	<!-- Main Data starts Here -->
                        <h1>Fund Transfer To Client Wallet <a href="clients-wallet-requests.php" class="a-button">Back to Wallet Requests</a></h1>
						<?php
						if(isset($_REQUEST['msg']))
						{
						?>
						<p style="color:red;text-align:center;">Your Wallet Distribution limit is less than requested transferring amount.<br><br></p>
						<?php
						}
						?>
						<form method="post" action="wallet-admin-transfer-dr-for-client-code.php">
							<?php
							include('_common.php');
							include('functions/_ShowClientName.php');
							include('functions/_ShowAdminBank.php');
							$client_id=$_REQUEST['cid'];
							$request_id=$_REQUEST['rid'];
							$client_name=show_client_name($client_id);
							
							$query_r="SELECT * from parent_wallet_requests where request_id='$request_id';";
							$result_r=mysql_query($query_r);
							$deposite_date="";
							$company_account="";
							$payment_mode="";
							$ref_no="";
							$deposit_amount="";
							$remarks="";
							$userid="";
							$req_st="";
							$_SESSION['dr_amount']=0;
							while($rs_r = mysql_fetch_assoc($result_r)) 
							{
								$deposite_date=$rs_r['deposite_date'];
								$company_account=show_admin_bank($rs_r['bank_id']);
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
							}
							?>
							<table class="home" frame="box" rules="all">
								<tr>
									<td>Reuqest ID</td>
									<td>
										<input name="client_id" type="hidden" readonly value="<?php echo $client_id; ?>" class="text" />
										<input name="userid" type="hidden" readonly value="<?php echo $userid; ?>" class="text" />
										<input name="request_id" type="text" readonly value="<?php echo $request_id; ?>" class="text" />
									</td>
								</tr>
								<tr>
									<td>Client Name</td>
									<td><input type="text" readonly value="<?php echo $client_name; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Deposit Date</td>
									<td><input type="text" readonly value="<?php echo $deposite_date; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Company Account</td>
									<td><input type="text" readonly value="<?php echo $company_account; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Payment Mode</td>
									<td><input type="text" readonly value="<?php echo $payment_mode; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Ref No</td>
									<td><input type="text" readonly value="<?php echo $ref_no; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Deposit Amount</td>
									<td><input id="deposit_amount" name="deposit_amount" type="text" readonly value="<?php echo $deposit_amount; ?>" class="text" /></td>
								</tr>
								<?php
								if($req_st==1)
								{
								?>
								<tr>
									<td>Client Remarks</td>
									<td><textarea readonly><?php echo $remarks; ?></textarea></td>
								</tr>
								<tr>
									<td>Request Status</td>
									<td>
										<select name="request_status" required>
											<option></option>
											<option value="2">Transferred</option>
											<option value="3">Request Rejected</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Admin Remarks</td>
									<td><textarea name="filled_remarks" required></textarea></td>
								</tr>
								<tr>
									<td></td>
									<td align="right"><input type="submit" class="button" /></td>
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
									<td>Request Status</td>
									<td><input type="text" readonly value="<?php echo $req_sts; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Remarks</td>
									<td><textarea readonly><?php echo $remarks; ?></textarea></td>
								</tr>
								<?php
								}
								?>
							</table>  
						</form>						
                	<!-- Main Data ends Here -->
                    <div class="clr">
                    </div>
                    <?php include('_news-bottom.php');?>
                </div>
            	<div class="data-right">
                	<?php include('_aid-right.php');?>
                </div>
			</div>
            <div class="clr">
            </div>
            <div class="data-bottom">
                <?php include('_aid-bottom.php');?>
            </div>
            <div class="clr">
            </div>
			<div class="footer">
				<?php include('_footer.php');?>
			</div>
        </div>
    </body>
</html>
