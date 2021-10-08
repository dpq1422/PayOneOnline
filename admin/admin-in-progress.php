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
										Transactions (In Progress)
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
										$cond=" and eko_transaction_id=$s2";
									}
									?>
									<div class="panel-body panel-primary text-left">
										Search by 
										<input type='number' size="30" placeholder="User ID" id='a' name='a' value="<?php echo $s1;?>" onkeyup='clearother(1)' />
										&nbsp;&nbsp;&nbsp;<input type='number' size="30" placeholder="Order ID" id='b' name='b' value="<?php echo $s2;?>" onkeyup='clearother(2)' />
										<input type="submit" value="Search" />
									</div>
								</form>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Order ID<br>(Group ID)</th>
													<th>User Name<br>(User ID)</th>
													<th>Transaction Type</th>
													<th>Transaction Result</th>
													<th>Previous Balance</th>
													<th>Amount</th>
													<th>Admin Balance</th>
													<th>Date Time</th>
												</tr>
												<?php
												//$qry="update main_transaction_mt set response='' where TIMESTAMPDIFF(SECOND, created_on, '$datetime_time')>300 and eko_transaction_status=0 $cond order by eko_transaction_id";
												//mysql_query($qry);
												$query="SELECT * FROM main_transaction_mt where TIMESTAMPDIFF(SECOND, created_on, '$datetime_time')>30 and eko_transaction_status not in(2,5) and source=1 and type=1 $cond order by eko_transaction_id desc";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);
													
												$i=0;
												$aa=$bb=0;
												if($num_rows>0)
												{
													include '../functions/_my_uname.php';
													$a=$b=$c=$d=0;
													while($rs = mysql_fetch_array($result))
													{
														$oid=$rs['eko_transaction_id'];
														$ttype=$rs['type'];
														$source=$rs['source'];
														$bank="";
														$query_bnk="select * from eko_receiver where receiver_id='".$rs['receiver_id']."'";
														$result_bnk=mysql_query($query_bnk);
														while($rs_bnk = mysql_fetch_assoc($result_bnk))
														{
															$bank=$rs_bnk['bank'];
														}
														if($ttype==1)
															$ttype="Money Transfer<br>(channel $source)<br><b>".$rs['channel_desc']."</b><br><b style='color:blue;'>$bank</b>";
														else if($ttype==2)
															$ttype="Account Verification<br>(channel $source)<br><b>".$rs['channel_desc']."</b><br><b style='color:blue;'>$bank</b>";
														
														$qry123="SELECT * FROM child_wallet_remain where transaction_type=7 and request_id='$oid'";
														$res123=mysql_query($qry123);
														$record=0;
														while($rs123=mysql_fetch_array($res123))
														{
															$record++;
														}
														
														
														$abc=$response=$rs['response'];
														$val_start='"txstatus_desc":"';
														$val_end='","fee":"';
														$pos_start=strpos($response,$val_start);
														$pos_end=strpos($response,$val_end);
														
														$startIndex = min($pos_start+17, $pos_end);
														$length = abs($pos_start+17 - $pos_end);
														$between = substr($response, $startIndex, $length);

														$response_result="$between";//$response;
														
														if($response_result=='{"response_status')
															$response_result="Failed";
														
														if($response_result=="Failed")
															continue;
														else
															$i++;
														
														$response_result="<b style='color:red;font-weight:normal;'>$response_result</b>";
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
														
														$aa+=$rs['amount'];
														$bb+=$rs['com_charged'];
												?>
												<tr style="background-color:White;">
													<td><?php echo $i;?></td>
													<td><?php echo $rs['eko_transaction_id'];?><br>(<?php echo $rs['group_id'];?>)</td>
													<td><?php echo show_my_uname($uuiidd);?><br><?php echo "($uuiidd)";?></td>
													<td><?php echo $ttype;?></td>
													<td title='<?php echo $abc;?>'>
														<?php echo $response_result;?>
														<?php 
														if($source==1)
														{
														?>
														<br><a style='color:green;' href="admin-check-order-status-for-refund.php?oid=<?php echo $rs['eko_transaction_id'];?>">Update Response</a>
														<br><br><a style='color:green;' href="admin-update-status-pending-order.php?oid=<?php echo $rs['eko_transaction_id'];?>">Update as Initiated</a>
														<?php 
															if($rs['type']==2)
															{ 
														?>
														<br><br><a style='color:green;' href="admin-update-status-acc-veri.php?oid=<?php echo $rs['eko_transaction_id'];?>&stts=2">Update as Success</a>
														<?php
															}
														}
														?>
													</td>
													<td><?php echo $rs['bal_before'];?></td>
													<td align="right">
														<?php echo str_replace(".00","",$rs['amount']);?><br><?php echo str_replace(".00","",$rs['com_charged']);?><br><b><?php echo str_replace(".00","",($rs['amount']+$rs['com_charged']));?></b>
													</td>
													<td>
														<?php echo $rs['bal_after'];?>
														<?php 
														/*
														if($source==1 && $record==0)
														{
														?>
														<br><a href="admin-refund-order.php?oid=<?php echo $rs['eko_transaction_id'];?>">Refund Order</a>
														<?php
														}
														*/
														?>
													</td>
													<td><?php echo $rs['created_on']."<br><br>".$rs['updated_on'];?></td>
												</tr>
												<?php
													}
												}
												?>
												<tr bgcolor='#e5e5e5'>
													<td colspan="6"></td>
													<td align="right"><?php echo $aa."<br>".$bb."<br>".($aa+$bb);?></td>
													<td colspan="2"></td>
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
