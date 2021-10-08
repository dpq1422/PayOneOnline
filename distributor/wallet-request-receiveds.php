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
										Wallet Requests Received by Admin
									</div>
							<?php
							$t1="";
							if(isset($_POST['t1']))
								$t1=$_POST['t1'];
							
							
							$t2="";
							if(isset($_POST['t2']))
								$t2=$_POST['t2'];
							
							$t3="";
							if(isset($_POST['t3']))
								$t3=$_POST['t3'];
							
							$cond=" order by request_id desc limit 0,100 ";
							$dts="";
							if($t2=="")
								$t2=$date_time;
							if($t3=="")
								$t3=$date_time;
							if($t1!="")
								$cond=" and user_id='$t1' ";
							if($t2!="")
							{
								$cond=" and ((request_date between '$t2' and '$t3') or (request_date between '$t3' and '$t2'))  order by request_id desc ";
								$dts="?dts2=$t2&dts3=$t3";
							}							
							?>
									<div class="panel-body panel-primary text-left">
										<form method="post">
										From 
										<!--<input size="30" name="t1" id='t1' onclick='document.getElementById("t2").value="";' value="<?php echo $t1;?>" placeholder="User ID"/>&nbsp;&nbsp;-->
										<input type="date" required name="t2" id='t2' value="<?php echo $t2;?>" />&nbsp;&nbsp;
										To 
										<input type="date" required name="t3" id='t3' value="<?php echo $t3;?>" />&nbsp;&nbsp;
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Sr.No.</th>
													<th>Req ID</th>
													<th>Date of Deposit</th>
													<th>User Name (ID)</th>
													<th>Payment Method</th>
													<th>Requested Amount</th>
													<th>Remarks</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_ShowAdminBankClient.php';
												include '../functions/_my_uname.php';
												
												$query="SELECT * FROM child_wallet_requests where  bank_id>100000 and bank_id=$user_id $cond ";
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
													
													$rid=$rs['request_id'];
													$cid=$rs['user_id'];
													
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
													$st="<b style='color:blue;'>Received</b>";
													else if($rs['request_status']==2)
													$st="<b style='color:green;'>Transferred</b>";
													else if($rs['request_status']==3)
													$st="<b style='color:red;'>Rejected</b>";
													
													$act="";
													if($rs['request_status']==1)
													$act="<a href='wallet-request-received-reply.php?rid=$rid&uid=$cid'>Transfer / Reject</a>";
													else
													$act="<a href='wallet-request-received-reply.php?rid=$rid&uid=$cid'>Show Details</a>";
													
											?>
											<tr <?php echo $style;?>>
												<td><?php echo $i;?></td>
												<td><?php echo $rs['request_id'];?></td>
												<td><?php echo $rs['deposite_date'];?></td>
												<td><?php echo show_my_uname($rs['user_id'])."<br>(".$rs['user_id'].")";?></td>
												<td><?php echo $pm;?></td>
												<td><?php echo $rs['deposit_amount'];?></td>
												<td><?php echo $rs['remarks'];?></td>
												<td><?php echo $st;?></td>
												<td><?php echo $act;?></td>
											</tr>
											<?php
													}
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
