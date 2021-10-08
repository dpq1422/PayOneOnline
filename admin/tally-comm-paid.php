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
										Exp/Comm. Paid through Bank Dr
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<!--<th>Sr.No.</th>-->
													<th>Paid ID</th>
													<th>Date Time</th>
													<th>User Name <br>(User ID)</th>
													<th>Details</th>
													<th>Amount</th>
													<th>Bank Txn No</th>
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_my_uname.php';
												
												$query="SELECT * FROM child_bank_comm_paid where bnk_id=0 order by paid_id desc";
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
													
													$rid=$rs['paid_id'];
													$cid=$rs['user_id'];
													
													$act="";
													$rdts=explode(" ",$rs['date_time'])[0];
													$act=$rs['bnk_id'];
													if($act==0)
													$act="<a href='tally-update-paid-txn.php?rid=$rid&cid=$cid&rdts=$rdts'>Update</a>";
													else
													{
														$style="style='background-color:#aee2ae;'";
													}
													
											?>
											<tr <?php echo $style;?>>
												<!--<td><?php echo $i;?></td>-->
												<td><?php echo $rs['paid_id'];?></td>
												<td><?php echo $rs['date_time'];?></td>
												<td><?php echo show_my_uname($rs['user_id'])."<br>(".$rs['user_id'].")";?></td>
												<td><?php echo $rs['details'];?></td>
												<td><?php echo $rs['dr'];?></td>
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
