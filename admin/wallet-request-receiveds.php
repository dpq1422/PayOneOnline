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
						<div class="col-sm-12">
							<?php
							$t1="";
							if(isset($_POST['t1']))
								$t1=$_POST['t1'];
							
							
							$t2="";
							if(isset($_POST['t2']))
								$t2=$_POST['t2'];
							if($t2=="")
								$t2=$date_time;
							
							$t3="";
							if(isset($_POST['t3']))
								$t3=$_POST['t3'];
							if($t3=="")
								$t3=$date_time;
							
							$bank="";
							if(isset($_POST['bank']))
								$bank=$_POST['bank'];
							
							$method="";
							if(isset($_POST['method']))
								$method=$_POST['method'];
							
							$status="";
							if(isset($_POST['status']))
								$status=$_POST['status'];
							
							$cond="";
							//$conds=" order by request_id desc limit 0,100 ";
							$dts="";
							
							if($t1!="")
								$cond=" $cond and user_id='$t1' ";
							if($t2!="")
							{
								$cond=" $cond and ((request_date between '$t2' and '$t3') or (request_date between '$t3' and '$t2')) ";
								//$dts="?dts2=$t2&dts3=$t3";
							}
							if($bank!="" && $bank!=0)
								$cond=" $cond and bank_id='$bank' ";
							if($method!="" && $method!=0)
								$cond=" $cond and payment_mode='$method' ";
							if($status!="" && $status!=0)
								$cond=" $cond and request_status='$status' ";
							
								
							$query="SELECT request_status,count(*) num,sum(deposit_amount) amt FROM child_wallet_requests where bank_id<100000 and ((request_date between '$t2' and '$t3') or (request_date between '$t3' and '$t2')) group by request_status";
							$result=mysql_query($query);
							$total_num=0;
							$total_amt=0;
							$rec_num=0;
							$rec_amt=0;
							$num_rows = mysql_num_rows($result);
							if($num_rows>0)
							{
								while($rs = mysql_fetch_assoc($result)) {
									$total_num=$total_num + $rs['num'];
									$total_amt=$total_amt + $rs['amt'];
									if($rs['request_status']==1)
									{
										$rec_num=$rec_num + $rs['num'];
										$rec_amt=$rec_amt + $rs['amt'];
									}
								}
							}
							if($total_num=="")
							$total_num=0;
							if($total_amt=="")
							$total_amt=0;
							if($rec_num=="")
							$rec_num=0;
							if($rec_amt=="")
							$rec_amt=0;
						
							if($t2==$t3)
								echo "<meta http-equiv='refresh' content='15'>";
							
							?>
							<div class="col-md-4">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Total Requests
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $total_amt; ?> INR</div>
										<div class="high-light-figures"><?php echo $total_num; ?> Nos</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Processed Requests
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $total_amt-$rec_amt; ?> INR</div>
										<div class="high-light-figures"><?php echo $total_num-$rec_num; ?> Nos</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Pending Requests
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures"><?php echo $rec_amt; ?> INR</div>
										<div class="high-light-figures"><?php echo $rec_num; ?> Nos</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Wallet Requests Received by Admin
									</div>
									<div class="panel-body panel-primary text-left">
										<form method="post">
										
										From <input style="width:160px;height:30px;" type="date" size="10" required name="t2" id='t2' value="<?php echo $t2;?>" />&nbsp;
										To <input style="width:160px;height:30px;" type="date" size="10" required name="t3" id='t3' value="<?php echo $t3;?>" />&nbsp;&nbsp;<input style="width:125px;height:30px;" name="t1" id='t1' value="<?php echo $t1;?>" placeholder="User ID"/>&nbsp;&nbsp;
										<select name="bank">
											<option value='0' <?php if($bank=="") echo "selected";?>>Bank</option>
											<option value='1' <?php if($bank=="1") echo "selected";?>>SBI</option>
											<option value='2' <?php if($bank=="2") echo "selected";?>>ICICI</option>
											<option value='3' <?php if($bank=="3") echo "selected";?>>PNB</option>
										</select>&nbsp;&nbsp;
										<select name="method">
											<option value='0' <?php if($method=="") echo "selected";?>>Method</option>
											<option value='1' <?php if($method=="1") echo "selected";?>>DD</option>
											<option value='2' <?php if($method=="2") echo "selected";?>>Cheque</option>
											<option value='3' <?php if($method=="3") echo "selected";?>>NEFT/RTGS</option>
											<option value='4' <?php if($method=="4") echo "selected";?>>IMPS</option>
											<option value='5' <?php if($method=="5") echo "selected";?>>Cash</option>
											<option value='6' <?php if($method=="6") echo "selected";?>>CDM</option>
										</select>&nbsp;&nbsp;
										<select name="status">
											<option value='0' <?php if($status=="") echo "selected";?>>Status</option>										
											<option value='1' <?php if($status=="1") echo "selected";?>>Received</option>
											<option value='2' <?php if($status=="2") echo "selected";?>>Transferred</option>
											<option value='3' <?php if($status=="3") echo "selected";?>>Rejected</option>
										</select>
										<input type="submit" value="Search" />
										<input type='button' value='Download Complete Excel' onclick="window.location.href='wallet-request-received.php<?php echo $dts;?>';" style='float:right;' />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Sr.No.</th>
													<th>Req ID</th>
													<th width='150'>Requset Date/Time
													<br>Deposit Date</th>
													<th>User Name (ID)</th>
													<th>Company Account
													<br>(Payment Method)</th>
													<th>Ref No</th>
													<th>Requested Amount</th>
													<!--<th>Remarks</th>-->
													<th>Status</th>
													<?php										
													if($user_id!=100001 && $user_id!=100006)
													{
													?>
													<th>Action</th>
													<?php
													}
													?>
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_ShowAdminBankClient.php';
												include '../functions/_my_uname.php';
												include '../functions/_my_umobile.php';
												
												//if($cond=="")
													//$cond="$conds";
												$query="SELECT * FROM child_wallet_requests where  bank_id<100000 $cond order by request_id desc";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												$total=0;
												if($num_rows>0)
												{				
													$i=0;
													while($rs = mysql_fetch_array($result)) {
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
													$total+=$rs['deposit_amount'];
													
											?>
											<tr <?php echo $style;?>>
												<td><?php echo $i;?></td>
												<td><?php echo $rs['request_id'];?></td>
												<td><?php echo "<b>R:</b>".$rs['request_date']."<br>".$rs['request_time']."<br><b>D:</b>".$rs['deposite_date'];?></td>
												<td><?php echo show_my_uname($rs['user_id'])." (".$rs['user_id'].")<br>".show_my_umobile($rs['user_id']);?></td>
												<td><?php echo show_admin_bank_client(1001,$rs['bank_id'])."<br>($pm)";?></td>
												<!--<td><?php echo $pm;?></td>-->
												<td><?php echo $rs['ref_no'];?></td>
												<td><?php echo $rs['deposit_amount'];?></td>
												<!--<td><?php echo $rs['remarks'];?></td>-->
												<td><?php echo $st;?></td>
												<?php										
														if($user_id!=100001 && $user_id!=100006)
														{
												?>
												<td><?php echo $act;?></td>
											<?php
														}
											?>
											</tr>
											<?php
													}
												}
											?>
											<tr bgcolor='#e5e5e5'>
												<th colspan='6' style='text-align:right;'>Total</th>
												<th style='text-align:right;'><?php echo $total;?></th>
												<th colspan='2'></th>
											</tr>
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
