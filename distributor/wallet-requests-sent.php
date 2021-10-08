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
										Wallet Requests
									</div>
									<div class="panel-body panel-primary text-left" style="float:left;">
									<?php											
									$s1="";
									$s2="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and deposite_date='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and deposit_amount=$s2 ";
									}
									?>
										<form method="post">
										Search by 
										<input type='date' id='a' onclick='document.getElementById("b").value="";' value="<?php echo $s1;?>" name='a' placeholder='Deposit Date'/>
										<input type='number' id='b' onclick='document.getElementById("a").value="";' value="<?php echo $s2;?>" name='b' placeholder='Deposit Amount'/>
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-right" style="float:right;">
										<input type="submit" value="Send New Request" onclick="location.href='wallet-request-sent.php';" />
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Req ID</th>
													<th>Date of Deposit</th>
													<th>Company Account</th>
													<th>Payment Method</th>
													<th>Ref No</th>
													<th>Requested Amount</th>
													<th>Remarks</th>
													<th>Status</th>
												</tr>
									<?php 
										include '../_common-team.php';
										include '../functions/_ShowAdminBankClient.php';
										
										$query="SELECT * FROM child_wallet_requests where user_id=$user_id $cond order by request_id desc";
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
											
											$pm="";
											if($rs['payment_mode']==1)
											$pm="Demand Draft";
											else if($rs['payment_mode']==2)
											$pm="Cheque";
											else if($rs['payment_mode']==3)
											$pm="NEFT / RTGS";
											else if($rs['payment_mode']==4)
											$pm="IMPS";
											else if($rs['payment_mode']==5)
											$pm="Cash Deposit";
											else if($rs['payment_mode']==6)
											$pm="CDM - Cash Deposit Machine";
											else if($rs['payment_mode']==7)
											$pm="Cash Value";
											else if($rs['payment_mode']==8)
											$pm="Advance Value";
											
											$st="";
											if($rs['request_status']==1)
											$st="Sent";
											else if($rs['request_status']==2)
											$st="Accepted";
											else if($rs['request_status']==3)
											$st="Rejected";
										
											$remarks=explode(" by ",$rs['remarks'])[0];
											
											if($rs['bank_id']<100000)
											$bnk=show_admin_bank_client(1001,$rs['bank_id']);
											else
											$bnk=$rs['bank_id'];
											
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $rs['request_id'];?></td>
													<td><?php echo $rs['deposite_date'];?></td>
													<td><?php echo $bnk;?></td>
													<td><?php echo $pm;?></td>
													<td><?php echo $rs['ref_no'];?></td>
													<td><?php echo $rs['deposit_amount'];?></td>
													<td><?php echo $remarks;?></td>
													<td><?php echo $st;?></td>
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
									<div class="panel-body panel-primary text-right">
										<a href="#"><<</a> Page <b>1</b> of 20 <a href="#">>></a>
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
