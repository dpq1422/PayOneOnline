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
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										My Earnings
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$t1="";
										$t2="";
										$cond="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										if(isset($_POST['t2']))
											$t2=$_POST['t2'];
										
										if(isset($_REQUEST['ddtt']))
											$t2=$_REQUEST['ddtt'];
										
										if($t2=="")
											$t2=$date_time;
									?>
										<form method="post">
										Search by 
										<input type="date" name="t2" id="t2" value="<?php echo $t2;?>" />
										&nbsp;&nbsp;
										<input size="30" name="t1" id="t1" value="<?php echo $t1;?>" placeholder="Retailer ID"/>&nbsp;&nbsp;
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
													<tr class="gridheader" align="center" style="background-color:#009DE2;">
														<th>Sr No</th>
														<th>Date Time</th>
														<th>Product Name</th>
														<th>Order No</th>
														<th>Retailer ID</th>
														<th>Earning</th>
														<th>TDS</th>
														<th>Income</th>
													</tr>
											<?php
										if($t2!="")
											$cond=" and date(date_time)='$t2' ";
											
											$query="SELECT * FROM main_commission_paid where user_id=$user_id and cr!=0 $cond order by etid desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												$i=0;
												$a=0;
												$b=0;
												$c=0;
												while($rs = mysql_fetch_assoc($result))
												{
													$etid=$rs['etid'];
													$prd_name="";
													$prd_source="";
													$ret_id="";
													
													$qry_txn="select * from main_transaction_mt where eko_transaction_id='$etid';";
													$res_txn=mysql_query($qry_txn);
													
													while($rs_txn=mysql_fetch_array($res_txn))
													{
														$prd_name=$rs_txn['type'];
														$prd_source=$rs_txn['source'];
														$ret_id=$rs_txn['user_id'];
													}
													if($t1!="")
													{
														if($t1!=$ret_id)
															continue;
													}
													
													$i++;
													if($prd_name==1)
													$prd_name="Money Transfer";
													else if($prd_name==2)
													$prd_name="Account Verification";
												
													if($prd_source==1)
													$prd_source="Channel 1";
													else if($prd_source==2)
													$prd_source="Channel 2";
													else if($prd_source==2)
													$prd_source="Channel 3";
												
													$amt=$rs['cr'];
											
													$amt=$amt*100/95;
													$tds=$amt*.05;
													$tds=($tds*100)/100;
													$amt=number_format($amt, 2, '.', '');
													$tds=number_format($tds, 2, '.', '');
													$net=$amt-$tds;
													$net=number_format($net, 2, '.', '');
													$a=$a+$amt;
													$b=$b+$tds;
													$c=$c+$net;
													$a=number_format($a, 2, '.', '');
													$b=number_format($b, 2, '.', '');
													$s=number_format($c, 2, '.', '');
													
													$usr_h3=0;
													$usr_qry="select user_name,hierarchy_3_id from child_user where user_id='$ret_id';";
													$usr_res=mysql_query($usr_qry);
													while($usr_rs=mysql_fetch_array($usr_res))
													{
														$ret_id="R - ".$ret_id." - ".$usr_rs['user_name'];
														$usr_h3=$usr_rs['hierarchy_3_id'];
													}
													if($usr_h3!=0)
													{	
														$usr_qry2="select user_name from child_user where user_id='$usr_h3';";
														$usr_res2=mysql_query($usr_qry2);
														while($usr_rs2=mysql_fetch_array($usr_res2))
														{
															$ret_id=$ret_id."<br>D - ".$usr_h3." - ".$usr_rs2['user_name'];
														}
													}
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['date_time'];?></td>
													<td><?php echo $prd_name." - ".$prd_source;?></td>
													<td><?php echo $rs['etid'];?></td>
													<td><?php echo $ret_id;?></td>
													<td align='right'><?php echo $amt;?></td>
													<td align='right'><?php echo $tds;?></td>
													<td align='right'><?php echo $net;?></td>
												</tr>
											<?php
												}
											?>
												<tr>
													<td colspan='5' align='right'><b>Total</b></td>
													<td align='right'><b><?php echo $a;?></b></td>
													<td align='right'><b><?php echo $b;?></b></td>
													<td align='right'><b><?php echo $c;?></b></td>
												</tr>
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
