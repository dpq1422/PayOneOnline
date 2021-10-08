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
										Bank Details for IMPS and NEFT
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Sr. No.</th>
													<th>Bank Code</th>
													<th>Bank Name</th>
													<th>IFSC Status</th>
													<th>Payent Method</th>
													<th>Account Verification</th>
												</tr>
												<?php
												$query="SELECT * FROM eko_bank order by eko_bank_id";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);
												$i=0;
												if($num_rows>0)
												{
													$stl="style='bachground-color:white;'";
													while($rs = mysql_fetch_assoc($result))
													{
														$i++;
														if($i%2==0)
															$stl="style='bachground-color:white;'";
														else
															$stl="style='bachground-color:#e5e5e5;'";
														
														$ifsc=$rs['ifsc_status'];
														if($ifsc==1)
															$ifsc="Bank short code (e.g. SBIN) works for both IMPS and NEFT";
														else if($ifsc==2)
															$ifsc="<i style='color:red'>Bank short code works for IMPS only</i>";
														else if($ifsc==3)
															$ifsc="<i style='color:green'>System can generate logical IFSC for both IMPS and NEFT</i>";
														else if($ifsc==4)
															$ifsc="<i style='color:red'>IFSC is required</i>";
														
														$veri=$rs['verification_available'];
														if($veri==0)
															$veri="<i style='color:red'>Not Available</i>";
														else if($veri==1)
															$veri="<i style='color:green'>Available</i>";
														
														$channel=$rs['available_channels'];
														if($channel==0)
															$channel="<i style='color:green'>Both (IMPS and NEFT)</i>";
														else if($channel==1)
															$channel="<i style='color:red'>NEFT only</i>";
														else if($channel==2)
															$channel="<i style='color:red'>IMPS only</i>";
															
												?>
												<tr <?php echo $stl;?>>
													<td><?php echo $rs['eko_bank_id'];?></td>
													<td><?php echo $rs['bank_code'];?></td>
													<td align='left'><?php echo $rs['bank_name'];?></td>
													<td><?php echo $ifsc;?></td>
													<td><?php echo $channel;?></td>
													<td><?php echo $veri;?></td>
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
