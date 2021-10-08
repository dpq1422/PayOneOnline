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
										Commission Paid
									</div>
									<div class="panel-body panel-primary text-left">
										Search by 
										<input size="60" placeholder="User ID"/>
										<input type="submit" value="Search" />
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
													<tr class="gridheader" align="center" style="background-color:#009DE2;">
														<th>Sr No</th>
														<th>Date Time</th>
														<th>Product Name</th>
														<th>Order No</th>
														<th>User ID</th>
														<th>Earning</th>
														<th>TDS</th>
														<th>Income</th>
														<th>Status</th>
													</tr>
											<?php
											$ddtt="";
											$exp="";
											if(isset($_REQUEST['ddtt']))
											{
												$ddtt=$_REQUEST['ddtt'];
												$ddtt=explode(" ",$ddtt)[0];
											}											
											
											if($ddtt!="")
											$exp=" and date(trans_date_time)='$ddtt' ";
											
											if($user_type==2)
											$query="SELECT * FROM eko_transaction_com where sd_id=$user_id and super_dist!=0 $exp order by etid desc";
											if($user_type==3)
											$query="SELECT * FROM eko_transaction_com where dist_id=$user_id and distributor!=0 $exp order by etid desc";
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
													$i++;
													$status=$rs['com_status'];
													$service=$rs['service'];
													if($status==1)
													$status="<i style='color:orange;'>Unpaid</i>";
													else if($status==2)
													$status="<i style='color:green;'>Paid</i>";
													
													if($service==1)
													$service="Account Verification";
													else if($service==2)
													$service="Money Transfer";
													
													if($user_type==2)
														$amt=$rs['super_dist'];
													if($user_type==3)
														$amt=$rs['distributor'];
											
													$tds=$amt*.05;
													$tds=($tds*100)/100;
													$tds=number_format($tds, 2, '.', '');
													$net=$amt-$tds;
													$a=$a+$amt;
													$b=$b+$tds;
													$c=$c+$net;
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['trans_date_time'];?></td>
													<td><?php echo $service;?></td>
													<td><?php echo $rs['etid'];?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $amt;?></td>
													<td><?php echo $tds;?></td>
													<td><?php echo $net;?></td>
													<td><?php echo $status;?></td>
												</tr>
											<?php
												}
											?>
												<tr>
													<th colspan='5' align='right'>Total</th>
													<th><?php echo $a;?></th>
													<th><?php echo $b;?></th>
													<th><?php echo $c;?></th>
													<th></th>
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
