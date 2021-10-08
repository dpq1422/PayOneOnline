<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script language="javascript" type="text/javascript">
		function clearother(vals)
		{
			var a=document.getElementById("a").value;
			var b=document.getElementById("b").value;
			if(vals==1)
			{
				document.getElementById("b").value='';
			}
			else if(vals==2)
			{
				document.getElementById("a").value='';
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
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Transactions (Refunded To Retailer)
									</div>
								<form method="post">
									<?php											
									$s1="";
									$s2="";
									$s3="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and user_id=$s1 ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and request_id=$s2 ";
									}
									?>
									<div class="panel-body panel-primary text-left">
										Search by 
										<input type='number' size="30" placeholder="User ID" value="<?php echo $s1;?>" id='a' name='a' onkeyup='clearother(1)' />
										&nbsp;&nbsp;&nbsp;<input type='number' value="<?php echo $s2;?>" size="30" placeholder="Order ID" id='b' name='b' onkeyup='clearother(2)' />
										<input type="submit" value="Search" />
									</div>
								</form>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Wallet ID</th>
													<th>Order ID<br>Txn ID</th>
													<th>User ID</th>
													<th>User Name</th>
													<th>Transaction Type</th>
													<th>Transaction Description</th>
													<th>Previous Balance</th>
													<th>Amount Cr</th>
													<th>Amount Dr</th>
													<th>Updated Balance</th>
													<th>Date Time</th>
												</tr>
												<?php
												$query="SELECT * FROM child_wallet_remain where request_id!=0 $cond and transaction_type in(7) and transaction_description like 'RC order %' order by wallet_id desc limit 0,100";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												$i=0;
												if($num_rows>0)
												{
													include '../functions/_my_uname.php';
													$a=$b=$c=$d=0;
													while($rs = mysql_fetch_assoc($result))
													{
														$i++;
														$ttype=$rs['transaction_type'];
														$transaction_description=$rs['transaction_description'];
														if($ttype==6)
														$ttype="Order Generated";
														if($ttype==7)
														$ttype="Failed Order Refunded";
														
														$uuiidd=$rs['user_id'];
														if($uuiidd==0)
														{
															$uuiidd=100001;
														}
														$a+=$rs['amount_pre'];
														$b+=$rs['amount_cr'];
														$c+=$rs['amount_dr'];
														$d+=$rs['amount_bal'];
														
														$tp="";
														$tid="";
														$st="";
														$detail="";
														$eid=$rs['request_id'];
														
														$qry1a="select * from main_transaction_rc where rc_id='$eid'";
														$res1a=mysql_query($qry1a);
														while($rs1a=mysql_fetch_array($res1a))
														{
															$tp=$rs1a['type'];
															if($tp==3)
															{
																$tp="Prepaid";
																$detail=$rs1a['mobile_number']."<br>".$rs1a['operator']."<br>(".$rs1a['circle'].")<br>Amt: ".$rs1a['amount'];
															}
															else if($tp==4)
															{
																$tp="DTH";
																$detail=$rs1a['mobile_number']."<br>".$rs1a['operator']."<br>Amt: ".$rs1a['amount'];
															}
															$tid=$rs1a['result'];
															$st=$rs1a['rc_status'];
														}
														$tp="<b>$tp</b>";
														
														if($st==0)
															$st="<b style='color:red;'>Not Initiated</b>";
														else if($st==1)
															$st="<b style='color:blue;'>Initiated</b>";
														else if($st==2)
															$st="<b style='color:green;'>Success</b>";
														else if($st==3)
															$st="<b style='color:blue;'>Response Awaited</b>";
														else if($st==4)
															$st="<b style='color:#cc5801;'>Refund Pending</b>";
														else if($st==5)
															$st="<b style='color:#cc5801;'>Refunded</b>";
														else if($st==6)
															$st="<b style='color:red;'>6</b>";
														else 
															$st="<b style='color:red;'>UNKNOWN</b>";
												?>
												<tr style="background-color:White;">
													<td><?php echo $i;?></td>
													<td><?php echo $rs['wallet_id'];?></td>
													<td><?php echo $rs['request_id']."<br>".$tid;?></td>
													<td><?php echo $uuiidd;?></td>
													<td><?php echo show_my_uname($uuiidd);?></td>
													<td><?php echo $ttype;?></td>
													<td><?php echo $rs['transaction_description']."<br>$tp $detail <br>$st";?></td>
													<td><?php echo $rs['amount_pre'];?></td>
													<td><?php echo $rs['amount_cr'];?></td>
													<td><?php echo $rs['amount_dr'];?></td>
													<td><?php echo $rs['amount_bal'];?></td>
													<td><?php echo $rs['wallet_date']." ".$rs['wallet_time'];?></td>
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
