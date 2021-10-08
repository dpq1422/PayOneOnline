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
										Wallet Transfers (Admin)
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										
										$cond="";
										if($t1!="")
											$cond=" and user_id2='$t1' ";
									?>
										<form method="post">
										Search by 
										<input size="30" name="t1" required value="<?php echo $t1;?>" placeholder="User ID"/>
										<input type="submit" value="Search" />
										<?php
										if($user_id==100010)
										{
										?>
										&nbsp;&nbsp;&nbsp;
										<input type="button" value="Wallet Transfer" onclick="location.href='wallet-add.php';" />
										&nbsp;&nbsp;&nbsp;
										<input type="button" value="Wallet Withdraw" onclick="location.href='wallet-withdraw.php';" />
										<?php
										}
										?>
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Wallet ID</th>
													<th>Transaction Type</th>
													<th>To User ID<br>(User Name)</th>
													<th>Previous Balance</th>
													<th>Amount Cr</th>
													<th>Amount Dr</th>
													<th>Updated Balance</th>
													<th>Date Time</th>
													<th>Remarks</th>
												</tr>
									<?php 
										$query="SELECT * FROM child_wallet_remain where user_id=100001 $cond order by wallet_id desc limit 0,100";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
											include '../functions/_my_uname.php';
											$i=0;
											$a=$b=$c=$d=0;
											while($rs = mysql_fetch_assoc($result)) 
											{
												$i++;
												if($i%2!=0)
												$style="style='background-color:white;'";
												else
												$style="style='background-color:#e5e5e5;'";
												
												$tr_tp=$rs['transaction_type'];
												if($tr_tp=="0") 
												$tr_tp="Account Opened"; 
												else if($tr_tp=="1") 
												$tr_tp="Wallet Amount Received";
												else if($tr_tp=="2")
												$tr_tp="Wallet Transeferred Manual by Admin"; 
												else if($tr_tp=="3")
												$tr_tp="Wallet Transfer on Request by Admin"; 
												else if($tr_tp=="4")
												$tr_tp="Wallet Transferred by Team"; 
												else if($tr_tp=="5")
												$tr_tp="Wallet Withdraw Manual by Admin";
												else if($tr_tp=="6")
												$tr_tp="Order Generated";
												else if($tr_tp=="7")
												$tr_tp="Failed Order Refunded";
												else if($tr_tp=="8" || $tr_tp=="9")
												$tr_tp="Commission";
												else if($tr_tp=="10" || $tr_tp=="11")
												$tr_tp="Surcharges";
												else if($tr_tp=="12" || $tr_tp=="13")
												$tr_tp="Chargeback";
												else if($tr_tp=="14" || $tr_tp=="15")
												$tr_tp="Other";
												else if($tr_tp=="16")
												$tr_tp="Software Amount";
												else if($tr_tp=="17")
												$tr_tp="Security Amuount";
												else if($tr_tp=="18")
												$tr_tp="Created Commission";
												else if($tr_tp=="21")
												$tr_tp="Distribution Wallet Received";
												$a+=$rs['amount_pre'];
												$b+=$rs['amount_cr'];
												$c+=$rs['amount_dr'];
												$d+=$rs['amount_bal'];
												
												$to="";
												if($rs['user_id2']==100000)
												{
													$to="";
												}
												else if($rs['user_id2']!=0)
													$to=show_my_uname($rs['user_id2'])."<br>(".$rs['user_id2'].")";
												
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['wallet_id'];?></td>
													<td><?php echo $tr_tp;?></td>
													<td><?php echo $to;?></td>
													<td><?php echo $rs['amount_pre'];?></td>
													<td><?php if($rs['amount_cr']!=0)echo $rs['amount_cr'];?></td>
													<td><?php if($rs['amount_dr']!=0)echo $rs['amount_dr'];?></td>
													<td><?php echo $rs['amount_bal'];?></td>
													<td><?php echo $rs['wallet_date']." ".$rs['wallet_time'];?></td>
													<td><?php echo $rs['transaction_description'];?></td>
												</tr>
									<?php
											}
										}
									?>
												<tr bgcolor='#e1e1e1' style='color:#000000;'>
													<td colspan='4'></td>
													<td colspan='2'><?php echo $a;?> + <?php echo $b;?></td>
													<td colspan='2'><?php echo $c;?> + <?php echo $d;?></td>
													<td>
													<?php
													if($a+$b==$c+$d)
													echo "<b style='color:green;'>Matched</b>";
													else
													echo "<b style='color:red;'>Not Matched</b>";
													?>
													</td>
													<td></td>
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
