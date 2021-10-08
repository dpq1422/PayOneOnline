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
										Links for Kuldeep
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
													<td align="left">Order Search</td>
													<td><a href='admin-search-order.php' target="_blank">Search</a></td>
												</tr>
												<tr>
													<td>2</td>
													<td align="left">Order In Progress</td>
													<td><a href='admin-in-progress.php' target="_blank">In-Progress</a></td>
												</tr>
												<tr>
													<td>3</td>
													<td align="left">Order Queued</td>
													<td><a href='admin-mt-queued.php' target="_blank">Queued</a></td>
												</tr>
												<tr>
													<td>4</td>
													<td align="left">Order Process Refund (sana)</td>
													<td><a href='admin-process-refund.php' target="_blank">Refund</a></td>
												</tr>
												<tr>
													<td>5</td>
													<td align="left">Show Update / Commission for Recharge / DTH</td>
													<td><a href='commission-show.php'>Show / Update RC Comm</a></td>
												</tr>
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
