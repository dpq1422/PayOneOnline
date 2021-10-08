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
										User
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th width="120">Login Date<br>Login Time</th>
													<th width="120">Logout Date<br>Logout Time</th>
													<th width="100">Access Via</th>
													<th width="120">IP</th>
													<th width="120">Login Status</th>
													<th>Remarks</th>
												</tr>
												<?php						
												$uid=$_REQUEST['userid'];
												$query5="select * from child_user_log where user_id='$uid' order by log_id desc limit 0,100;";
												$result5=mysql_query($query5);
												while($row5=mysql_fetch_array($result5))
												{		
													$st="";
													if($row5['login_status']==1)
													$st="<b style='color:green;'>Success</b>";
													else if($row5['login_status']==0)
													$st="<b style='color:red;'>Failed</b>";
												?>
												<tr style="background-color:White;">
													<td><?php echo $row5['login_date']; ?><br><?php echo $row5['login_time']; ?></td>
													<td><?php echo $row5['logout_date']; ?><br><?php echo $row5['logout_time']; ?></td>
													<td><?php echo $row5['login_method']; ?></td>
													<td><?php echo $row5['login_ip']; ?></td>
													<td><?php echo $st; ?></td>
													<td><?php echo $row5['login_remarks']; ?></td>
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
