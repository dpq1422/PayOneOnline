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
										Reports To Download
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Report Name</th>
													<th>Action</th>
												</tr>
												<tr>
													<td>1</td>
													<td align="left"><b>Download Members Data for Calling and E-mail</b></td>
													<td align='right'><a href='report-member.php' target="_blank"><b>Download Calling Data</b></a></td>
												</tr>
												<tr>
													<td>2</td>
													<td align="left">Admin Daily Daybook</td>
													<td align='right'><a href='sonar-admin.php' target="_blank">Sonar Admin</a></td>
												</tr>
												<tr>
													<td>3</td>
													<td align="left">Summarized Transaction Report</td>
													<td align='right'><a href='sonar.php' target="_blank">Sonar Today</a></td>
												</tr>
												<tr>
													<td>4</td>
													<td align="left">Summarized Commission Report</td>
													<td align='right'><a href='sonar-coms.php' target="_blank">Sonar GST, TDS, Comm Today</a></td>
												</tr>
												<tr>
													<td>5</td>
													<td align="left">Summarized Userwise Transaction Report for Date</td>
													<td align='right'><a href='sonar-date.php' target="_blank">Sonar User Today</a></td>
												</tr>
												<tr>
													<td>6</td>
													<td align="left">Summarized Overall Transaction Report for User</td>
													<td align='right'><a href='sonar-user.php' target="_blank">Sonar User All</a></td>
												</tr>
												<tr>
													<td>7</td>
													<td align="left">Summarized Userwise Transaction Report starting to till today</td>
													<td align='right'><a href='sonar-all.php' target="_blank">Sonar All</a></td>
												</tr>
												<tr>
													<td>8</td>
													<td align="left">Update Orders</td>
													<td align='right'><a href='update-transactions.php' target="_blank">Update</a></td>
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
