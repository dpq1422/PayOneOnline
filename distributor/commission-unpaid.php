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
										Commission Unpaid
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
													<th>Date</th>
													<th>Details</th>
													<th>Cr</th>
													<th>Dr</th>
													<th>Balance</th>
													<th>Action</th>
												</tr>
											<?php
											//SELECT date(date_time) date_time,sum(cr) cr,sum(dr) dr FROM main_commission_paid where user_id=$user_id group by date(date_time) order by date(date_time) desc
											$query="SELECT * FROM main_commission_paid where user_id=$user_id order by date_time desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												$i=0;
												$bal=0;
												while($rs = mysql_fetch_assoc($result))
												{
													$dt=$rs['date_time'];
													$status="";
													if($rs['dr']==0)
													$status="<a href='commission-unpaid.php?ddtt=$dt'>Show Details</a>";
													
											?>
												<tr>
													<td><?php echo $dt;?></td>
													<td><?php echo $rs['details'];?></td>
													<td><?php echo $rs['cr'];?></td>
													<td><?php echo $rs['dr'];?></td>
													<td><?php echo $rs['bal'];?></td>
													<td><?php echo $status;?></td>
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
