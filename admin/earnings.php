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
										My Earnings
									</div>
									<div class="panel-body panel-primary text-left">
										Search by &nbsp;&nbsp;&nbsp;
										<input size="20" placeholder="Transaction ID / User ID"/>
										&nbsp;&nbsp;&nbsp;Period <input type="date" /> to <input type="date" />
										<select>
											<option>Service Type</option>
											<option>Money Transfer</option>
										</select>&nbsp;&nbsp;&nbsp;
										<input type="submit" value="Search" />
										&nbsp;&nbsp;&nbsp;
										Commission : 40
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
				<tbody><tr class="gridheader" align="center" style="background-color:#009DE2;">
					<th>S.No.</th><th>Transaction ID</th><th>User ID</th><th>User Name</th><th>Service Type</th><th>Amount</th><th>Commission</th><th>Status</th><th>Admin Share</th><th>Balance</th><th>Date Time</th>
				</tr>
				<tr style="background-color:White;">
					<td>1</td><td>345345</td><td>User ID</td><td>User Name</td><td>Recharge</td><td>5000</td><td>0</td><td>Failed</td><td>0.08%</td><td>510522</td><td>12-March-2015 11:55:53</td>
				</tr><tr style="background-color:White;">
					<td>2</td><td>456456</td><td>User ID</td><td>User Name</td><td>Money Transfer</td><td>10000</td><td>15</td><td>Success</td><td>0.15%</td><td>510522</td><td>12-March-2015 11:55:53</td>
				</tr><tr style="background-color:White;">
					<td>3</td><td>456456</td><td>User ID</td><td>User Name</td><td>Utility &amp; Bill Payments</td><td>2500</td><td>25</td><td>Success</td><td>25</td><td>520537</td><td>12-March-2015 11:55:53</td>
				</tr>
			</tbody></table>
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
