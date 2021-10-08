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
										Wallet History (User Wallet)
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										
										$cond=" where 1!=1";
										if($t1!="")
											$cond=" where user_id='$t1'	 ";
									?>
										<form method="post">
										Search by 
										<input size="30" name="t1" required value="<?php echo $t1;?>" placeholder="User ID"/>
										<input type="submit" value="Search" />
										<?php
										if($t1!="")
										{
										?>
										<a style="float:right;" href="download-wallets.php?uid=<?php echo $t1;?>">Download Excel</a>
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
													<th>User Name<br>(User ID)</th>
													<th>Wallet ID</th>
													<th>Date Time</th>
													<th>Transaction Type</th>
													<th>Previous Balance</th>
													<th>Amount Cr</th>
													<th>Amount Dr</th>
													<th>Updated Balance</th>
													<th>Transaction Description</th>
												</tr>
									<?php 
										$query="SELECT * FROM child_wallet_remain $cond order by wallet_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										$a=$b=$c=$d=0;
										if($num_rows>0)
										{
											include '../functions/_my_uname.php';
											$i=0;
											while($rs = mysql_fetch_assoc($result)) 
											{
												$i++;
												if($i%2!=0)
												$style="style='background-color:white;'";
												else
												$style="style='background-color:#e5e5e5;'";
												$a+=$rs['amount_pre'];
												$b+=$rs['amount_cr'];
												$c+=$rs['amount_dr'];
												$d+=$rs['amount_bal'];
												
												$transaction_type=$rs['transaction_type'];
												if($transaction_type=="0") 
												$transaction_type="Account Opened"; 
												else if($transaction_type=="1") 
												$transaction_type="<b style='color:green;'>Wallet Amount Received</b>";
												else if($transaction_type=="2")
												$transaction_type="<b style='color:green;'>Wallet Transeferred Manual by Admin</b>"; 
												else if($transaction_type=="3")
												$transaction_type="<b style='color:green;'>Wallet Transfer on Request by Admin</b>"; 
												else if($transaction_type=="4")
												$transaction_type="<b style='color:green;'>Wallet Transferred by Team</b>"; 
												else if($transaction_type=="5")
												$transaction_type="<b style='color:blue;'>Wallet Withdraw Manual by Admin</b>";
												else if($transaction_type=="6")
												$transaction_type="Order Generated";
												else if($transaction_type=="7")
												$transaction_type="<b style='color:#cc5801;'>Failed Order Refunded</b>";
												else if($transaction_type=="8" || $transaction_type=="9")
												$transaction_type="Commission";
												else if($transaction_type=="10" || $transaction_type=="11")
												$transaction_type="Surcharges";
												else if($transaction_type=="12" || $transaction_type=="13")
												$transaction_type="<b style='color:red;'>Chargeback</b>";
												else if($transaction_type=="14" || $transaction_type=="15" || $transaction_type=="19")
												$transaction_type="Other";
												else if($transaction_type=="16")
												$transaction_type="Software Amount";
												else if($transaction_type=="17")
												$transaction_type="Security Amuount";
												else if($transaction_type=="18")
												$transaction_type="Created Commission";
												else if($transaction_type=="21")
												$transaction_type="Distribution Wallet Received";
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo show_my_uname($rs['user_id'])."<br>(".$rs['user_id'].")"; ?></td>
													<td><?php echo $rs['wallet_id'];?></td>
													<td><?php echo $rs['wallet_date']." ".$rs['wallet_time'];?></td>
													<td><?php echo $transaction_type;?></td>
													<td><?php echo $rs['amount_pre'];?></td>
													<td><?php echo $rs['amount_cr'];?></td>
													<td><?php echo $rs['amount_dr'];?></td>
													<td><?php echo $rs['amount_bal'];?></td>
													<td><?php echo $rs['transaction_description'];?></td>
												</tr>
									<?php
											}
										}
													$a=number_format((float)$a, 2, '.', '');
													$b=number_format((float)$b, 2, '.', '');
													$c=number_format((float)$c, 2, '.', '');
													$d=number_format((float)$d, 2, '.', '');
													$e=$a+$b;
													$f=$c+$d;
													$e=number_format((float)$e, 2, '.', '');
													$f=number_format((float)$f, 2, '.', '');
									?>
												<tr bgcolor='#e1e1e1' style='color:#000000;'>
													<td colspan='5'></td>
													<td colspan='2'><?php echo $a;?> + <?php echo $b;?><br>(<?php echo ($e);?>)</td>
													<td colspan='2'><?php echo $c;?> + <?php echo $d;?><br>(<?php echo ($f);?>)</td>
													<td>
													<?php
													if($e==$f)
													echo "<b style='color:green;'>Matched</b>";
													else
													echo "<b style='color:red;'>Not Matched</b>";
													?>
													</td>
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
