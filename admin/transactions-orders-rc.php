<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script language="javascript" type="text/javascript">
		function clearother(vals)
		{
			var a=document.getElementById("a").value;
			var b=document.getElementById("b").value;
			var c=document.getElementById("c").value;
			if(vals==1)
			{
				document.getElementById("b").value='';
				document.getElementById("c").value='';
			}
			else if(vals==2)
			{
				document.getElementById("a").value='';
				document.getElementById("c").value='';
			}			
			else if(vals==3)
			{
				document.getElementById("a").value='';
				document.getElementById("b").value='';
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
										Search Order (Transaction)
									</div>
								<form method="post">
									<?php											
									$s1="";
									$s2="";
									$s3="";
									$s4="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" or user_id='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" or rc_id='$s2' ";
									}
									if(isset($_POST['c']))
									{
										$s3=$_POST['c'];
										if($s3!="")
										$cond=" or result='$s3' ";
									}
									if(isset($_REQUEST['a']))
									{
										$s1=$_REQUEST['a'];
										if($s1!="")
										$cond=" or user_id='$s1' ";
									}
									if(isset($_REQUEST['b']))
									{
										$s2=$_REQUEST['b'];
										if($s2!="")
										$cond=" or rc_id='$s2' ";
									}
									if(isset($_REQUEST['c']))
									{
										$s3=$_REQUEST['c'];
										if($s3!="")
										$cond=" or result='$s3' ";
									}
									?>
									<div class="panel-body panel-primary text-left">
										Search by 
										<input type='number' size="30" placeholder="User ID" id='a' name='a' value="<?php echo $s1;?>" onkeyup='clearother(1)' />
										&nbsp;&nbsp;&nbsp;<input type='number' size="30" placeholder="Order ID" id='b' name='b' value="<?php echo $s2;?>" onkeyup='clearother(2)' />
										&nbsp;&nbsp;&nbsp;<input type='number' size="30" placeholder="Group ID" id='c' name='c' value="<?php echo $s3;?>" onkeyup='clearother(3)' />
										<input type="submit" value="Search" />
									</div>
								</form>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>User Name<br>(User ID)</th>
													<th>Order ID<br>Txn No</th>
													<th>Txn Type</th>
													<th>Txn Details</th>
													<th>Order Status</th>
													<th>Previous Balance</th>
													<th>Amount</th>
													<th>Wallet Balance</th>
													<th>Date Time</th>
												</tr>
												<?php
												$query="SELECT * FROM main_transaction_rc where 1!=1 $cond order by rc_id desc limit 0,20";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);
												$i=0;
												if($num_rows>0)
												{
													include '../functions/_my_uname.php';
													while($rs = mysql_fetch_assoc($result))
													{
														$i++;
														$ttype=$rs['type'];
														$detail="";
														if($ttype==3)
														{
															$ttype="Prepaid";
															$detail=$rs['mobile_number']."<br>".$rs['operator']."<br>(".$rs['circle'].")<br>Amt: ".$rs['amount'];
														}
														else if($ttype==4)
														{
															$ttype="DTH";
															$detail=$rs['mobile_number']."<br>".$rs['operator']."<br>Amt: ".$rs['amount'];
														}
														$refno=$rs['tid'];
														
														$uuiidd=$rs['user_id'];
														if($uuiidd==0)
														{
															$uuiidd=100001;
														}
														
														$st=$rs['rc_status'];
														
														$oid=$rs['rc_id'];
														$append_url="";
														if($s1!="")
															$append_url="&a=$s1";
														if($s2!="")
															$append_url="&b=$s2";
														if($s3!="")
															$append_url="&c=$s3";
														if($s4!="")
															$append_url="&d=$s4";
													
														if($st==0)
															$st="<b style='color:red;'>Not Initiated</b>";
														else if($st==1)
															$st="<b style='color:blue;'>Initiated</b>";
														else if($st==2)
														{
															if($refno!="" && $refno!=0)
															{
																$st="<b style='color:green;'>Success<br>Ref No:<br>$refno</b>";
															}
															else
															{
																$st="<b style='color:green;'>Success</b>";
															}
														}
														else if($st==3 || $st==-1)
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
													<td><?php echo show_my_uname($uuiidd);?><br><?php echo "($uuiidd)";?></td>
													<td><?php echo $oid."<br><br>".$rs['result'];?></td>
													<td><?php echo $ttype;?></td>
													<td><?php echo $detail;?></td>
													<td><?php echo $st;?></td>
													<td align="right"><?php echo $rs['pre_bal'];?></td>
													<td align="right"><?php echo $rs['deducted_amt'];?></td>
													<td align="right"><?php echo $rs['post_bal'];?></td>
													<td><?php echo $rs['created_on']."<br><br>".$rs['updated_on'];?></td>
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
